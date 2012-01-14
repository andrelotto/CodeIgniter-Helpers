<?php
/**
 * @author       Michael Aguiar <mike@aliasproject.com>
 * @copyright    2011 - 2012 Alias Project, Inc. 
 */

if(!defined('BASEPATH')) exit('No direct script access allowed');

function send_request($method, $url, $data, $optional_headers = null) {
    try {
        $params = array('http' => array('method' => $method, 'content' => $data));
        
        if($optional_headers !== null) {
            $params['http']['header'] = $optional_headers;
        }
        
        $ctx = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $ctx);
        
        if(!$fp) {
            throw new Exception("Problem with $url");
        }
        
        $response = @stream_get_contents($fp);
        
        if($response === false) {
            throw new Exception("Problem reading data from $url");
        }
        
        return $response;
    } catch(Exception $e) {
        log_message('error', $e->getMessage());
    }
}

function stringify_obj($obj) {
    $postString = '';
    $counter = 0;
    foreach($obj as $key => $value) {
        if($counter === 0) {
            $postString .= "$key=$value";
        } else {
            $postString .= "&$key=$value";
        }
        $counter++;
    }
    
    return $postString;
}
?>