<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&family=Poppins:wght@600&family=Roboto:wght@100&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= URL ?>public/css/template.css" />
    <link rel="stylesheet" href="<?= URL ?>public/css/<?= $css ?>" />
    <link rel="shortcut icon" href="<?= URL ?>public/logo/white-bg/favicon-black.png" type="image/x-icon" />
    <title><?= $titre ?></title>
</head>


<body>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') : ?>
        <section class="modal flex-center">
            <article class="modal-bg">
                <div class="close-container">
                    <img class="close-modal-2" src="<?= URL ?>public/icon/x-square.svg" alt="">
                </div>

                <article class="modal-suppression flex-start flex-col">
                    <h2>Confirmer suppression</h2>
                    <h3>Attention les données seront irrécupérable.</h3>
                    <div class="flex-center">
                        <form action="" method="post" class="flex-center delete-user">
                            <input type="submit" name="submit" id="submit" value="CONFIRMER">
                        </form>
                        <button class="annule-btn">ANNULER</button>
                    </div>
                </article>
            </article>
        </section>
    <?php endif; ?>

    <section class="modal-auth flex-center">
        <article class="modal-bg">

            <div class="close-container">
                <img class="close-modal" src="<?= URL ?>public/icon/x-square.svg" alt="">
            </div>

            <article class="modal-content flex-center">
                <div class="inscription-container flex-center">

                    <form class="form-inscription flex-center flex-col" action="<?php URL ?>register" method="post">
                        <h2>S'inscrire</h2>
                        <input type="email" name="adresse_mail_utilisateur" id="adresse_mail_utilisateur" placeholder="Adresse mail">
                        <div class="flex-center city">
                            <input type="text" name="code_postal_utilisateur" id="code_postal_utilisateur" placeholder="Code Postal" class="zipcode">
                            <select name="ville_utilisateur" id="ville_utilisateur" class="city">
                                <option value="Ville" selected disabled>Ville</option>
                            </select>
                        </div>
                        <input type="password" name="mot_de_passe_utilisateur" id="mot_de_passe_utilisateur" placeholder="Mot de passe">
                        <input type="password" name="verif_mot_de_passe_utilisateur" id="verif_mot_de_passe_utilisateur" placeholder="Mot de passe">
                        <input type="submit" value="SOUMETTRE">
                    </form>

                    <div class="content-inscription">
                        <h1>Vous n'avez pas de compte ?</h2>
                            <h2>S'inscrire</h2>
                            <button class="inscription">S'INSCRIRE</button>
                    </div>
                </div>

                <div class="connexion-container flex-center">

                    <form class="form-connexion flex-center flex-col" action="<?php URL ?>login" method="post">
                        <h2>Se connecter</h2>
                        <input type="email" name="adresse_mail" id="adresse_mail" placeholder="Adresse mail">
                        <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe">
                        <input type="submit" value="SOUMETTRE">
                    </form>

                    <div class="content-connexion">
                        <h1>Vous avez déjà un compte ?</h2>
                            <h2>Se connecter</h2>
                            <button class="connexion">SE CONNECTER</button>
                    </div>
                </div>
            </article>

        </article>
    </section>

    <nav class="flex-center">
        <ul class="flex-between">
            <li>
                <a href="<?= URL ?>home">
                    <img src="<?= URL . 'public/logo/black-bg/nav.png' ?>" alt="">
                </a>
            </li>
            <li class="flex-center">
                <?php if (isset($_SESSION['user'])) { ?>
                    <a href="<?= URL ?>articles">ARTICLES</a>
                    <?php if ($_SESSION['user']['role'] == 'admin') { ?>
                        <a href="<?= URL ?>admin">ADMINISTRATION</a>
                    <?php } ?>
                    <a href="<?= URL ?>logout">DECONNEXION</a>
                <?php } else { ?>
                    <p class="auth-modal">AUTHENTIFICATION</p>
                <?php } ?>
            </li>
        </ul>
    </nav>
    <hr>

    <?php
    if (!empty($_SESSION['alert'])) {
    ?>
        <div class="alert <?= $_SESSION['alert']['type'] ?> flex-between">
            <div>
                <img class="close-alert" src="<?= URL ?>public/icon/x-square.svg" alt="">
            </div>
            <p><?= $_SESSION['alert']['msg'] ?></p>
        </div>
    <?php
        unset($_SESSION['alert']);
    }
    ?>

    <?= $content ?>

    <div class="flex-center">
        <hr class="footer-hr">
    </div>

    <section class="flex-center">
        <footer class="flex-between">
            <div>
                <img src="<?= URL ?>public/logo/black-bg/no-bg-1.png" alt="">
            </div>
            <div>
                <h6 class="reseaux">NOS RESEAUX</h6>
                <div class="flex-between">
                    <img class="svg" src="<?= URL ?>public/icon/facebook.svg" alt="">
                    <img class="svg" src="<?= URL ?>public/icon/instagram.svg" alt="">
                    <img class="svg" src="<?= URL ?>public/icon/twitter.svg" alt="">
                </div>
            </div>
            <div>
                <h6>Sneakers Certifié<br>1 RUE DES MYOSOTIS<br>34070 MONTPELLIER</h6>
                <?php if (!isset($_SESSION['user'])) { ?>
                    <button class="auth-modal">S'INSCRIRE</button>
                <?php } ?>
            </div>
        </footer>
    </section>


    <script src="<?= URL ?>public/js/template.js"></script>
    <script src="<?= URL ?>public/js/<?= $js ?>"></script>

</body>

</html>