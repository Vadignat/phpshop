<?php
require_once 'pageContent.php';
require_once 'page.php';

class login extends pageContent
{
    private bool $log_ok = true;
    private bool $log_exists = true;

    public function __construct(){
        $this->protected_page = false;
        if ($this->exiting()){
            unset($_SESSION['auth']);
        } else {
            $this->login();
        }
    }

    private function exiting() : bool{
        return (isset($_GET['exit']) && $_GET['exit']==1);
    }

    private function login(){
        if (!isset($_POST['login']) &&
            !isset($_POST['psw'])) return;
        if (!isset($_POST['login']) ||
            !isset($_POST['psw']) ||
            mb_strlen($_POST['login']) < 1 ||
            mb_strlen($_POST['psw']) < 6 ||
            !$this->is_authorized($_POST['login'], $_POST['psw'])
        ) {
            $this->log_ok = false;
            return;
        }
        $_SESSION['auth'] = 1;
        header("Location: shop.php");
    }

    private function is_login_exists($login):bool
    {
        global $mysqli;
        return $mysqli->query("SELECT 1 FROM users WHERE login = '".$login."'")->num_rows > 0;
    }

    private function is_authorized($login, $psw) : bool{
        global $mysqli;
        if(!$this->is_login_exists($login))
        {
            $this->log_exists = false;
            return false;
        }
        $us_info = $mysqli->query("SELECT * FROM users WHERE login = '".$login."'")->fetch_row();
                if (strcmp($us_info[0], $login) === 0){
                    $res = password_verify($psw, $us_info[1]);
                    if ($res)
                    {
                        $_SESSION['login'] = $us_info[0];
                        $_SESSION['email'] = $us_info[2];
                    }
                    return ($res);
                }
                return false;
    }

    public function show_content()
    {
        if(!$this->log_exists){ ?>
            <label style="display: table; margin: 0 auto;" class="text-danger">Пользователя с таким логином не существует</label><?php
        }
        elseif (!$this->log_ok){?>
            <label style="display: table; margin: 0 auto;" class="text-danger">Пароль или логин введены не верно</label><?php }
        else{
            if(isset($_SESSION['login']))
            print($_SESSION['login']);
        }
        ?>
        <div class = "py-5">
            <h4 style="display: table; margin: 0 auto; padding-bottom: 5px;">
                Вход
            </h4>
        <form action="login.php" method="post">
            <table style="margin: auto;">
                <tr>
                    <td>Ваш логин:</td><td><input type="text" name="login" maxlength="30"></td>
                </tr>
                <tr>
                    <td>Ваш пароль:</td><td><input type="password" name="psw" maxlength="30"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top: 5px; text-align: center;"><input class = "btn btn-outline-dark" type="submit" value="Войти" style="margin: auto;"></td>
                </tr>
            </table>
            <label style="display: table; margin: 0 auto;">
                Нет аккаунта? <a href="register.php">Зарегистрируйтесь</a>
            </label>
        </form>
        </div>
        <?php
    }
}

new page(new login());