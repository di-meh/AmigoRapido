<?php

class VueVehicule extends VueGenerique {

	function __construct() {
		parent::__construct( "Vehicule" );
	}

	function accueil_vehicule( $listeVehicule ) {
		?>
		<link href="assets/css/vehicules.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/module_voiture.js"></script>

		<section id="corps">
			<div class="ui breadcrumb">
				<a class="section" href="index.php">Accueil</a>
				<i class="right chevron icon divider"></i>
				<div class="active section">Véhicule</div>
			</div>

			<form enctype="multipart/form-data" action="index.php?module=vehicule&action=modifierVehicule" method="post" id="formVoitureUpdate">
				<div class="ui grid">
					<div class="four wide column"></div>
					<div class="eight wide column carte-voiture">
						<h2 class="ui center aligned icon header"><i class="circular car icon"></i>Gestion des véhicules</h2>
						<div class="ui divider"></div>
						<div class="ui fluid search selection dropdown">
							<input name="voiture" type="hidden" id="voiture">
							<div class="default text">Selectionnez la voiture</div>
							<i class="dropdown icon"></i>
							<div class="menu">
								<?=$listeVehicule?>
							</div>
						</div>
						<br>
						<div class="ui grid">
							<div class="eight wide column">
								<div class="ui fluid search selection dropdown couleurs">
									<input name="couleur" type="hidden" id="couleur">
									<div class="default text">Selectionnez la couleur</div>
									<i class="dropdown icon"></i>
									<div class="menu">
										<div class="item" data-value="0">
											<div class="ui black empty circular label"></div>Noir</div>
										<div class="item" data-value="1">
											<div class="ui white empty circular label"></div>Blanc</div>
										<div class="item" data-value="2">
											<div class="ui grey empty circular label"></div>Gris</div>
										<div class="item" data-value="3">
											<div class="ui red empty circular label"></div>Rouge</div>
										<div class="item" data-value="4">
											<div class="ui yellow empty circular label"></div>Jaune</div>
										<div class="item" data-value="5">
											<div class="ui orange empty circular label"></div>Orange</div>
										<div class="item" data-value="6">
											<div class="ui pink empty circular label"></div>Rose</div>
										<div class="item" data-value="7">
											<div class="ui blue empty circular label"></div>Bleu</div>
										<div class="item" data-value="8">
											<div class="ui green empty circular label"></div>Vert</div>
									</div>
								</div>
							</div>
							<div class="eight wide column">
								<div class="ui left icon input" style="border: 1px solid rgba(34,36,38,.15); border-radius: 5px; width: 100%;">
									<input type="text" placeholder="Plaque d'immatriculation" name="immatriculation" id="immatriculation">
									<i class="car icon"></i>
								</div>
							</div>
						</div>
						<br>
						<div class="ui large buttons fluid">
							<button class="ui button btnPc" style="width: 50%" type="button">Permis de conduire</button>
							<input type="file" class="pc" name="pc" style="display: none" id="pc">
							<div class="or" data-text="et"></div>
							<button class="ui button btnCg" style="width: 50%" type="button">Carte grise</button>
							<input type="file" class="cg" name="cg" style="display: none" id="cg">
						</div>
						<p style="margin-top: 5px;"><em>Formats acceptés : <code>.jpg</code>, <code>.jpeg</code> et <code>.png</code></em>
						</p>

						<div style="text-align: center">
							<button class="ui green elastic loading button" id="btnLoading" type="button" style="display: none">Loading</button>
							<button class="ui green button" type="button" id="btnSubmit">Ajouter</button>
							<button class="ui red button" type="button" onClick="window.location.href = 'index.php?module=compte'">Annuler</button>
						</div>
					</div>
					<div class="four wide column"></div>
				</div>
			</form>
		</section>

		<?php
	}

