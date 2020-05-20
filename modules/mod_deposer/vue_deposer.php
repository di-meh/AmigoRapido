    <?php
	// require_once( 'assets/scripts/script-calendrier.php' );

	class VueDeposer extends VueGenerique
	{

		function __construct()
		{
			parent::__construct();
		}

		function affichageInfoConnexion()
		{
	?>
    		<div class="ui info message">
    			<i class="close icon"></i>
    			<div class="header">
    				Il semble que vous ne soyez pas connectés.
    			</div>
    			<p><a href="index.php?module=connexion" class="alert-link">Cliquez ici</a> pour vous connecter ou créer votre compte.</p>
    		</div>
    	<?php
		}

		function affichageErreur()
		{
		?>
    		<div class="ui negative message">
    			<i class="close icon"></i>
    			<div class="header">
    				Il y a eu une erreur dans l'annonce.
    			</div>
    			<p><a href="index.php?module=deposer" class="alert-link">Cliquez ici</a> pour retourner au déot d'annonces.</p>
    		</div>
    	<?php
		}

		function vue_formDepotAnnonce($data)
		{
		?>
    		<!-- container -->
    		<div class="container">
    			<ol class="breadcrumb">
    				<li><a href="index.html">Home</a>
    				</li>
    				<li class="active">Déposer</li>
    			</ol>
    			<div class="row">
    				<!-- Article main content -->
    				<article class="col-sm-12 maincontent">
    					<header class="page-header">
    						<h1 class="page-title">Déposer une annonce</h1>
    					</header>
    					<p>
    						Plus votre annonce sera complète et précise, plus elle sera consultée. Veillez donc à bien remplir tous les champs.
    					</p>
    					<br><br>
    					<!-- <form method="" action=""> -->
    					<form method="POST" action="index.php?module=deposer&action=soumettreInformationTrajet">
    						<div class="row">
    							<div class="col-sm-12">
    								<label>Information du départ</label><br>
    								<!-- AJAX pays départ -->
    								<div class="col-md-4">
    									<div class="field">
    										<div id="pays" class="ui fluid selection search dropdown">
    											<input value="" name="pays" type="hidden" id="paysInput">
    											<i class="dropdown icon"></i>
    											<i id="checkEtatPaysDpt" class="" style="float: right !important"></i>
    											<div class="default text">Pays</div>
    											<div id="pays-menu" class="menu">
    												<?php $pays = $data['pays'];
													foreach ($pays as $p) : ?>
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
    											<!--											<i id="checkInterroRueDpt" class="fas fa-question" style="float: right !important"></i>-->
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


    						</div>
    						<br>
    						<div class="row">
    							<div class="col-sm-12">
    								<label>Information de la destination</label><br>
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
													$pays = $data['pays'];
													foreach ($pays as $p) : ?>
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

    			</div>
    			<br>
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

    			<!-- DEBUT preferences-->
    			<div class="container-fluid">
    				<div class="row">
    					<div class="col-md-12 pt-3">
    						<header class="page-header">
    							<h1 class="page-title">Préférences pour le trajet</h1>
    						</header>
    						<p>De base toutes les préférences sont mises à non. Si vous souhaitez les laisser telles quelles, ne touchez à aucun bouton.</p>
    					</div>
    				</div>
    				<div class="row">
    					<div class="col-md-4">
    						<div class="inline field">
    							<div class="ui checkbox">
    								<input name="fumeur" id="fumeur" type="checkbox" tabindex="0" class="hidden form-control">
    								<label>Fumeur</label>
    							</div>
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="col-md-4">
    							<div class="inline field">
    								<div class="ui checkbox">
    									<input name="enfant" type="checkbox" tabindex="0" class="hidden form-control">
    									<label>Enfant</label>
    								</div>
    							</div>
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="col-md-4">
    							<div class="inline field">
    								<div class="ui checkbox">
    									<input name="animal" type="checkbox" tabindex="0" class="hidden form-control">
    									<label>Animal</label>
    								</div>
    							</div>
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="inline field">
    							<label for="select-6">Taille de la valise</label>
    							<select name="tailleValise" class="form-control" id="exampleFormControlSelect1" value="0">
    								<option value="0">Petite taille</option>
    								<option value="1">Moyenne taille</option>
    								<option value="2">Grande valise</option>
    							</select>
    						</div>
    					</div>
    				</div>
    				<!-- FIN preferences-->
    				<div class="ui buttons" style="margin-top: 20px;">
    					<button class="ui green labeled icon button" type="submit"><i class="plus icon"></i>Ajouter le trajet</button>
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

		function vue_validationTrajet()
		{
		?>
    		<div class="ui success message">
    			<i class="close icon"></i>
    			<div class="header">
    				Votre annonce a bien été prise en compte !
    			</div>
    			<p> <a href="index.php" class="alert-link">cliquez ici</a> pour revenir à l'accueil.</p>
    		</div>
    <?php
		}
	}
	?>