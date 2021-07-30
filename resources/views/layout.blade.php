<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="patrones, de, diseño, laravel">
    <title>@yield('titulo', 'Patrones de Diseño en Laravel')</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        a {
            text-decoration: none;
            color: #000;
            font-size: 1.4em;
            padding: 5px 0;
        }

        a:hover {
            font-size: 1.6em;
        }

        a::before {
            content: "✅";
            margin-right: 5px;
        }

        body {
            margin: auto;
            width: 80%;
            padding: 20px;
        }

        button {
            background: #fff;
            border: 1px solid rgba(0,0,0,.8);
            padding: 10px;
            border-radius: 5px;
        }

        button:hover {
            background: rgba(0,0,0,.8);
            color: #fff;
        }

        form {
            padding: 10px 0;
        }

        .contenido {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 5px 5px 15px 20px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>
    <h1>@yield('titulo', 'Patrones de Diseño en Laravel')</h1>
    <div class="contenido">
        @yield('contenido')
    </div>
</body>
</html>
