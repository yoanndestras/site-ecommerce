<?php
session_start();

if(!isset($_SESSION['client_admin']))
        {
            header('Location: index.php');
        }

$pdo = new PDO('mysql:host=localhost;dbname=ecommerce', 'root', 'root');
$pdo->exec('SET NAMES UTF8');


if(isset($_FILES['image']))
{ 
    $nom = htmlspecialchars($_POST['Nom']);
	$description = htmlspecialchars($_POST['Description']);

    $dossier = 'upload/';
    $fichier = basename($_FILES['image']['name']);

    if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) 
    {
        echo 'Upload effectué avec succès !';
        $image = $dossier."".$fichier;
    }
    else
    {
        $image = $_POST['imageactuelle'];
    }

    $stock = htmlspecialchars($_POST['Stock']);
	$buy_price = htmlspecialchars($_POST['buy_price']);
    $sell_price = htmlspecialchars($_POST['sell_price']);



}

$save_meal = $pdo->prepare
(
    'INSERT INTO orderline (order_name, orderline_description, orderline_img, orderline_quantity, orderline_buy_price, orderline_sell_price) values (?, ?, ?, ?, ?, ?)'
);

$save_meal->execute(array($nom, $description, $image, $stock, $buy_price, $sell_price));

header('Location: create_meal.php');
