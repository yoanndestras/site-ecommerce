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
      <h1 style="text-align:center">Modification d'un produit de la carte</h1>
      <form method="POST" action="valid_modify_meal.php" class="form-group" enctype="multipart/form-data">
      <fieldset>
				<legend>Caractéristiques</legend>
					<div style="margin-left: 40px">
						<div class="form-group row">
							<label for="Nom" class="col-sm-2 col-form-label">Nom :</label>
							<input type="text" name="Nom" autocomplete="off" class="col-sm-8" value ="<?=$_GET['order_name']  ?>" required>
						</div>
						<div class="form-group row">
							<label for="Description" class="col-sm-2 col-form-label" >Description :</label>
							<textarea type="text" name="Description" autocomplete="off" class="col-sm-8" required><?=$_GET['orderline_description']  ?></textarea>
						</div>
					</div>
				</fieldset>
			<fieldset>

				<legend>Approvisionnement</legend>

			</fieldset>
			<div style="margin-left: 40px">
				<div class="form-group row">
					<label for="Stock" class="col-sm-2 col-form-label">Stock initial :</label>
					<input type="text" name="Stock" autocomplete="off" value ="<?=$_GET['orderline_quantity']?>" required>
				</div>
				<div class="form-group row">
					<label for="buy_price" class="col-sm-2 col-form-label">Prix d'achat :</label>
					<input type="text" name="buy_price" autocomplete="off" value ="<?=$_GET['orderline_buy_price']?>" required><span style="font-size: 2em">€</span>
				</div>
				<div class="form-group row">
					<label for="sell_price" class="col-sm-2 col-form-label">Prix de vente :</label>
					<input type="text" name="sell_price" autocomplete="off" value ="<?=$_GET['orderline_sell_price']?>" required><span style="font-size: 2em">€</span>
				</div>
			</div>
			<div style="text-align: center">
				<input class="form-control" style="text-align: center" type="submit" name="envoi" value="Ajouter">
			</div>
		</form>	
    <main>

<body>