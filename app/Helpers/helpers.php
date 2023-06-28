<?php

if (!function_exists('Slugify')){
    function Slugify($string){
        return preg_replace('/\s+/u', '-', trim($string));
    }
}
