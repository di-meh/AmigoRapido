<?php

class ModeleAnnonce extends ModeleGenerique {

	function recupere_InfoTrajet($id) {
		$req = self::$connexion->prepare("SELECT * FROM  trajet where id_trajet = :i" );
		$req->bindParam(':i', $id);
		$req->execute();
		$resultat = $req->fetchAll();

		var_dump($resultat);

		return $resultat;
	}
		
	function recupere_InfoContact($id){
		
		$req = self::$connexion->prepare("SELECT nom , prenom, email,numeroTelephone FROM  utilisateur where id_utilisateur = :i" );
		$req->bindParam(':i', $id);
		$req->execute();
		$resultat = $req->fetchAll();

		return $resultat;
	}

	function recupere_lesLieux($id) {
			$req = self::$connexion->prepare('SELECT nom_lieu, nom_ville, nom_pays FROM lieu WHERE id_lieu = :id');
			$req->bindParam(':id', $id);
			$req->execute();
			$resultat = $req->fetch();

			return $resultat;
	}

	function ajout($idTrajet) {
		$val = $this->recupere_InfoTrajet($idTrajet);

		if($val[0][1] != $_SESSION['id_utilisateur']) {

			var_dump($val[0][1]);

			echo '$sess array val : ' . $val[0][0][0] . '<br/>';

			echo "idUtSess : " . $_SESSION['id_utilisateur'] . '<br/>';

			echo '$sess array val 2 : ' . $val[0][0]['id_utilisateur'] . '<br/>';


			if(!$this->estDeja($idTrajet)) {
				if($this->nbPlacesOk($idTrajet)) {
					$idUt = $_SESSION['id_utilisateur'];
					$req = self::$connexion->prepare('INSERT INTO `demande_trajet`(`id_demande`, `id_utilisateur`, `id_trajet`) VALUES (default, :id_sess, :id_traj)');
					$req->bindParam(':id_sess', $idUt);
					$req->bindParam(':id_traj', $idTrajet);
					$req->execute();
					$resultat = $req->fetch();

					echo "tout s'est bien déroulé";
					return 0;
				} else {
					echo "il n'y a plus de places.";
					return 1;
				}
			}	else {
				echo "déja dans le trajet.";
				return 2;
			}
		} else {
			echo "erreur conducteur";
			return 3;
		}
	}

	function nbPlacesOk($id) {
		$nbPlacesDemandeVar = $this->recupere_nbPlaces_Demandes($id);

		$nbPlacesProposeesVar = $this->nbPlacesProposees($id);

		if($nbPlacesProposeesVar - ($nbPlacesDemandeVar + 1) >= 0) {
			if($nbPlacesProposeesVar - ($nbPlacesDemandeVar + 1) == 0) {
				$this->modificationNbPlaces($id);
			}
			return true;
		} else {
			return false;
		}
	}

	function estDeja($id) {
		$idUt = $_SESSION['id_utilisateur'];
		$req = self::$connexion->prepare("SELECT count(*) FROM `demande_trajet` WHERE `id_trajet` = :i AND `id_utilisateur` = :idSess");
		$req->bindParam(':i', $id);
		$req->bindParam(':idSess', $idUt);

		$req->execute();
		$resultat = $req->fetch();

		if($resultat[0] == 0) {
			return false;
		} else {
			return true;
		}
	}

	function modificationNbPlaces($id) {
		$req = self::$connexion->prepare("UPDATE `trajet` SET `estPlein`= 1 WHERE id_trajet = :i" );
		$req->bindParam(':i', $id);
		$req->execute();
		$resultat = $req->fetchAll();
	}

	function nbPlacesProposees($id) {
		$req = self::$connexion->prepare("SELECT nbPersonnes FROM `trajet` WHERE `id_trajet` = :i");
		$req->bindParam(':i', $id);
		$req->execute();
		$resultat = $req->fetch();

		echo $resultat[0] . "  resultats<br/>";

		return $resultat[0];
	}

	function recupere_nbPlaces_Demandes($id) {
			
		$req = self::$connexion->prepare("SELECT count(id_utilisateur) FROM `demande_trajet` WHERE `id_trajet` = :i");
		$req->bindParam(':i', $id);
		$req->execute();
		$resultat = $req->fetch();

		return $resultat[0];
	}
}
?>