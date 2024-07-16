<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>



<div id="mypage">
    <?php /*?><div class="my_hd">
        <a href="javascript:history.back();" class="btn_close">
        <i class="fal fa-times"></i><span class="sound_only">닫기</span>
        </a>
    </div><?php */?><!--.my_hd-->

    <div class="my_box">
		<?php if ($is_member) { ?>
        <div class="my_info">
            <p><?php echo $member['mb_name'] ?> <span><?php echo $member['mb_id'] ?></span></p>
            <a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn2">로그아웃</a>
            <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php" class="btn2">정보수정</a>
        </div><!--.mb_info-->
		<?php } else { ?>
        <div class="my_info">
            <div class="no_login"><a href="<?php echo G5_BBS_URL ?>/login.php">로그인 후, 이용해주세요</a></div>
            <a href="<?php echo G5_BBS_URL ?>/login.php" class="btn2">로그인</a>
            <a href="<?php echo G5_BBS_URL ?>/register_form.php" class="btn2">회원가입</a>
        </div><!--.mb_info-->
		<?php } ?>
    </div><!--.my_box-->
    
    <div class="my_tpoint">
        <div class="my_tp cf">
        	<div id="tp_t"><i class="far fa-parking-circle"></i> 총 포인트</div>
        	<div id="tpoint">50,000 P</div>
        </div><!--.my_tp-->
    </div><!--.my_tpoint-->
    
    <div class="point_list">
    	<div class="plist_t">나의 포인트조회</div>
    	<div class="plist">
        	<ul>
            	<li><div id="pdate">2020.10.05</div>  <div id="pnum">2000P</div></li>
            	<li><div id="pdate">2020.10.05</div>  <div id="pnum">2000P</div></li>
            </ul>
            
            <div class="point_no">포인트내역이 없습니다.</div>
            
        </div>
        
        <!--게시물페이징-->
        <div id="paging">
        	<div class="page_box">
                <ul>
                	<li><span><a><i class="fal fa-angle-double-left"></i></a></span></li>
                    <li><span class="page_now"><a>1</a></span></li>
                    <li><span><a>2</a></span></li>
                    <li><span><a>3</a></span></li>
                	<li><span><a><i class="fal fa-angle-double-right"></i></a></span></li>
                </ul>
            </div><!--.page_box-->
        </div><!--#paging-->
        
    </div><!--.point_list-->
    
    

</div>

