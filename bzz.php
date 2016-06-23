<?php

include_once 'SwarmProxy.php';

$proxy = new SwarmProxy();
#$proxy->localProxy = '127.0.0.1:8888';
$url = $proxy->getUrl('bzz');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = $proxy->httpGet($url);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $proxy->httpPost($url, $_POST);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = $proxy->httpPut($url, file_get_contents("php://input"));
}

header('Content-Type: ' . $proxy->requestedContentType);
echo $data;