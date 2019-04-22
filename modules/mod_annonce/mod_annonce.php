<?php 
	require_once('controleur_annonce.php');
	
	class ModuleAnnonce extends ModuleGenerique{
		function __construct() {

			parent::__construct(new ControleurAnnonce());


			if(isset($_GET['action'])) {
				$action = htmlspecialchars($_GET['action']);
			} else {
				$action = 'affichage';
			}

			if(isset($_GET['id'])) {
				$id = htmlspecialchars($_GET['id']);
			} else {
				$action = 'erreur';
			}

			switch ($action) {
				case 'affichage':
					$this->controleur->afficherAnnonce($id);
				break;
				case 'ajoutParticipant':
					$this->controleur->ajoutParticipant($id);
				break;
				case 'erreur':
				default:
					$this->controleur->affErreur();
				break;
			}
		}
	}
 ?>