<?php


	require_once("../include/modele_generique.php");
	$connexion = new ModeleGenerique();
	$connexion = $connexion->init();


	if(isset($_POST['nomCategorie'])  && !empty($_POST['nomCategorie'])){
		$nomCategorie = htmlspecialchars($_POST['nomCategorie']);
		$reqMarque = $connexion->prepare("select distinct nomMarque from modele natural join marque natural join categorie where nomCategorie=:nomCategorie");
		$reqMarque->execute(array('nomCategorie' => $nomCategorie));
		$marques = $reqMarque->fetchAll();

	

	
?>


<?php foreach ($marques as $marque): ?>

	<div class="item" data-value="<?php echo $marque['nomMarque'] ?>"><?php echo $marque['nomMarque'] ?></div>
<?php endforeach ; }?>

<?php 
 	if(isset($_POST['categories']) && !empty($_POST['categories'])){
 		$categories = htmlspecialchars($_POST['categories']);
 		$tabCategorie = explode(',', $categories);
 		$choix = array();
 		foreach ($tabCategorie as $categorie) {
			array_push($choix, "nomCategorie='$categorie'");
		}

		$criteres = "";
		$i = 1;
		foreach ($choix as $key) {
			if($i < count($choix)){
				$criteres .= $key. " OR ";
			}
			else{
				$criteres .= $key;
			}
			$i++;
		}
		
		$req = 'SELECT distinct nomMarque FROM modele NATURAL JOIN marque NATURAL JOIN categorie WHERE '.$criteres .'';
		$marques = $connexion->query($req);


 ?>

 		<?php foreach ($marques as $marque): ?>

			<div class="item" data-value="<?php echo $marque['nomMarque'] ?>"><?php echo $marque['nomMarque'] ?></div>
		<?php endforeach ; }?>




						

	


 