<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Landing_page');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// if (!in_array($_SERVER['HTTP_X_FORWARDED_FOR'], maintenance_ip) && maintenance_status) {
// 	$routes->add('getmidtransnotiftest', 'Notification::midtransnotiftest');
// 	$routes->add('getmidtransnotif', 'Notification::midtransnotif');
// 	$routes->get('/', 'Error::maintenance');
// 	$routes->add('(:any)', 'Error::maintenance');
// }

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->get('/', 'Landing_page::index');
$routes->get('/tes', 'Landing_page::tes');
$routes->add('/tesshow', 'Landing_page::tampil');

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

$routes->add('email_check', 'Register::checkEmail');
$routes->add('daftar_baru', 'Register::newRegistration');
$routes->add('autoregister', 'Register::autonewRegistration');
$routes->add('refcode', 'Register::cekrefcode');
$routes->add('aktivasi/(:alphanum)', 'Register::aktivasi/$1');

$routes->add('login', 'Login::auth');
$routes->add('logingooglecalback', 'Login::logingoogleprocess');
$routes->add('facebookcalback', 'Login::loginfacebookprocess');
$routes->add('logout', 'Login::logout');

$routes->add('showchart', 'Chart::showchartuser');
$routes->add('showchartfa', 'Chart::showchartuserfa');

$routes->add('showtable', 'Tabel::showtableuser');
$routes->add('showtablefa', 'Tabel::showtableuserfa');

$routes->add('testmidtrans', 'TestMidtrans');
$routes->add('tokenmidtrans', 'TestMidtrans::transaction');

$routes->add('pricing', 'Pricing::price');
$routes->add('pricing/(:any)', 'Pricing::newprice/$1');

$routes->add('aboutus', 'About_us::index');

$routes->add('policyprivacy', 'Policy_privacy::index');
$routes->add('policyprivacymob', 'Policy_privacy::mob');

$routes->add('termsconditions', 'Terms_conditions::index');
$routes->add('termsconditionsweb', 'Terms_conditions::web');

$routes->add('contactus', 'Contact_us::index');
$routes->add('contactusprocess', 'Contact_us::uploadpesan');

$routes->add('pengumuman', 'Pengumuman::index');

$routes->add('profile', 'Profile::index');

$routes->add('chart', 'Chart::index');
$routes->add('chartfa', 'Chart::chart_fa');

$routes->add('tabel', 'Tabel::index');
$routes->add('tabelfa', 'Tabel::tabel_fa');

$routes->add('lupa', 'Lupa::index');
$routes->add('forgetpass', 'Lupa::forgetpass');
$routes->add('changepassword/(:alphanum)', 'Lupa::changepass/$1');
$routes->add('submitforgetpass', 'Lupa::updateforgetpass');

$routes->add('ref/(:alphanum)', 'Newreg::reference/$1');
$routes->add('newreg', 'Newreg::index');
$routes->add('regiscallback', 'Newreg::reg');
$routes->add('verifikasi', 'Newreg::verifikasi');
$routes->add('otpregisphone', 'Newreg::otpregisphone');
$routes->add('registrationotp', 'Newreg::otp');
$routes->add('registrationotpverif', 'Newreg::verifyregisotpcode');
$routes->add('regissendotp', 'Newreg::resendregisotp');
$routes->add('changeregisphone', 'Newreg::changeregisphone');
$routes->add('googlecalback', 'Newreg::regisgoogleprocess');
$routes->add('regisfacebookcalback', 'Newreg::regisfacebookprocess');

$routes->add('changephone', 'Change::index');
$routes->add('phoneotp', 'Change::phoneotp');

$routes->add('pembelian/(:alphanum)', 'Pembelian::index/$1');

$routes->add('career', 'Career::index');
$routes->add('detail/(:any)', 'Career::detail/$1');
$routes->add('submitkarir', 'Career::karirsubmitform');
$routes->add('list', 'Career::list');

$routes->add('email', 'Email::index');

$routes->add('subscribeprocess', 'Subscribe::index');

$routes->add('extend/(:alphanum)', 'Extend::cart/$1');

$routes->add('billing', 'Billing::index');
$routes->add('addfunds', 'Billing::addfunds');

$routes->add('paid', 'Status::index');
$routes->add('unpaid', 'Status::unpaid');
$routes->add('cancel', 'Status::cancel');

$routes->add('package', 'Package::index');
$routes->add('invoice', 'Package::invoice');
$routes->add('deletenontemp', 'Package::deletepacketnontemp');
$routes->add('detailpack/(:any)', 'Package::detail/$1');

