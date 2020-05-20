<?
require_once( 'modules/mod_mailing/controleur_mailing.php' );

class ModuleMailing extends ModuleGenerique {

	function __construct() {

		parent::__construct( new ControleurMailing() );

		if ( isset( $_GET[ "action" ] ) ) {

			$action = htmlspecialchars( $_GET[ "action" ] );
			switch ( $action ) {
				case 'confirmationCompte':
					$this->controleur->mailConfirmationCompte();
					break;
				case 'coupon':
					$this->controleur->mailCoupon();
					break;
			}
		}
	}

}
?>