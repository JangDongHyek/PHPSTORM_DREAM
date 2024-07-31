<?php
if(!defined('__HHGYU__')) exit();

class DB{
	var $db = null;

	function &getInstance() {
		static $theInstance = null;
		if(!$theInstance) $theInstance = new DB();
		return $theInstance;
	}
	
	function DB(){
		$config2 = &Config::getInstance();

        if(function_exists('mysqli_connect') && $config2->db_info->db_type == "mysqli") {
			$class_name = "Mysqli_Query";
			$file_name = "mysqli_query";
		}
		else{
			$class_name = "Mysql_Query";
			$file_name = "mysql_query";
		}
		$class_file = __ROOT_PATH__."include/$file_name.php";
        if(!file_exists($class_file)) return die("DB CLASS LOAD ERROR");
		require_once($class_file);
        $this->db =  call_user_func(array($class_name, 'getInstance'));
	}
}