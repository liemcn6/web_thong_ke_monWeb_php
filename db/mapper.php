<?php

function mapRowToUser($row)
{
  return new User($row['user_id'], $row['username'], $row['password'], $row['role']);
}

function mapRowToCustomer($row)
{
  $customer = new Customer();

  $customer->setId($row['customer_id']);
  $customer->setFullName($row['full_name']);
  $customer->setGender($row['gender']);
  $customer->setDateOfBirth($row['date_of_birth']);
  $customer->setAddress($row['address']);
  $customer->setEmail($row['email']);
  $customer->setPhoneNumber($row['phone_number']);
  $customer->setNote($row['note']);
  $customer->setTotalSpending($row['total_spending']);

  if (isset($row['name'])) {
    $membership = new Membership();
    $membership->setId($row['membership_id']);
    $membership->setName($row['name']);
    $membership->setDescription($row['description']);
    $membership->setDiscount($row['discount']);
    $membership->setOtherPromotion($row['others_promotion']);
    $membership->setTotalMember($row['total_member']);
    $membership->setCreatedDate($row['created_date']);
    
    $customer->setMembership($membership);
  }


  return $customer;
}

function mapRowToMembership($row)
{
  $membership = new Membership();

  $membership->setId($row['membership_id']);
  $membership->setName($row['name']);
  $membership->setDescription($row['description']);
  $membership->setDiscount($row['discount']);
  $membership->setOtherPromotion($row['others_promotion']);
  $membership->setTotalMember($row['total_member']);
  $membership->setCreatedDate($row['created_date']);

  return $membership;
}
