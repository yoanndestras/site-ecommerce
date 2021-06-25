<?php
    session_start();
    
    if(!isset($_SESSION['client_admin']))
        {
            header('Location: index.php');
        }

$pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
$pdo->exec('SET NAMES UTF8');

    $insertTampon = $pdo->prepare
    (
        'SELECT * FROM  tampon WHERE tampon_user_id = ? '
    );
    $insertTampon->execute(array($session));
    $test = $insertTampon->fetchAll();
    
    /*
    SELECT client, SUM(tarif)
    FROM achat
    GROUP BY client
    */

    $getthemeal = $pdo->prepare
    (
    "SELECT MIN(x.meal_id),  x.meal_user, x.meal_id, x.meal_date, x.meal_tva_price, x.meal_total 
        FROM meal x
        JOIN 
            (
                SELECT p.meal_user, p.meal_total, MAX(meal_id) AS max_total
                FROM meal p
                GROUP BY p.meal_user, p.meal_total
            )
        y ON y.meal_user = x.meal_user AND y.meal_total = x.meal_total AND y.max_total = x.meal_id
        WHERE x.meal_state = 0
        GROUP BY x.meal_user, x.meal_id, x.meal_total
        ORDER BY x.meal_date"
    );
    $getthemeal->execute();
    $meal = $getthemeal->fetchAll();
    
    //print_r ($meal);

    $user_meal_id = $_GET['meal_user'];
    $date_meal_id = $_GET['meal_date'];

    $getMeal = $pdo->prepare
    (
        "SELECT * FROM meal WHERE meal_user = ? AND meal_date = ? AND meal_state = 0"
    );
    $getMeal->execute(array($user_meal_id, $date_meal_id));
    $mealdetail = $getMeal->fetchAll();

    $getsendMeal = $pdo->prepare
    (
        "SELECT * FROM meal WHERE meal_state = 1"
    );
    $getsendMeal->execute();
    $mealsenddetail = $getsendMeal->fetchAll();

    $detailscommande = $pdo->prepare
    (
        'SELECT client_Nom, client_Prenom, client_Adresse, client_Ville, client_Code_Postal, client_Pays, client_Telephone, meal_state = 0
        FROM  client
        INNER JOIN meal ON client.client_Id_Client = meal.meal_user
        WHERE client_Id_Client = ?'
    );
    $detailscommande->execute(array($user_meal_id));
    $oui = $detailscommande->fetch();

    
?>

<!DOCTYPE html>

<html lang="fr">
<head>
 	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  	<title>Admin Panel</title>

