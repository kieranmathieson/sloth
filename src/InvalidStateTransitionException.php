<?php

namespace Drupal\sloth;

/**
 * Exception thrown for invalid state transition in sloth. E.g., from READY_FOR_EDITING
 * to READY_FOR_VIEWING.
 */
class InvalidStateTransitionException extends \RuntimeException {}
