<?php 


class VueGenerique 
{


	function __construct()
	{
		ob_start();
	}



	function getAffichage() {
		return ob_get_clean();
	}

}

?>
