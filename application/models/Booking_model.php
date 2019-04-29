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
        $myObj->setUdf6("ROROFERRY");
        $myObj->setUdf7($postData['passanger'][0]);
        $myObj->setUdf8($postData['emailAddress']);
        $myObj->setUdf9($postData['phoneNumber']);
        $myObj->setUdf10($postData['cityName']."-".$postData['pinCode']);
        $myObj->setUdf11(trim('1.00'));
        $myObj->setUdf12("No tax Details");
        
        $myObj->setCurrency(trim($currency));
        $myObj->setLanguage(trim($language));
        $myObj->setResponseURL(trim($receiptURL));
        $myObj->setErrorURL(trim($errorURL));
        $myObj->setAmt(trim('1.00')); //setPostData Amount
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
                print_r($myObj);
                echo '-----------<br/>';
                echo 'Transaction Status:' . $myObj->getResult() . '<br/>';
                echo 'Post Date:' . $myObj->getDates() . '<br/>';
                echo 'Transaction Reference ID:' . $myObj->getRef() . '<br/>';
                echo 'Mrch Track ID:' . $myObj->getTrackId() . '<br/>';
                echo 'Transaction ID:' . $myObj->getTransId() . '<br/>';
                echo 'Transaction Amount:' . $myObj->getAmt() . '<br/>';
                echo 'Payment ID:' . $myObj->getPaymentId() . '<br/>';
            } else {
                print_r($_GET);
                echo 'ErrorText:' . $errorText . '<br/>';
                echo 'Mrch Track ID:' . isset($_GET["trackid"]) ? $_GET["trackid"] : isset($_POST["trackid"]) ? $_POST["trackid"] : "" . '<br/>';
                echo 'Transaction ID:' . isset($_GET["tranid"]) ? $_GET["tranid"] : isset($_POST["tranid"]) ? $_POST["tranid"] : "" . '<br/>';
                echo 'Payment ID:' . $myObj->getTrackId() . '<br/>';
                echo 'Transaction ID:' . isset($_GET["paymentid"]) ? $_GET["paymentid"] : isset($_POST["paymentid"]) ? $_POST["paymentid"] : "" . '<br/>';
            }
        }
    }
    
    public function paymentInquiry($postData){
       
        $currency = '356';
        $language = 'USA';
        $receiptURL = base_url().'homepage/getResponsepaymentInquiry/';
        $errorURL = base_url().'homepage/getResponsepaymentInquiry/';
        $resourcePath = '/home/hcgk8u1dsu89/public_html/phpnormal/cgnfile/';
        $aliasName = 'IPGTEST';
        $rnd = substr(number_format(time() * rand(), 0, '', ''), 0, 10);
        $trackid = $rnd;
        $myObj = new iPay24Pipe();
        $myObj->setResourcePath(trim($resourcePath));
        $myObj->setKeystorePath(trim($resourcePath));
        $myObj->setAlias(trim($aliasName));
        $myObj->setAction(trim('8'));
        $myObj->setCurrency(trim($currency));
        $myObj->setLanguage(trim($language));
        $myObj->setResponseURL(trim($receiptURL));
        $myObj->setErrorURL(trim($errorURL));
        $myObj->setAmt(trim('1.00'));
        
        $myObj->setTypes($postData['type']);
        
        $myObj->setTrackId($trackid);
        $myObj->setTransId($postData['trackID']);
        $myObj->setUdf5('TrackID');
        
        if (trim($myObj->performTransactionHTTP()) != 0) {
            echo("ERROR OCCURED! SEE CONSOLE FOR MORE DETAILS");
            return;
        } else {
            //	header("location:".$myObj->getwebAddress()); 
            $url = trim($myObj->getwebAddress());
            echo "<meta http-equiv='refresh' content='0;url=$url'>";
        }
    }
    
    public function getResponsepaymentInquiry(){
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
// echo $trandata;exit
        if (isset($trandata) && trim($myObj->parseEncryptedRequest(trim($trandata))) != 0) {

            echo 'Error : ' .$myObj->getError();
        } else {
            if ($errorText == null) {
                print_r($myObj);
                die();
//                echo 'Transaction Status:' . $myObj->getResult() . '<br/>';
//                echo 'Post Date:' . $myObj->getDates() . '<br/>';
//                echo 'Transaction Reference ID:' . $myObj->getRef() . '<br/>';
//                echo 'Mrch Track ID:' . $myObj->getTrackId() . '<br/>';
//                echo 'Transaction ID:' . $myObj->getTransId() . '<br/>';
//                echo 'Transaction Amount:' . $myObj->getAmt() . '<br/>';
//                echo 'Payment ID:' . $myObj->getPaymentId() . '<br/>';
            } else {
                print_r($_GET);
                die();
//                echo 'ErrorText:' . $errorText . '<br/>';
//                echo 'Mrch Track ID:' . isset($_GET["trackid"]) ? $_GET["trackid"] : isset($_POST["trackid"]) ? $_POST["trackid"] : "" . '<br/>';
//                echo 'Transaction ID:' . isset($_GET["tranid"]) ? $_GET["tranid"] : isset($_POST["tranid"]) ? $_POST["tranid"] : "" . '<br/>';
//                echo 'Payment ID:' . $myObj->getTrackId() . '<br/>';
//                echo 'Transaction ID:' . isset($_GET["paymentid"]) ? $_GET["paymentid"] : isset($_POST["paymentid"]) ? $_POST["paymentid"] : "" . '<br/>';
            }
        }
    }
    
    public function paymentRefund($postData){
        $currency = '356';
        $language = 'USA';
        $receiptURL = base_url().'homepage/getResponsepaymentRefund/';
        $errorURL = base_url().'homepage/getResponsepaymentRefund/';
        $resourcePath = '/home/hcgk8u1dsu89/public_html/phpnormal/cgnfile/';
        $aliasName = 'IPGTEST';
        $myObj = new iPay24Pipe();
        $rnd = substr(number_format(time() * rand(), 0, '', ''), 0, 10);
        $trackid = $rnd;
        $myObj->setResourcePath(trim($resourcePath));
        $myObj->setKeystorePath(trim($resourcePath));
        $myObj->setAlias(trim($aliasName));
        $myObj->setAction(trim('8'));
        $myObj->setCurrency(trim($currency));
        $myObj->setLanguage(trim($language));
        $myObj->setResponseURL(trim($receiptURL));
        $myObj->setErrorURL(trim($errorURL));
        $myObj->setAmt(trim('1.00'));       
        $myObj->setTypes($postData['type']);        
        $myObj->setTrackId($trackid);
        $myObj->setTransId($postData['transactionID']);
        $myObj->setUdf5('TrackID');
        
        if (trim($myObj->performTransaction()) != 0) {
            echo("ERROR OCCURED! SEE CONSOLE FOR MORE DETAILS");
            return;
        } else {
            //	header("location:".$myObj->getwebAddress()); 
            $url = trim($myObj->getwebAddress());
            echo "<meta http-equiv='refresh' content='0;url=$url'>";
        }
    }
    
    public function getResponsepaymentRefund(){
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
                
                    print_r("HELLO");
                    die();
//                echo 'Transaction Status:' . $myObj->getResult() . '<br/>';
//                echo 'Post Date:' . $myObj->getDates() . '<br/>';
//                echo 'Transaction Reference ID:' . $myObj->getRef() . '<br/>';
//                echo 'Mrch Track ID:' . $myObj->getTrackId() . '<br/>';
//                echo 'Transaction ID:' . $myObj->getTransId() . '<br/>';
//                echo 'Transaction Amount:' . $myObj->getAmt() . '<br/>';
//                echo 'Payment ID:' . $myObj->getPaymentId() . '<br/>';
            } else {
                 print_r("ERROR");
                    die();
//                echo 'ErrorText:' . $errorText . '<br/>';
//                echo 'Mrch Track ID:' . isset($_GET["trackid"]) ? $_GET["trackid"] : isset($_POST["trackid"]) ? $_POST["trackid"] : "" . '<br/>';
//                echo 'Transaction ID:' . isset($_GET["tranid"]) ? $_GET["tranid"] : isset($_POST["tranid"]) ? $_POST["tranid"] : "" . '<br/>';
//                echo 'Payment ID:' . $myObj->getTrackId() . '<br/>';
//                echo 'Transaction ID:' . isset($_GET["paymentid"]) ? $_GET["paymentid"] : isset($_POST["paymentid"]) ? $_POST["paymentid"] : "" . '<br/>';
            }
        }
    }

}
?>