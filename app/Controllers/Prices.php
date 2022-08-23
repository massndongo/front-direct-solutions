<?php

/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 21/06/2021
 * Time: 12:48
 */

namespace App\Controllers;

use App\Libraries\Api;


class Prices extends BaseController
{
    public function listing()
    {
        $data['rate'] = $this->getPrices();
        $data['action_url'] = 'parameters/pricing-add';
        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $data['message'] = $flash_message;

        return view('parameters/prices/liste', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() == "post") {
            $data_view["rateAmount"] = (int)$this->request->getPost('rateAmount');
            $data_view["ratePartner"] = (int)$this->partner_id;
            $response = $this->invokeApi('post','api/define-rate-ticketing',$data_view);
            if (isset($response) && is_object($response) && $response->status == "00") :
                $flash_message = alert('success', lang('Messages.success_save_price'));
            else :
                $flash_message = alert('warning', lang('Messages.warning_save_price'));
            endif;
            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('parameters/pricing-list'));
        }
        return view('parameters/prices/form', $this->view_data);
    }
    public function edit()
    {
        if ($this->request->getMethod() == "post") {
            $data_view["rateId"] = (int)$this->request->getPost('rateId');
            $data_view["rateAmount"] = (int)$this->request->getPost('rateAmount');
            $data_view["ratePartner"] = (int)$this->partner_id;
            
			$response = $this->invokeApi('post','api/edition-rate-ticketing',["rateId"=>$data_view["rateId"], "ratePartner"=>$data_view["ratePartner"], "rateAmount"=>$data_view["rateAmount"]]);

            if (isset($response) && is_object($response) && $response->status == "00") :
                $flash_message= alert('success', lang('Messages.success_update_price'));
            else :
                $flash_message = alert('warning', lang('Messages.warning_save_price'));
            endif;
            session()->setFlashdata('flash_message', $flash_message);
            return redirect()->to(site_url('parameters/pricing-list'));
        }
        $this->view_data['action_url'] = 'parameters/pricing-add';
        $this->view_data['ratePartner']= $this->partner_id;
        $priceID = $this->uri->getSegment(3);
        $response= $this->invokeApi('get','api/list-rate-ticketing',['ratePartner'=>$this->view_data['ratePartner'] ,'rateId'=>$priceID]);
        $this->view_data['rateEdit'] = isset($response) && is_object($response) && $response->status=="00" ? (array)$response->response->rate[0]:[];;
        return view('parameters/prices/form',$this->view_data);
    }
}
