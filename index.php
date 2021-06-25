<?php

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

  	<title>Carte du restaurant</title>

<!-- CSS -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
	<header>
		<?php
            session_start();

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
      <h1 style="margin: 40px">Carte du restaurant </h1>
	
	<section id="accueil">
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
                        </tr>';
                    }
                echo'</table>';
			?>
		</article>
	<section>
    </main>
</body>
</html>