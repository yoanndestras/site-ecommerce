<?php

session_start();

if(!isset($_SESSION['client_admin']))
        {
            header('Location: index.php');            
        }

$pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
$pdo->exec('SET NAMES UTF8');

	$getProducts = $pdo->prepare
    (
        "SELECT * FROM orderline"
    );

    $getProducts->execute();
    $listeProducts = $getProducts->fetchAll();	
?>

<!DOCTYPE html>

<html lang="fr">
<head>
 	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  	<title>Ajout produit</title>

<!-- CSS -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/ef488c0f83.js" crossorigin="anonymous"></script>
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
		  <h1 style="text-align:center">Ajout d'un produit alimentaire à la carte</h1>
      <form method="POST" action="valid_create_meal.php" enctype="multipart/form-data" class="form-group">

			<fieldset>
				<legend>Caractéristiques</legend>
					<div style="margin-left: 40px">
						<div class="form-group row">
							<label for="Nom" class="col-sm-2 col-form-label">Nom :</label>
							<input type="text" name="Nom" autocomplete="off" class="col-sm-8" required>
						</div>
						<div class="form-group row">
							<label for="Description" class="col-sm-2 col-form-label">Description :</label>
							<textarea type="text" name="Description" autocomplete="off" class="col-sm-8" required></textarea>
						</div>
						<div class="form-group row">
							<label for="image" class="col-sm-2 col-form-label">Photo  :</label>
							<!-- input type="file" qui va permettre d'uploader une image -->
							<input type="file" name="image" id="image" /><br />
						</div>
						<div class="form-group row">
							<p class="col-sm-10" style="font-size: 1.2em" >Merci de renommer le fichier de la photo avec le nom de l'aliment <strong>avant</strong> de l'envoyer</p>
						</div>
					</div>
				</fieldset>
			<fieldset>

				<legend>Approvisionnement</legend>

			</fieldset>
			<div style="margin-left: 40px">
				<div class="form-group row">
					<label for="Stock" class="col-sm-2 col-form-label">Stock initial :</label>
					<input type="text" name="Stock" autocomplete="off" required>
				</div>
				<div class="form-group row">
					<label for="buy_price" class="col-sm-2 col-form-label">Prix d'achat :</label>
					<input type="text" name="buy_price" autocomplete="off" required><span style="font-size: 2em">€</span>
				</div>
				<div class="form-group row">
					<label for="sell_price" class="col-sm-2 col-form-label">Prix de vente :</label>
					<input type="text" name="sell_price" autocomplete="off" required><span style="font-size: 2em">€</span>
				</div>
			</div>
			<div style="text-align: center">
				<input class="form-control" style="text-align: center" type="submit" name="envoi" value="Ajouter">
			</div>
		</form>

		<section id="accueil">
		<h2 style="text-align:center; margin:40px">Carte du restaurant</h2>

		<article>
			<?php	
                echo'<table class="table table-bordred table-striped"  >';
				foreach($listeProducts as $product)
					{

						echo 
                        '<tr>
                            <td  style="width: 16.66%" style="text-align: left;"> <img style="width: 300px; height: 200px" src="'.$product['orderline_img'].'" /></td>
                            <td  style="width: 75%" style="text-align: left; font-size: 1.2em;">'.$product['order_name'].'<br/><br/>'.$product['orderline_description'].'</td>
                            <td  class="align-middle" style="width:  8.33%" style="text-align: center; font-size: 1.2em;">'.$product['orderline_sell_price'].'€</td>
                            <td  class="align-middle" style="width:  8.33%" style="text-align: center; font-size: 1.2em;"><a href="modify_meal.php?order_name='.$product['order_name'].'&amp;orderline_description='.$product['orderline_description'].'&amp;orderline_sell_price='.$product['orderline_sell_price'].'&amp;orderline_buy_price='.$product['orderline_buy_price'].'&amp;orderline_quantity='.$product['orderline_quantity'].'" style="font-size: 2em"><i class="far fa-edit"></i></a></td>
                        </tr>';
                    }                                            

                echo'</table>';
			?>
		</article>
	<section>
    </main>
</body>
</html>