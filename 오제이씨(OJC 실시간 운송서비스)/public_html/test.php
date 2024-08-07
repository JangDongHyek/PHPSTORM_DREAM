<?php
include_once('./common.php');

$params = array(
	'mbName' => '최성빈',
	'month' => '09',
	'day' => '04',
	'mainPct' => 'KCC 18S ECO 중방식환경(ALCO) OP (030T)외 1건',
	'startTime' => '20',
	'endTime' => '22'
);

echo '<pre>';
var_dump(sendAlimTalk(0, $params, '01042529806', $dispatch_idx));
echo '</pre>';
?>    