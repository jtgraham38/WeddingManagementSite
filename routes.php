<?php
//define routes to handler mapping
$routes = [
    '/' => 'home',
    '/home' => 'home',
    '/calendar' => 'calendar',
    '/photos' => 'photos',
    '/registry' => 'registry',

    //handlers for admin
    '/setup-admin'     => 'setup_admin',
    '/dashboard'        => 'admin_dashboard',
    '/dashboard/details'    =>  'details_settings',
    '/dashboard/guest-list'    =>  'guest_list_settings',
    '/dashboard/calendar'    =>  'calendar_settings',
    '/dashboard/photos'    =>  'photos_settings',
    '/dashboard/registry'    =>  'registry_settings',
    '/dashboard/sitewide'    =>  'sitewide_settings',


    //handlers for forms
    '/handle_setup_admin' => 'handle_setup_admin',
    '/handle_login'       => 'handle_login',
    '/handle_logout'       => 'handle_logout',
    '/handle_add_event'     =>  'handle_event',
    '/handle_delete_event'  =>  'handle_delete_event',
];

//define handler functions
function home(){
    //check if there is an admin user in the db
    $query = 'SELECT COUNT(*) FROM guests WHERE admin = TRUE;';
    if (intval(query($query)[0]['COUNT(*)']) < 1){
        header("Location: /setup-admin");
        return;
    }

    //set content of page
    $content = "HOMEPAGE";
    

    //include main template
    include('./templates/main.php');
}

function calendar(){
    //set content of page
    $query = 'SELECT COUNT(*) FROM guests WHERE admin = TRUE;';
    if (intval(query($query)[0]['COUNT(*)']) < 1){
        header("Location: /setup-admin");
        return;
    }

    $content = "CALENDAR";

    //include main template
    include('./templates/main.php');
}

function photos(){
    //set content of page
    $query = 'SELECT COUNT(*) FROM guests WHERE admin = TRUE;';
    if (intval(query($query)[0]['COUNT(*)']) < 1){
        header("Location: /setup-admin");
        return;
    }

    $content = "PHOTOS";

    //include main template
    include('./templates/main.php');
}

function registry(){
    //set content of page
    $query = 'SELECT COUNT(*) FROM guests WHERE admin = TRUE;';
    if (intval(query($query)[0]['COUNT(*)']) < 1){
        header("Location: /setup-admin");
        return;
    }

    $content = "REGISTRY";

    //include main template
    include('./templates/main.php');
}

function setup_admin(){
    //if there is no admin user in the db, this page will be visited to seed the first admin user

    //ensure their is a need to set up a new admin
    $query = 'SELECT COUNT(*) FROM guests WHERE admin = TRUE;';
    if (intval(query($query)[0]['COUNT(*)']) > 0){
        $_SESSION['flash_message'] = "There is already an admin user in the site!";
        header("Location: /");
        return;
    }

    //get setup admin page
    ob_start();
    include('./templates/admin/setup_admin.php');
    $content = ob_get_contents();
    ob_end_clean();
    

    //include main setup template
    include('./templates/admin/setup.php');
}

//admin screens TODO: i need to protect these pages with admin access!
function admin_dashboard(){
    //include dashboard template

    if (!is_admin()){
        $_SESSION['flash_message'] = "You don't have permission to view that page!";
        header('Location: /');
        return;
    }

    $content = "Landing page!";
    
    include('./templates/admin/admin.php');
}

function details_settings(){
    //return details settings content

    if (!is_admin()){
        $_SESSION['flash_message'] = "You don't have permission to view that page!";
        header('Location: /');
        return;
    }

    $content = "Details";

    include('./templates/admin/admin.php');
}

function guest_list_settings(){
    //return guest list content

    if (!is_admin()){
        $_SESSION['flash_message'] = "You don't have permission to view that page!";
        header('Location: /');
        return;
    }

    $content = "Guest List (need ability to add/remove other admins here)";

    include('./templates/admin/admin.php');
}

function calendar_settings(){
    //return calendar settings content

    if (!is_admin()){
        $_SESSION['flash_message'] = "You don't have permission to view that page!";
        header('Location: /');
        return;
    }

    //get setup admin page
    ob_start();
    include('./templates/admin/calendar_admin.php');
    $content = ob_get_contents();
    ob_end_clean();

    include('./templates/admin/admin.php');
}

function photos_settings(){
    //return photos settings content

    if (!is_admin()){
        $_SESSION['flash_message'] = "You don't have permission to view that page!";
        header('Location: /');
        return;
    }

    $content = "Photos";

    include('./templates/admin/admin.php');
}

function registry_settings(){
    //return registry settings

    if (!is_admin()){
        $_SESSION['flash_message'] = "You don't have permission to view that page!";
        header('Location: /');
        return;
    }

    $content = "Registry";

    include('./templates/admin/admin.php');
}

function sitewide_settings(){
    //return sitewide settings

    if (!is_admin()){
        $_SESSION['flash_message'] = "You don't have permission to view that page!";
        header('Location: /');
        return;
    }

    $content = "Sitewide";

    include('./templates/admin/admin.php');
}

