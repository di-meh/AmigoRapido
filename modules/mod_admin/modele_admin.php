<?php

class ModeleAdmin extends ModeleGenerique
{
    function sendMail($to, $sujet, $msg)
    {
        $headers = "From: amigorapido@turtletv.fr\r\n";
        //$headers .= "Return-Path: The Sender <amigorapido@turtletv.fr>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "X-Priority: 1 (Highest)\n";
        $headers .= "Importance: High\n";
        $headers .= "Organization: AmigoRapido\r\n";
        mail($to, $sujet, $msg, $headers);
    }

    function mailDeleteUser($to)
    {
        //TODO remplacer le message par un vrai design 
        $message = "Nous sommes tristes de vous voir partir ! :(\nMais conformément à votre demande, votre compte AmigoRapido liée à votre adresse mail " . $to . " a été supprimé.\nEn espérant vous revoir bientôt !\nL'équipe AmigoRapido.";
        $this->sendMail($to, "Suppression de votre compte AmigoRapido", $message);
    }
    function mailDeleteTrajet($data, $email)
    {
        $message = "Votre trajet partant de " . $data[0] . " et allant à " . $data[1] . ", le " . $data[2] . " et arrivant à " . $data[3] . ", comportant " . $data[4] . " personne(s) et coûtant " . $data[5] . " euros a été correctement supprimé. Merci d'avoir pris contact avec notre support, et nous vous souhaitons une bonne navigation sur notre site.\nL'équipe AmigoRapido.";
        $this->sendMail($email, "Suppression de votre trajet chez AmigoRapido", $message);
    }

    function deleteUser($mail)
    {
        $reqDelete = self::$connexion->prepare("DELETE from utilisateur where email like :email");
        $reqDelete->execute(array('email' => $mail));
    }

    function deleteTrajet($id)
    {
        $reqDelete = self::$connexion->prepare("DELETE from trajet where id_trajet = :id");
        $reqDelete->execute(array('id' => $id));
    }

    function chercherTrajets($id)
    {
        $req = self::$connexion->prepare("SELECT * from trajet where id_conducteur = :id");
        $req->execute(array('id' => $id));
        $res = $req->fetchAll();
        return $res;
    }

    function chercherTrajetsUser($mail)
    {
        $req = self::$connexion->prepare("SELECT id_trajet, CONCAT(l1.num_rue, ' ', l1.nom_lieu, ', ', l1.nom_ville, ', ', l1.nom_pays) as lieu_depart, CONCAT(l2.num_rue, ' ', l2.nom_lieu, ', ', l2.nom_ville, ', ', l2.nom_pays) as lieu_arrivee, heureDepart, heureArrivee, nbPersonnes, prix_commission FROM `trajet` JOIN lieu l1 ON trajet.id_lieu_depart = l1.id_lieu JOIN lieu l2 on trajet.id_lieu_arrivee = l2.id_lieu join utilisateur on trajet.id_conducteur = utilisateur.id_utilisateur and utilisateur.email = :mail");
        $req->execute(array('mail' => $mail));
        $res = $req->fetchAll();
        return $res;
    }

    function infosPerso($mail)
    {
        $req = self::$connexion->prepare("SELECT id_utilisateur, nom, prenom, email from utilisateur where email like '" . $mail . "' ");
        $req->execute();
        $res = $req->fetchAll();
        return $res;
    }

    function email($email)
    {
        $req = self::$connexion->prepare("SELECT DISTINCT email from utilisateur where email like ' " . $email . "%' order by email");
        $req->execute();
        $res = $req->fetchAll();
        return $res;
    }

    function emails()
    {
        $req = self::$connexion->prepare("SELECT DISTINCT email from utilisateur order by email asc");
        $req->execute();
        $res = $req->fetchAll();
        return $res;
    }
}
