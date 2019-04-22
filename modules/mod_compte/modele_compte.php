<?php

	class ModeleCompte extends ModeleGenerique {

		//Récupère la liste des véhicules du mec + la première image de son annonce
		function recupereVehicule($id) {
			$req = self::$connexion->prepare("SELECT * FROM vehicules LEFT JOIN image ON vehicules.idVehicules = image.idVehicules WHERE idUser = :id AND principale = 0");
			$req->execute(array('id' => $id));
			$voitures = $req->fetchAll();
			return $voitures;
		}

		function supprimer($id) {
			$this->supprimerAnnonces($id);
			$req = self::$connexion->prepare("DELETE FROM user WHERE idUser = :id;");
			$req->execute(array('id' => $id));
		}

		function supprimerAnnonces($id) {
			$req = self::$connexion->prepare("DELETE FROM vehicules WHERE idUser = :id;");
			$req->execute(array('id' => $id));
		}

		function supprimerAnnonce($id) {
			$this->supprimerImages($id);
			$req = self::$connexion->prepare("DELETE FROM vehicules WHERE idVehicules = :id;");
			$req->execute(array('id' => $id));
		}

		function supprimerImages($id) {
			$req = self::$connexion->prepare("DELETE FROM image WHERE idVehicules = :id;");
			$req->execute(array('id' => $id));
		}
	}


?>
