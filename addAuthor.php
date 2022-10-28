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

<h1> STATUT DE LA REQUETE </h1>

<?php
	if (!empty($_POST)) {
		$errors = [];

		$author_Fname = ($_POST['firstname']);

		if (!empty($_POST['lastname'])) {
			$author_Lname = ($_POST['lastname']);
		} else {
			$errors[]= 'Le nom ou pseudo est manquant.';
		}

		if (empty($errors)) {
			$sql = 'SELECT * FROM author WHERE `lastname` = :authorLN AND `firstname` = :authorFN';
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':authorLN', $author_Lname, \PDO::PARAM_STR);
			$stmt->bindValue(':authorFN', $author_Fname, \PDO::PARAM_STR);
			$stmt->execute();
			$authors = $stmt->fetchAll();

			if (count($authors)) {
				echo "This author already exists.";
			} else {
				$sql = 'INSERT INTO author (`firstname`, `lastname`) VALUES (:authorFN, :authorLN)';

				$stmt = $conn->prepare($sql);
			
				$stmt->bindValue(':authorFN', $author_Fname, \PDO::PARAM_STR);
				$stmt->bindValue(':authorLN', $author_Lname, \PDO::PARAM_STR);
				
			
				$stmt->execute();
				echo "VOTRE AUTEUR A BIEN ETE AJOUTE";
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
<a href = /createAuthor.php> RETOUR AJOUT NOUVEL AUTEUR </a></br>
<a href = /createBook.php> RETOUR AJOUT NOUVEAU LIVRE </a>
</body>
</html>