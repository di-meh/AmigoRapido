<?php

require_once( 'modele_support.php' );
require_once( 'vue_support.php' );

class ControleurSupport extends ControleurGenerique {
    function __construct() {
        parent::__construct( new ModeleSupport(), new VueSupport() );
    }

    function accueil_support() {
        $demandes = $this->modele->recupDemandes();
        $tableau = "";
        foreach ( $demandes as $key => $value ) {
            switch ( $value[ 'etat_demande' ] ) {
                case 0:
                    $etat = "En attente";
                    break;
                case 1:
                    $etat = "Pris en charge";
                    break;
                case 2:
                    $etat = "Résolu";
                    break;
            }
            $date = date_create_from_format( 'Y-m-d H:i:s', $value[ 'date_demande' ] );
            $date = date_format( $date, 'd/m/Y à H:i' );
            $tableau = $tableau . '<tr><td class="collapsing">' . $value[ 'id_demande' ] . '</td><td>' . $value[ 'motif' ] . '</td><td class="collapsing">' . $date . '</td><td class="collapsing">' . $etat . '</td><td class="collapsing"><a href="?module=support&action=consulter&id=' . $value[ 'id_demande' ] . '"><i class="folder open icon" title="Consulter"></i></a>• <a href="?module=support&action=fermer&id=' . $value[ 'id_demande' ] . '"><i class="times circle icon" title="Fermer"></i></a>• <a href="?module=support&action=supprimer&id=' . $value[ 'id_demande' ] . '"><i class="trash icon" title="Supprimer"></i></a></td></tr>';
        }
        $this->vue->accueil_support( $tableau );
    }

    function supprimer_demande() {
        if ( $_SESSION[ 'est_admin' ] == 1 ) {
            $id = htmlspecialchars( $_GET[ "id" ] );
            $this->modele->supprimerDemande( $id );
            header( 'Location: index.php?module=support' );
        } else header( 'Location: index.php' );

    }

    function fermer_demande() {
        if ( $_SESSION[ 'est_admin' ] == 1 ) {
            $id = htmlspecialchars( $_GET[ "id" ] );
            $this->modele->majEtat( 2, $id );
            header( 'Location: index.php?module=support' );
        } else header( 'Location: index.php' );

    }

    function consulter_admin() {
        if ( $_SESSION[ 'est_admin' ] == 1 ) {
            $id = htmlspecialchars( $_GET[ "id" ] );
            $demande = $this->modele->recupDemande( $id );
            if ( $demande[ 0 ][ "etat_demande" ] == 0 ) {
                $this->modele->majEtat( 1, $id );
                $demande = $this->modele->recupDemande( $id );
            }


            foreach ( $demande as $key => $value ) {
                $resolu = "";
                switch ( $value[ 'etat_demande' ] ) {
                    case 0:
                        $etat = "En attente";
                        break;
                    case 1:
                        $etat = "Pris en charge";
                        break;
                    case 2:
                        $etat = "Résolu";
                        $resolu = "disabled";
                        break;
                }
                $date = date_create_from_format( 'Y-m-d H:i:s', $value[ 'date_demande' ] );
                $date = date_format( $date, 'd/m/Y à H:i' );
                $json = json_decode( $value[ 'demande' ], true );
                $messages = "";
                foreach ( $json as $cle => $valeur ) {
                    $dateMessage = date_create_from_format( 'd-m-Y H:i:s', $valeur[ 'date' ] );
                    $dateMessage = date_format( $dateMessage, 'd/m/Y à H:i' );
                    if ( $valeur[ 'expediteur' ] == 0 ) {
                        $messages .= '
                        <div class="ui stackable two column grid"><div class="column"><div class="chatLeft">' . $valeur[ 'message' ] . '<br><p class="dateMessageRight">Le ' . $dateMessage . '</p></div></div><div class="column"></div></div>';
                    } else {
                        $messages .= '
                        <div class="ui stackable two column grid"><div class="column"></div><div class="column"><div class="chatRight">' . $valeur[ 'message' ] . '<br><p class="dateMessageLeft">Le ' . $dateMessage . '</p></div></div></div>';
                    }
                }
                $messages = html_entity_decode( $messages );
                // Afficher la demande
                if(isset($_GET["e"])) {
                    $erreur = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script><script type="text/javascript" src="assets/js/toast.js"></script>';
                }
                $this->vue->afficherChat( $value[ 'id_demande' ], $date, $etat, $messages, $resolu, $erreur );
            }

        } else header( 'Location: index.php' );
    }

