<?php
		
	class ModeleListe extends ModeleGenerique
	{
		function reccupereInformation($lieu, $ville, $pays) {
			$req = self::$connexion->prepare('SELECT id_lieu FROM lieu WHERE nom_lieu like :l AND nom_ville like :v AND nom_pays like :p');
			$req->bindParam(':l', $lieu);
            $req->bindParam(':v', $ville);
            $req->bindParam(':p', $pays);
			$req->execute();
			$resultat = $req->fetch();

			return $resultat[0];
		}

		function recupere_lesAnnonces($idD, $idA) {
			$req = self::$connexion->prepare('SELECT DISTINCT(id_utilisateur), nom, prenom, heureDepart, heureArrivee, nbPersonnes, estPlein, prix_commission, id_lieu_depart, id_lieu_arrivee, id_trajet FROM trajet INNER JOIN utilisateur USING(id_utilisateur) JOIN lieu ON id_lieu_depart = :depart AND id_lieu_arrivee = :arrivee ORDER BY heureDepart');
			$req->bindParam(':depart', $idD);
            $req->bindParam(':arrivee', $idA);
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
	}
?>