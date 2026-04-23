<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <style>
        body { background:#0f172a; color:white; font-family:Arial; }
        .container { padding:20px; }
        .card { background:#111; padding:15px; border-radius:10px; margin:10px 0; display:flex; }
        .btn { padding:5px 10px; border:none; border-radius:6px; cursor:pointer; }
        .edit { background:orange; }
        .delete { background:red; color:white; }
    </style>
</head>
<body>

<div class="container">
    @yield('content')
</div>

</body>
</html>