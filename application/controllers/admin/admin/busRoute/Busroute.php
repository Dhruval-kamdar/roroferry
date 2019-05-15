<?php

/**
 * 
 */
class Busroute extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
	      if (isset($this->session->userdata['roroferry_admin'])) {
                  $data['title']='Roroferry - Bus Route';
                  $data['meta']='Roroferry - Bus Route';
                  $data['page'] = PAGES.'busroute/busroute-list'; 
                  $data['pagetitle'] = 'Bus Route List';  
                  $data['busroute'] = "active";  
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