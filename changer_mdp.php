<?php


$pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
$pdo->exec('SET NAMES UTF8');

$token = htmlspecialchars($_GET['token']);
$email = htmlspecialchars($_GET['email']);


    
$mdpchange = $pdo->prepare
(
    'SELECT token, email FROM  email WHERE token = ? AND email = ?'
);
$mdpchange->execute(array($token, $email));
$test = $mdpchange->fetchAll();

if(isset($_POST['envoi']))
    {
        if($connection = $mdpchange->fetch())
            {
                $mdp = htmlspecialchars(md5($_POST['mdp']));

                $update = $pdo->prepare
                (
                    'UPDATE client SET client_Mot_de_passe = ? WHERE client_Email = ?'
                );
                $update->execute(array($mdp, $email));

                $delet = $pdo->prepare
                (
                    "DELETE FROM email WHERE email = ?"
                );
                $delet->execute([$email]);
            }
            else
            {
                echo 'Erreur 404';
            }


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
        <form method="POST" action="" class="form-group">

            <fieldset>
                <legend>Récupérer son compte</legend>
                    <div style="margin-left: 40px">
                    <div class="form-group row">
                        <label for="Email" class="col-sm-2 col-form-label">E-mail :</label>
                        <input type="email" name="Email" autocomplete="off" required>
                    </div>
                    <div class="form-group row">
                        <label for="mdp" class="col-sm-2 col-form-label">Nouveau Mot de Passe :</label>
                        <input type="password" name="mdp" autocomplete="off" required>
                       
                    </div>
                    <input type="submit" name="envoi">
            </fieldset>
        </form>
    </main>
</body>
</html>