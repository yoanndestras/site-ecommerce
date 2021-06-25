<?php
    session_start();

    if(!isset($_SESSION['client_Id_Client']))
        {
            if(!isset($_SESSION['client_admin']))
            {
                $message = "Veuillez vous connecter pour passer une commande";
			    echo "<script type='text/javascript'>alert('$message'); window.location.href='connect_account.php'</script>";
            }
        }
        else if(!isset($_SESSION['client_admin']))
        {
            if(!isset($_SESSION['client_Id_Client']))
            {
                $message = "Veuillez vous connecter pour passer une commande";
			    echo "<script type='text/javascript'>alert('$message'); window.location.href='connect_account.php'</script>";
            }
        }
        
    
    
    if(!isset($_SESSION['client_Id_Client']))
        {
            $session = $_SESSION['client_Id_Client_admin'];
        }
    else
        {
            $session = $_SESSION['client_Id_Client'];
        }

    $pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
    $pdo->exec('SET NAMES UTF8');

    $getProducts = $pdo->prepare
    (
        "SELECT * FROM orderline"
    );

    $getProducts->execute();
    $listeProducts = $getProducts->fetchAll();
    
    $query = $pdo->prepare
    (
        'SELECT * FROM orderline WHERE orderline_id = ?'
    );

    $query->execute([$_GET['orderline_id']]);
    $order = $query->fetch();

    
    $panier = $pdo->prepare
    (
        'SELECT * FROM orders WHERE orders_client_id = ?'
    );
    $panier->execute(array($session));
    

?>

<!DOCTYPE html>

<html lang="fr">
<head>
 	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  	<title>Passer une commande</title>

