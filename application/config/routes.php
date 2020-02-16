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
$route['default_controller'] = 'contractor';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'contractor/logout';
//route owner
$route['owner/signup'] = 'contractor/regis_owner';
$route['owner/dashboard'] = 'contractor/owner_board';
$route['owner/dashboard/proyek'] = 'contractor/owner_monitoring';
$route['owner/dashboard/edit-proyek'] = 'contractor/owner_edit_proyek';
$route['owner/profil'] = 'contractor/owner_profil';
$route['owner/profil/edit-profil'] = 'contractor/owner_edit_profil';
$route['owner/dashboard/buat-pengawas'] = 'contractor/regis_pengawas';
$route['owner/dashboard/edit-pengawas'] = 'contractor/owner_edit_pengawas';
//route kontraktor
$route['kontraktor/signup'] = 'contractor/regis_kontraktor';
$route['kontraktor/dashboard'] = 'contractor/kontraktor_board';
$route['kontraktor/profil'] = 'contractor/kontraktor_profil';
$route['kontraktor/profil/edit-profil'] = 'contractor/kontraktor_edit_profil';
$route['kontraktor/dashboard/proyek'] = 'contractor/kontraktor_data_proyek';
$route['kontraktor/dashboard/update-proyek'] = 'contractor/kontraktor_submit_proyek';
//route pengawas
$route['pengawas/dashboard'] = 'contractor/pengawas_board';
$route['pengawas/dashboard/laporan-proyek'] = 'contractor/pengawas_lihat_laporan';
$route['pengawas/profil'] = 'contractor/pengawas_profil';
$route['pengawas/profil/edit-profil'] = 'contractor/pengawas_edit_profil';