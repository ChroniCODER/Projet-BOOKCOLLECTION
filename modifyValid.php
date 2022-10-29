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
	if (!empty($_POST)) {
		$errors = [];

		if (!empty($_POST['name'])) {
			$book_name = ($_POST['name']);
		} else {
			$errors[]= 'Le nom est manquant.';
		}

		if (!empty($_POST['date'])) {
			$release_date = ($_POST['date']);
		} else {
			$errors[]= 'La date est manquante.';
		}

		if (!empty($_POST['author_id'])) {
			$author_name = ($_POST['author_id']);
		} else {
			$errors[]= 'L\'auteur est manquant.';
		}

		if (!empty($_POST['style_id'])) {
			$style_name = ($_POST['style_id']);
		} else {
			$errors[]= 'Le genre est manquant.';
		}
		
		if (empty($errors)) {
			$sql = 'SELECT * FROM book WHERE `name` = :name';
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':name', $book_name, \PDO::PARAM_STR);
			$stmt->execute();
			$books = $stmt->fetchAll();

			if (count($books)) {
				echo "This book already exists.";
			} else {
				$sql = 'UPDATE book SET `name` = :name, `release` = :date, author_id = :author, style_id = :style WHERE id = :id';

				$stmt = $conn->prepare($sql);
			
				$stmt->bindValue(':name', $book_name, \PDO::PARAM_STR);
				$stmt->bindValue(':date', $release_date, \PDO::PARAM_STR);
				$stmt->bindValue(':author', $author_name, \PDO::PARAM_INT);
				$stmt->bindValue(':style', $style_name, \PDO::PARAM_INT);
				$stmt->bindValue(':id', $_GET['id'], \PDO::PARAM_INT);
			
				$stmt->execute();
				echo "VOTRE LIVRE A BIEN ETE MODIFIE";
			}
		} else {
			foreach ($errors as $error) {
				echo $error . '<br/>';
			}
		}
	}
?>
<h1> Suivre le lien ci-dessous pour revenir à l'index </h1>
<a href = /index.php> RETOUR PAGE ACCUEIL </a></br>
<a href = /createBook.php> RETOUR AJOUT NOUVEAU LIVRE </a>
</body>
</html>