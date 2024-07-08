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

    <?php if (defined('_INDEX_')) { // index에서만 실행 ?>
    <div id="hd_wrapper">
    	<div class="row">
        <!-- 전체메뉴 시작 { -->
		<div class="tnb col-xs-2">
              <!--<div class="mem"><a href="javascript:alert('준비중입니다')"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/hd_mem.png" alt="멤버쉽"><span class="sound_only">멤버쉽</span></a></div>-->
        </div>
        <h1 id="logo" class="col-xs-8">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </h1>
        <div class="tnb col-xs-2">
            <div class="nav_open">
                <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="bottom">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/hd_mem.png" alt="메뉴"><span class="sound_only">열기</span>
                </a>
            </div><!--모바일메뉴버튼-->
        </div><!--전체메뉴버튼-->
        <!-- } 전체메뉴 끝 -->
        </div>  
	</div>  
    <?php }else{ // index 아닐때 실행 ?>
    <div id="hd_sub">
        <div class="clearfix">
            <div class="col-xs-2">
               <a id="back" href="javascript:history.back();"><img src="<?php echo G5_THEME_IMG_URL ?>/common/btn_back.png" style="height:20px"></a>
            </div>
            <div class="col-xs-8 text-center">
				 <h2 id="container_title">
				 <?php if($bo_table) {?>
                        <?php echo $board['bo_subject']; ?>
                 <?php }else { ?>
                        <?php echo $g5['title'] ?>
                 <?php } ?>
                 </h2>
            </div>
            <div class="col-xs-2">
               <? if( $bo_table =="b_notice") { //공지 ?>
                   <p class="b_w"><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=b_notice">글쓰기</a></p>
               <? } else if ($bo_table == "b_counsel") { //연애상담소 ?>
                   <p class="b_w"><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=b_counsel">글쓰기</a></p>
               <?php } else { ?>
               <? }?>
            </div>
        </div>
    </div>
    <?php } ?>
            
</header>
<!--//header-->

	<? if(defined('_INDEX_')) {?>
    <!-- 인텍스부분 -->
    
	<?php /*?><? }else if($bo_table || $co_id){ ?><?php */?>
	<? }else { ?>
    <!-- 서브 내용페이지 { -->
	<div id="wrapper">

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
        </div>
        <div id="container">
    <!-- } 서브 내용페이지 -->
    <? } ?> 
