<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['card_id'])) {
    $cardId = (int)$_POST['card_id'];
    
    if (!isset($_SESSION['collection'])) {
        $_SESSION['collection'] = [];
    }
    
    if (!isset($_SESSION['collection'][$cardId])) {
        $_SESSION['collection'][$cardId] = 1;
    } else {
        $_SESSION['collection'][$cardId]++;
    }
}

header('Location: index.php');
exit();
?> 