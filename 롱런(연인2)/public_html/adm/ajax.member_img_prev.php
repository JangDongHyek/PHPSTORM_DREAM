<?
/**********************************
회원관리 - 회원사진 미리보기
**********************************/
include_once('./_common.php');

$imgs = getMemberImg($_GET['mb_id']);

if ($imgs) {
	if ($imgs['cnt'] == 0) {
		echo "사진없음";
	} else {
		foreach ($imgs['list'] as $key=>$val) {
			echo "<img src='{$val['src']}'>";
		}
	}
} else {
	echo "사진을 불러오는데 실패하였습니다.";
}

?>