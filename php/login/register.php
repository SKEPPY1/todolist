<?php
session_start();
require('../dbconnect.php');
require('../functions.php');


if (!empty($_POST)){
    if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i", $_POST['password'])){
        $error['password'] = 'password_error';
    }
    if($_POST['password'] !== $_POST['password_conf']){
        $error['password_conf'] = 'password_conf_error';
    }

    // アカウント(メールアドレス)の重複チェック
    if (empty($error)){
        $user = $db->prepare('SELECT COUNT(*) AS cnt FROM user_info WHERE email=?');
        $user->execute(array($_POST['email']));
        $record = $user->fetch();
        if ($record['cnt'] > 0) {
            $error['email'] = 'duplicate';
        }
    }
    if (empty($error)){
        $_SESSION['register'] = $_POST;
        header('Location: register_check.php');
        exit();
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
<title>新規登録</title>
</head>
<body>
    <div class="container">
        <div class="login-content">
            <form action="" method="post">
                <h2>新規登録</h2>
                <div class="input-container">
                    <div class="div">
                        <input type="text" name="name" required=”true” placeholder="ユーザー名(お好きな名前)" 
                        value="<?php echo h($_POST['name']) ?>"><br>
                    </div>
                </div>

                <div class="input-container">
                    <div class="div">
                        <input type="email" name="email" required=”true” placeholder="メールアドレス" 
                        value="<?php echo h($_POST['email']) ?>"><br>
                    </div>
                </div>

                <?php if ($error['email'] === 'duplicate') :?>
                    <p>すでに登録済みのアドレスです。</p>
                <?php endif; ?>


                <div class="input-container">
                    <div class="div">
                        <input type="password" name="password" required=”true” placeholder="パスワード"><br>
                    </div>
                </div>

                <div class="input-container">
                    <div class="div">
                        <input type="password" name="password_conf" required=”true” placeholder="確認パスワード"><br>
                    </div>
                </div>

                <?php if ($error['password'] === 'password_error') :?>
                    <p>パスワードは英数字8文字以上100文字以下にしてください。</p>
                <?php endif; ?>

                <?php if ($error['password_conf'] === 'password_conf_error') :?>
                    <p>パスワードと確認パスワードが一致しません。</p>
                <?php endif; ?>


                <input class="btn" type="submit" value="確認画面">
            </form>
        </div>
    </div>
</body>
</html>