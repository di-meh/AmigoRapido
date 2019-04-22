<?php


	require_once("../include/modele_generique.php");
	$connexion = new ModeleGenerique();
	$connexion = $connexion->init();


	if(isset($_POST['nomModele'])  && !empty($_POST['nomModele']) && isset($_POST['nom_transmission'])  && !empty($_POST['nom_transmission']) && isset($_POST['nomCarburant'])  && !empty($_POST['nomCarburant']) && !empty($_POST['nom_transmission']) && isset($_POST['nbPortes'])  && !empty($_POST['nbPortes'])){
		$nomModele = htmlspecialchars($_POST['nomModele']);
		$nomCarburant = htmlspecialchars($_POST['nomCarburant']);
		$nom_transmission = htmlspecialchars($_POST['nom_transmission']);
		$nbPortes = htmlspecialchars($_POST['nbPortes']);
		$annee = htmlspecialchars($_POST['annee']);
		$reqVersion = $connexion->prepare("SELECT * FROM version natural join modele natural join energie where nomModele =:nomModele and transmission=:nom_transmission and typeCarburant=:nomCarburant and nbPortes=:nbPortes and annee = :annee");
		$reqVersion->execute(array('nomModele' => $nomModele,'nom_transmission' => $nom_transmission,'nomCarburant' => $nomCarburant,'nbPortes' => $nbPortes, 'annee' => $annee));
		$versions = $reqVersion->fetchAll();

	
	
	
	
?>


<?php foreach ($versions as $version): ?>
	<div class="item" data-value="<?php echo $version['nomVersion'] ?>"><?php echo $version['nomVersion'] ?></div>
	<?php endforeach; } ?>

	


 