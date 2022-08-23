<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 13/07/2021
 * Time: 16:28
 */

namespace App\Controllers;


use App\Libraries\Api;

class Terminus extends BaseController
{
    private $api;

    public function __construct()
    {
        $this->api = new Api();
    }

    public function listing(){

        $this->view_data['termPartner'] = $this->partner_id;
        $response = $this->api->appel(['myApi' => 'invoke_get', 'url' => 'api/list-terminus-ticketing', 'params' => $this->view_data]);
        $this->view_data['terminus'] = $response->status === "00" ? (array)$response->response : [];
        $data['terminus'] = $this->view_data['terminus'];
        $data['action_url'] = 'parameters/terminus-add';

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $data['message'] = $flash_message;

        return view('parameters/terminus/liste', $data);
    }

    public function add() {
        if ($this->request->getMethod() == 'post') {

            $data = $this->request->getPost();
            $data["termPartner"] = (int)$this->partner_id;

            $response = $this->api->appel(['myApi' => 'invoke_post', 'url' => 'api/define-terminus-ticketing', 'params' => $data]);
            if (isset($response) && is_object($response) && $response->status == "00") :
                session()->setFlashdata('flash_message', alert('success', lang('Messages.success_save_terminus')));
                return redirect()->to(site_url('parameters/terminus-list'));
            else:
                session()->setFlashdata('flash_message', alert('danger', lang('Messages.warning_save_terminus')));
            endif;
        }
        return view('parameters/terminus/form', $this->view_data);
    }

    public function edit() {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'termId'=>'required',
                'termLibelle'=>['label'=>'label.libelle','rules'=>'trim|required'],
                'termLat'=>['label'=>'label.lat','rules'=>'trim'],
                'termLng'=>['label'=>'label.lng','rules'=>'trim']
            ];
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $data = $this->request->getPost();
                $data['termPartner'] = $this->partner_id;
                $response = $this->api->appel(['myApi' => 'invoke_post', 'url' => 'api/edition-terminus-ticketing', 'params' => $data]);
                if (isset($response) && is_object($response) && $response->status == "00")
                    $flash_message = alert('success',lang('Messages.success_edit_terminus'));
                else
                    $flash_message = alert('danger',lang('Messages.warning_edit_terminus'));
            }
            session()->setFlashdata('flash_message', $flash_message);
            return redirect()->to(site_url('parameters/terminus-list'));
        }
        $data['termPartner'] = $this->partner_id;
        $termID = $this->uri->getSegment(3);
        $response = $this->api->appel(['myApi' => 'invoke_get', 'url' => 'api/list-terminus-ticketing', 'params' => ['termPartner' => $data['termPartner'], 'termId' => $termID]]);
        $this->view_data['termEdit'] = isset($response) && is_object($response) && $response->status == "00" ? (array)$response->response->term[0] : [];
        return view('parameters/terminus/form', $this->view_data);
    }
}