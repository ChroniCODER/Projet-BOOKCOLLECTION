<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
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


<h1>Remplissez les champs ci-dessous pour ajouter un livre à la DATABASE</h1>

<!-- champs name -->
<h2> Ajouter un nom </h2>

<form method="post" action="addValid.php">

		name : <input type="text" name="name" placeholder="150 characteres MAX" /><br />
		
	

<!-- champs release -->
<h2> Ajouter une date de sortie </h2>

	
		date : <input type="date" name="date" placeholder="Entrez la date"/><br />
		

<!-- TABLE AUTHOR -->
<h2> Ajouter un auteur </h2>

	
		Selectionnez un auteur: 
	<select name="author_id" id="author-select">
    <option value="">--Selectionner un auteur--</option>
		<?php
			$authors = $conn->query ('SELECT a.* FROM author a ORDER BY lastname ASC');
			foreach ($authors as $author)
			{
				echo '<option value="' . $author['id'] . '">' .$author['id'] . ' - ' .$author['lastname'] . ' '. $author['firstname'] . '</option>';
			}
		?>
		
	</select>
	
	
<!-- TABLE STYLE-->
<h2> Ajouter un genre littéraire</h2>


		Selectionnez un genre:
	<select name="style_id" id="style-select">
    <option value="">--Selectionner un genre--</option>
		<?php
			$styles = $conn->query ('SELECT s.*, s.name style_name FROM style s ORDER BY style_name ASC');
			foreach ($styles as $style)
			{
				echo '<option value="' . $style['id'] . '">' .$style['id'] . ' - ' .$style['name'] . ' '. '</option>';
			}
		?>
		
	</select>
	
	</br></br> <input type="submit" value="Enregistrer" />
	
</form>

</body>
</html>
