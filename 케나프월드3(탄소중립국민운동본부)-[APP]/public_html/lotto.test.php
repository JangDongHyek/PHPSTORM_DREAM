<?
		$curlObj = curl_init();
    curl_setopt($curlObj, CURLOPT_URL, "https://www.nlotto.co.kr/common.do?method=getLottoNumber&drwNo=1");
    curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curlObj, CURLOPT_HEADER, 0);
    curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
    $response = curl_exec($curlObj);
		echo $response;
?>