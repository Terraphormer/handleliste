<?php
require_once "php/functions.php";
checkLogin();
$uid = $_SESSION['id'];

require_once "php/config.php";
include "header.php";

$sql = "SELECT * FROM handleliste WHERE brukerid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $param_uid);
$param_uid = $uid;
$stmt->execute();
$result = $stmt->get_result();

$allitems = array();

while ($row = $result->fetch_assoc()) {
    echo $row['navn'];
}
?>