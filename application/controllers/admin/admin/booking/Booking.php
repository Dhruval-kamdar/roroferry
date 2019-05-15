<?php

/**
 * 
 */
class Booking extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
	      if (isset($this->session->userdata['roroferry_admin'])) {
                  $data['title']='Roroferry - Booking';
                  $data['meta']='Roroferry - Booking';
                  $data['page'] = PAGES.'booking/booking-list'; 
                  $data['pagetitle'] = 'Booking List';  
                  $data['booking'] = "active";  
                  $data['js'] = array(
                  );
                  $data['js_plugin'] = array(
                  );
                  $data['css'] = array(            
                  );
                  $data['css_plugin'] = array(
                  );
                  $data['init'] = array(  
                  );
                  $this->load->view(ADMINLAYOUT, $data); 
            }else{
                   redirect(base_url());
            }   
	}
}

?>