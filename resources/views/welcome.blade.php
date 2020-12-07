<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

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
                margin-top: 60px;
                padding-bottom: 2.5rem;
            }

            .title {
                font-size: 84px;
            }
            .subtitle {
                font-size: 44px;
                /*color: lightcoral;*/
                margin: 0 auto;
                width: 80%;
            }
            .development {
                color: lightcoral;
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

            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                text-align: center;
            }

            .corona {
                font-size: 24px;
                color: lightcoral;
            }

            .motd {
                font-size: 24px;
                color: orange;
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
                        <a href="{{ url('/classroom') }}">Classrooms</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                @if($motd)
                    <div class="motd">
                        {{ $motd }}
                    </div>
                @endif


                @if(config('app.env') != 'production')
                    <div class="subtitle m-b-md development">
                        Development Server
                    </div>
                @endif
                <div class="title m-b-md">
                    Welcome to </br> {{ env('APP_NAME') }} Server
                </div>
                <div class="subtitle corona m-b-md">
                    Available for free, with unlimited use during the COVID-19 situation, to assist students and teachers with continuity of learning.
                </div>

                <div class="links">
{{--                    <a href="#">Sign up</a>--}}
{{--                    <a href="#">Docs</a>--}}
                    <a href="https://sourceforge.net/projects/myquerytutor/files/" target="_blank" title="Download MyQueryTutor client">Download MyQueryTutor</a>
                    <a href="mailto:admin@myquerytutor.com?subject=My Query Tutor Server Enquiry" title="Email me at admin@myquerytutor.com" target="_blank" rel="noopener noreferrer">Contact Developer</a>
                </div>

                <div class="footer">
                    <p>&copy; Copyright 2020 <a href="mailto:craig@myquerytutor.com?subject=My Query Tutor Server Enquiry">Craig Hume</a>, ABN: 38 304 484 395</p>
                </div>
            </div>
        </div>
    </body>
</html>
