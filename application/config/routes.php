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
// SERVER_ADDR,$_SERVER['REMOTE_ADDR'];
$route['default_controller'] = "pages";
$route['404_override'] = '';
$route['admin'] = "admin/login";
$route['admin/login'] = "admin/login";
$route['admin/add_news'] = "admin/add_news";
$route['admin/edit_news'] = "admin/edit_news";
$route['admin/dashboard'] = "admin/dashboard";
$route['admin/comments']	= "admin/comments";
$route['admin/delete_comment/(:num)'] = "admin/delete_comment/$1";
$route['admin/activate/(:num)'] = "admin/activate/$1";
$route['admin/deactivate/(:num)'] = "admin/deactivate/$1";
$route['admin/approved_comment/(:num)'] = "admin/approved_comment/$1";
$route['admin/reject_comment/(:num)'] = "admin/reject_comment/$1";
$route['admin/news/(:num)'] = "admin/news/$1";
$route['admin/news'] = "admin/news";
$route['admin/update_main_news/(:num)/(:num)'] = "admin/update_main_news/$1/$2";
$route['admin/update_other_news/(:num)/(:num)'] = "admin/update_other_news/$1/$2";
$route['admin/update_popular_news/(:num)/(:num)'] = "admin/update_popular_news/$1/$2";
$route['admin/logout'] = "admin/logout";
$route['headlines'] = "admin/headlines";
$route['admin/delete_headline/(:num)'] = "admin/delete_headline/$1";
$route['admin/edit_headline'] = "admin/edit_headline";
$route['admin/add_headline'] = "admin/add_headline";
$route['admin/contact'] = "admin/contact";
$route['admin/delete_contact/(:num)'] = "admin/delete_contact/$1";
$route['admin/edit_contact'] = "admin/edit_contact";
$route['admin/add_contact'] = "admin/add_contact";
$route['rashifal'] = "admin/rashifal";
$route['admin/edit_rashifal'] = "admin/edit_rashifal";
$route['horoscope-rashifal'] = "Pages/rashifal";
$route['admin/updateProfile'] = "admin/updateProfile";
$route['admin/delete_message/(:num)'] = "admin/delete_message/$1";
$route['admin/update_message_status/(:num)'] = "admin/update_message_status/$1";

$route['home'] = "pages/home";
$route['contact'] = "pages/add_message";
$route['pages/likes'] = "pages/likes";
$route['pages/unlikes'] = "pages/unlikes";
$route['pages/add_comment'] = "pages/add_comment";
$route['(:any)/page/(:num)'] = "pages/news_listing/$1/$2";
$route['(:any)/(:any)'] = "pages/news_detail/$1/$2";
$route['(:any)'] = "pages/news_listing/$1";
// $route['(:any)'] = "pages/news_detail/$1";

// $route['forgot-password'] = "pages/forgot_password";
// $route['reset-password/(:any)'] = "pages/reset_password/$1";
// $route['change-password'] = "pages/change_password";
// $route['share/(:num)'] = "pages/share/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */