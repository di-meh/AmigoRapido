<?php
class VueRecherche extends VueGenerique {


	function __construct() {
		parent::__construct();
	}

	function affichageInfoConnexion() {
		?>
		<div class="alert alert-info" role="alert">
			Il semble que vous ne soyez pas connectés, <a href="index.php?module=connexion" class="alert-link">cliquez ici</a> pour vous connecter ou créer votre compte.
		</div>
		<?php
	}


	function vue_recherche( $data ) {

		?>
		<!-- <script type="text/javascript" src="assets/js/dropdown.js"></script> -->
		<!-- container -->
		<div class="container">
			<ol class="breadcrumb">
				<li>
					<a href="index.html">Home</a>
				</li>
				<li class="active">Recherche</li>
			</ol>
			<div class="row">
				<!-- Article main content -->
				<article class="col-sm-12 maincontent">
					<header class="page-header">
						<h1 class="page-title">Rechercher une annonce</h1>
					</header>
					<p>
						Rechercher les meilleurs trajets proposés par AmigoRapido. Vous pouvez aussi utiliser les options de recherche avancées pour trouver l'annonce voulue.
					</p>
					<p>La saisie de la rue est optionelle car les trajets recherchés ne partiront et n'arriveront pas forcément aux endroits voulus.</p>
					<br><br>

					<form method="POST" action="index.php?module=recherche&action=test">
						<div class="container-fluid">
							<div class="row">
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-12">
											<h3>
                                                Lieu de départ
                                            </h3>
										

											<div class="row">

												<!-- AJAX pays départ -->
												<div class="col-md-4">
													<div class="field">
														<div id="pays" class="ui fluid selection search dropdown">
															<input value="" name="pays" type="hidden" id="paysInput">
															<i class="dropdown icon"></i>
															<i id="checkEtatPaysDpt" class="" style="float: right !important"></i>
															<div class="default text">Pays</div>
															<div id="pays-menu" class="menu">
																<?php
																$pays = $data[ 'pays' ];
																foreach ( $pays as $p ): ?>
																<div class="item" data-value="<?php echo $p['nom_pays'] ?>">
																	<?php echo $p['nom_pays'] ?>
																</div>
																<?php endforeach ?>
															</div>
														</div>
													</div>
												</div>

												<!-- AJAX villes départ -->
												<div class="col-md-4" id="dropdown-ville" style="display: none">
													<div class="field">
														<div id="villes" class="ui fluid selection search dropdown dd-ville">
															<input value="" name="ville" type="hidden" id="villeInput">
															<i class="dropdown icon"></i>
															<i id="checkEtatVilleDpt" class="" style="float: right !important"></i>
															<div class="default text">Ville</div>
															<div id="villes-menu" class="menu">
																<!-- Génération options par JS -->
															</div>
														</div>
													</div>
												</div>


												<!-- AJAX rues départ -->
												<div class="col-md-4" id="dropdown-rues" style="display: none">
													<div class="field">
														<div id="rues" class="ui fluid selection search dropdown">
															<input value="" name="rue" type="hidden" id="ruesInput">
															<i class="dropdown icon"></i>
															<i id="checkEtatRueDpt" class="" style="float: right !important"></i>
															<!--                                            <i id="checkInterroRueDpt" class="fas fa-question" style="float: right !important"></i>-->
															<div class="default text">Rue</div>
															<div id="rues-menu" class="menu">
																<!-- Génération options par JS -->
															</div>
														</div>
													</div>
												</div>

											</div>

											<!-- Label informatif sur l'existence du lieu OU non -->
											<div class="container-fluid">
												<div class="row">
													<div class="col-md-12">
														<div class="ui green large horizontal label" id="labelDeptOK" style="display: none">Le lieu de départ est correct</div>
														<div class="ui red large horizontal label" id="labelDeptPasOK" style="display: none">Le lieu de départ n'est pas correct</div>
													</div>
												</div>
											</div>

											<h3>
                                                Lieu d'arrivée
                                            </h3>
										

											<div class="row">
												<!-- AJAX pays -->
												<div class="col-md-4">
													<div class="field">
														<div id="paysDest" class="ui fluid selection search dropdown">
															<input value="" name="paysDest" type="hidden" id="paysInputDest">
															<i class="dropdown icon"></i>
															<i id="checkEtatPaysAri" class="" style="float: right !important"></i>
															<div class="default text">Pays</div>
															<div id="pays-menuDest" class="menu">
																<?php
																$pays = $data[ 'pays' ];
																foreach ( $pays as $p ): ?>
																<div class="item" data-value="<?php echo $p['nom_pays'] ?>">
																	<?php echo $p['nom_pays'] ?>
																</div>
																<?php endforeach ?>
															</div>
														</div>
													</div>
												</div>

												<!-- AJAX villes -->
												<div class="col-md-4" id="dropdown-villeDest" style="display: none">
													<div class="field">
														<div id="villesDest" class="ui fluid selection search dropdown">
															<input value="" name="villeDest" type="hidden" id="villeInputDest">
															<i class="dropdown icon"></i>
															<i id="checkEtatVilleAri" class="" style="float: right !important"></i>
															<div class="default text">Ville</div>
															<div id="villes-menuDest" class="menu">
																<!-- Génération options par JS -->
															</div>
														</div>
													</div>
												</div>

												<!-- AJAX rues -->
												<div class="col-md-4" id="dropdown-ruesDest" style="display: none">
													<div class="field">
														<div id="ruesDest" class="ui fluid selection search dropdown">
															<input value="" name="rueDest" type="hidden" id="ruesInputDest">
															<i class="dropdown icon"></i>
															<i id="checkEtatRueAri" class="" style="float: right !important"></i>
															<div class="default text">Rue</div>
															<div id="rues-menuDest" class="menu">
																<!-- Génération options par JS -->
															</div>
														</div>
													</div>
												</div>

												<!-- Label informatif sur l'existence du lieu OU non -->
												<div class="container-fluid">
													<div class="row">
														<div class="col-md-12">
															<div class="ui green large horizontal label" id="labelDestOK" style="display: none">Le lieu de destination est correct</div>
															<div class="ui red large horizontal label" id="labelDestPasOK" style="display: none">Le lieu de destination n'est pas correct</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<div class="field">
															<label>Date du départ : </label>
															<!-- <div id="date_depart">
                                                                <input class="form-control" type="text" name="date_depart" placeholder="AAAA-MM-DD HH:MI:SS">
                                                            </div> -->

															<div class="ui calendar" id="date_depart">
																<div class="ui input left icon">
																	<i class="calendar icon"></i>
																	<input name="dateDepart" class="form-control" type="text" placeholder="Date" value="">
																</div>
															</div>


														</div>
													</div>
												</div>

											</div>

											<div class="ui buttons" style="margin-top: 20px;">
												<button class="ui green labeled icon button" type="submit"><i class="search icon"></i>Rechercher un trajet</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>

				</article>
				<!-- /Article -->
			</div>
		</div> <!-- /container -->
		<?php


	}

