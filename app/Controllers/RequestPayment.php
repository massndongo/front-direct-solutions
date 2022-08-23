<?php

namespace App\Controllers;


use App\Libraries\Api;

class RequestPayment extends BaseController
{
    public function __construct()
    {
        $identities = $this->invokeApi('get','api/list-identities',[]);
        $this->view_data['identities'] = $identities->status == "00" ? (array)$identities->response:[];
    }

    public function new_request(){
         if($this->request->getMethod() == "post"){
            $rules = [
                'amount'=>['label'=>'Label.amount','rules'=>'trim|required'],
                'beneficiaryPhoneNumber'=>['label'=>'Label.mobile_number','rules'=>'trim|required'],
                'codeService'=>['label'=>'Label.codeService','rules'=>'trim|required'],
            ];
            if(!$this->validate($rules)){
                $this->view_data['message'] = alert('warning',$this->validator->listErrors());
            }
            else{
                $data = $this->request->getPost();
                $this->view_data['partnerId']=  time();

                $response = $this->invokeApi('post','api/payment-request',$data);
                if(isset($response) && is_object($response) && $response->status=="00"):
                    session()->setFlashdata('flash_message',alert('success',lang('Messages.success_send_request')));
                    return redirect()->to(site_url('requestPayment/requestPayment-add'));
                else:
                    $this->view_data['message'] = alert('warning',lang('Messages.warning_send_request'));
                endif;
            }
        }

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        $this->view_data['titlePage'] = lang('Aside.menu_payment_request');
        $this->view_data['subTitlePage'] = lang('Label.request_add_title_comment');
        return view('requestPayment/form', $this->view_data);
    }
   
}