<?php
    class VueAdmin extends VueGenerique {

        function __construct() {
            parent::__construct("Admin");
        }

        function affichageInfoConnexion() {
            ?>
                <div class="alert alert-sucess" role="alert">
                    Il semble que vous ne soyez pas connectés, <a href="index.php?module=connexion" class="alert-link">cliquez ici</a> pour vous connecter ou créer votre compte.
                </div>
            <?php
        }
        
        function afficherAdmin() {
            ?>
                <div class="container">

                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Admin</li>
                </ol>

                <div class="row">

                <article class="col-sm-8 maincontent">
					<header class="page-header">
						<h1 class="page-title">Admin</h1>
                    </header>
                    <p>Bienvenue sur la page admin.</p>
                    <a class="btn btn-default btn-lg" role="button" href="index.php?module=admin&action=afficherTrajet">Afficher les trajets</a><br/>

                </article>
                </div>
                </div>
            <?php
        }

        function entrerID() {
            ?>
             <div class="container">

                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Admin</li>
                </ol>

                <div class="row">
                <article class="col-sm-8 maincontent">
					<header class="page-header">
						<h1 class="page-title">Trajets</h1>
                    </header>
                    <p>Entrez l'ID du conducteur : </p>
                    <form method="post" action="index.php?module=admin&action=supprimerTrajet">
                    <input type="text" class="form-control" name="idconducteur" required>
                    <button class="btn btn-action" type="submit">Entrer</button>
                    </form>
                </article>
            </div>
            <?php
               

        }

        function afficherTrajets($array) {
            ?>
            <div class="container">

                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Admin</li>
                </ol>

                <div class="row">
                <article class="col-sm-8 maincontent">
                    <header class="page-header">
                        <h1 class="page-title">Trajets</h1>
                    </header>

                    <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                        <th>Id Trajet</th>
                        <th>Id Lieu Depart</th>
                        <th>Id Lieu Arrivee</th>
                        <th>Heure Depart</th>
                        <th>Heure Arrivee</th>
                        <th>Nombre Personnes</th>
                        <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $tab = $array; foreach ($tab as $traj) {
                        echo "<tr>
                        <td>" . $traj['id_trajet'] . "</td>" . "
                        <td>" . $traj['id_lieu_depart'] . "</td>" . "
                        <td>" . $traj['id_lieu_arrivee'] . "</td>" . "
                        <td>" . $traj['heureDepart'] . "</td>" . "
                        <td>" . $traj['heureArrivee'] . "</td>" . "
                        <td>" . $traj['nbPersonnes'] . "</td>" . "
                        <td><a href=\"index.php?module=admin&action=supprimerTrajet&id=" . $traj['id_trajet'] . "\" >Supprimer</a></td>" . "
                        </tr>";
                    }
                        
                        ?>
                    </tbody>
                    </table>
                </article>
            </div>

            <?php
            
        }

        function confirmDelete() {
            ?>
            <div class="container">

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Admin</li>
            </ol>
            <div class="row">
                <article class="col-sm-8 maincontent">
                    <header class="page-header">
                        <h1 class="page-title">Trajets</h1>
                    </header>
                <h3>Trajet supprimé</h3>
                <a href="index.php?module=admin&action=afficherTrajet">Revenir au menu</a>
                </article>
            </div>
            </div>
        <?php
        }
    }
?>