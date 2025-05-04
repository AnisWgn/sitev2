<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $login = $_POST["login"];
  $password = $_POST["password"];

  if ($login == "admin" && $password == "1234") {
    $_SESSION["login"] = $login;

    header("Location:dashboard.php");
    exit();
  } else {
    $erreur = "Identifiants incorrects";
  }
}
?>

<form action="" method="post">
  <label for="login">Nom d'utilisateur :</label>
  <input type="text" id="login" name="login"><br><br>
  <label for="password">Mot de passe :</label>
  <input type="password" id="password" name="password"><br><br>
  <input type="submit" value="Se connecter">
</form>

<?php if (isset($erreur)) { ?>
  <p style="color: red;"><?php echo $erreur; ?></p>
<?php } ?>