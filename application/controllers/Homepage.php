<?php
require('application/libraries/bob/libfiles/iPay24Pipe.php');
class Homepage extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Booking_model','this_model');
        $this->load->model('Api_model');
        $this->load->model('Account_model');
        $this->load->helper('cookie');
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
        $url = "http://test.indigoseaways.com/api/api/Authenticate";
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
        $url = "http://test.indigoseaways.com/api/api/GetStops";
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
        $url = "http://test.indigoseaways.com/api/api/GetVehicles";
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
        $url = "http://test.indigoseaways.com/api/api/A_GetCargoTrips";
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
        $url = "http://test.indigoseaways.com/api/api/GetTrips?departureDate=$fromDate&destinationID=$tostation&sourceID=$fromstaton";
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
        $url = "http://test.indigoseaways.com/api/api/GetSeatLayout?tripID=4624";
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
        $url = "http://test.indigoseaways.com/api/api/BlockSeats";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
        echo json_encode($result);
        exit;
    }
    
    public function getPickupDetail() {
        $data = "";
        $token = $this->session->userdata('token');
        $url = "http://test.indigoseaways.com/api/api/GetBuses?tripID=4624";
       // http://test.indigoseaways.com/api/api/GetBuses?tripID=3418
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);
        echo json_encode($result);
        exit;
    }

    public function GetClass(){
        $tripID= $this->input->post('tripId');
        $data = "";
        $token = $this->session->userdata('token');
        $url = "http://test.indigoseaways.com/api/api/A_GetClasses?tripID=".$tripID;
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
        $url = "http://test.indigoseaways.com/api/api/A_GetTrips?departureDate=".$departureDate."&destinationID=".$destinationID."&sourceID=".$sourceID;
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);
       
        echo json_encode($result);
        exit;
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
        $url = "http://test.indigoseaways.com/api/api/A_Booking";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
        echo json_encode($result);
        exit;
    }
    
    
    public function makePayment(){
    
//        $amount=count($this->input->post('passanger'))*550;
        $amount = '1.00';
        $result= $this->this_model->makePaymentBOB($this->input->post());
        
    }
    
    public function getResponse(){
         $result= $this->this_model->makePaymentResponse();
    }
    
    public function paymentInquiry(){
        if($this->input->post()){
//            print_r($this->input->post());exit;
           $result= $this->this_model->paymentInquiry($this->input->post());
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
        $result= $this->this_model->getResponsepaymentRefund();
    }
}

?>