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

if (!function_exists('generateUid')) {
    function generateUid($prefix = null, $length = 8)
    {
        $alphabet = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
        $id = '';
        $maxIndex = strlen($alphabet) - 1;

        for ($i = 0; $i < $length; $i++) {
            $id .= $alphabet[random_int(0, $maxIndex)];
        }
        return $prefix . $id;
    }
}
