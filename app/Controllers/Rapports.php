<?php

namespace App\Controllers;


use App\Libraries\Excel;
use App\Libraries\ExportPDF;

class Rapports extends BaseController
{
    protected $excel;
    protected $pdf;
    protected $api;
    public function __construct()
    {
       $this->excel = new Excel();
        $this->pdf  = new ExportPDF();
    }

    public function collecte_ticket(){
        $filters= session()->get('filter-collect');
        if(isset($filters) && is_array($filters) && count($filters)>0){
            if(isset($filters['collectLimit']))
                unset($filters['collectLimit']);
            if(isset($filters['collectOffset']))
                unset($filters['collectOffset']);
        }
        $filters['collectPartnerId'] = $this->partner_id;
        $collectes   = $this->invokeApi('get','api/data-collect-list-ticketing-request',$filters);
        $totalAmount = $this->invokeApi('get','api/data-collect-total-amount-ticketing-request',$filters);
        $format = $this->uri->getSegment(3);
        if($format === "x") {
            $excelData = [
                'filename' => $this->partner_id . gmdate('YmdHis') . '_collecte.xlsx',
                'fields' => [
                    "#", lang('Label.date'), lang('Label.ligne'), lang('Label.registration_number'), lang('Label.receveur'), lang('Label.zone'), lang('Label.section'), lang('Label.qte'), lang('Label.total')
                ],
                'sizes' => [10, 25, 15, 20, 30, 15, 15, 15, 20],
                'alignments' => [7 => 'right', 8 => 'right']
            ];
            $tuples = [];
            if (isset($collectes) && is_object($collectes) && $collectes->status == "00") {
                if (is_array($collectes->response->history) && count($collectes->response->history) > 0) {
                    $i = 1;
                    $line = 0;
                    foreach ($collectes->response->history as $item) {
                        $tuples[$line][] = $i++;
                        $tuples[$line][] = date_en2fr($item->collectDate, 3);
                        $tuples[$line][] = lang('Label.ligne_numero', ['number' => $item->collectLigneSession]);
                        $tuples[$line][] = $item->collectVehicleSession;
                        $tuples[$line][] = $item->collectReceiptSession;
                        $tuples[$line][] = $item->collectZoneLabel;
                        $tuples[$line][] = $item->collectSectionLabel;
                        $tuples[$line][] = number_format($item->collectQte, 0, '', ' ');
                        $tuples[$line][] = number_format($item->collectTotal, 0, '', ' ');
                        $line++;
                    }
                }
            }
            if (isset($totalAmount) && is_object($totalAmount) && $totalAmount->status == "00") {
                if ((float)$totalAmount->response->totalAmount > 0) {
                    $tuples[] = ['', '', '', '', '', '', '', 'Total', number_format($totalAmount->response->totalAmount, 0, '', ' ')];
                }
            }
            $excelData['tuples'] = $tuples;

            $this->excel->generateFeuille($excelData);
            return;
        }
        else{
            $pdfData = [
                'orientation'=>'P','filename' => $this->partner_id . gmdate('YmdHis') . '_collecte','title'=>lang('Aside.submenu_etat_collecte_ticket_comment'),
                'fields' => [ "#", utf8_decode(lang('Label.date')), utf8_decode(lang('Label.ligne')), utf8_decode(lang('Label.registration_number')),
                    utf8_decode(lang('Label.receveur')), utf8_decode(lang('Label.zone')), utf8_decode(lang('Label.section')), utf8_decode(lang('Label.qte')),
                    utf8_decode(lang('Label.total'))],
                'sizes' => [10, 35, 17, 30, 30, 15, 20, 8, 25]
            ];
            $tuples = [];
            if (isset($collectes) && is_object($collectes) && $collectes->status == "00") {
                if (is_array($collectes->response->history) && count($collectes->response->history) > 0) {
                    $i = 1;
                    $line = 0;
                    foreach ($collectes->response->history as $item) {
                        $tuples[] = $i++;
                        $tuples[] = chop(utf8_decode(date_en2fr($item->collectDate, 3)));
                        $tuples[] = chop(utf8_decode(lang('Label.ligne_numero', ['number' => $item->collectLigneSession])));
                        $tuples[] = $item->collectVehicleSession;
                        $tuples[] = chop(utf8_decode($item->collectReceiptSession));
                        $tuples[] = chop(utf8_decode($item->collectZoneLabel));
                        $tuples[] = chop(utf8_decode($item->collectSectionLabel));
                        $tuples[] = chop("[C]".number_format($item->collectQte, 0, '', ' '));
                        $tuples[] = chop("[R]".number_format($item->collectTotal, 0, '', ' '));
                        $line++;
                    }
                }
            }
            if (isset($totalAmount) && is_object($totalAmount) && $totalAmount->status == "00") {
                if ((float)$totalAmount->response->totalAmount > 0) {
                    $tuples[] =''; $tuples[] =''; $tuples[] =''; $tuples[] =''; $tuples[] ='';
                    $tuples[] ='[B]Total'; $tuples[] ='';$tuples[] ='';
                    $tuples[] =chop("[BR]".number_format($totalAmount->response->totalAmount, 0, '', ' '));
                }
            }
            $pdfData['tuples'] = $tuples;
            return $this->pdf->genererTableau($pdfData);
        }
    }

