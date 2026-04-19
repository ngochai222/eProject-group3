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
    <nav style="background:#1f2937; padding:15px; color:white; display:flex; justify-content:space-between; align-items:center;">
         <div style="font-size:24px; font-weight:bold;">CINEBOOK</div>
         <div>
             <a href="{{ route('home') }}" style="margin-right:20px; color:white; text-decoration:none;">Home</a>
             <a href="{{ route('cinemas') }}" style="margin-right:20px; color:white; text-decoration:none;">Cinemas</a>
             <a href="{{ route('booking.index') }}" style="margin-right:20px; color:white; text-decoration:none;">Booking</a>
             <a href="{{ route('showtimes') }}" style="margin-right:20px; color:white; text-decoration:none;">Show Time</a>
             <a href="{{ route('contact') }}" style="color:white; text-decoration:none;">Contact</a>
         </div>
    </nav>

    <!-- Content -->
    <div style="padding:20px;">
        @yield('content')
    </div>

</body>
</html>
