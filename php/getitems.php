<?php
session_start();
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) {
    $uid = $_SESSION["id"];
}
require_once "config.php";

$sql = "SELECT * FROM handleliste WHERE brukerid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();

$json_array = array();
while ($row = $result->fetch_assoc()) {
    $output = array();
    $output['id'] = $row['id'];
    $output['navn'] = $row['navn'];
    if($row['checked'] == 0 && $row['gjemt'] == 0) {

        $output['checked'] = "unchecked";
        $json_array[] = $output;
    } elseif ($row['checked'] == 1 && $row['gjemt'] == 0) {
        $output['checked'] = "checked";
        $json_array[] = $output;
    }
}
$reversed = array_reverse(array: $json_array);
echo json_encode($reversed);
$stmt->close();
$conn->close();
?>