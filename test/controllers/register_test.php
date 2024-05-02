<?php
require_once 'vendor/autoload.php';

require_once 'src/controllers/register.php';
require_once 'test/tools/colors.php';

use controllers\register;
use colors;

try {
    echo colors\yellow("TEST register.php \n");
    
    //Test formulaire sans paramètres
    $empty_params = [];
    $result = register\verify_all_params($empty_params);
    echo "TEST empty params : ".(($result==False) ? colors\green("PASSED"):colors\red("FAILED"))."\n";
    
    //Test formulaire paramètres valides
    $valid_params = [
        'nom' => 'Doe',
        'prenom' => 'John',
        'date_naissance' => '1990-01-01',
        'sexe' => 'homme',
        'email' => 'john@gmail.com',
        'telephone' => '0123456789',
        'mdp' => 'Azertyuiop'
    ];
    $result = register\verify_all_params($valid_params);
    echo "TEST formulaire valide : ".(($result==True) ? colors\green("PASSED"):colors\red("FAILED"))."\n";

    //Test mdp trop court
    $params_short_mdp = $valid_params;
    $params_short_mdp['mdp'] = 'Azerty';
    $result = register\verify_all_params($params_short_mdp);
    echo "TEST mdp trop court : ".(($result==False) ? colors\green("PASSED"):colors\red("FAILED"))."\n";

    // Test date invalide
    $params_invalid_date = $valid_params;
    $params_invalid_date['date_naissance'] = '1990-01-32';
    $result = register\verify_all_params($params_invalid_date);
    echo "TEST date invalide : ".(($result==False) ? colors\green("PASSED"):colors\red("FAILED"))."\n";

    //Test email invalide
    $params_invalid_email = $valid_params;
    $params_invalid_email['email'] = 'john@gmail';
    $result = register\verify_all_params($params_invalid_email);
    echo "TEST email invalide : ".(($result==False) ? colors\green("PASSED"):colors\red("FAILED"))."\n";

    //Test téléphone invalide
    $params_invalid_phone = $valid_params;
    $params_invalid_phone['telephone'] = '012345678';
    $result = register\verify_all_params($params_invalid_phone);
    echo "TEST téléphone invalide : ".(($result==False) ? colors\green("PASSED"):colors\red("FAILED"))."\n";

    echo colors\yellow("TEST FINI \n");
} catch (Exception $th) {
    echo $th->getMessage()."\n";
}