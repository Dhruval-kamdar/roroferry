 <?php
require('application/libraries/bob/libfiles/iPay24Pipe.php');
class Homepage extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Booking_model','this_model');
        $this->load->model('Api_model');
        $this->load->model('Account_model');
        $this->load->helper('cookie');
        $this->load->library('Pdf');
    }

    public function index() {
       
        $data['page'] = "front/home/index";
        $data['var_meta_title'] = 'login';
        $data['var_meta_description'] = 'login';
        $data['var_meta_keyword'] = 'login';
        
        $getToken = $this->getToken();
        $data['route'] = $this->this_model->route();
        
        $getStop = array();
        if ($getToken) {
            $getVehical = $this->getVehical();
            $getStop = $this->getStop();
            if ($getStop['message'] == 'Success') {
                $getStop = $getStop['data'];
                $getVehical = $getVehical['data'];
            } else {
                $data['message'] = $getStop['message'];
                $data['page'] = "front/home/wrong";
            }
        } else {
            $data['page'] = "front/home/wrong";
        }
        $data['js'] = array(
            'front/home.js'
        );
        $data['js_plugin'] = array();

        $data['css'] = array();
        $data['css_plugin'] = array(
        );
        $data['init'] = array(
            'Home.init()'
        );
        $data['getStop'] = $getStop;
        $data['getVehical'] = $getVehical;
        $this->load->view(FRONT_LAYOUT, $data);
    }

    public function submitBooking(){
        $this->session->set_flashdata('success', 'Your booking is successfully. Your booking id is:'.time());
        redirect("/");
        exit;
    }

    public function getToken() {
        $data = "userName=testagent&password=123456&agentID=C39B22C1-6C27-4810-92AA-1BBE74B8F852";
        $url = "http://test.dgseaconnect.com/api/api/Authenticate";
        $header = array();
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
       
        if (isset($result['data']['token'])) {
            $this->session->set_userdata('token', $result['data']['token']);
            return true;
        } else {
            return false;
        }
    }

    public function getStop() {
        $token = $this->session->userdata('token');
        $data = "token=NgKsXWk2HHwZsOUvAeClfJGVrISyN2Ss";
        $url = "http://test.dgseaconnect.com/api/api/GetStops";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);

        if (isset($result['success'])) {
            return $result;
        } else {
            return $result;
        }
    }
    
    public function getVehical() {
        $token = $this->session->userdata('token');
       
        $data = "token=NgKsXWk2HHwZsOUvAeClfJGVrISyN2Ss";
        $url = "http://test.dgseaconnect.com/api/api/GetVehicles";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);
        
        if (isset($result['success'])) {
            return $result;
        } else {
            return $result;
        }
    }
    
    public function GetCargoTrips(){
        
         $fields = array(
            'departureDate' => date('d/m/Y', strtotime($this->input->post('departureDate'))),
            'destinationID' => $this->input->post('destinationID'),
            'sourceID' => $this->input->post('sourceID'),
            'vehicleTypeID' => $this->input->post('vehicleTypeID'),
            'vehicleCategoryID' => $this->input->post('vehicleCategoryID'),
        );

        $data = http_build_query($fields);
        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/A_GetCargoTrips";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
        echo json_encode($result);
        exit;
    }

    public function getTrips() {

        $data = "";
        $token = $this->session->userdata('token');
        $fromDate = date('d/m/Y', strtotime($this->input->post('fromDate')));
        $fromstaton = $this->input->post('fromstaton');
        $tostation = $this->input->post('tostation');
        $url = "http://test.dgseaconnect.com/api/api/GetTrips?departureDate=$fromDate&destinationID=$tostation&sourceID=$fromstaton";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);
        if (empty($result['data'])) {
            echo $result = '{"success": true,"data": [{"tripID": 3419,"tripDate": "31/03/2018","departureTime": "11:00 AM","arrivalTime": "12:00 PM","duration": "60","fromStationName": "Dahej","toStationName": "Ghogha","ferryName": "Live _ferry","amount": 300,"BaseRate": 250,"PercentageOfDayOfDiffrence": 20,"amountOfDayOfDiffrence": 50,"PercentageOfSeatAvailability": 98,"amountOfSeatAvailability": 0,"amountOfNonWindowsSeat": 250,"amountOfWindowsSeat": 0,"amountOfTimeCharge": 0,"noOfSeatAvailability": 128,"isPassed": false,"isSeatLayout": false,"reservedSeats": 0},{"tripID": 3418,"tripDate": "31/03/2018","departureTime": "04:00 PM","arrivalTime": "05:00 PM","duration": "60","fromStationName": "Dahej","toStationName": "Ghogha","ferryName": "Live _ferry","amount": 240,"BaseRate": 200,"PercentageOfDayOfDiffrence": 20,"amountOfDayOfDiffrence": 40,"PercentageOfSeatAvailability": 100,"amountOfSeatAvailability": 0,"amountOfNonWindowsSeat": 200,"amountOfWindowsSeat": 0,"amountOfTimeCharge": 0,"noOfSeatAvailability": 130,"isPassed": false,"isSeatLayout": false,"reservedSeats": 0}],"message": "Success"}';        
            exit;
        }
        echo json_encode($result);
        exit;
    }

    public function getSeat() {

        $data = "";
        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/GetSeatLayout?tripID=4624";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);
        echo json_encode($result);
        exit;
    }

    public function blockSeats() {
        $fields = array(
            'tripID' => "4624",
            'seatIDs' => array(3214, 3215),
            'paxDetails' => array(
                array('passangerCategoryID' => 1, 'pax' => 0),
                array('passangerCategoryID' => 1, 'pax' => 0),
            ),
        );

        $data = http_build_query($fields);

        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/BlockSeats";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
        echo json_encode($result);
        exit;
    }
    
    public function getPickupDetail() {
        $data = "";
        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/GetBuses?tripID=4624";
       // http://test.dgseaconnect.com/api/api/GetBuses?tripID=3418
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);
        echo json_encode($result);
        exit;
    }

    public function GetClass(){
        $tripID= $this->input->post('tripId');
        $data = "";
        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/A_GetClasses?tripID=".$tripID;
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);
        
        echo json_encode($result);
        exit;
    }
    
    public function GetTripTime(){
//        print_r($this->input->post('routeId'));
        $result= $this->this_model->GetTripTime($this->input->post('routeId'));
        echo json_encode($result);
        exit;
    }
    
    public function GetTripPickUpStaion(){
        $result= $this->this_model->GetTripPickUpStaion($this->input->post());
        echo json_encode($result);
        exit;
    }
    
    public function GetTripDropStaion(){
        $result= $this->this_model->GetTripDropStaion($this->input->post());
        echo json_encode($result);
        exit;
    }
    
    public function GetWithoutCargoTrips(){
        $departureDate= date('d/m/Y', strtotime($this->input->post('departureDate')));
        $destinationID= $this->input->post('destinationID');
        $sourceID= $this->input->post('sourceID');
        $data = "";
        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/A_GetTrips?departureDate=".$departureDate."&destinationID=".$destinationID."&sourceID=".$sourceID;
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);
        
        echo json_encode($result);
        exit;
    }
    
    public function a_booking(){
    
         $fields = array(
            'tripID' => $this->input->post('tripId'),
            'noOfPassengers' => $this->input->post('noPassangerharter'),
            'noOfInfants' => $this->input->post('noPassangerequal'),
            'noOfChilds' => $this->input->post('noPassangerlesstwo'),
            'className' => $this->input->post('ferryClass'),
        );
        
        $data = http_build_query($fields);
        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/A_Booking";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
        echo json_encode($result);
        exit;
        
//        print_r($this->input->post());
//        exit;
    }

    public function GetBooking(){
        $fields = array(
            'tripID' => $this->input->post('tripID'),
            'noOfPassengers' => $this->input->post('noOfPassengers'),
            'noOfInfants' => $this->input->post('noOfInfants'),
            'noOfChilds' => $this->input->post('noOfChilds'),
            'className' => $this->input->post('className'),
        );
        $data = http_build_query($fields);
        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/A_Booking";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
        echo json_encode($result);
        exit;
    }
    
    public function makePayment(){
//        $amount = '1.00';
       
//        $temp_amount=count($this->input->post('passanger'))*TICKET_AMOUNT;
//        $amount = $this->input->post('grandtotal');
        $amount = '1';
        $res= $this->this_model->saveTicketDetails($this->input->post());
        if($res){
            if($this->input->post() == 'Without vehicle'){
                $res = $this->withoutcargoconfirmCargoBooking($this->input->post());
            }else{
                $res = $this->confirmCargoBooking($this->input->post());
            }
            $result= $this->this_model->makePaymentBOB($this->input->post(),$res,$amount);
        }else{
            redirect('payment-compelete');
        }
    }
    
    public function getResponse(){
        $trandata = isset($_GET["trandata"]) ? $_GET["trandata"] : isset($_POST["trandata"]) ? $_POST["trandata"] : "";
        if($trandata != ""){
            $result= $this->this_model->makePaymentResponse();
         
            if($result['status'] == 'success'){
                if($result['transaction_status'] == 'CAPTURED'){
                    $update= $this->this_model->paymnetSuccess($result);
                    $this->generateTicketPdf($result['id'],$result['transaction_id']);
                    $this->sendConfirmMail($result['id'],$result['transaction_id']);
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
    
    public function paymentCompelete(){
        $data['page'] = "front/home/paymentCompelete";
        $data['var_meta_title'] = 'roroferry - Payment Compelete';
        $data['var_meta_description'] = 'roroferry - payment Compelete';
        $data['var_meta_keyword'] = 'roroferry - payment Compelete';
        $data['js'] = array(
            'front/paymentInquirey.js'
        );
        $data['js_plugin'] = array();
        $data['css'] = array();
        $data['css_plugin'] = array(
        );
        $data['init'] = array(
            'PaymentInquirey.init()'
        );
        $this->load->view(FRONT_LAYOUT, $data);
    }

    public function paymentInquiry(){
        
        if($this->input->post()){
//            print_r($this->input->post());exit;
           $result= $this->this_model->paymentInquiry($this->input->post());
          
           if($result['status'] == 'success'){
           $this->session->set_flashdata('success', 'Your inquiry is successfully. '
                   . '<br>Transaction Status:'.$result['transaction_status']
                   . '<br>Transaction ID:'.$result['transaction_id']
                   . '<br>Mrch Track ID:'.$result['march_track_id']
                   . '<br>Transaction Amt:'.$result['transaction_anount']
                   . '<br>UDF5:'.$result['UDF5']
                   );
           }else{
               $this->session->set_flashdata('error','Something went wrong...');
           }
        }
        $data['page'] = "front/home/paymentInquirey";
        $data['var_meta_title'] = 'roroferry - Payment Inquirey';
        $data['var_meta_description'] = 'roroferry - payment Inquirey';
        $data['var_meta_keyword'] = 'roroferry - payment Inquirey';
        $data['js'] = array(
            'front/paymentInquirey.js'
        );
        $data['js_plugin'] = array();

        $data['css'] = array();
        $data['css_plugin'] = array(
        );
        $data['init'] = array(
            'PaymentInquirey.init()'
        );
        
        $this->load->view(FRONT_LAYOUT, $data);
    }
    
    public function getResponsepaymentInquiry(){
        
         $result= $this->this_model->getResponsepaymentInquiry();
    }
    
    public function paymentRefund(){
        
        if($this->input->post()){
              $result= $this->this_model->paymentRefund($this->input->post());
              
        }
        $data['page'] = "front/home/paymentRefund";
        $data['var_meta_title'] = 'roroferry - Payment Inquirey';
        $data['var_meta_description'] = 'roroferry - payment Inquirey';
        $data['var_meta_keyword'] = 'roroferry - payment Inquirey';
        $data['js'] = array(
            'front/paymentRefund.js'
        );
        $data['js_plugin'] = array();

        $data['css'] = array();
        $data['css_plugin'] = array(
        );
        $data['init'] = array(
            'PaymentRefund.init()'
        );
        
        $this->load->view(FRONT_LAYOUT, $data);
    }
    
    public function getResponsepaymentRefund(){
        $trandata = isset($_GET["trandata"]) ? $_GET["trandata"] : isset($_POST["trandata"]) ? $_POST["trandata"] : "";
        
        if($trandata != ""){
            $result= $this->this_model->getResponsepaymentRefund();
            if($result['status'] == 'success'){
               $this->session->set_flashdata('success', 'Your inquiry is successfully. '
                       . '<br>Transaction Status:'.$result['transaction_status']
                       . '<br>Transaction ID:'.$result['transaction_id']
                       . '<br>Mrch Track ID:'.$result['march_track_id']
                       . '<br>Transaction Amt:'.$result['transaction_anount']
                       . '<br>UDF5:'.$result['UDF5']
                       );
               }else{
                   $this->session->set_flashdata('error','Something went wrong...');
               }
        }
        $data['page'] = "front/home/paymentRefund";
        $data['var_meta_title'] = 'roroferry - Payment Inquirey';
        $data['var_meta_description'] = 'roroferry - payment Inquirey';
        $data['var_meta_keyword'] = 'roroferry - payment Inquirey';
        $data['js'] = array(
            'front/paymentRefund.js'
        );
        $data['js_plugin'] = array();

        $data['css'] = array();
        $data['css_plugin'] = array(
        );
        $data['init'] = array(
            'PaymentRefund.init()'
        );
        
        $this->load->view(FRONT_LAYOUT, $data);
    }
    
    public function generateTicketPdf($id,$transaction_id){
           
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            $data['ticketDetails']=  $this->this_model->getpdfdetails($id);
            $data['passangerDetails']=  $this->this_model->getpassangerDetails($id);
            
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('TCPDF Example 006');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $lg = Array();
            $lg['a_meta_charset'] = 'UTF-8';
            $lg['a_meta_dir'] = 'rtl';
            $lg['a_meta_language'] = 'fa';
            $lg['w_page'] = 'page';
            $pdf->setLanguageArray($lg);
            $pdf->SetFont('freeserif', '', 12);
            $pdf->AddPage();
            $pdf->setRTL(false);
            
            $new_html = $this->load->view("front/home/generateTicketPdf", $data,true);
            
            $pdf->WriteHTML($new_html, true, 0, true, 0);
            ob_end_clean();  
            $pdf->Output(FCPATH.'public/uploads/'.$transaction_id.'.pdf', 'F');
    }
    
    public function sendConfirmMail($id,$transaction_id){
        $data['ticketDetails']=  $this->this_model->getpdfdetails($id);
        $data['passangerDetails']=  $this->this_model->getpassangerDetails($id);
        $data1= array();        
        $data['message'] = $this->load->view('front/email_template/mail_template', $data1, true);
        $data ['from_title'] = 'Roroferry Confirmation';
        $data ['subject'] = 'Roroferry Confirmation ';
        $data ['from'] = 'parthkhunt12@gmail.com';
        $data ['to'] = $data['ticketDetails'][0]->emailAddress;
        $data ['attech'] = 'public/uploads/'.$transaction_id.'.pdf';
        $mailSend = $this->utility->sendMailSMTP($data);
       
    }
    
    public function termsCondition(){
        $data['page'] = "front/home/termsCondition";
        $data['var_meta_title'] = 'Terms & Condition';
        $data['var_meta_description'] = 'Roroferry - Terms & Condition';
        $data['var_meta_keyword'] = 'Roroferry - Terms & Condition';
        
        $data['js'] = array();
        $data['js_plugin'] = array();
        $data['css'] = array();        
        $data['css_plugin'] = array();
        $data['init'] = array();
        $this->load->view(FRONT_LAYOUT, $data);
    }
    
    public function refundCancellation(){
        $data['page'] = "front/home/refundCancellation";
        $data['var_meta_title'] = 'Roroferry - Refund & Cancellation Policy';
        $data['var_meta_description'] = 'Roroferry - Refund & Cancellation Policy';
        $data['var_meta_keyword'] = 'Roroferry - Refund & Cancellation Policy';        
        $data['js'] = array();
        $data['js_plugin'] = array();
        $data['css'] = array();        
        $data['css_plugin'] = array();
        $data['init'] = array();
        $this->load->view(FRONT_LAYOUT, $data);
    }
    
    public function privacyPolicy(){
        $data['page'] = "front/home/privacyPolicy";
        $data['var_meta_title'] = 'Roroferry - Privacy Policy';
        $data['var_meta_description'] = 'Roroferry - Privacy Policy';
        $data['var_meta_keyword'] = 'Roroferry - Privacy Policy';        
        $data['js'] = array();
        $data['js_plugin'] = array();
        $data['css'] = array();        
        $data['css_plugin'] = array();
        $data['init'] = array();
        $this->load->view(FRONT_LAYOUT, $data);
    }
    
    public function testpdf(){
            $id = '2';
            $transaction_id = "dsdsanbdvsjbdmsbzdcxcxcxcx";
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            $data['ticketDetails']=  $this->this_model->getpdfdetails($id);
            $data['passangerDetails']=  $this->this_model->getpassangerDetails($id);
           
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('TCPDF Example 006');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $lg = Array();
            $lg['a_meta_charset'] = 'UTF-8';
            $lg['a_meta_dir'] = 'rtl';
            $lg['a_meta_language'] = 'fa';
            $lg['w_page'] = 'page';
            $pdf->setLanguageArray($lg);
            $pdf->SetFont('freeserif', '', 10);
            $pdf->AddPage();
            $pdf->setRTL(false);
            $new_html = $this->load->view("front/home/generateTicketPdf", $data,true);
            
            $pdf->WriteHTML($new_html, true, 0, true, 0);
            ob_end_clean();  
            $pdf->Output(FCPATH.'public/uploads/'.$transaction_id.'.pdf', 'F');
    }
    
    public function getTotalNumberSeat(){

        $result= $this->this_model->getTotalNumberSeat($this->input->post());
        echo json_encode($result);
        exit;
         
    }
    
    public function getTotalSeat(){
        $data['seatArray']= $this->this_model->getTotalSeat($this->input->post());
        $html=$this->load->view('front/home/seatLayout',$data,TRUE);
        echo $html;
        exit;
    }
    
    public function GetCargoBooking(){
        $fields = array(
            "tripID" => $this->input->post('tripId'),
            "noOfPassengers" => $this->input->post('noPassanger'),
            "noOfInfants" => "0",
            "noOfChilds" => "0",
            "className" => $this->input->post('ferryClass'),
            "vehicleCategoryID" => $this->input->post('vehicalId'),
        );
        
        $data = http_build_query($fields);
        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/A_CargoBooking";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
        echo json_encode($result);
        exit;
        
        
        
    }
    
    public function updateCargoPassengerDetails(){
         
        $passangerArry =[];
        for($i = 0 ; $i < count($this->input->post('passaangerName')) ; $i++){
            $temppassangerArry[$i]=[
                        'name'=>$this->input->post('passaangerName')[$i],
                        'age'=>$this->input->post('passaangerAge')[$i],
                        'gender'=>$this->input->post('passaangerGender')[$i],
                    ];
                    array_push($passangerArry,$temppassangerArry[$i]);
        }
//        $passengerDetails=json_encode($passangerArry);
        $fields = array(
            "bookingID"=> $this->input->post('bookingId'),
            "passengerDetails" =>$passangerArry ,
        );
         
        $data = http_build_query($fields);
       
        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/A_UpdatePassengerDetails";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
           
        echo json_encode($result);
        exit;
    }
    
    public function getWithoutcargoBooking(){
        if($this->input->post('noOfPassanger') == NULL){
             $noOfPassanger=0;
        }else{
            $noOfPassanger=$this->input->post('noOfPassanger');
        }
        if($this->input->post('noOfChild') == NULL){
             $noOfChild=0;
        }else{
            $noOfChild=$this->input->post('noOfChild');
        }
        if($this->input->post('noOfInfants') == NULL){
             $noOfInfants=0;
        }else{
            $noOfInfants = $this->input->post('noOfInfants');
        }
        
         $fields = array(
            "tripID" => $this->input->post('tripId'),
            "noOfPassengers" => $noOfPassanger,
            "noOfInfants" => $noOfChild,
            "noOfChilds" => $noOfInfants,
            "className" => $this->input->post('className'),
        );
       
        $data = http_build_query($fields);
        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/A_Booking";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
        echo json_encode($result);
        exit;
    }
    
    public function A_UpdateCargoPassengerDetails(){
        if($this->input->post('noOfPassanger') == NULL){
            
            
        $passangerArry =[];
            for($i = 0 ; $i < count($this->input->post('passaangerName')) ; $i++){
                $temppassangerArry[$i]=[
                            'name'=>$this->input->post('passaangerName')[$i],
                            'age'=>$this->input->post('passaangerAge')[$i],
                            'gender'=>$this->input->post('passaangerGender')[$i],
                        ];
                        array_push($passangerArry,$temppassangerArry[$i]);
            }
    //        $passengerDetails=json_encode($passangerArry);
            $fields = array(
                "bookingID"=> $this->input->post('bookingId'),
                "passengerDetails" =>$passangerArry ,
            );

            $data = http_build_query($fields);

            $token = $this->session->userdata('token');
            $url = "http://test.dgseaconnect.com/api/api/A_UpdatePassengerDetails";
            $header = array('authorization: ' . $token);
            $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
            
            echo json_encode($result);
            exit;
        }
    }
    
    public function confirmCargoBooking($postData){
         $fields = array(
            "bookingID" => $postData('bookingID'),
            "returnBookingID" => 0,
            "email" => $postData('emailAddress'),
            "mobile" => $postData('phoneNumber'),
            "vehicleRegNo" => $postData('vehicleNo'),
            "driverLicenseNo" => $postData('licenseNo'),
            "NoOfPassengers" => $postData('noPassanger'),
            "NoOfInfants"=>0,
        );
        
        $data = http_build_query($fields);
        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/A_ConfirmCargoBooking";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
        echo json_encode($result);
        exit;
    }
    
    public function withoutcargoconfirmCargoBooking($postData){
       
        $fields = array(
            "bookingID" => $postData('bookingID'),
            "email" => $postData('emailAddress'),
            "mobile" => $postData('phoneNumber'),
        );
        
        $data = http_build_query($fields);
        $token = $this->session->userdata('token');
        $url = "http://test.dgseaconnect.com/api/api/A_ConfirmBooking";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
        echo json_encode($result);
        exit;
    }
}
    
?>