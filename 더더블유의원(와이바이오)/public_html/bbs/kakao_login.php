<?php
// ![수정필요] 카카오 API 환경설정 파일 
include_once('./_common.php');

try{

		

		// 기본 응답 설정
		$res = array('rst'=>'fail','code'=>'','msg'=>'');

		// code && state 체크
		if( empty($_GET['code'])){ echo "인증실패";}
			

		// 토큰 요청
		$replace = array(
			'{grant_type}'=>'authorization_code',
			'{client_id}'=>$kakaoConfig['client_id'],
			'{redirect_uri}'=>$kakaoConfig['redirect_uri'],
			'{client_secret}'=>$kakaoConfig['client_secret'],
			'{code}'=>$_GET['code']
		);
		$login_token_url = str_replace(array_keys($replace), array_values($replace), $kakaoConfig['login_token_url']);
		$token_data = json_decode(curl_kakao($login_token_url));
		
		if( empty($token_data)){ echo "토큰요청 실패"; }
		if( !empty($token_data->error) || empty($token_data->access_token) ){ 
			echo "토큰 인증 에러";
		}


		// 프로필 요청 
		$header = array("Authorization: Bearer ".$token_data->access_token);
		$profile_url = $kakaoConfig['profile_url'];
		$profile_data = json_decode(curl_kakao($profile_url,$header));
		if( empty($profile_data) || empty($profile_data->id) ){ echo "프로필 요청실패"; }

		// 프로필정보 저장 -- DB를 통해 저장하세요
		/*
			echo '<pre>';
			print_r($profile_data);
			echo '</pre>';		
			exit;
		*/
		
		$mb_id=$profile_data->id;
		$mb_name = $profile_data->properties->nickname;
		$mb_email = $profile_data->kakao_account->email;
		$mb_level = 2;
		$mb_datetime=date("Y-m-d H:i:s");
		
		$sql="select * from g5_member where mb_id='$mb_id'";
		$row=sql_fetch($sql);
		
		
		$is_member=$row[mb_id]?true:false;
		if($mb_id){
			// 로그인 회원일 경우
			if( $is_member === true){
				$sql="update g5_member set 
						mb_email='$mb_email'
						where mb_id='$mb_id'";
				sql_query($sql);
			}
			// 새로 가입일 경우
			else{
				$sql="insert g5_member set 
						mb_id='$mb_id',
						mb_name='$mb_name',
						mb_email='$mb_email',
						mb_level='$mb_level',
						mb_datetime='$mb_datetime'";
				sql_query($sql);
			}

			$mb=get_member($mb_id);
			// 회원아이디 세션 생성
			set_session('ss_mb_id', $mb['mb_id']);
			// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
			set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
			
			// 최종 성공 처리
			$res['rst'] = 'success';
		}

	}catch(Exception $e){
		echo $e;
		
	}


	// 성공처리
	if($res['rst'] == 'success'){

	}

	// 실패처리 
	else{

	}

	// state 초기화 
	setcookie('state','',time()-3000); // 300 초동안 유효

	header("Location: /");
	exit;