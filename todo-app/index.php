<?php
include "partials/header.php";
include "partials/notification.php";
include "config/Database.php";

$database = new Database();
$db = $database->connect();
?>

<!-- Main Content Container -->
<div class="container">
    <h1>Todo App</h1>

    <!-- Add Task Form -->
    <form method="POST">
        <input type="text" name="task" placeholder="Enter a new task" required>
        <button type="submit" name="add_task">Add Task</button>
    </form>

    <!-- Display Tasks -->
    <ul>
        <li class="completed">
            <span class="completed">Sample Task</span>
            <div>
                <!-- Complete Task -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="1">
                    <button class="complete" type="submit" name="complete_task">Complete</button>
                </form>

                <!-- Undo Completed Task -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="1">
                    <button class="undo" type="submit" name="undo_complete_task">Undo</button>
                </form>

                <!-- Delete Task -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="1">
                    <button class="delete" type="submit" name="delete_task">Delete</button>
                </form>
            </div>
        </li>

        <li>
            <span>Another Task</span>
            <div>
                <!-- Complete Task -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="2">
                    <button class="complete" type="submit" name="complete_task">Complete</button>
                </form>

                <!-- Delete Task -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="2">
                    <button class="delete" type="submit" name="delete_task">Delete</button>
                </form>
            </div>
        </li>
    </ul>
</div>

<?php
include "partials/footer.php";
?>