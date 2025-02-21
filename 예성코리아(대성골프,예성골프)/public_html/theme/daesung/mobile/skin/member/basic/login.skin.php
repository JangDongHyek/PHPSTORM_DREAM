<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_PATH."/jl/JlConfig.php");

$jl_kakao = new JlKakao($_GET);
$jl_naver = new JlNaver($_GET);
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="mb_login" class="mbskin">
    <div class="login_frm_box container">

        <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post" class="form-signin">
        <input type="hidden" name="url" value="<?php echo $login_url ?>">
		<div class="newLogBox">
			<h2>회원 로그인</h2>

			<div id="login_frm">
				<label for="login_id" class="sound_only form-control">아이디<strong class="sound_only"> 필수</strong></label>
				<input type="text" name="mb_id" id="login_id" placeholder="아이디(필수)" required class="frm_input required" maxLength="20">
				<label for="login_pw" class="sound_only">비밀번호<strong class="sound_only"> 필수</strong></label>
				<input type="password" name="mb_password" id="login_pw" placeholder="비밀번호(필수)" required class="frm_input required" maxLength="20">
				<input type="submit" value="로그인" class="btn_submit">
				<?php /*?><div>
					<input type="checkbox" name="auto_login" id="login_auto_login">
					<label for="login_auto_login" class="auto_signin">자동로그인</label>
				</div><?php */?>
			</div>

            <div class="tc">
                <a href="<?php echo G5_BBS_URL ?>/register_form.php" class="newBtn xsmallB">회원 가입</a>
                <a href="<?php echo G5_BBS_URL ?>/password_lost.php" target="_blank" id="login_password_lost" class="newBtn xsmallB">아이디 비밀번호 찾기</a>
            </div>


		</div>
		<!-- /newLogBox -->
    
        </form>

        <? add_stylesheet('<link rel="stylesheet" href="'.get_social_skin_url().'/style.css">', 10); ?>
        <div class="login-sns sns-wrap-32 sns-wrap-over" id="sns_login">
            <h3>소셜계정으로 로그인</h3>
            <div class="sns-wrap">
                <a href="<?=$jl_naver->createHref();?>" class="sns-icon social_link sns-naver" title="네이버">
                    <span class="ico"></span>
                    <span class="txt">네이버<i> 로그인</i></span>
                </a>
                <a href="<?=$jl_kakao->createHref();?>" class="sns-icon social_link sns-kakao" title="카카오">
                    <span class="ico"></span>
                    <span class="txt">카카오<i> 로그인</i></span>
                </a>
            </div>
        </div>


		<?php
			// 소셜로그인 사용시 소셜로그인 버튼
			//include_once(get_social_skin_path().'/social_login.skin.php');
			?>
		
        <?php // 쇼핑몰 사용시 여기부터 ?>
        <?php if ($default['de_level_sell'] == 1) { // 상품구입 권한 ?>
    
            <!-- 주문하기, 신청하기 -->
            <?php if (preg_match("/orderform.php/", $url)) { ?>
    
        <section id="mb_login_notmb" class="newLogBox">
            <h2>비회원 구매</h2>
    
            <p>
                비회원으로 주문하시는 경우 포인트는 지급하지 않습니다.
            </p>
    
            <div id="guest_privacy">
                <!--?php echo $default['de_guest_privacy']; ?-->
				대성골프는 다음과 같이 서비스 제공을 위한 최소한의 이용자의 개인정보를 수집 및 이용하고 있습니다.<br><br>

1. 개인정보의 수집ㆍ이용 목적<br>
- 주문자 정보확보<br>
- 물품에 관한 배송지 정보 확보<br>
- 불만처리 의사소통 경로확보<br><br>
2. 수집하는 개인정보 항목<br>
물품 주문 시: 주문자의 성명, 주민등록번호, 유∙무선 전화번호, 전자우편주소, 주문비밀번호와 물품 수령인의 성명, 배송주소, 전화번호, 기타요구사항<br>
대금 결제 시<br>
- 카드결제의 경우: 신용카드 종류, 카드번호, 유효기간 등 결제에 필요한 최소 정보<br>
- 계좌이체의 경우: 거래 은행명, 계좌번호, 거래자 성명<br>
주문정보 확인 시: 주문번호, 이름<br><br>
3. 개인정보의 보유 및 이용기간<br>
- 원칙적으로 개인정보의 수집목적 또는 제공받은 목적이 달성되면 지체 없이 파기합니다.<br>
단, 전자상거래등에서의 소비자보호에 관한 법률 등 관계 법률에 의해 보존할 필요가 있는 경우에는 일정기간 보존합니다.<br>
- 계약 또는 청약철회 등에 관한 기록 : 5년<br>
- 대금결제 및 재화 등의 공급에 관한 기록 : 5년<br>
- 소비자 불만 또는 분쟁처리에 관한 기록 : 3년<br>
            </div>
    
            <div class="chk_ico"> 
            <input type="checkbox" id="agree" value="1">
            <label for="agree">개인정보수집에 대한 내용을 읽었으며 이에 동의합니다.</label>
            </div>
           
            <div class="btn_confirm" style="margin:15px 0 0">
                <a href="javascript:guest_submit(document.flogin);" class="newBtn">비회원으로 구매하기</a>
            </div>
    
            <script>
            function guest_submit(f)
            {
                if (document.getElementById('agree')) {
                    if (!document.getElementById('agree').checked) {
                        alert("개인정보수집에 대한 내용을 읽고 이에 동의하셔야 합니다.");
                        return;
                    }
                }
    
                f.url.value = "<?php echo $url; ?>";
                f.action = "<?php echo $url; ?>";
                f.submit();
            }
            </script>
        </section>
    
            <?php } else if (preg_match("/orderinquiry.php$/", $url)) { ?>
    
        <fieldset id="mb_login_od" class="newLogBox">
            <legend>비회원 주문조회</legend>
                <h2>비회원 주문조회 안내</h2>
            <p>메일로 발송해드린 주문서의 <strong>주문번호</strong> 및 주문 시<br>입력하신 <strong>비밀번호</strong>를 정확히 입력해주십시오.</p>

            <form name="forderinquiry" method="post" action="<?php echo urldecode($url); ?>" autocomplete="off">
    
            <label for="od_id" class="od_id sound_only">주문번호<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="od_id" value="<?php echo $od_id ?>" id="od_id" placeholder="주문번호" required class="frm_input required" size="20">
            <label for="id_pwd" class="od_pwd sound_only">비밀번호<strong class="sound_only"> 필수</strong></label>
            <input type="password" name="od_pwd" size="20" id="od_pwd" placeholder="비밀번호" required class="frm_input required">
            <input type="submit" value="확인" class="btn_submit">
    
            </form>
        </fieldset>
    

    
            <?php } ?>
    
        <?php } ?>
        <?php // 쇼핑몰 사용시 여기까지 반드시 복사해 넣으세요 ?>
    
        <!-- <div class="btn_confirm">
            <a href="<?php echo G5_URL ?>/">메인으로 돌아가기</a>
        </div> -->
    </div>
</div>

<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    return true;
}
</script>
