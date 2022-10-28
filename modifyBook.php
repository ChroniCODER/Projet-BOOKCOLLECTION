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


<h1>Remplissez les champs ci-dessous pour modifier un livre existant</h1>

<!-- champs name -->
<h2>Modifier le nom </h2>

<form method="post" action="modifyValid.php?id=<?= $_GET['id'] ?>">

		name : <input type="text" name="name" value= "<?php echo $book['name'] ?>" /><br />
		
	

<!-- champs release -->
<h2>Modifier la date de sortie </h2>

	
		date : <input type="date" name="date" value= "<?php echo $book['release'] ?>" /><br />
		

<!-- TABLE AUTHOR -->
<h2> Modifier un auteur </h2>

	
		Selectionnez un auteur: 
	<select name="author_id" id="author-select">
    <option value="">--Selectionner un auteur--</option>
		<?php
			$authors = $conn->query ('SELECT a.* FROM author a ORDER BY lastname ASC');
			foreach ($authors as $author)
			{
				echo '<option value="' . $author['id'] . '"';
				
				if ($author['id'] === $book['author_id']) echo ' selected';

				echo '>' .$author['id'] . ' - ' .$author['lastname'] . ' '. $author['firstname'] . '</option>';

				//<option value="$author['id']">Marc</option>
				//<option value="3" selected>Marc</option>
			}
		?>
		
	</select>
<p>OU <a href = /createAuthor.php alt = "ajouter un nouvel auteur">ajouter un nouvel auteur</a>	</p>
	
<!-- TABLE STYLE-->
<h2>Modifier un genre littéraire</h2>


		Selectionnez un genre:
	<select name="style_id" id="style-select">
    <option value="">--Selectionner un genre--</option>
		<?php
			$styles = $conn->query ('SELECT s.*, s.name style_name FROM style s ORDER BY style_name ASC');
			foreach ($styles as $style)
			{
				echo '<option value="' . $style['id'] . '"';

				if ($style['id'] === $book['style_id']) echo ' selected';

				echo '>' .$style['id'] . ' - ' .$style['name'] . ' '. '</option>';
			}
		?>
		
	</select>
	<p>OU <a href = /createStyle.php alt = "ajouter un nouveau genre">ajouter un nouveau genre</a>	</p>
	</br></br> <input type="submit" value="Enregistrer" />
	
</form>

</body>
</html>
