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
$nb_article = $_GET['nb_article'];


$updatedelet = $pdo->prepare
(
    'UPDATE orderline SET orderline_quantity = orderline_quantity + ? WHERE order_name = ?'
);
$updatedelet->execute(array($quantity, $nom));

    if($updatedelet -> rowCount() > 0)
        {
            $update = $pdo->prepare
            (
                'UPDATE orderline SET orderline_quantity = orderline_quantity - ? WHERE order_name = ?'
            );
            $update->execute(array($nb_article, $nom));

            header('Location: command.php');
        }
    else
        {
            echo "Une erreur s'est produite lors de l'ajout de votre produit";
        }


$actualiseTampon = $pdo->prepare
(
    'UPDATE tampon SET tampon_meal_quantity = ?  WHERE tampon_meal_index = ? AND tampon_user_id = ?'
);
$actualiseTampon->execute(array($_GET['nb_article'],$_GET['orders_id'],$_GET['orders_client_id']));


if($actualiseTampon -> rowCount() > 0)
    {
        $actualise = $pdo->prepare
        (
            'UPDATE orders SET orders_quantity = ?  WHERE orders_id = ? AND orders_client_id = ?'
        );
        $actualise->execute(array($_GET['nb_article'],$_GET['orders_id'],$_GET['orders_client_id']));


        if($actualise -> rowCount() > 0)
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
        echo "erreuuuussr";
    }