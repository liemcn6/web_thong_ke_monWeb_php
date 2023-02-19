<?php

require_once __DIR__ . '/../db/db-helper.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../db/mapper.php';

class AuthController
{
  private $dbHelper;

  function __construct()
  {
    session_start();
    $this->dbHelper = new DBHelper();
  }

  function login()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $this->dbHelper->executeQuerySingleResult(
      [$username],
      's',
      'SELECT * FROM users WHERE username=?'
    );

    if ($result != null && password_verify($password, $result['password'])) {

      $user = mapRowToUser($result);

      $_SESSION['userid'] = $user->getId();
      $_SESSION['username'] = $user->getUsername();
      $_SESSION['role'] = $user->getRole();

      if ($user->getRole() == 0) {
        header("Location: http://localhost/ltw-customer-management/admin");
      } else {
        header("Location: http://localhost/ltw-customer-management/");
      }
    } else {
      echo 'null';
    }
  }

  function register()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 0;
    $hasedPassword = password_hash($password, PASSWORD_BCRYPT);

    if ($this->dbHelper->executeQuery(
      [$username, $hasedPassword, $role],
      'ssi',
      'INSERT INTO users(username, password, role) VALUES(?, ?, ?)'
    )) {
      header("Location: http://localhost/ltw-customer-management/");
    } else {
      header("Location: http://localhost/ltw-customer-management/register");
    }
    die();
  }

  function logout()
  {
    session_unset();
    session_destroy();
    header("Location: http://localhost/ltw-customer-management/");
  }

  function showLoginPage()
  {
    $isLoggedIn = $this->checkLoggedIn();
    if (!$isLoggedIn) {
      require_once __DIR__ . '/../views/pages/login-page.php';
    }
  }

  function showRegisterPage()
  {
    $isLoggedIn = $this->checkLoggedIn();
    if (!$isLoggedIn) {
      require_once __DIR__ . '/../views/pages/register-page.php';
    }
  }

  private function checkLoggedIn()
  {
    // logged in
    if (isset($_SESSION['userid'])) {
      // admin role -> admin page
      if ($_SESSION['role'] == 0) {
        header("Location: http://localhost/ltw-customer-management/admin");
      } else {
        header("Location: http://localhost/ltw-customer-management/");
      }

      return true;
    }

    return false;
  }
}
