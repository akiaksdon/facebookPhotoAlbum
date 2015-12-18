<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1666988080247658',
  'app_secret' => 'a9fdc5c7ee7ea999755a91835e3279ca',
  'default_graph_version' => 'v2.5',
  ]);

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;

  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}
$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

$request = $fb->request('GET', '/me');
try {
  $response = $fb->getClient()->sendRequest($request);
  $userNode = $response->getGraphUser();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

echo 'Logged in as ' . $userNode->getName();

$userName = $userNode->getName();
$userId = $userNode->getId();
echo 'https://graph.facebook.com/'.$userId.'/picture';
echo $userId;

// try getting albums links
$request = $fb->request('GET', '/'.$userId.'/albums');
try {
  $response = $fb->getClient()->sendRequest($request);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$albumEdge = $response->getGraphEdge();
//print_r($albumEdge);

foreach(albumEdge as album){
  var_dump($album->asArray());

  $data = $album['data'];
  do {
      echo '<p>data:</p>' . "\n\n";
      var_dump($likes->asArray());
    } while ($data = $fb->next($data));
  }

}
?>
