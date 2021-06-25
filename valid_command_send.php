<?php

session_start();

if(!isset($_SESSION['client_admin']))
        {
            header('Location: index.php');
        }

$pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
$pdo->exec('SET NAMES UTF8');

$userID = htmlspecialchars($_POST['id_user']);
$dateID = htmlspecialchars($_POST['id_date']);

$update = $pdo->prepare
(
    'UPDATE meal SET meal_state = 1 WHERE meal_user = ? AND meal_date = ?'
);
$update->execute(array($userID, $dateID));



header('Location: panneau.php');