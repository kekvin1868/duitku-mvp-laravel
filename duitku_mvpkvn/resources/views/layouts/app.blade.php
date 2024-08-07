<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Application</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ asset('js/transactions/trc.js') }}"></script>
</body>
</html>
