<?php
require_once( "../include/modele_generique.php" );
$connexion = new ModeleGenerique();
$connexion = $connexion->init();

if ( isset( $_POST[ "pays" ] ) ) {
    $pays = htmlspecialchars( $_POST[ "pays" ] );
    $reqVilles = $connexion->prepare( "select distinct nom_ville from lieu where nom_pays like '$pays' order by nom_ville asc" );
    $reqVilles->execute();
    $arrayVilles = array();
    while ( $queryVilles = $reqVilles->fetch( PDO::FETCH_OBJ ) ) {
        $tmp = array( "nom_ville" => $queryVilles->nom_ville );
        array_push( $arrayVilles, $tmp );
    }
    echo json_encode( $arrayVilles, JSON_FORCE_OBJECT );
}

if ( isset( $_POST[ "ville" ] ) ) {
    $ville = htmlspecialchars( $_POST[ "ville" ] );
    $reqRue = $connexion->prepare( "select distinct num_rue, nom_lieu from lieu where nom_ville like '$ville' order by nom_lieu asc" );
    $reqRue->execute();
    $arrayRue = array();
    while ( $queryRue = $reqRue->fetch( PDO::FETCH_OBJ ) ) {
        $tmp = array( "num_rue" => $queryRue->num_rue, "nom_lieu" => $queryRue->nom_lieu );
        array_push( $arrayRue, $tmp );
    }
    echo json_encode( $arrayRue, JSON_FORCE_OBJECT );
}
?>