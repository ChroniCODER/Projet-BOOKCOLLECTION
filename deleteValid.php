<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création réussie</title>
</head>
<body>

<?php
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	
	//On établit la connexion
	$conn = new PDO("mysql:host=$servername;dbname=bookcollection", $username, $password);
	 
?>

<h1> STATUS </h1>

<?php

	if (!empty($_GET)) {
		
			$sql = 'DELETE FROM book WHERE id = :id';

			$stmt = $conn->prepare($sql);
		
			$stmt->bindValue(':id', $_GET['id'], \PDO::PARAM_INT);
		
			$stmt->execute();
			echo "VOTRE LIVRE A BIEN ETE SUPPRIME";
			}
		
	
?>
<h1> Suivre le lien ci-dessous pour revenir à l'index </h1>
<a href = /index.php> RETOUR PAGE ACCUEIL </a></br>
<a href = /createBook.php> RETOUR AJOUT NOUVEAU LIVRE </a>
</body>
</html>