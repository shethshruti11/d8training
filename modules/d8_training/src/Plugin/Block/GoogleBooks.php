<?php

namespace Drupal\d8_training\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use AntoineAugusti\Books\Fetcher;
use GuzzleHttp\Client;
/**
 * Provides a 'GoogleBooks' block.
 *
 * @Block(
 *  id = "google_books",
 *  admin_label = @Translation("Google books"),
 * )
 */
class GoogleBooks extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['isbn'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('ISBN'),
      '#description' => $this->t('ISBN value of the book for which we fetch the details.'),
      '#default_value' => isset($this->configuration['isbn']) ? $this->configuration['isbn'] : '',
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['isbn'] = $form_state->getValue('isbn');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $client = new Client(['base_uri' => 'https://www.googleapis.com/books/v1/']);
    $fetcher = new Fetcher($client);
    $book = $fetcher->forISBN('9780142181119');

    $build = [];
    $build['google_books_isbn']['#markup'] = '<p>' . $book->title . '</p>';

    return $build;
  }

}
