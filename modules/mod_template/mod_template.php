<?php

require_once('controleur_template.php');

class ModuleTemplate extends ModuleGenerique
{

    function __construct()
    {
        parent::__construct(new ControleurTemplate());

        if (!isset($_SESSION['id_utilisateur']) || $_SESSION['est_admin'] == 0) {
            header('Location: /index.php?module=compte');
        } else if (isset($_GET['action'])) {
            $action = htmlspecialchars($_GET['action']);
            // Différentes actions
            switch ($action) {
				case '':
					// TODO
					break;
            }
        } else {
			// TODO
        }
    }
}

?>
