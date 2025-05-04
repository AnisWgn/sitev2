<?php
session_start();
session_destroy();
header("Location:Page_De_Connexion.php");
exit();
?>
