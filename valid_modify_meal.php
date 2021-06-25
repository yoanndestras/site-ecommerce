<?php
session_start();

if(!isset($_SESSION['client_admin']))
        {
            header('Location: index.php');
        }

$pdo = new PDO('mysql:host=localhost;dbname=ecommerce', 'root', 'root');
$pdo->exec('SET NAMES UTF8');


$nom = htmlspecialchars($_POST['Nom']);
$description = htmlspecialchars($_POST['Description']);
$stock = htmlspecialchars($_POST['Stock']);
$buy_price = htmlspecialchars($_POST['buy_price']);
$sell_price = htmlspecialchars($_POST['sell_price']);



$save_meal = $pdo->prepare
(
    'UPDATE orderline SET order_name = ?, orderline_description = ?, orderline_quantity = ?, orderline_buy_price = ?, orderline_sell_price = ? WHERE order_name = ?'
);

$save_meal->execute(array($nom, $description, $stock, $buy_price, $sell_price, $nom));

header('Location: create_meal.php');
