<?php

/**
 * 
 */
class Booking extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
                $this->load->model(BOOKING_MODEL,'this_model');                
                $this->load->library('Pdf');
	}

	public function index(){
	      if (isset($this->session->userdata['roroferry_admin'])) {
                  
                  $data['route']= $this->this_model->routeList();
                  
                  $data['title']='Roroferry - Booking';
                  $data['meta']='Roroferry - Booking';
                  $data['page'] = PAGES.'booking/booking-list'; 
                  $data['pagetitle'] = 'Booking List';  
                  $data['booking'] = "active";  
                  $data['js'] = array(
                    'ajaxfileupload.js',
                    'jquery.form.min.js',
                    'booking.js',
                  );
                  $data['js_plugin'] = array(
                  );
                  $data['css'] = array(            
                  );
                  $data['css_plugin'] = array(
                  );
                  $data['init'] = array( 
                      'Booking.Init()',
                  );
                  $this->load->view(ADMINLAYOUT, $data); 
            }else{
                   redirect(base_url());
            }   
	}
        
        public function reportPdf(){
            $details=$this->input->post();
            $data['date']=$details['date'];
            $data['route']=$details['route'];
            $data['ferryTime']=$details['ferryTime'];
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $data['routeName']=  $this->this_model->route($details['route']);
            $data['passangerDetails']=  $this->this_model->reportDetails($details);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('TCPDF Example 006');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $lg = Array();
            $lg['a_meta_charset'] = 'UTF-8';
            $lg['a_meta_dir'] = 'rtl';
            $lg['a_meta_language'] = 'fa';
            $lg['w_page'] = 'page';
            $pdf->setLanguageArray($lg);
            $pdf->SetFont('freeserif', '', 10);
            $pdf->AddPage();
            $pdf->setRTL(false);
            $new_html = $this->load->view(PAGES.'booking/reportPdf', $data,true);
            $pdf->WriteHTML($new_html, true, 0, true, 0);
            ob_end_clean();  
            $pdf->Output(FCPATH.'public/uploads/reportPdf/'.'Report'.$data['date'].'.pdf', 'F');
            echo base_url().'public/uploads/reportPdf/'.'Report'.$data['date'].'.pdf' ;
            exit();
        }

                public function ajaxcall(){
            $action= $this->input->post('action');
            switch ($action) {
                
                case 'bookingList':
                    $fetch_data= $this->this_model->bookingList();
                   
                    $data =[];
                    $no =0;
                    foreach($fetch_data as $row)  
                    {  
                       $no++;
                       
                        $sub_array = array();
                        $sub_array[] = $no; 
                        $sub_array[] = $row->pnrNumber;
                        $sub_array[] = $row->seatNo;
                        $sub_array[] = $row->route;
                        $sub_array[] = date("d-m-Y" , strtotime($row->depatureDate));
                        $sub_array[] = $row->ferryTime;  
                        $sub_array[] = $row->pickupTime; 
                        $sub_array[] = $row->pickUpStation; 
                        $sub_array[] = $row->dropTime; 
                        $sub_array[] = $row->dropStation; 
                        $sub_array[] = $row->phoneNumber;
                        $sub_array[] = $row->passangerName; 
                        $sub_array[] = $row->passangerGender; 
                        $sub_array[] = $row->passangerAge;
                        $sub_array[] = $row->transaction_id;
                        $data[] = $sub_array;  
                    }  
            
                    $output = array(  
                         "draw"               =>     intval($_POST["draw"]),  
                         "recordsTotal"       =>     $this->this_model->get_all_data(),  
                         "recordsFiltered"    =>     $this->this_model->get_filtered_data(),  
                         "data"               =>     $data  
                    );
                    echo json_encode($output);
                    break;
            }
            
        }
}

?>