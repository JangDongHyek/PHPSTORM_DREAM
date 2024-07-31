<?php

class Member_Class{

	var $config2;
	var $mysql_query;

	function &getInstance() {
		static $theInstance = null;
		if(!$theInstance) $theInstance = new Member_Class();

		return $theInstance;
	}

	function Member_Class(){
		$this->init();
	}

	function init(){
		if(!isset($this->config))
			$this->config = &Config::getInstance();

		if(!isset($this->mysql_query)){
			$DB = &DB::getInstance();
			$this->mysql_query = $DB->db;
		}
	}

	function getMember_idx($idx,$cols = "*"){
		$this->init();

		$idx = $this->mysql_query->real_escape_string($idx);

		$query = $this->mysql_query->select($this->config->db_info->user_db,$cols,"`idx`='$idx'");

		if($query == null){
		}
		else{
			return $this->mysql_query->fetch($query);
		}
		return null;
	}

	function getMember_idx_query($idx,$cols = "*"){
		$this->init();

		$idx = $this->mysql_query->real_escape_string($idx);

		$query = $this->mysql_query->select($this->config->db_info->user_db,$cols,"`idx`='$idx'");

		return $query;
	}

	function getMember_where($where,$cols = "*"){
		$this->init();

		$idx = $this->mysql_query->real_escape_string($idx);

		$query = $this->mysql_query->select($this->config->db_info->user_db,$cols,"$where");

		if($query == null){
		}
		else{
			return $this->mysql_query->fetch($query);
		}
		return null;
	}
}