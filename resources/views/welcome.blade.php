<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
            .navbar-section{
                width:100%; 
                height:10%;
                background-color:#689f38;
                color:white;
                
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                text-align: center;
            }
            
            .navbar-section .nav-link{
                font-size:1.5rem;
                color:#ffffff;
            }
            .content .det-link {
                font-size:1.7em;
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
                padding-right:200px;
                padding-left:200px;
                font-size: 84px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                text-align: center;
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
    <div class="container-fluid navbar-section">
    @if (Route::has('login'))
                <div class="top-right links" >
                    @auth
                        <a class="nav-link" href="{{ url('/home') }}">Home</a>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a  class="nav-link" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

           
    </div>
        <div class="flex-center position-ref full-height">
           




            <div class="content">
                <div class="title m-b-md">
                    Welcome to your E-Wallet
                </div>

                <div class="links">
                    <a href="#" class="det-link">An Integrated Platform for all Your Online Purchase and Gifting</a>
                    
                </div>
            </div>
        </div>
    </body>
</html>
