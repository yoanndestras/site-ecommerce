<?php

session_start();

if(!isset($_SESSION['client_Id_Client']))
        {
            if(!isset($_SESSION['client_admin']))
            {
                header('Location: index.php');
            }
        }
        else if(!isset($_SESSION['client_admin']))
        {
            if(!isset($_SESSION['client_Id_Client']))
            {
                header('Location: index.php');
            }
        }

    
$pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
$pdo->exec('SET NAMES UTF8');

$nom = $_GET['order_name'];
$quantity = $_GET['orders_quantity'];

$update = $pdo->prepare
    (
        'UPDATE orderline SET orderline_quantity = orderline_quantity + ? WHERE order_name = ?'
    );
    $update->execute(array($quantity, $nom));

    if($update -> rowCount() > 0)
        {
            header('Location: command.php');
        }
    else
        {
            echo "Une erreur s'est produite lors de l'ajout de votre produit";
        }



$test = $pdo->prepare
(
    "DELETE FROM tampon WHERE tampon_meal_index = ? AND tampon_user_id = ?"
);

$test->execute(array($_GET['orders_id'],$_GET['orders_client_id']));

    if($test -> rowCount() > 0)
    {
        $deletarticle = $pdo->prepare
        (
            "DELETE FROM orders WHERE orders_id = ? AND orders_client_id = ?"
        );

        $deletarticle->execute(array($_GET['orders_id'],$_GET['orders_client_id']));
        if($test -> rowCount() > 0)
        {
            header('Location: command.php');

        }
    
        else
        {
            echo "erreuuuur";
        }

    }
    else
    {
        echo "erreur";
    }
