<?php 

	require_once('modules/mod_liste/controleur_liste.php');

	class ModuleListe extends ModuleGenerique{
		function __construct() {

			parent::__construct(new ControleurListe());
			

			if(!isset($_GET['action'])) {
				$action = 'affichage';
			} else {
				$action = $_GET['action'];
			}
			
			switch ($action) {
				case 'afficherListe':
					$this->controleur->afficherListe();
				break;
				default:
					echo 'A que coucou Bob :)';
				break;
			}
		}
	}

 ?>