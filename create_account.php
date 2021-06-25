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

?>
<!DOCTYPE html>

<html lang="fr">
<head>
 	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  	<title>Inscription</title>

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
		<form method="POST" action="valid_create_account.php" class="form-group">
			<fieldset>
				<legend>Identité et coordonnées</legend>
					<div style="margin-left: 40px">
						<div class="form-group row">
							<label for="Nom" class="col-sm-2 col-form-label">Nom :</label>
							<input type="text" name="Nom" autocomplete="off" class="col-sm-8" required>
						</div>
						<div class="form-group row">
							<label for="Prenom" class="col-sm-2 col-form-label">Prénom :</label>
							<input type="text" name="Prenom" autocomplete="off" class="col-sm-8" required>
						</div>
						<div class="form-group row">
								<label for="day" class="col-sm-2 col-form-label" >Date de naissance :</label>
								<select id="day" name="day">
									<?php for($day = 1; $day <= 31; $day++): ?>
										<option value="<?= $day ?>"><?= $day ?></option>
									<?php endfor ?>
								</select>
								<span style="font-size:1.5em ; margin:5px" > / </span>
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
								<span style="font-size:1.5em; margin:5px" > / </span>
								<select name="year">
									<?php for($year = date('Y') - 90 ; $year < date('Y') - 16; $year++): ?>
										<option value="<?= $year ?>"><?= $year ?></option>
									<?php endfor ?>
								</select>
							</div>
						<div class="form-group row">
							<label for="Adresse" class="col-sm-2 col-form-label">Adresse :</label>
							<textarea type="text" name="Adresse" autocomplete="off" class="col-sm-8" required></textarea>
						</div>
						<div class="form-group row">
							<label for="Ville" class="col-sm-2 col-form-label">Ville :</label>
							<input type="text" name="Ville" autocomplete="off" class="col-sm-8" required>
						</div>
						<div class="form-group row">
							<label for="Code_Postal" class="col-sm-2 col-form-label">Code Postal :</label>
							<input type="text" name="Code_Postal" autocomplete="off" class="col-sm-8" required>
						</div>
						<div class="form-group row">
							<label for="Pays" class="col-sm-2 col-form-label">Pays :</label>
							<input type="text" name="Pays" autocomplete="off" class="col-sm-8" required>
						</div>
						<div class="form-group row">
							<label for="Telephone" class="col-sm-2 col-form-label">Téléphone :</label>
							<input type="text" name="Telephone" autocomplete="off" class="col-sm-8" required>
						</div>
					</div>
				</fieldset>
			<fieldset>

				<legend>Informations d'authentification</legend>

			</fieldset>
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
		</form>
		
  	</main>
</body>
</html>