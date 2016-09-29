<?php

namespace Drupal\sloth\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class TestController.
 *
 * @package Drupal\sloth\Controller
 */
class TestController extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function configTest() {
    /* \Drupal\Core\Config\ImmutableConfig $a */
    $a = \Drupal::config('sloth.settings');
    $b = $a->get('content_types');
    /* \Drupal\Core\Config\Config $c */
    $c = \Drupal::configFactory()->getEditable('sloth.settings');
    $c->set('content_types', [ 'page', 'article' ]);
    $c->save();
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello')
    ];
  }

}
