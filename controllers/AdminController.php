<?php
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/CustomerModel.php';
require_once __DIR__ . '/../models/MembershipModel.php';
require_once __DIR__ . '/../models/PaymentModel.php';

require_once __DIR__ . '/../utils/Utils.php';

class AdminController
{

  function __construct()
  {
    session_start();
  }

  private function checkAuthority()
  {
    $userRole = $_SESSION['role'];

    if (isset($userRole)) {
      if ($userRole == 0) {
        return true;
      }

      header('Location: http://localhost/ltw-customer-management/');
    } else {
      header('Location: http://localhost/ltw-customer-management/login');
    }

    return false;
  }

  public function addCustomer()
  {
    $customer = new Customer();
    $customer->setFullName(Utils::getFieldWithFallback($_POST, 'fullname'));
    $customer->setGender(Utils::getFieldWithFallback($_POST, 'gender'));
    $customer->setDateOfBirth(Utils::getFieldWithFallback($_POST, 'birthday'));
    $customer->setEmail(Utils::getFieldWithFallback($_POST, 'email'));
    $customer->setPhoneNumber(Utils::getFieldWithFallback($_POST, 'phonenumber'));
    $customer->setAddress(Utils::getFieldWithFallback($_POST, 'address'));
    $customer->setNote(Utils::getFieldWithFallback($_POST, 'note'));

    $membershipId = Utils::getFieldWithFallback($_POST, 'membership');
    $membership = new Membership();
    $membership->setId($membershipId);

    $customer->setMembership($membership);

    $customerModel = new CustomerModel();
    $result = $customerModel->addCustomer($customer);

    if ($result) {
      header('Location: http://localhost/ltw-customer-management/admin/customer');
    } else {
      echo '503';
    }
  }

  public function updateCustomerGeneralInfo($id)
  {
    $customer = new Customer();

    $customer->setId($id);
    $customer->setFullName(Utils::getFieldWithFallback($_POST, 'fullname'));
    $customer->setDateOfBirth(Utils::getFieldWithFallback($_POST, 'birthday'));
    $customer->setGender(Utils::getFieldWithFallback($_POST, 'gender'));
    $customer->setNote(Utils::getFieldWithFallback($_POST, 'note'));

    $result = (new CustomerModel())->updateCustomerGeneralInfo($customer);

    if ($result) {
      header('Location: http://localhost/ltw-customer-management/admin/customer/' . $id);
    } else {
      echo '503 Update failed';
    }
  }

  public function updateCustomerContact($id)
  {
    $customer = new Customer();

    $customer->setId($id);
    $customer->setEmail(Utils::getFieldWithFallback($_POST, 'email'));
    $customer->setPhoneNumber(Utils::getFieldWithFallback($_POST, 'phonenumber'));
    $customer->setAddress(Utils::getFieldWithFallback($_POST, 'address'));

    $result = (new CustomerModel())->updateCustomerContact($customer);

    if ($result) {
      header('Location: http://localhost/ltw-customer-management/admin/customer/' . $id);
    } else {
      echo '503 Update failed';
    }
  }

  public function updateCustomerMembership($id)
  {
    $result = (new CustomerModel())->updateCustomerMembership(
      $id,
      Utils::getFieldWithFallback($_POST, 'membership')
    );

    if ($result) {
      header('Location: http://localhost/ltw-customer-management/admin/customer/' . $id);
    } else {
      echo '503 Update failed';
    }
  }

  public function deleteCustomer()
  {
    $customerId = Utils::getFieldWithFallback($_POST, 'customerid');

    $customerModel = new CustomerModel();
    $result = $customerModel->deleteCustomer($customerId);

    $response = new stdClass();
    if ($result) {
      $response->statusCode = '201';
      $response->message = 'delete success';
    } else {
      $response->statusCode = '503';
      $response->message = 'delete failed';
    }

    $response = json_encode($response);
    echo $response;
  }

  public function showStatisticPage()
  {
    if (!$this->checkAuthority()) return;

    $customerModel = new CustomerModel();
    $customerCount = $customerModel->getCustomerCount();
    $totalCustomerSpending = $customerModel->getTotalCustomerSpending();

    require_once __DIR__ . '/../views/pages/statistic-dashboard.php';
  }

  public function showCustomerPage()
  {
    if (!$this->checkAuthority()) return;

    $limit = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $from = ($page - 1) * $limit;
    $allParamExceptPage = array_filter($_GET, function ($key) {
      return strcasecmp($key, 'page');
    }, ARRAY_FILTER_USE_KEY);

    $customerModel = new CustomerModel();
    $listCustomer = $customerModel->getCustomers($from, $limit, $allParamExceptPage);

    if (isset($listCustomer)) {
      require_once __DIR__ . '/../views/pages/customer-dashboard.php';
    }
  }

  public function showAddCustomerPage()
  {
    if (!$this->checkAuthority()) return;

    $membershipList = (new MembershipModel())->getAllMembership();

    if (isset($membershipList)) {
      require_once __DIR__ . '/../views/pages/add-customer.php';
    } else {
      echo '503';
    }
  }

  public function showUpdateCustomerPage($customerId)
  {
    if (!$this->checkAuthority()) return;

    $customer = (new CustomerModel())->getCustomerById($customerId);
    $membershipList = (new MembershipModel())->getAllMembership();

    if (isset($customer) && isset($membershipList)) {
      require_once __DIR__ . '/../views/pages/update-customer.php';
    } else {
      echo '404';
    }
  }

