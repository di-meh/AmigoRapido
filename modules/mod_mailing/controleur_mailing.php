<?php
session_start();
require_once( 'modele_mailing.php' );
require_once( 'vue_mailing.php' ); //Si on me une vue, decommenter

class ControleurMailing extends ControleurGenerique {

	function __construct() {
		parent::__construct( new ModeleMailing(), new VueMailing() );
	}

	function mailConfirmationCompte() {
		$this->modele->genererCleConfirmation();
		$dest = $_SESSION[ "email" ];
		$objet = "Confirmez votre compte | AmigoRapido";
		ob_start();
		include "assets/mails/confirmation-compte/index.php";
		$message = ob_get_clean();
		$this->modele->envoyerMail( $dest, $objet, $message );
		$this->vue->mailEnvoyeConfCompte();
	}

	function mailCoupon() {
		$codePromo = htmlspecialchars( $_POST[ "code" ] ) . htmlspecialchars( $_POST[ "pourcentage" ] );
		$pourcentage = htmlspecialchars( $_POST[ "pourcentage" ] );
		$estAuto = htmlspecialchars( $_POST[ "estAuto" ] );
		$date = htmlspecialchars( $_POST[ "date" ] );
		$date = DateTime::createFromFormat( 'M d, Y H:i', $date );
		if ($estAuto == 1) {
			$date = $this->modele->calculerDate($pourcentage);
		}

		$this->modele->insererCoupon( $codePromo, $pourcentage, $date );
		$objet = "$pourcentage% de réduction ! | AmigoRapido";
		ob_start();
		include "assets/mails/coupons/index.php";
		$message = ob_get_clean();
		$emails = $this->modele->recupEmailsUsers();
		foreach ( $emails as $key => $value ) {
			$this->modele->envoyerMail( $value[ 0 ], $objet, $message );
		}
		$this->vue->confirmationCoupon( $codePromo, $pourcentage, $date );
	}
}
?>