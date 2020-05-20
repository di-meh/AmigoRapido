<?php

class VueCompte extends VueGenerique
{

	function __construct()
	{
		parent::__construct("Compte");
	}

	function vue_compte($trajet, $tableau, $possedeVoiture, $demandes)
	{
?>

		<!-- container -->
		<div class="container">

			<ol class="breadcrumb">
				<li><a href="index.php">Home</a>
				</li>
				<li class="active">Compte</li>
			</ol>

			<div class="row">

				<!-- Article main content -->
				<article class="col-sm-8 maincontent">
					<header class="page-header">
						<h1 class="page-title">
							<?php if (!isset($_SESSION['nom'])) {
								echo "Mon Compte";
							} else {
								echo $_SESSION['prenom'] . " " . $_SESSION['nom'];
							} ?>
						</h1>
					</header>
					<!-- MODIF POUR ADMIN -->
					<?php if ($_SESSION['est_admin'] == 1) {
					?>
						<h3>Admin</h3>
						<button class="ui right labeled icon button" onClick="location.href='index.php?module=admin'" style="margin-bottom: 5px; margin-top: 5px;"><i class="right key icon"></i>Gestion administrateur</button>
					<?php
					}

					?>
					<!--END MODIF POUR ADMIN -->

					<h3>Votre compte</h3><br>
					<p>Ici vous pourrez voir toutes les demandes de trajet, vos avis et quelques statistiques. Bonne navigation sur notre site !</p><br>
					<h3>Vos trajets</h3><br>

					<?php
					if (empty($trajet)) {
					?>
						<p>Vous n'avez pas encore de trajets !</p>
						<button class="ui right labeled icon button" onClick="location.href='index.php?module=deposer'" style="margin-bottom: 5px; margin-top: 5px;"><i class="right road icon"></i>Créer une demande de trajet</button>

						<?php
					} else {
						foreach ($trajet as $trajet) {
						?>
							<!-- Annonce -->
							<div class="panel panel-default">
								<div class="panel-body">
									<h3 class="thin">
										<?php echo $trajet['titre'] . " - " . $trajet['prix'] . " € "; ?>
									</h3><br>
									<p><img src="<?php
													if (empty($trajet['url'])) {
														echo " assets/images/image1.jpg ";
													} else {
														echo $trajet['url'];
													}
													?>" alt="Image" class="img-rounded pull-left" width="200">
										<?php echo $trajet['description']; ?>
									</p>
									<div class="col-md-12">
										<form method="POST" action="index.php?module=compte&action=supprimerAnnonce&id=<?php echo $trajet['idVehicules']; ?>">
											<button class="btn btn-action pull-right" type="submit">Supprimer</button>
										</form>
										<a href="index.php?module=annonce&id=<?php echo $trajet['idVehicules']; ?>"><button class="btn btn-action pull-right espace">Aller à l'annonce</button></a>
									</div>
								</div>
							</div>
					<?php
						}
					}
					?><br>

					<h3>Commentaires</h3><br>
					<button class="ui right labeled icon button" onClick="location.href='index.php?module=commentaire'" style="margin-bottom: 5px; margin-top: 5px;"><i class="right comment dot icon"></i>Commentaires</button>

					<h3>Support - Mes demandes</h3><br>
					<?php
					if (empty($demandes)) {
					?>
						<p>Vous n'avez pas encore de demandes !</p>
					<?php
					} else {
					?>
						<table class="ui celled striped table">
							<thead>
								<tr>
									<th class="collapsing">N° demande</th>
									<th>Motif</th>
									<th class="collapsing">Date demande</th>
									<th class="collapsing">Etat</th>
									<th class="collapsing">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?= $tableau ?>
							</tbody>
						</table>
					<?php
					}
					?>

				</article>
				<!-- /Article -->

				<!-- Sidebar -->
				<aside class="col-sm-4 sidebar sidebar-right">

					<div class="widget">
						<h4 class="page-header">Vos informations</h4>
						<ul class="list-unstyled list-spaces">
							<li>
								<p>Email :
									<?php echo $_SESSION['email']; ?>
								</p>
							</li>
							<li>
								<p>Téléphone :
									<?php echo $_SESSION['tel']; ?>
								</p>
							</li>
						</ul>

						<button class="ui right labeled icon button" onClick="location.href='index.php?module=compte&action=deconnexion'" style="margin-bottom: 5px; margin-top: 5px;"><i class="right door open icon"></i>Se déconnecter</button>

						<button class="ui right labeled icon button" onClick="location.href='index.php?module=compte&action=suppression'" style="margin-bottom: 5px; margin-top: 5px;"><i class="right trash alternate icon"></i>Supprimer mon compte</button>
						<br>

						<button class="ui right labeled icon button" onClick="location.href='index.php?module=support&action=redigerDemande'" style="margin-bottom: 5px; margin-top: 5px;"><i class="right question circle icon"></i>Contacter le support</button>
						<?php

						if ($possedeVoiture == 0) {
							echo '<button class="ui right labeled icon button" onClick="location.href=\'index.php?module=vehicule\'" style="margin-bottom: 5px; margin-top: 5px;"><i class="right car icon"></i>Ajouter ma voiture</button>';
						} else {
							echo '<button class="ui right labeled icon button" onClick="location.href=\'index.php?module=vehicule&action=edit\'" style="margin-bottom: 5px; margin-top: 5px;"><i class="right car icon"></i>Editer ma voiture</button>';
						}
						?>


					</div>

				</aside>
				<!-- /Sidebar -->

			</div>
		</div> <!-- /container -->

	<?php
	}

	function afficherSupp()
	{
	?>

		<div class="container">

			<ol class="breadcrumb">
				<li><a href="index.php">Home</a>
				</li>
				<li class="active">Supprimer mon compte</li>
			</ol>

			<header class="page-header">
				<h1 class="page-title">Supprimer mon compte</h1>
			</header>
			<br>
			<div class="row">
				<!-- Article main content -->
				<article class="col-sm-12 maincontent">
					<p>Etes vous sur de vouloir supprimer votre compte ?</p>
					<br>
					<a class="btn btn-default btn-lg" role="button" href="index.php?module=compte">Annuler</a>
					<a class="btn btn-default btn-lg" role="button" href="index.php?module=compte&action=supprimer">Supprimer mon compte</a>
				</article>
				<!-- /Article -->

			</div>
		</div> <!-- /container -->
	<?php
	}

	function alerte_ok($message)
	{
	?>
		<div class="alert alert-info" role="alert">
			<?= $message ?>
		</div>
	<?
	}

	function alerte_erreur($message)
	{
	?>
		<div class="alert alert-danger" role="alert">
			<?= $message ?>
		</div>
<?
	}
}
?>