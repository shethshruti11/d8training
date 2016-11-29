<?php

namespace Drupal\d8_training\Controller;

use \Drupal\node\Entity\NodeType;

class NodelistingPermissions {
  public function getnodelistingPermissions() {
    $types = NodeType::loadMultiple();
    dsm ($types);
  }
}
