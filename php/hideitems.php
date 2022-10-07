<?php
session_start();
require_once "config.php";

/* var_dump($_POST['id']);
echo "<br>";
var_dump(json_decode($_POST['id']));
echo "<br>"; */
echo $_POST['id'];
/* echo "<br>";
echo $_SESSION['id'];
echo "<br>";
echo "Ajax virker"; */

if (isset($_POST['id'])) {
    $hide = $_POST['id']; 
    if ($hide == 1) {
        $sql = "UPDATE handleliste SET gjemt = 1 WHERE brukerid = ? AND checked = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $param_id);
        $param_id = $_SESSION['id'];
        $stmt->execute();
        $stmt->close();
    }
}
$conn->close();
?>