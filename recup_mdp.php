<?php

session_start();


$pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
$pdo->exec('SET NAMES UTF8');

    $emailtest = htmlspecialchars($_POST['Email']);

    
    $email = $pdo->prepare
    (
        'SELECT * FROM  client'
    );
    $email->execute(array());
    $test = $email->fetchAll();

    foreach($test as $tests)
            {
                if($tests['client_Email'] ==  $emailtest)
                {
                    function createToken($number)
                    {
                        $liste = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
                        $shuffled = str_shuffle($liste);

                        if(strlen($shuffled)>$number)
                                    {
                                        $shuffled = substr($shuffled,0,$number);
                                        return $shuffled;
                                    }
                    }
                    $token = createToken(12);
                    $insert = $pdo->prepare
                    (
                        'INSERT INTO email (email, token) VALUES (?, ?)'
                    );
                    $insert->execute(array($emailtest, $token));

                $Contact = $emailtest;
                require 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
                require 'PHPMailer-master/PHPMailer-master/src/SMTP.php';
                //require 'PHPMailer/src/Exception.php';


                // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);

                define('MailUSER', 'yoanndestras@gmail.com'); // Utilisateur 
                define('MailPWD', 're!eyjl671s!?e'); // Mot de passe 

                try {
                    //Server settings
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                       Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->SMTPSecure = 'ssl'; 
                    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = MailUSER;                     // SMTP username
                    $mail->Password   = MailPWD;                               // SMTP password
                    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                    $mail->CharSet = 'UTF-8';
                    //Recipients
                    $mail->setFrom('yoanndestras@gmail.com');
                    $mail->addAddress($Contact);     // Add a recipient
                    //$mail->addAddress('ellen@example.com');               // Name is optional
                    $mail->addReplyTo('yoanndestras@gmail.com');
                    //$mail->addCC('cc@example.com');
                    //$mail->addBCC('bcc@example.com');

                    // Attachments
                    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    // Content
                    $mail->isHTML(true);                               // Set email format to HTML
                    $mail->Subject = 'Renouvellement de votre mot de passe!';
                    $mail->Body    = "Cliquez sur le lien suivant: http://localhost:8080/Site-ecommerce/changer_mdp.php?token=".$token.'&amp;email='.$Contact; 
                    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                }
                            
                else
                {
                   
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
                        <input type="submit" name="envoi">
                    </div>
            </fieldset>
        </form>
    </main>
</body>
</html>