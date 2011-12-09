Request Helper
================

Usage
-----
First, add request_helper.php to application/helpers.

Add the following to your controller:
    
    $this->load->helper('request');

To use the helper:

	send_request($method, $url, $data, $option_headers = null);