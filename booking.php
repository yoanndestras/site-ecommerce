<?php
    session_start();

    if(!isset($_SESSION['client_Id_Client']))
        {
            if(!isset($_SESSION['client_admin']))
            {
                $message = "Veuillez vous connecter pour réserver une table";
			    echo "<script type='text/javascript'>alert('$message'); window.location.href='connect_account.php'</script>";
            }
        }
    else if(!isset($_SESSION['client_admin']))
        {
            if(!isset($_SESSION['client_Id_Client']))
            {
                $message = "Veuillez vous connecter pour réserver une table";
			    echo "<script type='text/javascript'>alert('$message'); window.location.href='connect_account.php'</script>";
            }
        }
    
?>

<!DOCTYPE html>

<html lang="fr">
<head>
 	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  	<title>Réserver une table</title>

<!-- CSS -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
      <h1 style="margin: 40px">Réservation d'une table </h1>
        <legend>Informations <span style="font-size: 0.5em; color: red">Réservations possible de 11 heures à 22 heures tous les jours</span></legend>
        <form method="POST" action="valid_booking_account.php" class="form-group">

        <div style="margin-left: 40px">

            <div  class="form-group row">
                <label for="select" style="font-size: 1.2em" class="col-sm-2 col-form-label" >Date de réservation :</label>
        
						<div name="select" class="form-group row">
								<select id="day" name="day">
									<?php for($day = 1; $day <= 31; $day++): ?>
										<option value="<?= $day ?>"><?= $day ?></option>
									<?php endfor ?>
								</select>
								<span style="font-size:1.7em ; margin:5px" > / </span>
								<select name="month">
									<option value="1">Janvier</option>
									<option value="2">Février</option>
									<option value="3">Mars</option>
									<option value="4">Avril</option>
									<option value="5">Mai</option>
									<option value="6">Juin</option>
									<option value="7">Juillet</option>
									<option value="8">Août</option>
									<option value="9">Septembre</option>
									<option value="10">Octobre</option>
									<option value="11">Novembre</option>
									<option value="12">Décembre</option>
								</select>
								<span style="font-size:1.7em; margin:5px" > / </span>
								<select name="year">
									<?php for($year = date('Y') ; $year < date('Y') + 5; $year++): ?>
										<option value="<?= $year ?>"><?= $year ?></option>
									<?php endfor ?>
								</select>
                                <span style="font-size:1.4em; margin:10px" > à </span>
                                
                                <input type="time" id="minutes" name="minutes"min="11:00" max="22:00" required>

						</div>
            </div>
                        <div  class="form-group row">
                            <label for="couverts" style="font-size: 1.2em" class="col-sm-2 col-form-label" >Nombre de couverts :</label>
                                <div name="nb_couverts" class="form-group row">
                                        <select id="nb_couverts" name="nb_couverts">
                                            <?php for($nb_couverts = 1; $nb_couverts <= 12; $nb_couverts++): ?>
                                                <option value="<?= $nb_couverts ?>"><?= $nb_couverts ?></option>
                                            <?php endfor ?>
                                        </select>
                                        <span style="font-size:1.7em ; margin:5px; color: white" > / </span>

                                </div>
                        </div>
        </div>
        
            <div style="text-align: center">
				<input style="text-align: center" type="submit" class="btn btn-outline-primary" name="envoi">
			</div>
		</form>


        <?php 

        if(isset($_SESSION['client_admin']))
            {
                $pdo = new PDO('mysql:host=localhost;dbname=ecommerce;port=3306', 'root', 'root');
                $pdo->exec('SET NAMES UTF8');
                
                $booking = $pdo->prepare
                (
                    'SELECT * FROM  booking'
                );
                $booking->execute();
                $test = $booking->fetchAll();

                ?>
                <h1 style="margin: 40px">Panneau d'administration </h1>
                    <table class="table table-bordred table-striped" >

                        <tr class="table-success" style="text-align: center" >
                            <th>Heure de réservation</th>
                            <th>Nombre de couverts</th>
                        </tr>
                        
                        <?php
                            foreach($test as $tests)
                            {
                                echo
                                '<tr  style="text-align: center; font-size: 1.2em;">
                                    <td style="width: 50%" >'.$tests['booking_date'].'</td>
                                    <td style="width: 50%" >'.$tests['booking_couverts'].'</td>
                                </tr>';       
                            }
                        ?>

                    </table>
        <?php
            }
        ?>

      </main>
</body>
</html>
