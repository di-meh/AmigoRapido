<?php 
require_once('modules/mod_deposer/modele_deposer.php');
require_once('modules/mod_deposer/vue_deposer.php');

class ControleurDeposer extends ControleurGenerique {

	function __construct() {
		parent::__construct(new ModeleDeposer(),new VueDeposer());
	}


	//Détermine l'affichage en fonction de la connexion ou non du membre au site.
	function afficherDeposer() {

		if(!isset($_SESSION['id_utilisateur'])) {
			$this -> vue -> affichageInfoConnexion();
		} else {
			$data = array(
				"depart" => $this->modele->lieux(),
				"arrivee" => $this->modele->lieux()
			);

			$this->vue->vue_informationVehicule($data);
		}
	}

	//Appel de la vue , pour le succès de l'insertion du trajet dans la BD.
	function afficherValidationTrajet() {
		if(isset($_SESSION['infoTrajet']['valider']) && $_SESSION['infoTrajet']['valider'] == 1){
			$this->vue->vue_validationTrajet();
		}
	}

	//Recolte des informations pour l'insertion dans la BD.
	function soumettreInformationTrajet() {

		if(!empty($_POST['lieu_depart'])&& !empty($_POST['lieu_arrivee']) && !empty($_POST['prix']) && !empty($_POST['date_depart']) && !empty($_POST['nombre'])) {

			$date_depart = htmlspecialchars($_POST['date_depart']);
			$prix = htmlspecialchars($_POST['prix']);
			$lieu_depart = htmlspecialchars($_POST['lieu_depart']);
			$lieu_arrivee = htmlspecialchars($_POST['lieu_arrivee']);

			if ($prix < 0) {

				$this->vue->affichageErreur();
			} else {
				if ($this->modele->insertInformationTrajet($_POST['lieu_depart'], $_POST['lieu_arrivee'], $_POST['nombre'],$_POST['prix'], $_POST['date_depart'])) {
					$this->vue->vue_validationTrajet();
				} else {
					$this->vue->affichageErreur();
				}
			}

			

		} else {
			echo 'pbm 2';
		}




		//$erreurs = array();
		/*if(isset($_POST['valider'])){
			
			
			if(!empty($erreurs)){
				$_SESSION['erreurs'] = $erreurs;					
				header("Location:index.php?module=deposer&action=afficherDeposer");
			}

			else{
				$_POST['valider'] = 1;
				header("Location:index.php?module=deposer&action=afficherValidationTrajet");
			}
			var_dump($_POST);
			
			$_SESSION['infoTrajet'] = $_POST;

			var_dump($_SESSION);

			$this->modele->insertInformationTrajet();

			/*

	$_SESSION['infoTrajet']['lieu_depart'], $_SESSION['infoTrajet']['lieu_arrivee'], $_SESSION['infoTrajet']['nombre'],$_SESSION['infoTrajet']['prix'], $_SESSION['infoTrajet']['date_depart'])

			*/
	}

	//Permet d'unset les variables de session et de retourner à l'accueil.
	function terminer(){
		unset($_SESSION['infoTrajet']);
		header("Location:index.php?module=accueil");
	}
}
?>