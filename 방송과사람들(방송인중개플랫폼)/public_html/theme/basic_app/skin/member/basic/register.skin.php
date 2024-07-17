<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$name = "regi";
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>

<style>
	#ft{display:none;}
</style>

<? if($name=="regi") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="regi">
<?}?>

<div class="mbskin join_type">
	<div class="inr">
		<form name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
			<h1 class="logo">
				<img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_bk.svg" alt="방송과사람들">
				<span class="title_top">원하는 회원가입 유형을 선택하세요.</span>
			</h1>
			
			<div class="join_type cf">
                    <div id="member1" onclick="add_class(this.id);" class="type client"><!--선택하면 의뢰인 가입화면으로 넘어감-->
                    	<a href="<?php echo G5_BBS_URL ?>/register_expert_form.php?level=2">
                        <div class="join_type_chk"></div>
                        <img alt="의뢰인" src="<?php echo G5_THEME_IMG_URL ?>/app/icon_join01.svg">
                        <div class="title">
                            <h3>의뢰인으로 가입</h3>
                            <span>전문가에게 도움을 받고 싶어요</span>
                        </div>
                    	</a>
                    </div>
                    <div id="member2" onclick="add_class(this.id);" class="type expert">
                    	<a href="<?php echo G5_BBS_URL ?>/register_expert_form.php?level=3">
                        <div class="join_type_chk"></div><!--선택하면 전문인 가입화면으로 넘어감-->
                        <img alt="전문인" src="<?php echo G5_THEME_IMG_URL ?>/app/icon_join02.svg">
                        <div class="title">
                             <h3>전문인으로 가입</h3>
                            <span>비즈니스에 맞는 고객을 만나고 싶어요</span>
                        </div>
                        </a>
                    </div>
        </div><!--join_type-->


		   <!-- <div class="btn_confirm">
				<input type="submit" class="btn_submit btn btn-primary btn-lg" value="가입신청하기">
			</div>-->

		</form>
	</div>
</div>

<!--<form id="register1" name="register1" method="post" action="./register_form.php">
    <input type="hidden" id="id" name="id" value="<?/*=$id*/?>">
    <input type="hidden" id="email" name="email" value="<?/*=$email*/?>">
    <input type="hidden" id="sns" name="sns" value="<?/*=$sns*/?>">
</form>-->

<script>
    function add_class(w){
        $('.type').removeClass('action');
        $('#'+w).addClass('action');
    }
</script>