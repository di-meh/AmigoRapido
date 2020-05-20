<?php

class VueAdmin extends VueGenerique
{

	function __construct()
	{
		parent::__construct("Admin");
	}

	// Différentes fonctions pour le module admin:
	/*
	            - Rechercher et supprimer des utilisateurs
	                - Faire un formulaire (sous ajax) qui prend adresse mail pour le trouver. (ou utiliser id pour trouver directement utilisateur)
	                - Pour chaque résultat, afficher un bouton supprimer utilisateur (on click prompt js pour prévenir de la suppression + alert pour confirmer suppression)
	            - Rechercher et supprimer des trajets
	                - mm principe, utiliser lieu depart lieu arrivée heure depart nb personnes utilisateur etc en ajax
	                - puis supprimer trajet à chaque résultat
	        */

	function afficherAdmin()
	{
?>
		<div class="container">

			<ol class="breadcrumb">
				<li><a href="index.php">Home</a>
				</li>
				<li class="active">Admin</li>
			</ol>

			<div class="row">

				<article class="col-sm-8 maincontent">
					<header class="page-header">
						<h1 class="page-title">Admin</h1>
					</header>
					<p>Bienvenue sur la page admin.</p>
					<div class="three ui buttons">
						<button class="ui button" onclick="location.href='index.php?module=admin&action=rechercherUtilisateur'">Afficher les utilisateurs</button>
						<button class="ui button" onclick="location.href='index.php?module=admin&action=creerCoupon'">Créer un coupon</button>
						<button class="ui button" onclick="location.href='index.php?module=support'">Support</button>
					</div>

				</article>
			</div>
		</div>
	<?php
	}

	function rechercherUtilisateur($data)
	{
		// $show = "none";
		// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// 	$show = "block";
		// }
	?>

		<!-- Container -->
		<div class="ui container">
			<ol class="breadcrumb">
				<li><a href="index.php">Home</a>
				</li>
				<li class="active">Admin</li>
			</ol>
			<div class="row">
				<article class="col-md-12 maincontent">
					<header class="page-header">
						<h1 class="page-title">Rechercher un utilisateur</h1>
					</header>
					<form role="form" action="index.php?module=admin&action=afficherUtilisateur" method="POST" class="ui form" id="formRecherchUser">
						<!-- <div class="ui form"> -->
						<div class="field">
							<label>Veuillez entrer l'adresse mail de l'utilisateur:</label>
							<select class="ui search dropdown" id="emaildrop" name="emailUser" required>
								<option value="">Adresse mail </option>
								<?php $email = $data['email'];
								foreach ($email as $e) {
								?>
									<option value="<?= $e['email'] ?>">
										<?= $e['email'] ?>
									</option>
								<?php }
								?>

							</select>
						</div>
						<button type="submit" class="ui button">
							Rechercher
						</button>
						<!-- </div> -->
					</form>
				</article>

			</div>
		</div>
	<?php
	}



	function afficherUtilisateur($email, $data)
	{
	?>
		<!-- Regarder main.css, c'est là que les tables sont giga moches -->
		<div class="container">
			<ol class="breadcrumb">
				<li><a href="index.php">Home</a>
				</li>
				<li class="active">Admin</li>
			</ol>
			<div class="row">
				<article class="col-md-12 maincontent">
					<header class="page-header">
						<h1 class="page-title">Utilisateur</h1>
					</header>
					<form role="form" method="POST" action="index.php?module=admin&action=voirTrajets">
						<input type="hidden" name="email" value="<?= $email ?>">
						<table class="ui celled table">
							<thead class="thead-light">
								<tr>
									<th>
										#id
									</th>
									<th>
										Nom
									</th>
									<th>
										Prénom
									</th>
									<th>
										Adresse mail
									</th>
									<th>
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								<?php

								foreach ($data as $key => $value) {
								?>
									<tr>
										<td>
											<?= $value['id_utilisateur']; ?>
										</td>
										<td>
											<?= $value['nom']; ?>
										</td>
										<td>
											<?= $value['prenom']; ?>
										</td>
										<td>
											<?= $value['email']; ?>
										</td>
										<td>
											<button type="submit" class="ui blue button" id="trajetsButton">Trajets</button>
											<button type="submit" class="negative ui button" id="delUser" formaction="index.php?module=admin&action=supprimerUtilisateur">Supprimer</button>
										</td>
									<?php
								}
									?>
							</tbody>
						</table>
					</form>


				</article>
			</div>
		</div>



	<?php
	}

	function confirmDeleteUser($mail)
	{
	?>
		<div class="ui segment">La suppression s'est déroulée avec succès ! Vous allez être redirigé vers l'accueil.</div>
		<meta http-equiv="refresh" content="5; URL=https://amigorapido.turtletv.fr">
	<?php
	}

