<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 21/06/2021
 * Time: 12:48
 */

namespace App\Controllers;
use App\Libraries\Api;

class Bus extends BaseController
{
    protected $view_data;
    private $api;

    public function __construct()
    {
        $this->view_data = [];

        $this->api = new Api();
        $identities = $this->api->appel(['myApi'=>'invoke_get','url'=>'api/list-identities','params'=>[]]);
        $this->view_data['identities'] = $identities->status == "00" ? (array)$identities->response:[];

    }

    public function listing(){

        if($this->request->getGet('page_bus'))
            $this->view_data['busOffset'] = $this->request->getGet('page_bus');
        else $this->view_data['busOffset']= 0;
        $this->view_data['busLimit']  = $this->perPage;
        $this->view_data['busPartner']= $this->partner_id;

        $response = $this->invokeApi('get','api/list-bus-ticketing',$this->view_data);

        $this->view_data['liste'] = isset($response) && is_object($response) && $response->status === "00" ?  $response->response->bus:[];

        $_total = $this->api->appel(['myApi'=>'invoke_get','url'=>'api/count-bus-ticketing','params'=>$this->view_data]);
        $total=1000;

        $this->view_data['busPartner'] = $this->partner_id;
        $_bus = $this->api->appel(['myApi'=>'invoke_get','url'=>'api/list-bus-ticketing','params'=>$this->view_data]);
        $this->view_data['bus'] = isset($_bus) && is_object($_bus) && $_bus->status=="00" ? $_bus->response->bus:[];
        $this->view_data['pager'] = $this->pager;
        $this->view_data['pager'] = $this->pager->setPath(LINK_URL_PAGINATION.uri_string(),'bus');
        $this->view_data['paginate'] = ['page'=>$this->view_data['busOffset'],'perPage'=>$this->view_data['busLimit'],'template'=>'pagination','total'=>$total,'group'=>'bus'];

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        return view('parameters/bus/liste',$this->view_data);
    }

    //Fonction pour ajouter un nouveau bus

    public function add(){
        if($this->request->getMethod() == "post"){
            $rules = [
                'busBrand'=>['label'=>'Label.brand','rules'=>'trim'],
                'busModel'=>['label'=>'Label.model','rules'=>'trim'],
                'busRegistrationNumber'=>['label'=>'Label.registration_number','rules'=>'trim|required'],
                'busColor'=>['label'=>'Label.bus_color','rules'=>'trim']
            ];
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $data = $this->request->getPost();
                $data['busPartner'] = $this->partner_id;

                $response = $this->invokeApi('post','api/define-bus-ticketing',$data);

                if (isset($response) && is_object($response) && $response->status == "00" )
                    $flash_message = alert('success', lang('Messages.success_create_bus'));
                else $flash_message= alert('warning', lang('Messages.warning_save_bus'));

             /*   $response = $this->api->appel(['myApi'=>'invoke_post','url'=>'api/define-bus-ticketing','params'=>$data]);
                if(isset($response) && is_object($response) && $response->status=="00")
                    $flash_message = alert('success',lang('Messages.success_create_bus'));
                else $flash_message= alert('warning',lang('Messages.warning_save_bus'));*/

            }

            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('parameters/bus-list'));
        }

        return view('parameters/bus/form',$this->view_data);
    }

    //Fonction pour modifier les infos d'un bus
    public function edit(){
        if($this->request->getMethod() == "post"){

            $rules = [
                'busId'=>'required',
                'busBrand'=>['label'=>'Label.brand','rules'=>'trim'],
                'busModel'=>['label'=>'Label.model','rules'=>'trim'],
                'busRegistrationNumber'=>['label'=>'Label.registration_number','rules'=>'trim|required'],
                'busColor'=>['label'=>'Label.bus_color','rules'=>'trim']
            ];
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $data = $this->request->getPost();
                $data['busPartner'] = $this->partner_id;

                $response = $this->invokeApi('post','api/edition-bus-ticketing',$data);

                if (isset($response) && is_object($response) && $response->status == "00" )
                    $flash_message = alert('success', lang('Messages.success_create_bus'));
                else $flash_message= alert('warning', lang('Messages.warning_save_bus'));

               /* $response = $this->api->appel(['myApi'=>'invoke_post','url'=>'api/edition-bus-ticketing','params'=>$data]);
                if(isset($response) && is_object($response) && $response->status=="00")
                    $flash_message = alert('success',lang('Messages.success_edit_bus'));
                else $flash_message= alert('warning',lang('Messages.warning_edit_bus'));*/

            }

            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('parameters/bus-list'));
        }

        $busId = $this->uri->getSegment(3);
        $response = $this->invokeApi('get','api/list-bus-ticketing',['busPartner'=>$this->partner_id,'busId'=>$busId]);
        $this->view_data['bus'] = isset($response) && is_object($response) && $response->status=="00" ? (array)$response->response->bus[0]:[];

      /*  $busID = $this->uri->getSegment(3);
        $_bus = $this->api->appel(['myApi'=>'invoke_get','url'=>'api/list-bus-ticketing','params'=>['busId'=>$busID,'busPartner'=>$this->partner_id]]);
        $this->view_data['busData'] = isset($_bus) && is_object($_bus) && $_bus->status=="00" ? (array)$_bus->response->bus[0]:[];*/

        return view('parameters/bus/form',$this->view_data);
    }
    
}