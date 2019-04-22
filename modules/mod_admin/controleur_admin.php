<?php

    require_once('modele_admin.php');
    require_once('vue_admin.php');

    class ControleurAdmin extends ControleurGenerique {
        function __construct() {
            parent::__construct(new ModeleAdmin(), new VueAdmin());
        }
        
        function afficherConnexion() {
            $this->vue->affichageInfoConnexion();
        }
        function afficherAdmin() {
            $this->vue->afficherAdmin();
        }
        function afficherTrajet() {
            $this->vue->entrerID();
        }

        function supprimerTrajet() {
            $id = $_POST['idconducteur'];
            
            $resulttrajets = $this->modele->chercherTrajets($id);
            $this->vue->afficherTrajets($resulttrajets);

        }

        function supprimerTrajetId($id) {
            $this->modele->deleteTrajet($id);
            $this->vue->confirmDelete();
        }
    }


?>