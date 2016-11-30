<?php

namespace Drupal\d8_training\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\d8_training\OpenWeatherForecaster;

/**
 * Provides a 'WeatherBlock' block.
 *
 * @Block(
 *  id = "weather block",
 *  admin_label = @Translation("WeatherBlock"),
 * )
 */

class WeatherBlock extends Blockbase implements ContainerFactoryPluginInterface {

  private $weatherinfo;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, OpenWeatherForecaster $weatherinfo) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->weatherinfo = $weatherinfo;
  }

  public function blockForm($form, FormStateInterface $form_state) {
     $form['city'] = array(
       '#type' => 'textfield',
       '#title' => 'City',
       '#default_value' => $this->getConfiguration()['city']
     );
     return $form;
  }

  public function build() {
    $build['weather_block_city'] = array(
      '#theme' => 'd8_training_weather',
      '#weather_data' => $this->weatherinfo->fetchWeatherData('Pune'),
      '#attached' => [
        'library' => ['d8_training/weather_widget']
      ] 
    );

    return $build;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfiguration(array('city' => $form_state->getValue('city')));
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static ($configuration, $plugin_id, $plugin_definition, $container->get('d8_training.weather_forecast'));
  }
}
