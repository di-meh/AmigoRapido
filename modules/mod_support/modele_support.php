<?php

class ModeleSupport extends ModeleGenerique {


    function recupDemandes() {
        $req = self::$connexion->prepare( "SELECT * FROM `demandes` ORDER BY `date_demande` DESC" );
        $req->execute();
        return $req->fetchAll();
    }

    function recupDemande( $id ) {
        $req = self::$connexion->prepare( "SELECT * FROM `demandes` WHERE id_demande = $id ORDER BY `date_demande` DESC" );
        $req->execute();
        return $req->fetchAll();
    }

    function supprimerDemande( $id ) {
        $req = self::$connexion->prepare( "DELETE FROM `demandes` WHERE `id_demande` = $id" );
        $req->execute();
    }

    function ajouterReponse( $id, $demande ) {
        $req = self::$connexion->prepare( "UPDATE `demandes` SET `demande` = '$demande' WHERE `id_demande` = $id" );
        $req->execute();
    }

    function ajouterDemande( $motif, $demande, $utilisateur ) {
        $req = self::$connexion->prepare( "INSERT INTO `demandes` (`id_demande`, `motif`, `demande`, `date_demande`, `etat_demande`, `utilisateur`) VALUES (NULL, '$motif', '$demande', CURRENT_TIMESTAMP, '0', '$utilisateur');" );
        $req->execute();
    }

    function majEtat( $etat, $id ) {
        $req = self::$connexion->prepare( "UPDATE `demandes` SET `etat_demande` = '$etat' WHERE `id_demande` = $id" );
        $req->execute();
    }

}

?>