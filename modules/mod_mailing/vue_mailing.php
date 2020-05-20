<?php
class VueMailing extends VueGenerique {

	function __construct() {
		parent::__construct( "Mailing" );
		session_start();
	}

	function mailEnvoyeConfCompte() {
		?>
		<div class="alert alert-info" role="alert">
			Un mail pour confirmer la création de votre compte a été envoyé à <b><i><?= $_SESSION["email"]?></i></b>. Si vous n'avez pas reçu de mail, merci de vérifier dans les <b>spams</b> !<br>Si aucun mail n'a été reçu, cliquez <a href="index.php?module=mailing&action=confirmationCompte">ici</a> pour le renvoyer.
		</div>
		<?
	}

	function confirmationCoupon($codePromo, $pourcentage, $dateExpiration) {
		?>
		<div class="alert alert-info" role="alert">
			Un mail pour d'information sur la création du coupon <b><?= $codePromo ?></b> d'une valeur de -<?= $pourcentage ?>% a été envoyé aux utilisateurs !<br>Ce coupon sera valable jusqu'au <b><?= $dateExpiration ?></b>
		</div>
		<?
	}

}
?>