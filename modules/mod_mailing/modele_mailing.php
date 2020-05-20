<?php
session_start();
class ModeleMailing extends ModeleGenerique {

	function envoyerMail( $destinataire, $objet, $message ) {
		$headers = "From: amigorapido@turtletv.fr\r\n";
		//$headers .= "Return-Path: The Sender <amigorapido@turtletv.fr>\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		$headers .= "X-Priority: 1 (Highest)\n";
		$headers .= "Importance: High\n";
		$headers .= "Organization: AmigoRapido\r\n";

		mail( $destinataire, $objet, $message, $headers );
	}

	function genererCleConfirmation() {
		$idUser = $_SESSION[ 'email' ];
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen( $characters );
		$randomString = '';
		for ( $i = 0; $i < 32; $i++ ) {
			$randomString .= $characters[ rand( 0, $charactersLength - 1 ) ];
		}
		$reqUpdateCle = self::$connexion->prepare( "UPDATE `utilisateur` SET `cle_validation`='$randomString' WHERE `email` = '$idUser';" );
		$reqUpdateCle->execute();
		$_SESSION[ "cle" ] = $randomString;
	}

	function recupEmailsUsers() {
		$req = self::$connexion->prepare( "SELECT `email` FROM `utilisateur`" );
		$req->execute();
		return $req->fetchAll();
	}

	function insererCoupon( $codePromo, $pourcentage, $dateExp ) {
		$req = self::$connexion->prepare( "INSERT INTO `promotion`(`code_promotion`, `pourcentage_promotion`, `date_expiration`) VALUES ('$codePromo',$pourcentage, '$dateExp')" );
		$req->execute();
	}

	function calculerDate( $pourcentage ) {
		$date = new DateTime( date( 'Y-m-d' ) );
		switch ( $pourcentage ) {
			case 5:
				$date->modify( '+2 month' );
				break;
			case 10:
				$date->modify( '+1 month' );
				break;

			case 15:
				$date->modify( '+25 day' );
				break;

			case 20:
				$date->modify( '+20 day' );
				break;

			case 25:
				$date->modify( '+14 day' );
				break;

			case 30:
				$date->modify( '+7 day' );
				break;

			case 35:
				$date->modify( '+5 day' );
				break;

			case 40:
				$date->modify( '+3 day' );
				break;

			case 45:
				$date->modify( '+2 day' );
				break;

			case 50:
				$date->modify( '+1 day' );
				break;
		}
		return $date->format( 'Y-m-d' );
	}
}
?>