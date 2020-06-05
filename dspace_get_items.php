<?php
/**
 * Query items. This does not currently work with a dynamic token.
 * The answer comes in json
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
    CURLOPT_URL => "http://api.dspace.poc.euraknos.cf/server/api/core/items",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer [..TOKEN..]"
    ),
));

$response = curl_exec($curl);
print_r(json_decode($response, true));

curl_close($curl);