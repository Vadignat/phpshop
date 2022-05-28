<?php
require_once 'pageContent.php';
require_once 'page.php';


class shop extends pageContent
{
    public function __construct(){
        $this->protected_page = false;
    }
    public function show_content(){
        $products = get_products();
        if (!empty($products)):
?>
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php foreach ($products as $product): ?>
                        <div class="col mb-5">
                            <div class="card h-100">
                                <?php
                                if($product['new_arrival']==1 and $product['sale']==1 and $product['old_price']==0):
                                    ?>
                                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Скоро в продаже</div>
                                <?php
                                elseif ($product['sale'] == 1):
                                 ?>
                                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                <?php endif; ?>
                                <a href="<?=$product['page']?>"><img class="card-img-top" src="img/<?=$product['img']?>" alt="..." /></a>
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5 class="fw-bolder" "><a href="<?=$product['page']?>" style="text-decoration: none;color: rgba(var(--bs-black-rgb), var(--bs-text-opacity)) !important; "><?=$product['name']?></a></h5>
                                        <?php
                                        if($product['sale'] == 1 and !($product['new_arrival']==1 and $product['old_price']==0)):
                                        ?>
                                            <span class="text-muted text-decoration-line-through">$<?=$product['old_price']?></span>
                                        <?php endif; ?>
                                        $<?=$product['price']?>
                                    </div>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto add-to-cart" href="?cart=add&id=<?= $product['id'] ?>" data-id="<?= $product['id'] ?>">Добавить в корзину</a></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </section>

        <?php
    }
}
new page(new shop());