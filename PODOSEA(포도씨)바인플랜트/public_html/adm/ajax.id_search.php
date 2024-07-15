<?php
include_once('./_common.php');

/**
 * 관리자페이지-회원관리-포인트관리 포인트 적립/차감 아이디 찾기 (ajax)
 * 관리자페이지-기업의뢰-의뢰전달 아이디/회사명 찾기 (ajax)
 * 관리자페이지-벙커관리-벙커 적립/차감 아이디 찾기 (ajax)
 */

$company = false;
if($mode == 'company') { // 기업의뢰
    $company = true;
    $sql = " select * from g5_member where mb_id != '{$mb_id}' and (mb_id like '%{$id}%' or mb_company_name like '%{$id}%' or mb_company_name_eng like '%{$id}%') and mb_level = 3 order by mb_no desc limit 10 ";
} else { // 포인트관리
    $sql = " select * from g5_member where mb_id like '%{$id}%' order by mb_no desc limit 10 ";
}
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);
?>
<table>
<thead>
<tr>
	<th>아이디</th>
    <?php if($company) { ?>
    <th>회사명</th>
    <?php } ?>
    <?php if($mode == 'bunker') { ?>
    <th>일반벙커</th>
    <th>보너스벙커</th>
    <?php } ?>
	<th>선택</th>
</tr>
</thead>
<tbody>
<? if ((int)$result_cnt == 0) { ?>
<tr><td colspan="3">검색결과가 없습니다.</td></tr>
<? 
} else {
	for($i=0; $row = sql_fetch_array($result); $i++) {
?>
<tr>
	<td><?=$row['mb_id']?></td>
    <?php if($company) { ?>
    <td><?=$row['mb_company_name']?></td>
    <?php } ?>
    <?php if($mode == 'bunker') { ?>
    <td><?=number_format($row['mb_bunker'])?></td>
    <td><?=number_format($row['mb_bunker_bonus'])?></td>
    <?php } ?>
	<td><button type="button" class="btn_frmline btn_pass" onclick="select_id('<?=$row['mb_id']?>');"><?=$company ? '의뢰전달' : '선택'?></button></td>
</tr>
<?
	}
} 
?>
</tbody>
</table>