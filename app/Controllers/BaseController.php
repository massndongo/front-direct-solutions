<?php

namespace App\Controllers;

use Config\Pager;
use Config\Services;
use App\Libraries\Api;
use CodeIgniter\Controller;
use Psr\Log\LoggerInterface;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	public $titlePage;
	public $partnerName;
	public $userName;
	protected $partnerType;
	protected $partner_id;
	protected $pager;
	protected $perPage;
	protected $uri;
    protected  $view_data = [];
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form','functions','date'];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		$this->request = $request;
		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		$session = Services::session();
		$language = Services::language();
		$lang = $session->get('lang') ? $session->get('lang'):'fr';
		$language->setLocale($lang);
		$this->titlePage = "Accueil";
		$userData = $session->get('userData');
		//debug_data($session->get());
		if(isset($userData)):
			$this->partnerType = $userData->merchant_type;
			$this->partner_id  = $userData->partner_id;
		endif;

		$this->pager = Services::pager();
		$this->perPage = (new Pager())->perPage;
		$this->uri = service('uri');
	}
	
    function getPrices(){
        $view_data = [];
        /*$api = new Api();*/
        $partner_id = $this->partner_id;
        $view_data['ratePartner'] = $partner_id;
    
        $response = $this->invokeApi('get','api/list-rate-ticketing',$view_data);  /*$api->appel(['myApi' => 'invoke_get', 'url' => 'api/list-rate-ticketing', 'params' => $view_data]);*/

        $view_data['rate'] = $response->status === "00" ? (array)$response->response : [];
        $data['rate'] = $view_data['rate'];

        return $data;
    }

	public function invokeApi($method,$url,$params){
		$api = new Api();
		$reponse = $api->appel(['myApi'=>$method==="post" ? 'invoke_post':'invoke_get','url'=>$url,'params'=>$params]);
		if(isset($reponse) && is_object($reponse) && $reponse->status=="02"){
			expiration_session();
			session()->setFlashdata('flash_message',alert('warning',lang('Messages.sessin_expire')));
			header('location:'.site_url('log-in'));
			exit();
			/*return redirect()->to(base_url('log-in'));*/
		}
		else return $reponse;
	}


}
