<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRM - Custom Retail Management</title>

        <!-- Style -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <link href="{{asset('css/styles.css')}}" rel="stylesheet">


    </head>

    <body class="antialiased">
        <div id="app">
            <app-component></app-component>
        </div>

        <!-- Script -->
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
