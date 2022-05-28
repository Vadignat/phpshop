<?php
require_once 'pageContent.php';
require_once 'page.php';

class register extends pageContent
{
    private bool $reg_ok = true;
    private bool $login_exists = false;

    public function __construct(){
        $this->protected_page = false;
        $this->register();
    }

    private function register(){
        // 1. Проверить, что логин не пуст и не занят
        // 2. Проверить, что пароль по длине >= 6 символам
        // 3. Проверить, что пароли совпадают
        // 4. Сохранить пользователя
        if (!isset($_POST['reg'])) return;
        if (
            !isset($_POST['login']) ||
            !isset($_POST['psw']) ||
            !isset($_POST['psw2']) ||
            !isset($_POST['email'])
        ) {
            $this->reg_ok = false;
            return;
        }
        $login = trim($_POST['login']);
        $psw = trim($_POST['psw']);
        $psw2 = trim($_POST['psw2']);
        $email = trim($_POST['email']);
        global $mysqli;
        if($this->is_login_exists($login))
        {
            $this->login_exists = true;
            return;
        }
        if (
            mb_strlen($login) == 0 ||
            mb_strlen($psw) < 6 ||
            strcmp($psw, $psw2) !== 0
        ) {
            $this->reg_ok = false;
            return;
        }
        $hpsw = password_hash($psw, PASSWORD_DEFAULT);
        $mysqli->query( "INSERT INTO users(LOGIN, PSW, EMAIL) VALUES('".$login."','".$hpsw."','".$email."')") or die(mysqli_error());
        if($this->is_login_exists($login))
        {
            header("Location: login.php");
        }
    }

    private function is_login_exists($login):bool
    {
        global $mysqli;
        return $mysqli->query("SELECT 1 FROM users WHERE login = '".$login."'")->num_rows > 0;
    }

    public function show_content()
    {
        if (!$this->reg_ok)
            print 'Все плохо!';
        if($this->login_exists):
        ?>
              <label style="display: table; margin: auto;" class="text-danger">Пользователь с таким логином уже существует</label>
        <?php endif?>
        <div class="py-5">
        <form action="register.php" method="post">
            <h4 style="display: table; margin: 0 auto; padding-bottom: 5px;">
                Регистрация
            </h4>
            <label style="display: table; margin: auto; padding-bottom: 10px;">
                (Пароль должен содержать минимум 6 символов)
            </label>
            <input type="hidden" name="reg" value="1">
            <table style="margin: auto;">
                <tr>
                    <td>Ваш логин:</td><td><input type="text" name="login" maxlength="30"></td>
                </tr>
                <tr>
                    <td>Ваш пароль:</td><td><input type="password" name="psw" maxlength="30"></td>
                </tr>
                <tr>
                    <td>Повтор пароля:</td><td><input type="password" name="psw2" maxlength="30"></td>
                </tr>
                <tr>
                    <td>Ваша эл-почта:</td><td><input type="email" name="email" maxlength="100"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top: 5px; text-align: center;"><input class="btn btn-outline-dark" type="submit" value="Зарегистрироваться" style="margin: auto;"></td>
                </tr>
            </table>
        </form>
        </div>
        <?php
    }
}

new page(new register());