	function mon_vehicule( $marque, $modele, $energie, $place, $immatriculation, $photo ) {
		?>
		<link href="assets/css/vehicules.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/module_voiture.js"></script>

		<section id="corps">
			<div class="ui breadcrumb">
				<a class="section" href="index.php">Accueil</a>
				<i class="right chevron icon divider"></i>
				<div class="active section">Mon véhicule</div>
			</div>

			<div class="ui grid">
				<div class="four wide column"></div>
				<div class="eight wide column carte-voiture">
					<h2 class="ui center aligned icon header"><i class="circular car icon"></i>Mon véhicule</h2>
					<div class="ui divider"></div>
					<br>
					<div class="ui grid" style="text-align: center">
						<div class="eight wide column">
							<p><u>Marque :</u> <br>
								<strong>
									<?=$marque?>
								</strong>
							</p>
						</div>
						<div class="eight wide column">
							<p><u>Modèle :</u> <br>
								<strong>
									<?=$modele?>
								</strong>
							</p>
						</div>
					</div>

					<div class="ui grid" style="text-align: center">
						<div class="eight wide column">
							<p><u>Energie :</u> <br>
								<strong>
									<?=$energie?>
								</strong>
							</p>
						</div>
						<div class="eight wide column">
							<p><u>Nombre de place :</u> <br>
								<strong>
									<?=$place?>place(s)</strong>
							</p>
						</div>
					</div>

					<!-- Plaque d'immatriculation -->
					<div class="ui grid" style="text-align: center">
						<div id="immatriculation">
							<img src="assets/images/plaque_immatriculation.png" alt="immatriculation" style="width:40%;">
							<div class="centered">
								<span id="lettres1">
									<?=$immatriculation[0]?>
								</span> -
								<span id="chiffre">
									<?=$immatriculation[1]?>
								</span> -
								<span id="chiffre2">
									<?=$immatriculation[2]?>
								</span>
							</div>
						</div>
					</div>
					<br>
					<div style="text-align: center">
						<form action="index.php?module=vehicule&action=uploadPhoto" enctype="multipart/form-data" method="post" id="formulaireUploadPhoto">
							<input type="file" id="inputPhotoVoiture" name="photoVoiture" style="display: none">
							<button class="ui blue labeled icon button" type="button" id="uploadImageVoiture"><i class="upload icon"></i>Ajouter une photo</button>
							<button class="ui circular green icon button" id="btnSavePhoto" type="button" title="Sauvegarder les modifications"><i class="save icon"></i></button>
							<button class="ui circular blue icon button" type="button" title="Modifier la voiture" onClick="window.location.href='index.php?module=vehicule'"><i class="edit icon"></i></button>
							<button class="ui circular red icon button" id="btnSupprVoiture" type="button" title="Supprimer la voiture"><i class="trash icon"></i></button>
							<input type="hidden" name="idUser" value="<?=$_SESSION[" id_utilisateur "];?>">
						</form>
						<div style="margin-top: 10px;">
							<em>
								<p>Format accepté <code>.jpeg</code>, <code>.jpg</code> et <code>.png</code>
								</p>
							</em>
						</div>
					</div>
					<?php if(strlen($photo) > 0) echo '<br><img src="'.$photo.'" alt="voiture" style="border-radius:10px;-webkit-box-shadow: 2px 2px 5px 0px rgba(0,0,0,0.4);-moz-box-shadow: 2px 2px 5px 0px rgba(0,0,0,0.4);box-shadow: 2px 2px 5px 0px rgba(0,0,0,0.4);">';?>
					<div class="ui basic modal" id="modalSupprVoiture">
						<div class="ui icon header">
							<i class="trash alternate icon"></i> Supprimer voiture
						</div>
						<div class="content">
							<p>Voulez-vous vraiment supprimer votre véhicule ?</p>
						</div>
						<div class="actions">
							<div class="ui red basic cancel inverted button">
								<i class="remove icon"></i> Non
							</div>
							<div class="ui green ok inverted button" id="confirmDeleteVoiture">
								<i class="checkmark icon"></i> Oui
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php
	}
}

?>