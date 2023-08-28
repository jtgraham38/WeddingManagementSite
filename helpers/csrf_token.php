<?php
//generate csrf token
function create_csrf_token(){
    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_tokens'][] = [$csrf_token, 1];
    return $csrf_token;
}

//validate a csrf token
function validate_csrf_token(){
    if (isset($_POST['csrf_token'])){
        
        foreach ($_SESSION['csrf_tokens'] as $i=>$pair){
            $token = $pair[0];

            if (hash_equals($token, $_POST['csrf_token'])){
                unset($_POST['csrf_tokens'][$i]);
                return true;
            }
        }
        return false;
    }
    return false;

}

function clean_csrf_tokens(){
    $new = [];
    foreach ($_SESSION['csrf_tokens'] as $i=>$pair){
        $life = $pair[1];
        //var_dump($pair);
        //echo "<hr>";

        if ($life > 0){
            $new[] = [$pair[0], $pair[1] - 1];
        }
    }
    $_SESSION['csrf_tokens'] = $new;
}
?>