<?php
require_once('config.php');

class DBHelper
{
  private $conn;

  function __construct()
  {
    $this->conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  function createPreparedStatement($params, $paramTypes, $sql)
  {
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param($paramTypes, ...$params);

    return $stmt;
  }

  function executeQueryNoParam($sql)
  {
    $result = $this->conn->query($sql);

    if (is_bool($result)) return $result;

    $data = [];
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }

    return $data;
  }

  function executeQuery($params, $paramTypes, $sql)
  {
    if ($stmt = $this->conn->prepare($sql)) {
      $stmt->bind_param($paramTypes, ...$params);
      $result = $stmt->execute();

      return $result;
    }

    return false;
  }

  function executeQueryResult($params, $paramTypes, $sql)
  {
    if ($stmt = $this->conn->prepare($sql)) {
      $stmt->bind_param($paramTypes, ...$params);

      $stmt->execute();
      $result = $stmt->get_result();

      $data   = [];
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }

      return $data;
    }

    return null;
  }

  function executeQuerySingleResult($params, $paramTypes, $sql)
  {
    if ($stmt = $this->conn->prepare($sql)) {
      $stmt->bind_param($paramTypes, ...$params);

      $stmt->execute();
      $result = $stmt->get_result();

      if (($row = $result->fetch_assoc())) {
        return $row;
      }

      return null;
    }

    return null;
  }

  function closeStatment($stmt)
  {
    $stmt->close();
  }

  function closeConnection()
  {
    $this->conn->close();
  }

  function getLastIdInserted()
  {
    if (isset($this->conn)) {
      return $this->conn->insert_id;
    }

    return null;
  }
}
