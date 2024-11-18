<?php
if(!defined('__HHGYU__')) exit();

class Event_Manager{
	var $config2;
	var $mysql_query;
	var $member_class;
	var $gcm_manager;
	var $max_send_count = 600;

	function &getInstance() {
		static $theInstance = null;
		if(!$theInstance) $theInstance = new Event_Manager();

		$theInstance->init();

		return $theInstance;
	}

	function Event_Manager(){

	}

	function init(){
		if(!isset($this->config))
			$this->config = &Config::getInstance();

		if(!isset($this->mysql_query)){
			$DB = &DB::getInstance();
			$this->mysql_query = $DB->db;
		}

		if(!isset($this->member_class))
			$this->member_class = &Member_Class::getInstance();

		if(!isset($this->gcm_manager))
			$this->gcm_manager = &GCM_Manager::getInstance();
	}

	function allowOptions($arr) {
		//$result = array_flip(array_filter(array_flip($arr), array($this, "isAllowOption")));
		$allowed = array("idx", "ID", "arrID", "app_type");
		$result = $this->array_intersect_key2($arr, array_flip($allowed));
		return $result;
	}

	function array_intersect_key2($isec, $arr2){
		$argc = func_num_args();
 
		for ($i = 1; !empty($isec) && $i < $argc; $i++)
		{
			 $arr = func_get_arg($i);
 
			 foreach ($isec as $k => $v)
				 if (!isset($arr[$k]))
					 unset($isec[$k]);
		}
 
		return $isec;
	}

	function isAllowOption($key) {
		$allowed = array("idx", "ID", "arrID", "app_type");

		return in_array($key, $allowed);
	}

	function isOptionCheck($arrOption, $datas, $ID, $app_type) {
		$arrOption = @$this->allowOptions($arrOption);

		if($arrOption == null || count($arrOption) <= 0) {
			return true;
		} else {
			reset ($arrOption);
			$firstKey = key($arrOption);

			if($firstKey == "idx") {
				$arrData = $datas['idx'];
				$data = $arrOption['idx'];
			} else if($firstKey == "ID") {
				$arrData = $datas['ID'];
				$data = $arrOption['ID'];
			} else if($firstKey == "app_type") {
				$arrData = $datas['app_type'];
				$data = $arrOption['app_type'];
			} else if($firstKey == "arrID") {
				$arrData = $datas['ID'];
				$data = $arrOption['arrID'];
			}
			if(!is_array($arrData) || (!is_array($data) && ($data == null || ($data . "") == ""))) {
				return false;
			}

			if(is_array($data)) {
				foreach($data as $value) {
					if(in_array($value, $arrData)) {
						return true;
					}
				}
				return false;
			} else {
				if(in_array($data, $arrData)) {
					return true;
				} else {
					return false;
				}
			}
		}
		
	}
}