<?php 
	
	require_once('controleur_accueil.php');

	class ModuleAccueil extends ModuleGenerique {

		function __construct() {

			parent::__construct(new ControleurAccueil());
			$this->controleur->afficherAccueil();
			
		}
	}
?>