//form handlers
function handle_setup_admin(){
    //handle the form for creating the first admin
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        
        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            header("Location: /setup-admin");
            return;
        }

        //ensure email is not in db already
        $query = 'SELECT COUNT(*) FROM guests WHERE email = ?;';
        if (query($query, [$_POST['email']])[0]['COUNT(*)'] > 0){
            $_SESSION['flash_message'] = "That email is taken!";
            header("Location: /setup-admin");
            return;
        }

        //ensure passwords match and are long enouch
        if (strlen($_POST['password']) < 5){
            $_SESSION['flash_message'] = "That password is too short!";
            header("Location: /setup-admin");
            return;
        }
        else if ($_POST['password'] != $_POST['confirm_password']){
            $_SESSION['flash_message'] = "Those passwords do not match!";
            header("Location: /setup-admin");
            return;
        }

        //insert new admin
        $query = 'INSERT INTO guests (fname, lname, email, password_hash, phone, attending, admin) VALUES (?, ?, ?, ?, ?, 1, 1);';
        query($query, [$_POST['fname'], $_POST['lname'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['phone'] ]);

        //get id
        $query = 'SELECT id FROM guests WHERE email = ?;';
        $id = query($query, [$_POST['email']])[0]['id'];

        //update session of current user to log them in
        $_SESSION['flash_message'] = "Welcome, " . $record['fname'] . " " . $record['lname'] . "!";
        $_SESSION['user_id'] = $id;
        $_SESSION['is_admin'] = 1;
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];

        header("Location: /dashboard");
        return;
    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        header("Location: /");
        return;
    }
}

function handle_login(){
    //authenticate the user
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            header("Location: /");
            return;
        }

        //get user password and id record from db
        $query = "SELECT id, password_hash, admin, fname, lname FROM guests WHERE email = ?;";
        $record = query($query, [$_POST['email']])[0];
        //var_dump($record);
        
        //ensure record for that user exists
        if (!$record){
            $_SESSION['flash_message'] = "No user with that email exists... please try again!";
            header("Location: /");
            return;
        }

        //validate password
        if (!password_verify($_POST['password'], $record['password_hash'])){
            $_SESSION['flash_message'] = "The entered password does not match the password on record... please try again!";
            header("Location: /");
            return;
        }

        //log the user in at this point, since they are now authenticated
        $_SESSION['flash_message'] = "Welcome, " . $record['fname'] . " " . $record['lname'] . "!";
        $_SESSION['user_id'] = $record['id'];
        $_SESSION['is_admin'] = $record['admin'];
        $_SESSION['fname'] = $record['fname'];
        $_SESSION['lname'] = $record['lname'];

        header("Location: /dashboard");
        return;

    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        header("Location: /");
        return;
    }
}

function handle_logout(){
    //unset sessions vars
    $_SESSION['flash_message'] = "Bye, " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!";

    foreach ($_SESSION as $key => $value) {
        if ($key != 'flash_message'){
            unset($_SESSION[$key]); // unset each session variable
        }
    }

    header("Location: /");
    return;
}

function handle_event(){
    //handle adding and editing of an event
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            //header("Location: /");
            return;
        }

        //TODO: ensure end date is after start date!
        $start_date = new DateTime($_POST['start_date']);
        $end_date = new DateTime($_POST['end_date']);
        if ($start_date > $end_date){
            //if the start date entered was after the entered end date
            $_SESSION['flash_message'] = "The end date must be after the start date!";
            header("Location: /dashboard/calendar");
            return;
        }

        //check if the event already exists
        if (!$_POST['event_id']){
            //if this is a new event being added
            $query = 'INSERT INTO calendar_items (start_datetime, end_datetime, name, description, location) VALUES (?, ?, ?, ?, ?);';
            query($query, [$_POST['start_date'], $_POST['end_date'], $_POST['name'], $_POST['desc'], $_POST['location']]);

            $_SESSION['flash_message'] = "Event added!";
        }else{
            //else, if this is an event being edited
            $query = 'UPDATE calendar_items SET start_datetime = ?, end_datetime = ?, name = ?, description = ? WHERE id=?;';
            query($query, [$_POST['start_date'], $_POST['end_date'], $_POST['name'], $_POST['desc'], $_POST['event_id']]);

            $_SESSION['flash_message'] = "Event updated!";
        }

        header('Location: /dashboard/calendar');
        return;

    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        //header("Location: /");
        return;
    }

}

function handle_delete_event(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            header("Location: /");
            return;
        }

        //delete the event
        $query = 'DELETE FROM calendar_items WHERE id = ? AND name != "Wedding Day";';
        query($query, [$_POST['event_id']]);

        $_SESSION['flash_message'] = "Event deleted!";

        //TODO: THIS DOES NOT WORK

        header('Location: /dashboard/calendar');
        return;
    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        header("Location: /");
        return;
    }
}
?>