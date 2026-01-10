<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>404 – Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    body {
        min-height: 100vh;
        background: radial-gradient(circle at top, #111 0%, #000 60%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notfound {
        text-align: center;
        max-width: 520px;
        padding: 40px;
    }

    .notfound h1 {
        font-size: 120px;
        font-weight: 800;
        letter-spacing: -4px;
        color: #f3f3f3;
    }

    .notfound h2 {
        font-size: 28px;
        margin-bottom: 14px;
    }

    .notfound p {
        color: #aaa;
        margin-bottom: 32px;
        line-height: 1.6;
    }

    .notfound a {
        display: inline-block;
        padding: 14px 32px;
        background: #0a0a0a;
        color: #efeaea;
        text-decoration: none;
        border-radius: 999px;
        font-weight: 600;
        transition: transform .2s ease;
    }

    .notfound a:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(229, 227, 220, 0.72);
    }
    </style>
</head>

<body>
    <div class="notfound">
        <h1>404</h1>
        <h2>Page not found</h2>
        <p>
            The page you’re looking for doesn’t exist or has been moved.<br>
            Let’s get you back on track.
        </p>
        <a href="javascript:void(0);" onclick="history.back();">
            ← Back to Previous Page
        </a>

    </div>
</body>

</html>