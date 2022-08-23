<?php

namespace Config;

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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
$routes->get('change-langue/fr', 'LanguageController::index');
$routes->get('change-langue/en', 'LanguageController::index');

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('log-in', 'Home::expiration_session',['filter'=>'auth']);
$routes->post('log-in', 'Home::expiration_session',['filter'=>'auth']);

$routes->get('my-profile', 'Home::my_profile',['filter'=>'auth']);
$routes->post('my-profile', 'Home::my_profile',['filter'=>'auth']);

$routes->get('authenticate/sign-in','Home::log_in');
$routes->post('authenticate/sign-in','Home::log_in');

$routes->get('log-out', 'Home::log_out',['filter'=>'auth']);
$routes->get('dashboard', 'Home::dashboard',['filter'=>'auth']);
$routes->post('dashboard', 'Home::dashboard',['filter'=>'auth']);
//$routes->get('merchant/dashboard', 'Home::payment_merchant_dashboard',['filter'=>'auth']);

/**
 * Parameters routes
 */	
$routes->get('parameters/pricing-list','Prices::listing',['filter'=>'auth']);
$routes->post('parameters/pricing-add','Prices::add',['filter'=>'auth']);
$routes->get('parameters/pricing-add','Prices::add',['filter'=>'auth']);
$routes->get('parameters/pricing-edit/(:num)','Prices::edit',['filter'=>'auth']);
$routes->post('parameters/pricing-edit/(:num)','Prices::edit',['filter'=>'auth']);

$routes->get('parameters/section-list','Sections::listing',['filter'=>'auth']);
$routes->post('parameters/section-add','Sections::add',['filter'=>'auth']);
$routes->get('parameters/section-add','Sections::add',['filter'=>'auth']);
$routes->get('parameters/section-edit/(:num)','Sections::edit',['filter'=>'auth']);
$routes->post('parameters/section-edit/(:num)','Sections::edit',['filter'=>'auth']);

$routes->get('parameters/zone-list','Zones::listing',['filter'=>'auth']);
$routes->post('parameters/zone-add','Zones::add',['filter'=>'auth']);
$routes->get('parameters/zone-add','Zones::add',['filter'=>'auth']);
$routes->get('parameters/zone-edit/(:num)', 'Zones::edit', ['filter'=>'auth']);
$routes->post('parameters/zone-edit/(:num)', 'Zones::edit', ['filter'=>'auth']);
$routes->get('parameters/trajet-list','Traject::listing',['filter'=>'auth']);

$routes->get('parameters/terminus-list','Terminus::listing',['filter'=>'auth']);
$routes->get('parameters/terminus-add','Terminus::add',['filter'=>'auth']);
$routes->post('parameters/terminus-add','Terminus::add',['filter'=>'auth']);
$routes->get('parameters/terminus-edit/(:num)', 'Terminus::edit', ['filter'=>'auth']);
$routes->post('parameters/terminus-edit/(:num)', 'Terminus::edit', ['filter'=>'auth']);

$routes->get('parameters/expense-list','Expenses::listing',['filter'=>'auth']);
$routes->get('parameters/expense-add','Expenses::add',['filter'=>'auth']);
$routes->post('parameters/expense-add','Expenses::add',['filter'=>'auth']);
$routes->get('parameters/expense-edit/(:num)', 'Expenses::edit', ['filter'=>'auth']);
$routes->post('parameters/expense-edit/(:num)', 'Expenses::edit', ['filter'=>'auth']);


/**
 * Parameters bus
 */
$routes->get('parameters/bus-list','Bus::listing',['filter'=>'auth']);
$routes->post('parameters/bus-add','Bus::Add',['filter'=>'auth']);
$routes->get('parameters/bus-add','Bus::add',['filter'=>'auth']);
$routes->get('parameters/bus-add','Bus::add',['filter'=>'auth']);
$routes->post('parameters/bus-add','Bus::add',['filter'=>'auth']);
$routes->get('parameters/bus-edit/(:num)','Bus::edit',['filter'=>'auth']);
$routes->post('parameters/bus-edit/(:num)','Bus::edit',['filter'=>'auth']);

$routes->post('parameters/trajet-list','Traject::add',['filter'=>'auth']);
$routes->get('parameters/trajet-list','Traject::add',['filter'=>'auth']);
$routes->get('parameters/lines-list','Lignes::listing',['filter'=>'auth']);
$routes->get('parameters/lines-add','Lignes::add',['filter'=>'auth']);
$routes->post('parameters/lines-add','Lignes::add',['filter'=>'auth']);
$routes->get('parameters/lines-edit/(:num)','Lignes::edit',['filter'=>'auth']);
$routes->post('parameters/lines-edit/(:num)','Lignes::edit',['filter'=>'auth']);


/**
 * Agents routes
 */
$routes->get('agents/agent-add','Agents::add',['filter'=>'auth']);
$routes->post('agents/agent-add','Agents::add',['filter'=>'auth']);
$routes->get('agents/agent-edit/(:num)','Agents::edit',['filter'=>'auth']);
$routes->post('agents/agent-edit','Agents::edit',['filter'=>'auth']);
$routes->get('agents/agent-list','Agents::listing',['filter'=>'auth']);
$routes->post('agents/agent-list','Agents::listing',['filter'=>'auth']);
$routes->get('agents/agent-redit/(:num)','Agents::redit',['filter'=>'auth']);
$routes->post('agents/agent-redit/(:num)','Agents::redit',['filter'=>'auth']);
$routes->post('agents/agent-redit','Agents::redit',['filter'=>'auth']);


/**
 * Gestion Profils routes
 */
