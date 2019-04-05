<?php 
class Booking_model extends My_model
{
    public function route(){
        $data['table']='route_list';
        $data['select']=['id','route'];
        $data['where']=['is_active'=>'active'];
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
        $data['table']='station_list';
        $data['select']=['id','time','stationName'];
        $data['where']=['routeId'=>$postData['routeId'],'forTime'=>$postData['tripTimeId'],'stationType'=>'drop'];
        $res=$this->selectRecords($data);        
        return $res;
    }
}
?>