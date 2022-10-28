<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ajouter un nouvel auteur</title>
</head>

<!-- PDO -->

<?php

	$servername = 'localhost';
	$username = 'root';
	$password = '';
	
	//On établit la connexion
	$conn = new PDO("mysql:host=$servername;dbname=bookcollection", $username, $password);
	 
?>

<body>

<h1> Suivre le lien ci-dessous pour revenir à l'index </h1> 
<a href = /index.php> RETOUR PAGE ACCUEIL </a>


<h1>Remplissez les champs ci-dessous pour ajouter un auteur absent de la DATABASE</h1>

<!-- champs name -->
<h2> Ajouter un nouvel auteur </h2>

<form method="post" action="addAuthor.php">

		Prénom (Facultatif) : <input type="text" name="firstname" placeholder="80 characteres MAX" /><br />
		Nom ou Pseudo : <input type="text" name="lastname" placeholder="80 characteres MAX" /><br />
	


	
	</br></br> <input type="submit" value="Ajouter" />
	
</form>

</body>
</html>
