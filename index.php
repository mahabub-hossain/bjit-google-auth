<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once __DIR__ .('/src/Google/GoogleLogin.php');
$config = include('config.php');

if(isset($_GET['code'])){
    $code = $_GET['code'];
    $google = new BJIT\Google\GoogleLogin($config);
    $tokenInfo = $google->getAccesstoken($code);
    echo 'Token  Info';
    echo '<pre>';
    print_r($tokenInfo);
    echo '<br><br>';
    //echo $tokenInfo->access_token;
     $refreshtoken = $google->getRefreshtoken($tokenInfo->refresh_token);
     echo 'Refresh token Info';
     echo '<pre>';
     print_r($refreshtoken);

}

//echo $url;
