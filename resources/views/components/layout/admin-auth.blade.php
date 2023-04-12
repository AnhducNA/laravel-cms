<!doctype html>
<html lang="en" class="form-screen">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Tailwind is included -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/main.css')}}">

    <link rel="apple-touch-icon" sizes="180x180"
          href="{{asset('assets/admin/images/tailwind-favicons/apple-touch-icon.png')}}"/>
    <link rel="icon" type="image/png" sizes="32x32"
          href="{{asset('assets/admin/images/tailwind-favicons/favicon-32x32.png')}}"/>
    <link rel="icon" type="image/png" sizes="16x16"
          href="{{asset('assets/admin/images/tailwind-favicons/favicon-16x16.png')}}"/>
    <link color="#00b4b6" href="safari-pinned-tab.svg" rel="mask-icon"/>

    <!-- Material Design Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css"/>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

<div id="app">

    {{$slot}}

</div>
<!-- Scripts below are for demo only -->
<script src="{{asset('assets/admin/js/main.min.js')}}" type="text/javascript"></script>
@livewireScripts
</body>
</html>
