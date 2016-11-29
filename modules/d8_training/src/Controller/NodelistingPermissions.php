<?php

namespace Drupal\d8_training\Controller;

use \Drupal\node\Entity\NodeType;

class NodelistingPermissions {
  public function getnodelistingPermissions() {
    $types = NodeType::loadMultiple();

    foreach ($types as $type) {
      $gettype = $type->get('name');

      $permissions['d8 content type permissions' . $gettype] = array (
        'title' => 'Dynamic Permission for Content Types '. $gettype,
        'description' => 'Permissions dynamically generated content type ' . $gettype
      );
    }
    return $permissions;
  }
}
