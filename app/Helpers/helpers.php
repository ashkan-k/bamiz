<?php

if (!function_exists('Slugify')){
    function Slugify($string){
        return preg_replace('/\s+/u', '-', trim($string));
    }
}

if (!function_exists('CalculateTaskAmount')){
    function CalculateTaskAmount($amount){
        return intval(round(($amount * 9) / 100));
    }
}

if (!function_exists('CalculateAmountWithoutTask')){
    function CalculateAmountWithoutTask($amount){
        return intval(round($amount - CalculateTaskAmount($amount)));
    }
}
