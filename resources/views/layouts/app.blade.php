<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko ATK')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #ffffff);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 15px;
            text-align: center;
        }
        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .btn-custom {
            width: 150px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">🖊️ Toko ATK</a>
           
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="text-center text-muted mt-4">
        &copy; {{ date('Y') }} Toko ATK. Dibuat dengan ❤️ menggunakan Laravel.
    </footer>

</body>
</html>
