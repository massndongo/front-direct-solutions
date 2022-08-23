<?php

use App\Libraries\Api;

if(!function_exists('alert')){
    function alert($type,$message){
        $response = '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">';
        $response.= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        $response.= $message;
        $response.= '</div>';
        return $response;
    }
}
if(!function_exists('showMessage')){
    function showMessage($type,$message){
        $response = "<div class='text-center alert alert-".$type." alert-dismissible fade show' role='alert'>";
        $response.= "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        $response.= lang($message);
        $response.= "</div>";
        return $response;
    }
}
if(!function_exists('debug_data')){
    function debug_data($data, $json = false){
        if (!$json) {
            echo "<pre>";
            var_dump($data);
        }else{
            echo json_encode($data);
        }
        die;

    }
}
if(!function_exists('currentUrl')){
    function currentUrl($url){
        $response = '';
        $_url = explode('/',$url);
        $response.= isset($_url[0]) ? $_url[0].'/':'';
        $response.= isset($_url[1]) ? $_url[1]:'';
        return $response;
    }
}
if(!function_exists('clear_session_filter_data')){
    function clear_session_filter_data($key=''){
        $list = ['filter-agent','filter-profile-compte','filter-session-trajet','filter-collect','filter-collect-expense','transaction-filter','operation-filter'];
        $list=array_values(array_diff($list,array($key)));
        session()->remove($list);
    }
}
if(!function_exists('get_global_value')){
    function get_global_value($key){
        $userData = session()->has('userData') ? session()->get('userData'):null;
        $_list = [];
        if(isset($userData) && !is_null($userData)){
            $_list['fullname'] = strtoupper(substr($userData->first_name,0,1)).'. '.$userData->last_name;
            $_list['partnerName']= (!empty($userData->acronyme) ? $userData->acronyme:$userData->raison_social);
            $_list['acronyme'] = (!empty($userData->acronyme)) ? $userData->acronyme:lang('Messages.logo_partner');
            $_list['logo']= !empty($userData->personalization->logo) ? env('LOGO_URL') . '/'.$userData->personalization->logo:'#';
            $_list['headerColor']= !empty($userData->personalization->header) ? $userData->personalization->header:'';
            $_list['iconColor']= !empty($userData->personalization->icon) ? $userData->personalization->icon:'';
            /*$_list['left_side']= !empty($userData->personalization->left_side) ? $userData->personalization->left_side:'';*/
            $_list['icon']= !empty($userData->personalization->left_side) ? 'style="color:'.$userData->personalization->icon.'"':'';
            $_list['indicatif'] = isset($userData->indicatif) ? $userData->indicatif:'';
        }
        return array_key_exists($key,$_list) ? $_list[$key]:'';
    }
}
if(!function_exists('agentMerchantType')){
    function agentMerchantType($type='MT'){
        $response = [];
        if($type === "MT")
            $response = ['T'=>lang('Values.T_agent'),'S'=>lang('Values.S_agent'),'C'=>lang('Values.C_agent'),'R'=>lang('Values.R_agent')];
        if($type === "MS")
            $response = [];
        return $response;
    }
}
if(!function_exists('getAgentMerchantType')){
    function getAgentMerchantType($type,$code){
        $list = agentMerchantType($type);
        return $list[$code];
    }
}
if(!function_exists('getPiece')){
    function getPiece($code){
        $list = ['PP'=>lang('Values.pp_label'),'CI'=>lang('Values.ci_label'),'PC'=>lang('Values.pc_label'),'CC'=>lang('Values.cc_label'),'AU'=>lang('Values.au_label')];
        return $list[$code];
    }
}
if(!function_exists('get_statut_session')){
    function get_statut_session($code=""){
        $list = ['0'=>lang('Values.0'),'1'=>lang('Values.1')];
        return array_key_exists($code,$list) ? $list[$code]:$list;
    } 
}
if(!function_exists('isSelected')){
    function isSelected($field,$liste,$value){
        $_isSelected = '';
        foreach($liste as $item){
            if($item->{$field} == $value){
                $_isSelected = 'selected';
                break;
            }
        }
        return $_isSelected;
    }
}

if(!function_exists('expiration_session')){
    function expiration_session(){
		$list = ['userData','menus','privileges','options','isLogIn'];
        session()->remove($list);
    }
}

if(!function_exists('payment_method')){
    function payment_method($key){
        //echo $key;die;
        $list = array(
            "SN_AIRTIME_ORANGE"=>"Crédit téléphonique Orange",
            "SN_AIRTIME_FREE"=>"Crédit téléphonique Free",
            "SN_AIRTIME_EXPRESSO"=>"Crédit téléphonique Expresso",
            "SN_AIRTIME_PROMOBILE"=>"Crédit téléphonique ProMobile",
            "SN_CASHIN_OM"=>"Dépôt WALLET Orange Money",
            "SN_CASHOUT_OM"=>"Retrait WALLET Orange Money",
            "SN_PM_OM"=>"PM WALLET Orange Money",
            "SN_CASHIN_FREE_MONEY"=>"Dépôt WALLET Free Money",
            "SN_CASHOUT_FREE_MONEY"=>"Retrait WALLET Free Money",
            "SN_PM_FREE_MONEY"=>"PM WALLET Free Money",
            "SN_CASHIN_EMONEY"=>"Dépôt WALLET E-Money",
            "SN_CASHOUT_EMONEY"=>"Retrait WALLET E-Money",
            "SN_PM_EMONEY"=>"PM WALLET E-Money",
            "SN_PM_WIZALL"=>"PM WALLET WIZALL",
            "SN_PM_WAVE"=>"PM WALLET WAVE",
            "BANK_PAYMENT"=>"Paiement Bancaire"
            );

        return isset($list[$key]) ? $list[$key] : $key;
    }
}

if(!function_exists('payment_status')){
    function payment_status($key){
        $list = array(
            "P"=>lang("Label.pending") . '-warning',
            "S"=>lang("Label.paid") . '-success',
            "F"=>lang("Label.failed") . '-danger',
            );
        return isset($list[$key]) ? $list[$key] : $key;
    }
}

/* Get merchant current balance */
if (!function_exists('current_balance')){
    function current_balance(){
        $balance = 0;
        $api = new Api();
        $response = $api->appel(['myApi'=>'invoke_get', 'url'=>'api/get-solde-request', 'params'=>'']);
        //debug_data( $response, true);
		if(isset($response) && is_object($response) && $response->status=="00"){
            $balance = amount_format($response->solde, 2);
        }
        return $balance;
    }
}

if (!function_exists('amount_format')){
    function amount_format($amount, $decimal = 0){
        return number_format($amount, $decimal, ",", " ");
    }
}

//4 pour Visa, un 5 pour Mastercard et 3 pour American Express
if(!function_exists('card_type')) {
    function card_type($key)
    {
        $list = array(
            3 => 'AMERICAN_EXPRESS',
            4 => 'VISA',
            5 => 'MASTERCARD');

        return isset($list[$key]) ? $list[$key] : "";
    }
}

if(!function_exists('reverse_payment_method')){
    function reverse_payment_method($key){
        $list = array(
            "ORANGE MONEY"=>"SN_CASHIN_OM"
        );
        return isset($list[$key]) ? $list[$key] : $key;
    }
}

if(!function_exists('payment_status_2')){
    function payment_status_2($key){
        $list = array(
            "PENDING"=>'warning',
            "INITIATED"=> 'info',
            "FINISHED"=> 'success',
        );
        return isset($list[$key]) ? $list[$key] : $key;
    }
}
