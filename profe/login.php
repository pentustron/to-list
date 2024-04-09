<!DOCTYPE html>
<html lang="es">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://static.vecteezy.com/system/resources/thumbnails/001/806/801/original/glowing-stars-background-loop-free-video.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
        }
        .container {
            max-width: 800px;
            padding: 80px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulario de Registro</h2>
        <form action="procesalogin.php" method="post">
                       
            <label for="user">USUARIO:</label>
            <input type="text" name="user" required>
            
            <label for="pass">Contraseña:</label>
            <input type="password" name="pass" required>
                       
            <input type="submit" value="Entrar">
        </form>
    </div>
    <div class="container">
        <?php
        session_start();
        if (!isset($_SESSION['admin'])) {
            include('login.php');
            die();
        }
        ?>
        <br>
        <br>
        <h1>Resgistro:</h2>
        <ul>
            <li><a href="altaperiodistas.php">Registro de sesion</a></li>
        <br>
           
           
        </ul>

        <?php
        ?>
    </div>
</body>
</html>
