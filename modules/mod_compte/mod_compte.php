<?php

	require_once('controleur_compte.php');

	class ModuleCompte extends ModuleGenerique {

		function __construct() {

			parent::__construct(new ControleurCompte());

			if(isset($_GET['action'])) {

				$action = htmlspecialchars($_GET['action']);

				switch ($action) {
					case 'deconnexion':
						$this->controleur->deconnexion();
						break;

					case 'suppression':
						$this->controleur->suppression();
						break;

					case 'supprimer':
						$this->controleur->confirmerSuppression();
						session_destroy();
						header('Location: index.php?');
						break;

					case 'supprimerAnnonce':
						$id = $_GET['id'];
						$this->controleur->supprimerAnnonce($id);
						break;
                        
                    case 'confirmation':
                        $this->controleur->confirmerCompte();
                        break;

					default:
						$this->controleur->afficherCompte();
						break;
				}
			} else {
				$this->controleur->afficherCompte();
			}
			
		}
	}

 ?>
