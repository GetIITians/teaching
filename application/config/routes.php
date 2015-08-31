<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['wiziq_status'] 			=	"welcome/wiziq_status";
$route['narayan'] 				=	"welcome/narayan";
$route['rating/:any'] 			=	"welcome/rating";
$route['rating'] 				=	"welcome/rating";
$route['reviews'] 				=	"welcome/reviews";
$route['termsofuse'] 			=	"welcome/termsofuse";
$route['privacypolicy'] 		=	"welcome/privacypolicy";
$route['hiring'] 				=	"welcome/hiring";
$route['studentprofile'] 		=	"welcome/studentprofile";

$route['deleteFile'] 			=	"welcome/deleteFile";
$route['myslots'] 				=	"welcome/myslots";
$route['review'] 				=	"welcome/review";
$route['account']				=	"welcome/account";
$route['changepassword'] 		=	"welcome/changepassword";

$route['forgotPassword'] 		=	"welcome/forgotPassword";
$route['confirmSlots'] 			=	"welcome/confirmSlots";
$route['testCSV'] 				=	"welcome/testCSV";
$route['compareMany'] 			=	"welcome/compareMany";
$route['view'] 					=	"welcome/view";

$route['reject'] 				=	"welcome/reject";
$route['accept'] 				=	"welcome/accept";
$route['acceptOrReject'] 		=	"welcome/acceptOrReject";
$route['search'] 				=	"welcome/search";
$route['edit'] 					=	"welcome/edit";

$route['profile'] 				=	"welcome/profile";
$route['profile/:num'] 			=	"welcome/profile";
$route['profile/:num/:num']		=	"welcome/profile";
$route['topics'] 				=	"welcome/topics";
$route['cal'] 					=	"welcome/cal";
$route['signup']				=	"welcome/signup";
$route['login'] 				=	"welcome/login";

$route['joinusreal'] 			=	"welcome/joinusreal";
$route['contactus'] 			=	"welcome/contactus";
$route['reset'] 				=	"welcome/reset";
$route['joinus'] 				=	"welcome/joinus";
$route['aboutus'] 				=	"welcome/aboutus";

$route['index'] 				=	"welcome/index";
$route['default_controller'] 	=	"welcome";
$route['404_override'] 			=	'';


/* End of file routes.php */
/* Location: ./application/config/routes.php */