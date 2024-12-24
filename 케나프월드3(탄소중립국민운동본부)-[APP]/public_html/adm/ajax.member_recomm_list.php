<?php
$sub_menu = "200100";
include_once('./_common.php');

$sql = "SELECT * FROM g5_member WHERE mb_recommend = '{$_GET['mb_id']}' ORDER BY mb_no DESC";
$result = sql_query($sql);

// 선택한 회원이 가입시 추천한 회원 (상위회원)
// - 뒤로가기시 사용
$sql = "SELECT mb_recommend FROM g5_member WHERE mb_id = '{$_GET['mb_id']}'";
$row = sql_fetch($sql);
$mb_recommend = $row["mb_recommend"];



?>
<link rel="stylesheet" href="http://www.wecashgold.co.kr/adm/css/admin.css?v=1">

<div id="r_list">
	<h2>추천회원목록<span><?=$_GET['mb_id']?></span></h2>
	<div class="tbl_head02 tbl_wrap">
		<table>
		<thead>
		<tr>
			<th scope="col">No.</th>
			<th scope="col">고유아이디</th>
			<th scope="col">추천회원목록</th>
			<th scope="col">이름</th>
			<th scope="col">닉네임</th>
			<th scope="col">가입일</th>
		</tr>
		</thead>
		<tbody>
		<? 
		if ($_GET['mb_id']) { 
			for ($i = 0; $row = sql_fetch_array($result); $i++) { 
				// 나를 추천한 회원
				$sql = " SELECT COUNT(*) AS cnt FROM g5_member WHERE mb_recommend = '{$row['mb_id']}' ";
				$r_row = sql_fetch($sql);
				$recommCnt = $r_row["cnt"];

				$recomm_str = $recommCnt;

				if ($recommCnt > 0) {
					$recomm_str = "<a href='javascript:void(0)' class='link' onclick='parent.getRecommList(\"{$row['mb_id']}\");'>{$recommCnt}</a>";
				}
		?>
		<tr>
			<td><?=$i+1?></td>
			<td><?=$row['mb_id']?></td>
			<td><?=$recomm_str?></td>
			<td><?=$row['mb_name']?></td>
			<td><?=$row['mb_nick']?></td>
			<td><?=substr($row['mb_datetime'], 0, 10)?></td>
		</tr>
		<?	
			} 
		}	// end if 
		?>
		</tbody>
		</table>
	</div>
</div>

<a class="close_window back" id="btn_back" onclick="parent.fnFrameBack('<?=$mb_recommend?>');">뒤로 <i class="fa fa-chevron-left"></i></a>