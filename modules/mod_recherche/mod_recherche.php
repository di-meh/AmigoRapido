<?php 

	require_once('modules/mod_recherche/controleur_recherche.php');

	class ModuleRecherche extends ModuleGenerique
	{
			function __construct(){
	
				parent::__construct(new ControleurRecherche());

				if(isset($_GET["action"])) {
				
					$action = htmlspecialchars($_GET["action"]);
					
					switch ($action) {
					    case "afficherRecherche" : 
					    	$this->controleur->afficherRecherche();
					        break;
					    case 'modele':
					    	$this->controleur->modele();
					    	break;
					    case 'afficherListe':
					    	$this->controleur->afficherResultats();
					    break;
					    case 'test':
					    	/*echo "On a réccupéré ceci : <br/>";
					    	var_dump($_POST);*/
					    	$this -> controleur -> test($_POST);
					    break;
					    default :
							echo "Veuillez saisir une action";
						break;
				   }
				}
				else{
					$this->controleur->afficherRecherche();
				}
			}
	}

 ?>