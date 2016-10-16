<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 10/9/16
 * Time: 2:06 PM
 */

namespace Drupal\sloth;

use Drupal\Core\Entity\EntityInterface;

interface EligibleFieldsInterface {

  public function listEntityEligibleFields(EntityInterface $entity);

}