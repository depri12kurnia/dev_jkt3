<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

$route['default_controller'] = 'home';
// $route['default_controller'] = 'captcha';
// Routing Maintenance
// $route['default_controller'] = 'maintenance';

$route['404_override'] = 'home/oops';
$route['translate_uri_dashes'] = FALSE;
// ROuting Sitemap
$route['sitemap/alumni\.xml'] = 'sitemap/alumni';
$route['sitemap/berita\.xml'] = 'sitemap/berita';
$route['sitemap/pendidikan\.xml'] = 'sitemap/pendidikan';
$route['sitemap/prodi\.xml'] = 'sitemap/prodi';
$route['sitemap/tentang\.xml'] = 'sitemap/tentang';
$route['sitemap/custom\.xml'] = 'sitemap/custom';

// route untuk halaman kategori berita
$route['kategori/(:any)'] = 'berita/kategori/$1';
$route['kategori/(:any)/(:num)'] = 'berita/kategori/$1/$s2';

// route controller dokumen ke seafile
$route['admin/dokumen/(:any)'] = 'admin/dokumen/detail/$1';

// route untuk jurusan
$route['jurusan'] = 'jurusan/listing';
$route['jurusan/search'] = 'jurusan/search';
$route['jurusan/([a-zA-Z0-9-]+)/prodi/([a-zA-Z0-9-]+)'] = 'jurusan/prodi/$1/$2';
$route['jurusan/([a-zA-Z0-9-]+)'] = 'jurusan/index/$1';

// route untuk unit
$route['unit'] = 'unit/listing';
$route['unit/search'] = 'unit/search';
$route['unit/([a-zA-Z0-9-]+)/prodi/([a-zA-Z0-9-]+)'] = 'unit/prodi/$1/$2';
$route['unit/([a-zA-Z0-9-]+)'] = 'unit/index/$1';

// route untuk pusat
$route['pusat'] = 'pusat/listing';
$route['pusat/search'] = 'pusat/search';
$route['pusat/([a-zA-Z0-9-]+)/prodi/([a-zA-Z0-9-]+)'] = 'pusat/prodi/$1/$2';
$route['pusat/([a-zA-Z0-9-]+)'] = 'pusat/index/$1';
