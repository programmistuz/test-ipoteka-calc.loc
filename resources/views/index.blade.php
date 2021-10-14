<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- генерируемые стили Vue --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- шрифты для vuetifyjs --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

    <title>Расчет ипотеки</title>
</head>
<body>

{{-- содержимое Vue --}}
<div id="app">
</div>

{{-- гененрируемые скрипты Vue --}}
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
