<?php

class ModeleVehicule extends ModeleGenerique {


	function exemple_req_bd() {
		$req = self::$connexion->prepare( "REQ BD" );
		$req->execute();
		return $req->fetchAll();
	}
	
	function update_voiture($utilisateur, $voiture, $couleur, $immatriculation, $permisConduire, $carteGrise) {
		$req = self::$connexion->prepare( "DELETE FROM `voiture_utilisateur` WHERE `id_utilisateur` = $utilisateur" );
		$req->execute();
		$req = self::$connexion->prepare( "INSERT INTO `voiture_utilisateur` (`id`, `id_utilisateur`, `id_voiture`, `immatriculation`, `couleur_voiture`, `photo_voiture`, `permis_image`, `carte_grise_image`) VALUES (NULL, '$utilisateur', '$voiture', '$immatriculation', '$couleur', '', '$permisConduire', '$carteGrise');" );
		$req->execute();
	}
	
	function recup_liste_vehicule() {
		$req = self::$connexion->prepare( "SELECT * FROM `voiture` ORDER BY `voiture`.`modele_voiture` ASC" );
		$req->execute();
		return $req->fetchAll();
	}
	
	function recup_info_vehicule($idUser) {
		$req = self::$connexion->prepare( "SELECT * FROM `voiture_utilisateur` WHERE `id_utilisateur` = $idUser" );
		$req->execute();
		return $req->fetchAll();
	}
	
	function recup_vehicule($idVoiture) {
		$req = self::$connexion->prepare( "SELECT * FROM `voiture` WHERE `id_voiture` = $idVoiture" );
		$req->execute();
		return $req->fetchAll();
	}
	
	function supprimer_vehicule() {
		$user = $_SESSION["id_utilisateur"];
		$req = self::$connexion->prepare( "DELETE FROM `voiture_utilisateur` WHERE `id_utilisateur` = $user" );
		$req->execute();
	}
	
	function update_photo_voiture($photo) {
		$user = $_SESSION["id_utilisateur"];
		$req = self::$connexion->prepare( "UPDATE `voiture_utilisateur` SET `photo_voiture` = '$photo' WHERE `id_utilisateur` = $user" );
		$req->execute();
	}


}

?>