var Test = {
	common: {
		 error: function (messages) {
            var html = '';
            $.each(messages, function (k, v) {
                html += v;
            });

            return '<div class="alert alert-danger face" style="margin-left: 0;">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                '<h4>Lỗi!</h4>' +
                '<div class="list-unstyled">' +html+ '</ul>' +
                '</div>';
        },
	}
}

$(document).ready(function () {
	$('.profile-avatar img').hover(
        function() {
            $('.label-avatar').addClass('hover-elm');
        }, function() {
            $('.label-avatar').removeClass('hover-elm');
        }
    );
    $('.label-avatar').hover(function() {
        $(this).addClass('hover-elm');
    }, function () {
        $(this).removeClass('hover-elm');
    });
    $('#date-picker').datepicker({
        format: 'dd-mm-yyyy',
    })


    $('body').on('click', '.btn-register', function() {

        $('.form-register').ajaxSubmit({
        url: '/user/sign_up',
        success: function (res) {
        	console.log(res)
            if (res.status) {
                window.location.href = res.url;
            } else {
                $('.form-register').find('.error').html(Test.common.error(res.messages));
            }
        }
    });

    })
});