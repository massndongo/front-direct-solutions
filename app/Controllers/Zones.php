<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 21/06/2021
 * Time: 12:51
 */

namespace App\Controllers;


use App\Libraries\Api;
use phpDocumentor\Reflection\Types\This;

class Zones extends BaseController
{

    private $api;

    public function __construct()
    {
        $this->api = new Api();
    }

    public function listing(){

        $this->view_data['zonePartner'] = $this->partner_id;
        $response = $this->invokeApi('get', 'api/list-zone-ticketing', ['zonePartner'=>$this->partner_id]);
        $this->view_data['zone'] = $response->status === "00" ? (array)$response->response : [];
        $data['zone'] = $this->view_data['zone'];

        /* Get all section */
        $section_result = $this->invokeApi('get', 'api/list-section-ticketing', ['sectionPartner'=>$this->partner_id]);
        $this->view_data['section'] = ($section_result->status === "00") ? (array)$section_result->response : [];
        $data['section'] = $this->view_data['section'];
        $data['action_url'] = 'parameters/zone-add';

        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $data['message'] = $flash_message;

        return view('parameters/zones/liste', $data);
    }

    public function add() {

        if($this->request->getMethod() == 'post') {

            $rules = [
                'zoneLabel'=>['label'=>'Label.label','rules'=>'trim|required'],
                'zoneStart'=>['label'=>'Label.start','rules'=>'trim'],
                'zoneEnd'=>['label'=>'Label.end','rules'=>'trim'],
                'zoneSection'=>['label'=>'Label.section','rules'=>'required']
            ];
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
            $data = $this->request->getPost();
            /* Modifier la clé d'un tableau */
            $data['zoneSection'] = $data['zoneSections'];
            unset($data['zoneSections']);
            /* Modifier la clé d'un tableau */
            $data['zonePartner'] = $this->partner_id;

            $response = $this->invokeApi('post', 'api/define-zone-ticketing', $data);
            if (isset($response) && is_object($response) && $response->status == "00") :
                $flash_message = alert('success', lang('Messages.success_save_zone'));
            else:
                $flash_message = alert('warning', lang('Messages.warning_save_zone'));
            endif;
            }
            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('parameters/zone-list'));
        }
        /* Get all section */
        $section_result = $this->invokeApi('get', 'api/list-section-ticketing', ['sectionPartner'=>$this->partner_id]);
        $this->view_data['section'] = $section_result->status === "00" ? $section_result->response->section : [];

        return view('parameters/zones/form',$this->view_data);
    }

    public function edit()
    {
        if ($this->request->getMethod() == "post") {

            $rules = [
                'zoneId'=>'required',
                'zoneLabel'=>['label'=>'Label.label','rules'=>'trim|required'],
                'zoneStart'=>['label'=>'Label.start','rules'=>'trim'],
                'zoneEnd'=>['label'=>'Label.end','rules'=>'trim'],
                'zoneSection'=>['label'=>'Label.section','rules'=>'required']
            ];
            if(!$this->validate($rules))
                $flash_message = alert('warning',$this->validator->listErrors());
            else{
                $data = [
                    'zoneId' => $this->request->getPost('zoneId'),
                    'zoneLabel' => $this->request->getPost('zoneLabel'),
                    'zoneStart' => $this->request->getPost('zoneStart'),
                    'zoneEnd' => $this->request->getPost('zoneEnd'),
                ];
                if ($this->request->getPost('zoneSections') === null) {
                    $zoneSection = $this->request->getPost('zoneSection');
                }elseif ($this->request->getPost('zoneSection') === null) {
                    $zoneSection = $this->request->getPost('zoneSections');
                }else {
                    // Fusionner 2 tableaux en éliminant les doublons
                    $zoneSection = array_unique(array_merge($this->request->getPost('zoneSection'),$this->request->getPost('zoneSections')), SORT_REGULAR);
                    // Fusionner 2 tableaux en éliminant les doublons
                }
                $data['zoneSection'] = $zoneSection;
                $data['zonePartner'] = $this->partner_id;

                $response = $this->invokeApi('post', 'api/edition-zone-ticketing', $data);
                if (isset($response) && is_object($response) && $response->status == "00") :
                    $flash_message = alert('success', lang('Messages.success_edition_zone'));
                else:
                    $flash_message = alert('warning', lang('Messages.warning_edition_zone'));
                endif;
            }
            session()->setFlashdata('flash_message',$flash_message);
            return redirect()->to(site_url('parameters/zone-list'));
        }

        $zoneID = $this->uri->getSegment(3);
        $response = $this->invokeApi('get', 'api/list-zone-ticketing', ['zonePartner'=>$this->partner_id,'zoneId'=>$zoneID]);
        $this->view_data['zone'] = isset($response) && is_object($response) && $response->status =="00" ? $response->response->zone:[];

        /* Get all section */
        $section_result = $this->invokeApi('get', 'api/list-section-ticketing', ['sectionPartner'=>$this->partner_id]);
        $this->view_data['section'] = isset($section_result) && is_object($section_result) && $section_result->status === "00" ? $section_result->response->section : [];

        return view('parameters/zones/form', $this->view_data);

    }
}