<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
{{--        <meta name="csrf-token" content="{{ csrf_token() }}">--}}

        {{--favicon--}}
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <title>{{ config('app.name', 'BANTAM') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- for the inspinia theme -->
        <link href="{{ asset('css/fontawesome/css/all.css') }}"  rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            [v-cloak]{
                display: none;
            }
        </style>
    </head>
    <body>
    <div id="app">
        <main  class="py-4  animated fadeIn" v-cloak>
            <router-view />
        </main>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/app.js') .'?random='.uniqid() }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
        window.paceOptions = {
            "ajax": {
                trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'PATCH']
            }
        }
    </script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('js/inspinia.js') }}"></script>
    </body>
</html>
