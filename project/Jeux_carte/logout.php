<?php
// Inclure le header en premier
require_once 'includes/header.php';

session_start();
session_destroy();
header('Location: index.php');
exit();
?> 