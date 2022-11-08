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


<!-- formulaire de recherche par filtre -->

<h1>Recherche par filtre </h1>

<form method="post">

nom du livre (complet ou partiel) : <input type="text" name="name" placeholder="150 characteres MAX" value='<?php if (!empty($_POST['name'])) echo $_POST['name']?>'/><br />

Selectionnez un auteur : 
	<select name="author_id" id="author-select">
    <option value="">--Selectionner un auteur--</option>
		<?php
			$authors = $conn->query ('SELECT a.* FROM author a ORDER BY lastname ASC');
			foreach ($authors as $author)
			{
				echo '<option value="' . $author['id'] . '"';
				if (!empty($_POST['author_id']) && (int)$_POST['author_id'] === $author['id']){
					echo ' selected';
				}
				echo '>' .$author['id'] . ' - ' .$author['lastname'] . ' '. $author['firstname'] . '</option>';

				//<option value="$author['id']">Marc</option>
				//<option value="3" selected>Marc</option>
			}
		?>
		
	</select>


<br>

Selectionnez un genre:
	<select name="style_id" id="style-select">
    <option value="">--Selectionner un genre--</option>
		<?php
			$styles = $conn->query ('SELECT s.*, s.name style_name FROM style s ORDER BY style_name ASC');
			foreach ($styles as $style)
			{
				if (!empty($_POST['style_id'])){
				echo '<option value="' . $style['id'] . '"';
				if ((INT)$_POST['style_id'] === $style['id']){
					echo ' selected';
				}
				echo '>' .$style['id'] . ' - ' .$style['name'] . ' '. '</option>';
				}else{
					echo '<option value="' . $style['id'] . '">' .$style['id'] . ' - ' .$style['name'] . ' '. '</option>';
				}
			}
		?>
		
	</select>

	</br></br> <input type="submit" value="Rechercher" />
	
</form>

<!-- TABLEAU RESULTAT BDD -->

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
	
	$sql = "SELECT b.*, a.firstname, a.lastname, s.name style_name FROM book b JOIN author a ON a.id=b.author_id JOIN style s ON s.id=b.style_id";

	if(!empty($_POST)){
		$conditions = [];
		if (!empty($_POST['name'])) {
			$conditions[] = 'b.name LIKE \'%' . $_POST['name'] . '%\'';
		}

		if (!empty($_POST['author_id'])) {
			$conditions[] = 'a.id = ' . $_POST['author_id'];
		}

		if (!empty($_POST['style_id'])) {
			$conditions[] = 's.id = ' . $_POST['style_id'];
		}

		if (!empty($conditions)) {
			$sql .= ' WHERE ' . implode(' and ', $conditions);
		}
	}

	$books = $conn->query($sql);

	foreach  ($books as $book) { //POUR CHAQUE variable $book = effectuer la requete inclue dans la variable $books
		echo '<tr>';
			echo '<td>' . $book['id'] . '</td>';
			echo '<td>' . $book['name'] . '</td>'; //afficher uniquement l'alias entre les [] issu de la requete appelé par $book  
			echo '<td>' . $book['release'] . '</td>';
			echo '<td>' . $book['firstname'] . ' ' . $book['lastname'] . '</td>';
			echo '<td>' . $book['style_name'] . '</td>';
			echo '<td> <a href = "/modifyBook.php?id=' . $book['id'] . '"> <button> MODIFY </button> </a>';
			echo '<td> <a href = "/deleteBook.php?id=' . $book['id'] . '"> <button> DELETE </button> </a>';
			
		echo '</tr>';
	}
?>
</table>


</body>
</html>