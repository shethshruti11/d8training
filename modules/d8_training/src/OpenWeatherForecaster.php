<?php

namespace Drupal\d8_training;

use Drupal\Core\Config\ConfigFactory;
use GuzzleHttp\Client;
use Drupal\Component\Serialization\Json;

class OpenWeatherForecaster {
  private $httpclient;
  private $config_factory;

  public function __construct(Client $httpclient, ConfigFactory $config_factory) {
    $this->config_factory = $config_factory;
    $this->httpclient = $httpclient;
  }

  public function fetchWeatherData($cityname) {    
    $appid = '105816f6c350911c19f1373f69675be7';
    $res = $this->httpclient->request('GET', 'http://api.openweathermap.org/data/2.5/weather?q='. $cityname .'&appid=' . $appid, []);
    $contents = $res->getBody()->getContents();
    $weatherDataArray = Json::decode($contents);
    return $weatherDataArray;
  }
}
