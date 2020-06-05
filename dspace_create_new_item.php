<?php
/**
 * Create an item. This does not currently work with a dynamic token.
 * 
 */
echo '<pre>';
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.dspace.poc.euraknos.cf/server/api/authn/login?user=[..USERNAME..]&password=[..PASSWORD..]",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST"
));

$response = curl_exec($curl);

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.dspace.poc.euraknos.cf/server/api/core/items?owningCollection=ef0a292e-7edc-4118-b851-9d9df507c663",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>"{\r\n   \"name\":\"AKI TEST2\",\r\n   \"metadata\":{\r\n      \"dc.contributor.author\":[\r\n         {\r\n            \"value\":\"Zoltan, Szabo\",\r\n            \"language\":\"en\",\r\n            \"authority\":null,\r\n            \"confidence\":-1\r\n         }\r\n      ],\r\n      \"dc.title\":[\r\n         {\r\n            \"value\":\"AKI TEST\",\r\n            \"language\":\"en\",\r\n            \"authority\":null,\r\n            \"confidence\":-1\r\n         }\r\n      ],\r\n      \"dc.type\":[\r\n         {\r\n            \"value\":\"other\",\r\n            \"language\":\"en\",\r\n            \"authority\":null,\r\n            \"confidence\":-1\r\n         }\r\n      ]\r\n   },\r\n   \"inArchive\":true,\r\n   \"discoverable\":true,\r\n   \"withdrawn\":false,\r\n   \"type\":\"item\"\r\n}",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer [...........TOKEN.........]",
        "Content-Type: application/json"
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;