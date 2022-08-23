<?php

namespace App\Validation;


use App\Libraries\Api;

class LoginRules
{
    public function validateLogin(string $str,string $field,array $data){
        $api = new Api();
        $args = [
            'myApi'=>'invoke_post',
            'url'=>'api/authenticate-request',
            'params'=>[
                'username'=>$data['username'],
                'password'=>$data['password'],
                'langue'=>substr($data['change_langue'],-2,2)
            ]
        ];
        $_response = $api->appel($args);
        //debug_data($_response);
        if(isset($_response) && is_object($_response) && isset($_response->status) && $_response->status === "00"){
            $response = (array)$_response->user;
            $_recodedUserData = [
                'token'=>$response['token'],
                'userID'=>$response['id'],
                'username'=>$response['username'],
                'profileID'=>$response['profile_id'],
                'lang'=>substr($data['change_langue'],-2,2),
                'userType'=>$response['user_type'],
                'isLogIn'=>true
            ];
            session()->set($_recodedUserData);
            return true;
        }
        return false;
    }

    public function validateOldPassword(string $str,string $field,array $data){
        $userData = session()->get('userData');
        $boolean = true;
        if(isset($userData) && is_object($userData) && isset($userData->local_secret)) {
            if (isset($data['oldPassword']) && !empty($data['oldPassword'])) {
                if (sha1($data['oldPassword']) !== $userData->local_secret)
                    $boolean = false;
            }
        }
        else $boolean = false;

        return $boolean;
    }

    public function validateCompense(string $str,string $field,array $data){
        $balance = current_balance();
        $tab = explode(",",$balance);
        $solde = str_replace(" ",'',$tab[0]);
        $boolean = true;
        if((float)$data['montant']<0)
            $boolean = false;
        elseif((float)$data['montant']>(float)$solde)
            $boolean = false;

        return $boolean;
    }

}