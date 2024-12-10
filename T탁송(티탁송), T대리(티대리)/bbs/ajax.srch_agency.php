<?php
/************************************************
인트로 대리점명 검색결과
************************************************/
include_once('./_common.php');

// 36:티대리, 243:티탁송
$sql = "SELECT mb_no, mb_nick, mb_id FROM g5_member 
		WHERE mb_level = 9 AND mb_use = 'Y' AND mb_nick LIKE '%{$stx}%' OR mb_no IN (341,2203,36, 243)
		ORDER BY (CASE mb_no WHEN 341 THEN 1 WHEN 2203 THEN 2 WHEN 36 THEN 3 WHEN 243 THEN 4 ELSE 5 END) ASC, mb_nick ASC;";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

?>
<ul>
<? if ((int)$result_cnt == 0) { ?>
<li>대리점 검색 결과가 없습니다.</li>
<?
} else { 
	while($row = sql_fetch_array($result)) {
        $bold = ($row['mb_no']==36 || $row['mb_no']==243 || $row['mb_no']==341 || $row['mb_no']==2203)? "bold" : "";
?>
<li onclick="setAgency('<?=$row['mb_no']?>', this);" <? if ($agency_no == $row['mb_no']) echo "class='active'"; ?> style="font-weight: <?=$bold?>">
    <?=$row['mb_nick']?>
</li>
<? 
	}
} // end if ?>
</ul>