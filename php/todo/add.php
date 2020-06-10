<?php

if($_POST){
    require('../login/cookie.php');
    $title = $_POST['title'];
    $user_info_id = $user['id'];
    $stmt = $db->prepare("INSERT INTO todos(title, user_info_id) VALUE(?, ?)");
    $stmt->execute([$title, $user_info_id]);
    header("Location: ./top.php");
    }