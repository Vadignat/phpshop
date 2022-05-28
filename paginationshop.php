<?php
require_once 'pageContent.php';
require_once 'page.php';


class paginationshop extends pageContent
{
    public function __construct(){
        $this->protected_page = false;
    }
    public function show_content(){
        $total = count(get_products());
        $page = $_GET['page']  ?? 1;
        $count = $_GET['count'] ?? 3;
        $start = ($page * $count) - $count;

        $products = get_pagination_products($start,$count);
        $str_pag = ceil($total / $count);

        $previous = max($page-1,1);
        $next = min($page + 1,$str_pag);

        ?>
        <section class="py-5">
        <?php if (!empty($products)):
        ?>
        <section class="py-5">
        <div class="btn-group" style="float: right; padding-right: 15%">
            <button class="btn btn-secondary btn-outline-dark btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Количество
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="paginationshop.php?page=1&count=1#count">1</a>
                <a class="dropdown-item" href="paginationshop.php?page=1&count=2#count">2</a>
                <a class="dropdown-item" href="paginationshop.php?page=1&count=3#count">3</a>
            </div>
        </div>
            <div class="container px-4 px-lg-5 mt-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <div id="count" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
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
        <nav>
            <ul class="pagination justify-content-center">
                <?php ?>
                <li class="page-item" ><a class="page-link" href="paginationshop.php?page=<?=$previous?>&count=<?=$count?>">Назад</a></li>
                <?php
                for ($i = 1; $i <= $str_pag; $i++){
                    ?><li class="page-item"><a class="page-link" href="paginationshop.php?page=<?=$i?>&count=<?=$count?>" ><?=$i?></a></li><?php
                }
                ?>
                <li class="page-item"><a class="page-link" href="paginationshop.php?page=<?=$next?>&count=<?=$count?>">Вперёд</a></li>
            </ul>
        </nav>
        </section>

        <?php
    }
}
new page(new paginationshop());