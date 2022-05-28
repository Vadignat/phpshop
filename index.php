<?php
require_once 'pageContent.php';
require_once 'page.php';

class index extends pageContent
{
    public function __construct(){
        $this->protected_page = false;
    }
    public function show_content()
    {
        ?>
        <section class="py-2">
            <div style="
              float: right;
              max-width: 60%;
              padding: 5px;">
                <div class="col mb-5">
                    <div class="card h-100">
                        <img class="card-img-top" src="img/homepage-img.jpg" alt="..." />
                    </div>
                </div>
            </div>
            <div style="padding: 3%;border: 1px;">
                <h2>Добро пожаловать на главную страницу сайта!</h2>
                <p>
                    Это интернет-магазин приложений, написанный на PHP.
                    На платформе можно купить программы по заданиям за текущий семестр по приемлемым ценам.
                    Изучайте материал на платформе в любое удобное время.
                </p>
            </div>
        </section>
        <?php
    }
}

new page(new index());