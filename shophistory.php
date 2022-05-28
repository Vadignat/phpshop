<?php
require_once 'pageContent.php';
require_once 'page.php';

class shophistory extends pageContent
{
    public function show_content()
    {
        ?>
        <div class="py-5">
            <h4 style="display: table; margin: 0 auto; padding-bottom: 5px;">
            Пользователь: <?= $_SESSION['login'] ?>
            </h4>

            <?php
            global $mysqli;
            $arr = $mysqli->query("SELECT * FROM userlist.orders WHERE userid ='".$_SESSION['login']."' ORDER BY id DESC")->fetch_all();
            if(!empty($arr)):
        ?>
        <table class="table">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Название</th>
            <th scope="col">Код</th>
            <th scope="col">Цена</th>
            <th scope="col">Дата и время покупки</th>
        </tr>
        </thead>
            <tbody>
            <?php
            foreach ($arr as $item):
                $product = get_product($item[2]);
            ?>

            <tr>
                    <td><a href="#"><img src="img/<?= $product['img'] ?>" alt="<?= $product['name'] ?>" height = 50px></a></td>
                    <td><a href="<?=$product['page']?>" style=" color: black;"><?= $product['name'] ?></a></td>
                    <td><a href="<?=$product['code']?>" style=" color: black;"><?=$product['page']?></td>
                    <td> $<?= $product['price'] ?></td>
                    <td> <?= $item[3] ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
            <?php
            else:?>
                <p style="padding-left: 5%">История заказов пуста...</p>
                <?php endif; ?>
        </div>
        <?php
    }
}

new page(new shophistory());