<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel Vue App') }}</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>

    <body>
        <div id="app">
            <header>
                <h1 class="text-center m-5">{{ config('app.name', 'Laravel Vue App') }}</h1>
            </header>

            <main class="content-wrapper">
                <div class="content">
                    <div class="container">

                        <router-view></router-view>

                        <vue-progress-bar></vue-progress-bar>

                    </div>
                </div>
            </main>

            <footer></footer>
        </div><!-- #app.wrapper -->

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
