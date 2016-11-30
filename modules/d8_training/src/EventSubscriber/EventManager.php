<?php

namespace Drupal\d8_training\EventSubscriber;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventManager implements EventSubscriberInterface {
  public static function getSubscribedEvents() {
    $events[KernelEvents::RESPONSE][] = array('addheaderwithevents');

    return $events;
  }

  public function addheaderwithevents(FilterResponseEvent $event) {
    $response = $event->getResponse();
    $response->headers->add(['Access-Control-Allow-Origin' => '*']);
  }
}
