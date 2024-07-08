<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>
<div id="idx_wrapper">
    <div id="visual">
        <div class="slogan">
            <p>"We go together"</p>
            <span>두산중공업협력회</span>
        </div>
        <ul class="sliderbx">
        	<li></li>
        	<li></li>
        	<li></li>
        </ul>
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->

<div id="idx_container">

	<?php 
	$sql_common = " from {$g5['board_new_table']} a, {$g5['board_table']} b, {$g5['group_table']} c where a.bo_table = b.bo_table and b.gr_id = c.gr_id and a.wr_id = a.wr_parent";
	$sql_order = " order by a.bn_id desc ";

	$sql = " select a.*, b.bo_subject, c.gr_subject, c.gr_id {$sql_common} {$sql_order} limit 0, 1 ";
	$latest = sql_fetch($sql);
    $tmp_write_table = $g5['write_prefix'] . $latest['bo_table'];
    $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$latest['wr_id']}' ");
	?>
    <div class="idx_bbs">
        <h2>공지</h2>
		
		<div class="lt">
			<ul class="list">
				<?php if($latest) { ?>
				<li>
					<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?php echo $latest['bo_table'];?>&wr_id=<?php echo $latest['wr_id'];?>">
					<?php echo $row2['wr_subject'];?>
					</a>
				</li>
				<?php }else{ ?>
				<li>게시물이 없습니다.</li>
				<?php } ?>
			</ul>
			<?php if($latest) { ?>
			<div class="lt_more">
				<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=notice01">
					<span class="sound_only"><?php echo $row2['wr_subject'];?></span>더보기 &nbsp;<i class="fa fa-angle-right"></i>
				</a>
			</div>
			<?php } ?>
		</div>
    </div>
    
    <!-- 메인퀵메뉴 { -->
    <div class="idx_menu cf">
        <ul>
        <?php
        $sql = " select *
                    from {$g5['menu_table']}
                    where me_mobile_use = '1'
                      and length(me_code) = '2'
                    order by me_order, me_id ";
        $result = sql_query($sql, false);

        for($i=0; $row=sql_fetch_array($result); $i++) {
        ?>
            <li>
                <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>"><?php echo $row['me_name'] ?></a></li>
        <?php
        }
        if ($i == 0) {  ?>
            <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
        <?php } ?>
        </ul>
    </div>
    <!-- } 메인퀵메뉴 -->
    
    <!-- 배너 { -->
    <a href="https://www.youtube.com/embed/wSstdPsqOrk" class="video_bn">
    	<p><i class="fa fa-video-camera"></i>&nbsp;&nbsp;동반성장 홍보영상</p>
        동반성장 프로그램의 홍보영상을 감상하세요
    </a>
    <div class="banner">
        <dl>
          <dt>협력사 채용 박람회</dt>
          <dd>중소기업의 인력난을 해결하기 위해 참여 협력사에<br>
          채용박람회 참가에 대한 비용 지원</dd>
          <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=program04" class="btn">자세히보기</a>
        </dl>
    </div>
    <!-- } 배너 -->

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>