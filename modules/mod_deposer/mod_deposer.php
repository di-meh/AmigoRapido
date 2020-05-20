<?php 

require_once('modules/mod_deposer/controleur_deposer.php');

class ModuleDeposer extends ModuleGenerique
{
	function __construct(){
		
		parent::__construct(new ControleurDeposer());
		
		if(isset($_GET["action"])) {
			
			$action = htmlspecialchars($_GET["action"]);
						switch ($action) {
				case 'afficherDeposer':
					$this->controleur->afficherDeposer();
				break;
				case 'afficherValidationTrajet':
					$this->controleur->afficherValidationTrajet();
				break;
				case 'soumettreInformationTrajet':
					$this->controleur->soumettreInformationTrajet();
				break;
				case 'ajoutNvLieuBD':
					$this->controleur->ajoutLieuBD();
				break;
				case 'calculPxAnnonce':
					$this->controleur->calculPxAnnonce();
					break;
				case 'terminer':
				$this->controleur->terminer();
				break;
				default :
				$this->controleur->afficherDeposer();
				break;
			}
		}
		else{
			$this->controleur->afficherDeposer();
		}
	}
}
