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
$route['default_controller'] = 'user/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'user/login';
$route['sign_in'] = 'user/sign_in';
$route['register'] = 'user/register';
$route['sign_up'] = 'user/sign_up';
$route['forgot_password'] = 'user/forgot_password';
$route['register_success'] = 'user/register_success';
$route['verify'] = 'user/verify';
$route['info'] = 'user/info';
$route['change_password'] = 'user/change_password_form';
$route['error_permission'] = 'user/error_permission';
$route['logout'] = 'user/logout';
$route['loginFB'] = 'user/loginFB';
$route['gohome'] = 'user/gohome';
$route['update'] = 'user/updateLink';
$route['checkLogin'] = 'user/checkLogin';
$route['user/update-mobile'] = 'user/updateMobile';
$route['user/add-email'] = 'user/fb_add_email';
$route['user/fb-add-email'] = 'user/add_email';
$route['verify-fb'] = 'user/verify_fb';
$route['send-mail-success'] = 'user/send_mail_success';
