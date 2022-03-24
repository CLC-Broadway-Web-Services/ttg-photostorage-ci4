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
$routes->setDefaultController('Admin/DashboardController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

$routes->add('/login', 'AuthController::index', ['as' => 'login']);
$routes->add('/logout', 'AuthController::logout', ['as' => 'logout']);
$routes->add('/forget-password', 'AuthController::forget_password', ['as' => 'forget_password']);

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->add('/login-guest', 'AuthController::login_guest', ['as' => 'login_guest']);

// CLIENT ONLY ROUTES
$routes->group('client', ['filter' => 'clientauth'], function ($routes) {
    $routes->add('/', 'Client\DashboardController::index', ['as' => 'client_index']);
    $routes->add('profile', 'AuthController::currentUserProfile', ['as' => 'client_profile']);
    $routes->add('crn-search', 'Client\DashboardController::byCrn', ['as' => 'client_crn_search']);
    $routes->add('asset-search', 'Client\DashboardController::byAssetId', ['as' => 'client_asset_search']);
    $routes->add('manage-user', 'Client\DashboardController::manage_users', ['as' => 'client_manage_users']);
    $routes->add('create-user', 'Admin\ManageUsersController::creat_user', ['as' => 'client_creat_user']);
    // $routes->add('create-user/create', 'Client\ManageUsersController::edit_manage_user', ['as' => 'client_create']);
});

// SHARE ONLY ROUTES
// $routes->group('share', function ($routes) {
//     $routes->add( 'manage-shipment/details/(:num)', 'Admin\ManageShipmentController::manage_shipment_details/$1', ['as' => 'manage_shipment_details_share']);
// });

// SUPER ADMIN ONLY ROUTES
$routes->add('/manage-shipment/details/(:segment)', 'Admin\ManageShipmentController::manage_shipment_details/$1', ['as' => 'manage_shipment_details']);
$routes->add('/manage-data/details/(:any)', 'Admin\AssetDataController::manage_data_details/$1', ['as' => 'manage_data_details']);
$routes->group('/', ['filter' => 'superadminauth'], function ($routes) {
    $routes->add('', 'Admin\DashboardController::index', ['as' => 'admin_index']);
    $routes->add('profile', 'AuthController::currentUserProfile', ['as' => 'admin_profile']);
    $routes->add('/manage-shipment', 'Admin\ManageShipmentController::manage_shipment', ['as' => 'manage_shipment']);

    $routes->add('/download-data-pdf/(:any)/(:any)', 'Admin\AssetDataController::generateDirectPdf/$1/$2', ['as' => 'download_data_pdf']);

    $routes->add('/defect-analysis', 'Admin\AssetDataController::defect_analysis', ['as' => 'defect_analysis']);
    $routes->add('/file/(:segment)', 'Admin\FilePdfController::file_pdf/$1', ['as' => 'file_pdf']);
    $routes->add('/activity-logs', 'Admin\ReportsController::activity_logs', ['as' => 'activity_logs']);
    $routes->add('/performance-report', 'Admin\ReportsController::performance_report', ['as' => 'performance_report']);
    $routes->add('/notifications', 'Admin\DashboardController::notifications', ['as' => 'notifications']);
    $routes->add('/app-chats', 'Admin\DashboardController::app_chats', ['as' => 'app_chats']);

    // testing staff
    $routes->add('/testing-staff', 'Admin\ManageUsersController::testing_staff', ['as' => 'testing_staff']);
    // $routes->add('/testing-staff/edit_testing_staff', 'Admin\ManageUsersController::edit_testing_staff', ['as' => 'edit_testing_staff']);

    // shipping staff
    $routes->add('/shipping-staff', 'Admin\ManageUsersController::shipping_staff', ['as' => 'shipping_staff']);
    // $routes->add('/shipping-staff/edit_shipping_staff', 'Admin\ManageUsersController::edit_shipping_staff', ['as' => 'edit_shipping_staff']);

    // admin user
    $routes->add('/manage-admin', 'Admin\ManageUsersController::manage_admin', ['as' => 'manage_admin']);
    // $routes->add('/manage-admin/edit_manage_admin', 'Admin\ManageUsersController::edit_manage_admin', ['as' => 'edit_manage_admin']);

    // guest user
    $routes->add('/create-user', 'Admin\ManageUsersController::creat_user', ['as' => 'creat_user']);
    // $routes->add('/create-user/create', 'Admin\ManageUsersController::edit_manage_user', ['as' => 'create']);

    $routes->add('/manage-client', 'Admin\ManageUsersController::manage_client', ['as' => 'manage_client']);
    // $routes->add('/add-client', 'Admin\ClientController::index', ['as' => 'add_client']);

    $routes->add('/manage-data', 'Admin\AssetDataController::manage_data', ['as' => 'manage_data']);
    $routes->add('/download-all', 'Admin\ManageDataPdfController::downloadAllData', ['as' => 'download_all_shipments']);
    $routes->add('/download-all/data', 'Admin\ManageDataPdfController::downloadAllData/$1', ['as' => 'download_all_data']);
    $routes->add('/pdf/(:any)', 'Admin\ManageDataPdfController::manage_data_pdf/$1', ['as' => 'manage_data_pdf']);
    $routes->add('/excel/(:any)', 'Admin\ManageDataPdfController::manage_data_excel/$1', ['as' => 'manage_data_excel']);
    $routes->add('/manage-data/details/(:any)/imagedelete/(:num)', 'Admin\AssetDataController::manage_data_details/$1/$2', ['as' => 'manage_data_details_image_delete']);

    $routes->add('/developer-mode', 'Developer\DevController::index', ['as' => 'developer_index']);
});
// $routes->add('/', 'Admin\DashboardController::index', ['filter' => 'adminauth', 'as' => 'admin_index']);
// $routes->add('/client', 'Admin\DashboardController::client', [ 'as' => 'client_index']);

// $routes->add('/assign-crn', 'Admin\ClientController::assign_crn', ['as' => 'assign_crn']);
// $routes->add('/add-client/edit/(:num)', 'Admin\ClientController::edit/$1', ['as' => 'add_client_edit']);

$routes->group('api', function ($routes) {
    $routes->add('', 'API\APIController::index');
});

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