<!-- CSS -->
        <script src="https://kit.fontawesome.com/ef488c0f83.js" crossorigin="anonymous"></script>
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
      <h1 style="margin: 40px">Commande </h1>
        <form method="POST" action="valid_command.php" class="form-group" >

            <fieldset>
                <legend style="margin: 40px; font-size: 2em">Ajouter un article <span style="font-size: 0.5em; color: red">(Ne pas ajouter le même article au panier plusieurs fois mais choisir sa quantité directement svp)</span></legend>
                    <div class="form-group row">
                        
                        <label for="Nom" class="col-sm-2 col-form-label">Nom :</label>
                                <select  name="Nom"  id="Nom" onchange="location = this.value">
                                    <?php
                                        echo '<option value="choose">Choisissez</option>';



                                        foreach($listeProducts as $product)
                                        {
                                            echo '<option value="command.php?orderline_id='.$product['orderline_id'].'&amp;order_name='.$product['order_name'].'&amp;orderline_img='.$product['orderline_img'].'&amp;orderline_sell_price='.$product['orderline_sell_price'].'&amp;orderline_quantity='.$product['orderline_quantity'].'">'.$product['order_name'].'</option>';
                                        }
                                    ?>
                                </select>  
                    </div>
                    <div class="form-group row">
                        <label for="Stock" class="col-sm-2 col-form-label">Quantité :</label>
                        <input type="number" min="1" max="<?=$_GET['orderline_quantity']?>" name="Stock" autocomplete="off" required>
                    </div>

                            <?php 
                                if (isset($order['order_name']))
                                    {
                                        ?> 
                                        <table class="table table-bordred table-striped" >
                                            <tr style="text-align: center" >
                                                <th>Illustration</th>
                                                <th>Nom</th>
                                                <th>Description</th>
                                                <th>Prix</th>
                                                </tr>
                                        <?php 
                                    }
                                if (isset($order['order_name']))
                                    {
                                        echo
                                        '<tr>
                                            <td  style="width: 20%"><img style="width: 300px; height: 200px" src="'.$order['orderline_img'].'" /></td>
                                            <td  style="width: 20%" font-size: 1.2em;">'.$order['order_name'].'</td>
                                            <td  style="width: 60%" font-size: 1.2em;">'.$order['orderline_description'].'</td>
                                            <td  style="font-size: 1.2em;">'.$order['orderline_sell_price'].'€</td>
                                        </tr>';
                                    }
                            ?> 

                        </table>
                    <input type="hidden" name="img" value="<?=$_GET['orderline_img']?>"></input>
                    <input type="hidden" name="order" value="<?=$_GET['order_name']?>"></input>
                    <input type="hidden" name="price" value="<?=$_GET['orderline_sell_price']?>"></input>
        
                    <div style="text-align: center">
                        <input style="text-align: center" class="btn btn-primary" type="submit" name="envoi" value="Ajouter"></input>
                    </div>
            </fieldset>
        </form>
        <form method="POST" action="valid_all_command.php">
            <fieldset>
                <legend style="margin: 40px; font-size: 2em" >Récapitultif de la commande <span style="font-size: 0.5em; color:red">(Le contenu de votre panier est résérvé pendant une heure)</span></legend>

                <table class="table table-bordred table-striped">
                <tr style="text-align: center" >
                                <th>Illustration</th>
                                <th>Nom</th>
                                <th>Quantité</th>
                                <th>Modify Quantity</th>
                                <th>Prix Unitaire</th>
                                <th>Prix Total</th>
                                <th>Delete</th>
                                </tr>
                    <?php
                        if($panier -> rowCount() > 0)
                        {
                            $tampon = 0;

                            

                            foreach($panier as $paniers)
                                {
                                    
                                    $getNameQuantity = $pdo->prepare
                                    (
                                        'SELECT orderline_quantity FROM orderline WHERE order_name = ?'
                                    );
                                    $getNameQuantity->execute(array($paniers['orders_name']));
                                    $test = $getNameQuantity->fetchColumn();

                                    $prixtotal = $paniers['orders_sell_price'] * $paniers['orders_quantity'];
  
                                    echo
                                    '<tr>
                                        <td style="width: 20%" >  <img style="width: 300px; height: 200px" src="'.$paniers['orders_img'].'"/></td>
                                        <td style="width: 20%" name="name"  style="text-align: center; font-size: 1.2em;">'.$paniers['orders_name'].'</td>
                                        
                                        <td name="quantity"  style="text-align: center; font-size: 1.2em;">
                                            <select  name="quantity_panier"  id="quantity_panier" onchange="location = this.value">';
                                                   

                                                    for($nb_article = 1; $nb_article < $paniers["orders_quantity"]; $nb_article++)
                                                    {
                                                        echo '<option value="command.php?nb_article='.$nb_article.'&amp;orders_id='.$paniers['orders_id'].'">'.$nb_article.'</option>';
                                                    }

                                        echo  '<option value="command.php?nb_article='.$product['orderline_id'].'&amp;orders_id='.$paniers['orders_id'].'" selected>'.$paniers['orders_quantity'].'</option>';

                                                    for($nb_article = $paniers["orders_quantity"] + 1; $nb_article < $test + 1; $nb_article++)
                                                    {
                                                        echo '<option value="command.php?nb_article='.$nb_article.'&amp;orders_id='.$paniers['orders_id'].'">'.$nb_article.'</option>';
                                                    }
                                        echo'</select>
                                        </td>';
                                        
                                        if ($_GET['orders_id'] == $paniers['orders_id'])
                                        {
                                            $oui = $_GET['nb_article'];
                                            echo '<td name="total"  style="text-align: center; font-size: 1.2em;">'.$oui.' <a href="actualise_quantity_panier.php?orders_client_id='.$paniers['orders_client_id'].'&amp;orders_id='.$paniers['orders_id'].'&amp;nb_article='.$oui.'&amp;orders_quantity='.$paniers['orders_quantity'].'&amp;order_name='.$paniers['orders_name'].'"><i class="fas fa-check"></i></a></td>';
                                        }
                                        else
                                        {
                                            echo '<td name="total"  style="text-align: center; font-size: 1.2em;"><a href="actualise_quantity_panier.php?orders_client_id='.$paniers['orders_client_id'].'&amp;orders_id='.$paniers['orders_id'].'&amp;nb_article=""><i class="fas fa-check"></i></a></td>';
                                        }

                                        echo '<td name="price"  style="text-align: center; font-size: 1.2em;">'.$paniers['orders_sell_price'].' € </td>
                                        <td name="total"  style="text-align: center; font-size: 1.2em;">'.$prixtotal.' € </td>
                                        <td name="total"  style="text-align: center; font-size: 1.2em;"><a href="actualise_panier.php?orders_client_id='.$paniers['orders_client_id'].'&amp;orders_id='.$paniers['orders_id'].'&amp;orders_quantity='.$paniers['orders_quantity'].'&amp;order_name='.$paniers['orders_name'].'"><i class="fas fa-times"></i></a></td>
                                    </tr>';

                                    $tampon = $tampon + $prixtotal;
                                }
                                
                                $totalHT = $tampon;

                                $TVA = $totalHT * 0.2;

                                $totalTTC = $totalHT + $TVA;
                                 
                                echo
                                    '<tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td name="label"  style="text-align: center; font-size: 1.2em;"><strong> Total HT </strong></td>
                                        <td name="totalHT"  style="text-align: center; font-size: 1.2em;"><strong>'.$totalHT.' € </strong></td>
                                    </tr>';
                                    echo
                                    '<tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td name="label"  style="text-align: center; font-size: 1.2em;"><strong> TVA (20%) </strong></td>
                                        <td name="TVA"  style="text-align: center; font-size: 1.2em;"><strong>'.$TVA.' € </strong></td>
                                    </tr>';
                                    echo
                                    '<tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td name="label"  style="text-align: center; font-size: 1.2em; color: blue"><strong> Total TTC </strong></td>
                                        <td name="totalTTC" style="text-align: center; font-size: 1.2em; color: blue"><strong>'.$totalTTC.' € </strong></td>
                                    </tr>';
                        }
                        else
                        {
                            echo'<h2 style="color: green; text-align:center"> Votre panier est vide pour le moment ! </h2> ';
                        }
                    ?>
                </table>

                <input type="hidden" name="TVA" value="<?=$TVA?>"></input>
                <input type="hidden" name="totalTTC" value="<?=$totalTTC?>"></input>
                <input type="hidden" name="quantity" value="<?=$paniers['orders_quantity']?>"></input>
                <input type="hidden" name="name" value="<?=$paniers['orders_name']?>"></input>


                <div style="text-align: center">
                        <input style="text-align: center" class="btn btn-primary" type="submit" name="envoi" value="Valider la commande"></input>
                </div>
                <br/>
            </fieldset>
        </form>

    </main>
    
</body>
</html>