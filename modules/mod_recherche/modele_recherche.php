<?php
		
class ModeleRecherche extends ModeleGenerique {
		
	function trajet() {
		$req = self::$connexion->prepare("SELECT * FROM trajet ORDER BY heureDepart");
		$req->execute();
		$resultat = $req->fetchAll();
		return $resultat; 
	}

	function lieux() {
		// $req = self::$connexion->prepare("select num_rue, nom_lieu, nom_ville, nom_pays from lieu ORDER BY nom_ville");
		//nom_ville like 'Montreuil' AND nom_pays like 'France'
		//select id_lieu from lieu where nom_pays like 'France' AND nom_ville like 'Montreuil' AND nom_lieu like 'Place Jean Jaurès'
		//"select id_lieu from lieu where nom_lieu like 'Place Jean Jaurès' AND nom_ville like 'Montreuil' AND nom_pays like 'France'"
		
	}

	function chercheTrajet($pD, $vD, $pA, $vA, $dt) {
		$fArray = array(
			"lieuxDepart" => array($this -> chercheLieux($pD, $vD)),
			"lieuxArrive" => array($this -> chercheLieux($pA, $vA))
		);

		// var_dump($fArray["lieuxArrive"]);

		/*echo "<br /><br />";
		var_dump($fArray);
		echo "<br /><br />";
		
		echo '<br><br>'.json_encode($fArray, JSON_FORCE_OBJECT).'<br><br>';


		echo "<br />On a comme id lieu : " . $fArray["lieuxArrive"][0][0][0];
		echo "<br />On a comme id lieu : " . $fArray["lieuxArrive"][0][1][0];
		echo "<br />On a comme id lieu : " . $fArray["lieuxArrive"][0][2][0];

		echo "<br />On a une taille de : " . sizeof($fArray["lieuxArrive"][0]);*/

		$arrayD = array();
		for ($i=0; $i < count($fArray["lieuxDepart"][0]) ; $i++) {
			$tmp = $fArray["lieuxDepart"][0][$i][0];
			array_push($arrayD, $tmp);
		}

		$arrayA = array();
		for ($i=0; $i < sizeof($fArray["lieuxArrive"][0]); $i++) { 
			array_push($arrayA, $fArray["lieuxArrive"][0][$i][0]);
		}

		$arrayFinal = array(
			"lieuxDepart" => $arrayD,
			"lieuxArrive" => $arrayA
		);

		$arrayTrajets = array();
		for ($i=0; $i < sizeof($arrayFinal["lieuxDepart"]); $i++) { 
			for ($j=0; $j < sizeof($arrayFinal["lieuxArrive"]); $j++) {
				$tmp = $this -> matchTrajet($arrayFinal["lieuxDepart"][$i], $arrayFinal["lieuxArrive"][$j], $dt);

				$lieuDep = array($this -> chercheLieuxAll($arrayFinal["lieuxDepart"][$i]));
				$lieuArr = array($this -> chercheLieuxAll($arrayFinal["lieuxArrive"][$i]));

				$arraygnl = array($tmp, $lieuDep, $lieuArr);

				array_push($arrayTrajets, $arraygnl);
			}
		}

		return $arrayTrajets;
	}

	function matchTrajet($iD, $iA, $dt) {
		$req = self::$connexion->prepare( 'SELECT * FROM trajet WHERE id_lieu_depart = :d AND id_lieu_arrivee = :a AND heureDepart >= :t' );
		//
		$req->bindParam( ':d', $iD );
		$req->bindParam( ':a', $iA );
		$req->bindParam( ':t', $dt );
		$req->execute();

		$res = $req->fetchAll();

		if(sizeof($res) != 0) {
			return $res;
		} else {
			return null;
		}
	}

	function chercheLieux($p, $v) {
		$req = self::$connexion->prepare( 'SELECT id_lieu FROM lieu WHERE nom_ville = :v AND nom_pays = :p' );
		//
		$req->bindParam( ':v', $v );
		$req->bindParam( ':p', $p );
		$req->execute();

		return $req->fetchAll();
	}

	function chercheLieuxAll($i) {
		$req = self::$connexion->prepare( 'SELECT * FROM lieu WHERE id_lieu = :id' );
		//
		$req->bindParam( ':id', $i );
		$req->execute();

		return $req->fetchAll();
	}


	function formateDate($date) {
		$find = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
		$replace = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'Decqember');
		$date = str_replace($find, $replace, strtolower($date));
		return date('Y-m-d H:i:s', strtotime($date));
	}

	function vrdmp() {
		$req = self::$connexion->prepare(
			"select * from lieu"
		);
		$req->execute();
		$resultat = $req->fetchAll();

		var_dump($resultat);

		//echo '</br>' . $resultat[0][0];

		return $resultat; 
	}
}
?>