<?php

if(!defined('__HHGYU__')) exit();

class Config {
	var $db_info;

	var $passkey_gen;

	var $gcm;

	function &getInstance() {
		static $theInstance = null;
		if(!$theInstance) $theInstance = new Config();

		return $theInstance;
	}
 
	function Config()
	{
		$this->db_info->db_type = "mysql";
		//$this->db_info->db_hostname = "localhost:/var/lib/mysql/mysql.sock";
		$this->db_info->db_hostname = "lets080.co.kr";
		$this->db_info->db_port = "3306";
		$this->db_info->user_id="ktlove004";
		$this->db_info->password="kt8910088";
		$this->db_info->db = "ktlove004";
		//$this->db_info->api_db = "GCM_Referance";
		$this->db_info->user_db = "member_gcm";
		
		//$this->apnsHost = 'gateway.push.apple.com';
		//$this->apnsCert = '../Dic.pem';

		//$this->apnsHost = 'gateway.push.apple.com';
		$this->apnsHost = 'gateway.sandbox.push.apple.com';
		$this->apnsCert = '/home/ktlove004/public_html/manager/gcm/apns.pem';
		


		$this->passkey_gen = "itforyou_passkey_321!@#";

		$this->gcm->server_key="AIzaSyB3X1b-edmUeuKKp_zgX2am5BsnRkj7eXQ";
		$this->gcm->GCM_RegistrationID="885975414796";
	}

	function getFilePath(){
		$file_server_path = realpath(__FILE__);
		$php_filename = basename(__FILE__);
		$server_path = str_replace(basename(__FILE__), "", $file_server_path);
		return $server_path;
	}

	function getRelativeFilePath(){
		return $_SERVER['REQUEST_URI'];
	}
}