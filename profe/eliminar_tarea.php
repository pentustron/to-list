<?php
// Verificar si se ha enviado un ID de tarea para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task_id"])) {
    // Obtener el ID de la tarea a eliminar
    $task_id = $_POST["task_id"];
    echo "ID de la tarea a eliminar: $task_id"; // Depuración: Imprimir ID de la tarea

    // Conectar a la base de datos
    require("db_modelo.php");

    // Preparar y ejecutar la consulta SQL para eliminar la tarea
    $db = new Database("localhost", "webnews", "toor2022", "noticias");
    $sql = "DELETE FROM task WHERE id = '$task_id'";
    echo "Consulta SQL: $sql"; // Depuración: Imprimir consulta SQL
    
    // Ejecutar la consulta SQL
    $result = $db->query($sql);

    // Verificar si la consulta se ejecutó correctamente
    if ($result) {
        echo "La tarea se ha eliminado correctamente.";
    } else {
        $error_message = "Error al eliminar la tarea.";
        error_log($error_message); // Depuración: Registrar mensaje de error
        echo $error_message; // Mostrar mensaje de error en caso de fallo
    }

    // Cerrar la conexión a la base de datos
    $db->close();

    // Redirigir de vuelta a la página principal después de eliminar la tarea
    header("Location: menuadmin.php?confirmation=" . urlencode("La tarea se ha eliminado correctamente."));
    exit; // Terminar el script para evitar que se siga ejecutando después de la redirección
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si se envió un formulario con una solicitud inválida, redirigir de vuelta a la página principal
    header("Location: menuadmin.php");
    exit;
}
?>

