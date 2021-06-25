<?php
session_start();

if(isset($_SESSION['client_Id_Client']))
        {
			$message = "Veuillez vous déconnecter pour vous connecter sur un autre compte";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='index.php'</script>";
        }
		
else if(isset($_SESSION['client_admin']))
        {
            $message = "Veuillez vous déconnecter pour vous connecter sur un autre compte";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='index.php'</script>";
        }
?>

<!DOCTYPE html>

<html lang="fr">
<head>
 	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  	<title>Connexion</title>

<!-- CSS -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
	<header>
		<?php
			include('navbar.html');
		?>
	</header>
  	<main>
        <form method="POST" action="valid_connect_account.php" class="form-group">

            <fieldset>
                <legend>Connexion</legend>
                    <div style="margin-left: 40px">
                    <div class="form-group row">
                        <label for="Email" class="col-sm-2 col-form-label">E-mail :</label>
                        <input type="email" name="Email" autocomplete="off" required>
                    </div>
                    <div class="form-group row">
                        <label for="Mdp" class="col-sm-2 col-form-label">Mot de passe :</label>
                        <input type="password" name="Mdp" autocomplete="off" required>
                    </div>
                    </div>
                    <div style="text-align: center">
                        <input style="text-align: center" type="submit" name="envoi">
                    </div>
            </fieldset>
        </form>
    </main>
</body>
</html>