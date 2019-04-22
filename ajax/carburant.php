<?php


	require_once("../include/modele_generique.php");
	$connexion = new ModeleGenerique();
	$connexion = $connexion->init();


	if(isset($_POST['nomModele'])  && !empty($_POST['nomModele'])){
		$nom_modele = htmlspecialchars($_POST['nomModele']);
		$reqEnergies = $connexion->prepare("SELECT DISTINCT typeCarburant FROM version natural join modele natural join carburant where nomModele =:nomModele");
		$reqCarburants->execute(array('nomModele' => $nomModele));
		$carburants = $reqCarburants->fetchAll();
		if(!$carburants){
			$erreur = 1;
		}
	
	
	
	if(isset($erreur)){
		$reqCarburants = $connexion->prepare("SELECT * FROM carburant");
		$reqCarburants->execute();
		$carburants = $reqCarburants->fetchAll();
	}

	
	
?>


<?php foreach ($carburants as $carburant): ?>
	<div class="item" data-value="<?php echo $carburant['typeCarburant] ?>"><?php echo $carburant['typeCarburant'] ?></div>
	<?php endforeach ; }?>
