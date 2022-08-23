<?php

namespace App\Controllers;


use App\Libraries\Api;

class Home extends BaseController
{

	public function index()
	{
		$flash_message = session()->getFlashdata('flash_message');
		if(isset($flash_message) && !empty($flash_message))
			$this->view_data['message'] = $flash_message;

		if(!session()->has('lang'))
			session()->set('lang', service('request')->getLocale());

		return view('log-in/loginForm',$this->view_data);
	}

	public function expiration_session()
	{ 
		$this->view_data['message'] = alert('warning',lang('Messages.sessin_expire'));

		if(!session()->has('lang'))
			session()->set('lang', service('request')->getLocale());

		return view('log-in/loginForm',$this->view_data);
	}

	public function dashboard(){
		if(!isset($this->partner_id) || is_null($this->partner_id) || empty($this->partner_id)){
			$this->view_data['message'] = alert('warning',lang('Messages.sessin_expire'));

			if(!session()->has('lang'))
				session()->set('lang', service('request')->getLocale());

			return view('log-in/loginForm',$this->view_data);
		}
		else {
			if($this->partnerType === "MT"){
				if($this->request->getMethod() == "post"){
					$busId = $this->request->getVar('busId');
					if(isset($busId) && !empty($busId)){
						$trace = $this->invokeApi('get','api/data-list-geo-request',['geoPartnerId'=>$this->partner_id,'geoVehicleId'=>$busId]);
						//debug_data($trace);
						$_trace =isset($trace) && is_object($trace) && $trace->status=="00" ? $trace->response->geo:[];
						$this->view_data['trace'] = isset($_trace) && is_array($_trace) && count($_trace)>0 ? (array)$_trace[0]:[];
						$this->view_data['busId'] = $busId;

						//debug_data($this->view_data);
					}
					else{
						$this->view_data['geoList'] = [];
					}
				}
				else{
					$geo = $this->invokeApi('get','api/data-list-geo-request',['geoPartnerId'=>$this->partner_id]);
					$this->view_data['geoList'] = isset($geo) && is_object($geo) && $geo->status=="00" ? $geo->response->geo:[];
				}

				$bus = $this->invokeApi('get','api/list-bus-ticketing',['busPartner'=>$this->partner_id]);
				$this->view_data['busList'] = isset($bus) && is_object($bus) && $bus->status==="00" ? $bus->response->bus:[];

				$terminus = $this->invokeApi('get','api/list-terminus-ticketing',['termPartner'=>$this->partner_id]);
				$this->view_data['terminusList'] = isset($terminus) && is_object($terminus) && $terminus->status=="00" ? $terminus->response->term:[];
				return view('welcome_message',$this->view_data);
			}
			else{ /* MERCHANT STANDARD */
				//return view('merchant_dashboard');
				return redirect()->to("payment/dashboard");
			}

		}
	}
	public function log_in(){
		if($this->request->getMethod() == "post"){
			$rules = [
				'change_langue'=>['label'=>'Label.langue','rules'=>'trim|required'],
				'username'=>['label'=>'Label.username','rules'=>'trim|required'],
				'password'=>['label'=>'Label.username','rules'=>'trim|required|validateLogin[username,password,change_langue]']
			];
			if(!$this->validate($rules))
				$this->view_data['message'] = alert('warning',$this->validator->listErrors());
			else{
				if($this->setPrivilegeAccess()) {
					//echo json_encode(session()->get());die;
					return redirect()->to(site_url('dashboard'));
				}
				else{
					session()->destroy();
					$this->view_data['message'] = alert('warning',lang("Messages.profile_not_found"));
				}
			}
		}

		$message = session()->getFlashdata('flash_message');
		if(isset($message) && !empty($message))
			$this->view_data['message'] = $message;

		return view('log-in/loginForm',$this->view_data);
	}
	private function setPrivilegeAccess(){
		$profileID = session()->get('profileID'); 
		$args = [
				'myApi'=>'invoke_get',
				'url'=>'api/profile-access-data-request',
				'params'=>[
						'profile'=>$profileID,
						'userType'=>session()->get('userType'),
						'user'=>session()->get('userID')
				]
		];
		$response = $this->invokeApi('get',$args['url'],$args['params']);
		if($response->status==="00"):
			session()->set(['userData'=>$response->profile_data->userData,'menus'=>$response->profile_data->menus,'privileges'=>$response->profile_data->privileges,'options'=>$response->profile_data->options]);
			return true;
		endif;

		return false;
	}

	public function log_out(){
		session()->destroy();
		return redirect()->to(base_url());
	}

	public function my_profile(){
		$view_data = []; 

		if($this->request->getMethod() == "post"){
			$rules = [
				'userId'=>'required','agentId'=>'required','userType'=>'required','partnerType'=>'required','userName'=>'required',
				'firstName'=>['label'=>'Label.first_name','rules'=>'trim|required'],
				'lastName'=>['label'=>'Label.last_name','rules'=>'trim|required'],
				'phone'=>['label'=>'Label.mobile_number','rules'=>'trim'],
				'address'=>['label'=>'Label.location','rules'=>'trim'],
				'identity'=>['label'=>'Label.piece','rules'=>'trim'],
				'identity_number'=>['label'=>'Label.piece_number','rules'=>'trim'],
				'email'=>['label'=>'Label.email','rules'=>'trim|required|valid_email'],
				'oldPassword'=>['label'=>'Label.old_password','rules'=>'trim|validateOldPassword[oldPassword]'],
				'newPassword'=>['label'=>'Label.new_password','rules'=>'trim|matches[confPassword]'],
				'confPassword'=>['label'=>'Label.conf_password','rules'=>'trim'],
			];
			if(!$this->validate($rules))
				$flash_message = alert('warning',$this->validator->listErrors());
			else{
				$data = $this->request->getPost();
				$response = $this->invokeApi('post','api/edit-information-user-request',$data);
				if(isset($response) && is_object($response) && !is_null($response)) {
					if ($response->status === "00") {
						session()->set('userData', $response->response->userData);
						$flash_message = alert('success', lang('Messages.success_edition'));
					} else $flash_message = alert('warning', lang('Messages.warning_edition'));
				}
				else $flash_message = alert('warning',lang('Messages.warning_edition'));
			}
			session()->setFlashdata('flashMessage',$flash_message);
			return redirect()->to(site_url('my-profile'));
		}


		$view_data['userData'] = session()->get('userData');
		$identities = $this->invokeApi('get','api/list-identities',[]);
		$view_data['identities'] = $identities->status == "00" ? (array)$identities->response:[];

		$message = session()->getFlashdata('flashMessage');
		if(isset($message) && !empty($message))
			$view_data['message'] = $message;
		//die(var_dump($view_data));
		return view('log-in/userForm',$view_data);
	}

	public function dashboardMerchant(){

	}

    /**
     * Payment Merchant dashboard
     *
     */
    public function payment_merchant_dashboard(){
        return view('dashboard/payment_dashboard');
    }

}
