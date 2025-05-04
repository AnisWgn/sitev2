<?php
session_start();
$Username = 'root';
$Password = '';
try {
    $pdo = new PDO("mysql:host=localhost;dbname=slam_tp1", "$Username", "$Password");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
