<?php

session_start();

if(isset($_SESSION['client_Id_Client']))
        {
			$message = "Veuillez vous déconnecter pour créer un compte";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='index.php'</script>";
        }
		
else if(isset($_SESSION['client_admin']))
        {
            $message = "Veuillez vous déconnecter pour créer un compte";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='index.php'</script>";
        }

	$pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
    $pdo->exec('SET NAMES UTF8');


	if(isset($_POST['envoi']))
	{
		
		$nom = htmlspecialchars($_POST['Nom']);
		$prenom = htmlspecialchars($_POST['Prenom']);
		$date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
		$adresse = htmlspecialchars($_POST['Adresse']);
		$ville = htmlspecialchars($_POST['Ville']);
		$code_postal = htmlspecialchars($_POST['Code_Postal']);
		$pays = htmlspecialchars($_POST['Pays']);
		$telephone = htmlspecialchars($_POST['Telephone']);

		$email = htmlspecialchars($_POST['Email']);
		$mdp = htmlspecialchars(md5($_POST['Mdp']));

		$insertUser = $pdo->prepare
		(
			'INSERT INTO  client (client_Nom, client_Prenom, client_Date, client_Adresse, client_Ville, client_Code_Postal, client_Pays, client_Telephone, client_Email, client_Mot_de_passe) 
			values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
		);
		$insertUser->execute(array($nom, $prenom, $date, $adresse, $ville, $code_postal, $pays, $telephone, $email, $mdp));
	
		$recupUser = $pdo->prepare
		(
			'SELECT * FROM client WHERE client_Email = ? AND client_Mot_de_passe = ?'
		);
		$recupUser->execute(array($email, $mdp ));
		
		if($recupUser -> rowCount() > 0)
        {
			header('Location: index.php');
		}
		else
		{
			include('create_account.php');
            echo "Une erreur s'est produite lors de la création de votre compte veuillez contacter un administrateur du site";
		}
		
	
	}

?>

