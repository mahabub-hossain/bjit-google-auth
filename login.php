<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once __DIR__ .('/src/Google/GoogleLogin.php');
$config = include('config.php');
$google = new BJIT\Google\GoogleLogin($config);
$url = $google->getUrl();
?>
<a href="<?php echo $url;?>">Google Login</a>
