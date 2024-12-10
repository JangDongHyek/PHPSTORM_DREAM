<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 대리점정보 없으면 선택화면으로 이동
if ((int)$_SESSION['myAgency'] < 1 || $_SESSION['myAgency'] == "") {
	alert("대리점 선택이 필요합니다.", G5_URL."/theme/basic/mobile/intro.php");
}


// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 100);
?>
<script type="text/javascript">
$(function(){
	$("#agree-all").bind("click",function(){
		if($(this).prop("checked")){
			$("#agree-all-check").removeClass("check-large");
			$("#agree-all-check").addClass("check-large-active");
			$("input[type=checkbox]").prop("checked",true);
			$(".agree-check").addClass("check-small-active");
			$(".agree-check").removeClass("check-small");
		}else{
			$("#agree-all-check").removeClass("check-large-active");
			$("#agree-all-check").addClass("check-large");
			$("input[type=checkbox]").prop("checked",false);
			$(".agree-check").addClass("check-small");
			$(".agree-check").removeClass("check-small-active");
		}
	});
	
		$(".agree-check").bind("click",function(){
			var index=$(this).attr("data");
			if($("#agree"+index).prop("checked")){
				$("#agree-"+index).removeClass("check-small");
				$("#agree-"+index).addClass("check-small-active");
			}else{
				$("#agree-"+index).removeClass("check-small-active");
				$("#agree-"+index).addClass("check-small");
			}
		});
	


});
</script>
<div class="mbskin" id="agree_wrap">

    <form name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">

    <!--<p>
			회원가입약관 및 개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.
					
		</p>-->
		<h2>
			모두 확인, 동의부탁합니다. 
			<label for="agree-all">
			<span class="check check-large" id="agree-all-check">
				<input type="checkbox" name="agree_all" id="agree-all" value="1" style="display:none">
			</span>
			</label>
		</h2>
		
		<div>원활한 서비스 이용을 위해 필수 항목 동의가 필요합니다.</div>
		<div class="agree-form">
			<ul>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">서비스 이용약관 동의(필수)</a></li>
				<li>
					<label for="agree1">
					<span class="check-small agree-check" id="agree-1" data="1">
						<input type="checkbox" name="agree" id="agree1" value="1" style="display:none">	
					</span>
					</label>
				</li>
			</ul>
			<ul>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=lbs">위치기반 이용서비스 동의(필수)</a></li>
				<li>
					<label for="agree2">
					<span class="check-small agree-check" id="agree-2" data="2">
						<input type="checkbox" name="agree2" id="agree2" value="1" style="display:none">	
					</span>
					</label>
				</li>
			</ul>
			<ul>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보 처리방침 동의(필수)</a></li>
				<li>
					<label for="agree3">
					<span class="check-small agree-check" id="agree-3" data="3">
						<input type="checkbox" name="agree3" id="agree3" value="1" style="display:none">	
					</span>
					</label>
				</li>
			</ul>
			<ul>
				<li>개인정보 제3자 제공 동의(필수)</li>
				<li>
					<label for="agree4">
					<span class="check-small agree-check" id="agree-4" data="4">
						<input type="checkbox" name="agree4" id="agree4" value="1" style="display:none">	
					</span>
					</label>
				</li>
			</ul>
			<ul>
				<li>마케팅 전체 수신 동의(선택)</li>
				<li>
					<label for="agree5">
					<span class="check-small agree-check" id="agree-5" data="5">
						<input type="checkbox" name="agree5" id="agree5" value="1" style="display:none">	
					</span>
					</label>
				</li>
			</ul>
		</div>
		<?
		/*
    <section id="fregister_term">
        <h2>회원가입약관</h2>
        <textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea>
        <fieldset class="fregister_agree">
            <label for="agree11">회원가입약관의 내용에 동의합니다.</label>
            <input type="checkbox" name="agree" value="1" id="agree11">
        </fieldset>
    </section>

    <section id="fregister_private">
        <h2>개인정보처리방침안내</h2>
        <div class="tbl_head01 tbl_wrap">
            <!--<table>
                <caption>개인정보처리방침안내</caption>
                <thead>
                <tr>
                    <th>목적</th>
                    <th>항목</th>
                    <th>보유기간</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>이용자 식별 및 본인여부 확인</td>
                    <td>아이디, 이름, 비밀번호</td>
                    <td>회원 탈퇴 시까지</td>
                </tr>
                <tr>
                    <td>고객서비스 이용에 관한 통지,<br>CS대응을 위한 이용자 식별</td>
                    <td>연락처 (이메일, 휴대전화번호)</td>
                    <td>회원 탈퇴 시까지</td>
                </tr>
                </tbody>
            </table> -->
        </div>
        <textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea>
        <fieldset class="fregister_agree">
            <label for="agree21">개인정보처리방침안내의 내용에 동의합니다.</label>
            <input type="checkbox" name="agree2" value="1" id="agree21">
        </fieldset>*/?>
    </section>

    <div class="btn_confirm">
        <input type="submit" class="btn_submit" value="회원가입">
    </div>

    </form>

    <script>
    function fregister_submit(f)
    {
        if (!f.agree1.checked) {
			getNoti(1, '서비스 이용약관 동의 내용에 동의하셔야 회원가입 하실 수 있습니다.');
            return false;
        }

        if (!f.agree2.checked) {
            getNoti(1, "위치기반 서비스 이용약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            return false;
        }

		if (!f.agree3.checked) {
            getNoti(1, "개인정보 수집 동의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            return false;
        }

		if (!f.agree4.checked) {
            getNoti(1, "개인정보 제 3자 제공 동의  내용에 동의하셔야 회원가입 하실 수 있습니다.");
            return false;
        }

        return true;
    }
    </script>

</div>