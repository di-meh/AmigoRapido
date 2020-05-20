<meta charset="UTF-8">
<?php

require_once( 'modele_compte.php' );
require_once( 'vue_compte.php' );

class ControleurCompte extends ControleurGenerique {

	function __construct() {
		parent::__construct( new ModeleCompte(), new VueCompte() );
	}


	function afficherCompte() {
		$voiture = $this->modele->recupereVehicule( $_SESSION[ 'id_utilisateur' ] );

		$demandes = $this->modele->recupDemandesById( $_SESSION[ "id_utilisateur" ] );
		$tableau = "";
		foreach ( $demandes as $key => $value ) {
			switch ( $value[ 'etat_demande' ] ) {
				case 0:
					$etat = "En attente";
					break;
				case 1:
					$etat = "Pris en charge";
					break;
				case 2:
					$etat = "Résolu";
					break;
			}
			$date = date_create_from_format( 'Y-m-d H:i:s', $value[ 'date_demande' ] );
			$date = date_format( $date, 'd/m/Y à H:i' );
			$tableau = $tableau . '<tr><td class="collapsing">' . $value[ 'id_demande' ] . '</td><td>' . $value[ 'motif' ] . '</td><td class="collapsing">' . $date . '</td><td class="collapsing">' . $etat . '</td><td class="collapsing" style="text-align= center;"><a href="?module=support&action=consulterClient&id=' . $value[ 'id_demande' ] . '"><i class="folder open icon" title="Consulter"></i></a>';
		}

		// Vérification si utilisateur possède une voiture
		$possedeVoiture = $this->modele->possedeVoiture( $_SESSION[ 'id_utilisateur' ] );

		$this->vue->vue_compte( $voiture, $tableau, $possedeVoiture[ 0 ][ 0 ], $demandes);
	}

	function deconnexion() {
		session_destroy();
		$_SESSION = [];
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
	}

	function suppression() {
		$this->vue->afficherSupp();
	}

	function confirmerSuppression() {
		$this->modele->supprimer( $_SESSION[ 'id' ] );
	}

	function supprimerAnnonce( $id ) {
		$this->modele->supprimerAnnonce( $id );
	}


	function confirmerCompte() {
		if ( isset( $_GET[ "c" ] ) ) {
			$cle = htmlspecialchars( $_GET[ "c" ] );
			if ( $cle == "" || strlen( $cle ) != 32 ) {
				$this->vue->alerte_erreur( "Oups ! Cette clé n'est pas valide !" );
			} else {
				$date = strtotime( $this->modele->recupDateExp( $this->modele->recupIdAvecCle( $cle )[ 0 ] )[ 0 ] );
				$date2 = strtotime( date( "Y-m-d H:i:s" ) );
				if ( $date > $date2 ) {
					$this->modele->confirmerCompte( $cle );
					$this->vue->alerte_ok( 'Votre compte a été confirmé avec succès ! Cliquez <a href="index.php?module=connexion">ici</a> pour accéder à votre espace personnel !' );
				} else {
					$_SESSION[ "email" ] = $this->modele->recupEmailAvecId( $this->modele->recupIdAvecCle( $cle )[ 0 ] )[ 0 ];
					$this->vue->alerte_erreur( 'Oups ! La lien de confirmation a  expiré ! Cliquez <a href="index.php?module=mailing&action=confirmationCompte">ici</a> pour renvoyer un mail de confirmation' );
				}
			}
		} else {
			$this->vue->alerte_erreur( 'Oups ! Vous n\'avez rien à faire ici ! Cliquez <a href="index.php">ici</a> pour retourner à  l\'accueil' );
		}
	}
}
?>