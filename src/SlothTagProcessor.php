<?php

/**
 * @file
 * Handle sloth tag processing in some HTML. The processing needed
 * varies, depending on the state of the HTML. For example,
 * to show some HTML with sloth tags (view a node), the HTML is first
 * loaded from the DB (in DB_STORAGE state), then prepared for viewing
 * (READY_FOR_VIEWING state), then shown to the user.
 *
 * This class handles translating HTML between states.
 *
 * @author Kieran Mathieson
 */

namespace Drupal\sloth;

class SlothTagProcessor {

  /**
   * HTML with sloth tags.
   *
   * @var string
   */
  protected $html;

  /**
   * @return string
   */
  public function getHtml() {
    return $this->html;
  }

  /**
   * @param string $html
   * @return SlothTagProcessor
   */
  public function setHtml($html) {
    $this->html = $html;
    return $this;
  }

  /**
   * HTML state is not known.
   *
   * @var int
   */
  const UNKNOWN = 0;

  /**
   * HTML is coming from CKEditor. Should be converted for saving to DB.
   *
   * @var int
   */
  const EDITED_BY_USER_FROM_CKEDITOR = 1;

  /**
   * HTML is as it is stored in the DB. Ready to save to DB, or has just been
   * loaded.
   *
   * @var int
   */
  const DB_STORAGE = 2;

  /**
   * HTML is ready to show to an end user.
   *
   * @var int
   */
  const READY_FOR_VIEWING = 3;

  /**
   * HTML is is ready to put into CKEditor for editing.
   *
   * @var int
   */
  const READY_FOR_EDITING = 4;

  /**
   * What state is the HTML in?
   *
   * @var int
   */
  protected $htmlState;

  /**
   * Set of valid state transitions. An array, where the key is the start
   * state, and the item is the end state.
   *
   * @var int[]
   *
   */
  protected $validTransitions;

  public function __construct($html = '') {
    $this->htmlState = self::UNKNOWN;
    $this->html = $html;
    $this->validTransitions = [
      [self::UNKNOWN, self::DB_STORAGE],
      [self::DB_STORAGE, self::READY_FOR_VIEWING],
      [self::DB_STORAGE, self::READY_FOR_EDITING],
      [self::READY_FOR_EDITING, self::DB_STORAGE],
    ];
  }

  public function transition($start_state, $end_state) {
    if ( ! in_array([$start_state, $end_state], $this->validTransitions) ) {
      throw new InvalidStateTransitionException(
        "Transition from $start_state to $end_state not allowed."
      );
    }
  }


}