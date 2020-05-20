<?php

require_once( 'controleur_vehicule.php' );

class ModuleVehicule extends ModuleGenerique {

	function __construct() {
		parent::__construct( new ControleurVehicule() );

		if ( !isset( $_SESSION[ 'id_utilisateur' ] ) || $_SESSION[ 'est_admin' ] == 0 ) {
			header( 'Location: /index.php?module=compte' );
		} else if ( isset( $_GET[ 'action' ] ) ) {
			$action = htmlspecialchars( $_GET[ 'action' ] );
			// Différentes actions
			switch ( $action ) {
				case 'modifierVehicule':
					$this->controleur->modifierVoiture();
					break;
				case 'edit':
					$this->controleur->monVehicule();
					break;
				case 'delete':
					$this->controleur->supprVoiture();
					break;
				case 'uploadPhoto':
					$this->controleur->uploadVoiture();
					break;
			}
		} else {
			$this->controleur->vue_default();
		}
	}
}

?>