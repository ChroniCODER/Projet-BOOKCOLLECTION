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

<h1> VOTRE LIVRE A BIEN ETE AJOUTE </h1>
<?php

	$book_name = trim($_POST['name']);
	$release_date = trim($_POST['date']);
	$author_name = trim($_POST['author_id']);
	$style_name = trim($_POST['style_id']);
	
$sql = 'INSERT INTO book (`name`, `release`, `author_id`, `style_id`) VALUES (:name, :date, :author, :style)';

$stmt = $conn->prepare($sql);

$stmt->bindValue(':name', $book_name, \PDO::PARAM_STR);
$stmt->bindValue(':date', $release_date, \PDO::PARAM_STR);
$stmt->bindValue(':author', $author_name, \PDO::PARAM_STR);
$stmt->bindValue(':style', $style_name, \PDO::PARAM_STR);

	
		if (!empty($_POST) ) {
			$stmt->execute();
		}
		
?>
<h1> Suivre le lien ci-dessous pour revenir à l'index </h1> 
<a href = /index.php> RETOUR PAGE ACCUEIL </a>
</body>
</html>