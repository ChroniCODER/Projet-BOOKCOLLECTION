<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gestion Book Collection</title>
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

<h1> Suivre le lien ci-dessous pour ajouter un nouveau livre </h1> 
<a href = /createBook.php> AJOUTEZ UN LIVRE </a>



	
<h1> AFFICHAGE BASE DE DONNEES </h1>

<table>
 
	<tr>
		<th>ID</th>
		<th>Nom</th>
		<th>Date de publication</th>
		<th>Auteur</th>
		<th>Genre</th>
	</tr>

	<?php //Affichages des lignes du tableau
	$books = $conn->query ('SELECT b.*, a.firstname, a.lastname, s.name style_name
							FROM book b JOIN author a ON a.id=b.author_id JOIN style s ON s.id=b.style_id'); //$books = le resultat d'une requete faite dans la variable $conn qui est le contenue globale de ma base de donnée connecté via PDO
		foreach  ($books as $book) { //POUR CHAQUE variable $book = effectuer la requete inclue dans la variable $books
			echo '<tr>';
				echo '<td>' . $book['id'] . '</td>';
				echo '<td>' . $book['name'] . '</td>'; //afficher uniquement l'alias entre les [] issu de la requete appelé par $book  
				echo '<td>' . $book['release'] . '</td>';
				echo '<td>' . $book['firstname'] . ' ' . $book['lastname'] . '</td>';
				echo '<td>' . $book['style_name'] . '</td>';
				echo '<td> <a href = "/modifyBook.php?id=' . $book['id'] . '"> <button> MODIFY </button> </a>';
				echo '<td>  <button>  DELETE  </button>';
				
			echo '</tr>';
		}
	?>
</table>
   
<?php
		if (!empty($_POST)) {
			echo $_POST['styles'];
		}
		
		
	?>
</body>
</html>