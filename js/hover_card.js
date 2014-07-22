(function($) {
    Drupal.behaviors.hover_card = {
        attach: function(context, settings) {
            var modulePath = Drupal.settings.hover_card.path;
            var hoverUserDetails = '<div class="hover-details"></div>';
            $("a.username").hovercard({
                detailsHTML: hoverUserDetails,
                width: 250,
                onHoverIn: function() {
                    var title = $(this).text();
                    $.ajax({
                        url: Drupal.settings.basePath + "hover-card",
                        type: 'GET',
                        data: {
                            id: title,
                        },
                        beforeSend: function() {
                            $(".hover-details").empty();
                            $(".hover-details").prepend('<p class="loading-text"><img src="' + modulePath + '/images/ajax-loader.gif"></p>');
                        },
                        success: function(data) {
                            var obj = $.parseJSON(data);
                            $(".hover-details").empty();
                            $(".hover-details").html('<strong>' + obj.name + '<strong>');
                        },
                        complete: function() {
                            $('.loading-text').remove();
                        }
                    });
                }
            });
        }
    };
})(jQuery);
