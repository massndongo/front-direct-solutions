<?php

namespace App\Controllers;


class ApproCompense extends BaseController
{
    protected $view_data;

    public function __construct()
    {

        $this->view_data = [];
    }

    public function liste(){
        $tDate = gmdate('d/m/Y');

        if($this->request->getMethod() == "post"){
            $search = $this->request->getPost();
        }
        else{
            if($this->request->getGet('page_appro'))
                $search = session()->has('filter-appro-compense') ? session()->get('filter-appro-compense'):array('start'=>$tDate,'end'=>$tDate);
            else $search= array('start'=>$tDate,'end'=>$tDate);
        }
        session()->set('filter-appro-compense',$search);
        $response = $this->invokeApi('post', 'api/appro-compense-request', $search);
        $this->view_data['liste'] = isset($response) && is_object($response) && isset($response->status) && $response->status==="00" ? $response->liste:array();
        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;
        $this->view_data = array_merge($this->view_data,$search);

        return view('appro-compense/liste',$this->view_data);
    }

    public function approviser(){
        if($this->request->getMethod() == "post"){
            $rules = array(
                'reference'=>array('label'=>'Référence du dépôt','rules'=>'trim|required'),
                'date'=>array('label'=>'Date du dépôt','rules'=>'trim|required'),
                'bank'=>array('label'=>'Banque du dépôt','rules'=>'trim|required'),
                'montant'=>array('label'=>'Montant du dépôt','rules'=>'trim|required')
            );
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $data = $this->request->getPost();
                $data['user_at'] = session()->get('userID');
                $userData = session()->get('userData');
                $data['partner_id'] = $userData->partner_id;
                $data['partner_type']=$userData->partner_type;
                $response = $this->invokeApi('post', 'api/appro-request', $data);
                if (isset($response) && is_object($response) && $response->status == "00")
                    $flash_message=alert('success',"Demande d'approvisionnement initié avec succès");
                else
                    $flash_message=alert('warning',"Echec initiation demande d'approvisionnement");
            }
            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('approvisionnent-compensation'));
        }
        $view_data['typeView'] = "APPRO";
        $view_data['titleForm']= "Formulaire de demande d'approvisionnement";
        $banks = $this->invokeApi('get', 'api/get-bank-request', []);
        if(isset($banks) && is_object($banks) && isset($banks->status) && $banks->status==="00")
            $view_data['banks'] = $banks->banks;
        return view('appro-compense/form',$view_data);
    }

    public function compenser(){
        if($this->request->getMethod() == "post"){
            $rules = array(
                'montant'=>array(
                    'label'=>'Montant de la compensation','rules'=>'trim|required|validateCompense[montant]'
                )
            );
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $data = $this->request->getPost();
                $data['user_at'] = session()->get('userID');
                $userData = session()->get('userData');
                $data['partner_id'] = $userData->partner_id;
                $data['partner_type']=$userData->partner_type;
                $response = $this->invokeApi('post', 'api/compense-request', $data);
                if (isset($response) && is_object($response) && $response->status == "00")
                    $flash_message=alert('success',"Demande de compensation initiée avec succès");
                else
                    $flash_message=alert('warning',"Echec initiation demande de compensation");
            }
            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('approvisionnent-compensation'));
        }
        $view_data['typeView'] = "COMPENSE";
        $view_data['titleForm']= "Formulaire de demande de compensation";
        return view('appro-compense/form',$view_data);
    }
}