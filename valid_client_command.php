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

?>
<!DOCTYPE html>

<html lang="fr">
<head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Validation de commande</title>

<!-- CSS -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <header>
        <?php

            if(isset($_SESSION['client_Id_Client']))
            {
                include('navbar_membre.html');
            }
            else if(isset($_SESSION['client_admin']))
            {
                include('navbar_admin.html');
            }
            else
            {
                include('navbar.html');
            }
        ?>
    </header>
        <main>
             <h3>Votre commande a été validé avec succés, elle vous sera livrée dans les plus bref délais</h3>

            
            <img src="upload/succes.jpg"alt="">
        </main>
</body>
</html>