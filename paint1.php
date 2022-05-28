<?php
require_once 'pageContent.php';
require_once 'page.php';

class paint1 extends pageContent
{
    public function __construct(){
        $this->protected_page = false;
    }
    public function show_content()
    {
        $product = get_product(5);
        ?>
        <section class="py-2">
            <div style="
              float: right;
              max-width: 60%;
              padding: 5px;">
                <div class="col mb-5">
                    <div class="card h-100">
                        <img class="card-img-top" src="img/<?= $product['img'] ?>" alt="..." />
                    </div>
                </div>
            </div>
            <div style="padding: 3%;border: 1px;">
                <h2><?= $product['name'] ?></h2>
                <p>
                    <?= $product['content'] ?>
                </p>
            </div>
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto add-to-cart" href="?cart=add&id=<?= $product['id'] ?>" data-id="<?= $product['id'] ?>">Добавить в корзину</a><label style="margin-left: 7px;">$<?= $product['price'] ?></label></div>
                </div>
            </div>
        </section>
        <?php
    }
}
new page(new paint1());