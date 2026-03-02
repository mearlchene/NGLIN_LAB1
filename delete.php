<?php
session_start();
include "db.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    $del = $conn->prepare("DELETE FROM students WHERE id = ?");
    $del->bind_param("i", $id);

    if ($del->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record.";
    }

    $del->close();
} else {
    echo "Invalid ID.";
}

$conn->close();
?>