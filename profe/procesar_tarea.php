<?php
// Incluir el archivo de configuración de la base de datos
require_once "db_modelo.php";

// Verificar si se ha enviado la descripción de la tarea
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task_description"])) {
    // Obtener la descripción de la tarea del formulario
    $task_description = $_POST["task_description"];

    // Sanitizar la entrada para evitar inyección de SQL
    $task_description = htmlspecialchars($task_description);

    // Insertar la tarea en la base de datos
    $db = new Database("localhost", "root", "toor2022", "noticias");
    $sql = "INSERT INTO tasks (task_description) VALUES ('$task_description')";
    $result = $db->query($sql);
    $db->close();
}

// Verificar si se ha enviado una solicitud para obtener las tareas
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] == "get_tasks") {
    // Obtener todas las tareas de la base de datos
    $db = new Database("localhost", "root", "toor2022", "noticias");
    $sql = "SELECT * FROM tasks";
    $result = $db->query($sql);
    $tasks = [];
    while ($row = $db->fetch($result)) {
        $tasks[] = $row;
    }
    $db->close();
    echo json_encode($tasks); // Devolver las tareas en formato JSON
}
?>
