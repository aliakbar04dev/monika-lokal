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
$routes->setDefaultController('Home');
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
$routes->get('/', 'Home::index');
$routes->get('getuserlogin', 'User::get');
$routes->get('getuserloginsosmed', 'User::getByMail');
$routes->get('getuserprofile', 'User::getProfile');
$routes->get('getuserexpired', 'User::getExpDate');
$routes->get('getanggotavalid', 'User::getAnggota');
$routes->get('getkomunitasvalid', 'User::getKomunitas');
$routes->get('getreferalvalid', 'User::getReferal');
$routes->get('getaccount', 'Api::userDetail');
$routes->get('getpaymentconfig', 'Api::configPayment');
$routes->get('getjenismember', 'JenisMember::getAll');
$routes->get('getjenistblsakti', 'JenisTblSakti::getAll');
$routes->get('getbanner', 'Banner::getAll');
$routes->get('getnews', 'Pengumuman::getAllNews');
$routes->get('getevents', 'Pengumuman::getAllEvents');
$routes->get('getcategorynews', 'Pengumuman::getCategoryNews');
$routes->get('getcategoryevent', 'Pengumuman::getCategoryEvent');
$routes->get('getnewsbycategory', 'Pengumuman::getNewsByCategory');
$routes->get('geteventbycategory', 'Pengumuman::getEventsByCategory');
$routes->get('getdetailnewsevent', 'Pengumuman::getDetailNewsEvent');
$routes->get('getalltutorial', 'Tutorial::getAllTutorial');
$routes->get('gettutorialpagination', 'Tutorial::getTutorialByLimit');
$routes->get('gettutorialbyid', 'Tutorial::getTutorialById');
$routes->get('getallprice', 'Pricing::getAll');
$routes->get('getallpricenew', 'Pricing::getAllNew');
$routes->get('getpricebylevel', 'Pricing::getByLevel');
$routes->get('getbroacastnotif', 'Notification::getAllBroadcast');
$routes->get('getbroacastrecentnotif', 'Notification::getRecentBroadcast');
$routes->get('getpaymentnotif', 'Notification::getPaymentNotif');
$routes->get('getpayment', 'Payment::getAll');
$routes->get('getpaymentpagination', 'Payment::getAllByLimit');
$routes->get('getpaymentbyinv', 'Payment::getByInv');
$routes->get('getpaymentfilter', 'Payment::getFilter');
$routes->get('getfaq', 'Faq::getAll');
$routes->get('getfiltervideo', 'FilterMedia::getVideo');
$routes->get('getfiltergallery', 'FilterMedia::getGallery');
$routes->get('getvideo', 'Media::getVideo');
$routes->get('getgallery', 'Media::getGallery');
$routes->get('gettblsakti', 'TblSakti::getByDate');
$routes->get('gettblsaktipaging', 'TblSakti::getByLimit');
$routes->get('getfactsheet', 'Factsheet::getByYear');
$routes->post('getchartta', 'TeknikalAnalisis::getChart');
$routes->get('getdescchartta', 'TeknikalAnalisis::getDescChartTa');
$routes->post('getnewchartta', 'TeknikalAnalisis::getChartNew');
$routes->post('getchartfa', 'FundamentalAnalisis::getChart');
$routes->post('getnewchartfa', 'FundamentalAnalisis::getChartNew');
$routes->get('getfilterta', 'TeknikalAnalisis::getTable');
$routes->get('getfilterfa', 'FundamentalAnalisis::getTable');
$routes->get('getimeicode', 'Imei::getImei');
$routes->get('getcommchartta', 'ListChartTa::getAll');
$routes->get('getcommchartfa', 'ListChartFa::getAll');
$routes->get('getintervalchartta', 'ListIntervalTa::getAll');
$routes->get('getintervalchartfa', 'ListIntervalFa::getAll');
$routes->post('gentoken', 'Api::token');
$routes->post('postcontact', 'ContactUs::insert');
$routes->post('postuserregister', 'User::insert');
$routes->post('postuserregisterwithmailverify', 'User::insertWithMail');
$routes->post('postvalidasipassword', 'Email::resetpassword');
$routes->post('postvalidasiregister', 'Sms::register');
$routes->post('postvalidasichangephone', 'Sms::resetphone');
$routes->post('postchangephone', 'Sms::resetphoneWithoutOTP');
$routes->post('postpaymentnotif', 'Notification::insert');
$routes->post('postpayment', 'Payment::insert');

$routes->put('putuserprofile/(:segment)', 'User::edit/$1');
$routes->put('putuserpassword/(:segment)', 'User::changePassword/$1');
$routes->put('putuserphone/(:segment)', 'User::changePhone/$1');
$routes->put('putuseremail/(:segment)', 'User::changeEmail/$1');
$routes->put('putusercoperation/(:segment)', 'User::updateAnggota/$1');
$routes->put('putusercommunity/(:segment)', 'User::updateKomunitas/$1');
$routes->put('putuseractivated/(:segment)', 'User::activateuser/$1');
$routes->put('putuseraccess/(:segment)', 'User::editLastAccess/$1');
$routes->put('putuserfiretoken/(:segment)', 'User::changeToken/$1');
$routes->put('putusernotifsetting/(:segment)', 'User::changeNotif/$1');
$routes->put('putuserpinsetting/(:segment)', 'User::changePin/$1');

// created by ali
$routes->post('updateuserphotoprofile', 'User::editPhotoProfile');
$routes->post('updateveremailmob', 'User::isVeriefiedEmail');

$routes->put('putpaymentstatus/(:segment)', 'Payment::edit/$1');
$routes->put('putpaymentlink/(:segment)', 'Payment::editlink/$1');
$routes->put('deleteusercoperation/(:segment)', 'User::deleteAnggota/$1');
$routes->put('deleteusercommunity/(:segment)', 'User::deleteKomunitas/$1');
$routes->put('putimeicode/(:segment)', 'Imei::changeImei/$1');

$routes->get('getapistock/(:any)/(:any)', 'Apistockreview::fGetStart/$1/$2');
$routes->get('gettimeline', 'Apistockreview::getTimeline');
$routes->get('getsystemtrade', 'Apistockreview::getSystemTrade');
$routes->get('getintervalwatchlist', 'Apistockreview::getIntervalWatchlist');
$routes->get('gettickerwatchlist', 'Apistockreview::getTickerWatchlist');
$routes->get('getsmartwatchlist', 'Apistockreview::getWatchlist');
$routes->get('getsmartwatchlisttes', 'Apistockreview::getWatchlistTes');
$routes->post('postsmartwatchlist', 'Apistockreview::insertWatchlist');

$routes->post('postnotification', 'Notifikasi::sendNotif');

$routes->delete('deletesmartwatchlist/(:segment)', 'Apistockreview::deleteWatchlist/$1');
$routes->delete('deleteuser/(:segment)', 'User::deleteUser/$1');

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
