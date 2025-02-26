<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title","E-com")</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        /* Ensure the page takes full height */
        html, body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        /* Content area takes remaining space */
        .content-wrapper {
            flex: 1;
        }

        /* Ensure footer is at the bottom */
        footer {
            margin-top: auto;
        }
    </style>
    @yield("style")
</head>
<body>
    @include("include.header")

    <div class="content-wrapper">
        @yield("content")
    </div>

    @unless(Request::is('order-history'))
        @include("include.footer")
    @endunless

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    @yield("script")
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
