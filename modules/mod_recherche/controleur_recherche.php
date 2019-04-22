<?php 
	
	require_once('modules/mod_recherche/modele_recherche.php');
	require_once('modules/mod_recherche/vue_recherche.php');

	
	class ControleurRecherche extends ControleurGenerique
	{
		function __construct(){

			parent::__construct(new ModeleRecherche(), new VueRecherche());

		}

		function afficherRecherche(){
			if(!isset($_SESSION['id_utilisateur'])){
				$this -> vue -> affichageInfoConnexion();
			} else {
				$data = array(
					"trajet" => $this->modele->trajet(),
					"lieux" => $this->modele->lieux()
				);

				/*$data = array("categorie" => $this->modele->categorie(),
						  "marque" => $this->modele->marque(),
						  "modele" => $this->modele->modele(),
						  "prix" => $this->modele->prix(),
						  "carburant" => $this->modele->carburant()
				);*/
				$this->vue->vue_recherche($data);
			}	
		}	

		function afficherResultats() {
			$this->vue->affichageResultats();
		}
	}
?>