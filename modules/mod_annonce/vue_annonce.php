<?php 


class VueAnnonce extends VueGenerique
{

	function __construct(){
		parent::__construct("Annonce");
	}

	function affichageErreur() {
        ?>
            <div class="alert alert-warning" role="alert">
                Nous ne parvenons pas à afficher l'annonce. Elle n'existe plus ou n'a pas été correctement renseignée. <a href="index.php" class="alert-link">Cliquez ici</a> pour retourner au menu principal.
            </div>
        <?php
    }

    function affichageErreurPlaces() {
    	?>
            <div class="alert alert-danger" role="alert">
                Il semble que le trajet choisi n'ai plus de places. Nous vous conseillons d'en rechercher un similaire. <a href="index.php" class="alert-link">Cliquez ici</a> pour retourner au menu principal.
            </div>
        <?php
    }

    function affichageErreurDejaTrajet() {
    	?>
            <div class="alert alert-warning" role="alert">
                Vous faites déja parti de ce trajet. Pas la peine de se réinscrire. <a href="index.php" class="alert-link">Cliquez ici</a> pour retourner au menu principal.
            </div>
        <?php
    }

    function affichageErreurConducteur() {
    	?>
            <div class="alert alert-danger" role="alert">
                Vous êtes le conducteur du voyage. Vous ne pouvez donc pas être votre propre passager. <a href="index.php" class="alert-link">Cliquez ici</a> pour retourner au menu principal.
            </div>
        <?php
    }

    function affichageCorrect() {
    	?>
            <div class="alert alert-success" role="alert">
                Vous êtes bien inscrit. Rendez-vous avec votre chauffeur. <a href="index.php" class="alert-link">Cliquez ici</a> pour retourner au menu principal.
            </div>
        <?php
    }

	function vue_annonce($data){
		?>

					<div class="container">

						<ol class="breadcrumb">
							<li><a href="index.php">Home</a></li>
							<li class="active">Annonce</li>
						</ol>

						<div class="row">

								<div class="col-sm-12 maincontent">
								<header class="page-header">
									<h2 class="page-title">
										De <?php echo $data[0][0] . ", " .$data[0][1] ;?> à <?php echo $data[1][0] . ", " .$data[1][1];?> pour  <strong><?php echo $data['infoTrajet'][0]['prix_commission']." CA$";?></strong>
									</h2>
								</header>

								<article class="col-sm-12 sidebar sidebar-left">
									<h2>Le conducteur propose <?php echo $data['infoTrajet'][0]['nbPersonnes']; ?> place(s).</h2>
								</article>
							</div>
							<!-- /Article -->

						</div>
					</div>	<!-- /container -->


					<div class="container">
						<div class="table100">
							<table>
								<thead>
									<tr class="table100-head">
										<th class="column1">Conducteur</th>
										<th class="column1">Nombre de passagers</th>
										<th class="column1">Heure départ</th>
										<th class="column1">Heure prévue d'arrivée</th>
										<th class="column1">Prix</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="column1"><?php echo $data[2][0][0] . " " . $data[2][0][1]; ?></td>
										<td class="column1">
											<p>Il reste <?php
												$val = (int)$data['infoTrajet'][0]['nbPersonnes'] - (int)$data[3][0][0];
											 	echo $val;
											?> place(s).</p>
										</td>
										<td class="column1"><?php echo $data['infoTrajet'][0]['heureDepart']; ?></td>
										<td class="column1"><?php echo $data['infoTrajet'][0]['heureArrivee']; ?></td>
										<td class="column1"><?php echo $data['infoTrajet'][0]['prix_commission']; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="container">
						<div>
							<a href="index.php?module=annonce&action=ajoutParticipant&id=<?php echo $data['infoTrajet'][0]['id_trajet'];?>"><button class="btn btn-action pull-right">Prendre ce trajet</button></a>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
?>