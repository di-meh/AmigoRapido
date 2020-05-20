<?php

require_once('modele_admin.php');
require_once('vue_admin.php');

class ControleurAdmin extends ControleurGenerique
{
    function __construct()
    {
        parent::__construct(new ModeleAdmin(), new VueAdmin());
    }

    function afficherAdmin()
    {
        $this->vue->afficherAdmin();
    }
    function rechercherUtilisateur()
    {
        if (!isset($_SESSION['id_utilisateur']) || $_SESSION['est_admin'] == 0) {
            header('Location: /index.php?module=compte');
        } else {
            $data = array(
                "email" => $this->modele->emails()
            );
            $this->vue->rechercherUtilisateur($data);
        }
    }
    function afficherUtilisateur()
    {
        if (isset($_POST['emailUser'])) {
            $data = $this->modele->infosPerso($_POST['emailUser']);
            $this->vue->afficherUtilisateur($_POST['emailUser'], $data);
        } else {
            header('Location: /index.php?module=admin&action=rechercherUtilisateur');
        }
    }

    function supprimerUtilisateur()
    {
        if (isset($_POST['email'])) {
            $mail = htmlspecialchars($_POST['email']);

            $this->modele->deleteUser($mail);
            // $this->modele->mailDeleteUser($mail);
            $this->vue->confirmDeleteUser($mail);
        } else {
            header('Location: /index.php?module=admin&action=rechercherUtilisateur');
        }
    }

    function voirTrajets()
    {
        if (isset($_POST['email'])) {
            $traj_cond = $this->modele->chercherTrajetsUser($_POST['email']);
            $this->vue->afficherTrajets($traj_cond, $_POST['email']);
        } else {
            header('Location: /index.php?module=admin&action=rechercherUtilisateur');
        }
    }

    function supprimerTrajet()
    {
        $id = $_POST['trajet'];
        $data = array($_POST['lieu_depart'], $_POST['lieu_arrivee'], $_POST['heureDepart'], $_POST['heureArrivee'], $_POST['nbPersonnes'], $_POST['prix_commission']);

        $this->modele->deleteTrajet($id);
        // $this->modele->mailDeleteTrajet($data, $_POST['email']);
        $this->vue->confirmDelete();
    }

    function creerCoupon()
    {
        $this->vue->creerCoupon();
    }
}
