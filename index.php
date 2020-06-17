<?php
require_once __DIR__ .('/src/Google/GoogleLogin.php');

$config = include('config.php');//storing config information.
//Will receive a code in url after redirect in landing page
if(isset($_GET['code'])){
    $code = $_GET['code'];//storing code
    $google = new BJIT\Google\GoogleLogin($config);//creating object of GoogleLogin and passing $config.
    $tokenInfo = $google->getAccesstoken($code);//To get Access Token  we need to pass $code as parameter
    var_dump($tokenInfo);
}
//To regenerate access token
$refreshtoken = $google->getRefreshtoken($tokenInfo->refresh_token);//After expiration of access token, regenerate access token with the use of refresh token
var_dump($refreshtoken);