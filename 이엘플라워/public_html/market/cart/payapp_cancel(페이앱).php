<?php
include_once("../../connect.php");
/*************************************************************************/
/* payapp                                                                */
/* copyright �� 2012 UDID. all right reserved.                           */
/*                                                                       */
/* oapi sample                                                           */
/* - version 004-001                                                     */
/* - payapp ������ ������û��� ������ �����մϴ�.                           */
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

	$postdata['cmd']	= 'paycancel';// paycancel ����, �ʼ�
	if( !$postdata['userid'] || !$postdata['linkkey'] ){
		return Array('state'=>'0','errorMessage'=>'userid �Ǵ� linkkey ���� Ȯ���ϼ���.','errno'=>'70010');
	}
	if( !$postdata['mul_no'] ){
		return Array('state'=>'0','errorMessage'=>'mul_no ���� Ȯ���ϼ���.','errno'=>'70020');
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
TODO : �̰����� ������û ������ �ҷ��ɴϴ�.

ex) SELECT mul_no FROM payrequest WHERE orderno='1234567890'
*/

// �Ʒ� ������ payapp �Ǹ����� ������ �Է��ϼ���.
// �Ǹ��� ����Ʈ�� �ִ� ����KEY, ����VALUE�� �Ϲ� ����ڿ��� ������ ���� �ʵ��� ���� �Ͻñ� �ٶ��ϴ�.
$payapp_userid	= 'shop_mobile';	// payapp �Ǹ��� ���̵�
$payapp_linkkey	= 'NaJ3JpjQ8XpSsaaaaaBF0e1DPJnaaaaaOgT+oqg6zaM=';			// payapp ����key, �Ǹ��� ����Ʈ �α��� �� ���� �޴����� Ȯ�� ����

$postdata = array(
	'userid'		=> $payapp_userid,			// �Ǹ��� ���̵�, �ʼ�
	'linkkey'		=> $payapp_linkkey,			// ����KEY��, �ʼ� (�Ǹ��� ����Ʈ �α��� �� ���� �޴����� Ȯ�� ����)

	// �Ʒ� ���� ���翡 �°� �ٲټž� �մϴ�.
	'mul_no'		=> $mul_no,					// ������û��ȣ, �ʼ�
	'cancelmemo'	=> 'ī��������',			// ������û��� �޸�
	'cancelmode'	=> '',						// ������û��� ���
												// ready �� ��� ������û ����(������ �ȵȻ���)�� ��� ���� ��Ұ� �˴ϴ�.
);

$oResData = payapp_oapi_post($postdata);
if( $oResData['state']=='1' ){
	// ������û��Ҽ���
	// ������û��Ҵ� ��� ����˴ϴ�.
	// ������û�� feedbackurl�� ����ϸ� ������û��� ������ feedbackurl�� ��� ������ ���޵˴ϴ�.
	// feedbackurl �� ����ϸ鼭 �̰����� ������û��Ҹ� ó���ϸ� ������û��� ó���� �ߺ��� �� ������ �����Ͻñ� �ٶ��ϴ�.

	/*
	TODO : �̰����� ������û����� ������ �����մϴ�. �Ǵ� feedbackurl ���� ó���Ͻñ� �ٶ��ϴ�.

	ex) UPDATE payrequest SET cancel='y',cancel_date=NOW() WHERE orderno='1234567890'
	*/

	$sql = "update order_buy set card_paid='f', status='10', field5='ī��������' where mart_id='$mart_id' and order_num='$order_num'";
	mysql_query($sql,$dbconn);
	
	echo "
	<script>
	alert('������Ұ� �Ϸ�Ǿ����ϴ�.');
	location.href = '../stat/order.html';
	</script>
	";

}else{
	// ������û����
	// �����޽���($oResData['errorMessage'])�� Ȯ���ϰ�, ������ �����ϼž� �մϴ�.
	/*
	$oResData['errorMessage'];	// �����޽���
	$oResData['errno'];			// �����ڵ�
	*/

	/*
	TODO : �̰����� ������û��� ���� ������ �����ϰų�, ���� �������� �̵��ؼ� �ٽ� �õ��� �� �ֵ��� �ؾ� �մϴ�.

	ex) UPDATE payrequest SET errorMessage='{$oResData['errorMessage']}' WHERE orderno='1234567890'
	*/

	echo "
	<script>
	alert('������ҿ� �����Ͽ����ϴ�.');
	history.go(-1);
	</script>
	";
}


?>