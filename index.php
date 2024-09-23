<?php
session_start();

// Handle task deletion
if (isset($_POST['delete'])) {
    $index = $_POST['delete'];
    unset($_SESSION['tasks'][$index]);
    $_SESSION['tasks'] = array_values($_SESSION['tasks']);
}

// Handle task status update
if (isset($_POST['update_status'])) {
    $index = $_POST['task_index'];
    $new_status = $_POST['new_status'];
    $_SESSION['tasks'][$index]['assigned'] = $new_status;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <header>
            <h1 class="title">Task Tracker</h1>
            <p class="version">Mustafa Fathi</p>
        </header>
        <section class="input">
            <h2 class="instruction">Create a Task</h2>
            <form id="task" method="POST" action="process_form.php">
                <label class="form-label">Task Name</label><br>
                <input class="form-enter name" type="text" name="name" required>
                <br>
                <label class="form-label">Date</label><br>
                <input class="form-enter date" type="date" name="date">
                <br>
                <label class="form-label">Assigned To</label><br>
                <select class="form-enter assigned" name="assigned" id="ass">
                    <option value="to-do">TO-DO</option>
                    <option value="do">DO</option>
                    <option value="done">DONE</option>
                </select>
                <br>
                <input class="submit" type="submit" value="Submit">
            </form>
        </section>
        <section class="output">
            <h2 class="existing">Existing Tasks</h2>
            <div class="task-wrapper">
            <?php
                // Display existing tasks from the session
                if (!empty($_SESSION['tasks'])) {
                    foreach ($_SESSION['tasks'] as $index => $task) {
                        echo "<div class='task-item'>";
                        echo "<span class='task-name'>" . htmlspecialchars($task['name']) . "</span>";
                        echo "<span class='task-date'>" . htmlspecialchars($task['date']) . "</span>";
                        echo "<span class='task-assigned'>" . htmlspecialchars($task['assigned']) . "</span>";
                        echo "<form method='POST' action='' style='display:inline;'>
                                <input type='hidden' name='task_index' value='$index'>
                                <select name='new_status'>
                                    <option value='to-do'>TO-DO</option>
                                    <option value='do'>DO</option>
                                    <option value='done'>DONE</option>
                                </select>
                                <button class='btn' type='submit' name='update_status' value='Update'>Update</button>
                                <button class='btn' type='submit' name='delete' value='$index'>Delete</button>
                              </form>";
                        echo "</div>";
                    }
                } else {
                    echo "<div>No tasks available.</div>";
                }
                ?>
            </div>
        </section>
    </div>
</body>
</html>
