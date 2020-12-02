<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sistem Kepegawaian</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/lojin/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/lojin/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/lojin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/lojin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/lojin/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/lojin/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/lojin/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/lojin/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/lojin/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/lojin/css/util.css">
	<link rel="stylesheet" type="text/css" href="/lojin/css/main.css">
<!--===============================================================================================-->
<style>
    .imagecenter {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 70%;
        margin-bottom: 30px;
    }
</style>
</head>
<body style="background-color: #666666;">

<div class="limiter">

    <div class="container-login100">

        <div class="wrap-login100">

            <form class="login100-form validate-form" action="{{ route('login') }}" method="POST" style="padding:50px 55px 55px 55px;">
                @csrf
                <img src="{{asset('lojin/images/untan.png')}}" class="imagecenter" alt="" />
                <span class="login100-form-title p-b-43">
                    MASUK | LOGIN
                </span>
                @if(session('not_active'))
                <!-- Success Alert -->
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4 style="text-align: center;"><strong><i class="hi hi-check"></i>AKUN ANDA BELUM AKTIF</strong></h4>
                        <p style="text-align: center;">{{ session('not_active') }}</p>
                    </div>
                <!-- END Success Alert -->
                {{session()->forget('new')}}
                @endif
                @error('email')
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4 style="text-align: center;"><strong><i class="hi hi-check"></i>EMAIL / PASSWORD SALAH</strong></h4>
                        <p style="text-align: center;">Silahkan Hubungi Admin Apabila Lupa Cara Login.</p>
                    </div>
                @enderror
                @error('password')
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4 style="text-align: center;"><strong><i class="hi hi-check"></i>EMAIL / PASSWORD SALAH</strong></h4>
                        <p style="text-align: center;">Silahkan Hubungi Admin Apabila Lupa Cara Login.</p>
                    </div>
                @enderror
                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">

                    <input class="input100" type="text" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="focus-input100"></span>
                    <span class="label-input100">Email</span>
                </div>


                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" id="password" name="password" required autocomplete="current-password">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Password</span>
                </div>




                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>

                </div>


            </form>

            <div class="login100-more" style="background-image: url('/lojin/images/rsuntan2.jpg');">
            </div>
        </div>
    </div>
</div>





<!--===============================================================================================-->
	<script src="/lojin/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/lojin/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/lojin/vendor/bootstrap/js/popper.js"></script>
	<script src="/lojin/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/lojin/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/lojin/vendor/daterangepicker/moment.min.js"></script>
	<script src="/lojin/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/lojin/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/lojin/js/main.js"></script>

</body>
</html>
