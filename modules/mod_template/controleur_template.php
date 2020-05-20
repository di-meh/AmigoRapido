<?php
require_once( 'modele_template.php' );
require_once( 'vue_template.php' );

class ControleurTemplate extends ControleurGenerique {
    function __construct() {
        parent::__construct( new ModeleTemplate(), new VueTemplate() );
	}
}
?>