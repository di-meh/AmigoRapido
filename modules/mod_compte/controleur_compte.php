<?php

	require_once('modele_compte.php');
	require_once('vue_compte.php');

	class ControleurCompte  extends ControleurGenerique {

		function __construct() {
			parent::__construct(new ModeleCompte(), new VueCompte());
		}


		function afficherCompte() {
			$voiture = $this->modele->recupereVehicule($_SESSION['id_utilisateur']);
			$aaa = 1;
			$this->vue->vue_compte($voiture, $aaa);
		}

		function deconnexion() {
			session_destroy();
			header('Location: index.php');
		}

		function suppression() {
			$this->vue->afficherSupp();
		}

		function confirmerSuppression() {
			$this->modele->supprimer($_SESSION['id']);
		}
		
		function supprimerAnnonce($id) {
			$this->modele->supprimerAnnonce($id);
		}
	}
?>