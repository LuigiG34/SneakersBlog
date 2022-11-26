<?php
ob_start();
?>



<section class="flex-center title">
    <hr>
    <h1>ADMINISTRATION</h1>
    <hr>
</section>

<section class="admin">
    <?php foreach ($users as $user) : ?>
        <article class="grid-container">
            <p class="flex-center"><?= $user->getId_utilisateur() ?></p>
            <p class="flex-center"><?= $user->getAdresse_mail_utilisateur() ?></p>
            <p class="flex-center"><?= $adresseManager->getAdresseById($user->getId_adresse())->getCode_postal_adresse() ?></p>
            <p class="flex-center"><?= $adresseManager->getAdresseById($user->getId_adresse())->getVille_adresse() ?></p>
            <button class="modal-btn-suppr" id="<?=$user->getId_utilisateur()?>">SUPPRIMER</button>
        </article>
    <?php endforeach; ?>
</section>

<?php
$titre = "Administration";
$css = "administration.css";
$js = "administration.js";
$content = ob_get_clean();
require_once "template.php";
?>