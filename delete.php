<?php
<<<<<<< HEAD
session_start();
include "db.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
=======
include "db.php";

if(isset($_GET['id']) && is_numeric($_GET['id'])){

    $id = $_GET['id'];
>>>>>>> ea37ff5cf8619eb3b321777cd28589af5f7a24d5

    $del = $conn->prepare("DELETE FROM students WHERE id = ?");
    $del->bind_param("i", $id);

<<<<<<< HEAD
    if ($del->execute()) {
        header("Location: index.php");
=======
    if($del->execute()){
        header("Location: student_records.php");
>>>>>>> ea37ff5cf8619eb3b321777cd28589af5f7a24d5
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