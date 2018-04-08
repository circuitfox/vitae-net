<?php

if (!function_exists('d')) {
    /**
     * Converts a number to a string with
     * two decimal places if the decimal
     * part is greater than 0
     *
     * @param float $num
     * @return string
     */
    function d(float $num)
    {
        if (($num * 10) % 10 !== 0) {
            if (($num * 100) % 10 === 0) {
                return strval($num) . '0';
            }
        }
        return strval($num);
    }
}
