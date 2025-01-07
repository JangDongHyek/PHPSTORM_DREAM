<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$sql = " select * from {$g5['new_win_table']}
          where '".G5_TIME_YMDHIS."' between nw_begin_time and nw_end_time
            and nw_device IN ( 'both', 'pc' )
          order by nw_id asc ";
//$result = sql_query($sql, false);
$row = sql_fetch($sql);

?>


<style>
/*.swiper-slide{ width:100% !important; margin:0 !important}
.swiper-slide img{ width:100%}*/
</style>
<?php
	if(!$_COOKIE["hd_pops_{$row['nw_id']}"]){?>
<!-- 팝업레이어 시작 { -->
<div id="hd_pop">
    <h2>팝업레이어 알림</h2>
	<div id="hd_pops_<?php echo $row['nw_id'] ?>" class="hd_pops swiper-container2" style="top:<?php echo $row['nw_top']?>px;left:<?php echo $row['nw_left']?>px">
		<?php
/*			if ($_COOKIE["hd_pops_{$row['nw_id']}"])
	        continue;*/
		?>
		<div class="hd_pops_con swiper-wrapper" id="Pop" style="width:<?php echo $row['nw_width'] ?>px;height:<?php echo $row['nw_height'] ?>px">
			<?php
			$sql = " select * from {$g5['new_win_table']}
					  where '".G5_TIME_YMDHIS."' between nw_begin_time and nw_end_time
					  and nw_device IN ( 'both', 'pc' )
					  order by nw_id asc ";
			$result = sql_query($sql, false);
			for ($i=0; $nw=sql_fetch_array($result); $i++)
			{
			?>
              <div class="swiper-slide"><?php echo conv_content($nw['nw_content'], 1); ?></div>
			<?php }?>
        </div>
		<div class="hd_pops_footer">
            <button class="hd_pops_reject hd_pops_<?php echo $row['nw_id']; ?> <?php echo $row['nw_disable_hours']; ?>"><strong><?php echo $row['nw_disable_hours']; ?></strong>시간 동안 다시 열람하지 않습니다.</button>
            <button class="hd_pops_close hd_pops_<?php echo $row['nw_id']; ?>">닫기</button>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
	</div>
<?php
}
/*for ($i=0; $nw=sql_fetch_array($result); $i++)
{
    // 이미 체크 되었다면 Continue
    if ($_COOKIE["hd_pops_{$nw['nw_id']}"])
        continue;
?>

    <div id="hd_pops_<?php echo $nw['nw_id'] ?>" class="hd_pops swiper-container" style="top:<?php echo $nw['nw_top']?>px;left:<?php echo $nw['nw_left']?>px">
        <div class="hd_pops_con swiper-wrapper" style="width:<?php echo $nw['nw_width'] ?>px;height:<?php echo $nw['nw_height'] ?>px">
              <div class="swiper-slide"><?php echo conv_content($nw['nw_content'], 1); ?></div>
        </div>
        <div class="hd_pops_footer">
            <button class="hd_pops_reject hd_pops_<?php echo $nw['nw_id']; ?> <?php echo $nw['nw_disable_hours']; ?>"><strong><?php echo $nw['nw_disable_hours']; ?></strong>시간 동안 다시 열람하지 않습니다.</button>
            <button class="hd_pops_close hd_pops_<?php echo $nw['nw_id']; ?>">닫기</button>
        </div>
    </div>
<?php }
if ($i == 0) echo '<span class="sound_only">팝업레이어 알림이 없습니다.</span>';*/
?>
</div>


<script>
$(function() {
	new Swiper('.swiper-container2', {
	 //nextButton: '.swiper-button-next',
	 //prevButton: '.swiper-button-prev',
	pagination: '.swiper-pagination',
	 paginationClickable: true,
	 slidesPerView: 1,
	 speed: 1200,
	 centeredSlides: true,
	 autoplay: 2000,
	 mousewheelControl: true,
	 autoplayDisableOnInteraction: false,
	 loop:true,
	});
    $(".hd_pops_reject").click(function() {
        var id = $(this).attr('class').split(' ');
        var ck_name = id[1];
        var exp_time = parseInt(id[2]);
        $("#"+id[1]).css("display", "none");
        set_cookie(ck_name, 1, exp_time, g5_cookie_domain);
    });
    $('.hd_pops_close').click(function() {
        var idb = $(this).attr('class').split(' ');
        $('#'+idb[1]).css('display','none');
    });
    $("#hd").css("z-index", 1000);
	 
});
</script>
<!-- } 팝업레이어 끝 -->