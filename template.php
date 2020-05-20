<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>AmigoRapido</title>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="shortcut icon" href="assets/images/chevre-ico.ico">

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="assets/css/main.css">

	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.1/dist/semantic.min.css">
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">


</head>

<body class="home">
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom">
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.php?module=accueil"><img src="assets/images/chevre.png" alt="Logo du site"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li class="active"><a href="index.php">Accueil</a>
					</li>
					<li><a href="index.php?module=deposer">Déposer un trajet</a>
					</li>
					<li><a href="index.php?module=recherche">Recherche un trajet</a>
					</li>

					<li>
						<a class="btn" href="<?php if(isset($_SESSION['nom'])) {
            echo " index.php?module=compte ";
            } else {
              echo "index.php?module=connexion ";
            }?>">
							<?php 
            if(!isset($_SESSION['nom'])) {
              echo "Mon Compte";
            } else {
              echo $_SESSION['prenom']." ".$_SESSION['nom'];
            }
            ?>
						</a>
					</li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->

	<header id="head" class="secondary"></header>

	<?= $content ?>



	<section id="social">
		<div class="container">
			<div class="wrapper clearfix">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style">
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
					<a class="addthis_button_tweet"></a>
					<a class="addthis_button_linkedin_counter"></a>
					<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
				</div>
				<!-- AddThis Button END -->
			</div>
		</div>
	</section>
	<!-- /social links -->


	<footer id="footer" class="top-space" style="">
		<div class="ui inverted vertical footer segment">
			<div class="ui container">
				<div class="ui stackable inverted divided equal height stackable grid">
					<div class="four wide column">
						<h4 class="ui inverted header">Contact</h4>
						<div class="ui inverted link list">
							<a href="mailto:amigorapido.turtletv.fr" class="item">amigorapido@turtletv.fr</a>
						</div>
						<p>Montreuil, Île-de-France - Chicoutimi , Saguenay</p>
						<br>
						<img class="ui avatar image" src="assets/images/france.svg" alt="France" style="cursor: pointer" title="Mettre le site en Français" onClick="fr();">
						<img class="ui avatar image" src="assets/images/australia.svg" alt="Australie" style="cursor: pointer" title="Mettre le site en Australien simplifié" onClick="au();">
						<img class="ui avatar image" src="assets/images/rope.svg" alt="Australie"style="cursor: pointer" title="Mettre le site en Australien" onClick="au2();">
					</div>
					<div class="four wide column">
						<h4 class="ui inverted header">Suivez-nous</h4>
						<button class="ui circular facebook icon button"><i class="facebook icon"></i></button>					
						<button class="ui circular twitter icon button"><i class="twitter icon"></i></button>					
						<button class="ui circular linkedin icon button"><i class="linkedin icon"></i></button>					
						<button class="ui circular google plus icon button"><i class="google plus icon"></i></button>					
					</div>
					<div class="eight wide column">
						<h4 class="ui inverted header">Pourquoi AmigoRapido ?</h4>
						<p style="">AMIGO RAPIDO - Site de covoiturage au Canada fondé par Milan CAMUS - Mehdi Saber - Arthur VADROT<br>Les grandes étendues de l'Europe ou du Canada effraient votre budget pour vous déplacer ? N'ayez crainte ! AMIGO RAPIDO se charge de vous mettre en relation avec d'autres conducteurs / passagers afin d'économiser de l'argent lors de vos déplacements tout en faisant de superbes rencontres !</p>
					</div>
				</div>
			</div>
		</div>
	</footer>



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/dropdown.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/headroom/0.10.3/jQuery.headroom.js"></script>
	<script src="assets/js/template.js"></script>
	<script src="assets/js/lang.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.1/dist/semantic.min.js"></script>
	<script src="assets/js/semantic.min.js"></script>
	<?php if (isset($_GET['module']) && $_GET['module'] == 'admin') {
		?><script src="assets/js/admin.js"></script>
		<?php
	}
	?>
</body>
</html>