<?php
require_once "php/functions.php";
checkLogin();
$uid = $_SESSION['id'];
require_once "php/config.php";
include "header.php";
?>
<style>
    .accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  text-align: left;
  border: none;
  outline: none;
  transition: 0.4s;
}

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active, .accordion:hover {
  background-color: #ccc;
}

/* Style the accordion panel. Note: hidden by default */
.panel {
    margin: 8px 0px;
  padding: 0 18px;
  background-color: white;
  display: none;
  overflow: hidden;
}

.button {
    width: 100%;
    margin: 0;
}
</style>
<button class="accordion">Pizza</button>
<div class="panel">
    <ul>
        <li>Kjøttdeig</li>
        <li>Ost</li>
    </ul>
    <button class="button">Legg i handleliste</button>
</div>

<button class="accordion">Section 2</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Section 3</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>