<!-- CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/ef488c0f83.js" crossorigin="anonymous"></script>
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
        <h1 style="margin: 40px">Panneau d'administration </h1>
        <table class="table table-bordred table-striped" >

        <tr class="table-success" style="text-align: center" >
            <th>Num Commande</th>
            <th>Num User</th>
            <th>Date Commande</th>
            <th>TVA Price</th>
            <th>Total</th>
            <th>Details</th>
        </tr>
        
        <?php 
            foreach($meal as $meals)
            {
                echo
                '<tr  style="text-align: center; font-size: 1.2em;">
                    <td style="width: 20%" >'.$meals['meal_id'].'</td>
                    <td style="width: 20%" >'.$meals['meal_user'].'</td>
                    <td style="width: 20%" >'.$meals['meal_date'].'</td>
                    <td style="width: 20%" >'.$meals['meal_tva_price'].' € </td>
                    <td style="width: 10%" >'.$meals['meal_total'].' € </td>
                    <td style="width: 10%" ><a style="font-size: 1.2em; color:green" href= panneau.php?meal_user='.$meals['meal_user'].'&amp;meal_date='.urlencode($meals['meal_date']).'><i class="far fa-eye"></i></a></td>
                    </tr>';       
            }
        ?> 
        </table>

        <h2 style="margin: 40px">Détails de la commande</h2>

            <table class="table table-bordred table-striped" >

            <tr class="table-warning" style="text-align: center" >
                <th>Order Name</th>
                <th>Quantity</th>
            </tr>
            <form class="form-group" method="POST" action="valid_command_send.php">

            <?php
            
            foreach($mealdetail as $detail)
            {
                
                echo 
                '<tr  style="text-align: center; font-size: 1.2em;">
                    <td style="width: 50%">'.$detail['meal_name'].'</td>
                    <td style="width: 50%">'.$detail['meal_quantity'].'</td>
                </tr>';
                $id_user = $detail['meal_user'];
                $id_date = $detail['meal_date'];
                $id_name = $detail['meal_name'];
                
            }
            echo '</table><table class="table table-bordred table-striped" >

                <tr class="table-warning" style="text-align: center" >
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Ville</th>
                    <th>Code Postal</th>
                    <th>Pays</th>
                    <th>Telephone</th>
                </tr>
                <tr style="text-align: center; font-size: 1.2em;">
                    <td style="width: 15%">'.$oui['client_Nom'].'</td>
                    <td style="width: 15%">'.$oui['client_Prenom'].'</td>
                    <td style="width: 15%">'.$oui['client_Adresse'].'</td>
                    <td style="width: 15%">'.$oui['client_Ville'].'</td>
                    <td style="width: 15%">'.$oui['client_Code_Postal'].'</td>
                    <td style="width: 15%">'.$oui['client_Pays'].'</td>
                    <td style="width: 15%">'.$oui['client_Telephone'].'</td>
                </tr>';
            ?>
            </table>
            <input type="hidden" name="id_user" value="<?=$id_user?>"></input>
            <input type="hidden" name="id_date" value="<?=$id_date?>"></input>
            <div style="text-align: center">
                <input class="btn btn-outline-success"  type="submit" class="col-sm-12"name="envoi" value="Commande prête" >
            </div>
        </form>
             <br/>
             <h2 style="margin: 40px">Commandes envoyées</h2>
            <form class="form-group" method="POST" action="valid_command_finished.php">

            <?php
            $compteur = 0;
            foreach($mealsenddetail as $details)
            {
                    $adresse = $yes['client_Adresse'];
                    $nom = $yes['client_Nom'];

                    $detailssendcommand = $pdo->prepare
                    (
                        'SELECT client_Nom, client_Prenom, client_Adresse, client_Ville, client_Code_Postal, client_Pays, client_Telephone, meal_state = 1
                        FROM  client
                        INNER JOIN meal ON client.client_Id_Client = meal.meal_user
                        WHERE meal_date = ?'
                    );

                    $detailssendcommand->execute(array($details['meal_date']));
                    $yes = $detailssendcommand->fetch();

                    if( $adresse !== $yes['client_Adresse'])
                        {
                            $compteur = 1;
                        }
                    else if ($adresse == $yes['client_Adresse'])
                        {
                            $compteur = 0;
                        }

                    if ($compteur == 1)
                        {
                            echo '<div style="border: none; margin-top: 50px" ></div>';

                            echo '<div style="border: solid 1px #03045e; margin-bottom: 0px" ></div>

                            <table class="table table-bordred table-striped">
                            <tr class="table-info" style="text-align: center" >
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Adresse</th>
                                <th>Ville</th>
                                <th>Code Postal</th>
                                <th>Pays</th>
                                <th>Telephone</th>
                            </tr>
                            <tr style="text-align: center; font-size: 1.2em;">
                                <td style="width: 12%">'.$yes['client_Nom'].'</td>
                                <td style="width: 12%">'.$yes['client_Prenom'].'</td>
                                <td style="width: 12%">'.$yes['client_Adresse'].'</td>
                                <td style="width: 12%">'.$yes['client_Ville'].'</td>
                                <td style="width: 12%">'.$yes['client_Code_Postal'].'</td>
                                <td style="width: 12%">'.$yes['client_Pays'].'</td>
                                <td style="width: 12%">'.$yes['client_Telephone'].'</td>
                            </tr></table>';
                        }
                            echo 
                            '<table class="table table-bordred table-striped">

                            <tr style="text-align: center" >
                                <th>Order Name</th>
                                <th>Quantity</th>
                                <th>Hour</th>
                            </tr>

                            <tr style="text-align: center; font-size: 1.2em;">
                                <td style="width: 33%">'.$details['meal_name'].'</td>
                                <td style="width: 33%">'.$details['meal_quantity'].'</td>
                                <td style="width: 33%">'.$details['meal_date'].'</td>
                                </table>';
                        }
                            echo '<div style="border: solid 1px #03045e; margin-bottom: 20px" ></div>';


            ?>

            <div style="text-align: center">
                <input type="submit" class="btn btn-outline-danger" class="col-sm-12"name="envoi" value="Supprimer l'historique" >
            </div>
        </form>
        <br/>
        </main>
</body>
</html>