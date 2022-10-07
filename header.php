<?php
session_start();
include "usersystem/userheader.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/handleliste/css/style.css">
    <link rel="icon" type="image/x-icon" href="/handleliste/images/icon8-ingredients-cloud-32.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Handleliste-App</title>
</head>
<body>
    <div class="wrapper">
        <?php
        if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {
            echo $header;
        } else {
            echo $userheader;
        }
        ?>
        <div style="height: 160px;"></div>