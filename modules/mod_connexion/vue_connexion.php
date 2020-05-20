<?php

class VueConnexion extends VueGenerique {

    function __construct() {
        parent::__construct( "Connexion" );
    }

    function vue_connexion() {
        ?>

        <!-- container -->
        <div class="container">

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a>
                </li>
                <li class="active">Connexion</li>
            </ol>

            <div class="row">

                <!-- Article main content -->
                <article class="col-xs-12 maincontent">
                    <header class="page-header">
                        <h1 class="page-title">Connexion</h1>
                    </header>

                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="thin text-center">Connectez vous à votre compte</h3><br>
                                <p class="text-center text-muted">Si vous n'avez pas encore de compte, <a href="index.php?module=connexion&action=inscription">inscrivez-vous !</a>
                                </p>
                                <hr>

                                <form method="post" action="index.php?module=connexion&action=connexion">
                                    <div class="top-margin">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="email" required>
                                    </div>
                                    <div class="top-margin">
                                        <label>Mot de passe <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="mdp" required>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-8">
                                            <b><a href="">Mot de passe oublié ?</a></b>
                                        </div>
                                        <div class="col-lg-4 text-right">
                                            <button class="btn btn-action" type="submit">Connexion</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </article>
                <!-- /Article -->

            </div>
        </div> <!-- /container -->

        <?php
    }

    function vue_inscription() {
        ?>

        <!-- container -->
        <div class="container">

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a>
                </li>
                <li class="active">Inscription</li>
            </ol>

            <div class="row">

                <!-- Article main content -->
                <article class="col-xs-12 maincontent">
                    <header class="page-header">
                        <h1 class="page-title">Inscription</h1>
                    </header>

                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="thin text-center">Créez votre compte</h3><br>
                                <p class="text-center text-muted">Si vous avez déjà un compte, <a href="index.php?module=connexion">connectez-vous</a> à celui-ci.</p>
                                <hr>

                                <form method="post" action="index.php?module=connexion&action=inscription">
                                    <div class="top-margin">
                                        <label>Prénom <span class="text-danger">*</span></label>
                                        <input type="text" name="prenom" class="form-control" required>
                                    </div>
                                    <div class="top-margin">
                                        <label>Nom <span class="text-danger">*</span></label>
                                        <input type="text" name="nom" class="form-control" required>
                                    </div>
                                    <div class="top-margin">
                                        <label>Adresse mail <span class="text-danger">*</span></label>
                                        <input type="text" name="mail" class="form-control" required>
                                    </div>
                                    <div class="top-margin">
                                        <label>Adresse <span class="text-danger">*</span></label>
                                        <input type="text" name="adresse" class="form-control" required>
                                    </div>
                                    <div class="top-margin">
                                        <label>Code Postal <span class="text-danger">*</span></label>
                                        <input type="text" name="codePostal" class="form-control" required>
                                    </div>
                                    <div class="top-margin">
                                        <label>Ville <span class="text-danger">*</span></label>
                                        <input type="text" name="ville" class="form-control" required>
                                    </div>
                                    <div class="top-margin">
                                        <label>Téléphone <span class="text-danger">*</span></label>
                                        <input type="text" name="tel" class="form-control" required>
                                    </div>
                                    <div class="row top-margin">
                                        <div class="col-sm-6">
                                            <label>Mot de passe <span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-8">
                                            <label class="checkbox">
                        <input type="checkbox"> 
                        I have read the <a href="page_terms.html">Terms and Conditions</a>
                      </label>
                                        

                                        </div>
                                        <div class="col-lg-4 text-right">
                                            <button class="btn btn-action" type="submit">Inscription</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </article>
                <!-- /Article -->

            </div>
        </div> <!-- /container -->

        <?php
    }

    function vue_alerte( $message ) {
        ?>
        <div class="container">
            <div class="row error">
                <h4 class="thin text-center">
                    <?php echo $message; ?>
                </h4>
            </div>
        </div>
        <?php
    }
}

?>