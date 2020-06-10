<?php

require_once("../include/modele_generique.php");
$connexion = new ModeleGenerique();
$connexion = $connexion->init();

if(isset($_POST["depart"]) && isset($_POST["arrivee"])) {
	$depart = urlencode( htmlspecialchars($_POST["depart"]));
		$arrivee = urlencode( htmlspecialchars($_POST["arrivee"]));
	$jsonMatrix = file_get_contents( "https://maps.googleapis.com/maps/api/distancematrix/json?units=metrics&origins=$depart&destinations=$arrivee&key=" );

	$objMatrix = json_decode( $jsonMatrix, true );

		// Récupération distance
	//echo $objMatrix[ "rows" ][ 0 ][ "elements" ][ 0 ][ "distance" ][ "text" ] . ' - ' . $objMatrix[ "rows" ][ 0 ][ "elements" ][ 0 ][ "duration" ][ "text" ];

	$dist = intval($objMatrix[ "rows" ][ 0 ][ "elements" ][ 0 ][ "distance" ][ "value" ]/1000);

	/*$valMin = intval($dist * 0.14 * 0.8);

	$valMoy = intval($dist*0.14);

	$valMax = intval($dist * 0.14 * 1.2);

	$arrayVal = array($valMin, $valMoy, $valMax);*/

	// var_dump($arrayVal);

	$arrayVal["pxMin"] = intval($dist * 0.14 * 0.8);
	$arrayVal["pxMoy"] = intval($dist*0.14);
	$arrayVal["pxMx"] = intval($dist * 0.14 * 1.2);

	echo $arrayVal["pxMin"] . "-" . $arrayVal["pxMoy"] . "-" . $arrayVal["pxMx"];
}
?>
