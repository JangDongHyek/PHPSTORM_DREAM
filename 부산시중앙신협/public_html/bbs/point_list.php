<? 
include_once("./_common.php");

$g5['title'] = '포인트 현황';
$pid = "point_list";
include_once('./_head.php');

$sql = "select * from `g5_point` where `mb_id` = '$member[mb_id]' order by `po_datetime` desc";
$re = sql_query($sql);

?>
<link rel="stylesheet" href="<?=G5_BBS_URL?>/style.css?v=<?=G5_CSS_VER?>">
<style>


@media (max-width:768px){
    .btm_nav_box .link_title.ver2{
        margin-bottom: 20px;
    }
}
</style>

<div class="autoW bdpd">
    <div id="mypage_wrap" class="">
       <?php include_once('./mypage_left_menu.php'); ?> 
        <div class="con_wrap">
            <div class="rev_wrap">
                <h2>나의 포인트 현황</h2>
				<!--
                <ul class="rev_tab_wrap">
                    <li data-view = "" class="rev_tab <?php  if ($view == '') echo "on" ?>">전체</li>
                    <li data-view = "private" class="rev_tab <?php  if ($view == 'private') echo "on" ?>">프라이빗 센터</li>
                    <li data-view = "golf" class="rev_tab <?php  if ($view == 'golf') echo "on" ?>">더 스크린골프</li>
                    <li data-view = "cu" class="rev_tab <?php  if ($view == 'cu') echo "on" ?>">CU문화센터</li>
                </ul>
				-->
                <table class="rev_board">
                    <tr>
                        <!--                        <th>상태</th>-->
                        <th>내용</th>
                        <th>기간</th>
                        <th>증감포인트</th>
						<th>남은포인트</th>
                    </tr>

					<? 
						$is_null = true;
						while($row = sql_fetch_array($re)){
							$is_null = false;
					?>	
							<tr>
								<td>
									<a><?=$row['po_content']?></a>
								</td>
								<td>
									<a><?=$row['po_datetime']?></a>
								</td>
								<td>
									<a><?=number_format($row['po_point'])?></a>
								</td>
								<td>
									<a><?=number_format($row['po_mb_point'])?></a>
								</td>
							</tr>
					<?}?>

					<? if($is_null == true) { ?>

						<tr>
							<td class="no_rev" colspan="5">
								<a href="javascript:void(0)">포인트 정보가 없습니다.</a>
							</td>
						</tr>
					<?}?>
					
                </table>
            </div>
        </div>
    </div>
</div>

<script>

</script>

<?php
include_once('./_tail.php');
?>
