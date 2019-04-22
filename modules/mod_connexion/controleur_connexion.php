<?php 

require_once('modele_connexion.php');
require_once('vue_connexion.php');

class Controleur_Connexion  extends ControleurGenerique {

	function __construct() {
		parent::__construct(new ModeleConnexion(), new VueConnexion());
	}


	function connexion() {

		if(isset($_POST['email'])) {

			$membre = $this->modele->recupereMembres();

			foreach ($membre as $membre) {

				echo($membre['email']);

				if ($membre['email'] == $_POST['email']) {

					$email = htmlspecialchars($_POST['email']);
					$mdp = $membre['mdp'];

					if(password_verify($_POST['mdp'], $mdp)) {

						$this->init_session($membre['id_utilisateur'], $membre['nom'], $membre['prenom'], $membre['email'], $membre['numeroTelephone']);

						// Affiche la page Compte et met à jour le header
						header('Location: index.php?module=compte');

					} else {
						$this->vue->vue_alerte("Mot de passe incorrect !");
						$this->vue->vue_connexion();
					}
				}
			}

			if (!isset($email)) {
				$this->vue->vue_alerte("L'adresse mail est incorrecte !");
				$this->vue->vue_connexion();
			}

		} else {
			$this->vue->vue_connexion();
		}
	}

	function inscription() {
		if(isset($_POST['nom'])) {

			$membre = $this->modele->recupereMembres();

			// Vérification email déjà présent A FAIRE
			foreach ($membre as $membre) {
				
				if ($membre['mail'] == $_POST['email']) {
					$this->vue->vue_inscription();
				}
			}

			$this->modele->inscription($_POST['nom'],$_POST['prenom'],password_hash($_POST['password'],PASSWORD_BCRYPT),$_POST['tel'],$_POST['mail']);

			$id = $this->modele->recupereId($_POST['email']);

			$this->init_session($id['id_utilisateur'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['numeroTelephone']);

			/*
			$this->init_session($membre['idUser'], $membre['nom'],$membre['prenom'],$membre['email'],$membre['adresse'],$membre['codePostal'],$membre['ville'],$membre['telephone']);
			*/

			// Retourne à l'index et met à jour le header
			header('Location: index.php?module=compte');
		} else {
			$this->vue->vue_inscription();
		}
	}

	function init_session($id_utilisateur,$nom, $prenom, $email, $tel) {
		$_SESSION['id_utilisateur'] = $id_utilisateur;
		$_SESSION['nom'] = $nom;
		$_SESSION['prenom'] = $prenom;
		$_SESSION['email'] = $email;
		$_SESSION['tel'] = $tel;
	}
}
?>