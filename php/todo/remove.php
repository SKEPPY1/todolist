<?php

if($_POST){
    require('../dbconnect.php');

    $id = $_POST['id'];
    $stmt = $db->prepare("DELETE FROM todos WHERE id=?");
    $stmt->execute([$id]);
    header("Location: ./top.php");
}