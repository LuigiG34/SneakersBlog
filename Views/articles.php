<?php
ob_start();

?>

<?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') : ?>
    <section class="modal-suppr-art flex-center">
        <article class="modal-bg modal-del">
            <div class="close-container">
                <img class="close-modal-4" src="<?= URL ?>public/icon/x-square.svg" alt="">
            </div>

            <article class="modal-suppression-2 flex-start flex-col">
                <h2>Confirmer suppression</h2>
                <h3>Attention les données seront irrécupérable.</h3>
                <div class="flex-center">
                    <form action="" method="post" class="flex-center delete-article">
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <input type="submit" name="delete" id="delete" value="CONFIRMER">
                    </form>
                    <button class="annule-btn-art">ANNULER</button>
                </div>
            </article>
        </article>
    </section>

    <section class="modal-add flex-center">
        <article class="modal-bg">
            <div class="close-container">
                <img class="close-modal-3" src="<?= URL ?>public/icon/x-square.svg" alt="">
            </div>

            <article class="modal-contenu flex-center flex-col">
                <h2>Ajouter un article</h2>
                <div class="flex-center flex-col">
                    <form enctype="multipart/form-data" action="<?= URL ?>articles/addArticle" method="post" class="flex-center flex-col add-article">
                        <input type="text" name="titre" id="titre" placeholder="Nom des chaussures">
                        <input type="date" name="date" id="date" placeholder="Date de sortie">
                        <input type="text" name="couleur" id="couleur" placeholder="Couleur">
                        <textarea name="premier" id="premier" cols="30" rows="10" placeholder="Premier paragraphe"></textarea>
                        <textarea name="deuxieme" id="deuxieme" cols="30" rows="10" placeholder="Deuxième paragraphe"></textarea>
                        <input type="file" name="image" id="image" accept="image/*">
                        <input type="submit" name="valider" id="valider" value="SOUMETTRE">
                    </form>
                </div>
            </article>
        </article>
    </section>
<?php endif; ?>


<section class="flex-center title">
    <hr>
    <h1>ARTICLES</h1>
    <hr>
</section>


<?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') : ?>
    <section class="flex-center">
        <p class="action-article flex-center">Ajouter un article <img src="<?= URL ?>public/icon/plus-square.svg" alt="" class="svg-action"></p>
    </section>
<?php endif; ?>

<section class="container-article flex-center">
    <section class="articles flex-center">
        <?php foreach ($articles as $article) : ?>

            <article>
                <img src="<?= URL . $article->getUrl_img_article() ?>" alt="">
                <h6 class="shoe-title"><?= $article->getTitre_article() ?></h6>
                <p><?= substr($paragrapheManager->getParagrapheByIdArticle($article->getId_article())[0]->contenu_paragraphe, 0, 198) ?>...</p>
                <div class="flex-center">
                    <a href="<?= URL ?>articles/<?= $article->getId_article() ?>"><button>LIRE LA SUITE</button></a>
                </div>
                <h6 class="date"><?= $article->getDate_article_view() ?></h6>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') : ?>
                    <p class="action-article flex-center suppr-btn" id="<?= $article->getId_article() ?>">Supprimer l'article<img src="<?= URL ?>public/icon/trash.svg" alt="" class="svg-action"></p>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    </section>
</section>



<?php
$titre = "Articles";
$css = "articles.css";
$js = "articles.js";
$content = ob_get_clean();
require_once "template.php";
?>