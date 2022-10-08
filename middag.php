<?php
require_once "php/functions.php";
checkLogin();
$uid = $_SESSION['id'];
require_once "php/config.php";
include "header.php";

$sql = "SELECT * FROM middag WHERE brukerid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();

echo "<p style='margin: 8px;'>Har du noen av ingrediensene fra før? Kryss de vekk før du legger til!</p>";

while ($row = $result->fetch_assoc()) {
    if (!empty($row['navn'])) {
        echo "<button class='dropdown'>" . $row['navn'] . "</button><div class='panel'><ul id=" . $row['id'] . ">";

        if (!empty(trim($row['ing1']))) {
            echo "<li class='marker'>" . $row['ing1'] . "</li>";
        }
        if (!empty(trim($row['ing2']))) {
            echo "<li class='marker'>" . $row['ing2'] . "</li>";
        }
        if (!empty(trim($row['ing3']))) {
            echo "<li class='marker'>" . $row['ing3'] . "</li>";
        }
        if (!empty(trim($row['ing4']))) {
            echo "<li class='marker'>" . $row['ing4'] . "</li>";
        }
        if (!empty(trim($row['ing5']))) {
            echo "<li class='marker'>" . $row['ing5'] . "</li>";
        }
        if (!empty(trim($row['ing6']))) {
            echo "<li class='marker'>" . $row['ing6'] . "</li>";
        }
        if (!empty(trim($row['ing7']))) {
            echo "<li class='marker'>" . $row['ing7'] . "</li>";
        }
        if (!empty(trim($row['ing8']))) {
            echo "<li class='marker'>" . $row['ing8'] . "</li>";
        }
        if (!empty(trim($row['ing9']))) {
            echo "<li class='marker'>" . $row['ing9'] . "</li>";
        }
        if (!empty(trim($row['ing10']))) {
            echo "<li class='marker'>" . $row['ing10'] . "</li>";
        }
        if (!empty(trim($row['ing11']))) {
            echo "<li class='marker'>" . $row['ing11'] . "</li>";
        }
        if (!empty(trim($row['ing12']))) {
            echo "<li class='marker'>" . $row['ing12'] . "</li>";
        }
        if (!empty(trim($row['ing13']))) {
            echo "<li class='marker'>" . $row['ing13'] . "</li>";
        }
    }
    echo "</ul><button class='button2'>Legg ingredienser i handleliste</button><button class='slettRett'>Slett rett</button></div>";
}

include "footer.php";
?>

<script>
    function addMiddag() {
        window.location.href = "lagmiddag.php";
    }

    const li = document.getElementsByTagName("li");
    for (x = 0; x < li.length; x++) {
        li[x].addEventListener("click", function() {
            if (this.className === "nomarker") {
                this.className = "marker";
            } else {
                this.className = "nomarker";
            }
        })
    }

    document.body.addEventListener("click", e => {
        const btn = e.target.closest(".button2");
        if (!btn) return;
        const markerText = [...btn.previousElementSibling.children]
            .filter(li => li.classList.contains("marker") && li.textContent)
            .map(({
                textContent
            }) => textContent);
        var obj = markerText.reduce(function(acc, cur, i) {
            acc[i] = cur;
            return acc;
        }, {});

        /*         markerText.forEach(element => console.log(element));
                let l = 1;
                const data = markerText.map((textContent) => ({
                    [`ing${l++}`]: textContent
                }));

                const map1 = new Map(
                    data.map(object => {
                        return [object.key, object.value];
                    }),
                );
                console.log(map1);

                const iterator = data2.keys();

                for (const key of iterator) {
                    console.log(key, "key");
                }
                console.log(data);

                markerText.forEach(ul => {
                    let data = Array.from(ul.querySelectorAll(".marker")).reduce((obj, el, i) => obj = el.innerHTML ? {
                        ...obj,
                        [`ing${i+1}`]: el.innerHTML
                    } : obj, {})
                })

                console.log(data); */
        $.ajax({
            type: 'POST',
            url: 'php/addmiddag.php',
            data: obj,
            success: function(data) {
                console.log(data)
            }
        });
    }, {
        passive: true
    });

    /*     const add = document.querySelectorAll(".button2");
        for (i = 0; i < add.length; i++) {
            add[i].addEventListener("click", function() {

                const ul = document.querySelector('ul');
                const uniqueId = this.previousElementSibling.id;
                let uls = document.querySelectorAll("ul")
                uls.forEach(ul => {
                    let data = Array.from(ul.querySelectorAll(".marker")).reduce((obj, el, i) => obj = el.innerHTML ? {
                        ...obj,
                        [`ing${i+1}`]: el.innerHTML
                    } : obj, {})
                })

                $.ajax({
                    type: 'POST',
                    url: 'php/addmiddag.php',
                    data: data,
                    success: function(data) {
                        console.log(data)
                    }
                });
            })
        } */

    const drop = document.getElementsByClassName("dropdown");
    for (i = 0; i < drop.length; i++) {
        drop[i].addEventListener("click", function() {

            const panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>