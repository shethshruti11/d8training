<?php

namespace Drupal\test\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class testController.
 *
 * @package Drupal\test\Controller
 */
class testController extends ControllerBase {
  /**
   * Mymethod.
   *
   * @return string
   *   Return Hello string.
   */
  public function mymethod() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: mymethod')
    ];
  }

}
