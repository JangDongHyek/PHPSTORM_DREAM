<?php
/************************************************
인트로 대리점명 검색결과
************************************************/
include_once('./_common.php');

$sql = "SELECT mb_no, mb_nick, mb_id FROM g5_member 
		WHERE mb_level = 9 AND mb_use = 'Y' AND mb_nick LIKE '%{$stx}%'
		ORDER BY mb_nick ASC;";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

?>
<ul>
<? if ((int)$result_cnt == 0) { ?>
<li>대리점 검색 결과가 없습니다.</li>
<?
} else { 
	while($row = sql_fetch_array($result)) {
?>
<li onclick="setAgency('<?=$row['mb_no']?>', this);" <? if ($agency_no == $row['mb_no']) echo "class='active'"; ?>><?=$row['mb_nick']?></li>
<? 
	}
} // end if ?>
</ul>