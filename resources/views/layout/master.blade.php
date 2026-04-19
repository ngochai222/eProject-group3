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
    <nav style="background:#1f2937; padding:15px; color:white; display:flex; justify-content:space-between;">
         <div style="font-size:24px; font-weight:bold;">CINEBOOK</div>
         <div>
             <a href="/" style="margin-right:20px; color:white; text-decoration:none;">Home</a>
             <a href="/cinema" style="margin-right:20px; color:white; text-decoration:none;">Cinemas</a>
             <a href="/booking" style="margin-right:20px; color:white; text-decoration:none;">Booking</a>
             <a href="/showtime" style="margin-right:20px; color:white; text-decoration:none;">Show Time</a>
             <a href="/contact" style="color:white; text-decoration:none;">Contact</a>
         </div>
         <h2 style="margin:0;">Cinema Booking</h2>
            <a href="{{ route('home') }}"HOME</a>
            <a href="{{ route('showtime') }}"SHOW TIME</a>
            <a href="{{ route('booking') }}"BOOKING<a/>

    </nav>

    <!-- Content -->
    <div style="padding:20px;">
        @yield('content')
    </div>

</body>
</html>
