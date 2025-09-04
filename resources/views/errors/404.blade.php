<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 | Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f8fafc;
            color: #22223b;
            font-family: 'Montserrat', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .error-code {
            font-size: 8rem;
            font-weight: 700;
            color: #4e54c8;
            letter-spacing: 10px;
        }
        .error-message {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .error-desc {
            color: #6c757d;
            margin-bottom: 2rem;
        }
        .home-btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);
            color: #fff;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }
        .home-btn:hover {
            background: linear-gradient(90deg, #8f94fb 0%, #4e54c8 100%);
        }
        @media (max-width: 600px) {
            .error-code { font-size: 4rem; }
            .error-message { font-size: 1.2rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">404</div>
        <div class="error-message">Oops! Page Not Found</div>
        <div class="error-desc">
            The page you are looking for might have been removed,<br>
            had its name changed, or is temporarily unavailable.
        </div>
        <a href="{{ url('/') }}" class="home-btn">Go to Homepage</a>
    </div>
</body>
</html>
