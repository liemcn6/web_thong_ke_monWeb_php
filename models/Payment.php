<?php

class Payment
{
  private $id;
  private $orderNumber;
  private $amount;
  private $createdDate;

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
   * Get the value of orderNumber
   */
  public function getOrderNumber()
  {
    return $this->orderNumber;
  }

  /**
   * Set the value of orderNumber
   *
   * @return  self
   */
  public function setOrderNumber($orderNumber)
  {
    $this->orderNumber = $orderNumber;

    return $this;
  }

  /**
   * Get the value of amount
   */
  public function getAmount()
  {
    return $this->amount;
  }

  /**
   * Set the value of amount
   *
   * @return  self
   */
  public function setAmount($amount)
  {
    $this->amount = $amount;

    return $this;
  }

  /**
   * Get the value of createdDate
   */
  public function getCreatedDate()
  {
    return $this->createdDate;
  }

  /**
   * Set the value of createdDate
   *
   * @return  self
   */
  public function setCreatedDate($createdDate)
  {
    $this->createdDate = $createdDate;

    return $this;
  }
}
