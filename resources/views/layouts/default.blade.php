<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title","E-com")</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    @yield("style")
</head>
<body>
    @include("include.header")
    @yield("content")
    @include("include.footer")
    <script src="{{asset('assets/js/bootstrap.miin.js')}}"></script>
    @yield("script")
</body>
</html>