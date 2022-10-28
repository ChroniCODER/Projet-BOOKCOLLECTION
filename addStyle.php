<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statut de la demande</title>
</head>
<body>

<?php
	
	$servername = 'localhost';
	$username = 'root';
	$password = '';
		
	//On établit la connexion
	$conn = new PDO("mysql:host=$servername;dbname=bookcollection", $username, $password);
	 
?>

<h1> STATUT DE LA REQUETE </h1>

<?php
	if (!empty($_POST)) {
		$errors = [];

		if (!empty($_POST['name'])) {
			$style_name = ($_POST['name']);
		} else {
			$errors[]= 'Le nom du genre est manquant.';
		}

		if (empty($errors)) {
			$sql = 'SELECT * FROM style WHERE `name` = :name';
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':name', $style_name, \PDO::PARAM_STR);
			$stmt->execute();
			$styles = $stmt->fetchAll();

			if (count($styles)) {
				echo "This style already exists.";
			} else {
				$sql = 'INSERT INTO style (`name`) VALUES (:name)';

				$stmt = $conn->prepare($sql);
			
				$stmt->bindValue(':name', $style_name, \PDO::PARAM_STR);
							
			
				$stmt->execute();
				echo "VOTRE GENRE LITTERAIRE A BIEN ETE AJOUTE";
			}
		} else {
			foreach ($errors as $error) {
				echo $error . '<br/>';
			}
		}
	}
?>
<h1> Suivre le lien ci-dessous pour revenir à l'index </h1> 
<a href = /index.php> RETOUR ACCUEIL </a></br>
<a href = /createStyle.php> RETOUR AJOUT NOUVEAU GENRE </a></br>
<a href = /createBook.php> RETOUR AJOUT NOUVEAU LIVRE </a>
</body>
</html>