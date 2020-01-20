 <?php
require('application/libraries/bob/libfiles/iPay24Pipe.php');
class Paynow extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Paymet_details','this_model');
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
            $amount = $this->input->post('amount');
            $res= $this->this_model->adddetails($this->input->post());
            if($res){
                $result= $this->this_model->makePaymentBOBNew($this->input->post(),$res,$amount);
            }else{
                redirect('pay-now');
            }
        }else{
            redirect(base_url());
        }
    }
    
    
    
    
}
    
?>