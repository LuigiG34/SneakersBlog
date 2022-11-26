<?php
ob_start();
$couleur = $couleurManager->getCouleurById($article->getId_couleur());
?>

<?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') : ?>

    <section class="modal-update flex-center">
        <article class="modal-bg">
            <div class="close-container">
                <img class="close-modal-5" src="<?= URL ?>public/icon/x-square.svg" alt="">
            </div>

            <article class="modal-contenu flex-center flex-col">
                <h2>Modifier un article</h2>
                <div class="flex-center flex-col">
                    <form enctype="multipart/form-data" action="<?= URL ?>articles/<?= $article->getId_article() ?>/update" method="post" class="flex-center flex-col add-article">
                        <input type="text" name="titre" id="titre" placeholder="Nom des chaussures" value="<?= $article->getTitre_article() ?>">
                        <input type="date" name="date" id="date" placeholder="Date de sortie" value="<?= $article->getDate_sortie_chaussures() ?>">
                        <input type="text" name="couleur" id="couleur" placeholder="Couleur" value="<?= $couleur->getNom_couleur() ?>">
                        <textarea name="premier" id="premier" cols="30" rows="10" placeholder="Premier paragraphe" value=""><?= $paragrapheManager->getParagrapheByIdArticle($article->getId_article())[0]->contenu_paragraphe ?></textarea>
                        <textarea name="deuxieme" id="deuxieme" cols="30" rows="10" placeholder="Deuxième paragraphe" value=""><?= $paragrapheManager->getParagrapheByIdArticle($article->getId_article())[1]->contenu_paragraphe ?></textarea>
                        <input type="file" name="image" id="image" accept="image/*" value="<?= URL . $article->getUrl_img_article() ?>">
                        <input type="submit" name="valider" id="valider" value="SOUMETTRE">
                    </form>
                </div>
            </article>
        </article>
    </section>

    <section class="flex-center">
        <p class="action-article modify-trigger">Modifier l'article <img src="../public/icon/gear.svg" alt="" class="gear"></p>
    </section>
<?php endif; ?>

<section class="flex-center section-article">
    <div class="img-article flex-center">
        <img src="<?= URL . $article->getUrl_img_article() ?>" alt="">
    </div>
    <div class="title-article">
        <h1><?= $couleur->getNom_couleur(); ?></h1>
        <h2><?= $article->getTitre_article() ?></h2>
        <p class="date">Date de sortie : <?= $article->getDate_sortie_view() ?></p>
    </div>
</section>

<section class="paragraphe">
    <p> <?= $paragrapheManager->getParagrapheByIdArticle($article->getId_article())[0]->contenu_paragraphe ?></p>
    <br>
    <p> <?= $paragrapheManager->getParagrapheByIdArticle($article->getId_article())[1]->contenu_paragraphe ?></p>
    <p class="date-2">Date de création article : <?= $article->getDate_article_view() ?></p>

    <p>Rédiger un commentaire :</p>
    <form action="<?= URL ?>articles/<?= $article->getId_article() ?>/commentaire" method="post">
        <textarea name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
        <input type="submit" value="Publier">
    </form>

    <?php if (isset($commentaires)) : ?>
        <?php foreach ($commentaires as $com) : ?>

            <?php if ($com->getId_article() == $article->getId_article()) : ?>

                <div class="commentaire">
                    <p><?= $com->getContenu_commentaire() ?></p>
                    <p><?= str_replace("-", "/", $com->getDate_commentaire()) ?></p>
                    <?php if ($_SESSION['user']['role'] == "admin") : ?>
                        <form action="<?= URL ?>articles/<?= $article->getId_article() ?>/commentaireSuppr/<?= $com->getId_commentaire() ?>" method="post">
                            <input type="submit" name="delete" value="Supprimer">
                        </form>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>
    <?php endif; ?>

</section>

<?php
$titre = $article->getTitre_article() . " - " . $couleur->getNom_couleur();;
$css = "article.css";
$js = "article.js";
$content = ob_get_clean();
require_once "template.php";
?>