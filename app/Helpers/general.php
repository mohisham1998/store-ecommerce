<?php

const PAGINATION_COUNT = 15;



function getFolder(){

    return app() -> getLocale() == 'ar' ? 'css-rtl' : 'css';
}



function getCategoryType($type) {

    return $type === 'main' ? 'main' : 'child';
}

function uploadImage($folder,$image){
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/'.$folder. '/'. $filename;
    return  $path;
}
