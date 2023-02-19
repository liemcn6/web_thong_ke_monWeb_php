<?php

class User
{
  private $id;
  private $username;
  private $password;
  private $fullName;
  private $role;


  function __construct($id, $username, $password, $role)
  {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->role = $role;
  }

  /**
   * Get the value of username
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * Set the value of username
   *
   * @return  self
   */
  public function setUsername($username)
  {
    $this->username = $username;

    return $this;
  }

  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of password
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set the value of password
   *
   * @return  self
   */
  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }


  /**
   * Get the value of role
   */
  public function getRole()
  {
    return $this->role;
  }

  /**
   * Set the value of role
   *
   * @return  self
   */
  public function setRole($role)
  {
    $this->role = $role;

    return $this;
  }

  /**
   * Get the value of avatar
   */
  public function getAvatar()
  {
    return $this->avatar;
  }

  /**
   * Set the value of avatar
   *
   * @return  self
   */
  public function setAvatar($avatar)
  {
    $this->avatar = $avatar;

    return $this;
  }

  /**
   * Get the value of fullName
   */
  public function getFullName()
  {
    return $this->fullName;
  }

  /**
   * Set the value of fullName
   *
   * @return  self
   */
  public function setFullName($fullName)
  {
    $this->fullName = $fullName;

    return $this;
  }
}
