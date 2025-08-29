<?php
defined('BASEPATH') or exit('No direct script access allowed');


$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://srv179.niagahoster.com'; // atau sesuaikan dengan server actual
$config['smtp_port'] = 465; // atau 587 jika menggunakan TLS
$config['smtp_user'] = 'newsletter@poltekkesjakarta3.ac.id';
$config['smtp_pass'] = 'Jak#17415jkt3';
$config['mailtype']  = 'text'; // atau 'html' jika isi email Anda HTML
$config['charset']   = 'utf-8';
$config['newline']   = "\r\n";
