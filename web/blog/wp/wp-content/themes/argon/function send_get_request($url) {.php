<?php 
function send_get_request($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_exec($ch);
    return $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
    curl_close($ch);
}

if (extension_loaded('curl')) {
    echo 'cURL extension is installed and enabled.';
} else {
    echo 'cURL extension is not installed or enabled.';
}

$url = 'https://ed333.tossp/';
$status = send_get_request($url);
echo 'Status code: ' . $status;
?>
