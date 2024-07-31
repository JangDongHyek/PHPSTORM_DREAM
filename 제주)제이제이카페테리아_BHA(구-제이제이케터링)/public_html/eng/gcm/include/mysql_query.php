<?php
if(!defined('__HHGYU__')) exit();

class Mysql_Query{
	var $config2;
	var $is_connect = false;
	var $conn = null;
	var $dbSel = null;

	function &getInstance() {
		static $theInstance = null;
		if(!$theInstance) {$theInstance = new Mysql_Query();}
		$theInstance->init();
		
		return $theInstance;
	}

	function Mysql_Query(){
		$this->is_connect = false;
		$this->conn = null;
		$this->dbSel = null;
	}

	function init(){
		if(!isset($this->config))
			$this->config = &Config::getInstance();
		$this->connent();
	}
	
	function begin(){
		$this->init();
	}

	function connent(){
		if($this->isConnected())
			return $this->conn;
		$this->conn=mysql_connect($this->config->db_info->db_hostname . ":" . $this->config->db_info->db_port, $this->config->db_info->user_id, $this->config->db_info->password);
		if(!isset($this->conn))
			die('Database connection failed: ' . mysql_error());

		$this->dbSel=mysql_select_db($this->config->db_info->db) or die('Unable to connect to database.');
		if(!isset($this->dbSel))
			die('Database connection failed: ' . mysql_error());


		$this->query("set names utf8");

		$this->is_connect = true;
		return $this->conn;
	}

	function close(){
		if($this->isConnected() && isset($this->conn)){
			@mysql_close($this->conn);
			unset($this->conn);
		}
		$this->is_connect = false;
	}

	function isConnected(){
		return ($this->is_connect && isset($this->conn));
	}

	function select($db_table,$col = "*",$where,$limit_start = 0,$limit_count = 1,$ORDER_BY_col = null,$Order_BY = 'DESC',$ORDER_BY_MULT = false){
		
		if(!$this->isConnected()){
			die("Not Open DB");
		}

		$col_string=$col;
		$where_stirng="";
		$order_by_stirng="";

		if(is_array($col))
			$col_string=implode(", ",$col);
		else
			$col_string = $col;

		if(isset($where) && $where != "")
			$where_stirng="WHERE " . $where;

		if(isset($ORDER_BY_col) && $ORDER_BY_MULT == false)
			$order_by_stirng = "ORDER BY " . $ORDER_BY_col . " " . $Order_BY;
		else if(isset($ORDER_BY_col))
			$order_by_stirng = "ORDER BY " . $ORDER_BY_col;

		$query =  $this->query("SELECT {$col_string} FROM `{$db_table}` {$where_stirng} {$order_by_stirng} LIMIT {$limit_start},{$limit_count}");

		if(@$this->num_rows($query) == 0){
			return null;
		}
		else
			return $query;
	}

	function insert($db_table,$cols,$values,&$insert_id){

		if(!$this->isConnected()){
			die("Not Open DB");
		}
		$insert_id = null;

		$col_string = $cols;
		$value_string = $values;

		$is_cols_array = is_array($cols);
		$is_values_array = is_array($values);

		if($is_cols_array != $is_values_array) die("insert 구문은 cols, values 둘다 배열이거나  둘다 배열이 아니여야됨");

		if($is_cols_array == true)
			$col_string = implode(", ",$cols);

		if($is_values_array == true)
			$value_string = implode(", ",$values);

		$col_string = "(" . $col_string . ")";
		$value_string = "VALUES (" . $value_string . ")";

		$query =  $this->query("INSERT INTO `{$db_table}` {$col_string} {$value_string}");

		if(@$this->affected_rows()==1){
			$insert_id = $this->insert_id();
			return true;
		}
		else{
			return false;
		}
	}

	function delete($db_table,$where = NULL){
		if(!$this->isConnected()){
			die("Not Open DB");
		}

		$where_stirng = "";

		if(isset($where) && $where != "")
			$where_stirng="WHERE " . $where;
		else
			return false;

		$query =  $this->query("DELETE FROM `{$db_table}` {$where_stirng}");
		if(@$this->affected_rows()!=0){
			return true;
		}
		else
			return false;
	}

	function update($db_table,$cols,$values,$where){
		if(!$this->isConnected()){
			die("Not Open DB");
		}
		
		$set_string = "";
		$where_stirng = "";

		$is_cols_array = is_array($cols);
		$is_values_array = is_array($values);

		if($is_cols_array != $is_values_array) die("update 구문은 cols, values 둘다 배열이거나  둘다 배열이 아니여야됨");

		if($is_cols_array == false)
			$cols=array($cols);

		if($is_values_array == false)
			$values=array($values);

		$cols_count = count($cols);
		$i=0;
		$set_string = " SET ";
		foreach($cols as $key => $value){
			$i++;
			$value_2 = $values[$key];
			$set_string .= " {$value} = {$value_2}";

			if($i<$cols_count)
				$set_string .= ",";
			else
				$set_string .= " ";
		}

		if(isset($where) && $where != "")
			$where_stirng="WHERE " . $where;

		$query =  $this->query("UPDATE `{$db_table}` {$set_string} {$where_stirng}");

		if($query==true){
			return true;
		}
		else
			return false;
	}

