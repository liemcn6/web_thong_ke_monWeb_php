<?php

require './vendor/autoload.php';
require './controllers/AuthController.php';
require './controllers/HomeController.php';
require './controllers/AdminController.php';

$router = new \Bramus\Router\Router();

// home controller
$router->all('/', function () {
  (new HomeController)->showWelcomePage();
});

// auth controller
$router->get('/login', function () {
  (new AuthController())->showLoginPage();
});

$router->post('/login', function () {
  (new AuthController())->login();
});

$router->get('/register', function () {
  (new AuthController())->showRegisterPage();
});

$router->post('/register', function () {
  (new AuthController())->register();
});

$router->get('logout', function () {
  (new AuthController())->logout();
});

// admin contorller
$router->get('/admin', function () {
  (new AdminController())->showStatisticPage();
});

$router->get('/admin/customer', function () {
  (new AdminController())->showCustomerPage();
});

$router->get('/admin/customer/add', function () {
  (new AdminController())->showAddCustomerPage();
});

$router->post('/admin/customer/add', function () {
  (new AdminController())->addCustomer();
});

$router->get('/admin/customer/{id}', function ($id) {
  (new AdminController())->showUpdateCustomerPage($id);
});

$router->post('/admin/customer/{id}/update/general', function ($id) {
  (new AdminController())->updateCustomerGeneralInfo($id);
});

$router->post('/admin/customer/{id}/update/contact', function ($id) {
  (new AdminController())->updateCustomerContact($id);
});

$router->post('/admin/customer/{id}/update/membership', function ($id) {
  (new AdminController())->updateCustomerMembership($id);
});

$router->post('/admin/customer/delete', function () {
  (new AdminController())->deleteCustomer();
});

$router->get('/admin/membership', function () {
  (new AdminController())->showMembershipPage();
});

$router->post('/admin/membership/add', function () {
  (new AdminController())->addMembership();
});

$router->get('/admin/membership/update/{id}', function ($id) {
  (new AdminController())->showUpdateMembershipPage($id);
});

$router->post('/admin/membership/update/{id}/general', function ($id) {
  (new AdminController())->updateMembershipGeneralInfo($id);
});

$router->post('/admin/membership/update/{id}/advance', function ($id) {
  (new AdminController())->updateMembershipAdvanceInfo($id);
});

// api

$router->get('/api/admin/customer', function () {
  (new AdminController())->getCustomers();
});

$router->get('/api/admin/membership/all', function () {
  (new AdminController())->getAllMembership();
});

$router->post('/api/admin/membership/delete', function () {
  (new AdminController())->deleteMembership();
});

$router->get('/api/admin/statistic/customer-increasing/{selected_year}', function ($selectedYear) {
  (new AdminController())->getCustomerIncreasingStatistic($selectedYear);
});

$router->get('/api/admin/statistic/total-income/{selected_year}', function ($selectedYear) {
  (new AdminController())->getTotalIncomeByMonthStatistic($selectedYear);
});

$router->get('/api/admin/statistic/customer-spending/{statistic_by}', function ($statisticBy) {
  (new AdminController())->getCustomerSpendingStatistic($statisticBy);
});

$router->run();
