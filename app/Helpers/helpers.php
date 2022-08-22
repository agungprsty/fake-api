<?php

if(!function_exists('safe_int')){
    /**
     * Safely convert a string to an integer.
     */
    function safe_int(int $value, int $default = 0)
    {
        return $value ?: $default;
    }
}



