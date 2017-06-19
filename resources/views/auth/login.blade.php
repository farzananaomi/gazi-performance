<html>
<head>
    <title>GAZI Performance | GAZI VM</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="theme-color" content="#7286A1">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#7286A1">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#7286A1">

    <link rel="icon" sizes="192x192" href="{{ asset('img/gazi-group.png') }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>

    <style>
        html, body {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Varela Round', Helvetica, serif;
        }

        .singularity-credit {
            position: absolute;
            right: 0;
            bottom: 35px;
            margin-right: 20px;
            width: 250px;
        }
        @media screen and (min-width: 480px) and (orientation: portrait) {
            html, body {
                overflow: auto !important;
            }
            .singularity-credit {
                position: static;
                float: right;
            }
        }
        @media screen and (max-height: 640px) and (orientation: landscape) {
            html, body {
                overflow: auto !important;
            }
            .singularity-credit {
                position: static;
                float: right;
            }
        }
        input {
            padding-top: 0 !important;
        }
        .container {
            width: 400px;
            margin: 150px auto 0;
            height: 300px;
            background: rgba(255, 255, 255, 1);
            box-shadow: 10px 10px 66px 0 #6D7373;
            padding: 20px;
        }

        .background-image {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            z-index: -99;
            opacity: 0.68;
            display: block;
            background: #7286A1 url({{ asset('img/background.jpg') }}) no-repeat center bottom;
            background-size: cover;
        }

        .content {
            position: fixed;
            left: 0;
            right: 0;
            z-index: 9999;
            margin-left: 20px;
            margin-right: 20px;
        }
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px white inset !important;
        }
        /*=== 2. Anchor Link ===*/
        a {
            color: #aaaaaa;
            transition: all ease-in-out 200ms;
        }

        a:hover {
            color: #333333;
            text-decoration: none;
        }

        /*=== 3. Text Outside the Box ===*/
        .etc-login-form {
            color: #919191;
            padding: 10px 20px;
        }

        .etc-login-form p {
            margin-bottom: 5px;
        }

        /*=== 4. Main Form ===*/
        .login-form {
            width: 95%;
            max-width: 335px;
            border-radius: 5px;
            display: inline-block;
            box-shadow: 10px 10px 66px 0 #6D7373;
            background: #ffffff;
        }

        .main-login-form {
            position: relative;
        }

        .login-form .form-control {
            border: 0;
            box-shadow: 0 0 0;
            border-radius: 0;
            background: transparent;
            color: #555555;
            padding: 7px 0;
            font-weight: bold;
            height: auto;
        }

        .login-form .form-control::-webkit-input-placeholder {
            color: #999999;
        }

        .login-form .form-control:-moz-placeholder,
        .login-form .form-control::-moz-placeholder,
        .login-form .form-control:-ms-input-placeholder {
            color: #999999;
        }

        .login-form .form-group {
            margin-bottom: 0;
            border-bottom: 2px solid #efefef;
            padding-right: 20px;
            position: relative;
        }

        .login-form .form-group:last-child {
            border-bottom: 0;
        }

        .login-group {
            background: #ffffff;
            color: #999999;
            border-radius: 8px;
            padding: 10px 20px;
        }

        .login-group-checkbox {
            padding: 5px 0;
        }

        /*=== 5. Login Button ===*/
        .login-form .login-button {
            position: absolute;
            right: -25px;
            top: 50%;
            background: #ffffff;
            color: #999999;
            padding: 11px 0;
            width: 50px;
            height: 50px;
            margin-top: -25px;
            border: 5px solid #efefef;
            border-radius: 50%;
            transition: all ease-in-out 500ms;
        }

        .login-form .login-button:hover {
            color: #555555;
            transform: rotate(450deg);
        }

        .login-form .login-button.clicked {
            color: #555555;
        }

        .login-form .login-button.clicked:hover {
            transform: none;
        }

        .login-form .login-button.clicked.success {
            color: #2ecc71;
        }

        .login-form .login-button.clicked.error {
            color: #e74c3c;
        }

        /*=== 6. Form Invalid ===*/
        label.form-invalid {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 5;
            display: block;
            margin-top: -25px;
            padding: 7px 9px;
            background: #777777;
            color: #ffffff;
            border-radius: 5px;
            font-weight: bold;
            font-size: 11px;
        }

        label.form-invalid:after {
            top: 100%;
            right: 10px;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border: 6px solid transparent;
            border-top-color: #777777;
        }

        /*=== 7. Form - Main Message ===*/
        .login-form-main-message {
            background: #ffffff;
            color: #999999;
            border-left: 3px solid transparent;
            border-radius: 3px;
            margin-bottom: 8px;
            font-weight: bold;
            height: 0;
            padding: 0 20px 0 17px;
            opacity: 0;
            transition: all ease-in-out 200ms;
        }

        .login-form-main-message.show {
            height: auto;
            opacity: 1;
            padding: 10px 20px 10px 17px;
        }

        .login-form-main-message.success {
            border-left-color: #2ecc71;
        }

        .login-form-main-message.error {
            border-left-color: #e74c3c;
        }

        /*=== 8. Custom Checkbox & Radio ===*/
        /* Base for label styling */
        [type="checkbox"]:not(:checked),
        [type="checkbox"]:checked,
        [type="radio"]:not(:checked),
        [type="radio"]:checked {
            position: absolute;
            left: -9999px;
        }

        [type="checkbox"]:not(:checked) + label,
        [type="checkbox"]:checked + label,
        [type="radio"]:not(:checked) + label,
        [type="radio"]:checked + label {
            position: relative;
            padding-left: 25px;
            padding-top: 1px;
            cursor: pointer;
        }

        /* checkbox aspect */
        [type="checkbox"]:not(:checked) + label:before,
        [type="checkbox"]:checked + label:before,
        [type="radio"]:not(:checked) + label:before,
        [type="radio"]:checked + label:before {
            content: '';
            position: absolute;
            left: 0;
            top: 2px;
            width: 17px;
            height: 17px;
            border: 0px solid #aaa;
            background: #f0f0f0;
            border-radius: 3px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        /* checked mark aspect */
        [type="checkbox"]:not(:checked) + label:after,
        [type="checkbox"]:checked + label:after,
        [type="radio"]:not(:checked) + label:after,
        [type="radio"]:checked + label:after {
            position: absolute;
            color: #555555;
            transition: all .2s;
        }

        /* checked mark aspect changes */
        [type="checkbox"]:not(:checked) + label:after,
        [type="radio"]:not(:checked) + label:after {
            opacity: 0;
            transform: scale(0);
        }

        [type="checkbox"]:checked + label:after,
        [type="radio"]:checked + label:after {
            opacity: 1;
            transform: scale(1);
        }

        /* disabled checkbox */
        [type="checkbox"]:disabled:not(:checked) + label:before,
        [type="checkbox"]:disabled:checked + label:before,
        [type="radio"]:disabled:not(:checked) + label:before,
        [type="radio"]:disabled:checked + label:before {
            box-shadow: none;
            border-color: #8c8c8c;
            background-color: #878787;
        }

        [type="checkbox"]:disabled:checked + label:after,
        [type="radio"]:disabled:checked + label:after {
            color: #555555;
        }

        [type="checkbox"]:disabled + label,
        [type="radio"]:disabled + label {
            color: #8c8c8c;
        }

        /* accessibility */
        [type="checkbox"]:checked:focus + label:before,
        [type="checkbox"]:not(:checked):focus + label:before,
        [type="checkbox"]:checked:focus + label:before,
        [type="checkbox"]:not(:checked):focus + label:before {
            border: 1px dotted #f6f6f6;
        }

        /* hover style just for information */
        label:hover:before {
            border: 1px solid #f6f6f6 !important;
        }

        /*=== Customization ===*/
        /* radio aspect */
        [type="checkbox"]:not(:checked) + label:before,
        [type="checkbox"]:checked + label:before {
            border-radius: 3px;
        }

        [type="radio"]:not(:checked) + label:before,
        [type="radio"]:checked + label:before {
            border-radius: 35px;
        }

        /* selected mark aspect */
        [type="checkbox"]:not(:checked) + label:after,
        [type="checkbox"]:checked + label:after {
            content: '✔';
            top: 0;
            left: 2px;
            font-size: 14px;
        }

        [type="radio"]:not(:checked) + label:after,
        [type="radio"]:checked + label:after {
            content: '\2022';
            top: 0;
            left: 3px;
            font-size: 30px;
            line-height: 25px;
        }

        /*=== 9. Misc ===*/
        .logo {
            padding: 15px 0;
            font-size: 25px;
            color: #aaaaaa;
            font-weight: bold;
        }

        .text-center {
            padding:50px 0;
            zoom: 1.25;
            margin-top: 5%;
        }
    </style>
</head>
<body>
<div class="background-image"></div>

<div class="text-center">
    <!-- Main Form -->
    <div class="login-form">
        <img src="{{ asset('img/gazi-group.png') }}" alt="" style="display: block; width: 250px; margin: 25px auto 0;">

        <form id="login-form" class="text-left" action="{{ route('auth.login') }}" method="post">
            {!! csrf_field() !!}
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                               placeholder="username">
                    </div>
                    <div class="form-group">
                        <label for="password" style="margin-top: 15px;">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="password">
                    </div>
                </div>
                <button type="submit" class="btn btn-block btn-primary" style="border-radius: 0;margin: 0 auto 20px;width: 80%;display: block;"><i class="fa fa-key"></i> Login</button>
            </div>

        </form>
    </div>
    <!-- end:Main Form -->
</div>

<a href="//www.singularitybd.com/" class="singularity-credit">
    <img src="{{ asset('img/singularity-credit.png') }}" alt="Singularity Interactive Ltd."
         style="width: 250px;">
</a>
</body>
</html>