jQuery(document).ready(function($) {
    $('form.ajax').on('submit', function(e) {
        e.preventDefault();
        var that = $(this),
            url = that.attr('action'),
            type = that.attr('method');
        var name = $('.name').val();
        var email = $('.email').val();
        var message = $('.message').val();
        $.ajax({
            url: cpm_object.ajax_url,
            type: "POST",
            dataType: 'type',
            data: {
                action: 'set_form',
                name: name,
                email: email,
                message: message,
            },
            success: function(response) {
                alert("Successfully sent");
            },
            error: function(data) {
                alert("Email not sent");
            }
        });
        $('.ajax')[0].reset();
    });
});