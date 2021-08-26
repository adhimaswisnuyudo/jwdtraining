<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'account/login';
$route['dologin'] = 'account/dologin';
$route['logout'] = 'account/logout';

// route untuk admin
$route['adm'] = 'Admin/index';

// route untuk user
$route['usr'] = 'User/index';