	function max_count($db_table,$where = NULL){

		if(!$this->isConnected()){
			die("Not Open DB");
		}

		$where_stirng = "";
		
		if(isset($where) && $where != "")
			$where_stirng="WHERE " . $where;

		$query = $this->query("SELECT COUNT(*) as count FROM `{$db_table}` {$where_stirng}");
		
		if($query == null){
			return null;
		}
		else{
			$total_rows = $this->fetch($query);
			return $total_rows['count'];
		}
	}

	function max_count_toQuery($tmpQuery){
		
		if(!$this->isConnected()){
			die("Not Open DB");
		}
		$where_stirng = "";
		
		if(isset($where) && $where != "")
			$where_stirng="WHERE " . $where;

		$query = $this->query($tmpQuery);
		if($query == null){
			return null;
		}
		else{
			$total_rows = $this->fetch($query);
			return $total_rows['count(`idx`)'];
		}
	}

	function Origin_Query($query,$limit_start = 0,$limit_count = 1,$ORDER_BY_col = null,$Order_BY = 'DESC',$ORDER_BY_MULT = false){
		if(!$this->isConnected()){
			die("Not Open DB");
		}

		$order_by_stirng = "";

		if(isset($ORDER_BY_col) && $ORDER_BY_MULT == false)
			$order_by_stirng = "ORDER BY " . $ORDER_BY_col . " " . $Order_BY;
		else if(isset($ORDER_BY_col))
			$order_by_stirng = "ORDER BY " . $ORDER_BY_col;

		$query =  $this->query("{$query} {$order_by_stirng} LIMIT {$limit_start},{$limit_count}");

		if(@$this->num_rows($query) == 0){
			return null;
		}
		else
			return $query;
	}

	function Origin_Query_Max_Count($query){
		if(!$this->isConnected()){
			die("Not Open DB");
		}

		$query = $this->query($query);

		if($query == null){
			return null;
		}
		else{
			$total_rows = $this->fetch($query);
			return $total_rows[0];
		}
	}

	function query($query_string){
		if($query_string == "") return null;
		return mysql_query($query_string,$this->conn);
	}

	function fetch(&$result){
		if($result == null || $result === false)
			return null;
		return mysql_fetch_array($result, MYSQL_ASSOC);
	}

	function fetch_row(&$result){
		if($result == null || $result === false)
			return null;
		return mysql_fetch_row($result);
	}

	function num_rows(&$result){
		return mysql_num_rows($result);
	}

	function affected_rows(&$result){
		return mysql_affected_rows($result);
	}

	function insert_id(){
		return mysql_insert_id($this->conn);
	}

	function real_escape_string($str){
		return mysql_real_escape_string($str,$this->conn);
	}

	function select_return_string($db_table,$col = "*",$where,$limit_start = 0,$limit_count = 1,$ORDER_BY_col = null,$Order_BY = 'DESC',$ORDER_BY_MULT = false){

		$col_string=$col;
		$where_stirng="";
		$order_by_stirng="";

		if(is_array($col))
			$col_string=implode(", ",$col);
		else
			$col_string = $col;

		if(isset($where) && $where != "")
			$where_stirng="WHERE " . $where;

		if(isset($ORDER_BY_col) && $ORDER_BY_MULT == false)
			$order_by_stirng = "ORDER BY " . $ORDER_BY_col . " " . $Order_BY;
		else if(isset($ORDER_BY_col))
			$order_by_stirng = "ORDER BY " . $ORDER_BY_col;

		return ("SELECT {$col_string} FROM `{$db_table}` {$where_stirng} {$order_by_stirng} LIMIT {$limit_start},{$limit_count}");
	}

	function insert_return_string($db_table,$cols,$values){
		
		$col_string = $cols;
		$value_string = $values;

		$is_cols_array = is_array($cols);
		$is_values_array = is_array($values);

		if($is_cols_array != $is_values_array) die("insert 구문은 cols, values 둘다 배열이거나  둘다 배열이 아니여야됨");

		if($is_cols_array == true)
			$col_string = implode(", ",$cols);

		if($is_values_array == true)
			$value_string = implode(", ",$values);

		$col_string = "(" . $col_string . ")";
		$value_string = "VALUES (" . $value_string . ")";

		return ("INSERT INTO `{$db_table}` {$col_string} {$value_string}");
	}

	function delete_return_string($db_table,$where = NULL){

		if(isset($where) && $where != "")
			$where_stirng="WHERE " . $where;
		else
			return false;

		return ("DELETE FROM `{$db_table}` {$where_stirng}");
	}

	function update_return_string($db_table,$cols,$values,$where){
		
		$set_string = "";

		$is_cols_array = is_array($cols);
		$is_values_array = is_array($values);

		if($is_cols_array != $is_values_array) die("update 구문은 cols, values 둘다 배열이거나  둘다 배열이 아니여야됨");

		if($is_cols_array == false)
			$cols=array($cols);

		if($is_values_array == false)
			$values=array($values);

		$cols_count = count($cols);
		$i=0;
		$set_string = " SET ";
		foreach($cols as $key => $value){
			$i++;
			$value_2 = $values[$key];
			$set_string .= " {$value} = {$value_2}";

			if($i<$cols_count)
				$set_string .= ",";
			else
				$set_string .= " ";
		}

		if(isset($where) && $where != "")
			$where_stirng="WHERE " . $where;

		return ("UPDATE `{$db_table}` {$set_string} {$where_stirng}");
	}
}