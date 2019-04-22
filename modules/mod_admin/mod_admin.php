<?php

    require_once('controleur_admin.php');

    class ModuleAdmin extends ModuleGenerique {

        function __construct() {
            parent::__construct(new ControleurAdmin());

            if (!isset($_SESSION['id_utilisateur']) || $_SESSION['estAdmin']==0) {
                $this->controleur->afficherConnexion();
            }
            else if (isset($_GET['action'])) {
                $action = htmlspecialchars($_GET['action']);
                switch($action) {
                    case 'afficherTrajet':
                    $this->controleur->afficherTrajet();
                    break;

                    case 'supprimerTrajet':
                    $this->controleur->supprimerTrajet();
                    if(isset($_GET['id'])) {
                        $this->controleur->supprimerTrajetId($_GET['id']);
                    }
                    break;

                    default:
                    $this->controleur->afficherAdmin();
                    break;
                }

            }else {
                $this->controleur->afficherAdmin();
            }
        }

    }
?>