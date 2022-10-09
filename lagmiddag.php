<?php
require_once "php/functions.php";
checkLogin();
require_once "php/config.php";
include "header.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['navn'])) || empty(trim($_POST['igr1'])) || empty(trim($_POST['igr2']))) {
        echo "Retten må ha navn, og inneholde minst 2 ingredienser.";
    } else {
        $sql = "INSERT INTO middag (navn, ing1, ing2, ing3, ing4, ing5, ing6, ing7, ing8, ing9, ing10, ing11, ing12, ing13, brukerid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssssss", $param_navn, $param_ing1, $param_ing2, $param_ing3, $param_ing4, $param_ing5, $param_ing6, $param_ing7, $param_ing8, $param_ing9, $param_ing10, $param_ing11, $param_ing12, $param_ing13, $param_brukerid);
        $param_navn = trim($_POST['navn']);
        $param_ing1 = trim($_POST['igr1']);
        $param_ing2 = trim($_POST['igr2']);
        $param_ing3 = trim($_POST['igr3']);
        $param_ing4 = trim($_POST['igr4']);
        $param_ing5 = trim($_POST['igr5']);
        $param_ing6 = trim($_POST['igr6']);
        $param_ing7 = trim($_POST['igr7']);
        $param_ing8 = trim($_POST['igr8']);
        $param_ing9 = trim($_POST['igr9']);
        $param_ing10 = trim($_POST['igr10']);
        $param_ing11 = trim($_POST['igr11']);
        $param_ing12 = trim($_POST['igr12']);
        $param_ing13 = trim($_POST['igr13']);
        $param_brukerid = trim($_SESSION['id']);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        echo "<p class='text'>Fullført, du kan legge til flere retter, eller <a href='middag.php'>Gå tilbake til oversikten</a></p>";
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="lagmiddag">
    <input type="text" placeholder="Navn på middagsrett" class="ingrediens" name="navn" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #1" class="ingrediens" name="igr1" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #2" class="ingrediens" name="igr2" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #3" class="ingrediens" name="igr3" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #4" class="ingrediens" name="igr4" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #5" class="ingrediens" name="igr5" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #6" class="ingrediens" name="igr6" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #7" class="ingrediens" name="igr7" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #8" class="ingrediens" name="igr8" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #9" class="ingrediens" name="igr9" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #10" class="ingrediens" name="igr10" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #11" class="ingrediens" name="igr11" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #12" class="ingrediens" name="igr12" autocapitalize="on" autocomplete="off">
    <input type="text" placeholder="Ingrediens #13" class="ingrediens" name="igr13" autocapitalize="on" autocomplete="off">
    <input type="submit" value="Opprett middagsrett" class="ingrediens">
</form>
<?php
include "footer.php";
?>