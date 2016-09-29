<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 9/28/16
 * Time: 9:35 AM
 */

namespace Drupal\sloth;

//use Drupal\Core\Routing\RouteMatchInterface;
//use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityInterface;
//use Drupal\Component\Utility\Html;
use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

class SlothTagHandler {

  /**
   * The configuration storage service.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The entity field manager.
   *
   * @var \Drupal\Core\Entity\EntityFieldManagerInterface
   */
  protected $entityFieldManager;

  /* $slothConfigs Configuration of the sloths, set by admin. */
  protected $slothConfigs;

  /* $configAllowedContentTypes What content types are allowed to have
   * sloths embedded in them. Stores an array of content type names.*/
  protected $configAllowedContentTypes;

  /* $config_allowed_ What fields are allowed to have
   * sloths embedded in them. Stores an array of field names. */
  protected $configAllowedFields;

  /* $configAllowedTieldTypes What field types are allowed to have
   * sloths embedded in them. Stores an array of type names. */
  protected $configAllowedFieldTypes;

  protected $htmlPreprocessing;

  protected $htmlPostProcessing;
  /**
   * SlothTagHandler constructor.
   *
   * Load sloth configuration data set by admin.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   * @param \Drupal\Core\Entity\EntityFieldManagerInterface $entity_field_manager
   */
  function __construct(ConfigFactoryInterface $configFactory, EntityFieldManagerInterface $entity_field_manager ){
    $this->configFactory = $configFactory;
    $this->entityFieldManager = $entity_field_manager;
    //Load module configs.
    $this->slothConfigs = $configFactory->get('sloth.settings');
    //Which content types have sloths embedded?
    $this->configAllowedContentTypes = $this->slothConfigs->get('content_types');
    //Get allowed fields.
    $this->configAllowedFields = $this->slothConfigs->get('fields');
    //Get allowed field types.
    $this->configAllowedFieldTypes = explode(',', $this->slothConfigs->get('field_types'));
  }

  /**
   * Return a list of the names of fields that are allowed to have
   * sloth shards in them.
   *
   * @param EntityInterface $entity Entity with the fields.
   * @return array Names of fields that may have sloths embedded.
   */
  public function listFieldsEligibleForSlothEmbedding(EntityInterface $entity) {
    $field_names = [];
    //Is this a node?
    if ($entity->getEntityTypeId() == 'node') {
      //Is this content type allowed?
      if (in_array($entity->bundle(), $this->configAllowedContentTypes)) {
        //Get definitions of the fields in the bundle.
        $field_defs = $this->entityFieldManager->getFieldDefinitions('node', $entity->bundle());
        //Loop across fields.
        foreach ($field_defs as $field_name => $field_def) {
          //Is the field allowed?
          if (in_array($field_name, $this->configAllowedFields)) {
            //Is the field type allowed?
            if (in_array(
                  $field_def->getFieldStorageDefinition()->getType(),
                  $this->configAllowedFieldTypes
               )) {
              $field_names[] = $field_name;
            } //End field type is allowed.
          } //End field is allowed.
        } //End foreach.
      } //End content type is allowed.
    } //End entity is a node.
    return $field_names;
  }

  /**
   * @return mixed
   */
  public function getHtmlPreprocessing() {
    return $this->htmlPreprocessing;
  }

  /**
   * @param mixed $htmlPreprocessing
   * @return SlothTagHandler
   */
  public function setHtmlPreprocessing($htmlPreprocessing) {
    $this->htmlPreprocessing = $htmlPreprocessing;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getHtmlPostProcessing() {
    return $this->htmlPostProcessing;
  }

  /**
   * @param mixed $htmlPostProcessing
   * @return SlothTagHandler
   */
  public function setHtmlPostProcessing($htmlPostProcessing) {
    $this->htmlPostProcessing = $htmlPostProcessing;
    return $this;
  }

public function processSlothTagsOnNodeEditForm(FormStateInterface $form_state) {
//  $entity = $form_state->getFormObject()->getEntity();
//
//  if ( $entity->getEntityTypeId() != 'node' ) {
//    return;
//  }
//  //Get the names of the fields that are eligible for sloths.
//  $eligible_fields = $this->listFieldsEligibleForSlothEmbedding($entity);



//  $form_values = $form_state->getValues();
//  //For each field on the form...
//  $data_changed = false;
//  foreach( $form_values as $field_name => $field_values ) {
//    //Is the field one that can be slothed?
//    if ( in_array($field_name, $eligible_fields) ) {
//      //Aye. Go over each of its values (could be multivalued).
//      foreach ($field_values as $key => $field_value) {
//        //Push the HTML into the processor.
//        $sloth_tag_handler->setHtmlPreprocessing($field_value['value']);
//        //Process, checking whether there were any changes.
//        if ( $sloth_tag_handler->processSlothTags() ) {
//          //Save the new data into the values array.
//          $form_values[$field_name][$key]['value']
//            = $sloth_tag_handler->getHtmlPostProcessing();
//          //Set flag to show there have been changes.
//          $data_changed = true;
//        }
//      } //End for each value in multi-valued field.
//    } //End field is eligible for slothing.
//
//  } //End foreach field on the form.
//  //Were any changes made to the form fields?
//  if ( $data_changed ) {
//    $form_state->setValues($form_values);
//  }

}


  public function processSlothTag() {
    $changed = false;

    return $changed;
  }

}