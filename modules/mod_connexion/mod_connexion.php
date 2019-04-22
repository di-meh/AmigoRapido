<?php 

	require_once('controleur_connexion.php');

	class ModuleConnexion extends ModuleGenerique {

		function __construct() {

			$this -> controleur = new Controleur_Connexion();

			if(isset($_GET['action'])) {

				$action = htmlspecialchars($_GET['action']);

				switch ($action) {
					case 'inscription':
						$this->controleur->inscription();
						break;
					
					case 'connexion':
						$this->controleur->connexion();
						break;

					case 'deconnexion':
						$this->controleur->deconnexion();
						break;

					default:
						$this->controleur->connexion();
						break;
				}
			} else {
				$this->controleur->connexion();
			}
			
		}
	}

 ?>
