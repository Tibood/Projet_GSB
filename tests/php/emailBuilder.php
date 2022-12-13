<?php

require '../../vendor/autoload.php';
//require '../../config/define.php';
use SendinBlue\Client\Configuration;
//use SendinBlue\Client\Api\SendersApi;

$config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

$apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
    new GuzzleHttp\Client(),
    $config
);
$sendSmtpEmail = new SendinBlue\Client\Model\SendSmtpEmail();
$sendSmtpEmail['subject'] = "Code d'authentification à 2 facteurs";
$sendSmtpEmail['htmlContent'] = '<html><body><h1>Votre code : ' . rand(1000, 9999) . '</h1></body></html>';
$sendSmtpEmail['sender'] = array('name' => 'Verification GSB', 'email' => 'adrien.dodero@gmail.com');
$sendSmtpEmail['to'] = array(
    array('email' => 'Verif.A2F.GSB.ATR@protonmail.com', 'name' => 'Utilisateur GSB')
);

try {
    $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
}