<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/submenu.lib.php');
?>
<!--header-->
<header id="hd" <?php if(!defined('_INDEX_')){ echo "class='sub'"; } ?>>
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
    } ?>

    <div id="hd_wrapper">
		<div class="tnb col-xs-2">
        <a href="javascript:history.back();" class="closed"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/tnb_back.png" alt="뒤로"><span class="sound_only">뒤로</span></a> 
        </div>
        <div id="logo" class="col-xs-8">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>
        
        <!-- 전체메뉴 시작 { -->
        <div class="tnb col-xs-2">
            <div class="nav_open">
                <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
                    <span></span><span></span><span></span><span class="sound_only">열기</span>
                </a>
            </div><!--모바일메뉴버튼-->
        </div><!--전체메뉴버튼-->
        <!-- } 전체메뉴 끝 -->
           
	</div>          
</header>
<!--//header-->

	<? if(defined('_INDEX_')) {?>
    <!-- 인텍스부분 -->
    
	<?php /*?><? }else if($bo_table || $co_id){ ?><?php */?>
	<? }else { ?>
    <!-- 서브 내용페이지 { -->
    <!-- 메인퀵메뉴 { -->
	<div id="wrapper">
    <div class="quick_menu cf">
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

	<?php 
	$sql_common = " from {$g5['board_new_table']} a, {$g5['board_table']} b, {$g5['group_table']} c where a.bo_table = b.bo_table and b.gr_id = c.gr_id and a.wr_id = a.wr_parent";
	$sql_order = " order by a.bn_id desc ";

	$sql = " select a.*, b.bo_subject, c.gr_subject, c.gr_id {$sql_common} {$sql_order} limit 0, 1 ";
	$latest = sql_fetch($sql);
    $tmp_write_table = $g5['write_prefix'] . $latest['bo_table'];
    $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$latest['wr_id']}' ");
	?>

        <?php /*?><div class="idx_bbs" style="border-top:2px solid #038FD1;">
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
					<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?php echo $latest['bo_table'];?>&wr_id=<?php echo $latest['wr_id'];?>">
						<span class="sound_only"><?php echo $row2['wr_subject']; ?></span>더보기 &nbsp;<i class="fa fa-angle-right"></i>
					</a>
				</div>
				<?php } ?>
			</div>

        </div><?php */?> <!--서브공지삭제170629-->
        <div id="aside">
        <?php 

            if(!$is_register || $w){ 
                //서브메뉴 추가
                if(!$sm_tid)	$sm_tid = $co_id;
                if(!$sm_tid)	$sm_tid = $bo_table;
                if($sm_tid)		
                echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
            }
        ?>
        </div>
        <div id="container">
            <div id="container_title">
            <!--메뉴로케이션 시작 {-->
            <?php 
    
                if(!$is_register || $w){ 
                    //서브메뉴 추가
                    if(!$sm_tid)	$sm_tid = $co_id;
                    if(!$sm_tid)	$sm_tid = $bo_table;
                    if($sm_tid)		
                    echo submenu($sm_tid, 'location', G5_THEME_PATH); 
                }
            ?>
            <!--} 메뉴로케이션 끝-->
             <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
             <?php }else { ?>
                    <?php echo $g5['title'] ?>
             <?php } ?>
            </div><!--//container_title"-->
    <!-- } 서브 내용페이지 -->
    <? } ?> 