  public function showMembershipPage()
  {
    if (!$this->checkAuthority()) return;

    $membershipModel = new MembershipModel();
    $listMembership = $membershipModel->getAllMembership();

    if (isset($listMembership)) {
      require_once __DIR__ . '/../views/pages/membership-dashboard.php';
    } else {
      echo '503';
    }
  }

  public function showUpdateMembershipPage($id)
  {
    if (!$this->checkAuthority()) return;

    $membershipModel = new MembershipModel();
    $membership = $membershipModel->getMembershipById($id);

    if (isset($membership)) {
      require_once __DIR__ . '/../views/pages/update-membership.php';
    } else {
      echo '404 Membership not found';
    }
  }

  public function addMembership()
  {
    if (!$this->checkAuthority()) return;

    $membership = new Membership();
    $membership->setName(Utils::getFieldWithFallback($_POST, 'name'));
    $membership->setDiscount(Utils::getFieldWithFallback($_POST, 'discount'));
    $membership->setDescription(Utils::getFieldWithFallback($_POST, 'description'));
    $membership->setOtherPromotion(Utils::getFieldWithFallback($_POST, 'otherspromotion'));

    $membershipModel = new MembershipModel();
    $result = $membershipModel->addMembership($membership);

    if ($result) {
      header('Location: http://localhost/ltw-customer-management/admin/membership');
    } else {
      echo '503';
    }
  }

  /**
   * Update discount and other promotions
   */
  public function updateMembershipAdvanceInfo($id)
  {
    if (!$this->checkAuthority()) return;

    $membership = new Membership();
    $membership->setId($id);
    $membership->setDiscount(Utils::getFieldWithFallback($_POST, 'discount'));
    $membership->setOtherPromotion(Utils::getFieldWithFallback($_POST, 'otherspromotion'));

    $membershipModel = new MembershipModel();
    $result = $membershipModel->updateMembershipAdvanceInfo($membership);

    if ($result) {
      header('Location: http://localhost/ltw-customer-management/admin/membership/update/' . $id);
    } else {
      echo '503 Update failed';
    }
  }

  public function updateMembershipGeneralInfo($id)
  {
    if (!$this->checkAuthority()) return;

    $membership = new Membership();
    $membership->setId($id);
    $membership->setName(Utils::getFieldWithFallback($_POST, 'name'));
    $membership->setDescription(Utils::getFieldWithFallback($_POST, 'description'));

    $membershipModel = new MembershipModel();
    $result = $membershipModel->updateMembershipGeneralInfo($membership);

    if ($result) {
      header('Location: http://localhost/ltw-customer-management/admin/membership/update/' . $id);
    } else {
      echo '503 Update failed';
    }
  }

  // api

  private function createAPIResponse($statusCode, $data, $error)
  {
    $response = new stdClass();
    $response->statusCode = $statusCode;

    if (isset($data)) {
      // normal array
      if (is_array($data) && (isset($data[0]) && !is_object($data[0]))) {
        $response->data = $data;
      } else {
        $response->data = Utils::jsonEncodeObjectArray($data);
      }
    } else if (isset($error)) {
      $response->error = $error;
    }

    return json_encode($response);
  }

  public function getCustomers()
  {
    if (!$this->checkAuthority()) return;

    $limit = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $from = ($page - 1) * $limit;
    $allParamExceptPage = array_filter($_GET, function ($key) {
      return strcasecmp($key, 'page');
    }, ARRAY_FILTER_USE_KEY);

    $customerModel = new CustomerModel();
    $listCustomer = $customerModel->getCustomers($from, $limit, $allParamExceptPage);

    $response = new stdClass();
    if (isset($listCustomer)) {
      $response->statusCode = '201';
      $response->data = Utils::jsonEncodeObjectArray($listCustomer);
    } else {
      $response->statusCode = '503';
    }

    $response = json_encode($response);
    echo $response;
  }

  public function getAllMembership()
  {
    if (!$this->checkAuthority()) return;

    $membershipModel = new MembershipModel();
    $listMembership = $membershipModel->getAllMembership();

    if (isset($listMembership)) {
      echo $this->createAPIResponse('201', $listMembership, null);
    } else {
      echo $this->createAPIResponse('503', null, null);
    }
  }

  public function deleteMembership()
  {
    if (!$this->checkAuthority()) return;

    $id = Utils::getFieldWithFallback($_POST, 'membershipid');
    $membershipModel = new MembershipModel();
    $result = $membershipModel->deleteMembership($id);

    if ($result) {
      echo $this->createAPIResponse('201', null, null);
    } else {
      echo $this->createAPIResponse('503', null, null);
    }
  }

  public function getCustomerIncreasingStatistic($selectedYear)
  {
    if (!$this->checkAuthority()) return;

    $result = (new CustomerModel())->getCustomerIncreasingStatistic($selectedYear);

    if (isset($result)) {
      echo $this->createAPIResponse('201', $result, null);
    } else {
      echo $this->createAPIResponse('503', null, null);
    }
  }

  public function getTotalIncomeByMonthStatistic($selectedYear)
  {
    if (!$this->checkAuthority()) return;

    $result = (new PaymentModel())->getTotalIncomeByMonthStatistic($selectedYear);

    if (isset($result)) {
      echo $this->createAPIResponse('201', $result, null);
    } else {
      echo $this->createAPIResponse('503', null, null);
    }
  }

  public function getCustomerSpendingStatistic($statisticBy)
  {
    if (!$this->checkAuthority()) return;

    $listCustomer = (new CustomerModel())->getCustomerSpendingStatistic($statisticBy, 10);

    if (isset($listCustomer)) {
      echo $this->createAPIResponse('201', $listCustomer, null);
    } else {
      echo $this->createAPIResponse('503', null, null);
    }
  }
}
