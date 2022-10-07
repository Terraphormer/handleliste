<?php ob_start(); ?>
<div class="header">
    <a href="/handleliste/handleliste.php" class="menubtn1"><div><p>Liste</p></div></a>
    <a href="/handleliste/middag.php" class="menubtn2"><div><p>Middag</p></div></a>
    <div class="menubtn3" onclick="toggleSettings()"><p>Meny</p></div>
    <p class="headerUserName"><?php echo $_SESSION['user']; ?>'s Handleliste</p>
<?php 
session_start();
if ($_SERVER['PHP_SELF'] == "/handleliste/handleliste.php") {
    echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post" class="leggtil">
        <input type="text" class="leggtilinput" placeholder="Legg til vare.." name="item" autocomplete="off" autocapitalize="on">
        <button type="submit" class="leggtilknapp" id="addItem">+</button>
    </form>';
} elseif ($_SERVER['PHP_SELF'] == "/handleliste/middag.php") {
    echo '
    <button class="leggtilmiddag" onclick="addMiddag()">Legg til middagsrett</button>
    ';
}
?>
</div>
<div class="hiddenmenu" id="hiddenmenu" style="visibility: hidden;">
    <a href="/handleliste/usersystem/logout.php" class="hidmenubtn1"><div><p>Logg ut</p></div></a>
    <a href="/handleliste/stats.php" class="hidmenubtn2"><div><p>Stats</p></div></a>
    <div class="hidmenubtn3" onclick="toggleSettings()"><p>Meny</p></div>
</div>

<?php $userheader = ob_get_clean(); ob_start(); ?>

<div class="header">
    <a href="/handleliste/handleliste.php" class="menubtn1"><div><p>Liste</p></div></a>
    <a href="/handleliste/middag.php" class="menubtn2"><div><p>Middag</p></div></a>
    <div class="menubtn3" onclick="toggleSettings()"><p>Meny</p></div>
    <p class="nouser">Du må logge inn for å bruke denne appen</p>
</div>
<div class="hiddenmenu" id="hiddenmenu" style="visibility: hidden;">
    <a href="/handleliste/usersystem/logout.php" class="hidmenubtn1"><div><p>Logg ut</p></div></a>
    <a href="/handleliste/stats.php" class="hidmenubtn2"><div><p>Stats</p></div></a>
    <div class="hidmenubtn3" onclick="toggleSettings()"><p>Meny</p></div>
</div>
<?php $header = ob_get_clean(); ?>