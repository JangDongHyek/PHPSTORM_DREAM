<?
$referer = $HTTP_REFERER;
if ($referer != str_replace($HTTP_HOST , "" , $referer)) {exit;}
@header ("location: http://renemall.co.kr/admin/log/nalogd.php?counter=daylife&url=$referer");
exit;
?>