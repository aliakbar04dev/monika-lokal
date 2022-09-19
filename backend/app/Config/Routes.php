<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
//$routes->setDefaultController('Home');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->get('/', 'Login::index');
//$routes->addPlaceholder('msg', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/%');
//$routes->get('/apinotif/(:msg)', 'MyApi::index/$1');
$routes->get('/apinotif', 'MyApi::index');
$routes->get('/smsservice/(:segment)/(:any)', 'MyApi::otpsms/$1/$2');
$routes->get('/admdashboard', 'Dashboard::index');

$routes->get('/admbillinginv', 'Billing/Invoicecontroller::index');
$routes->post('/admbillinginvfilter', 'Billing/Invoicecontroller::filterdata');

$routes->get('/adminfotype', 'Information/Typecontroller::index');
$routes->get('/adminfocat', 'Information/Categorycontroller::index');
$routes->get('/adminfonews', 'Information/Newscontroller::index');
$routes->get('/adminfobursaemiten', 'Information/Bursaemitencontroller::index');
$routes->get('/adminfotutorial', 'Information/Tutorialcontroller::index');
$routes->get('/adminfofaq', 'Information/Faqcontroller::index');

$routes->get('/admfeaturesjenistsakti', 'Features/Jenistsakticontroller::index');
$routes->get('/admfeaturestsakti', 'Features/Tsakticontroller::index');
$routes->get('/admfeaturespoin', 'Features/Poincontroller::index');
$routes->get('/admfeaturesreff', 'Features/Referalcontroller::index');
$routes->get('/admfeaturespoindetail', 'Features/Poincontroller::detaildata');
$routes->post('/admfeaturespoinfilter', 'Features/Poincontroller::filterdata');
$routes->post('/admfeaturesrefffilter', 'Features/Referalcontroller::filterdata');
$routes->get('/admultimateaccess', 'Features/Ultimatecontroller::index'); 

$routes->get('/admultimatedaily', 'Ultimate/Dailycontroller::index'); 
$routes->get('/admultimatedailyact', 'Ultimate/Dailyactcontroller::index'); 
$routes->get('/admultimatedailychart', 'Ultimate/Dailychartcontroller::index'); 
$routes->get('/admultimatedailyclosed', 'Ultimate/Dailyclosedcontroller::index'); 
$routes->get('/admultimatetrail', 'Ultimate/Trailingcontroller::index');
$routes->get('/admultimatetrailclosed', 'Ultimate/Trailingclosedcontroller::index');
$routes->get('/admultimatetrailact', 'Ultimate/Trailingactcontroller::index');  
$routes->get('/admultimatewtcaction', 'Ultimate/Wtcactioncontroller::index'); 
$routes->get('/admultimatewtcdata', 'Ultimate/Wtcdatacontroller::index'); 
$routes->get('/admultimateopenpos', 'Ultimate/Openposcontroller::index'); 
$routes->get('/admultimateclosepos', 'Ultimate/Closeposcontroller::index');
$routes->get('/admultimatecopyact', 'Ultimate/Copyactcontroller::index'); 
$routes->get('/admultimatefactsheet', 'Ultimate/Factsheetcontroller::index');


$routes->get('/admpackagediscount', 'Package/Disccontroller::index');
$routes->get('/admpackageprice', 'Package/Pricecontroller::index');

$routes->get('/admaccountuserlevel', 'Account/Userlevelcontroller::index');
$routes->get('/admaccountmember', 'Account/Membercontroller::index');
$routes->get('/admaccountadministrator', 'Account/Administratorcontroller::index');
$routes->get('/admaccountuser', 'Account/Usercontroller::index');
// $routes->get('/admaccountexportexcelview', 'Account/Usercontroller::getexcelview');
$routes->get('/admaccountexportexcel', 'Account/Usercontroller::getexcel');
$routes->get('/admmasteranggota', 'Account/Master/Anggotacontroller::index');
$routes->get('/admmasterkomunitas', 'Account/Master/Komunitascontroller::index');
$routes->get('/admmasterreferal', 'Account/Master/Referalcontroller::index');

$routes->get('/admmediafilter', 'Media/Filtermedcontroller::index');
$routes->get('/admmediasubmedia', 'Media/Filtersubmedcontroller::index');
$routes->get('/admmediaimage', 'Media/Imagemedcontroller::index');
$routes->get('/admmediavideonew', 'Media/Videomednewcontroller::index');
$routes->get('/admmediavideo', 'Media/Videomedcontroller::index');

$routes->get('/admfeedbackquestion', 'Feedback/Questioncontroller::index');
$routes->get('/admfeedbacksubscribe', 'Feedback/Subscribercontroller::index');

$routes->get('/admsettingbanner', 'Setting/Bannercontroller::index');
$routes->get('/admsettingbenefit', 'Setting/Benefitcontroller::index');
$routes->get('/admsettingcustom', 'Setting/Customcontroller::index');

$routes->get('/admcareercategory', 'Career/CategorycarController::index');
$routes->get('/admcareerdepartment', 'Career/DepartmentcarController::index');
$routes->get('/admcareerlocation', 'Career/LocationcarController::index');
$routes->get('/admcareervacancy', 'Career/VacancyController::index');
$routes->get('/admcareerapplied', 'Career/AppliedController::index');
$routes->get('/admcareertestimoni', 'Career/TestimoniController::index');

$routes->get('/admchartta', 'Chart/ChartTaController::index');
$routes->get('/admintervalta', 'Chart/IntervalTaController::index');
$routes->get('/admintervalta', 'Chart/IntervalTaController::index');


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
