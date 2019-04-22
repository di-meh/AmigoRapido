<?php 


	require_once('modele_accueil.php');
	require_once('vue_accueil.php');

	class ControleurAccueil extends ControleurGenerique {

		function __construct() {
			parent::__construct(new ModeleAccueil(), new VueAccueil());

		}
		
		function afficherAccueil() {
			$this->vue->vue_accueil();
			$annonces = $this->modele->recupereAnnonces();
			$this->vue->vue_Annonces($annonces);
		}

	}
?>