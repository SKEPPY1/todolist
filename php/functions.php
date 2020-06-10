<?php

// XSS対策　エスケープ処理
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

?>