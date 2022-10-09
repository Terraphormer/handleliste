<?php
require_once "php/functions.php";
checkLogin();
$uid = $_SESSION['id'];

require_once "php/config.php";
include "header.php";
$add_err ="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["item"]))) {
        $add_err = "Du må skrive noe";
    } elseif (!preg_match("/^[a-zA-Z0-9-_æøå ]+$/", trim($_POST["item"]))) {
        $add_err = "Du kan kun bruke bokstaver, tall og bindestrek";
    } else {
        $navn = trim($_POST["item"]);
        $sql = "INSERT INTO handleliste (brukerid, navn, checked) VALUES (?, ?, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $param_uid, $param_navn);
        $param_uid = $uid;
        $param_navn = $navn;
        $stmt->execute();
        $stmt->close();
        $conn->close();
        /* echo "<script>window.location.reload()</script>"; */
    }
}
echo $add_err;
?>

<ul id='unchecked'></ul>
<div class="toggleFullført">
    <button id="toggleFullført" onclick="toggleFullført()">Fullført</button>
    <button id ="toggleHide" onclick="toggleHide()">Fjern fullførte</button>
</div>
<ul id='checked'></ul>
<script>
async function toggleCheck(clicked) {
    if ($(clicked).parent().attr("id")=="checked") {
        $("#unchecked").append($(clicked));
        $(clicked).addClass("unchecked");
        $(clicked).removeClass("checked");
    } else { 
        $("#checked").append($(clicked));
        $(clicked).addClass("checked");
        $(clicked).removeClass("unchecked");
    }
    $.ajax({
        type: 'POST',
        url: 'php/changeitems.php',
        data: {id: $(clicked).attr("id")},
        success: function(data) { 
            console.log(data, "Sent")
        }
    });
}

async function toggleHide() {
    $.ajax({
        type: "POST",
        url: "php/hideitems.php",
        dataType: "html",
        data: {id: 1},
        success: function(data) {
            console.log(data);
            location.reload();
        }
    })
}

$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "php/getitems.php",
        dataType: "json",
        success: function(data) {
            for(let i = 0; i < data.length; i++) {
                let obj = data[i];
                var tempDiv = $("<li>").attr("id", obj['id']).text(obj['navn']).attr("onclick", "toggleCheck(this)");
                if (obj['checked'] == "unchecked") {
                    $(tempDiv).addClass("unchecked");
                    $("#unchecked").append($(tempDiv));
                } else {
                    $(tempDiv).addClass("checked");
                    $("#checked").append($(tempDiv));
                }
            }
        }
    });
});

</script>
<?php
include "footer.php";
?>