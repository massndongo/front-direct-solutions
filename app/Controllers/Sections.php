<?php

/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 21/06/2021
 * Time: 12:49
 */

namespace App\Controllers;

use App\Libraries\Api;
use App\Controllers\Prices;

class Sections extends BaseController
{
    public function __construct()
    {
        $this->view_data = [];
    }

    private function _loadInitData(){

        $rate = $this->getPrices();
        $prix = $rate['rate'];
        $this->view_data['rateList'] = $prix['rate'];
    }

    public function listing()
    {
        $this->view_data['sectionPartner'] = $this->partner_id;
        $response = $this->invokeApi('get','api/list-section-ticketing',$this->view_data);
        $this->view_data['section'] = $response->status === "00" ? (array)$response->response : [];
        $data['section'] = $this->view_data['section'];
        $data['action_url'] = 'parameters/section-add';
        $data['rate'] = $this->getPrices();

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $data['message'] = $flash_message;

        return view('parameters/sections/liste', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() == "post") {
            $rules = [
                'sectionLabel'=>['label'=>"Label.label",'rules'=>'trim|required'],
                'sectionRateId'=>['label'=>"Label.pri",'rules'=>'trim|required']
            ];
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $data = $this->request->getPost();
                $data["sectionPartner"] = (int)$this->partner_id;
                $response = $this->invokeApi('post','api/define-section-ticketing',$data);
                if(isset($response) && is_object($response) && $response->status=="00")
                    $flash_message = alert('success', lang('Messages.success_save_section'));
                else $flash_message= alert('warning', lang('Messages.warning_save_section'));
            }
            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('parameters/section-list'));
        }
        $this->_loadInitData();
        return view('parameters/sections/form', $this->view_data);
    }

    public function edit()
    {
        if ($this->request->getMethod() == "post") {
            $rules = [
                'sectionId'=>'required',
                'sectionLabel'=>['label'=>"Label.label",'rules'=>'trim|required'],
                'sectionRateId'=>['label'=>"Label.pri",'rules'=>'trim|required']
            ];
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $data = $this->request->getPost();
                $data["sectionPartner"] = (int)$this->partner_id;
                $response = $this->invokeApi('post','api/edition-section-ticketing',$data);
                if(isset($response) && is_object($response) && $response->status=="00")
                    $flash_message = alert('success', lang('Messages.success_update_section'));
                else $flash_message= alert('warning', lang('Messages.warning_update_section'));
            }
            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('parameters/section-list'));
        }

        $data['sectionPartner'] = $this->partner_id;
        $sectionID = $this->uri->getSegment(3);
        $response = $this->invokeApi('get','api/list-section-ticketing',['sectionPartner' => $data['sectionPartner'], 'sectionId' => $sectionID]);
        $this->view_data['sectionEdit'] = isset($response) && is_object($response) && $response->status == "00" ? (array)$response->response->section[0] : [];
        $this->_loadInitData();
        return view('parameters/sections/form', $this->view_data);
    }
}
