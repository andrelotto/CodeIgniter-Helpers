<?php
/**
 * @author       Michael Aguiar <mike@aliasproject.com>
 * @copyright    2011 - 2011 Alias Project, Inc. 
 */

if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('rest')) {
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
            
            return json_decode($response);
        } catch(Exception $e) {
            log_message('error', $e->getMessage());
        }
    }
}
?>