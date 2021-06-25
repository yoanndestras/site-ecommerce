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

    $pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
    $pdo->exec('SET NAMES UTF8');

    if(isset($_POST['envoi']))
    {
        $email = htmlspecialchars($_POST['Email']);
		$mdp = htmlspecialchars(md5($_POST['Mdp']));

        $recupUser = $pdo->prepare
		(
			'SELECT * FROM  client WHERE client_Email = ? AND client_Mot_de_passe = ?'
		);
        
		$recupUser->execute(array($email, $mdp));
        
        if($connection = $recupUser->fetch())
        {
            if($connection['client_admin'] == "1")
            {
                $_SESSION['Email'] = $email;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['client_admin'] = $connection['client_admin'];
                $_SESSION['client_Id_Client_admin'] = $connection['client_Id_Client'];
            }
            else
            {
                $_SESSION['Email'] = $email;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['client_Id_Client'] = $connection['client_Id_Client'];
            }

            header('Location: index.php');
        }
        else
        {
            include('connect_account.php');
            echo "Vos identifiants sont incorrects...";
        }
        
    }

