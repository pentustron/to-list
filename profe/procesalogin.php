<?php
session_start();
include "db_modelo.php";

$us = '';
$pas = '';

if (isset($_POST['user'])) {
    $us = $_POST['user'];
}

if (isset($_POST['pass'])) {
    $pas = $_POST['pass'];
}

if ($us == '' || $pas == '') {
    echo "<div style='color: red; background-color: #FFCCCC; padding: 10px; text-align: center; font-weight: bold;'>Usuario o contraseña inválido</div>";
    include("login.php");
    die();
}

// Sanitizar
$us = str_replace("'", "", $us);
$pas = str_replace("'", "", $pas);

// Conectar a la base de datos
$db = new Database("localhost", "root", "toor2022", "noticias");

// Armar SQL
$sql = "SELECT * FROM usuarios WHERE login='{$us}' AND pass='{$pas}';";

// Ejecutar la consulta
$result = $db->query($sql);

if ($result) {
    if ($row = $db->fetch($result)) {
        $_SESSION['admin'] = $row['nombre']; // Crear la sesión con el nombre
        echo "<div style='color: green; background-color: #CCFFCC; padding: 10px; text-align: center; font-weight: bold;'>Bienvenido " . $_SESSION['admin'] . "</div>";
        echo "<br><br>";
        echo "<a href='menuadmin.php' style='display: block; text-align: center; text-decoration: none; background-color: #007BFF; color: white; padding: 10px; border-radius: 5px;'>Continuar</a>";
    } else {
        echo "<div style='color: red; background-color: #FFCCCC; padding: 10px; text-align: center; font-weight: bold;'>Usuario o contraseña incorrecta</div>";
        include("login.php");
        die();
    }
}



// Cerrar la BD
$db->close();
?>
