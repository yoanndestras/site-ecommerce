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

if(!isset($_SESSION['client_Id_Client']))
{
    $session = $_SESSION['client_Id_Client_admin'];
}
else
{
    $session = $_SESSION['client_Id_Client'];
}


if(isset($_POST['envoi']))
{
    $TVA = htmlspecialchars($_POST['TVA']);
    $totalTTC = htmlspecialchars($_POST['totalTTC']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $name = htmlspecialchars($_POST['name']);


    echo $TVA;
    echo $totalTTC;
    echo $session;

    $insertTampon = $pdo->prepare
    (
        'SELECT * FROM  tampon WHERE tampon_user_id = ? '
    );

    $insertTampon->execute(array($session));
    $test = $insertTampon->fetchAll();

    foreach($test as $tests)
            {
            $validOrder = $pdo->prepare
            (
                'INSERT INTO  meal (meal_user, meal_tva_price, meal_total, meal_quantity, meal_name, meal_date) VALUES (?, ?, ?, ?, ?, now())'
            );

            $validOrder->execute(array($session, $TVA, $totalTTC, $tests['tampon_meal_quantity'], $tests['tampon_meal_name']));
            }

    $delettampon = $pdo->prepare
    (
        "DELETE FROM tampon WHERE tampon_user_id = ?"
    );
    $delettampon->execute([$session]);

    if($validOrder -> rowCount() > 0)
        {
            
        $deletpanier = $pdo->prepare
        (
            "DELETE FROM orders WHERE orders_client_id = ?"
        );
        $deletpanier->execute([$session]);


            header('Location: valid_client_command.php');
        }
    else
        {
            echo "Une erreur s'est produite lors de la validation de votre panier";
        }
}



