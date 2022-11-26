<?php

namespace LuigiG34;

session_start();

require 'Autoloader.php';

use FFI\Exception;
use LuigiG34\App\Controllers\ArticleController;
use LuigiG34\App\Controllers\CommentaireController;
use LuigiG34\App\Controllers\UserController;

// constante qui récupère début de l'url
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));

Autoloader::register();

$userController = new UserController();
$articleController = new ArticleController();
$commentaireController = new CommentaireController();

try {
    if (!isset($_GET['page'])) {
        $articleController->displayArticlesHome();
    } else {
        $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
        switch ($url[0]) {
            case 'home':
                $articleController->displayArticlesHome();
                break;

            case 'login':
                if (!isset($_SESSION['user'])) {
                    $userController->logIn();
                }
                break;

            case 'register':
                if (!isset($_SESSION['user'])) {
                    $userController->register();
                }
                break;

            case 'logout':
                $userController->logout();
                break;

            case 'articles':
                if (isset($_SESSION['user'])) {
                    if ($_SESSION['user']['role'] == 'admin') {
                        if (isset($url[1]) && $url[1] == "addArticle") {
                            $articleController->addArticle();
                        }
                        if (isset($url[2]) && isset($url[1]) && $url[1] == "delete") {
                            $articleController->deleteArticleDB($url[2]);
                        }
                        if (isset($url[2]) && isset($url[1]) && $url[2] == "update") {
                            $articleController->updateArticle($url[1]);
                        }
                        if(isset($url[3])  && isset($url[2])  && isset($url[1]) && $url[2] == "commentaireSuppr") {
                            $commentaireController->deleteCommentaire($url[3], $url[1]);
                        }
                    }
                    if(isset($url[2])  && isset($url[1]) && $url[2] == "commentaire") {
                        $commentaireController->addCommentaire($url[1]);
                    }
                    
                    if (isset($url[1])) {
                        $articleController->displayArticle($url[1]);
                    }else{
                        $articleController->displayArticles();
                    }
                }else{
                    http_response_code(404);
                    require "Views/404.php";
                    
                }
                break;

            case 'deleteUser':
                if ($_SESSION['user']['role'] == 'admin') {
                    if (isset($url[1])) {
                        $userController->deleteUserDB(intval($url[1]));
                    }
                } else {
                    http_response_code(404);
                    require "Views/404.php";
                }
                break;

            case 'admin':
                if ($_SESSION['user']['role'] == 'admin') {
                    $userController->displayUsers();
                } else {
                    http_response_code(404);
                    require "Views/404.php";
                }
                break;

            default:
                http_response_code(404);
                require "Views/404.php";
                break;
        }
    }
} catch (Exception $e) {
    http_response_code(404);
    require "Views/404.php";
}
