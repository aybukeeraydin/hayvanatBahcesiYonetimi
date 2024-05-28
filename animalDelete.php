<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    include 'includes/db.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM animals WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
} else {
    header("Location: dashboard.php");
    exit;
}
?>
