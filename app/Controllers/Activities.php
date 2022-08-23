<?php

namespace App\Controllers;


use App\Libraries\Api;

class Activities extends BaseController
{
    protected $api;

    public function __construct()
    {
        $this->view_data = [];
    }
    private function _initListe($form='yes'){

        $lignes     = $this->invokeApi('get','api/list-lines-ticketing',['linePartner'=>$this->partner_id]);
        $this->view_data['ligneList']   = isset($lignes) && is_object($lignes) && $lignes->status=="00" ? $lignes->response->ligne:[];

        if($form==="yes"):
            $bus        = $this->invokeApi('get','api/list-bus-ticketing',['busPartner'=>$this->partner_id]); 
            $this->view_data['busList']     = isset($bus) && is_object($bus) && $bus->status==="00" ? $bus->response->bus:[];
        endif;
        if($form==="yes"):
            $chauffeurs = $this->invokeApi('get','api/list-agent-request',['agentPartner'=>$this->partner_id,'agentPartnerType'=>$this->partnerType,'agentType'=>'T']);
            $this->view_data['driverList']  = isset($chauffeurs) && is_object($chauffeurs) && $chauffeurs->status=="00" ? $chauffeurs->response->agent:[];
        endif;
        if($form==="yes"):
            $receveurs  = $this->invokeApi('get','api/list-agent-request',['agentPartner'=>$this->partner_id,'agentPartnerType'=>$this->partnerType,'agentType'=>'R']);
            $this->view_data['receiptList'] = isset($receveurs) && is_object($receveurs) && $receveurs->status=="00" ? $receveurs->response->agent:[];
        endif;

    }
    public function add(){
        clear_session_filter_data('');
        if($this->request->getMethod() == "post"){
            $rules = [
                'ssBusId'=>['label'=>'Label.bus','rules'=>'trim|required'],
                'ssDriverId'=>['label'=>'Label.chauffeur','rules'=>'trim|required'],
                'ssReceiptId'=>['label'=>'Label.receveur','rules'=>'trim|required'],
                'ssLineId'=>['label'=>'Label.ligne','rules'=>'trim|required'],
                'ssCollectionTime'=>['label'=>'Label.collecte_time','rules'=>'trim|required'],
                'ssQrCodeStatus'=>['label'=>'Label.qrcode','rules'=>'trim|required|in_list[A,I]'],
            ];
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $data = $this->request->getPost();
                $data['ssPartner'] = $this->partner_id;
                $response = $this->invokeApi('post','api/define-session-ticketing',$data);
                if($response->status == "00")
                    $flash_message = alert('success',lang('Messages.success_create_session'));
                else $flash_message= alert('warning',lang('Messages.warning_create_session'));
            }
            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('activities/list-session'));
        }
        $this->_initListe();
        return view('activities/merchants/modal-view/form',$this->view_data);
    }

    public function edit(){
        clear_session_filter_data('');
        if($this->request->getMethod() == "post"){
            $rules = [
                'ssId'=>'required',
                'ssBusId'=>['label'=>'Label.bus','rules'=>'trim|required'],
                'ssDriverId'=>['label'=>'Label.chauffeur','rules'=>'trim|required'],
                'ssReceiptId'=>['label'=>'Label.receveur','rules'=>'trim|required'],
                'ssLineId'=>['label'=>'Label.ligne','rules'=>'trim|required'],
                'ssQrCodeStatus'=>['label'=>'Label.qrcode','rules'=>'trim|required|in_list[A,I]'],
            ];
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $data = $this->request->getPost();
                $data['ssPartner'] = $this->partner_id;
                $response = $this->invokeApi('post','api/edition-session-ticketing',$data);
                if($response->status == "00")
                    $flash_message = alert('success',lang('Messages.success_edit_session'));
                else $flash_message= alert('warning',lang('Messages.warning_edit_session'));
            }
            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('activities/list-session'));
        }
        $ssId = $this->uri->getSegment(3);
        $ssList = $this->invokeApi('get','api/list-session-ticketing',['ssPartner'=>$this->partner_id,'ssId'=>$ssId]);
        $this->view_data['tagSession'] = isset($ssList) && is_object($ssList) && $ssList->status==="00" ? (array)$ssList->response->sessions[0]:[];

        $this->_initListe();
        return view('activities/merchants/modal-view/form',$this->view_data);
    }

    public function listing(){
        clear_session_filter_data('filter-session-trajet');
        if($this->request->getMethod() == "post"){
            $this->view_data = $this->request->getPost();
            session()->set('filter-session-trajet',$this->view_data);
        }
        else{
            if($this->request->getGet('page_activities'))
                $this->view_data = session()->has('filter-session-trajet') ? session()->get('filter-session-trajet'):['ssStatut'=>'0'];
            else $this->view_data= session()->has('filter-session-trajet') ? session()->get('filter-session-trajet'):['ssStatut'=>'0'];
        }
        if($this->request->getGet('page_activities'))
            $this->view_data['ssOffset'] = $this->request->getGet('page_activities');
        else $this->view_data['ssOffset']= 0;
        $this->view_data['ssLimit']  = $this->perPage;
        $this->view_data['ssPartner']= $this->partner_id;

        $_total = $this->invokeApi('get','api/count-session-ticketing',$this->view_data);
        $total = isset($_total) && is_object($_total) && $_total->status=="00" ? $_total->response->total:0;

        $ssList = $this->invokeApi('get','api/list-session-ticketing',$this->view_data);
        $this->view_data['liste'] = isset($ssList) && is_object($ssList) && $ssList->status==="00" ? (array)$ssList->response->sessions:[];

        $this->view_data['pager'] = $this->pager;
        $this->view_data['pager'] = $this->pager->setPath(LINK_URL_PAGINATION.uri_string(),'activities');
        $this->view_data['paginate'] = ['page'=>$this->view_data['ssOffset'],'perPage'=>$this->view_data['ssLimit'],'template'=>'pagination','total'=>$total,'group'=>'activities'];

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        $this->_initListe("no");
        return view('activities/merchants/liste',$this->view_data);
    }
}