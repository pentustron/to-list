<?php
require("db_modelo.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado los datos del formulario
    if (isset($_POST["nombre"]) && isset($_POST["pass"]) && isset($_POST["usuario"])) {
        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $pass = $_POST["pass"];
        $usuario = $_POST["usuario"]; // Obtener el nombre de usuario del formulario

        // Sanitizar los datos (eliminar caracteres especiales)
        $nombre = htmlspecialchars($nombre);
        $pass = htmlspecialchars($pass);
        $usuario = htmlspecialchars($usuario);

        // Conectar a la base de datos
        $db = new Database("localhost", "webnews", "toor2022", "noticias");

        // Preparar la consulta SQL para insertar un nuevo usuario
        $sql = "INSERT INTO usuarios (login, pass, nombre) VALUES ('$nombre', '$pass', '$usuario')";

        // Ejecutar la consulta SQL
        $result = $db->query($sql);

        // Cerrar la conexión a la base de datos
        $db->close();

        // Redirigir al usuario al archivo de login después del registro
        header("Location: login.php");
        exit; // Salir del script para evitar que se ejecute el código siguiente
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://www.cocacolaep.com/assets/Spain/Blog-Rojo-y-en-Botella/2022/DIA-PERIODISTA-FAKE-NEWS/FakeNews-906x808__FocusFillWzEyMTAsMTA4MCwieCIsMF0.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
            border: 1px solid #ccc;
            background-color: white;
            border-radius: 5px;
        }
        .reportero {
            text-align: center;
            color: white;
            margin-top: 135px;
        }
        label {
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: blue;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #359393;
        }
    </style>
</head>
<body>
    <div class="reportero">
        <h2>Registrar Usuario</h2>
    </div>
    <form method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>
    <label for="pass">Contraseña:</label>
    <input type="password" id="pass" name="pass" required><br>
    <label for="usuario">Nombre de usuario:</label>
    <input type="text" id="usuario" name="usuario" required><br> <!-- Corregido: tipo de entrada debe ser "text" -->
    <input type="submit" value="Generar Usuario">
</form>

</body>
</html>
