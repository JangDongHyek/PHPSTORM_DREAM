<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>


<div class="mbskin agr_check">
    <form name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
    	<h1 class="logo">
        	<img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고">
            <span class="title_top"><strong class="point">잡고</strong>에서 특별한 재능을 찾아드립니다.</span>
        </h1>
        
        <div class="join_type cf">
                    <div id="member1" onclick="add_class(this.id);" class="type client"><!--선택하면 의뢰인 가입화면으로 넘어감-->
                    	<a href="<?php echo G5_BBS_URL ?>/register_form.php">
                        <div class="join_type_chk"></div>
                        <img alt="의뢰인" src="<?php echo G5_THEME_IMG_URL ?>/main/ic_joinclient.png">
                        <div class="title">
                            어떤 재능이 필요한가요?<br />잡고에서 찾아드리겠습니다!
                            <div class="who"><strong>의뢰인</strong>으로 가입하기</div>
                        </div>
                    	</a>
                    </div>
                    <div id="member2" onclick="add_class(this.id);" class="type expert">
                    	<a href="<?php echo G5_BBS_URL ?>/register_expert_form01.php">
                        <div class="join_type_chk"></div><!--선택하면 전문인 가입화면으로 넘어감-->
                        <img alt="전문인" src="<?php echo G5_THEME_IMG_URL ?>/main/ic_joindesigner.png">
                        <div class="title">
                            당신이 가진 특별한 재능을<br />잡고에서 마음껏 펼쳐보세요!
                            <div class="who"><strong>재능인</strong>으로 가입하기</div>
                        </div>
                        </a>
                    </div>
        </div><!--join_type-->


       <!-- <div class="btn_confirm">
            <input type="submit" class="btn_submit btn btn-primary btn-lg" value="가입신청하기">
        </div>-->

    </form>
</div>

<script>
    function add_class(w){
        $('.type').removeClass('action');
        $('#'+w).addClass('action');
    }
</script>