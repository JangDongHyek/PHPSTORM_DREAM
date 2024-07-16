<?
include_once('./_common.php');

$si = trim($_GET['si']);
$gu = trim($_GET['gu']);

$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL,"http://letsit.kr/~itforone_test2/api/get_map.php?si=".$si."&gu=".$gu); //접속할 URL 주소
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
curl_setopt ($ch, CURLOPT_SSLVERSION,3); // SSL 버젼 (https 접속시에 필요)
curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt ($ch, CURLOPT_TIMEOUT, 10); // TimeOut 값
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
$result = curl_exec ($ch);

if(curl_errno($ch)) var_dump(curl_error($ch));

curl_close ($ch);

echo iconv("UTF-8", "EUC-KR", $result);

?>