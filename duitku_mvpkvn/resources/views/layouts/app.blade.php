<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Application</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    <!-- Add your JavaScript links here -->
</body>
</html>
