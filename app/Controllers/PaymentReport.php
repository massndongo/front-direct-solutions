<?php

namespace App\Controllers;

use App\Libraries\ExportPDF;

class PaymentReport extends BaseController
{
    public function __construct(){
        return redirect()->to("payment/transaction-statement");
    }

    /**
     * Payment history
     * @return string
     */
    public function transaction_list(){
        clear_session_filter_data('transaction-filter');
        $start =  $end = gmdate('d/m/Y'); $statut = $tag = '';
        if ($this->request->getMethod() == "post") {
            $rules = [
                'start' => ['label' => lang('Label.start_date'), 'rules' => 'trim|required'],
                'end' => ['label' => lang('Label.end_date'), 'rules' => 'trim|required'],
                'tag' => ['label' => lang('Aside.operation'), 'rules' => 'trim'],
                'statut' => ['label' => lang('Label.status'), 'rules' => 'trim'],
            ];
            if (!$this->validate($rules)) {
                $this->view_data['message'] = alert('warning', $this->validator->listErrors());
            }
            else {
                $data = $this->request->getPost();
                $start = $data['start'];
                $end = $data['end'];
                $statut = $data['statut'];
                $tag = $data['tag'];
            }
        }

        $data['partnerId'] = $this->partner_id;
        $data['start'] = date_fr2en($start, 1) . ' 00:00:00';
        $data['end'] = date_fr2en($end, 1) . ' 23:59:00';

        $response = $this->invokeApi('post', 'api/get-transaction-statement', $data);

        if (isset($response) && is_object($response) && $response->status == "00"){
            $this->view_data['transaction'] = $response->transactions;
        }

        session()->set('transaction-filter', $data);

        $this->view_data['start']  = $start;
        $this->view_data['end']    = $end;
        $this->view_data['statut'] = $statut;
        $this->view_data['tag']    = $tag;
        return view('report/transaction_list', $this->view_data);
    }

    /**
     *  Operations list
     */
    public function operation_list() {
        clear_session_filter_data('operation-filter');
        $start =  $end = gmdate('d/m/Y');
        if ($this->request->getMethod() == "post") {
            $rules = [
                'start' => ['label' => lang('Label.start_date'), 'rules' => 'trim|required'],
                'end' => ['label' => lang('Label.end_date'), 'rules' => 'trim|required'],
            ];
            if (!$this->validate($rules)) {
                $this->view_data['message'] = alert('warning', $this->validator->listErrors());
            }
            else {
                $data = $this->request->getPost();
                $start = $data['start'];
                $end = $data['end'];
            }
        }

        $data['partnerId'] = $this->partner_id;
        $data['start'] = date_fr2en($start, 1) . ' 00:00:00';
        $data['end'] = date_fr2en($end, 1) . ' 23:59:00';

        $response = $this->invokeApi('post', 'api/get-operation-statement', $data);
		
        if (isset($response) && is_object($response) && $response->status == "00"){
            $this->view_data['operation'] = $response->operations;
	    }

        $this->view_data['start'] = $start;
        $this->view_data['end'] = $end;

        session()->set('operation-filter', $data);

        return view('report/operation_list', $this->view_data);
    }

