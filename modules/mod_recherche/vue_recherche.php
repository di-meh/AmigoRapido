<?php 
    class VueRecherche extends VueGenerique {


        function __construct(){
            parent::__construct();
        }

        function affichageInfoConnexion() {
            ?>
                <div class="alert alert-info" role="alert">
                    Il semble que vous ne soyez pas connectés, <a href="index.php?module=connexion" class="alert-link">cliquez ici</a> pour vous connecter ou créer votre compte.
                </div>
            <?php
        }


        function vue_recherche($data){

            ?>  

    <!-- container -->
    <div class="container">

        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Rechercher</li>
        </ol>

        <div class="row">

            <!-- Article main content -->
            <article class="col-sm-12 maincontent">
                <header class="page-header">
                    <h1 class="page-title">Rechercher une annonce</h1>
                </header>

                <p>
                    Ici vous pourrez rechercher parmis toutes les annonces du site pour trouver la voiture qu'il vous faut.
                </p>
                <br><br>
                


                <form class="" method="POST" action="index.php?module=liste&action=afficherListe">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="field">
                                <label>Lieu de départ : </label>
                                <div id="categorieR" class="ui fluid selection search dropdown">
                                    <input value="<?php echo isset($_SESSION['recherche']['lieu_depart']) ? $_SESSION['recherche']['lieu_depart'] : ''; ?>"  name="depart" type="hidden">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Lieu de départ</div>
                                    <div id="depart-menu" class="menu">
                                        <?php $lieux = $data['lieux']; foreach ($lieux as $lieu): ?>
                                        <div class="item" data-value="<?php echo $lieu['nom_lieu'] . "," . $lieu['nom_ville'] . "," . $lieu['nom_pays']?>"><?php echo $lieu['nom_lieu'] . ", " . $lieu['nom_ville'] . ", " . $lieu['nom_pays'] ?></div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="field">
                             <label>Lieu d'arrivée : </label>
                                <div id="categorieR" class="ui fluid selection search dropdown">
                                    <input value="<?php echo isset($_SESSION['recherche']['lieu_arrivee']) ? $_SESSION['recherche']['lieu_arrivee'] : ''; ?>"  name="arrivee" type="hidden">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Lieu d'arrivée</div>
                                    <div id="arrivee-menu" class="menu">
                                        <?php $lieux = $data['lieux']; foreach ($lieux as $lieu): ?>
                                        <div class="item" data-value="<?php echo $lieu['nom_lieu'] . "," . $lieu['nom_ville'] . "," . $lieu['nom_pays']?>"><?php echo $lieu['nom_lieu'] . ", " . $lieu['nom_ville'] . ", " . $lieu['nom_pays'] ?></div>
                                    <?php endforeach ?>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- <div class="row">
                <div class="col-sm-6">
                    <div class="field">
                        <label>Marque :</label>
                        <div id="marqueR" class="ui fluid selection search dropdown">
                            <input value="<?php echo isset($_SESSION['infoV']['marque']) ? $_SESSION['infoV']['marque'] : ''; ?>"  name="marque" type="hidden">
                            <i class="dropdown icon"></i>
                            <div class="default text">Marque</div>
                            <div id="marqueR-menu" class="menu">
                                <?php //$marques = $data['marque']; foreach ($marques as $marque): ?>
                                <div class="item" data-value="<?php echo $marque['nomMarque'] ?>"><?php echo $marque['nomMarque'] ?></div>
                            <?php //endforeach ?> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="field">
                    <label>Carburant :</label>
                    <div id="carburantR" class="ui fluid selection search dropdown">
                        <input type="hidden" value="<?php echo isset($_SESSION['infoV']['carburant']) ? $_SESSION['infoV']['carburant'] : ''; ?>" name="carburant">
                        <i class="dropdown icon"></i>
                        <div class="default text">Carburant</div>
                        <div class="menu">
                            <?php //$carbu = $data['carburant']; foreach ($carbu as $carburant): ?>
                            <div class="item" data-value="<?php echo $carburant['typeCarburant'] ?>"><?php echo $carburant['typeCarburant'] ?></div>
                        <?php// endforeach ?> 
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <br>

    <!-- <div class="row">
        <div class="col-sm-3">
        <div class="field">
            <label>Prix</label>
            <div class="ui fluid input">
                <input value="<?php echo isset($_SESSION['descV']['prix']) ? $_SESSION['descV']['prix'] : ''; ?>" placeholder="Prix" name="prix"  type="number" min="100">
                <i id="euro" class="fa fa-eur  fa-lg" aria-hidden="true"></i>
            </div>  
        </div>
    </div> -->
    </div>

    <br>

    <div class="row">
        <div class="col-sm-12 text-right">
            <button id="button-rechercher" class="btn btn-primary">Rechercher</button>
        </div>
    </div>
    </form>

    </article>
    <!-- /Article -->

    </div>
    </div>  <!-- /container --> 
<?php


}

function affichageResultats() {
    
}


}
?>