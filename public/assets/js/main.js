$(function () {

    let currentUri = location.origin + location.pathname.replace(/\/$/, '');
    $('.navbar-menu a').each(function () {
        let href = $(this).attr('href').replace(/\/$/, '');
        if (href === currentUri) {
            $(this).addClass('active');
        }
    });

    let iziModalAlertSuccess = $('.iziModal-alert-success');
    let iziModalAlertError = $('.iziModal-alert-error');

    iziModalAlertSuccess.iziModal({
        padding: 20,
        title: 'Success',
        headerColor: '#00897b'
    });
    iziModalAlertError.iziModal({
        padding: 20,
        title: 'Error',
        headerColor: '#e53935'
    });

    $('.ajax-form').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let btn = form.find('button');
        let btnText = btn.text();
        let method = form.attr('method');
        if (method) {
            method = method.toLowerCase();
        }
        let action = form.attr('action') ? form.attr('action') : location.href;

        $.ajax({
            url: action,
            type: method === 'post' ? 'post' : 'get',
            data: form.serialize(),
            beforeSend: function () {
                btn.prop('disabled', true).text('Отправляю...');
            },
            success: function (res) {
                res = JSON.parse(res);
                if (res.status === 'success') {
                    iziModalAlertSuccess.iziModal('setContent', {
                        content: res.data
                    });
                    form.trigger('reset');
                    iziModalAlertSuccess.iziModal('open');
                    if (res.redirect) {
                        $(document).on('closed', iziModalAlertSuccess, function (e) {
                            location = res.redirect;
                        });
                    }
                } else {
                    iziModalAlertError.iziModal('setContent', {
                        content: res.data
                    });
                    iziModalAlertError.iziModal('open');
                }
                btn.prop('disabled', false).text(btnText);
            },
            error: function () {
                alert('Error!');
                btn.prop('disabled', false).text(btnText);
            },
        });

    });

});