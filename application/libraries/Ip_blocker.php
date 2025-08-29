<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ip_blocker {

    protected $CI;
    protected $blocked_ips = array('165.22.253.27'); // Daftar IP yang diblokir

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function check_ip()
    {
        $client_ip = $this->CI->input->ip_address();

        if (in_array($client_ip, $this->blocked_ips)) {
            show_error('Access Denied', 403);
        }
    }
}
