<?php

namespace Drupal\d8_training\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Database\Driver\mysql\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NodelistingController extends ControllerBase {
  public function content() {
    $nodedata = $this->database->select('node', 'n')
                  ->fields('n', array())
                  ->execute();

    $header = array(
      $this->t('nid'),
      $this->t('vid'),
      $this->t('type'),
      $this->t('langcode')
    );

    $rows = [];

    while($session = $nodedata->fetchAssoc()) {
      $row = array (
        'data' => array()
      );

      $row['data'][] = $session['nid'];
      $row['data'][] = $session['vid'];
      $row['data'][] = $session['type'];
      $row['data'][] = $session['langcode'];

      $rows[] = $row;
    }

    $output[] = [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => 'No data found!'
    ];

    return $output;
  }

  public function dynamic_content($node) {
    return array(
      '#markup' => $node . ' Hello Shruti!!'
    );
  }

   public function example_content(NodeInterface $node) {
    return new JsonResponse($node->getTitle());
  }

  public static function create (ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  private $database;
  public function __construct(Connection $database) {
    $this->database = $database;
  }
}
