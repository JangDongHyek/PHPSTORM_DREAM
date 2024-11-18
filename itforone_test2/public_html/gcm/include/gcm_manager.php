<?php
if (!defined('__HHGYU__'))
	exit();
class GCM_Manager {
	var $config2;
	var $mysql_query;
	var $member_class;
	var $max_send_count = 600;

	function & getInstance() {
		static $theInstance = null;
		if (!$theInstance)
			$theInstance = new GCM_Manager();

		$theInstance -> init();

		return $theInstance;
	}

	function GCM_Manager() {

	}

	function init() {

		if (!isset($this -> config))
			$this -> config = &Config::getInstance();

		if (!isset($this -> mysql_query)) {
			$DB = &DB::getInstance();
			$this -> mysql_query = $DB -> db;
		}

		if (!isset($this -> member_class))
			$this -> member_class = &Member_Class::getInstance();
	}

	function sendToMember_idx($code, $idx, $title, $msg, $button_string, $url, $data, &$returnObj) {
		if (!isset($idx) || !isset($title) || !isset($msg))
			return false;
		$arrResultQuery = array();
		$arrResult = array();

		$member_data = $this -> member_class -> getMember_idx($idx, "`idx`,`RegID`");

		if (!isset($member_data) || !isset($member_data['RegID']))
			return false;

		$regIDs = array($member_data['RegID']);

		$res = $this -> sendMessage($this -> config -> gcm -> server_key, $member_data['RegID'], $code, $title, $msg, $button_string, $url, $data);
		$resQuery = $this -> failure_RegID_Null($res, $regIDs, array($member_data['idx']));
		$arrResult["i_0"] = $res;
		$arrResult["i_0"]['delete'] = $resQuery;
		if ($resQuery != "") {
			$arrResultQuery[] = $resQuery;
		}
		foreach ($arrResultQuery as $key => $sql_string) {
			$this -> mysql_query -> query($sql_string);
		}

		$returnObj = (object)$arrResult;

		return true;
	}

	function sendToMember_ID($code, $ID, $title, $msg, $button_string, $url, $data, &$returnObj) {

		if (!isset($ID) || !isset($title) || !isset($msg))
			return false;

		$arrResultQuery = array();
		$arrResult = array();

		 $max_count = $this -> mysql_query -> max_count($this -> config -> db_info -> user_db, "`ID` = '{$ID}' and (LENGTH(`RegID`) > 0 OR `RegID` IS NOT NULL) and `delete` = '0' and `app_type` = '0' GROUP BY `DeviceID` ");

		if($max_count == 0) return false;
		if ($max_count > 0) {
			for ($i = 1; $i <= ceil($max_count / $this -> max_send_count); $i++) {
				$start_limit = $i * $this -> max_send_count - $this -> max_send_count;
				$query = $this -> mysql_query -> select($this -> config -> db_info -> user_db, "`idx`,`RegID`", "`ID` = '{$ID}' and ( LENGTH(`RegID`) > 0 OR `RegID` IS NOT NULL) and `delete` = '0' and `app_type` = '0' GROUP BY `DeviceID`", $start_limit, $this -> max_send_count);
				$member_idxs = array();
				$regIDs = $this -> MysqlQueryToRegID($query, &$member_idxs);
				$res = $this -> sendMessages($this -> config -> gcm -> server_key, $regIDs, $code, $title, $msg, $button_string, $url, $data);
				$resQuery = $this -> failure_RegID_Null($res, $regIDs, $member_idxs);

				$arrResult["i_" . $i] = $res;
				$arrResult["i_" . $i]['delete'] = $resQuery;
				if ($resQuery != "") {
					$arrResultQuery[] = $resQuery;
				}

			}
			foreach ($arrResultQuery as $key => $sql_string) {
				$this -> mysql_query -> query($sql_string);
			}
		}
		$arrResult['max_count'] = $max_count;

		$returnObj = (object)$arrResult;

		return true;
	}

