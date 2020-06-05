<?php
/**
 * Create an item.
 * 
 */
echo '<pre>';
function get_headers_from_curl_response($response)
{
    $headers = array();
    
    $header_text = substr($response, 0, strpos($response, "\r\n\r\n"));
    
    foreach (explode("\r\n", $header_text) as $i => $line)
        if ($i === 0)
            $headers['http_code'] = $line;
            else
            {
                list ($key, $value) = explode(': ', $line);
                
                $headers[$key] = $value;
            }
            
            return $headers;
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.dspace.poc.euraknos.cf/server/api/authn/login?user=______&password=______",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
    ),
    CURLOPT_HEADER => 1,
    CURLOPT_RETURNTRANSFER => true
));

$response = curl_exec($curl);
$cresult = get_headers_from_curl_response($response);

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.dspace.poc.euraknos.cf/server/api/core/items?owningCollection=ef0a292e-7edc-4118-b851-9d9df507c663",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>"{\r\n   \"name\":\"AKI TEST100\",\r\n   \"metadata\":{\r\n      \"dc.contributor.author\":[\r\n         {\r\n            \"value\":\"Zoltan, Szabo\",\r\n            \"language\":\"en\",\r\n            \"authority\":null,\r\n            \"confidence\":-1\r\n         }\r\n      ],\r\n      \"dc.title\":[\r\n         {\r\n            \"value\":\"AKI TEST 100\",\r\n            \"language\":\"en\",\r\n            \"authority\":null,\r\n            \"confidence\":-1\r\n         }\r\n      ],\r\n      \"dc.type\":[\r\n         {\r\n            \"value\":\"other\",\r\n            \"language\":\"en\",\r\n            \"authority\":null,\r\n            \"confidence\":-1\r\n         }\r\n      ]\r\n   },\r\n   \"inArchive\":true,\r\n   \"discoverable\":true,\r\n   \"withdrawn\":false,\r\n   \"type\":\"item\"\r\n}",
    CURLOPT_HTTPHEADER => array(
        "Authorization: ".$cresult['Authorization']."",
        "Content-Type: application/json"
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;