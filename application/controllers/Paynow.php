 <?php
require('application/libraries/bob/libfiles/iPay24Pipe.php');
class Paynow extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Paymet_details','this_model');
        $this->load->model('Booking_model','booking_model');
        $this->load->helper('cookie');
        $this->load->library('Pdf');
    }
    
    public function index(){
        $data['page'] = "front/home/paynow";
        $data['var_meta_title'] = 'Make your payment';
        $data['var_meta_description'] = 'Roroferry - Make your payment';
        $data['var_meta_keyword'] = 'Roroferry - Make your payment';
        $data['js'] = array("front/paynow.js");
        $data['js_plugin'] = array();
        $data['css'] = array();        
        $data['css_plugin'] = array();
        $data['init'] = array("Paynow.init()");
        $this->load->view(FRONT_LAYOUT, $data);
    }
    public function confirmpayment(){
        if($this->input->post()){
           $data['details'] = $this->input->post();
           
            $data['page'] = "front/home/confirmpayment";
            $data['var_meta_title'] = 'Confirm your payment';
            $data['var_meta_description'] = 'Roroferry - Confirm your payment';
            $data['var_meta_keyword'] = 'Roroferry - Confirm your payment';
            $data['js'] = array("front/paynow.js");
            $data['js_plugin'] = array();
            $data['css'] = array();        
            $data['css_plugin'] = array();
            $data['init'] = array("Paynow.confirmpayment()");
            $this->load->view(FRONT_LAYOUT, $data);
        }else{
            redirect(base_url());
        }
    }
    
    public function makePayment(){
        if($this->input->post()){
//            Array ( [firstname] => Parth [lastname] => Khunt [email] => parthkhunt12@gmail.com [amount] => 12500 [mobileno] => 9727466631 [note] => Test )
//            
             $amount = '1.00';
//            $amount = $this->input->post('amount');
            $res= $this->this_model->adddetails($this->input->post());
            if($res){
                $result= $this->booking_model->makePaymentBOBNew($this->input->post(),$res,$amount);
            }else{
                redirect('pay-now');
            }
        }else{
            redirect(base_url());
        }
    }
    
    public function getResponsepaynow(){
        
        $trandata = isset($_GET["trandata"]) ? $_GET["trandata"] : isset($_POST["trandata"]) ? $_POST["trandata"] : "";
        
        if($trandata != ""){
            $result= $this->booking_model->makePaymentResponse();
       
            if($result['status'] == 'success'){
                if($result['transaction_status'] == 'CAPTURED'){
                    $getticketDetails= $this->this_model->getpaymentDetails($result['id']);
                    
                    
                         
                    $update= $this->this_model->paymnetSuccess($result);
//                    print_r($update);
//                    die();
//                    $this->generateTicketPdf($result['id'],$result['transaction_id']);
//                    $this->sendConfirmMail($result['id'],$result['transaction_id']);
                    
                    $this->session->set_flashdata('success', 'Your payment is successfully. '
                            . '<br>Transaction Status:'.$result['transaction_status']
                            . '<br>Transaction ID:'.$result['transaction_id']
                            . '<br>Mrch Track ID:'.$result['march_track_id']
                            . '<br>Transaction Amt:'.$result['transaction_anount']
                            . '<br>Payment Id:'.$result['payment_id']
                            );
                }else{
                   if($result['transaction_status'] == 'IPAY0100048 - CANCELLED'){
                       $this->session->set_flashdata('info','Your payment is cancelled.');
                   }  
                }
           }else{
               $this->session->set_flashdata('error','Something went wrong...');
           }
        }
         redirect('payment-compelete');
    }
    
    
    
    
}
    
?>