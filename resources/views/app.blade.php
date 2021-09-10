<!doctype html>
        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" value="{{ csrf_token() }}" />

            <title>Test task for an Alif Tech</title>
            <link href=’https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel=”stylesheet”>

            <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
        </head>

        <body>
            <div id="app"></div>
            <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
        </body>

        </html>
