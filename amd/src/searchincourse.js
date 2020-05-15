/* jshint ignore:start */
define(['jquery', 'core/log'], function($, log) {
    return {
        init: function(data) {
            $(document).ready(function() {
                log.debug(data);
                var $buttonElement = document.querySelector(data.button);
                var $inputElement = document.querySelector(data.input);
                $buttonElement.addEventListener('click', function(event) {
                    event.preventDefault();
                    if ($inputElement.value !== '') {
                        alert($inputElement.value);
                    }
                });

            });
        }
    };

});
/* jshint ignore:end */
