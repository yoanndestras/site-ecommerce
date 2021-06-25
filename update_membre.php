<?php

session_start();

if(!isset($_SESSION['client_admin']))
        {
            header('Location: index.php');
        }

$pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
$pdo->exec('SET NAMES UTF8');


$update = $pdo->prepare
(
    'UPDATE client SET client_admin = 1 WHERE client_Id_Client = ?'
);


$update->execute([$_GET['client_Id_Client']]);

header('Location: admin_account.php');