<?php

class VueSupport extends VueGenerique {

    function __construct() {
        parent::__construct( "Support" );
    }

    function accueil_support( $tableau ) {
        //Menu d'accueil de la page support
        ?>
        <div class="container">

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a>
                </li>
                <li><a href="index.php?module=admin">Admin</a>
                </li>
                <li class="active">Support</li>
            </ol>

            <div class="row">

                <article class="col-sm-8 maincontent">
                    <header class="page-header">
                        <h1 class="page-title">Support</h1>
                    </header>
                    <p>Bienvenue sur la page Support.</p>
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
                </article>
            </div>
        </div>

        <?php
    }

    function afficherChat( $noDemande, $date, $etat, $messages, $resolu, $erreur ) {
        ?>
        <link href="assets/css/chat.css" rel="stylesheet" type="text/css">
        <?= $erreur ?>
        <div class="chatContainer">
            <div class="ui breadcrumb">
                <a class="section" href="index.php">Accueil</a>
                <i class="right chevron icon divider"></i>
                <a class="section" href="index.php?module=admin">Admin</a>
                <i class="right chevron icon divider"></i>
                <a class="section" href="index.php?module=support">Support</a>
                <i class="right arrow icon divider"></i>
                <div class="active section">Demande n°
                    <?= $noDemande ?>
                </div>
            </div>
            <h1>Demande de support n° <?= $noDemande ?></h1>
            <p>Émis le
                <?= $date ?> - État :
                <b>
                    <?= $etat ?>
                </b>
            </p>
            <?= $messages ?>
            <form action="?module=support&action=repondre&id=<?= $noDemande ?>" method="post">
                <div class="ui fluid action input inputReponse <?= $resolu ?>">
                    <input type="text" name="reponse" placeholder="Saisissez votre réponse..." required>
                    <button class="ui icon button <?= $resolu ?>" title="Répondre au message"><i class="send icon"></i></button>
                </div>
            </form>
        </div>

        <?php
    }

    function afficherChatClient( $noDemande, $date, $etat, $messages, $resolu, $erreur ) {
        ?>
        <link href="assets/css/chat.css" rel="stylesheet" type="text/css">
        
        <?= $erreur ?>
        <div class="chatContainer">
            <div class="ui breadcrumb">
                <a class="section" href="index.php">Accueil</a>
                <i class="right chevron icon divider"></i>
                <a class="section" href="index.php?module=compte">Mon compte</a>
                <i class="right arrow icon divider"></i>
                <div class="active section">Demande n°
                    <?= $noDemande ?>
                </div>
            </div>
            <h1>Demande de support n° <?= $noDemande ?></h1>
            <p>Émis le
                <?= $date ?> - État :
                <b>
                    <?= $etat ?>
                </b>
            </p>
            <?= $messages ?>
            <form action="?module=support&action=repondreClient&id=<?= $noDemande ?>" method="post">
                <div class="ui fluid action input inputReponse <?= $resolu ?>">
                    <input type="text" name="reponse" placeholder="Saisissez votre réponse..." required>
                    <button class="ui icon button <?= $resolu ?>" title="Répondre au message"><i class="send icon"></i></button>
                </div>
            </form>
        </div>

        <?php
    }

    function afficherNouvelleDemande() {
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="assets/js/support.js" type="text/javascript"></script>

        <div class="container">

            <div class="row">

                <article class="col-sm-8 maincontent">
                    <div class="ui breadcrumb">
                        <a class="section" href="index.php">Accueil</a>
                        <i class="right chevron icon divider"></i>
                        <a class="section">Support</a>
                        <i class="right arrow icon divider"></i>
                        <div class="active section">Nouvelle demande</div>
                    </div>
                    <header class="page-header">
                        <h1 class="page-title">Support - Rédiger une demande</h1>
                    </header>
                    <p>Bienvenue sur le support d'AmigoRapido ! Si vous rencontrez un problème, décrivez-le nous du mieux que vous pouvez afin que nous puissions vous aider et trouver une solution ensemble !</p>
                    <form method="post" action="index.php?module=support&action=envoyerDemande">
                        <div class="ui fluid search selection dropdown motif">
                            <input type="hidden" name="motif">
                            <i class="dropdown icon"></i>
                            <div class="default text">Sélectionnez le motif...</div>
                            <div class="menu">
                                <div class="item" data-value="Problème lié au paiement de mon trajet"><img class="ui mini image" src="assets/images/credit-card.png">Problème lié au paiement de mon trajet</div>
                                <div class="item" data-value="Problème lié à mon/mes passager(s)"><img class="ui mini image" src="assets/images/people.png">Problème lié à mon/mes passager(s)</div>
                                <div class="item" data-value="Problème lié au conducteur"><img class="ui mini image" src="assets/images/car.png">Problème lié au conducteur</div>
                                <div class="item" data-value="Problème lié à la réservation"><img class="ui mini image" src="assets/images/receipt.png">Problème lié à la réservation</div>
                            </div>
                        </div>
                        <p><i>Si votre problème ne figure pas dans la déroulante, vous pouvez en écrire un de votre choix !</i>

                        

                        </p>


                        <div class="ui form">
                            <div class="ui left corner labeled input">
                                <div class="ui left corner label">
                                    <i class="asterisk icon"></i>
                                </div>
                                <textarea style="margin-top: 0px; margin-bottom: 0px; height: 150px; width: 500px;" placeholder="Veuillez nous décrire votre problème plus précisement..." name="demande"></textarea>
                            </div>
                        </div>
                        <br>
                        <button class="ui primary button" type="submit">Envoyer ma demande</button>
                        <button class="ui red inverted button" type="reset" onClick="">Annuler</button>
                        <p><i>Les champs annotés d'une <b>*</b> sont obligatoires</i>
                        </p>
                    </form>

                </article>
            </div>
        </div>
        <?php
    }

    function confirmerNouvelleDemande() {
        ?>

        <div class="container">

            <div class="row">

                <article class="col-sm-8 maincontent">
                    <div class="ui breadcrumb">
                        <a class="section" href="index.php">Accueil</a>
                        <i class="right chevron icon divider"></i>
                        <a class="section">Support</a>
                        <i class="right arrow icon divider"></i>
                        <div class="active section">Demande envoyée</div>
                    </div>
                    <header class="page-header">
                        <h1 class="page-title">Support - Merci !</h1>
                    </header>
                    <p>Merci ! Votre message a été transmis à nos équipes ! Nous nous effonçons de vous répondre dans les plus brèfs delais !<br>Vous pouvez consulter le statut de votre demande depuis la page <a href="index.php?module=compte">Mon compte</a> !</p>
                </article>
            </div>
        </div>
        <?php
    }
}

?>