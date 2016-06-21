<?php

class SwarmProxy
{
    public $serverUrl = 'http://localhost:8500/';
    public $localProxy = '';
    public $requestedContentType = '';

    function getUrl($protocol)
    {
        $name = $_SERVER['REQUEST_URI'];
        $name = str_replace('/bzz.php/', '', $name);
        $name = str_replace('/bzzr.php/', '', $name);
        $url = $this->serverUrl . $protocol . ':/' . $name;

        return $url;
    }

    function httpPost($url, $data)
    {
        $post = curl_init();
        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_POST, count($data));
        curl_setopt($post, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
        if ($this->localProxy) {
            curl_setopt($post, CURLOPT_PROXY, $this->localProxy);
        }

        $result = curl_exec($post);
        $this->requestedContentType = curl_getinfo($post, CURLINFO_CONTENT_TYPE);
        curl_close($post);

        return $result;
    }

    function httpGet($url)
    {
        $post = curl_init();
        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
        if ($this->localProxy) {
            curl_setopt($post, CURLOPT_PROXY, $this->localProxy);
        }

        $result = curl_exec($post);
        $this->requestedContentType = curl_getinfo($post, CURLINFO_CONTENT_TYPE);
        curl_close($post);

        return $result;
    }
}
