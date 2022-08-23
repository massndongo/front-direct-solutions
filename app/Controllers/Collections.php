<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 06/07/2021
 * Time: 13:01
 */

namespace App\Controllers;


use App\Libraries\Api;

class Collections extends BaseController
{
    protected $api;
    public function __construct()
    {
        $this->view_data = [];
 
    }

    private function _initListe($form=''){

        $agents     = $this->invokeApi('get','api/list-agent-by-session-request',['agentPartner'=>$this->partner_id]);
        $this->view_data['agentList']  = isset($agents) && is_object($agents) && $agents->status==="00" ? $agents->response->agent:[];

		$lignes     = $this->invokeApi('get','api/list-lines-ticketing',['linePartner'=>$this->partner_id]);
        $this->view_data['ligneList']   = isset($lignes) && is_object($lignes) && $lignes->status=="00" ? $lignes->response->ligne:[];

        if($form=="ticket"):
            $zones     = $this->invokeApi('get','api/list-zone-ticketing',['zonePartner'=>$this->partner_id]);
            $this->view_data['zoneList']   = isset($zones) && is_object($zones) && $zones->status=="00" ? $zones->response->zone:[];

            if(isset($this->view_data['collectZoneId']) && !empty($this->view_data['collectZoneId'])){
                $_zone     = $this->invokeApi('get','api/list-zone-ticketing',['zonePartner'=>$this->partner_id,'zoneId'=>$this->view_data['collectZoneId']]);
                $this->view_data['sectionList'] = isset($_zone) && is_object($_zone) && $_zone->status=="00" ? $_zone->response->zone->zoneSection:[];
            }
            else {
                $sections = $this->invokeApi('get', 'api/list-section-ticketing', ['sectionPartner' => $this->partner_id]);
                $this->view_data['sectionList'] = isset($sections) && is_object($sections) && $sections->status == "00" ? $sections->response->section : [];
            }
        elseif($form=="expense"):
            $expenses = $this->invokeApi('get','api/liste-type-expense-ticketing-request',['typeExpensePartner'=>$this->partner_id]);
            $this->view_data['typeList'] = isset($expenses) && is_object($expenses) && $expenses->status == "00" ? $expenses->response->typeExpense:[];

            $vehicles = $this->invokeApi('get','api/list-bus-ticketing',['busPartner'=>$this->partner_id]);
            $this->view_data['busList'] = isset($vehicles) && is_object($vehicles) && $vehicles->status == "00" ? $vehicles->response->bus:[];
        endif;
    }
    /* ETAT COLLECTE DES TICKETS */
    public function liste(){
        clear_session_filter_data('filter-collect');
        if($this->request->getMethod() == "post"){
            $this->view_data = $this->request->getPost();
            session()->set('filter-collect',$this->view_data);
        }
        else{
            if($this->request->getGet('page_collect'))
                $this->view_data = session()->get('filter-collect');
            else $this->view_data= ['collectStartDate'=>gmdate('d/m/Y'),'collectEndDate'=>gmdate('d/m/Y')];
            session()->set('filter-collect',$this->view_data);
        }
        $this->view_data = session()->get('filter-collect');

        if($this->request->getGet('page_collect'))
            $this->view_data['collectOffset'] = $this->request->getGet('page_collect');
        else $this->view_data['collectOffset']= 0;

        $this->view_data['collectLimit'] = $this->perPage;
        $this->view_data['collectPartnerId'] = $this->partner_id;
        $collectes   = $this->invokeApi('get','api/data-collect-list-ticketing-request',$this->view_data);
        $total 	     = $this->invokeApi('get','api/data-collect-total-ticketing-request',$this->view_data);
        $totalAmount = $this->invokeApi('get','api/data-collect-total-amount-ticketing-request',$this->view_data);

        $this->view_data['liste'] = isset($collectes) && is_object($collectes) && $collectes->status=="00" ? $collectes->response->history:[];
        $this->view_data['totalAmount'] = isset($totalAmount) && is_object($totalAmount) && $totalAmount->status == "00" ? $totalAmount->response->totalAmount:0;
        $nbElement = isset($total) && is_object($total) && $total->status=="00" ? $total->response->total:0;

        $this->view_data['pager'] = $this->pager;
        $this->view_data['pager'] = $this->pager->setPath(LINK_URL_PAGINATION.uri_string(),'collect');
        $this->view_data['paginate'] = ['page'=>$this->view_data['collectOffset'],'perPage'=>$this->view_data['collectLimit'],'template'=>'pagination','total'=>$nbElement,'group'=>'collect'];

        $this->_initListe('ticket');
        return view('collections/merchant/liste',$this->view_data);
    }
    public function details(){
        $historyId = $this->uri->getSegment(3);

        $details = $this->invokeApi('get','api/data-collect-list-detail-ticketing-request',['collectPartnerId'=>$this->partner_id,'collectHistoryId'=>$historyId]);
        $this->view_data['history'] = isset($details) && is_object($details) && $details->status == "00" ? (array)$details->response->history:[];
        
		return view('collections/merchant/modal-view/details',$this->view_data);
    }
    /* ETAT COLLECTE DES DEPENSES */
    public function expense_list(){
        clear_session_filter_data('filter-collect-expense');
        if($this->request->getMethod() == "post"){
            $this->view_data = $this->request->getPost();
            session()->set('filter-collect-expense',$this->view_data);
        }
        else{
            if($this->request->getGet('page_expense'))
                $this->view_data = session()->get('filter-collect-expense');
            else $this->view_data= ['expenseStartDate'=>gmdate('d/m/Y'),'expenseEndDate'=>gmdate('d/m/Y')];
            session()->set('filter-collect-expense',$this->view_data);
        }
        $this->view_data = session()->get('filter-collect-expense');

        if($this->request->getGet('page_expense'))
            $this->view_data['expenseOffset'] = $this->request->getGet('page_expense');
        else $this->view_data['expenseOffset']= 0;

        $this->view_data['expenseLimit'] = $this->perPage;
        $this->view_data['expensePartner'] = $this->partner_id;

        $collectes   = $this->invokeApi('get','api/data-expense-list-ticketing-request',$this->view_data);
        $total 	     = $this->invokeApi('get','api/data-expense-total-ticketing-request',$this->view_data);
        $totalAmount = $this->invokeApi('get','api/data-expense-total-amount-ticketing-request',$this->view_data);

        $this->view_data['liste'] = isset($collectes) && is_object($collectes) && $collectes->status=="00" ? $collectes->response->expense:[];
        $this->view_data['totalAmount'] = isset($totalAmount) && is_object($totalAmount) && $totalAmount->status == "00" ? $totalAmount->response->amount:0;
        $nbElement = isset($total) && is_object($total) && $total->status=="00" ? $total->response->total:0;

        $this->view_data['pager'] = $this->pager;
        $this->view_data['pager'] = $this->pager->setPath(LINK_URL_PAGINATION.uri_string(),'expense');
        $this->view_data['paginate'] = ['page'=>$this->view_data['expenseOffset'],'perPage'=>$this->view_data['expenseLimit'],'template'=>'pagination','total'=>$nbElement,'group'=>'expense'];

        $this->_initListe('expense');
        return view('collections/merchant/expense_liste',$this->view_data);
    }
}