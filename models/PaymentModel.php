<?php
require_once __DIR__ . './Payment.php';

class PaymentModel
{
  private $dbHelper;

  public function __construct()
  {
    $this->dbHelper = new DBHelper();
  }

  public function getTotalIncomeByMonthStatistic($selectedYear)
  {
    $sql = 'SELECT MONTH(created_date) as month, SUM(amount) as value FROM `payment` '
      . 'WHERE YEAR(created_date) = ? GROUP BY MONTH(created_date)';

    $result = $this->dbHelper->executeQueryResult([$selectedYear], 's', $sql);

    return $result;
  }
}
