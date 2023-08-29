<?php
//start session
session_start();

//clean output buffer
ob_clean();

//include helper files
include('./helpers/db_connection.php');
include('./helpers/csrf_token.php');
include('./helpers/authorization.php');
include('./helpers/format_date.php');
include('./helpers/settings.php');
//TODO: add validation to make sure all inputs received from forms are not larger than the cols they are going to be entered in to

//include routes
include('./routes.php');

//handle routes
$requested_path = $_SERVER['REQUEST_URI'];
if (isset($routes[$requested_path])) {
    $func_name = $routes[$requested_path];
    if (function_exists($func_name)) {

        //generate page content/handle forms
        call_user_func($func_name);

        //clean csrf tokens
        clean_csrf_tokens();
        
        //handle flash messages
        if (!strpos($requested_path, 'handle')){    //if it is not a handler function... (all handlers must contain "handle" in the path)
            if (isset($_SESSION['flash_message']) && $_SESSION['flash_message']) {
                ?> 
                    <div style="position: fixed; left: 10px; top: 5px; background-color: lightgray; z-index: 1000;" class="notification">
                        <button class="delete" onclick="event.target.parentNode.remove()"></button>
                        <?= htmlspecialchars($_SESSION['flash_message']) ?>
                    </div>
                <?php
                unset($_SESSION['flash_message']); // clear the flash message session variable
            }
        }
    } else {
        echo "404 - Page not found (no func)";
    }
} else {
    echo "404 - Page not found (no route)";
}
?>