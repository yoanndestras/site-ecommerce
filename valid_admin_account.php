<?php

session_start();

if(!isset($_SESSION['client_admin']))
        {
            header('Location: index.php');
        }
	$pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
    $pdo->exec('SET NAMES UTF8');


	if(isset($_POST['envoi']))
	{
		$email = htmlspecialchars($_POST['Email']);
		$mdp = htmlspecialchars(md5($_POST['Mdp']));

		$insertadmin = $pdo->prepare
		(
			'INSERT INTO  client (client_Email, client_Mot_de_passe, client_admin) 
			VALUES (?, ?, ?)'
		);
		$insertadmin->execute(array($email, $mdp, 1));
	
		
		if($connection = $insertadmin->fetch())
        {
			//header('Location: admin_account.php');
            echo "Le compte a été créé avec succés";
		}
		else
		{
			//header('Location: admin_account.php');
			echo "Une erreur s'est produite lors de la création du compte veuillez contacter un administrateur du site";
		}
		
	
	}
?>