	function sendToMember_AppType($code, $app_type, $title, $msg, $button_string, $url, $data, &$returnObj) {
		if (!isset($app_type) || !isset($title) || !isset($msg))
			return false;
		$arrResultQuery = array();
		$arrResult = array();

		$max_count = $this -> mysql_query -> max_count($this -> config -> db_info -> user_db, "`app_type` = '{$app_type}' and (LENGTH(`RegID`) > 0 OR `RegID` IS NOT NULL) and `delete` = '0' and `app_type` = '0'  GROUP BY `DeviceID` ");
		if ($max_count > 0) {
			for ($i = 1; $i <= ceil($max_count / $this -> max_send_count); $i++) {
				$start_limit = $i * $this -> max_send_count - $this -> max_send_count;
				$query = $this -> mysql_query -> select($this -> config -> db_info -> user_db, "`idx`,`RegID`", "`app_type` = '{$app_type}' and ( LENGTH(`RegID`) > 0 OR `RegID` IS NOT NULL) and `delete` = '0' and `app_type` = '0' GROUP BY `DeviceID` ORDER BY length(`app_type`) desc", $start_limit, $this -> max_send_count);
				$member_idxs = array();
				$regIDs = $this -> MysqlQueryToRegID($query, &$member_idxs);
				$res = $this -> sendMessages($this -> config -> gcm -> server_key, $regIDs, $code, $title, $msg, $button_string, $url, $data);
				$resQuery = $this -> failure_RegID_Null($res, $regIDs, $member_idxs);
				$arrResult["i_" . $i] = $res;
				$arrResult["i_" . $i]['delete'] = $resQuery;
				if ($resQuery != "") {
					$arrResultQuery[] = $resQuery;
				}
			}
			foreach ($arrResultQuery as $key => $sql_string) {
				$this -> mysql_query -> query($sql_string);
			}
		}
		$arrResult['max_count'] = $max_count;

		$returnObj = (object)$arrResult;

		return true;
	}

	function sendToMember_ALL($code, $title, $msg, $button_string, $url, $data, &$returnObj) {

		if (!isset($title) || !isset($msg))
			return false;

		$arrResultQuery = array();
		$arrResult = array();

		$max_count = $this -> mysql_query -> max_count_toQuery("select count(`idx`) FROM `{$this->config->db_info->user_db}` " . "WHERE (LENGTH(`RegID`) > 0 OR `RegID` IS NOT NULL) and `delete` = '0' and `app_type` = '0'  GROUP BY `DeviceID`");
		if($max_count == 0) return false;
		if ($max_count > 0) {
			for ($i = 1; $i <= ceil($max_count / $this -> max_send_count); $i++) {
				$start_limit = $i * $this -> max_send_count - $this -> max_send_count;
				$query = $this -> mysql_query -> select($this -> config -> db_info -> user_db, "`idx`,`RegID`", "(LENGTH(`RegID`) > 0 OR `RegID` IS NOT NULL) and `delete` = '0' and `app_type` = '0'  GROUP BY `DeviceID` ORDER BY `idx` asc", $start_limit, $this -> max_send_count);
				$member_idxs = array();
				$regIDs = $this -> MysqlQueryToRegID($query, &$member_idxs);
				$res = $this -> sendMessages($this -> config -> gcm -> server_key, $regIDs, $code, $title, $msg, $button_string, $url, $data);
				$resQuery = $this -> failure_RegID_Null($res, $regIDs, $member_idxs);
				$arrResult["i_" . $i] = $res;
				$arrResult["i_" . $i]['delete'] = $resQuery;
				if ($resQuery != "") {
					$arrResultQuery[] = $resQuery;
				}
			}
			foreach ($arrResultQuery as $key => $sql_string) {
				$this -> mysql_query -> query($sql_string);
			}
		}
		$arrResult['max_count'] = $max_count;
		$returnObj = (object)$arrResult;

		return true;
	}

	function MysqlQueryToRegID($query, &$member_idxs) {
		if (!isset($query))
			return null;
		$regIDs = array();

		while ($data = $this -> mysql_query -> fetch($query)) {
			$regIDs[] = $data['RegID'];
			$member_idxs[] = $data['idx'];
		}

		return $regIDs;
	}

	function sendMessage($auth, $registration_id, $code, $title, $msg, $button_string, $url, $_data) {
		echo aa;
		$data = array('registration_ids' => array($registration_id), 'data' => array('title' => $title, 'msg' => $msg, 'time' => date("Y-m-d H:i:s", time()), 'button_string' => $button_string, "url" => $url, "code" => $code));

		if (isset($_data)) {
			foreach ($_data as $key => $value) {
				if (!isset($data['data'][$key])) {
					$data['data'][$key] = $value;
				}
			}
		}

		$headers = array("Content-Type:application/json", "Authorization:key=" . $auth);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$res = curl_exec($ch);
		$res_info = @curl_getinfo($ch);

		curl_close($ch);

		if ($res == null)
			$res = array();
		$res['data'] = json_decode($res, true);

		$res['http_code'] = @$res_info['http_code'];
		$res['http_code'] = @$res_info['total_time'];

		return $res;
	}

