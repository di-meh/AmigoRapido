<?php 

	class ModuleGenerique 
	{
		protected $controleur;

		function __construct($controleur) {
			$this->controleur = $controleur;
		}

		function getControleur(){
			return $this->controleur;
		}

		function getAffichage(){
			return $this->controleur->getAffichage();
		}

	}	
		
?>
