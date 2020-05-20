<?php 
	
	require_once('modules/mod_recherche/modele_recherche.php');
	require_once('modules/mod_recherche/vue_recherche.php');

	
	class ControleurRecherche extends ControleurGenerique
	{
		function __construct(){

			parent::__construct(new ModeleRecherche(), new VueRecherche());

		}

		function afficherRecherche() {
			if(!isset($_SESSION['id_utilisateur'])){
				$this -> vue -> affichageInfoConnexion();
			} else {
				$data = array(
					"trajet" => $this->modele->trajet(),
					"lieux" => $this->modele->lieux()
				);

				$this->vue->vue_recherche($data);
			}	
		}

		function test($d) {
			$date = $this->modele->formateDate($_POST['dateDepart']);

			$paysD = $_POST['pays'];
			$villeD = $_POST['ville'];

			$paysA  = $_POST['paysDest'];
			$villeA = $_POST['villeDest'];

			$this -> vue -> affichageResultats($this -> modele -> chercheTrajet($paysD, $villeD, $paysA, $villeA, $date));
		}

		function afficherResultats() {
			$this->vue->affichageResultats();
		}
	}
?>