<?php

namespace App\Controllers;


class FilterController extends BaseController
{

    public function zone_by_line(){
        $result = ['status'=>false];
        if($this->request->getMethod() == "post"){
            $lineId = $this->request->getVar('lineId');
            $response = $this->invokeApi('get','api/list-lines-ticketing',['linePartner'=>$this->partner_id,'lineId'=>$lineId]);
            if(isset($response) && is_object($response) && $response->status === "00"){
                $ligne = $response->response->ligne[0];
                $result = ['status'=>true,'tuples'=>$ligne->lineZone];
            }
        }
        echo json_encode($result);
        return;
    }

    public function section_by_zone(){
        $result = ['status'=>false];
        if($this->request->getMethod() == "post"){
            $zoneId = $this->request->getVar('zoneId');
            $response = $this->invokeApi('get','api/list-zone-ticketing',['zonePartner'=>$this->partner_id,'zoneId'=>$zoneId]);
            if(isset($response) && is_object($response) && $response->status === "00"){
                $zone = $response->response->zone;
                $result = ['status'=>true,'tuples'=>$zone->zoneSection];
            }
        }
        echo json_encode($result);
        return;
    }
}