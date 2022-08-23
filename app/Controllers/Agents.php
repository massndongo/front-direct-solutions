<?php

namespace App\Controllers;


use App\Libraries\Api;

class Agents extends BaseController
{
    public function __construct()
    {
        $identities = $this->invokeApi('get','api/list-identities',[]);
        $this->view_data['identities'] = $identities->status == "00" ? (array)$identities->response:[];
    }

    public function add(){
        if($this->request->getMethod() == "post"){
            $rules = [
                'first_name'=>['label'=>'Label.first_name','rules'=>'trim|required'],
                'last_name'=>['label'=>'Label.last_name','rules'=>'trim|required'],
                'phone_number'=>['label'=>'Label.mobile_number','rules'=>'trim|required'],
                'email'=>['label'=>'Label.email','rules'=>'trim'],
                'location'=>['label'=>'Label.location','rules'=>'trim|required'],
                'identity_type'=>['label'=>'Label.piece','rules'=>'trim|required'],
                'identity_number'=>['label'=>'Label.piece_number','rules'=>'trim|required'],
                'agent_type'=>['label'=>'Label.type','rules'=>'trim|required'],
            ];
            if(!$this->validate($rules)){
                $this->view_data['message'] = alert('warning',$this->validator->listErrors());
            }
            else{
                $data = $this->request->getPost();
                $data['merchant_id'] = $this->partner_id;
                $data['type'] = $this->partnerType;
                $data['indicatif'] = get_global_value('indicatif');
                $response = $this->invokeApi('post','api/define-agent-request',$data);
                if(isset($response) && is_object($response) && $response->status=="00"):
                    session()->setFlashdata('flash_message',alert('success',lang('Messages.success_save_agent')));
                    return redirect()->to(site_url('agents/agent-add'));
                else:
                    $this->view_data['message'] = alert('warning',lang('Messages.warning_save_agent'));
                endif;
            }
        }
        $this->view_data['action_url'] = 'agents/agent-add';
        $this->view_data['partnerType']= $this->partnerType;

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        $this->view_data['titlePage'] = lang('Aside.submenu_agent_add_comment');
        $this->view_data['subTitlePage'] = lang('Label.agent_add_title_comment');
        return view('agents/merchants/form',$this->view_data);
    }

    public function edit(){
        if($this->request->getMethod() == "post"){
            $rules = [
                'id'=>'required',
                'first_name'=>['label'=>'Label.first_name','rules'=>'trim|required'],
                'last_name'=>['label'=>'Label.last_name','rules'=>'trim|required'],
                'phone_number'=>['label'=>'Label.mobile_number','rules'=>'trim|required'],
                'email'=>['label'=>'Label.email','rules'=>'trim'],
                'location'=>['label'=>'Label.location','rules'=>'trim|required'],
                'identity_type'=>['label'=>'Label.piece','rules'=>'trim|required'],
                'identity_number'=>['label'=>'Label.piece_number','rules'=>'trim|required'],
                'agent_type'=>['label'=>'Label.type','rules'=>'trim|required'],
            ];
            if(!$this->validate($rules)){
                $this->view_data['message'] = alert('warning',$this->validator->listErrors());
                session()->setFlashdata('flash_message',alert('success',$this->validator->listErrors()));
                return redirect()->to(site_url('agents/agent-list'));
            }
            else{
                $data = $this->request->getPost();
                $data['merchant_id'] = $this->partner_id;
                $data['type'] = $this->partnerType;
                $data['indicatif'] = get_global_value('indicatif');
                $response = $this->invokeApi('post','api/edition-agent-request',$data);
                if(isset($response) && is_object($response) && $response->status=="00"):
                    session()->setFlashdata('flash_message',alert('success',lang('Messages.success_edit_agent')));
                    return redirect()->to(site_url('agents/agent-list'));
                else:
                    $this->view_data['message'] = alert('warning',lang('Messages.warning_edit_agent'));
                endif;
            }   
        }
        $this->view_data['action_url'] = 'agents/agent-edit';
        $this->view_data['partnerType']= $this->partnerType;

        $agentID = $this->uri->getSegment(3);
        $response= $this->invokeApi('get','api/details-agent-request',['id'=>$agentID]);
        if(isset($response) && $response->status =="00")
            $this->view_data['agent'] = (array)$response->agent;
        else{
            session()->setFlashdata('flash_message',alert('success',lang('Messages.invalid_edition_data_agent')));
            return redirect()->to(site_url('agents/agent-list'));
        }

        $this->view_data['titlePage'] = lang('Aside.submenu_agent_edit_comment');
        $this->view_data['subTitlePage'] = lang('Label.agent_edit_title_comment');

        return view('agents/merchants/form',$this->view_data);
    }

