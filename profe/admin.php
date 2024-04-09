
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }
        .button-container {
        text-align: right;
        }
    </style>
</head>

<body>
    <header>
        <h1>Menu de Administracion</h1>
    </header>

    <br>
    <div class="button-container">
        <a href="index.php" class="btn btn-info">Regresar a la pagina principal</a>
    </div>
    <br>
    
    <div class="container">
        <?php
        session_start();
        if(!isset($_SESSION['admin'])) {
            include('login.php');
            die();
        }
        ?>
        <h2>Opciones de Administracion:</h2>
        <ul>
            <li><a href="altaperiodistas.php">Alta de reporteros</a></li>
            <li><a href="bajareporteros.php">Baja de reporteros</a></li>
            <hr>
            <li><a href="subirnoticias.php">Subir una noticia</a></li>
            <li><a href="bajarnoticias.php">Bajar una noticia</a></li>
        </ul>
        <?php
        ?>
    </div>
</body>
</html>