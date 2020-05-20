<?php

require_once('controleur_support.php');

class ModuleSupport extends ModuleGenerique
{

    function __construct()
    {
        parent::__construct(new ControleurSupport());

        if (!isset($_SESSION['id_utilisateur']) || $_SESSION['est_admin'] == 0) {
            header('Location: /index.php?module=compte');
        } else if (isset($_GET['action'])) {
            $action = htmlspecialchars($_GET['action']);
            // Différentes actions
            switch ($action) {
				case 'consulter':
					$this->controleur->consulter_admin();
					break;
                case 'supprimer':
                    $this->controleur->supprimer_demande();
                    break;
                case 'fermer':
                    $this->controleur->fermer_demande();
                    break;
                case 'repondre':
                    $this->controleur->repondre_demande();
                    break;  
                case 'redigerDemande':
                    $this->controleur->rediger_demande();
                    break;
                case 'envoyerDemande':
                    $this->controleur->envoyer_demande();
                    break;
                case 'consulterClient':
                    $this->controleur->consulter_client();
                    break;
                case 'repondreClient':
                    $this->controleur->repondre_demandeClient();
                    break; 
            }
        } else {

            $this->controleur->accueil_support();
        }
    }
}

?>
