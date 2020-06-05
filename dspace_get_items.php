<?php
/**
 * Query items.
 * The answer comes in json
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
    CURLOPT_URL => "http://api.dspace.poc.euraknos.cf/server/api/authn/login?user=_____&password=_____",
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
    CURLOPT_URL => "http://api.dspace.poc.euraknos.cf/server/api/core/items",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => 1,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: ".$cresult['Authorization'].""
    ),
));
$response2 = curl_exec($curl);
print_r($response2);
print_r(json_decode($response2));

curl_close($curl);