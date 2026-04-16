<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema</title>

    <!-- Load CSS -->
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">    
</head>

<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav style="background:#1f2937; padding:15px; color:white;">
        <h2>Cinema Booking</h2>
    </nav>

    <!-- Content -->
    <div style="padding:20px;">
        @yield('content')
    </div>

</body>
</html>
