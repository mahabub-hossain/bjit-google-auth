<?php
require_once __DIR__ .('/src/Google/GoogleLogin.php');
$config = include('config.php');//storing config information.
$google = new BJIT\Google\GoogleLogin($config);//creating object of GoogleLogin and passing $config.
$url = $google->getUrl();//calling getUrl() method which return authenticate url
?>
<a href="<?php echo $url;?>">Google Login</a>
