<?php

/* 

@Package: Ocean API Wrapper
@Language: PHP
@Version: 1.0.0

*/

namespace Ocean;

class Core
{
    
    private $key;
    private $endpoints;
    
    public function __construct(){
        $this->endpoints = ['math', 'storage', 'random-word', 'image', 'reddit-fetch'];
    }
    
    public function call($endpoint_url, $data, $timeout = 30){
        
        /* Check if key is set */
        if(!isset($this->key)){
            throw new \ErrorException("No key specified.");
        }
        
        /* Check if $data is an array */
        if(!is_array($data)){
            throw new \ErrorException("Did not send data as an array.");
        }
        
        /* Check if endpoint URL is valid */
        if($this->valid_endpoint($endpoint_url) == false){
            throw new \ErrorException("Invalid URL endpoint.");
        }
        
        /* Start cURL request */
        $curl = curl_init();

        /* Setup cURL request */
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_POSTFIELDS, json_encode($data),
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => ["cache-control: no-cache", array('Content-Type:application/json'), "Ocean_Auth:" . $this->key],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response, true);
        
        /* Return Data */
        return $response;
    } 
    
    /* Display Endpoints */
    public function endpoints(){
        echo '<pre>'; 
            print_r($this->endpoints); 
        echo '</pre>';
    }
    
    /* Generate a fake key */
    public function fake_key(){
        $key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
        return $key;
    }
    
    /* Check if URL endpoint is valid */
    public function valid_endpoint($url){
        $pieces = explode('/', $url);
        if(in_array($pieces[4], $this->endpoints)){
            return true;
        }else{
            return false;
        }
    }
    
    /* Setters */
    public function key($set_key){
        $this->key = $set_key;
    }
    
}

?>
