<?
	include "../../common.php";
	function han ($s) { return reset(json_decode('{"s":"'.$s.'"}')); }

	function to_han ($str) { return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',$str); }



	include "./".$division."_json.php";
?>