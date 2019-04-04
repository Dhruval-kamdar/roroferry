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


	}

?>