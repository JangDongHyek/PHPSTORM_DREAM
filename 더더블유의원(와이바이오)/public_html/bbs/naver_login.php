<?php
include_once('./_common.php');
$naver_curl = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".NAVER_CLIENT_ID."&client_secret=".NAVER_CLIENT_SECRET."&redirect_uri=".urlencode(NAVER_CALLBACK_URL)."&code=".$_GET['code'];//상수는 /public_html/common.php에 있음
 
// 토큰값 가져오기 
$is_post = false; 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $naver_curl); 
curl_setopt($ch, CURLOPT_POST, $is_post); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
 
$response = curl_exec ($ch); 
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
curl_close ($ch); 
 
if($status_code == 200){ 
    $responseArr = json_decode($response, true); 
 
      // 토큰값으로 네이버 회원정보 가져오기 
      $headers = array( 'Content-Type: application/json', sprintf('Authorization: Bearer %s', $responseArr['access_token']) ); 
      $is_post = false; 
      $me_ch = curl_init(); 
      curl_setopt($me_ch, CURLOPT_URL, "https://openapi.naver.com/v1/nid/me"); 
      curl_setopt($me_ch, CURLOPT_POST, $is_post ); 
      curl_setopt($me_ch, CURLOPT_HTTPHEADER, $headers); 
      curl_setopt($me_ch, CURLOPT_RETURNTRANSFER, true); 
      $res = curl_exec ($me_ch); 
      curl_close ($me_ch); 
      $res_data = json_decode($res , true); 
	  
	  $res_data ['response']['name'];
      if ($res_data ['response']['id']) { 
		$mb_id=$res_data['response']['id'];
		$mb_name = $res_data['response']['name'];
		$mb_nick = $res_data['response']['nickname'];
		$mb_email = $res_data['response']['email'];
		$mb_level = 2;
		$mb_datetime=date("Y-m-d H:i:s");
        //해당 아이디값을 정상적으로 가져온다면 디비에 해당 아이디로 회원가입 여부 확인 하여 회원 가입을 하였으면 자동 로그인 구현.
		$sql="select * from g5_member where mb_id='".$mb_id."'";
		$row=sql_fetch($sql);
		if($row[mb_id]){
			$sql="update g5_member set 
					mb_email='$mb_email'
					where mb_id='$mb_id'";
			sql_query($sql);
		}else{
			$sql="insert g5_member set 
					mb_id='$mb_id',
					mb_name='$mb_name',
					mb_email = '$mb_email',
					mb_level='$mb_level',
					mb_datetime='$mb_datetime'";
			sql_query($sql);
		}
           
		$mb=get_member($mb_id);
		// 회원아이디 세션 생성
		set_session('ss_mb_id', $mb['mb_id']);
		// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
		set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
		goto_url("/");
        
 
      }
}
?>