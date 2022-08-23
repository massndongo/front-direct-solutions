<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 13/09/2021
 * Time: 16:42
 */

namespace App\Controllers;


class PushPayment extends BaseController
{

    /* Current merchant dashboard */
    public function dashboard(){

       // debug_data(session()->get("menus"), true);
        $this->view_data['partner'] = $this->partner_id;
        $this->view_data['service_code'] = 'PUSH_PAY';

        $_payment = $this->invokeApi('get','api/payment-history', $this->view_data);
        $payment_list = isset($_payment) && is_object($_payment) && $_payment->status=="00" ? $_payment->response->payment:[];

        /* Total transactions received */
        $this->view_data['total_received'] = count($payment_list);
        /* Total transactions succeed */
        $s_status = 'S';

        $this->view_data['total_succeed'] = array_count_values(array_column($payment_list, 'status'))[$s_status] ?? 0;

        /* Total transactions failed */
        $f_status = 'F';
        $this->view_data['total_failed'] = array_count_values(array_column($payment_list, 'status'))[$f_status] ?? 0;

        /* Compensation total amount */
        $this->view_data['compensation_amount'] = 0;

        // debug_data($this->view_data, true);

        $this->view_data['pay_list'] = $payment_list;

        return view('push_payment/payme_dashboard', $this->view_data);
    }

    /**
     * @deprecated
     * It will remove soon
     * @return string|void
     */
    public function push_payment_request_old()
    {
        if ($this->request->getMethod() == "post") {
            $rules = [
                'amount' => ['label' => 'Label.amount', 'rules' => 'trim|required'],
                'customerPhoneNumber' => ['label' => 'Label.mobile_number', 'rules' => 'trim|required'],
                'serviceCode' => ['label' => 'Label.codeService', 'rules' => 'trim|required'],
            ];
            if (!$this->validate($rules)) {
                $this->view_data['message'] = alert('warning', $this->validator->listErrors());
            }
            else {
                $data = $this->request->getPost();
                $data['partnerId'] = $this->partner_id;

                $response = $this->invokeApi('post', 'api/push-payment', $data);
                $jsonData = [];
                if (isset($response) && is_object($response) && $response->status == "00"):
                    $jsonData['status'] = true;
                    $jsonData['title']  = lang('Messages.success');
                    $jsonData['message']= lang('Messages.success_send_request');
                /*session()->setFlashdata('flash_message', alert('success', ));
                return redirect()->to(site_url('payment/push-payment-request'));*/
                else:
                    $jsonData['status'] = false;
                    $jsonData['title']  = lang('Messages.error');
                    $jsonData['message']= lang('Messages.warning_send_request');
                    /*$this->view_data['message'] = alert('warning', lang('Messages.warning_send_request'));*/
                endif;
                echo json_encode($jsonData);
                return;
            }
        }

        $flash_message = session()->getFlashdata('flash_message');
        if (isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        $this->view_data['titlePage'] = lang('Aside.menu_payment_request');
        $this->view_data['subTitlePage'] = lang('Label.request_add_title_comment');
        return view('push_payment/push_payment_form', $this->view_data);

    }
    /**
     * @return string
     */
    public function push_payment_request(){
        $flash_message = session()->getFlashdata('flash_message');
        if (isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        $this->view_data['titlePage'] = lang('Aside.menu_payment_request');
        $this->view_data['subTitlePage'] = lang('Label.request_add_title_comment');
        return view('push_payment/push_payment_form', $this->view_data);
    }

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function push_payment_request_modal(){
        if ($this->request->getMethod() == "post") {
            $rules = [
                'amount' => ['label' => 'Label.amount', 'rules' => 'trim|required'],
                'customerPhoneNumber' => ['label' => 'Label.mobile_number', 'rules' => 'trim|required'],
                'serviceCode' => ['label' => 'Label.codeService', 'rules' => 'trim|required'],
            ];
            if (!$this->validate($rules)) {
                $flash_message = alert('warning', $this->validator->listErrors());
            }
            else {
                $data = $this->request->getPost();
                $data['partnerId'] = $this->partner_id;

                $response = $this->invokeApi('post', 'api/push-payment', $data);
                $jsonData = [];
                if (isset($response) && is_object($response) && $response->status == "00"):
                    /*$jsonData['status'] = true;
                    $jsonData['title']  = lang('Messages.success');*/
                    $flash_message= alert('success',lang('Messages.success_send_request'));
                else:
                    /*$jsonData['status'] = false;
                    $jsonData['title']  = lang('Messages.error');*/
                    $flash_message= alert('warning',lang('Messages.warning_send_request'));
                endif;
            }
            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('payment/push-payment-request'));
        }
        $this->view_data['service_code'] = $this->uri->getSegment(3);
        return view('push_payment/form', $this->view_data);
    }

    /**
     * Payment history
     * @return string
     */
    public function payment_history(){

        $this->view_data['partner'] = $this->partner_id;
        $this->view_data['service_code'] = 'PUSH_PAY';

        $_payment = $this->invokeApi('get','api/payment-history', $this->view_data);
        $this->view_data['pay_list'] = isset($_payment) && is_object($_payment) && $_payment->status=="00" ? $_payment->response->payment:[];

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        return view('push_payment/liste', $this->view_data);
    }

    /**
     * PUSH PAYEMENT BY BANK CARD
     */
    public function bank_card_payment_request() {

        if ($this->request->getMethod() == "post") {
            $rules = [
                'montant' => ['label' => lang('Label.amount'), 'rules' => 'trim|required'],
                'serviceCode' => ['label' => lang('Label.codeService'), 'rules' => 'trim|required'],
                'client_firstname' => ['label' => lang('Label.first_name'), 'rules' => 'trim|required'],
                'client_lastname' => ['label' => lang('Label.last_name'), 'rules' => 'trim|required'],
                'numeroBeneficiaire' => ['label' => lang('Label.mobile_number'), 'rules' => 'trim|required'],
                'email' => ['label' => lang('Label.email'), 'rules' => 'trim|valid_email|required'],
            ];
            if (!$this->validate($rules)) {
                $flash_message = alert('warning', $this->validator->listErrors());
            }
            else {
                $data = $this->request->getPost();
                $amount = str_replace(" ", "", $data['montant']);
                $data['montant'] = (int)$amount;
				$data['partnerId'] = $this->partner_id;
				$phone = str_replace(" ", "", $data['numeroBeneficiaire']);
				$data['numeroBeneficiaire'] = str_replace("+", "", $phone);
				
                // debug_data($data, true);
				log_message('critical', 'Bank Pay DATA :: ' . print_r($data, true));
                $response = $this->invokeApi('post', 'api/card-payment-request', $data);
				log_message('critical', 'RES :: ' . print_r($response, true));
                if (isset($response) && is_object($response) && $response->status == "00"):
                    $flash_message= alert('success',lang('Messages.success_send_request'));
                else:
                    $flash_message= alert('warning',lang('Messages.warning_send_request'));
                endif;
            }
            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('payment/push-payment-request'));
        }

        $this->view_data['service_code'] = $this->uri->getSegment(3);
        return view('push_payment/bank_card_payment_form', $this->view_data);
    }

}