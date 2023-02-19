<?php
require_once __DIR__ . '/Membership.php';

require_once __DIR__ . '/../db/db-helper.php';
require_once __DIR__ . '/../db/mapper.php';

class MembershipModel
{
  private $dbHelper;

  public function __construct()
  {
    $this->dbHelper = new DBHelper();
  }

  public function getMembershipById($id)
  {
    $sql = 'SELECT * FROM memberships WHERE membership_id = ?';

    $result = $this->dbHelper->executeQuerySingleResult([$id], 'i', $sql);

    if (isset($result)) {
      return mapRowToMembership($result);
    }

    return null;
  }

  public function getAllMembership()
  {
    $sql = 'SELECT * FROM memberships WHERE membership_id != 1';

    $result = $this->dbHelper->executeQueryNoParam($sql);

    if (isset($result)) {
      $listMembership = [];

      if (!is_bool($result)) {
        foreach ($result as $row) {
          array_push($listMembership, mapRowToMembership($row));
        }
      }

      return $listMembership;
    }

    return null;
  }

  public function addMembership($membership)
  {
    $sql = 'INSERT INTO memberships (name, description, discount, others_promotion) VALUES (?, ?, ?, ?)';

    $result = $this->dbHelper->executeQuery(
      [
        $membership->getName(), $membership->getDescription(),
        $membership->getDiscount(), $membership->getOtherPromotion()
      ],
      'ssss',
      $sql
    );

    return $result;
  }

  public function updateMembershipAdvanceInfo($membership)
  {
    $sql = 'UPDATE memberships SET discount = ?, others_promotion = ? WHERE membership_id = ?';

    $result = $this->dbHelper->executeQuery(
      [$membership->getDiscount(), $membership->getOtherPromotion(), $membership->getId()],
      'ssi',
      $sql
    );

    return $result;
  }

  public function updateMembershipGeneralInfo($membership)
  {
    $sql = 'UPDATE memberships SET name = ?, description = ? WHERE membership_id = ?';

    $result = $this->dbHelper->executeQuery(
      [$membership->getName(), $membership->getDescription(), $membership->getId()],
      'ssi',
      $sql
    );

    return $result;
  }

  public function deleteMembership($id)
  {
    $sql = 'DELETE FROM memberships WHERE membership_id = ?';

    $result = $this->dbHelper->executeQuery([$id], 'i', $sql);

    return $result;
  }
}
