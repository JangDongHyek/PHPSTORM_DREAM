<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);


$pointTableArr=array("point"=>"S포인트","point_l"=>"L포인트");
$sql="select * from g5_lotto where mb_id='$member[mb_id]' and rank < 6";
$result=sql_query($sql);
?>
<!--상단 탭부분-->
<div id="cha_tab">
    <ul>
        <li><a href="<?=G5_BBS_URL?>/mywallet.php">충전내역</a></li>
        <li><a href="<?=G5_BBS_URL?>/myrecommend.php">추천인목록</a></li>
        <li><a href="<?=G5_BBS_URL?>/myrecommend.point.php">포인트내역</a></li>
        <li class="selected"><a href="<?=G5_BBS_URL?>/mylotto.php">복권당첨내역</a></li>
    </ul>
</div><!--#cha_tab-->

<div class="container">	
	<table class="table_m" id="recommend-list">
		<thead>
			<tr>
				<th colspan="4" class="my_st"><?=$pointTableArr[$table]?> 내역</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>순번</td>
				<td>로또번호</td>
				<td>주차</td>
				<td>등수</td>
			</tr>
			<?
				$i=0;
				while($row=sql_fetch_array($result)){
			?>
			<tr>
				<td><?=$i+1?></td>
				<td><?=$row[lotto_num]?></td>
				<td><?=str_replace("/","년",$row[turn])?>회차</td>
				<td><?=$row[rank]?></td>
			</tr>
			<? $i++;}?>
		</tbody>

	</table>
</div>

