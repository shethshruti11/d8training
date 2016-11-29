<?php

namespace Drupal\d8_training\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;

class SimpleForm extends FormBase {
  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  public function getFormId() {
    return 'custom-form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

     $form['first_name'] = array(
      '#type' => 'textfield',
      '#title' => 'First Name',
      '#maxlength' => '20'
    );
     $form['last_name'] = array(
      '#type' => 'textfield',
      '#title' => 'Last Name',
      '#maxlength' => '20'
    );
     $form['submit'] = array(
      '#value' => 'submit',
      '#type' => 'submit',
    );
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
   // $form_state->setErrorByName('first_name', t('Please add this field and then Submit'));
    //dsm($formvalues); 
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    $inputdata = $this->connection->insert('custom_form')->fields(
      array(
      	'firstname' => $form_state->getValue('first_name')
      )         
    )->execute();
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }
}
