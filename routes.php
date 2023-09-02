<?php
//define routes to handler mapping
$routes = [
    '/' => 'home',
    '/home' => 'home',
    '/calendar' => 'calendar',
    '/photos' => 'photos',
    '/registry' => 'registry',
    '/rsvp' => 'rsvp',

    //handlers for admin
    '/setup-admin'     => 'setup_admin',
    '/dashboard'        => 'admin_dashboard',
    '/dashboard/details'    =>  'details_settings',
    '/dashboard/guest-list'    =>  'guest_list_settings',
    '/dashboard/calendar'    =>  'calendar_settings',
    '/dashboard/photos'    =>  'photos_settings',
    '/dashboard/registry'    =>  'registry_settings',


    //handlers for forms
    '/handle_setup_admin' => 'handle_setup_admin',
    '/handle_login'       => 'handle_login',
    '/handle_logout'       => 'handle_logout',
    '/handle_add_event'     =>  'handle_event',
    '/handle_delete_event'  =>  'handle_delete_event',
    '/handle_update_settings' => 'handle_settings',
    '/handle_rsvp'          =>    'handle_rsvp',
    '/handle_toggle_admin'  => 'handle_toggle_admin',
    '/handle_toggle_attending' => 'handle_toggle_attending',
    '/handle_add_registry_item' => 'handle_add_registry_item',
    '/handle_delete_registry_item'   =>  'handle_delete_registry_item',
    '/handle_add_photo' =>  'handle_add_photo',
    '/handle_delete_photo' =>  'handle_delete_photo',
    '/handle_guest_claim_registry_item' => 'handle_guest_claim_registry_item',
    '/handle_guest_unclaim_registry_item' => 'handle_guest_unclaim_registry_item',
];

//define handler functions
function home(){
    //check if there is an admin user in the db
    $query = 'SELECT COUNT(*) FROM guests WHERE admin = TRUE;';
    if (intval(query($query)[0]['COUNT(*)']) < 1){
        header("Location: /setup-admin");
        return;
    }

    //get details content
    ob_start();
    include('./templates/pages/details.php');
    $content = ob_get_contents();
    ob_end_clean();
    

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

    //get calendar content
    ob_start();
    include('./templates/pages/calendar.php');
    $content = ob_get_contents();
    ob_end_clean();

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

    //get photos content
    ob_start();
    include('./templates/pages/photos.php');
    $content = ob_get_contents();
    ob_end_clean();

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

    //get registry content
    ob_start();
    include('./templates/pages/registry.php');
    $content = ob_get_contents();
    ob_end_clean();

    //include main template
    include('./templates/main.php');
}

