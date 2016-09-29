<?php

namespace Drupal\sloth\Tests;

use Drupal\simpletest\WebTestBase;
use Drupal\sloth\SlothTagProcessor;
use Drupal\sloth\InvalidStateTransitionException;


/**
 * Provides automated tests for the SlothTagProcessor class in the sloth module.
 *
 * @group sloth
 */
class SlothTagProcessorTest extends WebTestBase {


  /**
   * Tests dom_test functionality.
   */
  public function testStateTransitionValidation() {
    $tag_processor = new SlothTagProcessor();
    //Bad transition.
    try {
      $tag_processor->transition(SlothTagProcessor::READY_FOR_EDITING, SlothTagProcessor::READY_FOR_VIEWING);
      $this->fail(t('Expected transition exception not thrown.'));
    }
    catch( InvalidStateTransitionException $e){
      $this->pass(t('Expected InvalidStateTransitionException thrown.'));
    };

    //Good transition.
    try {
      $tag_processor->transition(
        SlothTagProcessor::READY_FOR_EDITING, SlothTagProcessor::DB_STORAGE);
      $this->pass(t('Valid transition did not throw exception.'));
    }
    catch( InvalidStateTransitionException $e){
      $this->fail(t('Valid transition did not throw exception.'));
    };



//    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}