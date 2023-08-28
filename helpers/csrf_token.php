<?php
//generate csrf token
function create_csrf_token(){
    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;  
    return $csrf_token;
}

function validate_csrf_token(){
    if (isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        //CSRF token is valid, process the form data
        //...
        unset($_SESSION['csrf_token']); // Remove the used token
        return true;
    } else {
        //invalid CSRF token, handle the error
        return false;
    }
}
?>