	function affichageResultats( $data ) {
		?>
		<div style="margin-left: 15%; margin-right: 15%; margin-top: 50px;">
			<?php
			for ( $i = 0; $i < sizeof( $data ); $i++ ) {
				if ( !is_null( $data[ $i ][ 0 ][ 0 ][ "id_trajet" ] ) ) {
					?>

			<table class="ui celled table">
				<thead>
					<tr>
						<th>Adresse de départ</th>
						<th>Adresse d'arrivée</th>
						<th>Date et heure de départ</th>
						<th>Prix du voyage</th>
						<th>Préférences</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td data-label="dpt">
							<?php echo $data[ $i ][ 1 ][ 0 ][ 0 ][ "num_rue" ] . ", " . $data[ $i ][ 1 ][ 0 ][ 0 ][ "nom_lieu" ];?>,
							<?php echo $data[ $i ][ 1 ][ 0 ][ 0 ][ "nom_ville" ] . " " . $data[ $i ][ 1 ][ 0 ][ 0 ][ "nom_pays" ];?>
						</td>
						<td data-label="ar">
							<?php echo $data[ $i ][ 2 ][ 0 ][ 0 ][ "num_rue" ] . ", " . $data[ $i ][ 2 ][ 0 ][ 0 ][ "nom_lieu" ]; ?>,
							<?php echo $data[ $i ][ 2 ][ 0 ][ 0 ][ "nom_ville" ] . " " . $data[ $i ][ 2 ][ 0 ][ 0 ][ "nom_pays" ];?>
						</td>
						<td data-label="heure">
							<?php echo $data[$i][0][0]["heureDepart"];?>
						</td>
						<td data-label="prix">
							<?php echo $data[$i][0][0]["prix_commission"];?>€</td>
						<td data-label="pref">
							<p>Taille du bagage : <i class="suitcase icon"></i>
							</p>
							<p>Fumeur : <i class="red joint icon joints"></i>
							</p>
							<p>Enfant : <i class="red child icon"></i>
							</p>
						</td>
						<td><button class="ui primary button">Participer</button>
						</td>

					</tr>
				</tbody>
			</table>
			<?php }
    }?>
		</div>
		<?php
	}


}

function trash() {
	?>

	<div class="row">
		<div class="col-md-12">
			<div class="field">
				<label>Date du départ : </label>
				<!-- <div id="date_depart">
                            <input class="form-control" type="text" name="date_depart" placeholder="AAAA-MM-DD HH:MI:SS">
                        </div> -->

				<div class="ui calendar" id="date_depart">
					<div class="ui input left icon">
						<i class="calendar icon"></i>
						<input name="dateDepart" class="form-control" type="text" placeholder="Date" value="">
					</div>
				</div>


			</div>
		</div>
	</div>

	<!-- derniere ligne -->
	<div class="row">
		<div class="col-sm-6">
			<div class="field">
				<div class="col-sm-6">
					<div class="border">
						<label for="select-6">Nombre de personnes : </label>
						<select name="nombre" class="form-control" id="exampleFormControlSelect1">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6+</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="field">
				<label>Prix du trajet : </label>
				<div>
					<input class="form-control" name="prix" type="text" id="champPrix" placeholder="">
				</div>
			</div>
			<label id="champPrixInformations"></label>
		</div>
	</div>
	<!-- FIN derniere ligne -->
	</div>
	</div>
	<br>
	<br>

	<div class="row">
		<div class="col-sm-12 text-right">
			<button name="valider" id="boutonValider" class="btn btn-primary">Déposer le trajet</button>
		</div>
	</div>

	<?php
}
?>