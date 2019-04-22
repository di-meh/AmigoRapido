<?php


class VueAccueil extends VueGenerique {

	function __construct() {
		parent::__construct("Accueil");
	}

	function vue_accueil() {
		?>

		<!-- Header -->
		<header id="head">
			<div class="container">
				<div class="row">
					<h1 class="lead">Voyager d'une manière simple et peu coûteuse tout en faisant de superbes rencontres !</h1>
					<p class="tagline">Soyez éco-friendly grâce à Amigo Rapido !</p>
				</div>
			</div>
		</header>
		<!-- /Header -->

		<!-- Intro -->
		<div class="container text-center">
			<br> <br>
			<h2 class="thin">Créer votre compte , déposer ou chercher et vous voilà sur les routes ! </h2>
			<p class="text-muted">
				C'est simple , essayez ! 
			</p>
		</div>
		<!-- /Intro-->
		
		<!-- Highlights - jumbotron -->
		<div class="jumbotron top-space">
			<div class="container">

				<h3 class="text-center thin">Pourquoi choisir Amigo Rapido ?</h3>

				<div class="row">
					<div class="col-md-3 col-sm-6 highlight">
						<div class="h-caption"><h4><i class="fa fa-cogs fa-5"></i>Facile d'utilisation</h4></div>
						<div class="h-body text-center">.
							<p>Les démarches sont faciles , rapides et vous permettent de vous mettre en liaison avec des conducteurs et passagers en quelques minutes</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 highlight">
						<div class="h-caption"><h4><i class="fa fa-flash fa-5"></i>Eco-responsable</h4></div>
						<div class="h-body text-center">
							<p>Réduisez les consommations de nos énergies au travers du co-voiturage .</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 highlight">
						<div class="h-caption"><h4><i class="fa fa-heart fa-5"></i>De superbes rencontres</h4></div>
						<div class="h-body text-center">
							<p>Vous gagnez de l'argent , mais aussi des amis ! C'est pas beau ça ? </p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 highlight">
						<div class="h-caption"><h4><i class="fa fa-smile-o fa-5"></i>Toujours à l'écoute</h4></div>
						<div class="h-body text-center">
							<p>Votre voyage était super ? Ou au contraire rien n'allait ...? Dans tous les cas , faites parvenir vos avis sur le site afin d'en informer les autres utilisateurs ! De plus , une assistance clientèle est présente pour s'assurer du bon fonctionnement de votre voyage !</p>
						</div>
					</div>
				</div> <!-- /row  -->

			</div>
		</div>
		<!-- /Highlights -->

				<?php
	}

	//Affichage d'annonces de trajets
	function vue_Annonces($annonces) {

?>

		<!-- container -->
		<div class="container">

			<div class="row">

				<!-- Article main content -->
				<article class="col-sm-12 maincontent">
					<header class="page-header">
						<h1 class="page-title">Quelques trajets</h1>
					</header>
					<br>

					<?php 
					foreach ($annonces as $annonce) {
						?> <!-- Annonce -->
						<div class="col-sm-6">
							<div class="panel panel-default">
								<div class="panel-body">
									<h3 class="thin"><?php echo $annonce['titre']." - ".$annonce['prix']." €"; ?></h3><br>
									<p><img src="<?php 
									if (empty($annonce['url'])) {
										echo "assets/images/image1.jpg";
									} else {
										echo $annonce['url'];
									}
									?>" alt="Image" class="img-rounded pull-left" style="width : 200px; height: 150px;"> <?php echo $annonce['description']; ?> </p>
									<div class="col-md-12">
										<a href="index.php?module=annonce&id=<?php echo $annonce['idVehicules']; ?>"><button class="btn btn-action pull-right" >Aller à l'annonce</button></a>
									</div> 
								</div>
							</div>
						</div>
						<?php
					}
					?>

					/

				</article>
				<!-- /Article -->

			</div>
		</div>	<!-- /container -->

		<?php
	}
}
?>