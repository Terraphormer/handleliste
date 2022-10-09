<?php
function checkLogin() {
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: usersystem/login.php");
    exit;
} else {
    $uid = $_SESSION["id"];
    return $uid;
}
}
?>