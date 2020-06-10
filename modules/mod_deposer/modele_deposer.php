<?php


class ModeleDeposer extends ModeleGenerique {

	function lieux() {
		$reqLieux = self::$connexion->prepare( "SELECT DISTINCT id_lieu, num_rue, nom_lieu, nom_ville, nom_pays FROM lieu ORDER BY nom_ville" );
		$reqLieux->execute();
		$resultat = $reqLieux->fetchAll();
		return $resultat;
	}

	function pays() {
		$reqPays = self::$connexion->prepare( "SELECT DISTINCT nom_pays FROM lieu ORDER BY nom_pays ASC" );
		$reqPays->execute();
		$arrayPays = array();
		while ( $queryPays = $reqPays->fetch( PDO::FETCH_OBJ ) ) {
			$tmp = array( "nom_pays" => $queryPays->nom_pays );
			array_push( $arrayPays, $tmp );
		}
		return $arrayPays;
	}

	function recupereInformationTrajet( $strAdr ) {

		$valeurs = explode( ",", $strAdr );

		$req = self::$connexion->prepare( 'SELECT id_lieu FROM lieu WHERE nom_lieu = :l AND nom_ville = :v AND nom_pays = :p' );
		//
		$req->bindParam( ':l', $valeurs[ 0 ] );
		$req->bindParam( ':v', $valeurs[ 1 ] );
		$req->bindParam( ':p', $valeurs[ 2 ] );
		$req->execute();

		$resultat = $req->fetch();

		return $resultat[ 0 ];
	}

	function insertInformationTrajet( $idLieuDepart, $idLieuArrivee, $dateDepart, $nombrePers, $prix ) {
		$insertDescriptionTrajet = self::$connexion->prepare( "INSERT INTO `trajet`(`id_trajet`, `id_conducteur`, `id_lieu_depart`, `id_lieu_arrivee`, `heureDepart`, `heureArrivee`, `nbPersonnes`, `estPlein`, `prix_commission`) VALUES (DEFAULT, :idSession, :idLieuD, :idLieuA, :dateDepart, '2019-03-16 10:00:00', :nombrePers, 0, :prix)" );

		$insertDescriptionTrajet->bindParam( ':idSession', $_SESSION[ 'id_utilisateur' ] );
		$insertDescriptionTrajet->bindParam( ':idLieuD', $idLieuDepart );
		$insertDescriptionTrajet->bindParam( ':idLieuA', $idLieuArrivee );
		$insertDescriptionTrajet->bindParam( ':dateDepart', $dateDepart );
		$insertDescriptionTrajet->bindParam( ':nombrePers', $nombrePers );
		$insertDescriptionTrajet->bindParam( ':prix', $prix );

		return $insertDescriptionTrajet->execute();
	}

	function insertIntoDBPlace( $home, $street, $city, $country, $lat, $lng ) {
		try {
			$insertLieu = self::$connexion->prepare( "INSERT INTO `lieu`(`id_lieu`, `num_rue`, `nom_lieu`, `nom_ville`, `nom_pays`, `latitude`, `longitude`) VALUES (DEFAULT, :h, :s, :ci, :co, :la, :lo)" );

			$insertLieu->bindParam( ':h', $home );
			$insertLieu->bindParam( ':s', $street );
			$insertLieu->bindParam( ':ci', $city );
			$insertLieu->bindParam( ':co', $country );
			$insertLieu->bindParam( ':la', $lat );
			$insertLieu->bindParam( ':lo', $lng );

			var_dump( $insertLieu );
			$insertLieu->execute();
			/*if ( $insertLieu->execute() ) {
				echo 'OK';
				return true;
			} else {
				echo 'PAS OK';
				return false;
			}*/

		} catch ( Exception $e ) {
			echo 'Exception -> ';
			var_dump( $e->getMessage() );
		}
	}

	function calculPxAPI($d, $a) {
		$depart = urlencode( htmlspecialchars( $d ));
		$arrivee = urlencode( htmlspecialchars( $a ));
		$jsonMatrix = file_get_contents( "https://maps.googleapis.com/maps/api/distancematrix/json?units=metrics&origins=$depart&destinations=$arrivee&key=" );

		$objMatrix = json_decode( $jsonMatrix, true );

				// Récupération distance
		echo $objMatrix[ "rows" ][ 0 ][ "elements" ][ 0 ][ "distance" ][ "text" ] . ' - ' . $objMatrix[ "rows" ][ 0 ][ "elements" ][ 0 ][ "duration" ][ "text" ];

		$dist = intval($objMatrix[ "rows" ][ 0 ][ "elements" ][ 0 ][ "distance" ][ "value" ]/1000);

		$valMin = intval($dist * 0.14 * 0.8);

		$valMoy = intval($dist*0.14);

		$valMax = intval($dist * 0.14 * 1.2);

		$arrayVal = array($valMin, $valMoy, $valMax);

		var_dump($arrayVal);

		return $arrayVal;
	}

	function formateDate($date) {
		$find = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
		$replace = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'Decqember');
		$date = str_replace($find, $replace, strtolower($date));
		return date('Y-m-d H:i:s', strtotime($date));
	}
}