	function afficherTrajets($array, $email)
	{

	?>
		<div class="container">

			<ol class="breadcrumb">
				<li><a href="index.php">Home</a>
				</li>
				<li class="active">Admin</li>
			</ol>

			<div class="row">
				<article class="col-md-12 maincontent">
					<header class="page-header">
						<h1 class="page-title">Trajets</h1>
					</header>

					<?php
					if (sizeof($array) == 0) {
					?>
						<div class="ui negative message">
							<div class="header">
								Cet utilisateur semble ne faire partie d'aucun trajet.
							</div>
							<p>Vérifiez l'adresse mail envoyée.</p>
						</div>
					<?php
					} else {


					?>
						<form role="form" method="POST" action="index.php?module=admin&action=supprimerTrajet">
							<table class="ui celled table">
								<thead class="thead-light">
									<tr>
										<th>Id Trajet</th>
										<th>Lieu Depart</th>
										<th>Lieu Arrivee</th>
										<th>Heure Depart</th>
										<th>Heure Arrivee</th>
										<th>Nombre Personnes</th>
										<th>Prix Commission</th>
										<th>Supprimer</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($array as $key => $traj) {
									?>
										<tr>
											<td>
												<?= $traj['id_trajet']; ?>
											</td>
											<td>
												<?= $traj['lieu_depart']; ?>
											</td>
											<td>
												<?= $traj['lieu_arrivee']; ?>
											</td>
											<td>
												<?= $traj['heureDepart']; ?>
											</td>
											<td>
												<?= $traj['heureArrivee']; ?>
											</td>
											<td>
												<?= $traj['nbPersonnes']; ?>
											</td>
											<td>
												<?= $traj['prix_commission']; ?>
											</td>
											<td>
												<input type="hidden" name="trajet" value="<?= $traj['id_trajet']; ?>">
												<input type="hidden" name="lieu_depart" value="<?= $traj['lieu_depart']; ?>">
												<input type="hidden" name="lieu_arrivee" value="<?= $traj['lieu_arrivee']; ?>">
												<input type="hidden" name="heureDepart" value="<?= $traj['heureDepart']; ?>">
												<input type="hidden" name="heureArrivee" value="<?= $traj['heureArrivee']; ?>">
												<input type="hidden" name="nbPersonnes" value="<?= $traj['nbPersonnes']; ?>">
												<input type="hidden" name="prix_commission" value="<?= $traj['prix_commission']; ?>">
												<input type="hidden" name="email" value="<?= $email ?>">
												<button type="submit" id="delTrajet" class="negative ui button">Supprimer</button>
											</td>

										</tr>
								<?php
									}
								}

								?>
								</tbody>
							</table>
				</article>
			</div>
		</div>

	<?php

	}

	function confirmDelete()
	{
	?>
		<div class="ui segment">La suppression s'est déroulée avec succès ! Vous allez être redirigé vers l'accueil.</div>
		<meta http-equiv="refresh" content="5; URL=https://amigorapido.turtletv.fr">
	<?php
	}

	function creerCoupon()
	{
	?>
		<div class="container">
			<ol class="breadcrumb">
				<li><a href="index.php">Home</a>
				</li>
				<li class="active">Admin</li>
			</ol>
			<div class="row">
				<article class="col-md-12 maincontent">
					<header class="page-header">
						<h1 class="page-title">Créer un coupon</h1>
					</header>
					<form role="form" action="index.php?module=mailing&action=coupon" method="POST" class="ui form">
						<div class="field">
							<label for="inputCodeCoupon">
								Code du coupon (sans le % de réduc à la fin) :
							</label>
							<input class="form-control" id="inputCodeCoupon" name="code" placeholder="ex: AMIGO" required />
						</div>
						<div class="field">
							<label for="inputPourcentageCoupon">
								Pourcentage de réduction:
							</label>
							<select name="pourcentage" id="inputPourcentageCoupon" class="ui search dropdown" required>
								<?php
								for ($i = 5; $i <= 50; $i += 5) {
								?>
									<option value="<?= $i ?>"><?= $i ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="field">
							<div class="ui toggle checkbox" id="checkboxCoupon">
								<input type="checkbox" tabindex="0" class="checkbox">
								<label>Choisir la date automatiquement</label>
							</div>
							<input type="hidden" name="estAuto" value="0">
						</div>
						<div class="field">
							<div class="ui calendar" id="dateCoupon">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" placeholder="Date" name="date">
								</div>
							</div>
						</div>
						<button type="submit" class="ui button">
							Créer le coupon
						</button>
					</form>
				</article>
			</div>
		</div>
<?php
	}
}
?>