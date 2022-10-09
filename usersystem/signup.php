<?php
include "../header.php";
session_start();
require_once "../php/config.php";

$user = $pass = $cpass = "";
$user_err = $pass_err = $cpass_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["brukernavn"]))) {
        $user_err = "Du må skrive et gyldig brukernavn.";
    } elseif (!preg_match("/^[a-zA-Z0-9-_æøå]+$/", trim($_POST["brukernavn"]))) {
        $user_err = "Du må skrive et gyldig brukernavn.";
    } else {
        $user = trim($_POST["brukernavn"]);
    }

    if (empty(trim($_POST["passord"]))) {
        $pass_err = "Du må skrive et gyldig passord.";
    } else {
        $pass = trim($_POST["passord"]);
    }

    if (empty(trim($_POST["bekreft_passord"]))) {
        $cpass_err = "Bekreft passordet";
    } else {
        $cpass = trim($_POST["bekreft_passord"]);
        if ($pass != $cpass) {
            $pass_err = "Passordene må matche.";
        }
    }

    if (empty($user_err) && empty($pass_err) && empty($cpass_err)) {
        $sql = "INSERT INTO Brukere (Brukernavn, Passord) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $param_user, $param_pass);

        $param_user = $user;
        $param_pass = password_hash($pass, PASSWORD_DEFAULT);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }
}
?>

        <div>
            <?php   
                if (!empty($user_err)) { echo $user_err; } 
                if (!empty($pass_err)) { echo $pass_err; }
                if (!empty($cpass_err)) { echo $cpass_err; }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="register">

                    <input type="text" placeholder="Brukernavn" name="brukernavn" class="inputuname">
                    <input type="password" placeholder="Passord" name="passord" class="inputpass">
                    <input type="password" placeholder="Bekreft passord" name="bekreft_passord" class="inputconfpass">
                    <input type="submit" class="btnreg" value="Opprett bruker">
                    <input type="reset" class="btnres" value="Slett">

                <p><a href="login.php">Gå til inlogging</a></p>
            </form>
        </div>
<?php
include "../footer.php";
?>