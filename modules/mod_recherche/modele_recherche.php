<?php
		
class ModeleRecherche extends ModeleGenerique {
		
	function trajet() {
		$req = self::$connexion->prepare("SELECT * FROM trajet ORDER BY heureDepart");
		$req->execute();
		$resultat = $req->fetchAll();
		return $resultat; 
	}

	function lieux() {
		$req = self::$connexion->prepare("select nom_lieu, nom_ville, nom_pays from lieu ORDER BY nom_ville");
		$req->execute();
		$resultat = $req->fetchAll();
		return $resultat; 
	}

	/*	function categorie() {
			$reqCategorie = self::$connexion->prepare("SELECT * FROM categorie ORDER BY nomCategorie");
			$reqCategorie->execute();
			$resultat = $reqCategorie->fetchAll();
			return $resultat; 
		}

		function marque() {

			$reqMarque = self::$connexion->prepare("SELECT * from marque ORDER BY nomMarque");
			$reqMarque->execute();

			$resultat = $reqMarque->fetchAll();

			return $resultat;
		}

		function modele() {


			$reqModele = self::$connexion->prepare("SELECT * from modele ORDER BY nomModele");
			$reqModele->execute();

			$resultat = $reqModele->fetchAll();

			return $resultat;
		}

		function carburant() {
			$reqCategorie = self::$connexion->prepare("SELECT * FROM carburant ORDER BY typeCarburant");
			$reqCategorie->execute();
			$resultat = $reqCategorie->fetchAll();
			
			return $resultat; 
		}

		function prix(){
			$reqPrix = self::$connexion->prepare("select prix from vehicules order by prix");
			$reqPrix->execute();

			$resultat = $reqPrix->fetchAll();

			return $resultat;
		}	*/
}
?>