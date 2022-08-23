<?php

namespace App\Controllers;

use App\Libraries\Api;

class Profiles extends BaseController
{
    protected $api;

    private function asOptionMenu($grpMenu,$options){
        $boolean = false;
        foreach($options as $item){
            if((int)$grpMenu===(int)$item->menu_id){
                $boolean = true;
                break;
            }
        }
        return $boolean;
    }
    private function formatNestableList($grpMenu,$menus,$profile_id =0,$profileAccess=[]){
        $response = [];
        foreach($grpMenu as $item){
            $response[$item->id]['libelle'] = lang('Aside.'.$item->comment);
            if(isset($menus['pMenu']) && is_array($menus['pMenu']) && count($menus['pMenu'])>0):
                foreach($menus['pMenu'] as $line){
                    if((int)$line->menu_id===(int)$item->id){
                        $response[$item->id]['data'][] = ['id'=>$line->id,'parent'=>$line->linkParent,'text'=>lang('Aside.'.$line->comment),'icon'=>false,'state'=>['selected'=>$profile_id>0 ? in_array($line->id,$profileAccess):false]];
                    }
                }
            endif;
            if(isset($menus['oMenu']) && is_array($menus['oMenu']) && count($menus['oMenu'])>0 && $this->asOptionMenu($item->id,$menus['oMenu'])):
                $response[$item->id]['data'][] = ['id'=>$item->id,'parent'=>'#','text'=>lang('Aside.option_menu'),'icon'=>false,'state'=>['opened'=>true]];
                foreach($menus['oMenu'] as $line){
                    if((int)$line->menu_id===(int)$item->id){
                        $response[$item->id]['data'][] = ['id'=>$line->id,'parent'=>$item->id,'text'=>lang('Aside.'.$line->comment),'icon'=>false,'state'=>['selected'=>$profile_id>0 ? in_array($line->id,$profileAccess):false]];
                    }
                }
            endif;
        }
        return $response;
    }
    private function getAside($profile_id=0,$profileAccess=[]){
        $grpMenu = $this->invokeApi('get','api/group-side-request',['partner_type'=>'T']);
        $pMenu   = $this->invokeApi('get','api/side-view-request',['partner_type'=>'T']);
        $oMenu   = $this->invokeApi('get','api/side-action-request',['partner_type'=>'T']);
        return $this->formatNestableList(($grpMenu->status==="00" ? $grpMenu->menus:[]),['pMenu'=>($pMenu->status==="00" ? $pMenu->menus:[]),'oMenu'=>($oMenu->status==="00" ? $oMenu->options:[])],$profile_id,$profileAccess);
    }
    public function add(){
        if($this->request->getMethod() == "post"){
            $rules = [
                'profile_name'=>['label'=>'Label.profile_name','rules'=>'trim|required'],
                'privileges'=>['label'=>'Label.privilege_list','rules'=>'trim|required']
            ];
            if(!$this->validate($rules))
                $this->view_data['message'] = alert('warning',$this->validator->listErrors());
            else{
                $data = $this->request->getPost();
                $data['type'] = $this->partnerType === "MT" ? "T":"M";
                $data['partner_id'] = $this->partner_id;
                $response = $this->invokeApi('post','api/define-profile-request',$data);
                if(isset($response) && is_object($response) && $response->status === "00"){
                    session()->setFlashdata('flash_message',alert('success',lang("Messages.success_save_define_profile")));
                    return redirect()->to(site_url(uri_string()));
                }
                else $this->view_data['message'] = alert('warning',$response->message);
            }
        }
        $this->view_data['nestableList'] = $this->getAside();
        $this->view_data['action_url'] = uri_string();

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        return view('profiles/merchants/form',$this->view_data);
    }
    public function edit(){
        if($this->request->getMethod() == "post"){
            $rules = [
                'profile_id'=>'required',
                'profile_name'=>['label'=>'Label.profile_name','rules'=>'trim|required'],
                'privileges'=>['label'=>'Label.privilege_list','rules'=>'trim|required']
            ];
            if(!$this->validate($rules)) {
                session()->setFlashdata('flash_message', alert('warning', $this->validator->listErrors()));
                return redirect()->to(site_url('profiles/profile-list'));
            }
            else{
                $data = $this->request->getPost();
                $data['type'] = $this->partnerType === "MT" ? "T":"M";
                $data['partner_id'] = $this->partner_id;
                $response = $this->invokeApi('post','api/edition-profile-request',$data);
                if(isset($response) && is_object($response) && $response->status === "00"){
                    session()->setFlashdata('flash_message',alert('success',lang("Messages.success_save_define_profile")));
                    return redirect()->to(site_url('profiles/profile-list'));
                }
                else{
                    session()->setFlashdata('flash_message', alert('warning', $response->message));
                    return redirect()->to(site_url('profiles/profile-list'));
                }
            }
        }
        $this->view_data['profile'] = $this->uri->getSegment(3);
        $this->view_data['nestableList'] = $this->getAside();
        $this->view_data['action_url'] = "profiles/profile-edit";
        $aDroits=$this->invokeApi('get','api/access-rights-request',['profile_id'=>$this->view_data['profile']]);
        $this->view_data['nestableList'] = $this->getAside($this->view_data['profile'],$aDroits->response);
        $profil = $this->invokeApi('get','api/get-profile-request',['profile_id'=>$this->view_data['profile']]);
        $this->view_data['profile_name'] = $profil->response->label;

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        return view('profiles/merchants/form',$this->view_data);
    }
    public function listing(){

        $args = [
            'myApi'=>'invoke_get','url'=>'api/list-profile-request',
            'params'=>[
                'partner_id'=>$this->partner_id,
                'partner_type'=>($this->partnerType === "MT" ? 'T':'M'),
                'limit'=>$this->perPage,
            ]
        ];

        if($this->request->getGet('page_profile'))
            $args['params']['offset'] = $this->request->getGet('page_profile');
        else $args['params']['offset']= 0;
        $this->view_data['limit'] = $this->perPage;
        $this->view_data['offset'] = $args['params']['offset'];

        $response = $this->invokeApi('get',$args['url'],$args['params']);
        $this->view_data['liste'] = $response->status=="00"  ? (array)$response->response:[];
        $total = $this->invokeApi('get','api/total-profile-request',$args['params']);

        $this->view_data['pager'] = $this->pager;
        $this->view_data['pager'] = $this->pager->setPath(LINK_URL_PAGINATION.uri_string(),'profile');
        $this->view_data['paginate'] = ['page'=>$this->view_data['offset'],'perPage'=>$this->view_data['limit'],'template'=>'pagination','total'=>$total->response,'group'=>'profile'];

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        return view('profiles/merchants/liste',$this->view_data);
    }

