<?php

class ModeleTemplate extends ModeleGenerique {


    function exemple_req_bd() {
        $req = self::$connexion->prepare( "REQ BD" );
        $req->execute();
        return $req->fetchAll();
    }

   
}

?>