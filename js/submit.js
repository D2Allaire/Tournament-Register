$(function(){
    var form = $('#ajax-submit');
    var formMessage = $('#form-message');

    $(form).submit(function(event) {
        event.preventDefault();
        var formData = $(form).serialize();

        $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: formData
            })

            .done(function(response) {
                $(formMessage).removeClass('error');
                $(formMessage).addClass('success');
                $(formMessage).text(response);
                $("html, body").animate({ scrollTop: 0 }, "fast");

                $('#name').val('');
                $('#url').val('');
                $('#description').val('');
                $('#prize').val('');
                $('#fee').val('');
                $('#region').val('');
                $('#signups').val('');
                $('#type').val('');
                $('#format').val('');
                $('#signups-comment').val('');
            })

            .fail(function(data) {
                $(formMessage).removeClass('success');
                $(formMessage).addClass('error');

                if (data.responseText !== ''){
                    $(formMessage).text(data.responseText);
                } else {
                    $(formMessage).text('Oops! An error ocurred and your submission could not be sent.');
                }
            });
    });
});