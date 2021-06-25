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

        $jour = htmlspecialchars($_POST['day']);
        $mois = htmlspecialchars($_POST['month']);
        $année = htmlspecialchars($_POST['year']);
        $heure = htmlspecialchars($_POST['minutes']);
        $couverts = htmlspecialchars($_POST['nb_couverts']);


        $date = $année."-".$mois."-".$jour." ".$heure.":"."00";
        echo $date;

        echo $couverts;

        
        $book = $pdo->prepare
        (
            'INSERT INTO booking (booking_date, booking_couverts) VALUES (?, ?)'
        );
        $book->execute(array($date, $couverts));

        if($book -> rowCount() > 0)
            {
                header('Location: booking_valid.php');
            }
        else
            {
                echo "Une erreur s'est produite lors de l'ajout de votre produit";
            }

    }
?>