$routes->add('tutorial', 'Tutorial::index');
$routes->add('detail-tutorial/(:any)', 'Tutorial::detail/$1');

$routes->add('informasibursa', 'Informasibursa::index');
$routes->add('informasibursatags/(:any)', 'Informasibursa::tags/$1');
$routes->add('informasibursadetail/(:any)', 'Informasibursa::detail/$1');
$routes->add('informasibursapdf/(:any)', 'Informasibursa::pdf/$1');

$routes->add('emitenipo', 'Emitenipo::index');
$routes->add('emitenipotags/(:any)', 'Emitenipo::tags/$1');
$routes->add('emitenipodetail/(:any)', 'Emitenipo::detail/$1');
$routes->add('emitenipopdf/(:any)', 'Emitenipo::pdf/$1');


$routes->add('news', 'News::index');
$routes->add('newstags/(:any)', 'News::tags/$1');
$routes->add('newsdetail/(:any)', 'News::detail/$1');

$routes->add('integration', 'Integration::index');
$routes->add('komuconnect', 'Integration::komuintegrate');
$routes->add('komutes', 'Integration::komutes');
$routes->add('kopeconnect', 'Integration::koperintegrate');

$routes->add('editprofile', 'Edit_profile::index');
$routes->add('username_check', 'Edit_profile::usernamecheck');
$routes->add('updateprofil', 'Edit_profile::update');
$routes->add('userpassword', 'Edit_profile::changepassword');
$routes->add('submituserpass', 'Edit_profile::updateuserpassword');
$routes->add('updatephoto', 'Edit_profile::updateuserphoto');
$routes->add('otpphonechange', 'Edit_profile::getotpforchangephone');
$routes->add('resendotp', 'Edit_profile::otpresenduser');
$routes->add('formotpverif', 'Edit_profile::verifyotpcodeuser');

//$routes->add('changepassword', 'Change_password::index');

$routes->add('videoedukasi', 'Video_edukasi::index');

$routes->add('videoweb', 'Video::web');
$routes->add('videoedukasimonikaps/(:any)', 'Video::index/$1');

$routes->add('videodetail/(:any)', 'Detailvid::index/$1');
$routes->add('videoonplay/(:any)', 'Detailvid::onplay/$1');
$routes->add('videodetailwebview/(:any)/(:any)', 'Detailvid::webview/$1/$2');


$routes->add('cart/(:alphanum)', 'Abs_pricing::cart/$1');
$routes->add('extendpackage/(:alphanum)', 'Abs_pricing::packageextender/$1');
$routes->add('continuepayment/(:alphanum)', 'Abs_pricing::packagecontinuer/$1');
$routes->add('processpayment', 'Abs_pricing::process');
$routes->add('processmidtrans', 'Abs_pricing::midtrans');

//$routes->add('getorderid', 'Abs_pricing::getorderid');
$routes->add('getmidtransnotiftest', 'Notification::midtransnotiftest');
$routes->add('getmidtransnotif', 'Notification::midtransnotif');
$routes->add('markallread', 'Notification::marksnotifread');

$routes->add('tabelsakti', 'Tabel_sakti::index');
$routes->add('getdatasakti', 'Tabel_sakti::getdata');
$routes->add('mtabelsakti', 'Mobile::tabelsakti');

$routes->add('getdatasaktim', 'Mobile::getdatam');
$routes->get('apitestend', 'Mobile::test');
$routes->add('mtabel/(:any)', 'Mobile::tabel/$1');
$routes->add('mtabelfa/(:any)', 'Mobile::tabel_fa/$1');
$routes->add('mshowtabel', 'Mobile::mshowtableuser');
$routes->add('mshowtabelfa', 'Mobile::mshowtableuserfa');
$routes->add('mshowchart', 'Mobile::mshowchartuser');
$routes->add('mvideotutorial/(:any)', 'Mobile::videotutor/$1');
$routes->add('mchart/(:any)', 'Mobile::chart/$1');

$routes->add('/pengumuman/(:segment)', 'Pengumuman::news/$1');

$routes->post('apichartta', 'Api::gettachart');
$routes->get('apitableta', 'Api::gettatable');

