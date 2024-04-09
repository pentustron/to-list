// Función para añadir una tarea
function addTask() {
    var taskInput = document.getElementById("taskInput").value;
    
    if (taskInput.trim() !== "") {
        // Realizar una solicitud AJAX para agregar la tarea
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "procesar_tarea.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Actualizar la lista de tareas después de agregar una nueva tarea
                fetchTasks();
            }
        };
        xhr.send("task_description=" + encodeURIComponent(taskInput));
    } else {
        alert("Por favor, escribe una tarea válida.");
    }
}

// Función para obtener y mostrar la lista de tareas
function fetchTasks() {
    var taskList = document.getElementById("taskList");
    taskList.innerHTML = ""; // Limpiar la lista de tareas antes de actualizar
    
    // Realizar una solicitud AJAX para obtener la lista de tareas
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "procesar_tarea.php?action=get_tasks", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var tasks = JSON.parse(xhr.responseText);
            tasks.forEach(function(task) {
                var taskItem = document.createElement("li");
                taskItem.textContent = task.task_description;
                taskList.appendChild(taskItem);
            });
        }
    };
    xhr.send();
}

// Actualizar la fecha actual cada segundo
function showDate() {
    var currentDateElement = document.getElementById("currentDate");
    var currentDate = new Date();

    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    var formattedDate = currentDate.toLocaleDateString('es-ES', options);

    currentDateElement.textContent = "Fecha del día: " + formattedDate;
}

showDate(); // Mostrar la fecha actual al cargar la página
setInterval(showDate, 1000); // Actualizar la fecha cada segundo

// Ejecutar fetchTasks al cargar la página para mostrar las tareas existentes
document.addEventListener("DOMContentLoaded", fetchTasks);
