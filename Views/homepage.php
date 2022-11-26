<?php
ob_start();

$result = array_slice($articles, -3, 3, true);
?>

<link rel="stylesheet" href="<?= URL ?>public/css/homepage.css">

<section class="one flex-between">
    <article>
        <h1>SNEAKERS</h1>
        <h2>CERTIFIÉES</h2>
        <h3>BLOG DE SNEAKERS</h3>
        <?php if (!isset($_SESSION['user'])) { ?>
            <button class="auth-modal">S'INSCRIRE</button>
        <?php } ?>
    </article>
    <article>
        <img src="<?= URL ?>public/img/banner.png" alt="">
    </article>
</section>

<section class="two flex-between">
    <article>
        <img src="<?= URL ?>public/img/img.png" alt="">
    </article>
    <article class="second-article">
        <h4>Notre site web</h4>
        <h5>À propos</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam porttitor orci nibh, et posuere lacus pulvinar eget. Aenean vel leo augue. Integer sit amet nulla id nibh luctus vestibulum. Praesent dignissim, urna vitae eleifend posuere, odio dolor sodales metus, sit amet lobortis mauris purus quis quam. Aenean eget lacus consequat, interdum dui a, malesuada risus. Etiam id nunc urna. Donec gravida sollicitudin nulla sed laoreet. Sed ex massa, consequat fringilla magna et, consequat iaculis massa.</p>
    </article>
</section>


<section class="flex-center last">
    <hr>
    <h6>Les articles</h6>
    <hr>
</section>

<section class="articles flex-center">
    <?php foreach ($result as $article) : ?>
        <article>
            <img src="<?= URL . $article->getUrl_img_article() ?>" alt="">
            <h6 class="shoe-title"><?= $article->getTitre_article() ?></h6>
            <p><?= substr($paragrapheManager->getParagrapheByIdArticle($article->getId_article())[0]->contenu_paragraphe ,0, 300) ?>...</p>
            <?php if (isset($_SESSION['user'])) : ?>
                <div class="flex-center">
                    <a href="<?= URL ?>articles/<?= $article->getId_article() ?>"><button>LIRE LA SUITE</button></a>
                </div>
            <?php endif; ?>
            <h6 class="date"><?= $article->getDate_article_view() ?></h6>
        </article>
    <?php endforeach; ?>
</section>

<?php
$titre = "Sneakers Certifiées";
$css = "homepage.css";
$content = ob_get_clean();
require_once "template.php";
?>