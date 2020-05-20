<?php 


	class ModeleAccueil extends ModeleGenerique {

		function recupereAnnonces() {
			/*$reqMarque = self::$connexion->prepare('SELECT * FROM vehicules  NATURAL join version  NATURAL JOIN modele NATURAL JOIN carburant NATURAL JOIN marque NATURAL JOIN categorie NATURAL JOIN image NATURAL JOIN user where principale = 0');
				$reqMarque->execute();
				$resultat = $reqMarque->fetchAll();
				return $resultat;*/
		}
	}
?>