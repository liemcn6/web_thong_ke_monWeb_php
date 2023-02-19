<?php
require_once __DIR__ . '/../models/CustomerModel.php';

class HomeController
{
  function showWelcomePage()
  {
    $limit = 3;
    $statisticBy = 'month';
    $listCustomer = (new CustomerModel())->getCustomerSpendingStatistic($statisticBy, $limit);

    require_once __DIR__ . '/../views/pages/welcome-page.php';
  }
}
