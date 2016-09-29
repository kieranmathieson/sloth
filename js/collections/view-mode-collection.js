/**
 * @file
 * Models a folio of view modes. Yes, that's the collective noun.
 *
 * The data is shared across all instances of CKEditor on the page.
 */
(function ($, Drupal) {

  "use strict";

  Drupal.SlothSpace.collections.Folio = Backbone.Collection.extend({
      model: Drupal.SlothSpace.models.ViewMode,
      url: function(){
        var result = '/sloth/view-modes?_format=json';
        console.log('Sloth view mode collection URL: ' + result);
        return result;
      }
  });

})(jQuery, Drupal);