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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//web
$route['login'] = 'welcome/login';
$route['register'] = 'welcome/register';
$route['logout'] = 'welcome/logout';

//web api
$route['api/register'] = 'api/web/register';
$route['api/login'] = 'api/web/login';


//user
$route['company'] = 'company/main/index';
$route['company/coach'] = 'company/coach/index';
$route['company/coach/add'] = 'company/coach/add';
$route['company/coach/edit/(:num)'] = 'company/coach/edit/$1';
$route['company/athlete'] = 'company/athlete/index';
$route['company/athlete/add'] = 'company/athlete/add';
$route['company/athlete/edit/(:num)'] = 'company/athlete/edit/$1';
$route['company/profile'] = 'company/main/profile';


//user api
$route['api/company/coach'] = 'api/company/getCoach';
$route['api/company/coach/add'] = 'api/company/addCoach';
$route['api/company/coach/edit'] = 'api/company/editCoach';
$route['api/company/profile/edit'] = 'api/company/editProfile';
$route['api/company/athlete'] = 'api/company/getAthlete';
$route['api/company/athlete/add'] = 'api/company/addAthlete';
$route['api/company/athlete/edit'] = 'api/company/editAthlete';


//coach
$route['coach'] = 'coach/main/index';
$route['coach/athlete'] = 'coach/athlete/index';
$route['coach/athlete/add'] = 'coach/athlete/add';
$route['coach/athlete/edit/(:num)'] = 'coach/athlete/edit/$1';
$route['coach/athlete/view/(:num)/(:num)'] = 'coach/athlete/view/$1/$2';
$route['coach/athlete/workout/add/(:num)'] = 'coach/workout/add/$1';
$route['coach/athlete/workout/edit/(:num)'] = 'coach/workout/edit/$1';
$route['coach/athlete/diet/add/(:num)'] = 'coach/diet/add/$1';
$route['coach/athlete/diet/edit/(:num)'] = 'coach/diet/edit/$1';
$route['coach/profile'] = 'coach/main/profile';

//coach api
$route['api/coach/athlete'] = 'api/coach/getAthlete';
$route['api/coach/addWorkout'] = 'api/coach/addWorkout';
$route['api/coach/addDiet'] = 'api/coach/addDiet';
$route['api/coach/getWorkout'] = 'api/coach/getWorkout';
$route['api/coach/getDiet'] = 'api/coach/getDiet';


//athlete
$route['athlete'] = 'athlete/main/index';
$route['athlete/profile'] = 'athlete/main/profile';
$route['athlete/workouts'] = 'athlete/main/workouts';


//athlete api
$route['api/athlete/workouts'] = 'api/athlete/getworkouts';