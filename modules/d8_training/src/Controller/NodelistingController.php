<?php

namespace Drupal\d8_training\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class NodelistingController extends ControllerBase {
  public function content() {
    return array(
      //'#markup' => 'Hello Shruti!!'
    	'#theme' => 'item_list',
    	'#items' => array('1', '2')
    );
  }

  public function dynamic_content($node) {
    return array(
      '#markup' => $node . ' Hello Shruti!!'
    );
  }

   public function example_content(NodeInterface $node) {
    return new JsonResponse($node->getTitle());
  }
}
