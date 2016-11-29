<?php

namespace Drupal\d8_training;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\HttpFoundation\Request;

class QueryAccessCheck implements AccessInterface {
  public function access(Request $request) {
    $qs = $request->getQueryString();
    if($qs) { 
      return AccessResult::allowed()->cachePerPermissions();
    }
    else {
      return AccessResult::forbidden(); 
    }
  }
}
