<?php

session_start();
require_once( 'include/modele_generique.php' );
require_once( 'include/vue_generique.php' );
require_once( 'include/controleur_generique.php' );
require_once( 'include/module_generique.php' );

$connexion = new ModeleGenerique();
$connexion->init();

$nom_module = "accueil";

if ( isset( $_GET[ 'module' ] ) ) {

	$nom_module = htmlspecialchars( $_GET[ 'module' ] );
}

switch ( $nom_module ) {

	case 'connexion':
		if ( !isset( $_SESSION[ 'nom' ] ) ) {
			require_once( 'modules/mod_connexion/mod_connexion.php' );
			$module = new ModuleConnexion();
		} else {
			header( 'Location: /index.php?module=compte' );
		}
		break;

	case 'accueil':
		require_once( 'modules/mod_accueil/mod_accueil.php' );
		$module = new ModuleAccueil();
		break;

	case 'deposer':
		require_once( 'modules/mod_deposer/mod_deposer.php' );
		$module = new ModuleDeposer();
		break;

	case 'liste':
		require_once( 'modules/mod_liste/mod_liste.php' );
		$module = new ModuleListe();
		break;


	case 'annonce':
		require_once( 'modules/mod_annonce/mod_annonce.php' );
		$module = new ModuleAnnonce();
		break;

	case 'compte':
		if ( isset( $_SESSION[ 'email' ] ) ) {
			require_once( 'modules/mod_compte/mod_compte.php' );
			$module = new ModuleCompte();
		} else {
			header( 'Location: index.php?module=connexion' );
		}
		break;

	case 'recherche':
		require_once( 'modules/mod_recherche/mod_recherche.php' );
		$module = new ModuleRecherche();
		break;

	case 'admin':
		if ( isset( $_SESSION[ 'nom' ] ) ) {
			require_once( 'modules/mod_admin/mod_admin.php' );
			// require_once( 'test/admin.php' );
			$module = new ModuleAdmin();
		} else {
			header( 'Location: /index.php?module=compte' );
		}
		break;

	case 'mailing':
		require_once( 'modules/mod_mailing/mod_mailing.php' );
		$module = new ModuleMailing();
		break;

	case 'support':
		if ( isset( $_SESSION[ 'nom' ] ) ) {
			require_once( 'modules/mod_support/mod_support.php' );
			$module = new ModuleSupport();
		} else {
			header( 'Location: /index.php?module=compte' );
		}
		break;

	case 'vehicule':
		if ( isset( $_SESSION[ 'nom' ] ) ) {
			require_once( 'modules/mod_vehicule/mod_vehicule.php' );
			$module = new ModuleVehicule();
		} else {
			header( 'Location: /index.php?module=compte' );
		}
		break;

	default:
		require_once( 'modules/mod_accueil/mod_accueil.php' );
		$module = new ModuleAccueil();
		break;
}


$content = $module->getAffichage();
require( 'template.php' );

var_dump( $_SESSION );
echo '<br/>';
var_dump( $_POST );
?>