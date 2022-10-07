<?php
require_once "config.php";
session_start();
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) {
    $uid = $_SESSION["id"];
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    echo $id;

    $sql = "SELECT * FROM handleliste WHERE brukerid = ? AND id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $uid, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        if($row['checked'] == 0) {
            $update = "UPDATE handleliste SET checked = 1 WHERE id = ?";
            $stmt = $conn->prepare($update);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        } elseif ($row['checked'] == 1) {
            $update = "UPDATE handleliste SET checked = 0 WHERE id = ?";
            $stmt = $conn->prepare($update);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }
}
$conn->close();

?>