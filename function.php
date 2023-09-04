<?php

    // generating digits
    function generateDigits($len) {
        $string = "12345678905550987654321";
        $string = str_shuffle($string);
        $string_code = substr($string, 0, $len);

        return $string_code;
    }


?>