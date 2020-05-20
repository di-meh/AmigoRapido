<?php
echo "Test API Maps<br><br>Paramètres URL :<br>?d = adresse ou lieu de départ<br>?a = adresse ou lieu d'arrivée<br><br>";

if ( isset( $_GET[ "a" ] ) || isset( $_GET[ "d" ] ) ) {
	$depart = urlencode( htmlspecialchars( $_GET[ "d" ] ) );
	$arrivee = urlencode( htmlspecialchars( $_GET[ "a" ] ) );
	$jsonMatrix = file_get_contents( "https://maps.googleapis.com/maps/api/distancematrix/json?units=metrics&origins=$depart&destinations=$arrivee&key=" );

	$objMatrix = json_decode( $jsonMatrix, true );
	// Récupération distance
	echo $objMatrix[ "rows" ][ 0 ][ "elements" ][ 0 ][ "distance" ][ "text" ] . ' - ' . $objMatrix[ "rows" ][ 0 ][ "elements" ][ 0 ][ "duration" ][ "text" ];
	
	$dist = intval($objMatrix[ "rows" ][ 0 ][ "elements" ][ 0 ][ "distance" ][ "value" ]/1000);
	
	$val1 = intval($dist * 0.14 * 0.8);
	$val2 = intval($dist * 0.14 * 1.2);
	
	echo($dist);
	
	echo '<br><input type="text" placeholder="'.intval($dist*0.14) .'€"></input><p>Pour ce trajet nous vous suggérons un prix entre '.$val1.'€ et '.$val2.'€</p>';
}