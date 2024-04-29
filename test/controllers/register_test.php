<?php
require_once 'vendor/autoload.php';

use form_tools;

try {
    $empty_params = [];
    // $result = register\verify_all_params($empty_params);
    $result = form_tools\is_date_valid('2021-01-01');
    echo "TEST REUSSI \n";
} catch (\Throwable $th) {
    echo $th->getMessage()."\n";
}