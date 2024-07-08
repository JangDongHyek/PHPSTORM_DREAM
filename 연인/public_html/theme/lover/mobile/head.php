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
<!-- sdk 자바스크립트 -->
<script>
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T43XLM7');
</script>

<!--header-->
<header id="hd" <?php if(!defined('_INDEX_')){ echo "class='sub'"; } ?>>
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>




    <div id="new_hd">
        <? if($is_member) { ?>
            <!-- 로그인 -->
            <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">

                <?php if (defined('_INDEX_')) { ?>
                    <img src="<?php echo G5_THEME_IMG_URL ?>/new/new_ic1.svg">
                <?php } else {?>
                    <img src="<?php echo G5_THEME_IMG_URL ?>/new/new_ic1sub.svg">
                <?php } ?>
            </a>
            <p>
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else if(defined('_INDEX_')){ ?>

                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?>
            </p>
            <a href="<?=G5_BBS_URL?>/register_form.php?w=u">
                <?php if (defined('_INDEX_')) {  ?>
                    <img src="<?php echo G5_THEME_IMG_URL ?>/new/new_ic2.svg">
                <?php } else {?>
                    <img src="<?php echo G5_THEME_IMG_URL ?>/new/new_ic2sub.svg">
                <?php } ?>
            </a>
        <?} else { ?>
            <!-- 비로그인 -->
            <a></a>
            <p>
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else if(defined('_INDEX_')){ ?>

                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?>
            </p>
            <a></a>
        <?}?>

    </div>
    <?/*php  else {?>

        <?php
        if(defined('_INDEX_')) { // index에서만 실행
        } ?>

        <?php if (defined('_INDEX_')) { // index에서만 실행 ?>
        <div id="hd_wrapper">
            <div class="row">
            <!-- 전체메뉴 시작 { -->
            <div class="tnb_heart col-xs-2">
                  <div id="hd_icon" class="CE col-xs-3">
                    <?
                    // 회원 휴면기/진행기 on, off
                    $sw_flag = strtolower(strtolower($member['mb_switch']));
                    $sw_str = ($sw_flag == "on")? "진행기" : "휴면기";
                    ?>
                    <div id="hf_flag" class="<?=$sw_flag?>" onclick="setMemberSwitch('<?=$member['mb_id']?>', '<?=$sw_flag?>', 'index');">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/hd_icon_<?=$sw_flag?>.png" alt="<?=$sw_str?>">
                        <p><!--<i class="fas fa-sort-up"></i>--><span><?=$sw_str?><i class="far fa-grin"></i></span></p>
                    </div>
                    <? /*
                    <!-- 원본 -->
                    <div class="on" style="">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/hd_icon_on.png" alt="진행기">
                        <!--<p><i class="fas fa-sort-up"></i><span>진행기</span></p>-->
                    </div>
                    <div class="off" style="display:none">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/hd_icon_off.png" alt="휴면기">
                        <!--<p><i class="fas fa-sort-up"></i><span>휴면기</span></p>-->
                    </div>
                    / ?>
                </div>
            </div>
            <h1 id="logo" class="col-xs-8">
                <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
            </h1>
            <div class="tnb col-xs-2">
                <div class="nav_open">
                    <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="top">
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
                   <a id="back" href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/btn_back.png" style="height:20px"></a>
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
                   <? } else if ($bo_table == "b_event") { //이벤트 ?>
                       <p class="b_w"><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=b_event">글쓰기</a></p>
                   <?php } else { ?>
                   <? }?>
                </div>
            </div>
        </div>
        <?php } ?>

    <?php } */?>

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
