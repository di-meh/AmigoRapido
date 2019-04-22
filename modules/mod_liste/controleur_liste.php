<?php 

require_once('modules/mod_liste/modele_liste.php');
require_once('modules/mod_liste/vue_liste.php');


class ControleurListe extends ControleurGenerique
{

	function __construct(){
		parent::__construct(new ModeleListe(),new VueListe());
	}

	function afficherListe() {

		if(isset($_POST['depart']) && isset($_POST['arrivee'])) {
			
			$choix = array();

			$val_depart;
			$val_arrivee;

			foreach ($_POST as $key => $value) {
				switch ($key) {
					case 'depart':

					if(!empty($value)){
						$lieux = explode(',', $value);

						$val_depart = $this->modele->reccupereInformation($lieux[0], $lieux[1], $lieux[2]);	
					}
					
					break;

					case 'arrivee':
					if(!empty($value)){
						$lieux = explode(',', $value);

						$val_arrivee = $this->modele->reccupereInformation($lieux[0], $lieux[1], $lieux[2]);
					}
					break;
				}
			}
			$data = array(
				"lesAnnonces" => $this->modele->recupere_lesAnnonces($val_depart, $val_arrivee),
				"lieuDepart" => $this->modele->recupere_lesLieux($val_depart),
				"lieuArrivee" => $this->modele->recupere_lesLieux($val_arrivee));

			$this->vue->vue_liste($data);

		} else {
			$this->vue->vue_liste($data);
		}

	}
	
	
}
?>