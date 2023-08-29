<?php
function get_setting($name){
    return query('SELECT value FROM settings WHERE name = ?;', [$name])[0]['value'];
}

?>