<?php 
	
	require_once('modele_annonce.php');
	require_once('vue_annonce.php');


	
class ControleurAnnonce extends ControleurGenerique {

		function __construct(){
			parent::__construct(new ModeleAnnonce(),new VueAnnonce());
		}

		function afficherAnnonce($id) {
			$data = array('infoTrajet' => $this->modele->recupere_InfoTrajet($id));

			array_push($data, $this->modele->recupere_lesLieux($data['infoTrajet'][0][2]));
			array_push($data, $this->modele->recupere_lesLieux($data['infoTrajet'][0][3]));

			array_push($data, $this->modele->recupere_InfoContact($data['infoTrajet'][0][1]));



			array_push($data, $this->modele->recupere_nbPlaces_Demandes($data['infoTrajet'][0]['id_trajet']));
			
			$this->vue->vue_annonce($data);
		}

		function ajoutParticipant($id) {
			$valSortie = $this->modele->ajout($id);

			switch ($valSortie) {
				case 0:
					$this->vue->affichageCorrect();
				break;
				case 1:
					$this->vue->affichageErreurPlaces();
				break;
				case 2:
					$this->vue->affichageErreurDejaTrajet();
				break;
				case 3:
					$this->vue->affichageErreurConducteur();
				break;
				default:
					echo 'A que coucou Bob';
				break;
			}
		}

		function affErreur() {
			$this->vue->affichageErreur();
		}
	}
?>