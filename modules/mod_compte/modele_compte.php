<?php

class ModeleCompte extends ModeleGenerique {

    //Récupère la liste des véhicules du mec + la première image de son annonce
    function recupereVehicule( $id ) {
        /*$req = self::$connexion->prepare("SELECT * FROM vehicules LEFT JOIN image ON vehicules.idVehicules = image.idVehicules WHERE idUser = :id AND principale = 0");
        $req->execute(array('id' => $id));
        $voitures = $req->fetchAll();
        return $voitures;*/
    }

    function supprimer( $id ) {
        $this->supprimerAnnonces( $id );
        $req = self::$connexion->prepare( "DELETE FROM user WHERE idUser = :id;" );
        $req->execute( array( 'id' => $id ) );
    }

    function supprimerAnnonces( $id ) {
        $req = self::$connexion->prepare( "DELETE FROM vehicules WHERE idUser = :id;" );
        $req->execute( array( 'id' => $id ) );
    }

    function supprimerAnnonce( $id ) {
        $this->supprimerImages( $id );
        $req = self::$connexion->prepare( "DELETE FROM vehicules WHERE idVehicules = :id;" );
        $req->execute( array( 'id' => $id ) );
    }

    function supprimerImages( $id ) {
        $req = self::$connexion->prepare( "DELETE FROM image WHERE idVehicules = :id;" );
        $req->execute( array( 'id' => $id ) );
    }

    function confirmerCompte( $cle ) {
        $req = self::$connexion->prepare( "UPDATE `utilisateur` SET `est_verifie` = 1 WHERE `cle_validation` like '$cle';" );
        $req->execute();
    }

    function recupDateExp( $id ) {
    	$req = self::$connexion->prepare( "SELECT `date_expiration` FROM `utilisateur` WHERE `id_utilisateur` = :idUser;" );
    	$req->execute( array( 'idUser' => $id ) );
    	return $req->fetch();
    }
    
    function recupIdAvecCle( $cle ) {
        $req = self::$connexion->prepare( "SELECT `id_utilisateur` FROM `utilisateur` WHERE `cle_validation` = :cle;" );
        $req->execute( array( 'cle' => $cle ) );
        return $req->fetch();
    }
    
    function recupEmailAvecId($id) {
        $req = self::$connexion->prepare( "SELECT `email` FROM `utilisateur` WHERE `id_utilisateur` = :user;" );
        $req->execute( array( 'user' => $id ) );
        return $req->fetch();
    }
    
    function recupDemandesById($id) {
        $req = self::$connexion->prepare( "SELECT * FROM `demandes` WHERE utilisateur = $id ORDER BY `date_demande` DESC" );
        $req->execute();
        return $req->fetchAll();
    }
	
	function possedeVoiture($id) {
        $req = self::$connexion->prepare( "SELECT COUNT(*) FROM voiture_utilisateur WHERE `id_utilisateur` = $id" );
        $req->execute();
        return $req->fetchAll();
    }
}


?>