Request Helper
================

Usage
-----
Add the following to your controller:
    
    $this->load->helper('request');

To use the helper:

	send_request($method, $url, $data, $option_headers = null);