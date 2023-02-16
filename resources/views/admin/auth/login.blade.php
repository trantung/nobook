@extends('admin.layouts.main', ['title' => 'Login', 'hasCaptcha' => true, 'action' => 'admin_login'])
@section('content')
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->





    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="#"> <h4>Sign In</h4></a>

                                <div class="error mt-4 text-danger">
                                    @if($errors->any())
                                        {{ $errors->first() }}
                                    @endif
                                </div>
                                <form class="mb-5 login-input" id="admin_login-form" method="POST" action="{{ route('admin.auth.login') }}">
                                    @csrf
                                    <input type="hidden" id="gg_recaptcha" name="gg_recaptcha">

                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <button class="btn login-form__btn submit w-100 login-btn btn-secondary">Sign In</button>
                                </form>
{{--                                <p class="mt-5 login-form__footer">Dont have account? <a href="page-register.html" class="text-primary">Sign Up</a> now</p>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!--**********************************
        Scripts
    ***********************************-->

@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/login.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/admin/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/settings.js') }}"></script>
    <script src="{{ asset('assets/admin/js/gleek.js') }}"></script>
    <script src="{{ asset('assets/admin/js/styleSwitcher.js') }}"></script>
@endpush
