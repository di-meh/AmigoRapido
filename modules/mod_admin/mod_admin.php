<?php

require_once('controleur_admin.php');

class ModuleAdmin extends ModuleGenerique
{

    function __construct()
    {
        parent::__construct(new ControleurAdmin());

        if (!isset($_SESSION['id_utilisateur']) || $_SESSION['est_admin'] == 0) {
            header('Location: /index.php?module=compte');
        } else if (isset($_GET['action'])) {
            $action = htmlspecialchars($_GET['action']);
            switch ($action) {
                case 'voirTrajets':
                    $this->controleur->voirTrajets();
                    break;
                case 'afficherUtilisateur':
                    $this->controleur->afficherUtilisateur();
                    break;
                case 'rechercherUtilisateur':
                    $this->controleur->rechercherUtilisateur();
                    break;
                case 'supprimerUtilisateur':
                    $this->controleur->supprimerUtilisateur();
                    break;
                case 'supprimerTrajet':
                    $this->controleur->supprimerTrajet();
                    break;
                case 'creerCoupon':
                    $this->controleur->creerCoupon();
                    break;
                default:
                    $this->controleur->afficherAdmin();
                    break;
            }
        } else {
            $this->controleur->afficherAdmin();
        }
    }
}
