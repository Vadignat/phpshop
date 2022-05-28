<div class="modal-body">
    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                <tr>
                    <td><a href="#"><img src="img/<?= $item['img'] ?>" alt="<?= $item['name'] ?>" height = 50px></a></td>
                    <td><a href="<?=$item['page']?>"><?= $item['name'] ?></a></td>
                    <td><?= $item['price'] ?></td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="4" align="right">Товаров: <span id="modal-cart-qty"><?= $_SESSION['cart.qty'] ?></span>
                    <br> Сумма: <?= $_SESSION['cart.sum'] ?> $.
                </td>
            </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p>Корзина пуста...</p>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
    <?php if (!empty($_SESSION['cart'])): ?>
            <?php if (empty($_SESSION['login'])): ?>
                <a href="login.php" class="btn btn-primary">Оформить заказ</a>
            <?php else:?>
                <button id="place-an-order" type="button" class="btn btn-primary">Оформить заказ</button>
    <?php endif; ?>
        <button type="button" class="btn btn-danger" id="clear-cart">Очистить корзину</button>
    <?php endif; ?>
</div>
