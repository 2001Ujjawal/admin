<?php


if (!function_exists('prt')) {
    function prt($data, bool $dieFlag = true)
    {
        if ($dieFlag == true) {
            print "<pre>";
            print_r($data);
            print "</pre>";
            die;
        }
        print "<pre>";
        print_r($data);
        print "</pre>";
        return;
    }
};
