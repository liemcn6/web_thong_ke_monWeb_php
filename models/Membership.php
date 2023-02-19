<?php

class Membership
{
  private $id;
  private $name;
  private $description;
  private $discount;
  private $otherPromotion;
  private $totalMember;
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
   * Get the value of name
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of description
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get the value of discount
   */
  public function getDiscount()
  {
    return $this->discount;
  }

  /**
   * Set the value of discount
   *
   * @return  self
   */
  public function setDiscount($discount)
  {
    $this->discount = $discount;

    return $this;
  }

  /**
   * Get the value of otherPromotion
   */
  public function getOtherPromotion()
  {
    return $this->otherPromotion;
  }

  /**
   * Set the value of otherPromotion
   *
   * @return  self
   */
  public function setOtherPromotion($otherPromotion)
  {
    $this->otherPromotion = $otherPromotion;

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

  /**
   * Get the value of totalMember
   */
  public function getTotalMember()
  {
    return $this->totalMember;
  }

  /**
   * Set the value of totalMember
   *
   * @return  self
   */
  public function setTotalMember($totalMember)
  {
    $this->totalMember = $totalMember;

    return $this;
  }

  public function jsonSerialize()
  {
    return get_object_vars($this);
  }
}
