<?php
    $token = $_GET["access_token"];
    $ch = curl_init();
    $url = "http://localhost/learn/oauth2-server-php/resource.php";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'access_token'=>$token
    ));

    $data = curl_exec($ch);
    echo $data;
