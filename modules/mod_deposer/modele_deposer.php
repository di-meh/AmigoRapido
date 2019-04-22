<?php
	

	class ModeleDeposer extends ModeleGenerique
	{

		function lieux() {
			$reqLieux = self::$connexion->prepare("SELECT DISTINCT nom_lieu, nom_ville, nom_pays FROM lieu ORDER BY nom_ville");
			$reqLieux->execute();
			$resultat = $reqLieux->fetchAll();
			
			return $resultat; 
		}
		

	function recupereInformationTrajet($nomLieu) {

		$valeurs = explode(",", $nomLieu);

		$req = self::$connexion->prepare('SELECT id_lieu FROM lieu WHERE nom_lieu like :l AND nom_ville like :v AND nom_pays like :p');
		$req->bindParam(':l', $valeurs[0]);
        $req->bindParam(':v', $valeurs[1]);
        $req->bindParam(':p', $valeurs[2]);
		$req->execute();
		$resultat = $req->fetch();

		return $resultat[0];
	}

	function insertInformationTrajet($nomLieuDepart,$nomLieuArrivee,$nombrePers,$prix,$dateDepart){
		$idLieuD = $this->recupereInformationTrajet($nomLieuDepart);
		$idLieuA = $this->recupereInformationTrajet($nomLieuArrivee);

		$insertDescriptionTrajet = self::$connexion->prepare("INSERT INTO `trajet`(`id_trajet`, `id_utilisateur`, `id_lieu_depart`, `id_lieu_arrivee`, `heureDepart`, `heureArrivee`, `nbPersonnes`, `estPlein`, `prix_commission`) VALUES (DEFAULT, :idSession, :idLieuD, :idLieuA, :dateDepart, '2019-03-16 10:00:00', :nombrePers, 0, :prix)");

		$insertDescriptionTrajet->bindParam(':idSession', $_SESSION['id_utilisateur']);
		$insertDescriptionTrajet->bindParam(':idLieuD', $idLieuD);
		$insertDescriptionTrajet->bindParam(':idLieuA', $idLieuA);
		$insertDescriptionTrajet->bindParam(':dateDepart', $dateDepart);
		$insertDescriptionTrajet->bindParam(':nombrePers', $nombrePers);
		$insertDescriptionTrajet->bindParam(':prix', $prix);

		if($insertDescriptionTrajet->execute()) {
			return true;
		} else {
			return false;
		}		
	}
			
}
?>