	function sendMessages($auth, $registration_ids, $code, $title, $msg, $button_string, $url, $_data) {
		$data = array('registration_ids' => $registration_ids, 'data' => array('title' => $title, 'msg' => $msg, 'time' => date("Y-m-d H:i:s", time()), 'button_string' => $button_string, "url" => $url, "code" => $code));

		if (isset($_data)) {
			foreach ($_data as $key => $value) {
				if (!isset($data['data'][$key])) {
					$data['data'][$key] = $value;
				}
			}
		}

		$headers = array("Content-Type:application/json", "Authorization:key=" . $auth);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$res = curl_exec($ch);
		$res_info = @curl_getinfo($ch);

		curl_close($ch);

		if ($res == null)
			$res = array();
		
		$res['data'] =  json_decode($res, true);
		$res['http_code'] = @$res_info['http_code'];
		$res['total_time'] = @$res_info['total_time'];

		@flush();
		@ob_flush();

		return $res;
	}


	function failure_RegID_Null($res, $RegIDs, $member_idxs) {
		$sql_string = "";

		$r = (array)$res;
		if ($r['failure'] > 0) {
			$r_k = $r['results'];
			for ($k = 0; $k < count($r_k); $k++) {
				$r_k[$k] = (array)$r_k[$k];
				if (@$r_k[$k]['error'] != "" && ($r_k[$k]['error'] == "InvalidRegistration" || $r_k[$k]['error'] == "MismatchSenderId" || $r_k[$k]['error'] == "NotRegistered")) {
					$sql_string .= $member_idxs[$k] . ",";
				}
			}
			if (strlen($sql_string) > 0) {
				$sql_string = "(" . substr($sql_string, 0, strlen($sql_string) - 1) . ")";
				$sql_string = $this -> mysql_query -> update_return_string($this -> config -> db_info -> user_db, '`delete`', '1', "`idx` IN {$sql_string}");
			}
		}

		return $sql_string;
	}

	function getDatas($userid, $DeviceID, $app_type) {
		if (!isset($userid) || !isset($DeviceID))
			return false;
		$res = array();

		$query = $this -> mysql_query -> select($this -> config -> db_info -> user_db, "*", "`ID` = '$userid' and `DeviceID` = '$DeviceID' and (LENGTH(`RegID`) > 0 OR `RegID` IS NOT NULL) and `delete` = '0' and `app_type` = '0' ", 0, 1000);

		while (($data = $this -> mysql_query -> fetch($query)) != null) {
			foreach ($data as $key => $value) {
				if (!isset($res[$key])) {
					$res[$key] = array();
				}
				$res[$key][] = $value;
			}
		}

		if (!isset($res) || count($res) <= 0)
			return false;

		return $res;
	}

	function sendToMember_ALL_APNS($code, $title, $msg, $button_string, $url, $data, &$returnObj) {
		if (!isset($title) || !isset($msg))
			return false;

		$arrResultQuery = array();
		$arrResult = array();

		$max_count = $this -> mysql_query -> max_count_toQuery("select count(`idx`) FROM `{$this->config->db_info->user_db}` " . "WHERE (LENGTH(`RegID`) > 0 OR `RegID` IS NOT NULL) and `delete` = '0' and `app_type` = '1'  GROUP BY `DeviceID`");
		if($max_count == 0) return false;
		if ($max_count > 0) {
			for ($i = 1; $i <= ceil($max_count / $this -> max_send_count); $i++) {
				$start_limit = $i * $this -> max_send_count - $this -> max_send_count;
				$query = $this -> mysql_query -> select($this -> config -> db_info -> user_db, "`idx`,`RegID`", "(LENGTH(`RegID`) > 0 OR `RegID` IS NOT NULL) and `delete` = '0' and `app_type` = '1'  GROUP BY `DeviceID` ORDER BY `idx` asc", $start_limit, $this -> max_send_count);
				$member_idxs = array();
				$regIDs = $this -> MysqlQueryToRegID($query, &$member_idxs);
				$res = $this -> sendMessages_APNS($this -> config -> apnsHost, $this -> config -> apnsCert, $regIDs, $code, $title, $msg, $button_string, $url, $data);
				$resQuery = $this -> failure_RegID_Null($res, $regIDs, $member_idxs);
				$arrResult["i_" . $i] = $res;
				$arrResult["i_" . $i]['delete'] = $resQuery;
				if ($resQuery != "") {
					$arrResultQuery[] = $resQuery;
				}
			}
			foreach ($arrResultQuery as $key => $sql_string) {
				$this -> mysql_query -> query($sql_string);
			}
		}
		$arrResult['max_count'] = $max_count;
		$returnObj = (object)$arrResult;

		return false;
	}

