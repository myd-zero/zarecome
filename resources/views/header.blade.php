<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarecome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        nav {
            background-color: #000;
            padding: 10px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: white;
            margin-right: 20px;
            font-size: 14px;
        }

        nav h4 {
            margin: 0;
            padding: 10px;
        }
    </style>
</head>
<body>
    <nav>
        <a href="/" style="text-decoration: none; color: white;">
            <h4>Zarecome</h4>
        </a>
        <div>
            @auth
                <a href="/dashboard">Dashboard</a>
            @else
                <a href="/login">Login</a>
            @endauth
        </div>
    </nav>
    

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>