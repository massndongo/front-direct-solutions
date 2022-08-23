<?php

namespace App\Controllers;


class Expenses extends BaseController
{

    public function __construct()
    {
        $this->data = [];
    }

    public function listing(){
        if ($this->partner_id) {
            $this->data['action_url'] = 'parameters/expense-add';
            $this->data['typeExpensePartner'] = (int)$this->partner_id;
            $response = $this->invokeApi('get','api/liste-type-expense-ticketing-request',$this->data);
            $this->data['depense'] = isset($response) && is_object($response) && $response->status=="00" ? $response->response->typeExpense:[];
            
            $flash_message = session()->getFlashdata('flash_message');
            if(isset($flash_message) && !empty($flash_message))
                $this->data['message'] = $flash_message;

        }
        return view('parameters/expenses/liste', $this->data);
    }

    public function add(){
        
        if ($this->request->getMethod() == "post") {
            $rules = [
                'typeExpenseLibelle'=>['label'=>"Label.label",'rules'=>'trim|required'],
            ];
            
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else {
                $this->data["typeExpenseLibelle"] = $this->request->getPost("typeExpenseLibelle");
                $this->data['typeExpensePartner'] = (int)$this->partner_id;
                $response = $this->invokeApi('post','api/definition-type-expense-ticketing-request',$this->data);
                if (isset($response) && is_object($response) && $response->status == "00") :
                    $flash_message = alert('success', lang('Messages.success_save_expense'));
                else :
                    $flash_message = alert('warning', lang('Messages.warning_save_expense'));
                endif;
            }
            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('parameters/expense-list'));
        }
        return view('parameters/expenses/form', $this->data);

    }

    public function edit(){
        
        if ($this->request->getMethod() == "post") {
            $rules = [
                'typeExpenseLibelle'=>['label'=>"Label.label",'rules'=>'trim|required'],
            ];
            
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $this->data["typeExpenseId"] = (int)$this->request->getPost('typeExpenseId');
                $this->data["typeExpenseLibelle"] = $this->request->getPost('typeExpenseLibelle');
                $this->data["typeExpensePartner"] = (int)$this->partner_id;
                
                $response = $this->invokeApi('post','api/edition-type-expense-ticketing-request',$this->data);

                if (isset($response) && is_object($response) && $response->status == "00") :
                    $flash_message= alert('success', lang('Messages.success_save_expense'));
                else :
                    $flash_message = alert('warning', lang('Messages.warning_save_expense'));
                endif;
            }
            session()->setFlashdata('flash_message', $flash_message);
            return redirect()->to(site_url('parameters/expense-list'));
        }
        $this->data['action_url'] = 'parameters/expense-add';
        $this->data['typeExpensePartner']= $this->partner_id;
        $expenseID = $this->uri->getSegment(3);
        $response= $this->invokeApi('get','api/liste-type-expense-ticketing-request',['typeExpensePartner'=>$this->data['typeExpensePartner'] ,'typeExpenseId'=>$expenseID]);

        $this->data['expenseEdit'] = isset($response) && is_object($response) && $response->status=="00" ? (array)$response->response->typeExpense[0]:[];

        return view('parameters/expenses/form',$this->data);
    }

    
}