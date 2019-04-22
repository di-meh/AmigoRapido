<?php

    class ModeleAdmin extends ModeleGenerique {
        function deleteTrajet($id) {
            $reqDelete = self::$connexion->prepare("DELETE from trajet where id_trajet = :id");
            $reqDelete->execute(array('id' => $id));
        }

        function chercherTrajets($id) {
            $req = self::$connexion->prepare("SELECT * from trajet where id_conducteur = :id");
            $req->execute(array('id' => $id));
            $res = $req->fetchAll();
            return $res;
        }
    }
?>