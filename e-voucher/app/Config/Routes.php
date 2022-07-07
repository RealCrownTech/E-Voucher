<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');

$myroutes = [];

//Login
$myroutes['login'] = 'Login::index';
$myroutes['logout'] = 'Login::logout';

//Dashboard 
$myroutes['dashboard'] = 'Dashboard::index';
$myroutes['changelog'] = 'Dashboard::changelog';

//User
$myroutes['addUser'] = 'User::create';
$myroutes['users'] = 'User::view';
$myroutes['editUser/(:num)'] = 'User::edit/$1';
$myroutes['viewUser/(:num)'] = 'User::user_profile/$1';
$myroutes['deleteuser/(:num)'] = 'User::deleteUser/$1';
$myroutes['profile_upload/(:num)'] = 'FileUpload::profile_upload/$1';
$myroutes['change_password'] = 'User::change_password';

//Voucher
$myroutes['vouchers'] = 'Voucher::index';
$myroutes['ibc'] = 'Voucher::createPettyByCash';
$myroutes['ibt'] = 'Voucher::createPettyByTransfer';
$myroutes['pbc'] = 'Voucher::createPaymentByCash';
$myroutes['pbt'] = 'Voucher::createPaymentByTransfer';
$myroutes['pettybycash/(:num)'] = 'Voucher::viewpettybycash/$1';
$myroutes['pettybytransfer/(:num)'] = 'Voucher::viewpettybytransfer/$1';
$myroutes['approvepetty/(:num)'] = 'Voucher::approvepetty/$1';
$myroutes['declinepetty/(:num)'] = 'Voucher::declinepetty/$1';
$myroutes['paymentbycash/(:num)'] = 'Voucher::viewpaymentbycash/$1';
$myroutes['paymentbytransfer/(:num)'] = 'Voucher::viewpaymentbytransfer/$1';
$myroutes['approvepayment/(:num)'] = 'Voucher::approvepayment/$1';
$myroutes['declinepayment/(:num)'] = 'Voucher::declinepayment/$1';
$myroutes['processpayment/(:num)'] = 'Voucher::processpayment/$1';
$myroutes['deletevoucher/(:num)'] = 'Voucher::delete/$1';
$myroutes['editibc/(:num)'] = 'Voucher::editPettyByCash/$1';
$myroutes['editibt/(:num)'] = 'Voucher::editPettyByTransfer/$1';
$myroutes['editpbc/(:num)'] = 'Voucher::editPaymentByCash/$1';
$myroutes['editpbt/(:num)'] = 'Voucher::editPaymentByTransfer/$1';
$myroutes['search'] = 'Voucher::search';
$myroutes['generate_report'] = 'Voucher::generate_report';
$myroutes['print_pbc/(:num)'] = 'Voucher::print_pbc/$1';
$myroutes['print_pbt/(:num)'] = 'Voucher::print_pbt/$1';
$myroutes['print_ibc/(:num)'] = 'Voucher::print_ibc/$1';
$myroutes['print_ibt/(:num)'] = 'Voucher::print_ibt/$1';

//Settings
$myroutes['settings'] = 'Settings::index';
$myroutes['company_settings'] = 'Settings::company';
$myroutes['bank_settings'] = 'Settings::bank';
$myroutes['add_role'] = 'Settings::add_user_role';
$myroutes['privileges/(:num)'] = 'Settings::permission/$1';
$myroutes['deleterole/(:num)'] = 'Settings::deleteRole/$1';
$myroutes['img_upload/(:alpha)'] = 'FileUpload::img_upload/$1';
$myroutes['addBusiness'] = 'Settings::addBusiness';
$myroutes['editbusiness/(:num)'] = 'Settings::editBusiness/$1';
$myroutes['deletebusiness/(:num)'] = 'Settings::deleteBusiness/$1';
$myroutes['addOutlet'] = 'Settings::addOutlet';
$myroutes['editoutlet/(:num)'] = 'Settings::editOutlet/$1';
$myroutes['deleteoutlet/(:num)'] = 'Settings::deleteOutlet/$1';
$myroutes['addDepartment'] = 'Settings::addDepartment';
$myroutes['editdepartment/(:num)'] = 'Settings::editDepartment/$1';
$myroutes['deletedepartment/(:num)'] = 'Settings::deleteDepartment/$1';
$myroutes['add_exp_cat'] = 'Settings::addExpenseCategory';
$myroutes['deleteexpcat/(:num)'] = 'Settings::deleteExpenseCategory/$1';


$routes->map($myroutes);

/*
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
