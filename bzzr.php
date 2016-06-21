<?php

include_once 'SwarmProxy.php';

$proxy = new SwarmProxy();
#$proxy->localProxy = '127.0.0.1:8888';
$url = $proxy->getUrl('bzzr');
$data = $proxy->httpGet($url);
header('Content-Type: ' . $proxy->requestedContentType);
echo $data;