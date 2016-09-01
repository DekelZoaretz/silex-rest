<?php

/**
 * @param $array
 * @param $key
 * @param string $defaultValue
 * @param bool $force
 * @return string
 */
function array_get($array, $key, $defaultValue = "", $force = false){
    $val = isset($array[$key])? $array[$key] : $defaultValue ;
    if($force)
        return (empty($val)) ? $defaultValue : $val;

    return $val;
}

/**
 * this function was created because that php cast string (true/false) to int
 * was not working properly
 *
 * @param $boolWord
 * @return int
 */
function castStringBoolToInt($boolWord){
    $returnValue = 0;
    if($boolWord === 'true' || $boolWord === true)
        $returnValue = 1;
    return $returnValue;
}

function mediaUrl($path){
    if($path === "")
    {
        return "";
    }
    return MEDIA_URL."$path";
}

