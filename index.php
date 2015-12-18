<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 
 <?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';


$fb = new Facebook\Facebook([
  'app_id' => '1666988080247658',
  'app_secret' => 'a9fdc5c7ee7ea999755a91835e3279ca',
  'default_graph_version' => 'v2.5',
  ]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes']; // optional
$loginUrl = $helper->getLoginUrl('http://phpstack-14183-30913-76146.cloudwaysapps.com/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
?>

 </body>
</html>
