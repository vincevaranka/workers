<?php
// include our OAuth2 Server object
require_once __DIR__.'/server.php';

// Handle a request to a resource and authenticate the access token
$check = $server->verifyResourceRequest(OAuth2\Request::createFromGlobals());
if (!$check) {
    $server->getResponse()->send();
    die;
} 
echo json_encode(array('success' => true, 'message' => 'You accessed my APIs!', 'data',$check));