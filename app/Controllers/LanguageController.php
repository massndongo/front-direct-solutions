<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 09/06/2021
 * Time: 13:27
 */

namespace App\Controllers;


class LanguageController extends BaseController
{
    public function index(){
        $uri = service('uri');
        $locale = $uri->getSegment(2);
        session()->remove('lang');
        session()->set('lang', $locale);
        $url = base_url();
        return redirect()->to($url);
    }
}