    function repondre_demande() {
        $id = htmlspecialchars( $_GET[ "id" ] );
        $reponse = htmlspecialchars( $_POST[ "reponse" ] );
        $demande = $this->modele->recupDemande( $id );
        try {
            foreach ( $demande as $key => $value ) {
                $date = date( "d-m-Y H:i:s" );
                $json = json_decode( $value[ 'demande' ], true );
                $tab = array( "vu" => false, "date" => "$date", "message" => "$reponse", "expediteur" => 1 );
                array_push( $json, $tab );
                $json = addslashes( json_encode( $json, JSON_FORCE_OBJECT ) );
                $this->modele->ajouterReponse( $id, $json );
            }
            header( "Location: index.php?module=support&action=consulter&id=$id" );
        } catch ( Exception $e ) {
            $pos = strpos( $e, "ERREUR_DEMANDE_FERME" );
            if ( $pos != 0 )
                header( "Location: index.php?module=support&action=consulter&id=$id&e=1" );
        }
    }

    function rediger_demande() {
        $this->vue->afficherNouvelleDemande();
    }

    function envoyer_demande() {
        $motif = htmlspecialchars( $_POST[ "motif" ] );
        $message = htmlspecialchars( $_POST[ "demande" ] );
        $date = date( "d-m-Y H:i:s" );
        $demande = array();
        array_push( $demande, array( "vu" => false, "date" => "$date", "message" => "$message", "expediteur" => 0 ) );
        $json = addslashes( json_encode( $demande, JSON_FORCE_OBJECT ) );
        $utilisateur = $_SESSION[ "id_utilisateur" ];
        $this->modele->ajouterDemande( $motif, $json, $utilisateur );
        $this->vue->confirmerNouvelleDemande();
    }

    function consulter_client() {
        if ( isset( $_SESSION[ 'id_utilisateur' ] ) ) {
            $id = htmlspecialchars( $_GET[ "id" ] );
            $demande = $this->modele->recupDemande( $id );

            foreach ( $demande as $key => $value ) {
                $resolu = "";
                switch ( $value[ 'etat_demande' ] ) {
                    case 0:
                        $etat = "En attente";
                        break;
                    case 1:
                        $etat = "Pris en charge";
                        break;
                    case 2:
                        $etat = "Résolu";
                        $resolu = "disabled";
                        break;
                }
                $date = date_create_from_format( 'Y-m-d H:i:s', $value[ 'date_demande' ] );
                $date = date_format( $date, 'd/m/Y à H:i' );
                $json = json_decode( $value[ 'demande' ], true );
                $messages = "";
                foreach ( $json as $cle => $valeur ) {
                    $dateMessage = date_create_from_format( 'd-m-Y H:i:s', $valeur[ 'date' ] );
                    $dateMessage = date_format( $dateMessage, 'd/m/Y à H:i' );
                    if ( $valeur[ 'expediteur' ] == 1 ) {
                        $messages .= '
                        <div class="ui stackable two column grid"><div class="column"><div class="chatLeft">' . $valeur[ 'message' ] . '<br><p class="dateMessageRight">Le ' . $dateMessage . '</p></div></div><div class="column"></div></div>';
                    } else {
                        $messages .= '
                        <div class="ui stackable two column grid"><div class="column"></div><div class="column"><div class="chatRight">' . $valeur[ 'message' ] . '<br><p class="dateMessageLeft">Le ' . $dateMessage . '</p></div></div></div>';
                    }
                }
                $messages = html_entity_decode( $messages );
                // Afficher la demande
                if(isset($_GET["e"])) {
                    $erreur = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script><script type="text/javascript" src="assets/js/toast.js"></script>';
                }
                $this->vue->afficherChatClient( $value[ 'id_demande' ], $date, $etat, $messages, $resolu, $erreur );
            }

        } else header( 'Location: index.php' );
    }

    function repondre_demandeClient() {
        $id = htmlspecialchars( $_GET[ "id" ] );
        $reponse = htmlspecialchars( $_POST[ "reponse" ] );
        $demande = $this->modele->recupDemande( $id );
        try {
            foreach ( $demande as $key => $value ) {
                $date = date( "d-m-Y H:i:s" );
                $json = json_decode( $value[ 'demande' ], true );
                $tab = array( "vu" => false, "date" => "$date", "message" => "$reponse", "expediteur" => 0 );
                array_push( $json, $tab );
                $json = addslashes( json_encode( $json, JSON_FORCE_OBJECT ) );
                $this->modele->ajouterReponse( $id, $json );
            }
            header( "Location: index.php?module=support&action=consulterClient&id=$id" );
        } catch ( Exception $e ) {
            $pos = strpos( $e, "ERREUR_DEMANDE_FERME" );
            if ( $pos != 0 )
                header( "Location: index.php?module=support&action=consulterClient&id=$id&e=1" );
        }
    }
}

?>