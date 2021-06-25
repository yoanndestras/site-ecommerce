<?php

    session_start();

    if(!isset($_SESSION['client_admin']))
        {
            header('Location: index.php');
        }

    

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
    $pdo->exec('SET NAMES UTF8');

    $searchbar = $pdo->prepare
    (
        'SELECT * FROM client WHERE client_admin NOT IN (1) ORDER BY client_Id_Client DESC'
    );
    $searchbar->execute();

    if(isset($_GET['s']))
    {
        $recherche = htmlspecialchars($_GET['s']);

        $searchbar = $pdo->prepare
        (
            'SELECT * FROM client WHERE client_Email  LIKE "%'.$recherche.'%" AND client_admin NOT IN (1)  ORDER BY client_Id_Client DESC '
        );
		$searchbar->execute();

    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<!DOCTYPE html>

<html lang="fr">
<head>
 	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  	<title>Création d'un admin</title>

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
    
        <form method="GET">
            <div style="margin: 40px;" class="form-group">
                <label class="col-sm-2 col-form-label" for="s">Rechercher un membre :</label>
                <input type="search" class="col-sm-8" name="s" placeholder=" Entrer son email" autocomplete="off" required>
                
            </div>
            <input type="submit" class="form-control" name="envoyer" value="Rechercher"> </input>
        </form>
   
        

        <table class="table table-bordred table-striped" >

        <h3 style="text-align:center; margin:20px" >Création d'un administrateur</h3>

        <h4 style="text-align:center; margin:20px; color: blue" >Member List</h4>

            <tr style="text-align: center" >
                <th>Prénom</th>
                <th>Nom</th>
                <th>Mail</th>
                <th>Upgrade to Admin</th>
                <th>Delete</th>
            </tr>

        <?php

            if($searchbar->rowCount() > 0)
            {
                while($client = $searchbar->fetch())
                {
                    echo 
                    '<tr>
                    <td  style="text-align: center; font-size: 1.2em;">'.$client['client_Prenom'].'</td>
                    <td  style="text-align: center; font-size: 1.2em;">'.$client['client_Nom'].'</td>
                    <td  style="text-align: center; font-size: 1.2em;">'.$client['client_Email'].'</td>
                    <td  style="text-align: center; font-size: 1.5em;" ><a href= update_membre.php?client_Id_Client='.$client['client_Id_Client'].'><i class="fas fa-user-shield"></i></a></td>
                    <td  style="text-align: center; font-size: 1.5em;" ><a href= delet_membre.php?client_Id_Client='.$client['client_Id_Client'].'><i class="fas fa-times"></i></a></td>
                    </tr>';
                }
            }
        ?>  
        </table>
    </main>
</body>
</html>