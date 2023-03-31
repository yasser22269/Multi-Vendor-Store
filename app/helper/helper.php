<?php

define('PAGINATION_COUNT', 10);

function uploadImage($folder,$image){
    $image->store('/', $folder);
    $filename = $image->hashName();
    return  $filename;
}

function replaceurl($url){
    return   str_replace('http://127.0.0.1:8000/', '',  $url);
}

