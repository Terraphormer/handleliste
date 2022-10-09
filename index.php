<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: usersystem/login.php");
    exit;
} else {
    header("location: handleliste.php");
}
?>