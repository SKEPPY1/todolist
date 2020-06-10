<?php
session_start();
require('../dbconnect.php');
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
    $_SESSION['time'] = time();

    $users = $db->prepare('SELECT * FROM user_info WHERE id=?');
    $users->execute(array($_SESSION['id']));
    $user = $users->fetch();
}else {
    header('Location: index.php');
    exit();
}
?>