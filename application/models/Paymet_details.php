<?php

class Paymet_details extends My_model {

    function __construct() {
        parent::__construct();
    }

    public function adddetails($postData) {
        $data['table'] = 'payment_details';
        $data['insert'] = [
            'firstname' => $postData['firstname'],
            'lastname' => $postData['lastname'],
            'email' => $postData['email'],
            'mobileno' => $postData['mobileno'],
            'amount' => $postData['amount'],
            'note' => $postData['note'],
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
        ];
        $result = $this->insertRecord($data);
        return $result;
    }
    
    public function getpaymentDetails($id){
        $data['table'] = 'payment_details';
        $data['select']=['firstname','lastname','email','mobileno','amount','note'];
        $data['where']=['id'=>$id];
        $result = $this->selectRecords($data);
        return $result;
    }
    public function paymnetSuccess($paymentDetails){
        $data['table']='payment_details';
        $data['where'] = ['id' => $paymentDetails['id']];
        $data['update']=[
            'transaction_id'=>$paymentDetails['transaction_id'],
            'payment_detail'=> json_encode($paymentDetails),

        ];
        $result = $this->updateRecords($data);
    }

}

?>