    public function collecte_expense(){
        $filters= session()->get('filter-collect-expense');
        if(isset($filters) && is_array($filters) && count($filters)>0){
            if(isset($filters['expenseLimit']))
                unset($filters['expenseLimit']);
            if(isset($filters['expenseOffset']))
                unset($filters['expenseOffset']);
        }
        $filters['expensePartner'] = $this->partner_id;
        $collectes   = $this->invokeApi('get','api/data-expense-list-ticketing-request',$filters);
        $totalAmount = $this->invokeApi('get','api/data-expense-total-amount-ticketing-request',$filters);
        $format = $this->uri->getSegment(3);
        if($format === "x") {
            $excelData = [
                'filename' => $this->partner_id . gmdate('YmdHis') . '_expense.xlsx',
                'fields' => [
                    "#", lang('Label.reference'), lang('Label.date'), lang('Label.expense'), lang('Label.ligne'), lang('Label.registration_number'), lang('Label.receveur'), lang('Label.total')
                ],
                'sizes' => [10, 15, 25, 30, 15, 20, 30, 30],
                'alignments' => [7 => 'right']
            ];
            $tuples = [];
            if (isset($collectes) && is_object($collectes) && $collectes->status == "00") {
                if (is_array($collectes->response->expense) && count($collectes->response->expense) > 0) {
                    $i = 1;
                    $line = 0;
                    foreach ($collectes->response->expense as $item) {
                        $tuples[$line][] = $i++;
                        $tuples[$line][] = date_en2fr($item->expenseDate, 3);
                        $tuples[$line][] = $item->expenseReference;
                        $tuples[$line][] = $item->expenseTypeLibelle;
                        $tuples[$line][] = lang('Label.ligne_numero', ['number' => $item->expenseLineNumber]);
                        $tuples[$line][] = $item->expenseVehicleRegistrationNumber;
                        $tuples[$line][] = $item->expenseReceiver;
                        $tuples[$line][] = number_format($item->expenseAmount, 0, '', ' ');
                        $line++;
                    }
                }
            }
            if (isset($totalAmount) && is_object($totalAmount) && $totalAmount->status == "00") {
                if ((float)$totalAmount->response->amount > 0) {
                    $tuples[] = ['', '', '', '', '', '', 'Total', number_format($totalAmount->response->amount, 0, '', ' ')];
                }
            }
            $excelData['tuples'] = $tuples;

            $this->excel->generateFeuille($excelData);
            return;
        }
        else{
            $pdfData = [
                'filename' => $this->partner_id . gmdate('YmdHis') . '_expense','title'=>lang('Aside.submenu_etat_collecte_depense_comment'),'orientation'=>'P',
                'fields' => ["#", utf8_decode(lang('Label.reference')), utf8_decode(lang('Label.date')), utf8_decode(lang('Label.expense')),
                    utf8_decode(lang('Label.ligne')), utf8_decode(lang('Label.registration_number')), utf8_decode(lang('Label.receveur')), utf8_decode(lang('Label.total'))
                ],
                'sizes' => [10, 30, 25, 30, 15, 20, 30, 30]
            ];
            $tuples = [];
            if (isset($collectes) && is_object($collectes) && $collectes->status == "00") {
                if (is_array($collectes->response->expense) && count($collectes->response->expense) > 0) {
                    $i = 1;
                    $line = 0;
                    foreach ($collectes->response->expense as $item) {
                        $tuples[] = $i++;
                        $tuples[] = chop(utf8_decode(date_en2fr($item->expenseDate, 3)));
                        $tuples[] = chop(utf8_decode($item->expenseReference));
                        $tuples[] = chop(utf8_decode($item->expenseTypeLibelle));
                        $tuples[] = chop(utf8_decode(lang('Label.ligne_numero', ['number' => $item->expenseLineNumber])));
                        $tuples[] = chop(utf8_decode($item->expenseVehicleRegistrationNumber));
                        $tuples[] = chop(utf8_decode($item->expenseReceiver));
                        $tuples[] = chop("[R]".utf8_decode(number_format($item->expenseAmount, 0, '', ' ')));
                        $line++;
                    }
                }
            }
            if (isset($totalAmount) && is_object($totalAmount) && $totalAmount->status == "00") {
                if ((float)$totalAmount->response->amount > 0) {
                    $tuples[] =''; $tuples[] = ''; $tuples[] =''; $tuples[] =''; $tuples[] =''; $tuples[] ='';
                    $tuples[] ='Total'; $tuples[] =chop("[BR]".number_format($totalAmount->response->amount, 0, '', ' '));
                }
            }
            $pdfData['tuples'] = $tuples;
            return $this->pdf->genererTableau($pdfData);
        }
    }
}