function rsvp(){
    //set content of page
    $query = 'SELECT COUNT(*) FROM guests WHERE admin = TRUE;';
    if (intval(query($query)[0]['COUNT(*)']) < 1){
        header("Location: /setup-admin");
        return;
    }

    //get rsvp content
    ob_start();
    include('./templates/pages/rsvp.php');
    $content = ob_get_contents();
    ob_end_clean();

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

//admin screens
function admin_dashboard(){
    //include dashboard template

    if (!is_admin()){
        $_SESSION['flash_message'] = "You don't have permission to view that page!";
        header('Location: /');
        return;
    }

    //redirect to details page
    header('Location: /dashboard/details');
}

function details_settings(){
    //return details settings content

    if (!is_admin()){
        $_SESSION['flash_message'] = "You don't have permission to view that page!";
        header('Location: /');
        return;
    }

    //get details admin page
    ob_start();
    include('./templates/admin/details_admin.php');
    $content = ob_get_contents();
    ob_end_clean();

    include('./templates/admin/admin.php');
}

function guest_list_settings(){
    //return guest list content

    if (!is_admin()){
        $_SESSION['flash_message'] = "You don't have permission to view that page!";
        header('Location: /');
        return;
    }

    //get guest list admin page
    ob_start();
    include('./templates/admin/guest_list_admin.php');
    $content = ob_get_contents();
    ob_end_clean();

    include('./templates/admin/admin.php');
}

function calendar_settings(){
    //return calendar settings content

    if (!is_admin()){
        $_SESSION['flash_message'] = "You don't have permission to view that page!";
        header('Location: /');
        return;
    }

    //get calendar admin page
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

    //get registry admin page
    ob_start();
    include('./templates/admin/photos_admin.php');
    $content = ob_get_contents();
    ob_end_clean();

    include('./templates/admin/admin.php');
}

function registry_settings(){
    //return registry settings

    if (!is_admin()){
        $_SESSION['flash_message'] = "You don't have permission to view that page!";
        header('Location: /');
        return;
    }

    //get registry admin page
    ob_start();
    include('./templates/admin/registry_admin.php');
    $content = ob_get_contents();
    ob_end_clean();

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
        $_SESSION['flash_message'] = "Welcome, " . $_POST['fname'] . " " . $_POST['lname'] . "!";
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
            header("Location: /");
            return;
        }
        
        //ensure user is admin
        if (!is_admin()){
            $_SESSION['flash_message'] = "You don't have permission to view that page!";
            header('Location: /');
            return;
        }

        //validate start dates TODO: ensure dates are in future
        $start_date = new DateTime($_POST['start_date']);
        $end_date = new DateTime($_POST['end_date']);
        if ($start_date > $end_date){
            //if the start date entered was after the entered end date
            $_SESSION['flash_message'] = "The end date must be after the start date!";
            header("Location: /dashboard/calendar");
            return;
        }

        //validate that both dates are in the future
        $now = new DateTime();
        if ($start_date < $now || $end_date < $now){
            //if the start or end date is before now
            $_SESSION['flash_message'] = "Both dates must be in the future!";
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
            $query = 'UPDATE calendar_items SET start_datetime = ?, end_datetime = ?, name = ?, description = ?, location = ? WHERE id=?;';
            query($query, [$_POST['start_date'], $_POST['end_date'], $_POST['name'], $_POST['desc'], $_POST['location'], $_POST['event_id']]);

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

        //ensure user is admin
        if (!is_admin()){
            $_SESSION['flash_message'] = "You don't have permission to view that page!";
            header('Location: /');
            return;
        }

        //TODO: handle direct post to this endpoint to delete "Wedding Day" event

        //delete the event
        $query = 'DELETE FROM calendar_items WHERE id = ? AND name != "Wedding Day";';
        query($query, [$_POST['event_id']]);

        $_SESSION['flash_message'] = "Event deleted!";
        header('Location: /dashboard/calendar');
        return;
    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        header("Location: /");
        return;
    }
}

function handle_settings(){

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            header("Location: /");
            return;
        }

        //ensure user is admin
        if (!is_admin()){
            $_SESSION['flash_message'] = "You don't have permission to view that page!";
            header('Location: /');
            return;
        }

        //update db records
        $args = [];
        foreach ($_POST as $name=>$value){
            if ($name != 'csrf_token'){
                $args[] = $name;
                $args[] = $value;
            }
            //NOTE: if the query changes number of '?', this system of creating args could get messed up
        }

        $query = "UPDATE settings
        SET value = CASE " . 
        str_repeat("WHEN name = ? THEN ? ", count($_POST) - 1)
        . "END;";
        query($query, $args);

        //redirect on success
        $_SESSION['flash_message'] = "Settings updated!";
        header('Location: /dashboard/details');
        return;
    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        header("Location: /dashboard/details");
        return;
    }
}

