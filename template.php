<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport"    content="width=device-width, initial-scale=1.0">

  <title>AmigoRapido</title>

  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/semantic.min.css">
  <link rel="shortcut icon" href="assets/images/chevre-ico.ico">

  <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">

  <!-- Custom styles for our template -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
  <link rel="stylesheet" href="assets/css/main.css">

</head>

<body class="home">
  <!-- Fixed navbar -->
  <div class="navbar navbar-inverse navbar-fixed-top headroom" >
    <div class="container">
      <div class="navbar-header">
        <!-- Button for smallest screens -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="index.php?module=accueil"><img src="assets/images/chevre.png" alt="Logo du site"></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav pull-right">
          <li class="active"><a href="index.php">Accueil</a></li>
          <li><a href="index.php?module=deposer">Déposer un trajet</a></li>
          <li><a href="index.php?module=recherche">Recherche un trajet</a></li>

          <li><a class="btn" href="<?php if(isset($_SESSION['nom'])) {
            echo "index.php?module=compte";
            } else {
              echo "index.php?module=connexion";
            }?>"><?php 
            if(!isset($_SESSION['nom'])) {
              echo "Mon Compte";
            } else {
              echo $_SESSION['prenom']." ".$_SESSION['nom'];
            }
            ?></a></li>
          </ul>
        </div><!--/.nav-collapse -->
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


    <footer id="footer" class="top-space">

      <div class="footer1">
        <div class="container">
          <div class="row">

            <div class="col-md-3 widget">
              <h3 class="widget-title">Contact</h3>
              <div class="widget-body">
                  <a href="mailto:#">contact@amigorapido.com</a><br>
                  <br>
                	Chicoutimi , Saguenay
                </p>  
              </div>
            </div>

            <div class="col-md-3 widget">
              <h3 class="widget-title">Suivez nous</h3>
              <div class="widget-body">
                <p class="follow-me-icons">
                  <a href=""><i class="fa fa-twitter fa-2"></i></a>
                  <a href=""><i class="fa fa-dribbble fa-2"></i></a>
                  <a href=""><i class="fa fa-github fa-2"></i></a>
                  <a href=""><i class="fa fa-facebook fa-2"></i></a>
                </p>  
              </div>
            </div>

            <div class="col-md-6 widget">
              <h3 class="widget-title">Pourquoi ce site ?</h3>
              <div class="widget-body">
                <p>AMIGO RAPIDO - Site de covoiturage au Canada fondé par Arthur VADROT - Steven QUIOT - Mehdi SABER</p>
                <p>Les grandes étendues du Canada effraient votre budget pour vous déplacer ? N'ayez crainte ! AMIGO RAPIDO se charge de vous mettre en relation avec d'autres conducteurs / passagers afin d'économiser de l'argent lors de vos déplacements tout en faisant de superbes rencontres ! </p>
              </div>
            </div>

          </div> <!-- /row of widgets -->
        </div>
      </div>

      <div class="footer2">
        <div class="container">
          <div class="row">

            <div class="col-md-6 widget">
              <div class="widget-body">
                <p class="simplenav">
                  <a href="#">Home</a> | 
                  <a href="about.html">About</a> |
                  <a href="sidebar-right.html">Sidebar</a> |
                  <a href="contact.html">Contact</a> |
                  <b><a href="signup.html">Sign up</a></b>
                </p>
              </div>
            </div>

            <div class="col-md-6 widget">
              <div class="widget-body">
                <p class="text-right">
                  Copyright &copy; 2014, Your name. Designed by <a href="http://gettemplate.com/" rel="designer">gettemplate</a> 
                </p>
              </div>
            </div>

          </div> <!-- /row of widgets -->
        </div>
      </div>

    </footer> 

    <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/headroom.min.js"></script>
    <script src="assets/js/jQuery.headroom.min.js"></script>
    <script src="assets/js/template.js"></script>


    <script type="text/javascript" src="assets/js/jquery.min.js"></script>

    <script type="text/javascript" src="assets/js/script.js"></script>
    
    <script src="assets/js/semantic.min.js"></script>
  </body>
  </html>