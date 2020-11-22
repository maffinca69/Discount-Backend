<?php

if (!function_exists('removeMask')) {

    /**
     * @param string $phone
     * @return string
     */
    function removeMask(string $phone): string
    {
        return preg_replace('/\D+/', '', $phone);
    }
}

if (!function_exists('addMask')) {

    /**
     * @param $phone
     * @return string|string[]|null
     */
    function addMask($phone) {
        return preg_replace(
            [
                '/[\+]?([\d])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/'
            ],
            '+$1 ($2) $3-$4-$5', $phone
        );

    }
}
