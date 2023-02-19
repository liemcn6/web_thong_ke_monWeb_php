<?php

class Customer
{
  private $id;
  private $fullName;
  private $gender;
  private $phoneNumber;
  private $email;
  private $address;
  private $dateOfBirth;
  private $avatar;
  private $totalSpending;
  private $membership;
  private $note;

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

  /**
   * Get the value of gender
   */
  public function getGender()
  {
    return $this->gender;
  }

  /**
   * Set the value of gender
   *
   * @return  self
   */
  public function setGender($gender)
  {
    $this->gender = $gender;

    return $this;
  }

  /**
   * Get the value of phoneNumber
   */
  public function getPhoneNumber()
  {
    return $this->phoneNumber;
  }

  /**
   * Set the value of phoneNumber
   *
   * @return  self
   */
  public function setPhoneNumber($phoneNumber)
  {
    $this->phoneNumber = $phoneNumber;

    return $this;
  }

  /**
   * Get the value of email
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the value of email
   *
   * @return  self
   */
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of dateOfBirth
   */
  public function getDateOfBirth()
  {
    return $this->dateOfBirth;
  }

  /**
   * Set the value of dateOfBirth
   *
   * @return  self
   */
  public function setDateOfBirth($dateOfBirth)
  {
    $this->dateOfBirth = $dateOfBirth;

    return $this;
  }

  /**
   * Get the value of address
   */
  public function getAddress()
  {
    return $this->address;
  }

  /**
   * Set the value of address
   *
   * @return  self
   */
  public function setAddress($address)
  {
    $this->address = $address;

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
   * Get the value of membership
   */
  public function getMembership()
  {
    return $this->membership;
  }

  /**
   * Set the value of membership
   *
   * @return  self
   */
  public function setMembership($membership)
  {
    $this->membership = $membership;

    return $this;
  }
  /**
   * Get the value of totalSpending
   */
  public function getTotalSpending()
  {
    return $this->totalSpending;
  }

  /**
   * Set the value of totalSpending
   *
   * @return  self
   */
  public function setTotalSpending($totalSpending)
  {
    $this->totalSpending = $totalSpending;

    return $this;
  }

  /**
   * Get the value of note
   */
  public function getNote()
  {
    return $this->note;
  }

  /**
   * Set the value of note
   *
   * @return  self
   */
  public function setNote($note)
  {
    $this->note = $note;

    return $this;
  }

  public function jsonSerialize()
  {
    return get_object_vars($this);
  }
}