$routes->get('profiles/profile-add','Profiles::add',['filter'=>'auth']);
$routes->post('profiles/profile-add','Profiles::add',['filter'=>'auth']);
$routes->get('profiles/profile-edit/(:num)','Profiles::edit',['filter'=>'auth']);
$routes->post('profiles/profile-edit','Profiles::edit',['filter'=>'auth']);
$routes->get('profiles/profile-list','Profiles::listing',['filter'=>'auth']);
$routes->get('profiles/profile-compte-user','Profiles::comptes',['filter'=>'auth']);
$routes->post('profiles/profile-compte-user','Profiles::comptes',['filter'=>'auth']);
$routes->get('profiles/profile-compte-user-add','Profiles::compte_add',['filter'=>'auth']);
$routes->post('profiles/profile-compte-user-add','Profiles::compte_add',['filter'=>'auth']);
$routes->get('profiles/profile-compte-user-edit/(:num)','Profiles::compte_edit',['filter'=>'auth']);
$routes->post('profiles/profile-compte-user-edit/(:num)','Profiles::compte_edit',['filter'=>'auth']);


/**
 * Gestion Sessions routes
 */
$routes->get('activities/define-session','Activities::add',['filter'=>'auth']);
$routes->post('activities/define-session','Activities::add',['filter'=>'auth']);
$routes->get('activities/edit-session/(:num)','Activities::edit',['filter'=>'auth']);
$routes->post('activities/edit-session/(:num)','Activities::edit',['filter'=>'auth']);
$routes->get('activities/list-session','Activities::listing',['filter'=>'auth']);
$routes->post('activities/list-session','Activities::listing',['filter'=>'auth']);

/**
 * Gestion Etat routes
 */
$routes->get('collection/show-history','Collections::liste',['filter'=>'auth']);
$routes->post('collection/show-history','Collections::liste',['filter'=>'auth']);
$routes->get('collection/show-details-history/(:num)','Collections::details',['filter'=>'auth']);
$routes->get('collection/show-expense-history','Collections::expense_list',['filter'=>'auth']);
$routes->post('collection/show-expense-history','Collections::expense_list',['filter'=>'auth']);

/**
 * Gestion Rapport routes
 */
$routes->get('rapports/collecte-history/[p|x]','Rapports::collecte_ticket',['filter'=>'auth']);
$routes->get('rapports/collecte-expense-history/[p|x]','Rapports::collecte_expense',['filter'=>'auth']);


/**
 *  URL LISTE LIEES
 */
$routes->post('filtres/zone-by-line','FilterController::zone_by_line',['filter'=>'auth']);
$routes->post('filtres/section-by-zone','FilterController::section_by_zone',['filter'=>'auth']);

/**
 * Paiement Masse
 */
$routes->get('masse/init-request', 'PushPayment::push', ['filter'=>'auth']);


/**
 * Request Payment routes
 */
//$routes->get('requestPayment/requestPayment-add','RequestPayment::new_request',['filter'=>'auth']);
//$routes->post('requestPayment/requestPayment-add','RequestPayment::new_request',['filter'=>'auth']);

$routes->get('payment/dashboard', 'PushPayment::dashboard',['filter'=>'auth']);
$routes->get('payment/push-payment-request','PushPayment::push_payment_request',['filter'=>'auth']);
$routes->post('payment/push-payment-request','PushPayment::push_payment_request',['filter'=>'auth']);
$routes->get('payment/push-payment-request/(:segment)','PushPayment::push_payment_request_modal',['filter'=>'auth']);
$routes->post('payment/push-payment-request/(:segment)','PushPayment::push_payment_request_modal',['filter'=>'auth']);
$routes->get('payme/card-payment-request/(:segment)','PushPayment::bank_card_payment_request',['filter'=>'auth']);
$routes->post('payme/card-payment-request/(:segment)','PushPayment::bank_card_payment_request',['filter'=>'auth']);

$routes->get('push/list-request', 'PushPayment::payment_history',['filter'=>'auth']);

$routes->get('payment/bulk-payment-request','MassPayment::init_bulk_payment',['filter'=>'auth']);
$routes->post('payment/bulk-payment-request','MassPayment::init_bulk_payment',['filter'=>'auth']);
$routes->get('payment/send-bulk-payment', 'MassPayment::send_bulk_payment',['filter'=>'auth']);
$routes->get('payment/bulk-payment-list', 'MassPayment::bulk_payment_history',['filter'=>'auth']);
$routes->get('payment/bulk-payment-request-file-download', 'MassPayment::telecharger',['filter'=>'auth']);
//$routes->get('masse/list-request', 'MassPayment::liste',['filter'=>'auth']);

$routes->get('payment/transaction-statement','PaymentReport::transaction_list',['filter'=>'auth']);
$routes->post('payment/transaction-statement','PaymentReport::transaction_list',['filter'=>'auth']);

$routes->get('payment/operation-statement','PaymentReport::operation_list',['filter'=>'auth']);
$routes->post('payment/operation-statement','PaymentReport::operation_list',['filter'=>'auth']);

$routes->get('report/transaction-report','PaymentReport::export_transaction',['filter'=>'auth']);
$routes->get('report/operation-report','PaymentReport::export_operation',['filter'=>'auth']);

$routes->get('approvisionnent-compensation','ApproCompense::liste',['filter'=>'auth']);
$routes->post('approvisionnent-compensation','ApproCompense::liste',['filter'=>'auth']);
$routes->get('approviser-compte','ApproCompense::approviser',['filter'=>'auth']);
$routes->post('approviser-compte','ApproCompense::approviser',['filter'=>'auth']);
$routes->get('compenser-compte','ApproCompense::compenser',['filter'=>'auth']);
$routes->post('compenser-compte','ApproCompense::compenser',['filter'=>'auth']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
