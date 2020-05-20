<?php

class ModeleConnexion extends ModeleGenerique {

    function inscription( $nom, $prenom, $mdp, $numeroTelephone, $email ) {
        $req = self::$connexion->prepare( "INSERT INTO utilisateur(nom,prenom,mdp, numeroTelephone,email) VALUES (:nom,:prenom,:mdp, :numeroTelephone, :email)" );
        $req->execute( array( 'nom' => $nom, 'prenom' => $prenom, 'mdp' => $mdp, 'numeroTelephone' => $numeroTelephone, 'email' => $email ) );
        $req->closeCursor();
    }

    function recupereMembres() {
        $req = self::$connexion->prepare( "SELECT * FROM utilisateur" );
        $req->execute();
        $membre = $req->fetchAll();

        //var_dump( $membre );

        return $membre;
    }

    function recupereId( $mail ) {
        $req = self::$connexion->prepare( "SELECT id_utilisateur FROM utilisateur WHERE email = :email" );
        $req->execute( array( 'email' => $mail ) );
        $id = $req->fetch();
        //var_dump($id);
        return $id;
    }

}


?>