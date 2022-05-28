<?php
    function debug(array $data):void
    {
        echo '<pre>'.print_r($data,1).'</pre>';
    }

    function get_products():array
    {
        global $pdo;
        $res = $pdo->query("SELECT * FROM products");
        return $res->fetchAll();
    }

    function get_product(int $id): array|false
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    function add_to_cart($product):void
    {
        if(!isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']] = [
                'name' => $product['name'],
                'page' => $product['page'],
                'price' => $product['price'],
                'img' => $product['img'],
            ];

            $_SESSION['cart.qty'] = !empty($_SESSION['cart.qty']) ? ++$_SESSION['cart.qty'] : 1;
            $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $product['price'] : $product['price'];
        }
    }

    function get_pagination_products(int $start, int $count):array{
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM items.products LIMIT $start,$count");
        return $stmt->fetchAll();
    }

