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
       
    $nom = htmlspecialchars($_POST['order']);
    $quantity = htmlspecialchars($_POST['Stock']);
    $img = htmlspecialchars($_POST['img']);
    $price = htmlspecialchars($_POST['price']);

    
    echo $nom;
    echo $quantity;
    echo $img;
    echo $session;

    
    $update = $pdo->prepare
    (
        'UPDATE orderline SET orderline_quantity = orderline_quantity - ? WHERE order_name = ?'
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




    $insertOrder = $pdo->prepare
    (
        'INSERT INTO  orders (orders_name, orders_quantity, orders_img, orders_sell_price, orders_client_id) VALUES (?, ?, ?, ?, ?)'
    );

    $insertOrder->execute(array($nom, $quantity, $img, $price, $session));

    $getID = $pdo->prepare
    (
        "SELECT orders_id FROM orders WHERE orders_name = ?"
    );

    $getID->execute(array($nom));
    $getsID = $getID->fetch();

    $insertTampon = $pdo->prepare
    (
        'INSERT INTO  tampon (tampon_meal_name, tampon_meal_quantity, tampon_user_id, tampon_meal_index) VALUES (?, ?, ?, ?)'
    );

    $insertTampon->execute(array($nom, $quantity, $session, $getsID['orders_id']));

    if($insertOrder -> rowCount() > 0)
        {
            header('Location: command.php');
        }
    else
        {
            echo "Une erreur s'est produite lors de l'ajout de votre produit";
        }
    }
?>