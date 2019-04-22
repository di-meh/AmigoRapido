<?php 

class VueListe extends VueGenerique{

	function __construct(){
		parent::__construct("Liste");
	}

	function vue_liste($data){
		?>

	<!-- container -->

		<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">Liste des annonces</li>
		</ol>

		<div class="row">

			<!-- Article main content -->
			<article class="col-sm-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Liste des annonces</h1>
				</header>
				<br>

				<?php $annonces = $data['lesAnnonces'];

				if(count($annonces) == 0) {
            		?>
			            <div class="alert alert-warning" role="alert">
			                Malheureusement aucun trajets n'a été trouvé pour <?php echo $data['lieuArrivee'][1] . " en partance de " . $data['lieuDepart'][1]; ?>. Nous vous conseillons d'essayer d'étendre votre recherche à une ville proche de <?php echo $data['lieuArrivee'][1]; ?>. <a href="index.php?module=recherche" class="alert-link">Cliquez ici</a> pour retourner à la recherche, sinon <a href="index.php" class="alert-link">cliquez ici</a> pour retourner au menu principal.
			            </div>
			        <?php
				} else {
					foreach ($annonces as $annonce) {
					?> <!-- Annonce -->
						<div class="col-sm-6">
							<div class="panel panel-default">
								<div class="panel-body">
									<h3 class="thin"><?php echo $data['lieuDepart'][0] . " -> " . $data['lieuArrivee'][0]; ?></h3><br>
									<div class="col-md-12">
										<div>
											<p>Départ le : <?php echo $annonce[3]?></p>
											<p>Arrivée prévue vers : <?php echo $annonce[4]?></p>
											<p>Prix de la course : <?php echo $annonce[7] . "$"?></p>
										</div>
										<a href="index.php?module=annonce&action=affichage&id=<?php echo $annonce['id_trajet']; ?>"><button class="btn btn-action pull-right" >Aller à l'annonce</button></a>
									</div>
								</div>
							</div>
						</div>
					<?php
				}
				}
				?>
			</article>
			<!-- /Article -->

		</div>
	</div>  <!-- /container -->

	<?php
	}		
}
?>