<?php

    error_reporting(-1);
    session_start();
    require_once 'database/db.php';
    require_once 'database/funcs.php';
    require_once 'database/connection.php';

    if (isset($_GET['cart'])) {
        switch ($_GET['cart']) {
            case 'add':
                $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                $product = get_product($id);

                if (!$product) {
                    echo json_encode(['code' => 'error', 'answer'=> 'Error product']);
                } else {
                    add_to_cart($product);
                    ob_start();
                    require 'cart-modal.php';
                    $cart = ob_get_clean();
                    echo json_encode(['code' => 'ok', 'answer' => $cart]);
                }
                break;

            case 'show':
                require 'cart-modal.php';
                break;

            case 'clear':
                if(!empty($_SESSION['cart'])){
                    unset($_SESSION['cart']);
                    unset($_SESSION['cart.sum']);
                    unset($_SESSION['cart.qty']);
                }
                require 'cart-modal.php';
                break;

            case 'order':
                if(!empty($_SESSION['cart'])){
                    global $mysqli;
                    foreach ($_SESSION['cart'] as $id => $item){
                        $mysqli->query("INSERT INTO userlist.orders(userid,itemid) VALUES('".$_SESSION['login']."', $id) ");
                    }
                    unset($_SESSION['cart']);
                    unset($_SESSION['cart.sum']);
                    unset($_SESSION['cart.qty']);
                }
                break;

        }
    }