<?php 

	require_once("../include/modele_generique.php");
	$connexion = new ModeleGenerique();
	$connexion = $connexion->init();

	if(isset($_POST['nomCategorie']) && !empty($_POST['nomCategorie'])){
		$nomMarque = htmlspecialchars($_POST['nomMarque']);
		$nomCategorie = htmlspecialchars($_POST['nomCategorie']);

		$reqModele = $connexion->prepare("SELECT * FROM modele natural join marque natural join categorie where nomMarque=:nomMarque AND nomCategorie=:nomCategorie ORDER BY nomModele");
		$reqModele->execute(array('nomMarque' => $nomMarque, 'nomCategorie' => $nomCategorie));
		$modeles = $reqModele->fetchAll();

	
	
?>

<?php foreach ($modeles as $modele): ?>
	<div class="item" data-value="<?php echo $modele['nomModele'] ?>"><?php echo $modele['nomModele'] ?></div>
<?php endforeach; } ?>

<?php 

	if(isset($_POST['categories']) && isset($_POST['marques']) && !empty($_POST['categories']) && !empty($_POST['marques']) ){


 		$choix = array();
 		
 		foreach ($_POST as $key => $value) {
 			switch ($key) {
	 			case 'categories':

	 				 $categories = explode(',', $value);
	 				$i = 1;
	 				$c = "";
	 				foreach ($categories as $categorie ) {

		 				 if($i < count($categories)){
							$c .= "nomCategorie='$categorie' OR ";
						}
						else{
							$c .= "nomCategorie='$categorie'";
						}
						$i++;
	 				 		

	 				 }

	 				 array_push($choix, $c);

	 			break;

	 			case 'marques':

	 				$marques = explode(',', $value);
	 				$i = 1;
	 				$c = "";
	 				 foreach ($marques as $marque ) {
	 				 	if($i < count($marques)){
							$c .= "nomMarque='$marque' OR ";
						}
						else{
							$c .= "nomMarque='$marque'";
						}
						$i++;
	 				 }

	 				 array_push($choix, $c);

	 				
	 			break;
 			}
			
		}

		
		$criteres = "";
		$i = 1;
		foreach ($choix as $key => $value) {
					if($i < count($choix)){
						$criteres .= $value. " AND ";
					}
					else{
						$criteres .= $value;
					}
						$i++;
					
			
		}


		
		

		$req = 'SELECT distinct nomModele,nomMarque FROM modele NATURAL JOIN marque NATURAL JOIN categorie WHERE '.$criteres .' ORDER BY nomMarque';
		$modeles = $connexion->prepare($req);
		$modeles->execute();
		$modeles = $modeles->fetchAll();


		$marques = array();

		foreach ($modeles as $modele => $value) {

			if(!in_array($value['nomMarque'],$marques)){
				array_push($marques, $value['nomMarque']);
				echo '<div class="header">'.$value['nomMarque'].'</div><div class="item" data-value='.$value['nomModele'].'>'.$value['nomModele'].'</div>';

			}
			else {

				echo '<div class="item" data-value='.$value['nomModele'].'>'.$value['nomModele'].'</div>';

			}

		}



		
		
		
	}

 ?>

 	
	


 