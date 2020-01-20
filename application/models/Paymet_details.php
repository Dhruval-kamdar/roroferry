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

}

?>