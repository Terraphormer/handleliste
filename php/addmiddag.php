<?php
require_once "config.php";
session_start();
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) {
    $uid = $_SESSION["id"];
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    echo $id;
}

$sql = "INSERT INTO handleliste (brukerid, navn) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $param_uid, $param_navn);
$param_uid = $uid;

$param_navn = $_POST['0'];
$stmt->execute();

$param_navn = $_POST['1'];
$stmt->execute();

$param_navn = $_POST['2'];
$stmt->execute();

$param_navn = $_POST['3'];
$stmt->execute();

$param_navn = $_POST['4'];
$stmt->execute();

$param_navn = $_POST['5'];
$stmt->execute();

$param_navn = $_POST['6'];
$stmt->execute();

$param_navn = $_POST['7'];
$stmt->execute();

$param_navn = $_POST['8'];
$stmt->execute();

$param_navn = $_POST['9'];
$stmt->execute();

$stmt->close();

?>