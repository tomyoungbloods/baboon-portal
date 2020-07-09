<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="manifest.json" />
        <meta name=theme-color content=#50b5f2><meta name=apple-mobile-web-app-status-bar-style content=black-translucent>
        <link href=./splashscreens/iphone5_splash.png media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image><link href=./splashscreens/iphone6_splash.png media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image><link href=./splashscreens/iphoneplus_splash.png media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel=apple-touch-startup-image><link href=./splashscreens/iphonex_splash.png media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel=apple-touch-startup-image><link href=./splashscreens/iphonexr_splash.png media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image><link href=./splashscreens/iphonexsmax_splash.png media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel=apple-touch-startup-image><link href=./splashscreens/ipad_splash.png media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image><link href=./splashscreens/ipadpro1_splash.png media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image><link href=./splashscreens/ipadpro3_splash.png media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image><link href=./splashscreens/ipadpro2_splash.png media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image>
        <meta name="theme-color" content="#35555d" />
        <meta name=theme-color content=#50b5f2><meta name=apple-mobile-web-app-status-bar-style content=black-translucent>
        <title>Baboons</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                
            </div>
        </div>
    </body>
</html>
