<?php
require_once "../php/config.php";
// session_start();
$user = $user_err = "";
$pass = $pass_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["brukernavn"]))) {
        $user_err = "Vennligst skriv inn brukernavn";
    } elseif (!preg_match("/^[a-zA-Z0-9-_]+$/", trim($_POST["brukernavn"]))) {
        $user_err = "Du må skrive et gyldig brukernavn.";
    } else {
        $user = trim($_POST["brukernavn"]);
    }

    if (empty(trim($_POST["passord"]))) {
        $pass_err = "Du må skrive et gyldig passord.";
    } else {
        $pass = trim($_POST["passord"]);
    }

    if (empty($user_err) && empty($pass_err)) {
        $sql = "SELECT ID, Brukernavn, Passord FROM Brukere WHERE Brukernavn = ?";
        
        /* $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Navn: " . $row["Brukernavn"]. " - Pass: " . $row["Passord"];
            }
        } else {
            echo "0 Results.";
        } */

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $param_user);
        $param_user = $user;

        if ($stmt->execute()) {
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $user, $hashed_pass);
                if ($stmt->fetch()) {
                    if (password_verify($pass, $hashed_pass)) {
                        session_start();

                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["user"] = $user;

                        header("Location: ../index.php");
                    } else {
                        $login_err = "Noe gikk galt... Feil passord e.l.";
                    }
                }
            }
        }
        $stmt->close();
    }
    $conn->close();
}

include "../header.php";
?>

        <div>
                <?php
                    if (!empty($user_err)) { echo $user_err; }
                    if (!empty($pass_err)) { echo $pass_err; }
                    if (!empty($login_err)) { echo $login_err; }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="register">
                        <input type="text" placeholder="Brukernavn" name="brukernavn" class="inputuname">
                        <input type="password" placeholder="Passord" name="passord" class="inputpass">
                        <input type="submit" class="btnreg" value="Logg inn">
                        <input type="reset" class="btnres" value="Slett">
                </form>
                <a href="signup.php" class="nybruker"><button class="knapp">Opprett bruker</button></a>
        </div>

<?php
include "../footer.php";
?>