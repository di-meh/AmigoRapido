<?php 

	
	class ControleurGenerique 
	{
		protected $modele;
		protected $vue;

		function __construct($modele, $vue) {
			$this->modele = $modele;
			$this->vue = $vue;
		}



		function getModele(){
			return $this->modele;
		}

		function getVue(){
			return $this->vue;
		}

		function getAffichage() {
			return $this->vue->getAffichage();
		}
		
	}

 ?>