<?php
session_start();

if(!isset($_SESSION['client_admin']))
        {
            header('Location: index.php');            
        }

$pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
$pdo->exec('SET NAMES UTF8');



$delet = $pdo->prepare
(
    "DELETE FROM client WHERE client_Id_Client = ?"
);
$delet->execute([$_GET['client_Id_Client']]);




header('Location: admin_account.php');