function handle_rsvp() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            header("Location: /");
            return;
        }

        //validate rsvp_key
        if ($_POST['rsvp_key'] != get_setting('rsvp_key')){
            $_SESSION['flash_message'] = "Incorrect RSVP code!";
            header("Location: /rsvp");
            return;
        }

        //ensure passwords match and are long enouch
        if (strlen($_POST['password']) < 5){
            $_SESSION['flash_message'] = "That password is too short!";
            header("Location: /rsvp");
            return;
        }
        else if ($_POST['password'] != $_POST['confirm_password']){
            $_SESSION['flash_message'] = "Those passwords do not match!";
            header("Location: /rsvp");
            return;
        }

        //insert user into db
        $query = 'INSERT INTO guests (fname, lname, email, password_hash, phone, attending, admin) VALUES (?, ?, ?, ?, ?, 1, 0);';
        query($query, [$_POST['fname'], $_POST['lname'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['phone'] ]);

        if (!logged_in()){
            //get id
            $query = 'SELECT id FROM guests WHERE email = ?;';
            $id = query($query, [$_POST['email']])[0]['id'];

            //log user in
            $_SESSION['flash_message'] = "Welcome, " . $record['fname'] . " " . $record['lname'] . "!";
            $_SESSION['user_id'] = $id;
            $_SESSION['is_admin'] = 0;
            $_SESSION['fname'] = $_POST['fname'];
            $_SESSION['lname'] = $_POST['lname'];
        }

        //redirect on success
        $_SESSION['flash_message'] = "Your RSVP was successful!";
        header('Location: /rsvp');
        return;
    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        header("Location: /dashboard/details");
        return;
    }
}

function handle_toggle_admin(){

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            header("Location: /");
            return;
        }

        //ensure user is admin
        if (!is_admin()){
            $_SESSION['flash_message'] = "You don't have permission to view that page!";
            header('Location: /');
            return;
        }

        //ensure there is at least one admin
        $query = 'SELECT COUNT(*) FROM guests WHERE admin = TRUE;';
        if (intval(query($query)[0]['COUNT(*)']) <= 1 && !isset($_POST['is_admin'])){
            $_SESSION['flash_message'] = "There must be at least one admin!";
            header("Location: /dashboard/guest-list");
            return;
        }

        //update user record, toggling admin
        foreach ($_POST as $key=>$value){
            if ($key != 'csrf_token'){
                $query = 'UPDATE guests SET admin = ? WHERE id=?;';
                query($query, [$_POST['is_admin'] ? 1 : 0, $_POST['guest_id']]);
                break;
            }
        }
        

        //redirect on success
        $_SESSION['flash_message'] = "User permissions adjusted!";
        header('Location: /dashboard/guest-list');
        return;
    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        header("Location: /dashboard/details");
        return;
    }
}

function handle_toggle_attending(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            header("Location: /");
            return;
        }

        //ensure user is admin
        if (!is_admin()){
            $_SESSION['flash_message'] = "You don't have permission to view that page!";
            header('Location: /');
            return;
        }

        //update user record, toggling admin
        foreach ($_POST as $key=>$value){
            if ($key != 'csrf_token'){
                $query = 'UPDATE guests SET attending = ? WHERE id=?;';
                query($query, [$_POST['is_attending'] ? 1 : 0, $_POST['guest_id']]);
                break;
            }
        }
        

        //redirect on success
        $_SESSION['flash_message'] = "User attendance updated!";
        header('Location: /dashboard/guest-list');
        return;
    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        header("Location: /dashboard/details");
        return;
    }
}

function handle_add_registry_item(){
    //handle adding and editing of a registry item
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            //header("Location: /");
            return;
        }
        
        //ensure user is admin
        if (!is_admin()){
            $_SESSION['flash_message'] = "You don't have permission to view that page!";
            header('Location: /');
            return;
        }

        //format all post links correctly
        if (substr($_POST['url'], 0, 8) != "https://"){ $_POST['url'] = 'https://' . $_POST['url']; }

        if (substr($_POST['aff_url'], 0, 8) != "https://"){ $_POST['aff_url'] = 'https://' . $_POST['aff_url']; }

        if (substr($_POST['img_url'], 0, 8) != "https://"){ $_POST['img_url'] = 'https://' . $_POST['img_url']; }

        //check if the event already exists
        if (!$_POST['item_id']){
            //if this is a new event being added
            $query = 'INSERT INTO registry_items (name, source, url, affiliate_url, image_url) VALUES (?, ?, ?, ?, ?);';
            query($query, [$_POST['name'], $_POST['source'], $_POST['url'], $_POST['aff_url'], $_POST['img_url']]);

            $_SESSION['flash_message'] = "Item added!";
        }else{
            //else, if this is an event being edited
            $query = 'UPDATE registry_items SET name = ?, source = ?, url = ?, affiliate_url = ?, image_url = ? WHERE id=?;';
            query($query, [$_POST['name'], $_POST['source'], $_POST['url'], $_POST['aff_url'], $_POST['img_url'], $_POST['item_id']]);

            $_SESSION['flash_message'] = "Event updated!";
        }

        header('Location: /dashboard/registry');
        return;

    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        //header("Location: /");
        return;
    }
}

