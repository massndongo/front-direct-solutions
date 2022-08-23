<?php

namespace App\Controllers;

use App\Libraries\Api;

class Lignes extends BaseController
{
    protected $api;
    public function __construct()
    {
        $this->view_data = [];
 
    }
    private function _loadInitData(){
        $zones    = $this->invokeApi('get','api/list-zone-ticketing',['zonePartner'=>$this->partner_id]);
        $terminus = $this->invokeApi('get','api/list-terminus-ticketing',['termPartner'=>$this->partner_id]);
        
		$this->view_data['zoneList'] = isset($zones) && is_object($zones) && $zones->status==="00" ? $zones->response->zone:[];
        $this->view_data['terminusList'] = isset($terminus) && is_object($terminus) && $terminus->status==="00" ? $terminus->response->term:[];
    }
    public function listing(){

        if($this->request->getGet('page_ligne'))
            $this->view_data['lineOffset'] = $this->request->getGet('page_ligne');
        else $this->view_data['lineOffset']= 0;
        $this->view_data['lineLimit']  = $this->perPage;
        $this->view_data['linePartner']= $this->partner_id;

        $_total = $this->invokeApi('get','api/count-lines-ticketing',$this->view_data);
        $total = isset($_total) && is_object($_total) && $_total->status=="00" ? $_total->response->total:0;

        $this->view_data['linePartner'] = $this->partner_id;
        $_lines = $this->invokeApi('get','api/list-lines-ticketing',$this->view_data);
        $this->view_data['liste'] = isset($_lines) && is_object($_lines) && $_lines->status=="00" ? $_lines->response->ligne:[];
        
		$this->view_data['pager'] = $this->pager;
        $this->view_data['pager'] = $this->pager->setPath(LINK_URL_PAGINATION.uri_string(),'ligne');
        $this->view_data['paginate'] = ['page'=>$this->view_data['lineOffset'],'perPage'=>$this->view_data['lineLimit'],'template'=>'pagination','total'=>$total,'group'=>'ligne'];

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        return view('parameters/lignes/liste',$this->view_data);
    }
    public function add(){
        if($this->request->getMethod() == "post"){
            $rules = [
                'lineLabel'=>['label'=>'Label.ligne','rules'=>'trim|required'],
                'lineDescription'=>['label'=>'Label.description','rules'=>'trim|required'],
                'lineStart'=>['label'=>'Label.terminus_start','rules'=>'trim|required'],
                'lineEnd'=>['label'=>'Label.terminus_end','rules'=>'trim|required'],
                'lineZone'=>['label'=>'Label.zones','rules'=>'required']
            ];
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $data = $this->request->getPost();
                $data['linePartner'] = $this->partner_id;
                $response = $this->invokeApi('post','api/define-lines-ticketing',$data);
                if(isset($response) && is_object($response) && $response->status=="00")
                    $flash_message = alert('success',lang('Messages.success_add_line'));
                else $flash_message= alert('warning',lang('Messages.warning_add_line'));
            }

            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('parameters/lines-list'));
        }
        $this->_loadInitData();
        return view('parameters/lignes/form',$this->view_data);
    }
    public function edit(){
        if($this->request->getMethod() == "post"){
            $rules = [
                'lineId'=>'required',
                'lineLabel'=>['label'=>'Label.ligne','rules'=>'trim|required'],
                'lineDescription'=>['label'=>'Label.description','rules'=>'trim'],
                'lineStart'=>['label'=>'Label.terminus_start','rules'=>'trim|required'],
                'lineEnd'=>['label'=>'Label.terminus_end','rules'=>'trim|required'],
                'lineZone'=>['label'=>'Label.zones','rules'=>'required']
            ];
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $data = $this->request->getPost();
                $data['linePartner'] = $this->partner_id;
                $response = $this->invokeApi('post','api/edition-lines-ticketing',$data);
                if(isset($response) && is_object($response) && $response->status=="00")
                    $flash_message = alert('success',lang('Messages.success_edit_line'));
                else $flash_message= alert('warning',lang('Messages.warning_edit_line'));
            }

            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('parameters/lines-list'));
        }
        $lineID = $this->uri->getSegment(3);
        $_lines = $this->invokeApi('get','api/list-lines-ticketing',['lineId'=>$lineID,'linePartner'=>$this->partner_id]);
        $this->view_data['lineData'] = isset($_lines) && is_object($_lines) && $_lines->status=="00" ? (array)$_lines->response->ligne[0]:[];
        $this->_loadInitData();
        return view('parameters/lignes/form',$this->view_data);
    }
}