<?php
include_once("../../connect.php");
/*************************************************************************/
/* payapp                                                                */
/* copyright �� 2012 UDID. all right reserved.                           */
/*                                                                       */
/* oapi sample                                                           */
/* - version 004-001                                                     */
/* - payapp ������ ������û ������ �����մϴ�.                           */
/*                                                                       */
/*************************************************************************/

// payapp ���� ������
define('PAYAPP_API_DOMAIN',	'api.payapp.kr');
// payapp ���� URL
define('PAYAPP_API_URL',	'/oapi/apiLoad.html');

// payapp ������ ���ؼ���
// api.payapp.kr�� 80port ������ �����ؾ� �մϴ�.
// �������� api.payapp.kr:80 ������ �����ϵ��� ��ȭ�� ���� �����Ͻñ� �ٶ��ϴ�.
function payapp_oapi_post($postdata = array())
{
	// ���������� php extension curl, �Ǵ� fsockopen���� api.payapp.kr:80�� ������ �մϴ�.
	// curl, fsockopen ���� �ϳ��� �̿��� �����ؾ� �մϴ�.
	$enable_curl	= function_exists('curl_exec');
	$enable_socket	= function_exists('fsockopen');

	$CRLF = "\r\n";
	$request_data	= '';
	$response_data	= '';
	$postdata_str	= '';
	$parse_data		= Array();

	$postdata['cmd']	= 'payrequest';// payrequest ����, �ʼ�
	if( !$postdata['userid'] ){
		return Array('state'=>'0','errorMessage'=>'userid ���� Ȯ���ϼ���.','errno'=>'70010');
	}
	if( !$postdata['goodname'] ){
		return Array('state'=>'0','errorMessage'=>'goodname ���� Ȯ���ϼ���.','errno'=>'70020');
	}
	if( !$postdata['price'] ){
		return Array('state'=>'0','errorMessage'=>'price ���� Ȯ���ϼ���.','errno'=>'70020');
	}
	/*if( $postdata['price']<1000 ){
		return Array('state'=>'0','errorMessage'=>'������û�ݾ��� 1,000�� �̻� �����մϴ�.','errno'=>'70020');
	}*/
	if( !$postdata['recvphone'] ){
		return Array('state'=>'0','errorMessage'=>'recvphone ���� Ȯ���ϼ���.','errno'=>'70020');
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
TODO : �̰����� ������û�� ������ �����մϴ�.

ex) INSERT INTO payrequest (orderno,memberid,goodcode,goodname,goodprice) VALUES ('1234567890','kim','abcdefg','�׽�Ʈ��ǰ',1000)
*/

// �Ʒ� ������ payapp �Ǹ����� ������ �Է��ϼ���.
// �Ǹ��� ����Ʈ�� �ִ� ����KEY, ����VALUE�� �Ϲ� ����ڿ��� ������ ���� �ʵ��� ���� �Ͻñ� �ٶ��ϴ�.
$payapp_userid	= 'buseong';	// payapp �Ǹ��� ���̵�

$goodname_sql = "select * from order_pro where mart_id='$mart_id' and order_num='$order_num'";
$goodname_qry = mysql_query($goodname_sql,$dbconn);
$goodname_num = mysql_num_rows($goodname_qry);
if($goodname_num > 1){
	$goodname_row = mysql_fetch_array($goodname_qry);
	$goodname_numb = $goodname_num - 1;
	$goodname = $goodname_row[item_name]." �� ".$goodname_num."��";
}else if($goodname_num > 0){
	$goodname_row = mysql_fetch_array($goodname_qry);
	$goodname = $goodname_row[item_name];
}

$recvphone = str_replace("-","",$recvphone);

// euc-kr ���ڵ��� utf-8�� �ٲ�
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
	'userid'		=> $payapp_userid,			// �Ǹ��� ���̵�, �ʼ�

	// �Ʒ� ���� ���翡 �°� �ٲټž� �մϴ�.
	'goodname'		=> $goodname,			// ��ǰ��, �ʼ�
	'price'			=> $price,					// ������û �ݾ� (1,000�� �̻�), �ʼ�
	'recvphone'		=> $recvphone,						// ������ �޴�����ȣ (������), �ʼ�
	'memo'			=> '������û',		// ������û�� �޸�
	'reqaddr'		=> '0',						// �ּҿ�û ����
	'feedbackurl'	=> $feedbackurl,						// �ǵ�� URL, feedbackurl�� �ܺο��� ������ �����ؾ� �մϴ�. payapp �������� ȣ�� �ϴ� ������ �Դϴ�.
	'var1'			=> $order_num,			// ���Ǻ���1
	'var2'			=> '',				// ���Ǻ���2
												// ���Ǻ����� ������ �ֹ���ȣ,��ǰ�ڵ� �� �ʿ信 ���� �����Ӱ� �̿��� �����մϴ�.
	'smsuse'		=> 'n',						// ������û SMS �߼ۿ��� ('n'�� ��� SMS �߼� ����)
	'currency'		=> 'krw',					// ��ȭ��ȣ (krw:��ȭ����, usd:US�޷� ����)
	'vccode'		=> '',						// ������ȭ ������ȣ (currency�� usd�� ��� �ʼ�)
	'returnurl'		=> $returnurl	// �����Ϸ� �̵� URL (�����Ϸ� �� ������ǥ ���������� "Ȯ��" ��ư Ŭ���� �̵�)
);

$oResData = payapp_oapi_post($postdata);
if( $oResData['state']=='1' ){
	// ������û����
	// ������û��ȣ($oResData['mul_no'])�� ���� DB�� ������ �����ž� �մϴ�.
	// ��û�� ������ ������ �����Ϸ� ���°� �ƴմϴ�. ���⿡�� ��ǰ���/���� ������ �ϸ� �ȵ˴ϴ�.
	// �����Ϸ�� feedbackurl������ Ȯ���� �����մϴ�.
	
	$oResData['mul_no'];	// ������û��ȣ
	$oResData['payurl'];	// ����â URL

	$sql = "update order_buy_temp set mul_no='{$oResData['mul_no']}' where mart_id='{$mart_id}' and order_num='{$order_num}'";
	mysql_query($sql,$dbconn);
?>
	<meta http-equiv='refresh' content='0;url=<?=$oResData['payurl']?>'>
<?
	/*
	TODO : �̰����� ������û�� ������ �����մϴ�.

	ex) UPDATE payrequest SET mul_no='{$oResData['mul_no']}' WHERE orderno='1234567890'
	*/
}else{
	// ������û����
	// �����޽���($oResData['errorMessage'])�� Ȯ���ϰ�, ������ �����ϼž� �մϴ�.
	
	 $oResData['errorMessage'];	// �����޽���
	 $oResData['errno'];			// �����ڵ�
	/*
	TODO : �̰����� ������û ���� ������ �����ϰų�, ���� �������� �̵��ؼ� �ٽ� �õ��� �� �ֵ��� �ؾ� �մϴ�.

	ex) UPDATE payrequest SET errorMessage='{$oResData['errorMessage']}' WHERE orderno='1234567890'
	*/

	echo "
	<script>
	alert('������ �����߽��ϴ�.');
	window.close();
	</script>
	";
}


?>
<div align="center">������ �������Դϴ�. ��ø� ��ٷ��ֽʽÿ�.</div>
