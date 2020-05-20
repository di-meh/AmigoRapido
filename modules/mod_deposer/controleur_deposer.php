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
				"arrivee" => $this->modele->lieux(),
				"pays" => $this->modele->pays()
			);

			$this->vue->vue_formDepotAnnonce($data);
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

		if(!empty($_POST['pays']) && !empty($_POST['ville']) && !empty($_POST['rue']) && !empty($_POST['paysDest']) && !empty($_POST['villeDest']) && !empty($_POST['rueDest']) && !empty($_POST['dateDepart']) && !empty($_POST['nombre']) && !empty($_POST['prix'])) {

			//on check les préférences si oui => 1 sinon => 0

			$fumeur = (!empty($_POST['fumeur']) ? true : false);
			$enfant = (!empty($_POST['enfant']) ? true : false);
			$animal = (!empty($_POST['animal']) ? true : false);

			// on réccupère les id des lieux pour les insérer dans la table trajet. Permet de vérifier une dernière fois
			// que les lieux existent bien

			$id_lieu_depart = null;
			$id_lieu_arrivee = null;

			if(is_numeric($_POST['rue'][0])) {
				//$tmp = explode( " ", $_POST['rue'] );

				$tmp = substr(strstr($_POST['rue']," "), 1);

				$strDep = $tmp . "," . $_POST['ville'] . "," . $_POST['pays'];
				$id_lieu_depart = $this->modele->recupereInformationTrajet($strDep);
			} else {
				$strDep = ltrim($_POST['rue']) . "," . $_POST['ville'] . "," . $_POST['pays'];
				$id_lieu_depart = $this->modele->recupereInformationTrajet($strDep);
			}

			if(is_numeric($_POST['rueDest'][0])) {
				$tmp1 = substr(strstr($_POST['rueDest']," "), 1);

				$strArr = $tmp1 . "," . $_POST['villeDest'] . "," . $_POST['paysDest'];
				$id_lieu_arrivee = $this->modele->recupereInformationTrajet($strArr);
			} else {
				$strArr = ltrim($_POST['rueDest']) . "," . $_POST['villeDest'] . "," . $_POST['paysDest'];
				$id_lieu_arrivee = $this->modele->recupereInformationTrajet($strArr);
			}

			//on formate la date selon de pattern choisi
			$date = $this->modele->formateDate($_POST['dateDepart']);

			// bonne insertion dans la BD
			if($this->modele->insertInformationTrajet($id_lieu_depart, $id_lieu_arrivee, $date, $_POST['nombre'], $_POST['prix'])) {
				$this->vue->vue_validationTrajet();
			} // echec de l'ajout => erreur
			else {
				echo "ERREUR dans l'insertion";
			}
		} else {
			echo 'Certaines informations viennent à manquer ou ne sont pas complètes';
		}


		/*if(!empty($_POST['lieu_depart'])&& !empty($_POST['lieu_arrivee']) && !empty($_POST['prix']) && !empty($_POST['date_depart']) && !empty($_POST['nombre'])) {

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
		}*/




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

function ajoutLieuBD() {
	if(!empty($_POST['street']) && !empty($_POST['city']) && !empty($_POST['country']) && !empty($_POST['lat']) && !empty($_POST['lng'])) {
		$this->modele->insertIntoDBPlace($_POST['home'], $_POST['street'], $_POST['city'], $_POST['country'], $_POST['lat'], $_POST['lng']);
	}
}

function calculPxAnnonce() {
	$this->modele->calculPxAPI($_POST['depart'], $_POST['arrivee']);
}

	//Permet d'unset les variables de session et de retourner à l'accueil.
function terminer(){
	unset($_SESSION['infoTrajet']);
	header("Location:index.php?module=accueil");
}
}
