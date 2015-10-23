<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- scales the web page so that it displays correctly on all resolutions -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta id="token" name="token" content="{{ csrf_token() }}">

    <title>email_spam</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/css/all.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>

    @include('partials._menu')

    <div class="container">
        @yield('content')
    </div>

    @include('errors._list')
</body>
</html>