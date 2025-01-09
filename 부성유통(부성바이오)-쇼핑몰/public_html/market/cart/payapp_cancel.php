<?php
include_once("../../connect.php");
/*************************************************************************/
/* payapp                                                                */
/* copyright ⓒ 2012 UDID. all right reserved.                           */
/*                                                                       */
/* oapi sample                                                           */
/* - version 004-001                                                     */
/* - payapp 서버로 결제요청취소 정보를 전달합니다.                           */
/*                                                                       */
/*************************************************************************/

// payapp 연동 도메인
define('PAYAPP_API_DOMAIN',	'api.payapp.kr');
// payapp 연동 URL
define('PAYAPP_API_URL',	'/oapi/apiLoad.html');

// payapp 연동을 위해서는
// api.payapp.kr로 80port 접속이 가능해야 합니다.
// 서버에서 api.payapp.kr:80 접속이 가능하도록 방화벽 룰을 조정하시기 바랍니다.
function payapp_oapi_post($postdata = array())
{
	// 예제에서는 php extension curl, 또는 fsockopen으로 api.payapp.kr:80에 접속을 합니다.
	// curl, fsockopen 둘중 하나는 이용이 가능해야 합니다.
	$enable_curl	= function_exists('curl_exec');
	$enable_socket	= function_exists('fsockopen');

	$CRLF = "\r\n";
	$request_data	= '';
	$response_data	= '';
	$postdata_str	= '';
	$parse_data		= Array();

	$postdata['cmd']	= 'paycancel';// paycancel 고정, 필수
	if( !$postdata['userid'] || !$postdata['linkkey'] ){
		return Array('state'=>'0','errorMessage'=>'userid 또는 linkkey 값을 확인하세요.','errno'=>'70010');
	}
	if( !$postdata['mul_no'] ){
		return Array('state'=>'0','errorMessage'=>'mul_no 값을 확인하세요.','errno'=>'70020');
	}

	foreach ($postdata as $k => $v){
		$postdata_str .= $postdata_str!='' ? '&': '';
		$postdata_str .= urlencode($k) .'='. urlencode($v);
	}
	if( $enable_curl === true ){
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, 'http://'.PAYAPP_API_DOMAIN.PAYAPP_API_URL );
		curl_setopt( $ch, CURLOPT_HEADER, 1 );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $postdata_str );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$response_data = curl_exec($ch);
		$errno = curl_errno($ch);
		$errstr = curl_error($ch);

		if( $errno ){
			return Array('state'=>'0','errorMessage'=>'('.$errno.') '.$errstr,'errno'=>'99999');
		}
		$response_data_row	= explode($CRLF.$CRLF,$response_data);
		parse_str($response_data_row[1], $parse_data);
	}elseif( $enable_socket === true ){
		$request_data .= 'POST '.PAYAPP_API_URL.' HTTP/1.1' . $CRLF;
		$request_data .= 'Host: '.PAYAPP_API_DOMAIN. $CRLF;
		$request_data .= 'Accept: text/html,application/xhtml+xml,*/*' . $CRLF;
		$request_data .= 'Accept-Language: ko-KR' . $CRLF;

		if( $postdata_str )
		{
			$request_data .= 'Content-Type: application/x-www-form-urlencoded' . $CRLF;
			$request_data .= 'Content-Length: '. strlen($postdata_str) . $CRLF . $CRLF;
			$request_data .= $postdata_str;
		}
		else $request_data .= $CRLF;

		if( ($fp = fsockopen(PAYAPP_API_DOMAIN, 80, $errno, $errstr, 10)) == false )
		{
			return Array('state'=>'0','errorMessage'=>'('.$errno.') '.$errstr,'errno'=>'99999');
		}
		stream_set_timeout($fp, 30);
		fwrite($fp, $request_data);
		while ($line = fread($fp, 2000)) $response_data .= $line;
		$info = stream_get_meta_data($fp);
		fclose($fp);

		if( $info['time_out'] ){
			return Array('state'=>'0','errorMessage'=>'connection time out','errno'=>'99999');
		}

		$response_data_row	= explode($CRLF.$CRLF,$response_data);
		parse_str($response_data_row[1], $parse_data);
	}else{
		return Array('state'=>'0','errorMessage'=>'function not exists','errno'=>'99999');
	}
	return $parse_data;
}


/*
TODO : 이곳에서 결제요청 정보를 불러옵니다.

ex) SELECT mul_no FROM payrequest WHERE orderno='1234567890'
*/

// 아래 정보를 payapp 판매자의 정보로 입력하세요.
// 판매자 사이트에 있는 연동KEY, 연동VALUE는 일반 사용자에게 노출이 되지 않도록 주의 하시기 바랍니다.
$payapp_userid	= 'shop_mobile';	// payapp 판매자 아이디
$payapp_linkkey	= 'NaJ3JpjQ8XpSsaaaaaBF0e1DPJnaaaaaOgT+oqg6zaM=';			// payapp 연동key, 판매자 사이트 로그인 후 설정 메뉴에서 확인 가능

$postdata = array(
	'userid'		=> $payapp_userid,			// 판매자 아이디, 필수
	'linkkey'		=> $payapp_linkkey,			// 연동KEY값, 필수 (판매자 사이트 로그인 후 설정 메뉴에서 확인 가능)

	// 아래 값을 고객사에 맞게 바꾸셔야 합니다.
	'mul_no'		=> $mul_no,					// 결제요청번호, 필수
	'cancelmemo'	=> '카드결제취소',			// 결제요청취소 메모
	'cancelmode'	=> '',						// 결제요청취소 모드
												// ready 인 경우 결제요청 상태(결제가 안된상태)인 경우 에만 취소가 됩니다.
);

$oResData = payapp_oapi_post($postdata);
if( $oResData['state']=='1' ){
	// 결제요청취소성공
	// 결제요청취소는 즉시 실행됩니다.
	// 결제요청시 feedbackurl을 사용하면 결제요청취소 성공시 feedbackurl로 취소 정보가 전달됩니다.
	// feedbackurl 을 사용하면서 이곳에서 결제요청취소를 처리하면 결제요청취소 처리가 중복될 수 있으니 주의하시기 바랍니다.

	/*
	TODO : 이곳에서 결제요청취소후 정보를 저장합니다. 또는 feedbackurl 에서 처리하시기 바랍니다.

	ex) UPDATE payrequest SET cancel='y',cancel_date=NOW() WHERE orderno='1234567890'
	*/

	$sql = "update order_buy set card_paid='f', status='10', field5='카드결제취소' where mart_id='$mart_id' and order_num='$order_num'";
	mysql_query($sql,$dbconn);
	
	echo "
	<script>
	alert('결제취소가 완료되었습니다.');
	location.href = '../stat/order.html';
	</script>
	";

}else{
	// 결제요청실패
	// 오류메시지($oResData['errorMessage'])를 확인하고, 오류를 수정하셔야 합니다.
	/*
	$oResData['errorMessage'];	// 오류메시지
	$oResData['errno'];			// 오류코드
	*/

	/*
	TODO : 이곳에서 결제요청취소 실패 정보를 저장하거나, 이전 페이지로 이동해서 다시 시도할 수 있도록 해야 합니다.

	ex) UPDATE payrequest SET errorMessage='{$oResData['errorMessage']}' WHERE orderno='1234567890'
	*/

	echo "
	<script>
	alert('결제취소에 실패하였습니다.');
	history.go(-1);
	</script>
	";
}


?>