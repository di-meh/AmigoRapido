    <?php
    require_once('assets/scripts/script-calendrier.php');

    class VueDeposer extends VueGenerique {

        function __construct(){
            parent::__construct();
        }

        function affichageInfoConnexion() {
            ?>
            <div class="alert alert-info" role="alert">
                Il semble que vous ne soyez pas connectés, <a href="index.php" class="alert-link">Cliquez ici</a> pour vous connecter ou créer votre compte.
            </div>
            <?php
        }

        function affichageErreur() {
            ?>
            <div class="alert alert-danger" role="alert">
                Il y a eu une erreur dans l'annonce. <a href="index.php?module=deposer" class="alert-link">Cliquez ici</a> pour retourner au déot d'annonces.
            </div>
            <?php
        }

        function vue_informationVehicule($data){
            ?> 
            <!-- container -->
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
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
                        <form method="POST" action="index.php?module=deposer&action=soumettreInformationTrajet">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="field">
                                        <label>Lieu du départ : </label>
                                        <div id="categorie" class="ui fluid selection search dropdown">
                                            <input value="<?php echo isset($_SESSION['depart']['lieux']) ? $_SESSION['arrivee']['lieux'] : ''; ?>"  name="lieu_depart" type="hidden">
                                            <i class="dropdown icon"></i>
                                            <div class="default text"></div>
                                            <div id="categorie-menu" class="menu">
                                                <?php $lieux = $data['depart']; foreach ($lieux as $lieu): ?>
                                                <div class="item" data-value="<?php echo $lieu['nom_lieu'] . ',' . $lieu['nom_ville'] . ',' .  $lieu['nom_pays']?>"><?php echo $lieu['nom_lieu'] . ', ' . $lieu['nom_ville'] . ", " .  $lieu['nom_pays'] ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="field">
                                <label>Lieu d'arrivée :</label>
                                <div id="modele" class="ui fluid selection search dropdown">
                                    <input value="<?php echo isset($_SESSION['depart']['lieux']) ? $_SESSION['arrivee']['lieux'] : ''; ?>"  name="lieu_arrivee" type="hidden">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Modèle</div>
                                    <div id="modele-menu" class="menu">
                                        <?php $lieux = $data['depart']; foreach ($lieux as $lieu): ?>
                                        <div class="item" data-value="<?php echo $lieu['nom_lieu'] . ',' . $lieu['nom_ville'] . ',' .  $lieu['nom_pays']?>"><?php echo $lieu['nom_lieu'] . ', ' . $lieu['nom_ville'] . ", " .  $lieu['nom_pays'] ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="field">
                        <label>Date du départ : </label>
                        <div id="date_depart">
                            <input class="form-control" type="text" name="date_depart" placeholder="YYYY-MM-DD HH:MI:SS">
                        </div>
                    </div>
                </div>
            </div>                        


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
                            <input class="form-control" name="prix" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-sm-12 text-right">
            <button name="valider" class="btn btn-primary">Valider et Continuer</button>
        </div>
    </div>
</form>

</article>
<!-- /Article -->
</div>
</div>  <!-- /container -->
<?php


}



function vue_validationTrajet(){
    ?>  



<div class="alert alert-success" role="alert">
                    Votre annonce a bien été prise en compte ! <a href="index.php?module=deposer&action=terminer" class="alert-link">cliquez ici</a> pour revenir à l'accueil.
</div>       
                             
            <?php
        }
    }
    ?>

