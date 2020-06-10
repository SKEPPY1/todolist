
<?php
session_start();
require('../dbconnect.php');
require('../functions.php');

if ($_COOKIE['email'] !== ''){
    $email = $_COOKIE['email'] ;
}

if (!empty($_POST)){
    $arr = [];
    $arr[] = $_POST['email'];
    // $email = $_POST['email'];

    if ($_POST['email'] !== '' && $_POST['password'] !== '' ){
        $login = $db->prepare('SELECT * FROM user_info WHERE email=?');
        $login->execute($arr);

        $user = $login->fetch();

        if(password_verify($_POST['password'], $user['password'])){
            $_SESSION['id'] = $user['id'];
            $_SESSION['time'] = time();

            if ($_POST['save'] === 'on') {
                setcookie('email', $_POST['email'], time()+60*60*24*14);
            }

            header('Location: ../todo/top.php');
            exit();
        }else{
            $error['login'] = 'failed';
        }
    }
}
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://kit.fontawesome.com/a81368914c.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../../css/login.css">
<title>ログイン</title>
</head>
<body>
    <div class="container">
        <div class="login-content">
            <form action="" method="post">
                <img src="../../img/avatar.svg">
                <h2 class="title">ログイン</h2>
                <div class="input-container">
                    <div class="div">
                        <input class="input" type="email" name="email" required=”true” placeholder="メールアドレス" 
                        value="<?php echo h($_COOKIE['email']) ?>"><br>
                    </div>
                </div>
                <div class="input-container">
                    <div class="div">
                        <input class="input" type="password" name="password" required=”true” placeholder="パスワード" 
                        value="<?php echo h($_POST['password']) ?>"><br>
                    </div>
                </div>

                <input id="save" type="checkbox" name="save" value="on">
                <label for="save">次回から自動的にログイン</label>
                <input class="btn" type="submit" value="ログイン"><br>

                <?php if ($error['login'] === 'failed') :?>
                    <p>ログイン失敗。正しく記入してください。</p><br>
                <?php endif; ?>
                <a href="register.php">新規登録</p>
            </form>
        </div>
    </div>
</body>
</html>