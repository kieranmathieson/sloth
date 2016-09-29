/**
 * @file
 * Models a pack of sloths. There is no accepted collective noun for sloths,
 * AFAIK.
 *
 * The data is shared across all instances of CKEditor on the page.
 */
(function ($, Drupal) {

  "use strict";

  Drupal.SlothSpace.collections.Pack = Backbone.Collection.extend({
      model: Drupal.SlothSpace.models.Sloth,
      url: function(){
        var result = '/sloth/index?_format=json';
        console.log('Sloth collection URL: ' + result);
        return result;
      }
  });

})(jQuery, Drupal);