    /* ====================== Compte UTILISATEURS ============================ */
    public function compte_add(){
        if($this->request->getMethod() == "post"){
            $rules = [
                'profile_id'=>['label'=>'Label.profile','rules'=>'trim|required'],
                'agent_id'=>['label'=>'Label.agent','rules'=>'trim|required']
            ];
            if(!$this->validate($rules)){
                session()->setFlashdata('flash_message', alert('warning', $this->validator->listErrors()));
                return redirect()->to(site_url('profiles/profile-compte-user'));
            }
            else{
                $data = $this->request->getPost();
                $_agent = explode('_',$data['agent_id']);
                $data['agent_id'] = $_agent[0];
                $data['email'] = $_agent[1];
                $data['partner_id'] = $this->partner_id;
                $data['user_type'] = $this->partnerType === "MT" ? 'T':'M';
                $data['partnerType'] = $this->partnerType;
                $response = $this->invokeApi('post','api/profil-link-user-request',$data);
                if(isset($response) && is_object($response) && $response->status=="00")
                    $flash_message = alert('success',lang('Messages.success_create_compte_user'));
                else $flash_message= alert('warning',lang('Messages.warning_create_compte_user'));

                session()->setFlashdata('flash_message', $flash_message);
                return redirect()->to(site_url('profiles/profile-compte-user'));
            }
        }
        $profilList = $this->invokeApi('get','api/profil-list-by-partner-request',['partner_id'=>$this->partner_id,'partnerType'=>($this->partnerType==="MT" ? 'T':'M')]);
        $userList   = $this->invokeApi('get','api/agent-list-by-partner-request',['partner_id'=>$this->partner_id,'partnerType'=>$this->partnerType]);

        $this->view_data['profilList'] = isset($profilList) && is_object($profilList) && $profilList->status==="00" ? (array)$profilList->response:[];
        $this->view_data['userList']   = isset($userList) && is_object($userList) && $userList->status==="00" ? (array)$userList->response:[];

        return view('profiles/merchants/modal-view/compte_form',$this->view_data);
    }
    public function compte_edit(){
        if($this->request->getMethod() == "post"){
            $rules = [
                'profile_id'=>['label'=>'Label.profile','rules'=>'trim|required'],
                'agent_id'=>['label'=>'Label.agent','rules'=>'trim|required'],
                'status'=>['label'=>'Label.status','rules'=>'trim'],
                'change_pwd'=>['label'=>'Label.change_pwd','rules'=>'trim'],
                'id'=>'required'
            ];
            if(!$this->validate($rules)){
                session()->setFlashdata('flash_message', alert('warning', $this->validator->listErrors()));
                return redirect()->to(site_url('profiles/profile-compte-user'));
            }
            else{
                $data = $this->request->getPost();
                $_agent = explode('_',$data['agent_id']);
                $data['agent_id'] = $_agent[0];
                $data['email'] = $_agent[1];
                $data['partner_id'] = $this->partner_id;
                $data['user_type'] = $this->partnerType === "MT" ? 'T':'M';
                $data['partnerType'] = $this->partnerType;
                $response = $this->invokeApi('post','api/profil-link-user-edit-request',$data);
                if(isset($response) && is_object($response) && $response->status=="00")
                    $flash_message = alert('success',lang('Messages.success_edit_compte_user'));
                else $flash_message= alert('warning',lang('Messages.warning_edit_compte_user'));

                session()->setFlashdata('flash_message', $flash_message);
                return redirect()->to(site_url('profiles/profile-compte-user'));
            }
        }
        $profilList = $this->invokeApi('get','api/profil-list-by-partner-request',['partner_id'=>$this->partner_id,'partnerType'=>($this->partnerType==="MT" ? 'T':'M')]);
        $userList   = $this->invokeApi('get','api/agent-list-by-partner-request',['partner_id'=>$this->partner_id,'partnerType'=>$this->partnerType]);
        $userID = $this->uri->getSegment(3);
        $_linkUser  = $this->invokeApi('get','api/agent-compte-user-request',['id'=>$userID]);
        if(isset($_linkUser) && is_object($_linkUser) && $_linkUser->status=="00")
            $this->view_data['linkUser'] = (array)$_linkUser->user;
        $this->view_data['profilList'] = isset($profilList) && is_object($profilList) && $profilList->status==="00" ? (array)$profilList->response:[];
        $this->view_data['userList']   = isset($userList) && is_object($userList) && $userList->status==="00" ? (array)$userList->response:[];

        return view('profiles/merchants/modal-view/compte_form',$this->view_data);
    }
    public function comptes(){
        clear_session_filter_data('filter-profile-compte');
        if($this->request->getMethod() == "post"){
            $this->view_data = $this->request->getPost();
            session()->set('filter-profile-compte',$this->view_data);
        }
        else{
            if($this->request->getGet('page_compte'))
                $this->view_data = session()->has('filter-profile-compte') ? session()->get('filter-profile-compte'):[];
            else $this->view_data= session()->has('filter-profile-compte') ? session()->get('filter-profile-compte'):[];
        }
        if($this->request->getGet('page_compte'))
            $this->view_data['offset'] = $this->request->getGet('page_compte');
        else $this->view_data['offset']= 0;

        $this->view_data['limit'] = $this->perPage;
        $this->view_data['partnerType'] = $this->partnerType;
        $this->view_data['partner_id'] = $this->partner_id;

        $response = $this->invokeApi('get','api/compte-user-define-request',$this->view_data);
        $this->view_data['liste'] = $response->status=="00"  ? (array)$response->response:[];
        $_total = $this->invokeApi('get','api/compte-user-total-request',$this->view_data);
        $total = isset($_total) && $_total->status == "00" ? $_total->response:0;

        $this->view_data['pager'] = $this->pager;
        $this->view_data['pager'] = $this->pager->setPath(LINK_URL_PAGINATION.uri_string(),'compte');
        $this->view_data['paginate'] = ['page'=>$this->view_data['offset'],'perPage'=>$this->view_data['limit'],'template'=>'pagination','total'=>$total,'group'=>'compte'];
        $profilList = $this->invokeApi('get','api/profil-list-by-partner-request',['partner_id'=>$this->partner_id,'partnerType'=>($this->partnerType==="MT" ? 'T':'M')]);
        $this->view_data['profilList'] = isset($profilList) && is_object($profilList) && $profilList->status==="00" ? (array)$profilList->response:[];

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        return view('profiles/merchants/compte_list',$this->view_data);
    }
}