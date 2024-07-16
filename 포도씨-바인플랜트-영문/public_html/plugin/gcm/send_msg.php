<?
include_once('./_common.php');

	if($post_no == null || $post_no == "") return;
	if($post_title == null || $post_title == "") return;
	if($post_content == null || $post_content == "") return;
	if($post_save != false) $post_save = true;

	if(is_array($post_user)){
		for($i=0; $i<count($post_user); $i++){
			$q_re = sql_query("Select * from `gcm_member` Where `mb_id` = '$post_user[$i]' and `state` = '1'");
			while($mb = sql_fetch_array($q_re)){
				$mb_arr[] = $mb;
			}
		}
	} else {
		if($post_user) $Where = " `mb_id` = '$post_user' and ";
		$q_re = sql_query("Select * from `gcm_member` Where $Where `state` = '1'");
		while($mb = sql_fetch_array($q_re)){
			$mb_arr[] = $mb;
		}
	}
	
	if($mb_arr == null || $mb_arr == "") return;

	$android_gcm_key = "AIzaSyB3X1b-edmUeuKKp_zgX2am5BsnRkj7eXQ";
	$GCM_RegistrationID = "885975414796";

	$apnsPort = 2195;
	$apnsKey = "6LBZJ6DW9F.p8";
	$apnsKeyId = "6LBZJ6DW9F";
	$apnsTeamId = "PGGLAPZ9AB"; 
	$production = false;

	sendMessage($android_gcm_key, $apnsKey, $apnsKeyId, $apnsTeamId, $production, $mb_arr, $post_no, $post_title, $post_content, $post_url, $post_save, $member[mb_id]);

	function sendMessage($android_auth, $key, $keyId, $teamId, $production, $mb_arr, $code, $title, $content, $url, $save, $mb_id) {
		$data = array(
			'android_auth' => $android_auth,
			'ios_key' => $key,
			'ios_keyId' => $keyId,
			'ios_teamId' => $teamId,
			'production' => $production,
			'title' => $title,
			'msg' => $content,
			'url' => $url,
			'code' => $code,
			'mb_arr' => $mb_arr,
			'time' => date("Y-m-d H:i:s", time())
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://gcm.cafe24app.com");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$result = curl_exec($ch);
		$res_info = @curl_getinfo($ch);
		curl_close($ch);

		if($result != null && $result != ""){
			$result = json_decode($result);		//json stdClass 변환
			$result = objectToArray($result);	//json Array 변환
		} else {
			return;
		}
		if($save){
			for($i=0; $i<count($mb_arr); $i++){
				$view_m = $mb_arr[$i][mb_id];
				sql_query("Insert into `gcm_write_msg` set
								`mb_id`		=	'$mb_id',
								`title`		=	'$title',
								`msg`		=	'$content',
								`link`		=	'$url',
								`date`		=	NOW(),
								`count`		=	'1',
								`view_member`	=	'',
								`send_member`	=	'$view_m'");
			}

		}

/*
		for($i=0; $i<count($result); $i++){
			$res = $result[$i];
			if($mb['type'] == "0" || $mb['type'] == 'android'){
				if($res[success] == "1"){
					if($save){
						sql_query("Insert into `gcm_write_msg` set
							`mb_id`		=	'$member[mb_id]',
							`title`		=	'$title',
							`msg`		=	'$content',
							`link`		=	'$url',
							`date`		=	NOW(),
							`count`		=	'1',
							`view_member`	=	'$mb[mb_id]',
							`send_member`	=	'$member[mb_id]'");
						sql_query("Update `gcm_member` set `count` = `count` + 1 Where `RegID` = '$mb[RegID]'");
					}

				} else {
					if($res[results][0][error] != "Unavailable"){
						sql_query("Update `gcm_member` set `State` = '0' Where `RegID` = '$mb[RegID]'");
					}
				}
			} else if($mb['type'] == "1" || $mb['type'] == 'ios'){
				if($res['failed'] == null){
					if($save){
						sql_query("Insert into `gcm_write_msg` set
							`mb_id`		=	'$member[mb_id]',
							`title`		=	'$title',
							`msg`		=	'$content',
							`link`		=	'$url',
							`date`		=	NOW(),
							`count`		=	'1',
							`view_member`	=	'$mb[mb_id]',
							`send_member`	=	'$member[mb_id]'");
						sql_query("Update `gcm_member` set `count` = `count` + 1 Where `RegID` = '$mb[RegID]'");
					}
				} else {
					if($res['failed'][0]['status'] == 400){
						sql_query("Update `gcm_member` set `State` = '0' Where `RegID` = '$mb[RegID]'");
					}
				}
			}
		}
*/
	}

	function objectToArray($d) {
		if (is_object($d)) {
			$d = get_object_vars($d);
		}
	 
		if (is_array($d)) {
			return array_map(__FUNCTION__, $d);
		} else {
			return $d;
		}
	}

	function arrayToObject($d) {
		if (is_array($d)) {
			return (object) array_map(__FUNCTION__, $d);
		} else {
			return $d;
		}
	}

?>