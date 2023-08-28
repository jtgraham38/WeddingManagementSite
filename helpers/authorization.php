<?php
function logged_in(){
    return array_key_exists('user_id', $_SESSION); 
}

function is_admin(){
    return logged_in() && array_key_exists('is_admin', $_SESSION) && $_SESSION['is_admin'];
}

?>