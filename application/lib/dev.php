<?php
function debug($str){
    echo '<pre>', var_dump($str), '</pre>';
    exit();
}