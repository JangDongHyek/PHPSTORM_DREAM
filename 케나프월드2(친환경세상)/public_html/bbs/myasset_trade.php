<?php
include_once('./_common.php');

if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}

$is_asset = "asset";
$g5['title'] = '에셋';

include_once($mypage_skin_path.'/myasset_trade.skin.php');
?>
