<?php

namespace Drupal\d8_training\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'WeatherBlock' block.
 *
 * @Block(
 *  id = "weather block",
 *  admin_label = @Translation("WeatherBlock"),
 * )
 */

class WeatherBlock extends Blockbase {
  public function blockForm($form, FormStateInterface $form_state) {
     $form['city'] = array(
       '#type' => 'textfield',
       '#title' => 'City'
     );
     return $form;
  }

  public function build() {
    return array(
      '#markup' => 'Hi inside Block');
  }
}
