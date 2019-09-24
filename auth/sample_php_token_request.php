<?php
    $client_id = "testclient";
    $client_secret = "testpass";
    $uri = "http://localhost/learn/oauth2-server-php/token.php";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => 'client_credentials'
    ));

    $data = curl_exec($ch);
    $res = json_decode($data, true);
    curl_close($ch);
    echo $res['access_token']; //get access token





