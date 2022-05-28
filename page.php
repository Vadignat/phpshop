<?php
error_reporting(-1);
session_start();
require_once 'database/db.php';
require_once 'database/funcs.php';
require_once 'database/connection.php';

class page
{
    public function __construct(pageContent $content){
        if ($content->is_protected() && !isset($_SESSION['login'])){
            header("Location: login.php");
        }
        $this->start_page();
        $this->show_menu();

        $content->show_content();

        $this->show_footer();
        $this->finish_page();
    }
    private function start_page(){
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>PHP Shop</title>
            <link rel="icon" type="image/x-icon" href="img/php.png" />

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

            <link href="css/styles.css" rel="stylesheet" />
        </head>
        <body>
        <?php
    }
    private function show_menu(){
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">PHP Shop</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Главная</a></li>
                        <li class="nav-item"><a class="nav-link" href="#a1">О Нас</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Магазин
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="shop.php">Все приложения</a>
                                <a class="dropdown-item" href="newArrivals.php">Новые поступления</a>
                                <a class="dropdown-item" href="paginationshop.php">Постраничный просмотр</a>
                            </div>
                        </li>
                        <?php if(isset($_SESSION['login'])):?>
                        <li class="nav-item"><a class="nav-link" href="shophistory.php">История заказов</a></li>
                        <?php endif;?>
                    </ul>
                    <form class="d-flex id="cart-modal"">
                        <button id="get-cart" type="button" class="btn btn-outline-dark" type="button" data-toggle="modal" data-target="#cart-modal">
                            <i class="bi-cart-fill me-1"></i>
                            Корзина
                            <span class="badge bg-dark text-white ms-1 rounded-pill mini-cart-qty"><?= $_SESSION['cart.qty'] ?? 0 ?></span>
                        </button>
                    <?php if(isset($_SESSION['login'])):?>
                        <a href="logout.php" style="margin-left: 3px;" class="btn btn-outline-dark">
                                Выйти
                        </a>
                    <?php else :?>
                    <a href="login.php" style="margin-left: 3px;" class="btn btn-outline-dark">
                        Войти
                    </a>
                    <?php endif ?>
                    </form>
                </div>
            </div>
        </nav>
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder"> PHP Shop</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Простые решения для сложных проблем</p>
                </div>
            </div>
        </header>
        <?php
    }

    private function show_footer(){
        ?>
        <div class="modal fade cart-modal" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Корзина</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-cart-content">

                    </div>

                </div>
            </div>
        </div>
        <footer class="py-5 bg-dark" style="clear: right;">
            <div class="container"><p id="a1" class="m-0 text-center text-white"> 2022 &copy; Вадим Игнатьев</p></div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

        <script src="js/main.js"></script>
        <?php
    }
    private function finish_page(){
        ?>
        </body>
        </html>
        <?php
    }
}