    public function listing(){
        clear_session_filter_data('filter-agent');
        if($this->request->getMethod() == "post"){
            $this->view_data = $this->request->getPost();
            session()->set('filter-agent',$this->view_data);
        }
        else{
            if($this->request->getGet('page_agent'))
                $this->view_data = session()->has('filter-agent') ? session()->get('filter-agent'):[];
            else $this->view_data= session()->has('filter-agent') ? session()->get('filter-agent'):[];
        }

        if($this->request->getGet('page_agent'))
            $this->view_data['agentOffset'] = $this->request->getGet('page_agent');
        else $this->view_data['agentOffset']= 0;

        $this->view_data['agentPartnerType'] = $this->partnerType;
        $this->view_data['agentPartner'] = $this->partner_id;
        $this->view_data['agentLimit'] = $this->perPage;

        $total = $this->invokeApi('get','api/total-agent-request',$this->view_data);
        $response = $this->invokeApi('get','api/list-agent-request',$this->view_data);
        $this->view_data['liste'] = $response->status === "00" ? (array)$response->response->agent:[];

        $this->view_data['pager'] = $this->pager;
        $this->view_data['pager'] = $this->pager->setPath(LINK_URL_PAGINATION.uri_string(),'agent');
        $this->view_data['paginate'] = ['page'=>$this->view_data['agentOffset'],'perPage'=>$this->view_data['agentLimit'],'template'=>'pagination','total'=>$total->response->total,'group'=>'agent'];

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        return view('agents/merchants/liste',$this->view_data);
    }

    public function redit(){
        if($this->request->getMethod() == "post"){
            $rules = [
                'id'=>'required',
                'first_name'=>['label'=>'Label.first_name','rules'=>'trim|required'],
                'last_name'=>['label'=>'Label.last_name','rules'=>'trim|required'],
                'phone_number'=>['label'=>'Label.mobile_number','rules'=>'trim|required'],
                'email'=>['label'=>'Label.email','rules'=>'trim'],
                'location'=>['label'=>'Label.location','rules'=>'trim|required'],
                'identity_type'=>['label'=>'Label.piece','rules'=>'trim|required'],
                'identity_number'=>['label'=>'Label.piece_number','rules'=>'trim|required'],
                'agent_type'=>['label'=>'Label.type','rules'=>'trim|required'],
                'changePwd'=>['label'=>'Label.type','rules'=>'trim'],
            ];
            if(!$this->validate($rules)){
                $this->view_data['message'] = alert('warning',$this->validator->listErrors());
                session()->setFlashdata('flash_message',alert('success',$this->validator->listErrors()));
                return redirect()->to(site_url('agents/agent-list'));
            }
            else{
                $data = $this->request->getPost();
                $data['merchant_id'] = $this->partner_id;
                $data['type'] = $this->partnerType;
                $data['indicatif'] = get_global_value('indicatif');
                $response = $this->invokeApi('post','api/edition-agent-request',$data);
                if(isset($response) && is_object($response) && $response->status=="00"):
                    session()->setFlashdata('flash_message',alert('success',lang('Messages.success_edit_password_agent')));
                    return redirect()->to(site_url('agents/agent-list'));
                else:
                    $this->view_data['message'] = alert('warning',lang('Messages.warning_edit_password_agent'));
                endif;
            }
        }
        $this->view_data['action_url'] = 'agents/agent-redit';

        $agentID = $this->uri->getSegment(3);
        $response= $this->invokeApi('get','api/details-agent-request',['id'=>$agentID]);
        if(isset($response) && $response->status =="00") {
            $this->view_data['tuple'] = $response->agent;
            $this->view_data['message'] = alert('danger', lang('Messages.reinitialisation_message', ['tuple' => $this->view_data['tuple']->first_name . ' ' . $this->view_data['tuple']->last_name]));
        }
        else{
            session()->setFlashdata('flash_message',alert('success',lang('Messages.invalid_edition_data_agent')));
            return redirect()->to(site_url('agents/agent-list'));
        }
        return view('agents/merchants/redit',$this->view_data);
    }
}