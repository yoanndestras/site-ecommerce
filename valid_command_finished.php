<?php

session_start();

if(!isset($_SESSION['client_admin']))
        {
            header('Location: index.php');
        }

$pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
$pdo->exec('SET NAMES UTF8');


if(isset($_POST['envoi']))
{

    $userID = htmlspecialchars($_POST['id_user']);
    $dateID = htmlspecialchars($_POST['id_date']);


    $validcommand = $pdo->prepare
    (
        "DELETE FROM meal WHERE meal_state = 1"
    );
    $validcommand->execute();


    if($validcommand -> rowCount() > 0)
        {
            header('Location: panneau.php');
        }
    else
        {
            header('Location: panneau.php');
        }
}