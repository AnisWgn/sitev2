<?php 
session_start();
require_once 'config.php';
$stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email) VALUES (:nom, :email)");

$nom = "";
$Prix = "dupont@example.com";

$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':email', $email);
$stmt->execute();

echo "Utilisateur ajouté avec succès !";
?>