<?php
session_start();
include "config/Database.php";
include "partials/functions.php";
include "classes/Task.php";



$database = new Database();
$db = $database->connect();
$todo = new Task($db);
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["add_task"])) {
        $todo->task = $_POST["task"];
        $todo->create();
        $_SESSION['message'] = "Task added succesfully";
        $_SESSION['msg_type'] = "success";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST["complete_task"])) {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        $todo->complete($_POST['id']);
        $_SESSION['message'] = "Task completed";
        $_SESSION['msg_type'] = "success";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST["undo_complete_task"])) {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        $todo->undo($_POST['id']);
        $_SESSION['message'] = "Task undone";
        $_SESSION['msg_type'] = "success";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST["delete_task"])) {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        $todo->delete($_POST['id']);
        $_SESSION['message'] = "Task deleted";
        $_SESSION['msg_type'] = "success";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $error .= 'method not found';
        $_SESSION['message'] = $error;
        $_SESSION['msg_type'] = "error";
    }
}

$tasks = $todo->read();
?>
<!-- Notification Container -->
<?php
include "partials/header.php";
include "partials/notification.php";
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
        <?php while ($task = $tasks->fetch_assoc()): ?>
            <li class="completed">
                <span class="<?= $task['is_completed'] ? 'completed' : '' ?>"><?= $task['task'] ?></span>
                <div>
                    <?php if (!$task['is_completed']): ?>
                        <!-- Complete Task -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $task['id'] ?>">
                            <button class="complete" type="submit" name="complete_task">Complete</button>
                        </form>
                    <?php else: ?>
                        <!-- Undo Completed Task -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $task['id'] ?>">
                            <button class="undo" type="submit" name="undo_complete_task">Undo</button>
                        </form>
                    <?php endif; ?>
                    <!-- Delete Task -->
                    <form onsubmit="return confirmDelete()" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                        <button class="delete" type="submit" name="delete_task">Delete</button>
                    </form>

                </div>
            </li>
        <?php endwhile; ?>

    </ul>
</div>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this task?")
    }
</script>

<?php
include "partials/footer.php";
?>