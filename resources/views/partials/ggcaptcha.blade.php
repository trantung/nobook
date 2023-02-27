@if(isset($hasCaptcha) && $hasCaptcha)
    @php
        $captchaKey = env('GOOGLE_RECAPTCHA_KEY');
    @endphp
    <script src="https://www.google.com/recaptcha/api.js?render={{ $captchaKey }}"></script>
    <script>
        $(document).ready(function () {
            grecaptcha.ready(function() {
                // do request for recaptcha token
                // response is promise with passed token
                let loginButton = $('.login-btn');
                loginButton.removeClass('btn-secondary').prop('disabled', false);
                loginButton.off('click');
                loginButton.on('click', function (e) {
                    e.preventDefault();
                    grecaptcha.execute("{{ $captchaKey }}", {action: "{{ $action ?? 'login' }}"})
                        .then(function(token) {
                            // add token value to form
                            $('#gg_recaptcha').val(token);
                            $("{{'#'.$action.'-form'}}").submit();
                        });
                });

                {{--setInterval(function(){--}}
                {{--    grecaptcha.execute("{{ $captchaKey }}", {action: "{{ $action ?? 'login' }}"}).then(function(token) {--}}
                {{--        $('#gg_recaptcha').val(token);--}}
                {{--    });--}}
                {{--}, 60000);--}}
            });
        });
    </script>
@endif
