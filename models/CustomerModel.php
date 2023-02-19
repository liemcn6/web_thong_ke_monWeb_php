<?php
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Customer.php';
require_once __DIR__ . '/Membership.php';

require_once __DIR__ . '/../db/db-helper.php';
require_once __DIR__ . '/../db/mapper.php';

class CustomerModel
{
  private $dbHelper;

  public function __construct()
  {
    $this->dbHelper = new DBHelper();
  }

  public function getCustomerCount()
  {
    $sql = 'SELECT COUNT(customer_id) as count FROM customers';

    $result = $this->dbHelper->executeQueryNoParam($sql);

    if (isset($result)) {
      return $result[0]['count'];
    }

    return 0;
  }

  public function getTotalCustomerSpending()
  {
    $sql = 'SELECT SUM(total_spending) as sum FROM customers';

    $result = $this->dbHelper->executeQueryNoParam($sql);

    if (isset($result)) {
      return $result[0]['sum'];
    }

    return 0;
  }

  public function getCustomerById($id)
  {
    $sql = 'SELECT * FROM customers, memberships '
      . 'WHERE customers.customer_id = ? AND customers.membership_id = memberships.membership_id';

    $result = $this->dbHelper->executeQuerySingleResult([$id], 'i', $sql);

    if (isset($result)) {
      return mapRowToCustomer($result);
    }

    return null;
  }

  public function getCustomers($from, $limit, $filter)
  {
    $orderBy = 'customer_id';
    $orderType = 'ASC';

    if (isset($filter['orderby'])) {
      $orderBy = $filter['orderby'];
    }

    if (isset($filter['ordertype'])) {
      $orderType = $filter['ordertype'];
    }

    $sql = 'SELECT * FROM memberships, customers '
      . 'WHERE customers.membership_id = memberships.membership_id '
      . 'AND customers.customer_id = IFNULL(?, customers.customer_id) '
      . 'AND customers.full_name LIKE IFNULL(?, customers.full_name) '
      . 'AND customers.email LIKE IFNULL(?, customers.email) '
      . 'AND customers.membership_id = IFNULL(?, customers.membership_id) '
      . 'ORDER BY customers.'
      . $orderBy
      . ' '
      . $orderType
      . ' LIMIT ' . $from . ', ' . $limit;

    $result = $this->dbHelper->executeQueryResult([
      isset($filter['id']) && !empty($filter['id']) ? $filter['id'] : null,
      isset($filter['fullname']) ? '%' . $filter['fullname'] . '%' : null,
      isset($filter['email']) ? '%' . $filter['email'] . '%' : null,
      isset($filter['membershipid']) && (int)($filter['membershipid']) ? (int)$filter['membershipid'] : null
    ], 'ssss', $sql);


    if (isset($result)) {
      $listCustomer = [];
      foreach ($result as $row) {
        array_push($listCustomer, mapRowToCustomer($row));
      }

      return $listCustomer;
    }

    return null;
  }

  public function addCustomer($customer)
  {
    $result = $this->dbHelper->executeQuery(
      [
        $customer->getFullName(),
        $customer->getGender(),
        $customer->getDateOfBirth(),
        $customer->getEmail(),
        $customer->getPhoneNumber(),
        $customer->getAddress(),
        $customer->getMembership()->getId(),
        $customer->getNote()
      ],
      'ssssssis',
      'INSERT INTO customers(full_name, gender, date_of_birth, email, phone_number, address, membership_id, note) '
        . 'VALUES(?, ?, ?, ?, ?, ?, IFNULL(?, membership_id), ?)'
    );

    return $result;
  }

  public function updateCustomerGeneralInfo($customer)
  {
    $sql = 'UPDATE customers SET full_name = ?, date_of_birth = ?, gender = ?, note = ? WHERE customer_id = ?';

    $result = $this->dbHelper->executeQuery(
      [
        $customer->getFullName(), $customer->getDateOfBirth(),
        $customer->getGender(), $customer->getNote(), $customer->getId()
      ],
      'ssssi',
      $sql
    );

    return $result;
  }

  public function updateCustomerContact($customer)
  {
    $sql = 'UPDATE customers SET email = ?, phone_number = ?, address = ? WHERE customer_id = ?';

    $result = $this->dbHelper->executeQuery(
      [
        $customer->getEmail(), $customer->getPhoneNumber(),
        $customer->getAddress(), $customer->getId()
      ],
      'sssi',
      $sql
    );

    return $result;
  }

  public function updateCustomerMembership($customerId, $newMembershipId)
  {
    $sql = 'UPDATE customers SET membership_id = ? WHERE customer_id = ?';

    $result = $this->dbHelper->executeQuery(
      [
        $newMembershipId, $customerId
      ],
      'ii',
      $sql
    );

    return $result;
  }

  public function deleteCustomer($customerId)
  {
    $result = $this->dbHelper->executeQuery(
      [$customerId],
      'i',
      'DELETE FROM customers WHERE customer_id = ?'
    );

    return $result;
  }

  public function getCustomerIncreasingStatistic($selectedYear)
  {
    $sql = 'SELECT MONTH(created_date) as month, COUNT(customer_id) as value FROM customers ' .
      'WHERE YEAR(created_date) = ? GROUP BY MONTH(created_date)';

    $result = $this->dbHelper->executeQueryResult([$selectedYear], 's', $sql);

    return $result;
  }

  public function getCustomerSpendingStatistic($statisticBy, $limit)
  {
    $sql = 'SELECT customers.*, SUM(payment.amount) as total_spending FROM customers, payment '
      . 'WHERE customers.customer_id = payment.customer_id ';

    if (strcasecmp($statisticBy, 'year') == 0) {
      $sql .= ' AND YEAR(payment.created_date) = YEAR(CURRENT_DATE())';
    } else if (strcasecmp($statisticBy, 'month') == 0) {
      $sql .= ' AND MONTH(payment.created_date) = MONTH(CURRENT_DATE()) '
        . 'AND YEAR(payment.created_date) = YEAR(CURRENT_DATE())';
    }

    $sql .= ' GROUP BY customers.customer_id ORDER BY total_spending DESC LIMIT ?';

    $result = $this->dbHelper->executeQueryResult([$limit], 'i', $sql);

    if (isset($result)) {
      $listCustomer = [];
      foreach ($result as $row) {
        array_push($listCustomer, mapRowToCustomer($row));
      }

      return $listCustomer;
    }

    return null;
  }
}
