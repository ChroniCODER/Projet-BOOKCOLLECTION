<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Modifier un livre</title>
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

<?php
	$target_id = $_GET['id'];
	$target_book = $conn->query ('SELECT b.*, a.firstname, a.lastname, b.release, s.name style_name FROM book b JOIN author a 
								  ON a.id=b.author_id JOIN style s ON s.id=b.style_id WHERE b.id = ' . $_GET['id']);
	$book = $target_book->fetch();
		
?>

</br>

<?php

?>
<h1> Suivre le lien ci-dessous pour revenir à l'index </h1> 
<a href = /index.php> RETOUR PAGE ACCUEIL </a>


<h1>ETES VOUS SURE DE VOULOIR EFFACER DEFINITIVEMENT LE LIVRE CI-DESSOUS ?</h1>

<table>
	<tr>
		<th>ID</th>
		<th>Nom</th>
		<th>Date de publication</th>
		<th>Auteur</th>
		<th>Genre</th>
	</tr>

	<?php
		echo '<tr>';
			echo '<td>' . $book['id'] . ' ' . '</td>';
			echo '<td>' . $book['name'] . ' ' .  '</td>'; //afficher uniquement la valeur du tableau entre les [] issu de la requete appelé par $book  
			echo '<td>' . $book['release'] . ' ' .  '</td>';
			echo '<td>' . $book['firstname'] . ' ' . $book['lastname'] . ' ' .  '</td>';
			echo '<td>' . $book['style_name'] . '</td>';
		echo '</tr>';
	?>

</table>
</br>

<a href = "/deleteValid.php?id=<?= $_GET['id'] ?>"> <button> CONFIRMER </button> </a></br>
<a href = "/index.php"> <button> ANNULER </button> </a>

</body>

</html>
