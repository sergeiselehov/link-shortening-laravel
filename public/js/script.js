$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#form_link').on('submit', function (e) {
        e.preventDefault();
        var _this = $(this);
        var error = _this.find('#error-link');
        var success = _this.find('#success-link');
        if(error.is(":visible")) {
            error.hide();
            error.empty();
        }
        if(success.is(":visible")) {
            success.hide();
            success.empty();
        }
        $.ajax({
            url: '/create',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if(response) {
                    success.append('Сокращенная ссылка: '+response.success);
                    success.show();
                    _this[0].reset();
                }
            },
            error: function (response) {
                if(response) {
                    error.append(response.responseJSON.errors.link[0]);
                    error.show();
                }
            }
        });
    });
});
