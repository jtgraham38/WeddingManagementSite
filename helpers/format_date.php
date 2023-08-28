<?php
function format_date($date_str){
    $datetime = new DateTime($date_str);
    return $datetime->format('j F Y, g:i A');
}
?>