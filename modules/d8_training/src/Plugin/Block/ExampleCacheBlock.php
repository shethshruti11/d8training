<?php

namespace Drupal\d8_training\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;

/**
 * Provides a 'ExampleCacheBlock' block.
 *
 * @Block(
 *  id = "example_cache_block",
 *  admin_label = @Translation("Example cache block"),
 * )
 */
class ExampleCacheBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Database\Driver\mysql\Connection definition.
   *
   * @var Drupal\Core\Database\Driver\mysql\Connection
   */
  protected $database;
  /**
   * Construct.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        Connection $database
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('database')
    );
  }



  /**
   * {@inheritdoc}
   */
  public function build() {
    $query = $this->database->select('node_field_data', 'n');
    $query->fields('n', array('title'));
    $query->condition('n.type', 'article', '=');
    $query->orderBy('n.created', 'DESC');
    $query->range(0,3);
    $result = $query->execute()->fetchAll();
    kint($result);

    while($session = $result) {
      $row[] = $session->title;
    } 

    $build = [];
    $build['example_cache_block']['#markup'] = 'Implement ExampleCacheBlock.';

    return $build;
  }
}