$routes->add('getpaketprice', 'Pembelian::gethargapaket');
$routes->add('loginpembelian', 'Pembelian::loginpembelianuser');
$routes->add('pembeliangooglecalback', 'Pembelian::logingoogleprocess');
$routes->add('pembelianfacebookcalback', 'Pembelian::loginfacebookprocess');
$routes->add('pembelianregis', 'Pembelian::registerprocess');
$routes->add('regispembeliangooglecalback', 'Pembelian::regisgoogleprocess');
$routes->add('pembelianregisfacebookcalback', 'Pembelian::regisfacebookprocess');
$routes->add('getrightprice', 'Pembelian::getrightpriceprocess');
$routes->add('memberpembeliansubmit', 'Pembelian::membersubmitprocess');
$routes->add('refcodepembeliansubmit', 'Pembelian::refcodeprocess');
$routes->add('pembelianpayment', 'Pembelian::processpembelianpayment');
$routes->add('pemblogout', 'Pembelian::logoutprocess');

$routes->add('thankyou/(:any)', 'Thankyou::index/$1');

$routes->add('newlogin', 'Newlogin::index');

$routes->add('dailyact', 'Dailyact::index');
$routes->add('dailyweb', 'Daily::web');
$routes->add('daily', 'Daily::index');

$routes->add('dailywebihsg', 'Daily::webdailyihsg');
$routes->add('dailymobihsg', 'Daily::mobdailyihsg');
$routes->add('dailywebopen', 'Daily::webdailyopen');
$routes->add('dailymobopen', 'Daily::mobdailyopen');
$routes->add('dailywebclosed', 'Daily::webdailyclosed');
$routes->add('dailymobclosed', 'Daily::mobdailyclosed');


$routes->add('trail', 'Trail::index');
$routes->add('trailclose', 'Trail::close');
$routes->add('trailweb', 'Trail::web');
$routes->add('trailopenweb', 'Trail::openweb');
$routes->add('trailclosedweb', 'Trail::closedweb');

$routes->add('action', 'Action::index');
$routes->add('actionweb', 'Action::web');
$routes->post('actionstorydetail', 'Action::get_item');
$routes->add('actionstorydetailuploadimg', 'Action::uploadGambar');
$routes->add('actionstorydetaildeleteimg', 'Action::deleteGambar');

$routes->add('data', 'Data::index');
$routes->add('dataweb', 'Data::web');

$routes->add('open', 'Open::index');
$routes->add('openweb', 'Open::web');
$routes->post('openstorydetail', 'Open::get_item');

$routes->add('closed', 'Closed::index');
$routes->add('closedweb', 'Closed::web');

$routes->add('factsheetweb', 'Factsheet::web');
$routes->add('factsheetweb', 'Factsheet::web');
$routes->add('factsheetperiode', 'Factsheet::periode');

$routes->add('stockreview', 'Stockreview::index');

$routes->get('stockreviewdaily/(:any)', 'Stockreview::daily/$1');
$routes->add('stockreviewdaily/stockreviewdailypost', 'Stockreview::dailypost');

$routes->get('stockreviewweekly/(:any)', 'Stockreview::weekly/$1');
$routes->add('stockreviewweekly/stockreviewweeklypost', 'Stockreview::weeklypost');

$routes->get('stockreviewhourly/(:any)', 'Stockreview::hourly/$1');
$routes->add('stockreviewhourly/stockreviewhourlypost', 'Stockreview::hourlypost');

$routes->get('stockreviewfive/(:any)', 'Stockreview::fivemin/$1');
$routes->add('stockreviewfive/stockreviewfivepost', 'Stockreview::fiveminpost');

$routes->get('stockreviewfifteen/(:any)', 'Stockreview::fifteenmin/$1');
$routes->add('stockreviewfifteen/stockreviewfifteenpost', 'Stockreview::fifteenminpost');

$routes->get('stockreviewthirty/(:any)', 'Stockreview::thirtymin/$1');
$routes->add('stockreviewthirty/stockreviewthirtypost', 'Stockreview::thirtyminpost');

$routes->get('apireferal/(:any)', 'Apireferal::getAll/$1');

$routes->add('smartwatchlist', 'Smartwatchlist::index');
$routes->post('addsmartwatchlist', 'Smartwatchlist::prosesAdd');
$routes->get('deletesmartwatchlist/(:any)', 'Smartwatchlist::prosesDelete/$1');
$routes->get('deletesmartwatchlistberanda/(:any)', 'Smartwatchlist::prosesDeleteSWberanda/$1');
$routes->add('tesemail', 'Smartwatchlist::tes');

$routes->delete('deleteuser/(:any)', 'Apireferal::fGetDeleteUser/$1');

$routes->get('getapitokenfr/(:any)/(:any)', 'Apireferal::mGetTokenFr/$1/$2');



// $routes->add('email', 'Email::index');
//$routes->add('testaja', 'Register::testAja');
$routes->add('(:any)', 'Error::index');

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
