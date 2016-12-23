<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:url"                content="{{url('/')}}" />
        <meta property="og:type"               content="article" />
        <meta property="og:title"              content="Monitor And Control Devices In Real-Time" />
        <meta property="og:description"        content="SocketDroid allows you to remotely monitor and control your devices in real-time. Sign up for free today!" />
        <meta property="og:image"              content="{{url('/marketing.png')}}" />
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@mastashake08">
        <meta name="twitter:creator" content="@mastashake08">
        <meta name="twitter:title" content="Monitor And Control Devices In Real-Time">
        <meta name="twitter:description" content="SocketDroid allows you to remotely monitor and control your devices in real-time. Sign up for free today!">
        <meta name="twitter:image" content="{{url('/marketing.png')}}">
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-53029737-5', 'auto');
          ga('send', 'pageview');

        </script>
        <title>SocketDroid</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 12px;
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
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    SocketDroid
                </div>

                <div class="links">
                    <a href="/how-it-works">How It Works</a>
                    <a href="https://jyroneparker.com">Meet The Developer</a>
                </div>
                <a href='https://play.google.com/store/apps/details?id=com.socketdroid.mastashake08.socketdroid&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png'/></a>
            </div>
        </div>
    </body>
</html>
