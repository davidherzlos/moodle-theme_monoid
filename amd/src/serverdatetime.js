/* jshint ignore:start */
define(['jquery', 'core/log'], function($, log) {

  "use strict"; // jshint ;_;

  log.debug('Monoid ServerDateTime AMD');

  return {
      init: function(data) {
          $(document).ready(function() {
              log.debug(data.courseurl);
              var sdtb = $('#serverdatetimebtn');
              if (sdtb.length) {
                  var tsdt = $('#theserverdatetime');
                  sdtb.click(function() {
                      $.ajax({
                          url: data.courseurl,
                          statusCode: {
                              '404': function() {
                                  log.debug("Monoid ServerDateTime - url '" + data.courseurl + "' not found.");
                              }
                          }
                      }).done(function(data) {
                          log.debug('Monoid ServerDateTime: ' + data);
                          tsdt.text(data);
                      }).fail(function(jqXHR, textStatus) {
                          log.debug('Monoid ServerDateTime request failed: ' + textStatus);
                      });
                  });
              } else {
                  log.debug('Monoid ServerDateTime: No button.');
              }
          });
          log.debug('Monoid ServerDateTime AMD init');
      }
  };
});
/* jshint ignore:end */
