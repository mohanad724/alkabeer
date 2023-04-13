<?php
session_start();

if(isset($_SESSION['teach_id'])) {
    session_destroy();
    unset($_SESSION['teach_id']);
    unset($_SESSION['teach_name']);
    header("Location: index.php");
} else {
    header("Location: index.php");
}
?>