<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'homepage/index';
//$route['default_controller'] = 'account/zz';
$route['register'] = 'account/register';
$route['contact'] = 'front/contact';
$route['payment-inquiry'] = 'homepage/paymentInquiry';
$route['pay-now'] = 'Paynow/index';
$route['confirm-payment'] = 'Paynow/confirmpayment';
$route['makePayment'] = 'Paynow/makePayment';

$route['payment-refund'] = 'homepage/paymentRefund';
/* START BY JIGNESH */
$route['login'] = 'account/login';
$route['home'] = 'account/home';

$route['dashboard'] = 'account/dashboard';
$route['trip-detail'] = 'homepage/getTrips';
$route['get-cargo-trips'] = 'homepage/GetCargoTrips';
$route['get-class'] = 'homepage/GetClass';
$route['get-trip-time'] = 'homepage/GetTripTime';
$route['get-trip-pickUp'] = 'homepage/GetTripPickUpStaion';
$route['get-trip-drop'] = 'homepage/GetTripDropStaion';
$route['get-without-cargo-trips'] = 'homepage/GetWithoutCargoTrips';
$route['get-booking'] = 'homepage/GetBooking';
$route['get-cargo-booking'] = 'homepage/GetCargoBooking';
$route['get-withoutcargo-booking'] = 'homepage/getWithoutcargoBooking';
$route['updateCargoPassengerDetails'] = 'homepage/updateCargoPassengerDetails';

$route['get-pickup-detail'] = 'homepage/getPickupDetail';
$route['get-total-number-seat'] = 'homepage/getTotalNumberSeat';
$route['get-all-seat'] = 'homepage/getTotalSeat';
$route['submit-booking'] = 'homepage/submitBooking';
$route['payment'] = 'homepage/makePayment';
$route['payment-compelete'] = 'homepage/paymentCompelete';
$route['generate-ticket-pdf'] = 'homepage/generateTicketPdf';
$route['send-mail'] = 'homepage/sendConfirmMail';
$route['terms-condition'] = 'homepage/termsCondition';
$route['refund-cancellation'] = 'homepage/refundCancellation';
$route['privacy-policy'] = 'homepage/privacyPolicy';
$route['a_booking']='homepage/a_booking';
$route['A_UpdateCargoPassengerDetails']='homepage/A_UpdateCargoPassengerDetails';
$route['confirmCargoBooking']='homepage/confirmCargoBooking';
$route['withoutcargoconfirmCargoBooking']='homepage/withoutcargoconfirmCargoBooking';


//*******************************Admin Route *****************************************//
$route['admin'] = 'admin/login';


$route['dashboard'] = 'admin/admin/dashborad';
$route['agent-dashboard'] = 'admin/agent/dashborad';

//*******************************Admin Bus Route *****************************************//
$route['busRoute-ajaxcall'] = 'admin/admin/busRoute/busroute/ajaxcall';
$route['bus-route'] = 'admin/admin/busRoute/busroute';
$route['add-route'] = 'admin/admin/busRoute/busroute/addRoute';
$route['deleteRoute'] = 'admin/admin/busRoute/busroute/deleteRoute';
$route['edit-route/(:any)'] = 'admin/admin/busRoute/busroute/editRoute/$1';

//*******************************Admin station Route *****************************************//
$route['station'] = 'admin/admin/station/station';
$route['station-ajaxcall'] = 'admin/admin/station/station/ajaxcall';
$route['add-station'] = 'admin/admin/station/station/addstation';
$route['edit-station/(:any)'] = 'admin/admin/station/station/editstation/$1';
$route['deleteStation'] = 'admin/admin/station/station/deleteStation';
$route['routeTimeList'] = 'admin/admin/station/station/routeTimeList';

//*******************************Admin booking Route *****************************************//
$route['booking'] = 'admin/admin/booking/booking';
$route['booking-ajaxcall'] = 'admin/admin/booking/booking/ajaxcall';
$route['report-pdf'] = 'admin/admin/booking/booking/reportPdf';

$route['test-pdf'] = 'homepage/testpdf';
//$route['payment-inquiry'] = 'homepage/paymentInquiry';
/* END BY JIGNESH */

$route['logout'] = 'admin/login/logout';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