	function sendMessages_APNS($apnsHost, $apnsCert, $registration_ids, $code, $title, $message, $button_string, $url, $_data) {
		foreach ($registration_ids as $key => $val) {
			$deviceToken = $val;
			$apnsPort = 2195;
			//$message = iconv("EUC-KR", "UTF-8", "$message");
			//$message = iconv("UTF-8", "EUC-KR", "$message");
			//이곳을 고치시면 됩니다.
			$msg = strip_tags("$title");
			//$payload = array('aps' => array('alert' => "$msg", 'badge' => 1, 'sound' => 'default', 'url' => $url, 'code'=> $code), "content-available"=>"1");
			$payload = array('aps' => array('sound' => 'default', "content-available"=>"1", 'alert' => "$msg", 'url' => $url));
			$payload = json_encode($payload);
			$streamContext = stream_context_create();
			stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
			
			$apns = stream_socket_client('ssl://'.$apnsHost.':'.$apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
			//$apns = fsockopen('ssl://' . $apnsHost, $apnsPort, $error, $errorString, 60);

			if ($apns) {
				$apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $deviceToken)) . chr(0) . chr(strlen($payload)) . $payload;
				fwrite($apns, $apnsMessage);
				fclose($apns);
			}
		}
	}

	function sendToMember_idx_APNS($code, $idx, $title, $msg, $button_string, $url, $data, &$returnObj) {
		if (!isset($idx) || !isset($title) || !isset($msg))
			return false;
		$arrResultQuery = array();
		$arrResult = array();

		$member_data = $this -> member_class -> getMember_idx($idx, "`idx`,`RegID`");

		if (!isset($member_data) || !isset($member_data['RegID']))
			return false;

		$regIDs = array($member_data['RegID']);

		$res = $this -> sendMessage($this -> config -> gcm -> server_key, $member_data['RegID'], $code, $title, $msg, $button_string, $url, $data);
		$resQuery = $this -> failure_RegID_Null($res, $regIDs, array($member_data['idx']));
		$arrResult["i_0"] = $res;
		$arrResult["i_0"]['delete'] = $resQuery;
		if ($resQuery != "") {
			$arrResultQuery[] = $resQuery;
		}
		foreach ($arrResultQuery as $key => $sql_string) {
			$this -> mysql_query -> query($sql_string);
		}

		$returnObj = (object)$arrResult;

		return true;
	}

	function sendToMember_ID_APNS($code, $ID, $title, $msg, $button_string, $url, $data, &$returnObj) {

		if (!isset($ID) || !isset($title) || !isset($msg))
			return false;
		$arrResultQuery = array();
		$arrResult = array();
		$max_count = $this -> mysql_query -> max_count($this -> config -> db_info -> user_db, "`ID` = '{$ID}' and (LENGTH(`RegID`) > 0 OR `RegID` IS NOT NULL) and `delete` = '0' and `app_type` = '1' GROUP BY `DeviceID` ");
		if($max_count == 0) return false;
		if ($max_count > 0) {
			for ($i = 1; $i <= ceil($max_count / $this -> max_send_count); $i++) {
				$start_limit = $i * $this -> max_send_count - $this -> max_send_count;
				$query = $this -> mysql_query -> select($this -> config -> db_info -> user_db, "`idx`,`RegID`", "`ID` = '{$ID}' and ( LENGTH(`RegID`) > 0 OR `RegID` IS NOT NULL) and `delete` = '0' and `app_type` = '1' GROUP BY `DeviceID`", $start_limit, $this -> max_send_count);
				$member_idxs = array();
				$regIDs = $this -> MysqlQueryToRegID($query, &$member_idxs);
				$res = $this -> sendMessages_APNS($this -> config -> apnsHost, $this -> config -> apnsCert, $regIDs, $code, $title, $msg, $button_string, $url, $data);
				$resQuery = $this -> failure_RegID_Null($res, $regIDs, $member_idxs);

				$arrResult["i_" . $i] = $res;
				$arrResult["i_" . $i]['delete'] = $resQuery;
				if ($resQuery != "") {
					$arrResultQuery[] = $resQuery;
				}

			}
			foreach ($arrResultQuery as $key => $sql_string) {
				$this -> mysql_query -> query($sql_string);
			}
		}
		$arrResult['max_count'] = $max_count;

		$returnObj = (object)$arrResult;

		return true;
	}
}
