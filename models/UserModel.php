<?php
require_once __DIR__ . '/../db/db-helper.php';
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/../db/mapper.php';
require_once __DIR__ . '/models/Customer.php';

class UserModel
{
  public function getUserByUsername()
  {
    $sql = 'SELECT * FROM users WHERE username=?';
  }
}
