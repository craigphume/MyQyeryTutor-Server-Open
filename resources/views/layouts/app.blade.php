
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
         /*these styles will animate bootstrap alerts.*/
        .alert{
            z-index: 99;
            top: 60px;
            right:18px;
            min-width:30%;
            position: sticky;
            animation: slide 0.5s forwards;
        }
        @keyframes slide {
            100% { top: 30px; }
        }
        @media screen and (max-width: 668px) {
            .alert{ /* center the alert on small screens */
                left: 10px;
                right: 10px;
            }
        }
    </style>

    <title>{{config('app.name')}}</title>
</head>
<body>

@include('includes.navbar')
<main class="container mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            @include('includes.flash')
            @yield('content')
            </div>
        </div>
    </div>
</main>

<script src="{{asset('js/app.js')}}"></script>

{{--<script>--}}
{{--    //close the alert after 6 seconds.--}}
{{--    $(document).ready(function(){--}}
{{--        setTimeout(function() {--}}
{{--            $(".alert").alert('close');--}}
{{--        }, 6000);--}}
{{--    });--}}
{{--</script>--}}

@yield('scripts')

</body>
</html>
