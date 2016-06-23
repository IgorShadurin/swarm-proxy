<?php

class SwarmProxy
{
    public $serverUrl = 'http://localhost:8500/';
    public $localProxy = '';
    public $requestedContentType = '';

    function getUrl($protocol)
    {
        $name = $_SERVER['REQUEST_URI'];
        $name = basename($name);
        $url = $this->serverUrl . $protocol . ':/' . $name;

        return $url;
    }

    function httpPut($url, $data)
    {
        // Clean up string
        //$putString = stripslashes($data);
        $putString = $data;
        // Put string into a temporary file
        $putData = tmpfile();
        // Write the string to the temporary file
        fwrite($putData, $putString);
        // Move back to the beginning of the file
        fseek($putData, 0);

        $post = curl_init();
        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_PUT, true);
        // Instead of POST fields use these settings
        curl_setopt($post, CURLOPT_INFILE, $putData);
        curl_setopt($post, CURLOPT_INFILESIZE, strlen($putString));
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
        if ($this->localProxy) {
            curl_setopt($post, CURLOPT_PROXY, $this->localProxy);
        }

        $result = curl_exec($post);
        $this->requestedContentType = curl_getinfo($post, CURLINFO_CONTENT_TYPE);
        curl_close($post);

        return $result;
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
