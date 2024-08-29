<?
$referer = $HTTP_REFERER;
if ($referer != str_replace($HTTP_HOST , "" , $referer)) {exit;}
@header ("location: http://songjuk.kr/admin/log/nalogd.php?counter=daylife&url=$referer");
exit;
?>