<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 13/09/2021
 * Time: 16:43
 */

namespace App\Controllers;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class MassPayment extends BaseController
{

    /**
     *  Init bulk payment and preview customer list
     *
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function init_bulk_payment(){

        /* Clear session data array */
        session()->set("beneficiary", "");
        $final_data = [];
        if($this->request->getMethod() == "post"){
            $rules = [
                'fichier'=>['label'=>'Fichier','rules'=>'uploaded[fichier]|ext_in[fichier,xlsx]']
            ];

             if(!$this->validate($rules)){
                 $message = $this->validator->listErrors();
                 if(isset($message) && !empty($message))
                     $this->view_data['message'] = alert('warning', $message);
            }
            else{
                $fichier = $this->request->getFile('fichier');
                if(!$fichier->isValid()){
                    $this->view_data['message'] = alert('warning', $fichier->getErrorString());
                }
                else{
                    $file_name = uniqid() . '.' . $fichier->getClientExtension();
                    if($fichier->move(WRITEPATH.'uploads/bulk-payment',$file_name)){
                        $reader = new Xlsx();
                        $reader->setReadDataOnly(true);
                        $spreadsheet = $reader->load(WRITEPATH.'uploads/bulk-payment/'.$file_name);
                        $data = $spreadsheet->getSheet(0)->toArray();
                        if(!$this->validateFicherRechargement($data)){
                            $this->view_data['message'] = $this->message;
                        }
                        else{
                            unset($data[0]);
                            $final_data = $this->format_data($data);
                            /* Add list in session */
                            session()->set(array('beneficiary'=>$final_data)); // setting session data

                            $this->view_data['view_step'] = "preview";
                            $this->view_data['customer_list'] = $final_data;
                        }
                    }
                    else{
                        $message = alert('warning', "Error de chargement du fichier");
                        $this->view_data['message'] = alert('warning', $message);
                    }
                }
            }
        }
        $flash_message = session()->getFlashdata('flash_message');
        if (isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        return view('mass_payment/bulk_payment_form', $this->view_data);
    }

    /**
     *  Send customer list for payment
     *
     * @return string
     *
     */
    public function send_bulk_payment() {

        $beneficiary = session()->get("beneficiary");

        if (!empty($beneficiary) && count($beneficiary) >0 ){

            $api_data = array('beneficiary'=>$beneficiary);

            $response = $this->invokeApi('post', 'api/bulk-payment', $api_data);

            if (isset($response) && is_object($response) && $response->status == "00"):
                session()->setFlashdata('flash_message', alert('success', lang('Messages.success_send_request')));
            else:
                session()->setFlashdata('flash_message', alert('danger', lang('Messages.warning_send_request')));
            endif;
        }
        else{
            session()->setFlashdata('flash_message', alert('danger', lang('Messages.send_error')));
        }
        /* Clear session data array */
        session()->set("beneficiary", "");

        return redirect()->to(site_url('payment/bulk-payment-request'));
    }

    public function bulk_payment_history(){

        $this->view_data['partner'] = $this->partner_id;
        $this->view_data['service_code'] = 'BULK_PAY';
        $_payment = $this->invokeApi('get','api/payment-history',$this->view_data);
        $this->view_data['pay_list'] = isset($_payment) && is_object($_payment) && $_payment->status=="00" ? $_payment->response->payment:[];
        
        $flash_message = session()->getFlashdata('flash_message');
        if(isset($flash_message) && !empty($flash_message))
            $this->view_data['message'] = $flash_message;

        return view("mass_payment/liste", $this->view_data);
    }

    private function validateFicherRechargement($data){
        $booelan = true;
        if(isset($data[1])){
            for($i=1; $i<count($data); $i++){
                if(count($data[$i])!=6){ /* Nombre d'elements de la ligne*/
                    $this->message = alert('warning',"Le nombre d'élèments sur la ligne n°".($i+1)." est invalid");
                    $booelan = false;
                    break;
                }
                /* Required fields */
                $type = $data[$i][0];
                if(!isset($type) || empty($type) || reverse_payment_method($type)===$type){ // Phone number
                    $this->message = alert('warning',"Le type sur la ligne n°".($i+1)." est invalid");
                    $booelan = false;
                    break;
                }
                $phone = $data[$i][2];
                if(!isset($phone) || empty($phone)){ // Phone number
                    $this->message = alert('warning',"Le numéro de téléphone sur la ligne n°".($i+1)." est obligatoire");
                    $booelan = false;
                    break;
                }
                $amount = $data[$i][1];
                if(!isset($amount) || empty($amount)){ // Amount
                    $this->message = alert('warning',"Le montant sur la ligne n°".($i+1)." est obligatoire");
                    $booelan = false;
                    break;
                }
                $amount = trim($data[$i][1]);
                if(!intval($amount)){ /* Montant Int */
                    $this->message = alert('warning',"Le montant sur la ligne n°".($i+1)." est invalid");
                    $booelan = false;
                    break;
                }
                $firstname = $data[$i][4];
                if(!isset($firstname) || empty($firstname)){ // Prénom
                    $this->message = alert('warning',"Le prénom sur la ligne n°".($i+1)." est obligatoire");
                    $booelan = false;
                    break;
                }
                $lastname = $data[$i][3];
                if(!isset($lastname) || empty($lastname)){ // Nom
                    $this->message = alert('warning',"Le nom sur la ligne n°".($i+1)." est obligatoire");
                    $booelan = false;
                    break;
                }
            }
        }
        else{
            $this->message = alert('warning',"Le fichier chargé est vide");
            $booelan = false;
        }
        return $booelan;
    }

    private function format_data($data){
        $response = [];
        for($i=1; $i<=count($data); $i++){
            $line = [
                "montant"=> $data[$i][1],
                "codeService"=>reverse_payment_method($data[$i][0]),
                "numeroBeneficiaire"=>$data[$i][2],
                "prenomBeneficiaire"=>$data[$i][4],
                "nomBeneficiaire"=>$data[$i][3],
                "mailBeneficiaire"=>$data[$i][5]
            ];
            $response[] = $line;
        }
        return $response;
    }

    public function telecharger(){
        $_filePath = ROOTPATH.'uploads/bulk-payment/Model-PayZem.xlsx';
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($_filePath) . '"');

        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($_filePath));
        flush(); // Flush system output buffer
        readfile($_filePath);
    }
}