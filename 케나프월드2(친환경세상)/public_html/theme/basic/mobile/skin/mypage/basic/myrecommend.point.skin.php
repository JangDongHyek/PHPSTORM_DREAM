<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);

$pointTableArr=array("point"=>"응모권 주식","point_l"=>"L포인트","point_m"=>"동영상충전포인트");
$sql="select * from g5_{$table} where mb_id='$member[mb_id]' order by po_id desc";
$result=sql_query($sql);
?>
<!--상단 탭부분-->
<div id="cha_tab">
    <ul>
        <li><a href="<?=G5_BBS_URL?>/mywallet.php">충전내역</a></li>
        <li><a href="<?=G5_BBS_URL?>/myrecommend.php">추천인목록</a></li>
        <li class="selected"><a href="<?=G5_BBS_URL?>/myrecommend.point.php">포인트내역</a></li>
        <li><a href="<?=G5_BBS_URL?>/mylotto.php">복권당첨내역</a></li>
    </ul>
</div><!--#cha_tab-->

<div class="container">
    <?php /*?><table class="table">
		<tbody>
			<tr>
				<td><a href="?table=point">S포인트</a></td>
				<td><a href="?table=point_l">L포인트</a></td>
				<td><a href="?table=point_m">동영상충전포인트</a></td>
			</tr>
		</tbody>
	</table><?php */?>
    
    <div id="point_tab">
        <ul>
            <li class="<?php echo $table=="point"||!$table?"on":"";?>"><a href="?table=point">응모권 주식</a></li>
            <li class="<?php echo $table=="point_l"?"on":"";?>"><a href="?table=point_l">L포인트</a></li>
			<li class="<?php echo $table=="point_m"?"on":"";?>"><a href="?table=point_m">동영상충전포인트</a></li>
			<li><a href="<?=G5_BBS_URL?>/mymovie_point.php">동영상시청포인트</a></li>
        </ul>
    </div><!--#point_tab-->
    
    
	<table class="table_m" id="recommend-list">
		<thead>
			<tr>
				<th colspan="4" class="my_st"><?=$pointTableArr[$table]?> 내역</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>번호</td>
				<td>포인트</td>
				<td>포인트내역</td>
				<td>날짜</td>
			</tr>
			<?
				$i=0;
				while($row=sql_fetch_array($result)){
			?>
			<tr>
				<td><?=$i+1?></td>
				<td><?=$row[po_point]?></td>
				<td><?=$row[po_content]?></td>
				<td><?=$row[po_datetime]?></td>
			</tr>
			<? $i++;}?>
		</tbody>

	</table>
</div>
