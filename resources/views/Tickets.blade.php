<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Premium Ticket</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ticket {
            width: 400px;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 25px;
            color: #fff;
            box-shadow: 0 0 30px rgba(0,255,255,0.2);
            position: relative;
            overflow: hidden;
        }

        .ticket::before {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(0,255,255,0.3), transparent);
            animation: glow 4s linear infinite;
        }

        @keyframes glow {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .ticket-content {
            position: relative;
            z-index: 1;
        }

        .title {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .info {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 5px;
        }

        .label {
            color: #aaa;
        }

        .value {
            font-weight: 500;
        }

        .price {
            text-align: center;
            font-size: 26px;
            margin-top: 15px;
            color: #00ffff;
        }

        .btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border-radius: 10px;
            background: linear-gradient(45deg, #00c6ff, #0072ff);
            text-decoration: none;
            color: white;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px #00c6ff;
        }
    </style>
</head>
<body>

<div class="ticket">
    <div class="ticket-content">
        <div class="title"> VIP CINEMA</div>

        <div class="info">
            <span class="label">Ticket ID</span>
            <span class="value">#{{ $ticket->id }}</span>
        </div>

        <div class="info">
            <span class="label">User</span>
<span class="value">{{ $ticket->user->name ?? 'N/A' }}</span>
        </div>

        <div class="info">
            <span class="label">Seat</span>
            <span class="value">{{ $ticket->seat->seat_number ?? 'N/A' }}</span>
        </div>

        <div class="info">
            <span class="label">Showtime</span>
            <span class="value">{{ $ticket->showtime->start_time ?? 'N/A' }}</span>
        </div>

        <div class="price">
            {{ number_format($ticket->price ?? 0) }} VND
        </div>

        <a href="/" class="btn">⬅ Back Home</a>
    </div>
</div>

</body>
</html>
