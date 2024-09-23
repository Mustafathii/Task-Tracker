<?php
session_start(); // Start the session

// Initialize tasks array if it doesn't exist
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $date = htmlspecialchars($_POST['date']);  
    $assigned = htmlspecialchars($_POST['assigned']);
    
    // Store the new task in the session array
    $_SESSION['tasks'][] = [
        'name' => $name,
        'date' => $date,
        'assigned' => $assigned
    ];
}

// Redirect back to index.php
header("Location: index.php");
exit();