<?php


if (!function_exists('prt')) {
    function prt($data, bool $dieFlag = true)
    {
        if ($dieFlag == true) {
            print_r($data);
            die;
        }
        print_r($data);
        return;
    }
};
