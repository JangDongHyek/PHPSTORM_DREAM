<?php
include_once("../../connect.php");
/*************************************************************************/
/* payapp                                                                */
/* copyright ⓒ 2012 UDID. all right reserved.                           */
/*                                                                       */
/* oapi sample                                                           */
/* - version 004-001                                                     */
/* - payapp 서버로 결제요청 정보를 전달합니다.                           */
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

	$postdata['cmd']	= 'payrequest';// payrequest 고정, 필수
	if( !$postdata['userid'] ){
		return Array('state'=>'0','errorMessage'=>'userid 값을 확인하세요.','errno'=>'70010');
	}
	if( !$postdata['goodname'] ){
		return Array('state'=>'0','errorMessage'=>'goodname 값을 확인하세요.','errno'=>'70020');
	}
	if( !$postdata['price'] ){
		return Array('state'=>'0','errorMessage'=>'price 값을 확인하세요.','errno'=>'70020');
	}
	/*if( $postdata['price']<1000 ){
		return Array('state'=>'0','errorMessage'=>'결제요청금액은 1,000원 이상 가능합니다.','errno'=>'70020');
	}*/
	if( !$postdata['recvphone'] ){
		return Array('state'=>'0','errorMessage'=>'recvphone 값을 확인하세요.','errno'=>'70020');
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
TODO : 이곳에서 결제요청전 정보를 저장합니다.

ex) INSERT INTO payrequest (orderno,memberid,goodcode,goodname,goodprice) VALUES ('1234567890','kim','abcdefg','테스트상품',1000)
*/

// 아래 정보를 payapp 판매자의 정보로 입력하세요.
// 판매자 사이트에 있는 연동KEY, 연동VALUE는 일반 사용자에게 노출이 되지 않도록 주의 하시기 바랍니다.
$payapp_userid	= 'buseong';	// payapp 판매자 아이디

$goodname_sql = "select * from order_pro where mart_id='$mart_id' and order_num='$order_num'";
$goodname_qry = mysql_query($goodname_sql,$dbconn);
$goodname_num = mysql_num_rows($goodname_qry);
if($goodname_num > 1){
	$goodname_row = mysql_fetch_array($goodname_qry);
	$goodname_numb = $goodname_num - 1;
	$goodname = $goodname_row[item_name]." 외 ".$goodname_num."개";
}else if($goodname_num > 0){
	$goodname_row = mysql_fetch_array($goodname_qry);
	$goodname = $goodname_row[item_name];
}

$recvphone = str_replace("-","",$recvphone);

// euc-kr 인코딩을 utf-8로 바꿈
$recvphone = iconv("euckr", "utf8", $recvphone);
$goodname = iconv("euckr", "utf8", $goodname);
$price = iconv("euckr", "utf8", $mon_tot_freight);

$home_dir = getenv("HTTP_HOST");
if($home_dir == "www.smartbusan.co.kr"){
	$home_dir .= "/~".$mart_id;
}

$feedbackurl = "http://www.doubleshopping.co.kr/market/cart/payapp_response.php";
$returnurl = "http://www.doubleshopping.co.kr/market/cart/order_ok_new_payapp.php?order_num=$order_num";

$postdata = array(
	'cmd'				=> 'payrequest',
	'userid'		=> $payapp_userid,			// 판매자 아이디, 필수

	// 아래 값을 고객사에 맞게 바꾸셔야 합니다.
	'goodname'		=> $goodname,			// 상품명, 필수
	'price'			=> $price,					// 결제요청 금액 (1,000원 이상), 필수
	'recvphone'		=> $recvphone,						// 수신자 휴대폰번호 (구매자), 필수
	'memo'			=> '결제신청',		// 결제요청시 메모
	'reqaddr'		=> '0',						// 주소요청 여부
	'feedbackurl'	=> $feedbackurl,						// 피드백 URL, feedbackurl은 외부에서 접근이 가능해야 합니다. payapp 서버에서 호출 하는 페이지 입니다.
	'var1'			=> $order_num,			// 임의변수1
	'var2'			=> '',				// 임의변수2
												// 임의변수는 고객사의 주문번호,상품코드 등 필요에 따라 자유롭게 이용이 가능합니다.
	'smsuse'		=> 'n',						// 결제요청 SMS 발송여부 ('n'인 경우 SMS 발송 안함)
	'currency'		=> 'krw',					// 통화기호 (krw:원화결제, usd:US달러 결제)
	'vccode'		=> '',						// 국제전화 국가번호 (currency가 usd일 경우 필수)
	'returnurl'		=> $returnurl	// 결제완료 이동 URL (결제완료 후 매출전표 페이지에서 "확인" 버튼 클릭시 이동)
);

$oResData = payapp_oapi_post($postdata);
if( $oResData['state']=='1' ){
	// 결제요청성공
	// 결제요청번호($oResData['mul_no'])를 고객사 DB에 저장해 놓으셔야 합니다.
	// 요청이 성공한 것으로 결제완료 상태가 아닙니다. 여기에서 상품배송/서비스 제공을 하면 안됩니다.
	// 결제완료는 feedbackurl에서만 확인이 가능합니다.
	
	$oResData['mul_no'];	// 결제요청번호
	$oResData['payurl'];	// 결제창 URL

	$sql = "update order_buy_temp set mul_no='{$oResData['mul_no']}' where mart_id='{$mart_id}' and order_num='{$order_num}'";
	mysql_query($sql,$dbconn);
?>
	<meta http-equiv='refresh' content='0;url=<?=$oResData['payurl']?>'>
<?
	/*
	TODO : 이곳에서 결제요청후 정보를 저장합니다.

	ex) UPDATE payrequest SET mul_no='{$oResData['mul_no']}' WHERE orderno='1234567890'
	*/
}else{
	// 결제요청실패
	// 오류메시지($oResData['errorMessage'])를 확인하고, 오류를 수정하셔야 합니다.
	
	 $oResData['errorMessage'];	// 오류메시지
	 $oResData['errno'];			// 오류코드
	/*
	TODO : 이곳에서 결제요청 실패 정보를 저장하거나, 이전 페이지로 이동해서 다시 시도할 수 있도록 해야 합니다.

	ex) UPDATE payrequest SET errorMessage='{$oResData['errorMessage']}' WHERE orderno='1234567890'
	*/

	echo "
	<script>
	alert('결제에 실패했습니다.');
	window.close();
	</script>
	";
}


?>
<div align="center">결제가 진행중입니다. 잠시만 기다려주십시오.</div>
