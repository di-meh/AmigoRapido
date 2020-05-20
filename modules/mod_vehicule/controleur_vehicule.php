<?php
require_once( 'modele_vehicule.php' );
require_once( 'vue_vehicule.php' );

class ControleurVehicule extends ControleurGenerique {
	function __construct() {
		parent::__construct( new ModeleVehicule(), new VueVehicule() );
	}

	function vue_default() {
		$voitures = $this->modele->recup_liste_vehicule();
		foreach ( $voitures as $value => $key ) {
			$options = $options . '<div class="item" data-value="' . $key[ 0 ] . '"><img class="ui image" src="' . $key[ 2 ] . '">' . $key[ 1 ] . ' ' . $key[ 3 ] . ' (' . $key[ 4 ] . ' - ' . $key[ 6 ] . ' cv)</div>';
		}
		$this->vue->accueil_vehicule( $options );
	}

	function modifierVoiture() {
		$idVoiture = htmlspecialchars( $_POST[ "voiture" ] );
		$couleur = htmlspecialchars( $_POST[ "couleur" ] );
		switch ( $couleur ) {
			case 0:
				$couleur = "Noir";
				break;
			case 1:
				$couleur = "Blanc";
				break;
			case 2:
				$couleur = "Gris";
				break;
			case 3:
				$couleur = "Rouge";
				break;
			case 4:
				$couleur = "Jaune";
				break;
			case 5:
				$couleur = "Orange";
				break;
			case 6:
				$couleur = "Rose";
				break;
			case 7:
				$couleur = "Bleu";
				break;
			case 8:
				$couleur = "Vert";
				break;
		}
		$immatriculation = htmlspecialchars( $_POST[ "immatriculation" ] );

		// Upload permis de conduire et carte grise
		$uploaddir = 'assets/images/docUtilisateurs/';
		$uploadfile = $uploaddir . $_SESSION[ "nom" ] . $_SESSION[ "prenom" ] . $_SESSION[ "id_utilisateur" ] . 'permisConduire.jpg';

		if ( move_uploaded_file( $_FILES[ 'pc' ][ 'tmp_name' ], $uploadfile ) ) {
			$uploaddir = 'assets/images/docUtilisateurs/';
			$uploadfile2 = $uploaddir . $_SESSION[ "nom" ] . $_SESSION[ "prenom" ] . $_SESSION[ "id_utilisateur" ] . 'carteGrise.jpg';

			if ( move_uploaded_file( $_FILES[ 'cg' ][ 'tmp_name' ], $uploadfile2 ) ) {
				session_start();
				$user = $_SESSION[ "id_utilisateur" ];
				$this->modele->update_voiture( $user, $idVoiture, $couleur, strtoupper( $immatriculation ), $uploadfile, $uploadfile2 );
				echo '<div class="ui segment">L\'ajout de votre voiture s\'est déroulé avec succès ! Vous allez être redirigé vers l\'accueil.</div><meta http-equiv="refresh" content="5; URL=https://amigorapido.turtletv.fr">';
			} else {
				echo '<div class="ui segment">Une erreur s\'est produite lors du transfert de votre carte grise ! Veuillez réessayer plus tard !</div>';
			}
		} else {
			echo '<div class="ui segment">Une erreur s\'est produite lors du transfert de votre permis de conduire ! Veuillez réessayer plus tard !</div>';
		}
	}

	function monVehicule() {
		$voiture = $this->modele->recup_info_vehicule( $_SESSION[ "id_utilisateur" ] );
		$voitureBd = $this->modele->recup_vehicule( $voiture[ 0 ][ 2 ] );
		$immatriculation = explode( "-", $voiture[ 0 ][ 3 ] );
		$this->vue->mon_vehicule( $voitureBd[ 0 ][ 1 ], $voitureBd[ 0 ][ 3 ], $voitureBd[ 0 ][ 4 ], $voitureBd[ 0 ][ 7 ], $immatriculation, $voiture[0]["photo_voiture"] ); // Marque, modèle, énergie, place et immatriculation
	}

	function uploadVoiture() {
		$uploaddir = 'assets/images/docUtilisateurs/';
		$uploadfile = $uploaddir . $_SESSION[ "nom" ] . $_SESSION[ "prenom" ] . $_SESSION[ "id_utilisateur" ] . 'photoVoiture.jpg';
		if ( move_uploaded_file( $_FILES[ 'photoVoiture' ][ 'tmp_name' ], $uploadfile ) ) {
			$this->modele->update_photo_voiture($uploadfile);
			echo '<div class="ui segment">L\'ajout de la photo de votre voiture s\'est déroulé avec succès ! Vous allez être redirigé vers votre compte.</div><meta http-equiv="refresh" content="5; URL=https://amigorapido.turtletv.fr?module=compte">';
		} else {
			echo '<div class="ui segment">Une erreur s\'est produite lors du transfert de votre carte grise ! Veuillez réessayer plus tard !</div>';
		}
	}

	function supprVoiture() {
		$this->modele->supprimer_vehicule();
		header('Location: index.php?module=compte');
	}
}
?>