function handle_delete_registry_item(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            header("Location: /");
            return;
        }

        //ensure user is admin
        if (!is_admin()){
            $_SESSION['flash_message'] = "You don't have permission to view that page!";
            header('Location: /');
            return;
        }

        //delete the event
        $query = 'DELETE FROM registry_items WHERE id = ?;';
        query($query, [$_POST['item_id']]);

        $_SESSION['flash_message'] = "Item deleted!";
        header('Location: /dashboard/registry');
        return;
    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        header("Location: /");
        return;
    }
}

function handle_add_photo(){
    //handle adding and editing of a registry item
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            header("Location: /");
            return;
        }
        
        //ensure user is admin
        if (!is_admin()){
            $_SESSION['flash_message'] = "You don't have permission to view that page!";
            header('Location: /');
            return;
        }

        //save photo
        $success = upload_file();

        //ensure upload success
        if (!$success){
            //flash message set in upload_file
            header('Location: /dashboard/photos');
            return;
        }
        
        $_SESSION['flash_message'] = "Photo uploaded!";
        header('Location: /dashboard/photos');
        return;

    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        //header("Location: /");
        return;
    }
}

function handle_delete_photo(){
    //handle adding and editing of a registry item
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            header("Location: /");
            return;
        }
        
        //ensure user is admin
        if (!is_admin()){
            $_SESSION['flash_message'] = "You don't have permission to view that page!";
            header('Location: /');
            return;
        }

        //save photo 
        $success = delete_uploaded_file($_POST['photo']);
        
        //ensure upload success
        if (!$success){
            //flash message set in delete_uploaded_file
            header('Location: /dashboard/photos');
            return;
        }
        
        $_SESSION['flash_message'] = "Photo Deleted!";
        header('Location: /dashboard/photos');
        return;

    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        //header("Location: /");
        return;
    }
}

function handle_guest_claim_registry_item(){

    //handle claiming a registry item
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            header("Location: /");
            return;
        }
        
        //ensure user is logged in
        if (!logged_in()){
            $_SESSION['flash_message'] = "You must be logged in to claim a registry item!";
            header('Location: /registry');
            return;
        }

        //set user id key in registry item
        $query = 'UPDATE registry_items SET buyer_id = ? WHERE id=?;';
        query($query, [$_SESSION['user_id'], $_POST['item_id']]);
        
        $_SESSION['flash_message'] = "Item Claimed!";
        header('Location: /registry');
        return;

    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        //header("Location: /");
        return;
    }
}

function handle_guest_unclaim_registry_item(){
    //handle claiming a registry item
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        //ensure csrf protection
        if (!validate_csrf_token()){
            $_SESSION['flash_message'] = "CSRF token is invalid... nice try!";
            header("Location: /");
            return;
        }
        
        //ensure user is logged in
        if (!logged_in()){
            $_SESSION['flash_message'] = "You must be logged in to unclaim a registry item!";
            header('Location: /registry');
            return;
        }

        //set user id key in registry item
        $query = 'UPDATE registry_items SET buyer_id = NULL WHERE id=?;';
        query($query, [$_POST['item_id']]);
        
        $_SESSION['flash_message'] = "Item Unclaimed!";
        header('Location: /registry');
        return;

    }else{
        $_SESSION['flash_message'] = "That method is not allowed!";
        //header("Location: /");
        return;
    }
}

?>