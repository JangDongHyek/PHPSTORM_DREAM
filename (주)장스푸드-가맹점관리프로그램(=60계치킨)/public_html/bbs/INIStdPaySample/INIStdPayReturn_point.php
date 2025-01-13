<?php
header("Content-Type: text/html; charset=UTF-8");

include_once('../../common.php');

require_once('../libs/INIStdPayUtil.php');
require_once('../libs/HttpClient.php');
require_once('../libs/sha256.inc.php');
require_once('../libs/json_lib.php');

$util = new INIStdPayUtil();

try {

	//#############################
	// 인증결과 파라미터 일괄 수신
	//#############################

	$merchant_arr = Array();
	$add_qry = "";
	$merchantData_arr = explode('&',$_REQUEST["merchantData"]);

	for($arr=0; $arr<count($merchantData_arr); $arr++){
		$merchantData_arr2 = explode('=',$merchantData_arr[$arr]);

		if($merchantData_arr2[0] == 'od_idx'){
			$od_idx = $merchantData_arr2[1];
		} else {
			$add_qry .= ", {$merchantData_arr2[0]} = '".urldecode($merchantData_arr2[1])."'";
		}
	}

	//#####################
	// 인증이 성공일 경우만
	//#####################
	if (strcmp("0000", $_REQUEST["resultCode"]) == 0) {

		//echo "####인증성공/승인요청####";
		//echo "<br/>";

		//############################################
		// 1.전문 필드 값 설정(***가맹점 개발수정***)
		//############################################

		$mid 				= $_REQUEST["mid"];     						// 가맹점 ID 수신 받은 데이터로 설정

		if($_SERVER['REMOTE_ADDR']=="121.144.134.22"){
			$signKey 		= "SU5JTElURV9UUklQTEVERVNfS0VZU1RS"; 			// 가맹점에 제공된 키(이니라이트키) (가맹점 수정후 고정) !!!절대!! 전문 데이터로 설정금지
		}else{
			$signKey 			= "cml2aGZnL1dNY28rcHE5WlZuMG9hZz09"; 			// 가맹점에 제공된 키(이니라이트키) (가맹점 수정후 고정) !!!절대!! 전문 데이터로 설정금지
		}

		$timestamp 			= $util->getTimestamp();   						// util에 의해서 자동생성

		$charset 			= "UTF-8";        								// 리턴형식[UTF-8,EUC-KR](가맹점 수정후 고정)

		$format 			= "JSON";        								// 리턴형식[XML,JSON,NVP](가맹점 수정후 고정)

		$authToken 			= $_REQUEST["authToken"];   					// 취소 요청 tid에 따라서 유동적(가맹점 수정후 고정)

		$authUrl 			= $_REQUEST["authUrl"];    						// 승인요청 API url(수신 받은 값으로 설정, 임의 세팅 금지)

		$netCancel 			= $_REQUEST["netCancelUrl"];   					// 망취소 API url(수신 받은f값으로 설정, 임의 세팅 금지)

		$mKey 				= hash("sha256", $signKey);						// 가맹점 확인을 위한 signKey를 해시값으로 변경 (SHA-256방식 사용)

		//#####################
		// 2.signature 생성
		//#####################
		$signParam["authToken"] = $authToken;  		// 필수
		$signParam["timestamp"] = $timestamp;  		// 필수
		// signature 데이터 생성 (모듈에서 자동으로 signParam을 알파벳 순으로 정렬후 NVP 방식으로 나열해 hash)
		$signature = $util->makeSignature($signParam);


		//#####################
		// 3.API 요청 전문 생성
		//#####################
		$authMap["mid"] 		= $mid;   			// 필수
		$authMap["authToken"] 	= $authToken; 		// 필수
		$authMap["signature"] 	= $signature; 		// 필수
		$authMap["timestamp"] 	= $timestamp; 		// 필수
		$authMap["charset"] 	= $charset;  		// default=UTF-8
		$authMap["format"] 		= $format;  		// default=XML

		try {

			$httpUtil = new HttpClient();

			//#####################
			// 4.API 통신 시작
			//#####################

			$authResultString = "";
			if ($httpUtil->processHTTP($authUrl, $authMap)) {
				$authResultString = $httpUtil->body;
				//echo "<p><b>RESULT DATA :</b> $authResultString</p>";			//PRINT DATA
			} else {
				//echo "Http Connect Error\n";
				//echo $httpUtil->errormsg;
				echo "<script>
					alert('카드결제 연결에 실패하였습니다');
					location.href = '".G5_URL."';
				</script>";
				exit;

				throw new Exception("Http Connect Error");
			}

			//############################################################
			//5.API 통신결과 처리(***가맹점 개발수정***)
			//############################################################
			//echo "## 승인 API 결과 ##";
			
			$resultMap = json_decode($authResultString, true);
			//echo "<pre>";
			//echo "<table width='565' border='0' cellspacing='0' cellpadding='0'>";

			/*************************  결제보안 추가 2016-05-18 START ****************************/ 
			$secureMap["mid"]		= $mid;							//mid
			$secureMap["tstamp"]	= $timestamp;					//timestemp
			$secureMap["MOID"]		= $resultMap["MOID"];			//MOID
			$secureMap["TotPrice"]	= $resultMap["TotPrice"];		//TotPrice
			
			// signature 데이터 생성 
			$secureSignature = $util->makeSignatureAuth($secureMap);
			/*************************  결제보안 추가 2016-05-18 END ****************************/

			if ((strcmp("0000", $resultMap["resultCode"]) == 0) && (strcmp($secureSignature, $resultMap["authSignature"]) == 0) ){	//결제보안 추가 2016-05-18
			   /*****************************************************************************
			   * 여기에 가맹점 내부 DB에 결제 결과를 반영하는 관련 프로그램 코드를 구현한다.  
			   
				 [중요!] 승인내용에 이상이 없음을 확인한 뒤 가맹점 DB에 해당건이 정상처리 되었음을 반영함
						  처리중 에러 발생시 망취소를 한다.
			   ******************************************************************************/

				// 190311 결제완료로 변경되는 오류때문에 추가
				if(strcmp("VBank", $resultMap["payMethod"]) == 0){
					$statusSTR = "입금대기";
				} else {
					$statusSTR = "결제완료";
				}

				$sql = " update g5_point_order set 
						od_status = '신청',
						pay_status = '{$statusSTR}',
						od_date = '".date('Y-m-d H:i:s')."', 
						tid = '{$resultMap['tid']}', 
						result_code = '{$resultMap['resultCode']}', 
						result_msg = '{$resultMap['resultMsg']}', 
						moid = '{$resultMap['MOID']}', 
						appl_date = '{$resultMap['applDate']}', 
						appl_time = '{$resultMap['applTime']}' 
						{$add_qry} 
						where od_idx = '{$od_idx}'
						";
				sql_query($sql);

				$sql2 = " update g5_point_cart set ct_status = '신청' where od_idx='{$od_idx}' ";
				sql_query($sql2);


				/* SMS 발송 STR */
				// 가상계좌는 입금확인 후 발송 해야함
				// SMS 발송
				$od_sql = " select * from g5_point_order where od_idx = '{$od_idx}' ";
				$od_row = sql_fetch($od_sql);
				$mb_hp = $od_row['mb_hp'];

				$mem_sql = " select * from g5_member where mb_id='{$od_row['mb_id']}' ";
				$mem_row = sql_fetch($mem_sql);

				$moid_arr = explode('60chicken4_',$resultMap['MOID']);
				
				$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
				mysql_select_db("chicken60");


				if(strcmp("VBank", $resultMap["payMethod"]) == 0){	// ======================> 가상계좌

					// 점주에게 발송
					$tran_msg1 = "[60계치킨] 주문이 완료되었습니다\n주문번호 : {$moid_arr[1]}";
					$sql = "insert into TBL_SUBMIT_QUEUE values
					(
						'200".$od_idx."0',
						'orders',
						'4133',
						'1',
						'00',
						'I',
						CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
						'1',
						'".str_replace('-','',$mb_hp)."',
						'".$g_tel2."',
						'',
						'00000',
						'".$tran_msg1."',
						'',
						'0',
						'',
						'',
						CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
						'',
						'',
						'',
						'',
						'0',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'0',
						'0'
					)";
					mysql_query($sql,$conn_db);

					

				} else {											// ======================> 신용카드, 실시간 계좌이체

					// 점주에게 발송
					$tran_msg1 = "[60계치킨] 결제가 완료되었습니다\n주문번호 : {$moid_arr[1]}";

					// 점주에게 발송
					$tran_msg2 = "{$mem_row['mb_2']}\n주문번호 : {$moid_arr[1]} 주문이 완료되었습니다\n빠른시간안에 제작하여 배송해드리겠습니다";

					// 회원관리에서 결제 체킹된 임직원에게 발송
					$tran_msg3 = "[60계치킨] 결제가 완료되었습니다\n매장명 : {$mem_row['mb_2']}\n주문번호 : {$moid_arr[1]}";

					// 회원관리에서 주문 체킹된 임직원에게 발송
					$tran_msg4 = "[60계치킨] 디자인 작업요청되었습니다\n매장명 : {$mem_row['mb_2']}\n주문번호 : {$moid_arr[1]}";

					$sql = "insert into TBL_SUBMIT_QUEUE values
					(
						'200".$od_idx."0',
						'orders',
						'4133',
						'1',
						'00',
						'I',
						CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
						'1',
						'".str_replace('-','',$mb_hp)."',
						'".$g_tel2."',
						'',
						'00000',
						'".$tran_msg1."',
						'',
						'0',
						'',
						'',
						CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
						'',
						'',
						'',
						'',
						'0',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'0',
						'0'
					)";
					mysql_query($sql,$conn_db);

					$sql2 = "insert into TBL_SUBMIT_QUEUE values
					(
						'200".$od_idx."1',
						'orders',
						'4133',
						'1',
						'00',
						'I',
						CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
						'1',
						'".str_replace('-','',$mb_hp)."',
						'".$g_tel2."',
						'',
						'00000',
						'".$tran_msg2."',
						'',
						'0',
						'',
						'',
						CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
						'',
						'',
						'',
						'',
						'0',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'0',
						'0'
					)";
					mysql_query($sql2,$conn_db);

					$oscm1_sql = " select * from g5_order_sms_cate_mb where oscm_ca_name='결제' and oscm_use='y' ";
					$oscm1_qry = sql_query($oscm1_sql);
					$k1=0;
					while($oscm1_row = sql_fetch_array($oscm1_qry)){
						$sql3 = "insert into TBL_SUBMIT_QUEUE values
						(
							'200".$od_idx."0".$k1."',
							'orders',
							'4133',
							'1',
							'10',
							'I',
							CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
							'1',
							'".str_replace('-','',$oscm1_row['oscm_mb_hp'])."',
							'".$g_tel2."',
							'',
							'00000',
							'".$tran_msg3."',
							'',
							'1',
							'text/plain',
							'',
							CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
							'',
							'',
							'',
							'',
							'0',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'0',
							'0'
						)";
						mysql_query($sql3,$conn_db);
						$k1++;
					}

					$oscm2_sql = " select * from g5_order_sms_cate_mb where oscm_ca_name='주문' and oscm_use='y' ";
					$oscm2_qry = sql_query($oscm2_sql);
					$k2=0;
					while($oscm2_row = sql_fetch_array($oscm2_qry)){
						$sql4 = "insert into TBL_SUBMIT_QUEUE values
						(
							'200".$od_idx."1".$k2."',
							'orders',
							'4133',
							'1',
							'10',
							'I',
							CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
							'1',
							'".str_replace('-','',$oscm2_row['oscm_mb_hp'])."',
							'".$g_tel2."',
							'',
							'00000',
							'".$tran_msg4."',
							'',
							'1',
							'text/plain',
							'',
							CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
							'',
							'',
							'',
							'',
							'0',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'0',
							'0'
						)";
						//mysql_query($sql4,$conn_db);
						$k2++;
					}
				}
				/* SMS 발송 END */

				$location_data = G5_BBS_URL."/content.php?co_id=point_myorder&od_idx=".$od_idx;

				//echo "<tr><th class='td01'><p>거래 성공 여부</p></th>";
				//echo "<td class='td02'><p>성공</p></td></tr>";

			} else {											// ======================> 결제실패

				if ($resultMap['resultCode'] == "R201") {	// (210319 추가) R201 : 승인요청 완료건으로 재승인요청 불가
					$rs = sql_fetch("SELECT result_code FROM g5_point_order WHERE od_idx = '{$od_idx}'");

					if ($rs['result_code'] == "0000") {
						$location_data = G5_BBS_URL."/content.php?co_id=point_myorder";
						die("<script>alert('이미 결제완료된 주문건 입니다.'); location.href = '{$location_data}'; </script>");
					}
				}

				$sql = " update g5_point_order set 
					od_status = '신청',
					pay_status = '결제실패',
					od_date = '".date('Y-m-d H:i:s')."', 
					tid = '{$resultMap['tid']}', 
					result_code = '{$resultMap['resultCode']}', 
					result_msg = '{$resultMap['resultMsg']}', 
					moid = '{$resultMap['MOID']}', 
					appl_date = '{$resultMap['applDate']}', 
					appl_time = '{$resultMap['applTime']}' 
					{$add_qry} 
					where od_idx = '{$od_idx}'
				";
				sql_query($sql);

				$sql2 = " update g5_point_cart set ct_status = '' where od_idx='{$od_idx}' ";
				sql_query($sql2);

				$location_data = G5_BBS_URL."/board.php?bo_table=point_item";

				//echo "<tr><th class='td01'><p>거래 성공 여부</p></th>";
				//echo "<td class='td02'><p>실패</p></td></tr>";
				/*echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>결과 코드</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["resultCode"] , $resultMap) ? $resultMap["resultCode"] : "null" ) . "</p></td></tr>";*/
				
				//결제보안키가 다른 경우.
				if (strcmp($secureSignature, $resultMap["authSignature"]) != 0) {
					/*echo "<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>결과 내용</p></th>
						<td class='td02'><p>" . "* 데이터 위변조 체크 실패" . "</p></td></tr>";*/

					//망취소
					if(strcmp("0000", $resultMap["resultCode"]) == 0) {
						throw new Exception("데이터 위변조 체크 실패");
					}
				} else {
					/*echo "<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>결과 내용</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["resultMsg"] , $resultMap) ? $resultMap["resultMsg"] : "null" ) . "</p></td></tr>";*/
				}

				die("<script>alert('결제에 실패했습니다. 다시 시도해 주세요.'); location.href = '{$location_data}'; </script>");

			}

			//공통 부분만
			/*
			echo
					"<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>거래 번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["tid"] , $resultMap) ? $resultMap["tid"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>결제방법(지불수단)</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["payMethod"] , $resultMap) ? $resultMap["payMethod"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>결과 코드</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["resultCode"] , $resultMap) ? $resultMap["resultCode"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>결과 내용</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["resultMsg"] , $resultMap) ? $resultMap["resultMsg"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>결제완료금액</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["TotPrice"] , $resultMap) ? $resultMap["TotPrice"] : "null" ) . "원</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>주문 번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["MOID"] , $resultMap) ? $resultMap["MOID"] : "null" )  . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>승인날짜</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["applDate"] , $resultMap) ? $resultMap["applDate"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>승인시간</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["applTime"] , $resultMap) ? $resultMap["applTime"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>";
			*/

			if (isset($resultMap["payMethod"]) && strcmp("VBank", $resultMap["payMethod"]) == 0) { //가상계좌

				$sql = " update g5_point_order set 
						od_status = '신청',
						pay_status = '입금대기',
						acct_bankcode = '".@(in_array($resultMap["VACT_BankCode"] , $resultMap) ? $resultMap["VACT_BankCode"] : "null" )."',
						vact_num = '".@(in_array($resultMap["VACT_Num"] , $resultMap) ? $resultMap["VACT_Num"] : "null" )."',
						vact_bankname = '".@(in_array($resultMap["vactBankName"] , $resultMap) ? $resultMap["vactBankName"] : "null" )."',
						vact_name = '".@(in_array($resultMap["VACT_Name"] , $resultMap) ? $resultMap["VACT_Name"] : "null" )."',
						vact_date = '".@(in_array($resultMap["VACT_Date"] , $resultMap) ? $resultMap["VACT_Date"] : "null" )."|".@(in_array($resultMap["VACT_Time"] , $resultMap) ? $resultMap["VACT_Time"] : "null" )."',
						vact_inputname = '".@(in_array($resultMap["VACT_InputName"] , $resultMap) ? $resultMap["VACT_InputName"] : "null" )."'
						where od_idx = '{$od_idx}'
						";
				sql_query($sql);

				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>입금 계좌번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["VACT_Num"] , $resultMap) ? $resultMap["VACT_Num"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>입금 은행코드</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["VACT_BankCode"] , $resultMap) ? $resultMap["VACT_BankCode"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>입금 은행명</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["vactBankName"] , $resultMap) ? $resultMap["vactBankName"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>예금주 명</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["VACT_Name"] , $resultMap) ? $resultMap["VACT_Name"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>송금자 명</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["VACT_InputName"] , $resultMap) ? $resultMap["VACT_InputName"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>송금 일자</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["VACT_Date"] , $resultMap) ? $resultMap["VACT_Date"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>송금 시간</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["VACT_Time"] , $resultMap) ? $resultMap["VACT_Time"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>";
				*/

			} else if (isset($resultMap["payMethod"]) && strcmp("DirectBank", $resultMap["payMethod"]) == 0) { //실시간계좌이체
				$sql = " update g5_point_order set 
					od_status = '신청',
					acct_bankcode = '".@(in_array($resultMap["ACCT_BankCode"] , $resultMap) ? $resultMap["ACCT_BankCode"] : "null" )."', 
					cshr_code = '".@(in_array($resultMap["CSHRResultCode"] , $resultMap) ? $resultMap["CSHRResultCode"] : "null" )."', 
					cshr_type = '".@(in_array($resultMap["CSHR_Type"] , $resultMap) ? $resultMap["CSHR_Type"] : "null" )."' 
					where od_idx = '{$od_idx}'
				";
				sql_query($sql);
				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>은행코드</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["ACCT_BankCode"] , $resultMap) ? $resultMap["ACCT_BankCode"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>현금영수증 발급결과코드</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["CSHRResultCode"] , $resultMap) ? $resultMap["CSHRResultCode"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>현금영수증 발급구분코드</p> <font color=red><b>(0 - 소득공제용, 1 - 지출증빙용)</b></font></th>
					<td class='td02'><p>" . @(in_array($resultMap["CSHR_Type"] , $resultMap) ? $resultMap["CSHR_Type"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>";
				*/
			} else if (isset($resultMap["payMethod"]) && strcmp("HPP", $resultMap["payMethod"]) == 0) { //휴대폰
				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>통신사</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["HPP_Corp"] , $resultMap) ? $resultMap["HPP_Corp"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>결제장치</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["payDevice"] , $resultMap) ? $resultMap["payDevice"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>휴대폰번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["HPP_Num"] , $resultMap) ? $resultMap["HPP_Num"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>";
				*/
		   } else if (isset($resultMap["payMethod"]) && strcmp("Culture", $resultMap["payMethod"]) == 0) { //문화상품권
			  /*
			  echo "<tr><th class='line' colspan='2'><p></p></th></tr>
			  <tr><th class='td01'><p>문화상품권승인일자</p></th>
			  <td class='td02'><p>" . @(in_array($resultMap["applDate"] , $resultMap) ? $resultMap["applDate"] : "null" ) . "원</p></td></tr>
			  <tr><th class='line' colspan='2'><p></p></th></tr>
			  <tr><th class='td01'><p>문화상품권 승인시간</p></th>
			  <td class='td02'><p>" . @(in_array($resultMap["applTime"] , $resultMap) ? $resultMap["applTime"] : "null" ) . "</p></td></tr>
			  <tr><th class='line' colspan='2'><p></p></th></tr>
			  <tr><th class='td01'><p>문화상품권 승인번호</p></th>
			  <td class='td02'><p>" . @(in_array($resultMap["applNum"] , $resultMap) ? $resultMap["applNum"] : "null" ) . "</p></td></tr>
			  <tr><th class='line' colspan='2'><p></p></th></tr><tr><th class='line' colspan='2'><p></p></th></tr>
			  <tr><th class='td01'><p>컬처랜드 아이디</p></th>
			  <td class='td02'><p>" . @(in_array($resultMap["CULT_UserID"] , $resultMap) ? $resultMap["CULT_UserID"] : "null" ) . "</p></td></tr>
			  <tr><th class='line' colspan='2'><p></p></th></tr>";
			  */

			} else if (isset($resultMap["payMethod"]) && strcmp("DGCL", $resultMap["payMethod"]) == 0) { //게임문화상품권
				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>게임문화상품권승인금액</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["GAMG_ApplPrice"] , $resultMap) ? $resultMap["GAMG_ApplPrice"] : "null" ) . "원</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>사용한 카드수</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["GAMG_Cnt"] , $resultMap) ? $resultMap["GAMG_Cnt"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>사용한 카드번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["GAMG_Num1"] , $resultMap) ? $resultMap["GAMG_Num1"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>카드잔액</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["GAMG_Price1"] , $resultMap) ? $resultMap["GAMG_Price1"] : "null" ) . "원</p></td></tr>";

				if (!strcmp("", $resultMap["GAMG_Num2"]) == 0) {
					echo "<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>사용한 카드번호</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GAMG_Num2"] , $resultMap) ? $resultMap["GAMG_Num2"] : "null" ) . "</p></td></tr>
						<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>카드잔액</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GAMG_Price2"] , $resultMap) ? $resultMap["GAMG_Price2"] : "null" ) . "원</p></td></tr>";
				}
				if (!strcmp("", $resultMap["GAMG_Num3"]) == 0) {
					echo "<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>사용한 카드번호</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GAMG_Num3"] , $resultMap) ? $resultMap["GAMG_Num3"] : "null" ) . "</p></td></tr>
						<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>카드잔액</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GAMG_Price3"] , $resultMap) ? $resultMap["GAMG_Price3"] : "null" ) . "원</p></td></tr>";
				}
				if (!strcmp("", $resultMap["GAMG_Num4"]) == 0) {
					echo "<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>사용한 카드번호</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GAMG_Num4"] , $resultMap) ? $resultMap["GAMG_Num4"] : "null" ) . "</p></td></tr>
						<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>카드잔액</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GAMG_Price4"] , $resultMap) ? $resultMap["GAMG_Price4"] : "null" ) . "원</p></td></tr>";
				}
				if (!strcmp("", $resultMap["GAMG_Num5"]) == 0) {
					echo "<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>사용한 카드번호</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GAMG_Num5"] , $resultMap) ? $resultMap["GAMG_Num5"] : "null" ) . "</p></td></tr>
						<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>카드잔액</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GAMG_Price5"] , $resultMap) ? $resultMap["GAMG_Price5"] : "null" ) . "원</p></td></tr>";
				}
				if (!strcmp("", $resultMap["GAMG_Num6"]) == 0) {
					echo "<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>사용한 카드번호</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GAMG_Num6"] , $resultMap) ? $resultMap["GAMG_Num6"] : "null" ) . "</p></td></tr>
						<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>카드잔액</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GAMG_Price6"] , $resultMap) ? $resultMap["GAMG_Price6"] : "null" ) . "원</p></td></tr>";
				}

				//echo "<tr><th class='line' colspan='2'><p></p></th></tr>";
				*/

			} else if (isset($resultMap["payMethod"]) && strcmp("OCBPoint", $resultMap["payMethod"]) == 0) { //오케이 캐쉬백
				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>지불구분</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["PayOption"] , $resultMap) ? $resultMap["PayOption"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>결제완료금액</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["applPrice"] , $resultMap) ? $resultMap["applPrice"] : "null" ) . "원</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>OCB 카드번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["OCB_Num"] , $resultMap) ? $resultMap["OCB_Num"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>적립 승인번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["OCB_SaveApplNum"] , $resultMap) ? $resultMap["OCB_SaveApplNum"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>사용 승인번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["OCB_PayApplNum"] , $resultMap) ? $resultMap["OCB_PayApplNum"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>OCB 지불 금액</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["OCB_PayPrice"] , $resultMap) ? $resultMap["OCB_PayPrice"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>";
				*/
			} else if (isset($resultMap["payMethod"]) && (strcmp("GSPT", $resultMap["payMethod"]) == 0)) { //GSPoint
				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>지불구분</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["PayOption"] , $resultMap) ? $resultMap["PayOption"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>GS 포인트 승인금액</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["GSPT_ApplPrice"] , $resultMap) ? $resultMap["GSPT_ApplPrice"] : "null" ) . "원</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>GS 포인트 적립금액</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["GSPT_SavePrice"] , $resultMap) ? $resultMap["GSPT_SavePrice"] : "null" ) . "원</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>GS 포인트 지불금액</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["GSPT_PayPrice"] , $resultMap) ? $resultMap["GSPT_PayPrice"] : "null" ) . "원</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>";
				*/
			} else if (isset($resultMap["payMethod"]) && strcmp("UPNT", $resultMap["payMethod"]) == 0) {  //U-포인트
				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>U포인트 카드번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["UPoint_Num"] , $resultMap) ? $resultMap["UPoint_Num"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>가용포인트</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["UPoint_usablePoint"] , $resultMap) ? $resultMap["UPoint_usablePoint"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>포인트지불금액</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["UPoint_ApplPrice"] , $resultMap) ? $resultMap["UPoint_ApplPrice"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>";
				*/
			} else if (isset($resultMap["payMethod"]) && strcmp("KWPY", $resultMap["payMethod"]) == 0) {  //뱅크월렛 카카오
				/*
				echo "<tr><th class='td01'><p>결제방법</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["payMethod"] , $resultMap) ? $resultMap["payMethod"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>결과 코드</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["resultCode"] , $resultMap) ? $resultMap["resultCode"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>결과 내용</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["resultMsg"] , $resultMap) ? $resultMap["resultMsg"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>거래 번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["tid"] , $resultMap) ? $resultMap["tid"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>주문 번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["MOID"] , $resultMap) ? $resultMap["MOID"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>결제완료금액</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["price"] , $resultMap) ? $resultMap["price"] : "null" ) . "원</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>사용일자</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["applDate"] , $resultMap) ? $resultMap["applDate"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>사용시간</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["applTime"] , $resultMap) ? $resultMap["applTime"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>";
				*/
			} else if (isset($resultMap["payMethod"]) && strcmp("TEEN", $resultMap["payMethod"]) == 0) { //틴캐시
				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>틴캐시 승인번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["TEEN_ApplNum"] , $resultMap) ? $resultMap["TEEN_ApplNum"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>틴캐시아이디</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["TEEN_UserID"] , $resultMap) ? $resultMap["TEEN_UserID"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>틴캐시승인금액</p></th>				
					<td class='td02'><p>" . @(in_array($resultMap["TEEN_ApplPrice"] , $resultMap) ? $resultMap["TEEN_ApplPrice"] : "null" ) . "원</p></td></tr>";
				*/
			} else if (isset($resultMap["payMethod"]) && strcmp("Bookcash", $resultMap["payMethod"]) == 0) { //도서문화상품권
				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>도서상품권 승인번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["BCSH_ApplNum"] , $resultMap) ? $resultMap["BCSH_ApplNum"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>도서상품권 사용자ID</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["BCSH_UserID"] , $resultMap) ? $resultMap["BCSH_UserID"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>도서상품권 승인금액</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["BCSH_ApplPrice"] , $resultMap) ? $resultMap["BCSH_ApplPrice"] : "null" ) . "원</p></td></tr>";
				*/
			} else if (isset($resultMap["payMethod"]) && strcmp("PhoneBill", $resultMap["payMethod"]) == 0) { //폰빌전화결제
				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>승인전화번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["PHNB_Num"] , $resultMap) ? $resultMap["PHNB_Num"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>";
				*/
			} else if (isset($resultMap["payMethod"]) && strcmp("Bill", $resultMap["payMethod"]) == 0) { //빌링결제
				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>빌링키</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["CARD_BillKey"] , $resultMap) ? $resultMap["CARD_BillKey"] : "null" ) . "</p></td></tr>";
				*/
			}else if (isset($resultMap["payMethod"]) && strcmp("Auth", $resultMap["payMethod"]) == 0){//빌링결제
				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>빌링키</p></th>";
				*/
				if (isset($resultMap["payMethodDetail"]) && strcmp("BILL_CARD", $resultMap["payMethodDetail"]) == 0) {
					//echo "<td class='td02'><p>" . @(in_array($resultMap["CARD_BillKey"] , $resultMap) ? $resultMap["CARD_BillKey"] : "null" ) . "</p></td></tr>";
				} else  if (isset($resultMap["payMethodDetail"]) && strcmp("BILL_HPP", $resultMap["payMethodDetail"]) == 0) {
					/*
					echo "<td class='td02'><p>" . @(in_array($resultMap["HPP_BillKey"] , $resultMap) ? $resultMap["HPP_BillKey"] : "null" ) . "</p></td></tr>
							<tr><th class='line' colspan='2'><p></p></th></tr>
							<tr><th class='line' colspan='2'><p></p></th></tr>
							<tr><th class='td01'><p>통신사</p></th>
							<td class='td02'><p>" . @(in_array($resultMap["HPP_Corp"] , $resultMap) ? $resultMap["HPP_Corp"] : "null" ) . "</p></td></tr>
							<tr><th class='line' colspan='2'><p></p></th></tr>
							<tr><th class='td01'><p>결제장치</p></th>
							<td class='td02'><p>" . @(in_array($resultMap["payDevice"] , $resultMap) ? $resultMap["payDevice"] : "null" ) . "</p></td></tr>
							<tr><th class='line' colspan='2'><p></p></th></tr>
							<tr><th class='td01'><p>휴대폰번호</p></th>
							<td class='td02'><p>" . @(in_array($resultMap["HPP_Num"] , $resultMap) ? $resultMap["HPP_Num"] : "null" ) . "</p></td></tr>
							<tr><th class='line' colspan='2'><p></p></th></tr>
							<tr><th class='td01'><p>상품명</p></th>
							<td class='td02'><p>" . @(in_array($resultMap["goodName"] , $resultMap) ? $resultMap["goodName"] : "null" ) . "</p></td></tr>";
					*/
				}
			} else { //카드
				if (isset($resultMap["EventCode"]) && !is_null($resultMap["EventCode"])) {
					$sql = " update g5_point_order set 
							od_status = '신청',
							card_num = '".@(in_array($resultMap["CARD_Num"] , $resultMap) ? $resultMap["CARD_Num"] : "null" )."', 
							card_quota = '".@(in_array($resultMap["CARD_Quota"] , $resultMap) ? $resultMap["CARD_Quota"] : "null" )."' 
							where od_idx = '{$od_idx}'
							";
					sql_query($sql);

					/*
					echo "<tr><th class='line' colspan='2'><p></p></th></tr>
				<tr><th class='td01'><p>이벤트 코드</p></th>
				<td class='td02'><p>" . @(in_array($resultMap["EventCode"] , $resultMap) ? $resultMap["EventCode"] : "null" ) . "</p></td></tr>";
					*/
				}

				/*
				echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>카드번호</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["CARD_Num"] , $resultMap) ? $resultMap["CARD_Num"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>할부기간</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["CARD_Quota"] , $resultMap) ? $resultMap["CARD_Quota"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>";
				*/

				if (isset($resultMap["EventCode"]) && isset($resultMap["CARD_Interest"]) && (strcmp("1", $resultMap["CARD_Interest"]) == 0 || strcmp("1", $resultMap["EventCode"]) == 0 )) {
					/*echo "<tr><th class='td01'><p>할부 유형</p></th>
						<td class='td02'><p>무이자</p></td></tr>";*/

				} else if (isset($resultMap["CARD_Interest"]) && !strcmp("1", $resultMap["CARD_Interest"]) == 0) {
					/*echo "<tr><th class='td01'><p>할부 유형</p></th>
						<td class='td02'><p>유이자 <font color='red'> *유이자로 표시되더라도 EventCode 및 EDI에 따라 무이자 처리가 될 수 있습니다.</font></p></td></tr>";*/
				}

				if (isset($resultMap["point"]) && strcmp("1", $resultMap["point"]) == 0) {
					/*echo "<td class='td02'><p></p></td></tr>
						<tr><th class='td01'><p>포인트 사용 여부</p></th>
						<td class='td02'><p>사용</p></td></tr>";*/

				} else {
					/*echo "<td class='td02'><p></p></td></tr>
						<tr><th class='td01'><p>포인트 사용 여부</p></th>
						<td class='td02'><p>미사용</p></td></tr>";*/
				}

				/*echo "<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>카드 종류</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["CARD_Code"] , $resultMap) ? $resultMap["CARD_Code"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>카드 발급사</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["CARD_BankCode"] , $resultMap) ? $resultMap["CARD_BankCode"] : "null" ) . "</p></td></tr>

					<tr><th class='td01'><p>부분취소 가능여부</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["CARD_PRTC_CODE"] , $resultMap) ? $resultMap["CARD_PRTC_CODE"] : "null" ) . "</p></td></tr>
					<tr><th class='line' colspan='2'><p></p></th></tr>
					<tr><th class='td01'><p>체크카드 여부</p></th>
					<td class='td02'><p>" . @(in_array($resultMap["CARD_CheckFlag"] , $resultMap) ? $resultMap["CARD_CheckFlag"] : "null" ) . "</p></td></tr>";*/

				if (isset($resultMap["OCB_Num"]) && !is_null($resultMap["OCB_Num"]) && !empty($resultMap["OCB_Num"])) {
					/*echo "<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>OK CASHBAG 카드번호</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["OCB_Num"] , $resultMap) ? $resultMap["OCB_Num"] : "null" ) . "</p></td></tr>
						<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>OK CASHBAG 적립 승인번호</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["OCB_SaveApplNum"] , $resultMap) ? $resultMap["OCB_SaveApplNum"] : "null" ) . "</p></td></tr>
						<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>OK CASHBAG 포인트지불금액</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["OCB_PayPrice"] , $resultMap) ? $resultMap["OCB_PayPrice"] : "null" ) . "</p></td></tr>";*/
				}

				if (isset($resultMap["GSPT_Num"]) && !is_null($resultMap["GSPT_Num"]) && !empty($resultMap["GSPT_Num"])) {
					/*echo "<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>GS&Point 카드번호</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GSPT_Num"] , $resultMap) ? $resultMap["GSPT_Num"] : "null" ) . "</p></td></tr>

						<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>GS&Point 잔여한도</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GSPT_Remains"] , $resultMap) ? $resultMap["GSPT_Remains"] : "null" ) . "</p></td></tr>

						<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>GS&Point 승인금액</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["GSPT_ApplPrice"] , $resultMap) ? $resultMap["GSPT_ApplPrice"] : "null" ) . "</p></td></tr>";*/
				}

				if (isset($resultMap["UNPT_CardNum"]) && !is_null($resultMap["UNPT_CardNum"]) && !empty($resultMap["UNPT_CardNum"])) {
					/*echo "<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>U-Point 카드번호</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["UNPT_CardNum"] , $resultMap) ? $resultMap["UNPT_CardNum"] : "null" ) . "</p></td></tr>

						<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>U-Point 가용포인트</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["UPNT_UsablePoint"] , $resultMap) ? $resultMap["UPNT_UsablePoint"] : "null" ) . "</p></td></tr>

						<tr><th class='line' colspan='2'><p></p></th></tr>
						<tr><th class='td01'><p>U-Point 포인트지불금액</p></th>
						<td class='td02'><p>" . @(in_array($resultMap["UPNT_PayPrice"] , $resultMap) ? $resultMap["UPNT_PayPrice"] : "null" ) . "</p></td></tr>";*/
				}
			}

			/*echo "</table>
				<span style='padding-left : 100px;'></span>
				<form name='frm' method='post'> 
					<input type='hidden' name='tid' value='" . @(in_array($resultMap["tid"] , $resultMap) ? $resultMap["tid"] : "null" ) . "'/>
				</form>
				</pre>";*/

			// 수신결과를 파싱후 resultCode가 "0000"이면 승인성공 이외 실패
			// 가맹점에서 스스로 파싱후 내부 DB 처리 후 화면에 결과 표시
			// payViewType을 popup으로 해서 결제를 하셨을 경우
			// 내부처리후 스크립트를 이용해 opener의 화면 전환처리를 하세요
			//throw new Exception("강제 Exception");

		} catch (Exception $e) {
			//    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
			//####################################
			// 실패시 처리(***가맹점 개발수정***)
			//####################################
			//---- db 저장 실패시 등 예외처리----//
			$s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
			//echo $s;
			echo "<script>
				alert('오류코드 : ".$s."');
				location.href = '".G5_URL."';
				</script>";
			exit;

			//#####################
			// 망취소 API
			//#####################

			$netcancelResultString = ""; // 망취소 요청 API url(고정, 임의 세팅 금지)
			if ($httpUtil->processHTTP($netCancel, $authMap)) {
				$netcancelResultString = $httpUtil->body;
			} else {
				//echo "Http Connect Error\n";
				//echo $httpUtil->errormsg;

				throw new Exception("Http Connect Error");
			}

			//echo "<br/>## 망취소 API 결과 ##<br/>";
			
			/*##XML output##*/
			//$netcancelResultString = str_replace("<", "&lt;", $$netcancelResultString);
			//$netcancelResultString = str_replace(">", "&gt;", $$netcancelResultString);

			// 취소 결과 확인
			//echo "<p>". $netcancelResultString . "</p>";
		}

	} else {

		//#############
		// 인증 실패시
		//#############
		//echo "<br/>";
		//echo "####인증실패####";

		//echo "<pre>" . var_dump($_REQUEST) . "</pre>";
		echo "<script>
			alert('인증에 실패하였습니다\\n".var_dump($_REQUEST)."');
			location.href = '".G5_URL."';
			</script>";
		exit;
	}

} catch (Exception $e) {
	$s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
	//echo $s;
	echo "<script>
		alert('오류코드 : ".$s."');
		location.href = '".G5_URL."';
		</script>";
	exit;
}

echo "<script>
	location.href = '".$location_data."';
	</script>";
?>