    /* Export data via PDF */
    public function export_transaction(){

        $filters = session()->get('transaction-filter');
 
        $filters['partnerId'] = $this->partner_id;

        $response = $this->invokeApi('post', 'api/get-transaction-statement', $filters);

        $this->pdf  = new ExportPDF();
        $pdfData = [
            'filename' => $this->partner_id . gmdate('YmdHis') . '_trx','title'=>lang('Label.transaction_history'), 'orientation'=>'P',
            'fields' => ["#", utf8_decode(lang('Label.reference')), utf8_decode(lang('Label.date')), utf8_decode(lang('Label.mobile_number')),
                utf8_decode(lang('Label.code_service')), utf8_decode(lang('Label.amount')), utf8_decode(lang('Label.commission')), utf8_decode(lang('Label.status'))
            ],
            'sizes' => [12, 23, 28, 22, 40, 20, 18, 20]
        ];
        $tuples = [];
        $total_amount = $commission = 0;

        if (isset($response) && is_object($response) && $response->status == "00"){
            $transactions = $response->transactions;
            $i = 1;
            $line = 0;
            foreach ($transactions as $item) {
                $tuples[] = $i++;
                $tuples[] = chop(utf8_decode($item->related_id));
                $tuples[] = chop(utf8_decode(date_en2fr($item->date_trx, 3)));
                $tuples[] = chop(utf8_decode($item->beneficiaire_number));
                $tuples[] = chop(utf8_decode(payment_method($item->type_trx)));
                $tuples[] = chop("[R]".utf8_decode(number_format($item->amount_trx, 0, '', ' ')));
                $tuples[] = chop("[R]".utf8_decode(number_format($item->commission_trx, 0, '', ' ')));
                $tuples[] = chop(utf8_decode($item->status_trx));
                $total_amount += str_replace(' ', '', $item->amount_trx);
                $commission += str_replace(' ', '', (int)$item->commission_trx);
                $line++;
            }
        }
        if ((int)($total_amount)>0) {
            $tuples[] =''; $tuples[] =''; $tuples[] =''; $tuples[] ='';
            $tuples[] =chop("[BR]TOTAL"); $tuples[] = chop("[BR]".number_format($total_amount, 0, '', ' '));
            $tuples[] = chop("[BR]".number_format($commission, 0, '', ' ')); $tuples[] ='';
        }
        $pdfData['tuples'] = $tuples;
        $pdfData['period'] = lang('Label.period_start') . ' ' . utf8_decode(date_en2fr($filters['start'], 2)) . ' ' . lang('Label.period_end') . ' ' . utf8_decode(date_en2fr($filters['end'], 2));
        return $this->pdf->genererTableau($pdfData);
    }

    /* Export data via PDF */
    public function export_operation(){
		
        $filters = session()->get('operation-filter');

        $filters['partnerId'] = $this->partner_id;

        $response = $this->invokeApi('post', 'api/get-operation-statement', $filters);

        $this->pdf  = new ExportPDF();
        $pdfData = [
            'filename' => $this->partner_id . gmdate('YmdHis') . '_operation','title'=>lang('Label.operation_history'), 'orientation'=>'P',
            'fields' => ["#", utf8_decode(lang('Label.reference')), utf8_decode(lang('Label.date')), utf8_decode(lang('Aside.operation')),
                utf8_decode(lang('Label.initial_balance')), utf8_decode(lang('Label.amount')), utf8_decode(lang('Label.final_balance')), utf8_decode(lang('Label.status'))
            ],
            'sizes' => [12, 23, 28, 32, 28, 20, 22, 23]
        ];
        $tuples = [];

        if (isset($response) && is_object($response) && $response->status == "00"){
            $operations = $response->operations;
            $i = 1;
            $line = 0;
            foreach ($operations as $item) {
                $tuples[] = $i++;
                $tuples[] = chop(utf8_decode($item->related_trx));
                $tuples[] = chop(utf8_decode(date_en2fr($item->date_trx, 3)));
                $tuples[] = chop(utf8_decode($item->type_trx));
                $tuples[] = chop("[R]".utf8_decode(number_format($item->solde_initial, 0, '', ' ')));
                $tuples[] = chop("[R]".utf8_decode(number_format($item->amount_trx, 0, '', ' ')));
                $tuples[] = chop("[R]".utf8_decode(number_format($item->solde_finial, 0, '', ' ')));
                $tuples[] = chop(utf8_decode($item->status_trx));
                $line++;
            }
        }
        $pdfData['tuples'] = $tuples;
        $pdfData['period'] = lang('Label.period_start') . ' ' . utf8_decode(date_en2fr($filters['start'], 2)) . ' ' . lang('Label.period_end') . ' ' . utf8_decode(date_en2fr($filters['end'], 2));
        return $this->pdf->genererTableau($pdfData);
    }


}