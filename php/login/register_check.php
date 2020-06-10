<?php
session_start();
require('../functions.php');

if(!isset($_SESSION['register'])){
    header('Location: register.php');
    exit();
}


if (!empty($_POST)){
    require('../dbconnect.php');
    $arr = [] ;
    $arr[] = $_SESSION['register']['name'];
    $arr[] = $_SESSION['register']['email'];
    $arr[] = password_hash($_SESSION['register']['password'],PASSWORD_DEFAULT);
    //  $name = $_SESSION['register']['name'];
    //  $email = $_SESSION['register']['email'];
    //  $password = sha1($_SESSION['register']['password']);

     $sql = "INSERT INTO user_info (name,email,password) VALUES (?, ?, ?)";
     $stmt = $db->prepare($sql);
    //  $params = array($name,$email,$password);
     $stmt->execute($arr);

     unset($_SESSION['register']);

     header('Location: index.php');
     exit;
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
<title></title>
</head>
<body>

<div class="container">
    <div class="login-content">
        <form action="" method="post">
            <h2>新規登録</h2>
            <input type="hidden" name="action" value="submit"/>
                <p>ユーザー名:</p>
                <span><?php echo h($_SESSION['register']['name']) ?></span><br>
                <p>メールアドレス:</p>
                <span><?php echo h($_SESSION['register']['email']) ?></span><br>
                <p>パスワード:</p>
                <span><?php echo h($_SESSION['register']['password']) ?></span><br>
                <div class="register_check">
                    <a href="register.php"><input class="check" type="button" value="戻る"></a>
                    <input class="check" type="submit" value="新規登録">
                </div>
        </form>
        </div>
    </div>
</section>
</body>    
</html>