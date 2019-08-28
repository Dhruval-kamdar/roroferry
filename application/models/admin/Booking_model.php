<?php 

class Booking_model extends My_model{
    
    function __construct() {
        parent::__construct();
    }
    
    public function bookingList(){
        
           $this->db->select("TPD.seatNo,TPD.ticketId,TTB.ferryTime,TTB.transaction_id,TPD.passangerName,TPD.passangerAge,TPD.passangerGender,TTB.pnrNumber,TTB.depatureDate,TRL.route,TTB.busRoute,TSL.stationName as pickUpStation,TSL.time as pickupTime,TSLD.time as dropTime,TSLD.stationName as dropStation,TTB.phoneNumber"); 
           $this->db->from(TBL_PASSANGER_DETAILS.' as TPD');  
           $this->db->join(TBL_TICKET_DETAILS.' as TTB','TTB.id = '.'TPD.ticketId','LEFT');
           $this->db->join(TBL_ROUTE_LIST.' as TRL','TRL.id = '.'TTB.busRoute','LEFT');
           $this->db->join(TBL_STATION_LIST.' as TSL','TSL.id = '.'TTB.tripPickUpTime','LEFT');
           $this->db->join(TBL_STATION_LIST.' as TSLD','TSLD.id = '.'TTB.tripDropTime','LEFT');
           $this->db->where('transaction_id !=', NULL);
           $this->db->where('transaction_id !=', '');
           if(isset($_POST["search"]["value"]))  
           {  
//               $this->db->like(TBL_ROUTE_LIST.'.route', $_POST["search"]["value"]);
           }  
           if(isset($_POST["order"]))  
           {  
//                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
//                $this->db->order_by(TBL_ROUTE_LIST.'.id', 'DESC');  
           }
           
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }
           $query = $this->db->get();
           return $query->result();
        }
        
        public function get_filtered_data(){  
           $this->bookingList();  
//           $this->db->select("TPD.ticketId,TPD.passangerName,TPD.passangerAge,TPD.passangerGender,TTB.pnrNumber,TTB.depatureDate,TRL.route,TTB.busRoute,TSL.stationName as pickUpStation,TSL.time as pickupTime,TSLD.time as dropTime,TSLD.stationName as dropStation,TTB.phoneNumber"); 
           $this->db->from(TBL_PASSANGER_DETAILS.' as TPD');  
           $this->db->join(TBL_TICKET_DETAILS.' as TTB','TTB.id = '.'TPD.ticketId','LEFT');
           $this->db->join(TBL_ROUTE_LIST.' as TRL','TRL.id = '.'TTB.busRoute','LEFT');
           $this->db->join(TBL_STATION_LIST.' as TSL','TSL.id = '.'TTB.tripPickUpTime','LEFT');
           $this->db->join(TBL_STATION_LIST.' as TSLD','TSLD.id = '.'TTB.tripDropTime','LEFT');
           $this->db->where('transaction_id !=', NULL);
           $this->db->where('transaction_id !=', '');
           $query = $this->db->get();
           return $query->num_rows();  
        } 
        
        public function get_all_data()  
        {  
            $this->db->select("TPD.ticketId,TTB.transaction_id,TTB.ferryTime,TPD.passangerName,TPD.passangerAge,TPD.passangerGender,TTB.pnrNumber,TTB.depatureDate,TRL.route,TTB.busRoute,TSL.stationName as pickUpStation,TSL.time as pickupTime,TSLD.time as dropTime,TSLD.stationName as dropStation,TTB.phoneNumber"); 
            $this->db->from(TBL_PASSANGER_DETAILS.' as TPD');  
            $this->db->join(TBL_TICKET_DETAILS.' as TTB','TTB.id = '.'TPD.ticketId','LEFT');
            $this->db->join(TBL_ROUTE_LIST.' as TRL','TRL.id = '.'TTB.busRoute','LEFT');
            $this->db->join(TBL_STATION_LIST.' as TSL','TSL.id = '.'TTB.tripPickUpTime','LEFT');
            $this->db->join(TBL_STATION_LIST.' as TSLD','TSLD.id = '.'TTB.tripDropTime','LEFT');
            $this->db->where('transaction_id !=', NULL);
           $this->db->where('transaction_id !=', '');
            return $this->db->count_all_results();  
        } 
        
        public function routeList(){
           $this->db->select(TBL_ROUTE_LIST.".*"); 
           $this->db->from(TBL_ROUTE_LIST);  
           $this->db->join(TBL_TRIP_TIME,TBL_TRIP_TIME.'.routeId = '.TBL_ROUTE_LIST.'.id','LEFT');
           $this->db->group_by(TBL_TRIP_TIME.'.routeId'); 
           $query = $this->db->get();
           return $query->result();
        }
        
        public function reportDetails($postData){
            
            $this->db->select("TPD.seatNo,TPD.ticketId,TTB.transaction_id,TTB.ferryTime,TPD.passangerName,TPD.passangerAge,TPD.passangerGender,TTB.pnrNumber,TTB.depatureDate,TRL.route,TTB.busRoute,TSL.stationName as pickUpStation,TSL.time as pickupTime,TSLD.time as dropTime,TSLD.stationName as dropStation,TTB.phoneNumber"); 
            $this->db->from(TBL_PASSANGER_DETAILS.' as TPD');  
            $this->db->join(TBL_TICKET_DETAILS.' as TTB','TTB.id = '.'TPD.ticketId','LEFT');
            $this->db->join(TBL_ROUTE_LIST.' as TRL','TRL.id = '.'TTB.busRoute','LEFT');
            $this->db->join(TBL_STATION_LIST.' as TSL','TSL.id = '.'TTB.tripPickUpTime','LEFT');
            $this->db->join(TBL_STATION_LIST.' as TSLD','TSLD.id = '.'TTB.tripDropTime','LEFT');
            $this->db->where('depatureDate ', date('Y-m-d',strtotime($postData['date'])));
            $this->db->where('busRoute', $postData['route']);
//            $this->db->where('ferryTime', $postData['ferryTime']);
            $this->db->where('transaction_id !=', NULL);
           $this->db->where('transaction_id !=', '');
            $this->db->order_by("TSL.id,TPD.seatNo", "asc");
            $query = $this->db->get();
            return $query->result();
        }
        
        public function route($id){
            $data['select']=['route'];
            $data['table']=TBL_ROUTE_LIST;
            $data['where']=['id'=>$id];
            $result= $this->selectRecords($data);
            return $result[0]->route;
        }
     
}?>