<?php
require("db_modelo.php");

// Función para obtener todas las tareas de la base de datos
function getAllTasks() {
    // Conectar a la BD
    $db = new Database("localhost", "webnews", "toor2022", "noticias");

    // Preparar la consulta SQL para obtener todas las tareas
    $sql = "SELECT * FROM tasks";

    // Ejecutar la consulta SQL
    $result = $db->query($sql);

    // Almacenar todas las tareas en un array
    $tasks = [];
    while ($row = $db->fetch($result)) {
        $tasks[] = $row;
    }

    // Cerrar la conexión
    $db->close();

    return $tasks;
}

// Si se ha enviado el formulario para agregar una nueva tarea
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_task"])) {
    // Obtener y validar los datos del formulario
    $user_id = htmlspecialchars($_POST["user_id"]);
    $task_description = $_POST["task_description"];

    // Verificar si la descripción de la tarea está vacía
    if (!empty($task_description)) {
        // Conectar a la BD
        $db = new Database("localhost", "webnews", "toor2022", "noticias");

        // Preparar la consulta SQL para insertar una nueva tarea
        $sql = "INSERT INTO tasks (user_id, task_description, created_at) VALUES ('$user_id', '$task_description', NOW())";

        // Ejecutar la consulta SQL
        $result = $db->query($sql);

        // Cerrar la conexión
        $db->close();
    }
}

// Si se ha enviado el formulario para eliminar todas las tareas
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_all_tasks"])) {
    // Conectar a la BD
    $db = new Database("localhost", "webnews", "toor2022", "noticias");

    // Preparar la consulta SQL para eliminar todas las tareas
    $sql = "DELETE FROM tasks";

    // Ejecutar la consulta SQL
    $result = $db->query($sql);

    // Cerrar la conexión
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="bg-primary text-white py-4">
        <div class="container">
            <h1 class="text-center">Lista de Tareas</h1>
        </div>
    </header>

    <div class="container mt-4">
        <div class="date-container mb-4">
            <p id="currentDate" class="fs-5"></p>
        </div>

        <!-- Formulario para agregar tarea -->
        <div class="input-group mb-3">
            <form method="post">
                <input type="hidden" name="user_id" value="1">
                <input type="text" name="task_description" id="taskInput" class="form-control" placeholder="Escribe una nueva tarea">
                <button type="submit" name="add_task" class="btn btn-primary">Añadir tarea</button>
            </form>
        </div>

        <!-- Botón para eliminar todas las tareas -->
        <form method="post" class="mb-3">
            <button type="submit" name="delete_all_tasks" class="btn btn-danger">Eliminar todas las tareas</button>
        </form>

        <!-- Lista de tareas -->
        <ul id="taskList" class="list-group">
            <?php foreach (getAllTasks() as $task): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo $task['task_description']; ?></span>
                    <!-- Botón para eliminar tarea -->
                    <form method="post">
                        <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                        <button type="submit" name="delete_task" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="scripts.js"></script>
    
</body>
</html>





