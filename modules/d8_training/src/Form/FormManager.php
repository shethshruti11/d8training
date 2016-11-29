<?php

namespace Drupal\d8_training;

class FormManager {
  private $connection;

  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  public function fetchData() {
    $query = $this->connection->select('custom_form', 'd8t')
    $query->fields('d8t', array());
    $query->range(0,1);    
    $result = $query->execute()->fetchAssoc();
    return $result['echo me'];
  }

  public function addData() {

  }
}
