<?php 
class Booking_model extends My_model
{
    public function route(){
        $data['table'] = 'route_list';
        $data['select'] = ['id','route'];
        $data['where'] = ['is_active'=>'active'];
        $res=$this->selectRecords($data);
        return $res;
    }

    public function GetTripTime($postData){
        $data['table']='trip_time';
        $data['select']=['id','time'];
        $data['where']=['routeId'=>$postData];
        $res=$this->selectRecords($data);
        
        return $res;
    }
    
    public function GetTripPickUpStaion($postData){
        $data['table']='station_list';
        $data['select']=['id','time','stationName'];
        $data['where']=['routeId'=>$postData['routeId'],'forTime'=>$postData['tripTimeId'],'stationType'=>'pickup'];
        $res=$this->selectRecords($data);        
        return $res;
    }
    
    public function GetTripDropStaion($postData){
        $data['table'] = 'station_list';
        $data['select'] = ['id','time','stationName'];
        $data['where'] = ['routeId'=>$postData['routeId'],'forTime'=>$postData['tripTimeId'],'stationType'=>'drop'];
        $res=$this->selectRecords($data);        
        return $res;
    }
    
    public function makePaymentBOB($postData){
        
        $currency = '356';
        $language = 'USA';
        $receiptURL = base_url().'homepage/getResponse/';
        $errorURL = base_url().'homepage/getResponse/';
        $resourcePath = '/home/hcgk8u1dsu89/public_html/phpnormal/cgnfile/';
        $aliasName = 'IPGTEST';
        $myObj = new iPay24Pipe();
        $rnd = substr(number_format(time() * rand(), 0, '', ''), 0, 10);
        $trackid = $rnd;
        $myObj->setResourcePath(trim($resourcePath));
        $myObj->setKeystorePath(trim($resourcePath));
        $myObj->setAlias(trim($aliasName));
        $myObj->setAction(trim('1'));
        $myObj->setCurrency(trim($currency));
        $myObj->setLanguage(trim($language));
        $myObj->setResponseURL(trim($receiptURL));
        $myObj->setErrorURL(trim($errorURL));
        $myObj->setAmt('10'); //setPostData Amount
        $myObj->setTrackId($trackid);
        
        if (trim($myObj->performPaymentInitializationHTTP()) != 0) {
            echo("ERROR OCCURED! SEE CONSOLE FOR MORE DETAILS");
            return;
        } else {
            //	header("location:".$myObj->getwebAddress()); 
            $url = trim($myObj->getWebAddress());
            echo "<meta http-equiv='refresh' content='0;url=$url'>";
        }
    }
    
    public function makePaymentResponse() {
        $resourcePath = '/home/hcgk8u1dsu89/public_html/phpnormal/cgnfile/';
        $aliasName = 'IPGTEST';
        $myObj = new iPay24Pipe();
        $myObj->setResourcePath(trim($resourcePath));
        $myObj->setKeystorePath(trim($resourcePath));
        $myObj->setAlias(trim($aliasName));

        if (!empty(($_SERVER["QUERY_STRING"]))) {
            parse_str($_SERVER["QUERY_STRING"]);
        } else {
            $trandata = isset($_GET["trandata"]) ? $_GET["trandata"] : isset($_POST["trandata"]) ? $_POST["trandata"] : "";
        }

        //$paymentid =  isset($_GET["paymentid"]) ? $_GET["paymentid"] : isset($_POST["paymentid"]) ? $_POST["paymentid"] : "";
        $errorText = isset($_GET["ErrorText"]) ? $_GET["ErrorText"] : isset($_POST["ErrorText"]) ? $_POST["ErrorText"] : null;

        if (isset($trandata) && trim($myObj->parseEncryptedRequest(trim($trandata))) != 0) {

            echo 'Error : ' .$myObj->getError();
        } else {

            if ($errorText == null) {

                echo 'Transaction Status:' . $myObj->getResult() . '<br/>';
                echo 'Post Date:' . $myObj->getDates() . '<br/>';
                echo 'Transaction Reference ID:' . $myObj->getRef() . '<br/>';
                echo 'Mrch Track ID:' . $myObj->getTrackId() . '<br/>';
                echo 'Transaction ID:' . $myObj->getTransId() . '<br/>';
                echo 'Transaction Amount:' . $myObj->getAmt() . '<br/>';
                echo 'Payment ID:' . $myObj->getPaymentId() . '<br/>';
            } else {

                echo 'ErrorText:' . $errorText . '<br/>';
                echo 'Mrch Track ID:' . isset($_GET["trackid"]) ? $_GET["trackid"] : isset($_POST["trackid"]) ? $_POST["trackid"] : "" . '<br/>';
                echo 'Transaction ID:' . isset($_GET["tranid"]) ? $_GET["tranid"] : isset($_POST["tranid"]) ? $_POST["tranid"] : "" . '<br/>';
                echo 'Payment ID:' . $myObj->getTrackId() . '<br/>';
                echo 'Transaction ID:' . isset($_GET["paymentid"]) ? $_GET["paymentid"] : isset($_POST["paymentid"]) ? $_POST["paymentid"] : "" . '<br/>';
            }
        }
    }

}
?>