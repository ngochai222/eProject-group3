<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <style>
        body {
            background: #0b0b0b;
            color: white;
            font-family: Arial;
        }
        .container { width: 90%; margin: auto; }
        .card {
            background: #111;
            padding: 15px;
            margin: 10px 0;
            border-radius: 10px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            background: #111;
            color: white;
            border: 1px solid #444;
            margin: 5px 0;
        }
        button {
            background: red;
            color: white;
            border: none;
            padding: 10px;
        }
        a { color: yellow; }
    </style>
</head>
<body>

<div class="container">
    @yield('content')
</div>

</body>
</html>