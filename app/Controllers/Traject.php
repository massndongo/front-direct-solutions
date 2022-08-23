<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 21/06/2021
 * Time: 12:51
 */

namespace App\Controllers;


use App\Libraries\Api;

class Traject extends BaseController
{
    public function listing(){

        /* Get current route */
        $response = $this->invokeApi('get','api/list-route-ticketing',['trajetPartner'=>$this->partner_id]);
        $this->view_data['trajet'] = $response->status === "00" ? (array)$response->response:['trajet'];

        /* Get all zone  */
        $zone_result = $this->invokeApi('get','api/list-zone-ticketing',['zonePartner'=>$this->partner_id]);

        $this->view_data['zone'] = ($zone_result->status === "00") ? (array)$zone_result->response : [];

        return view('parameters/trajets/liste', $this->view_data);
    }

    public function add() {

        if($this->request->getMethod() == 'post') {
            $data = [
                'trajetStart' => $this->request->getPost('trajetStart'),
                'trajetEnd' => $this->request->getPost('trajetEnd'),
                'trajetZone' => $this->request->getPost('zone')
            ];

            $data['trajetPartner'] = $this->partner_id;

            $response = $this->invokeApi('post','api/define-route-ticketing',$data);
            if (isset($response) && is_object($response) && $response->status == "00") :
                session()->setFlashdata('flash_message', alert('success', lang('Messages.success_save_zone')));
                return redirect()->to(site_url('parameters/trajet-list'));
            else:
                $this->view_data['message'] = alert('warning', lang('Messages.warning_save_zone'));
            endif;
        }
    }
}