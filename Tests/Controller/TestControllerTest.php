<?php

namespace Drupal\sloth\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the sloth module.
 */
class TestControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "sloth TestController's controller functionality",
      'description' => 'Test Unit for module sloth and controller TestController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests sloth functionality.
   */
  public function testTestController() {
    // Check that the basic functions of module sloth.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
