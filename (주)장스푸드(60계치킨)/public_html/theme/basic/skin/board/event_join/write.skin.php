<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);

if(!$w){//글쓰기 상태일때
	$write['wr_1'] = $_GET['wr_subject'];//넘어온 이벤트 명을 넣는다.
	$write['wr_3'] = $_GET['id'];//넘어온 이벤트 wr_id값을 넣는다.
}
?>
<section id="bo_w">
	<div id="event_join">
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="password" value="1234!">
	<input type="hidden" name="wr_name" value="<?=$write['wr_name']?>">
	<input type="hidden" name="wr_subject" value="<?=$write['wr_subject']?>">
	<input type="hidden" name="wr_content" value="희망창업">
	<input type="hidden" name="status_chk" id="status_chk" value="0">
	<input type="hidden" name="wr_1" id="wr_1" value="<?=$write['wr_1']?>">
	<input type="hidden" name="wr_3" id="wr_3" value="<?=$write['wr_3']?>">

    <div class="tbl_frm01 tbl_wrap">
		<?if(!$w){?><!-- 글쓰기상태일때 -->
        <table>
        <colgroup>
           <col style="width:15%" />
           <col style="width:auto" />
        </colgroup>
        <tbody>
		<tr>
			<td class="event_title">
				<span class="sound_only">이벤트명 : </span><?=$write['wr_1']?>
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" name="wr_2"  id="wr_2" value="<?php echo $write['wr_2'] ?>" required class="frm_input required" placeholder="휴대전화번호 입력" onkeyup="name_copy(this)">
				<script>					
				function name_copy(name){
					document.all.wr_subject.value = name.value + " 님의 신청내역입니다.";
					document.all.wr_name.value = name.value;
				}
				</script>
				<input type="button" id="cert_btn" class="cert_btn" value="인증번호받기">

				<!-- 인증확인 div 최초에 display:none 상태 -->
				<div id="cert_dl" class="row none">
					<span id="cert_dd_btn">
						<input type="text" name="mb_cert" id="reg_mb_cert" value="" placeholder="인증번호" maxlength="6" class="frm_input required">
						<input type="button" id="cert_btn2" class="cert_btn2" value="인증확인">
					</span>					
					<span id="cert_dd_cnt">
						(<span id="cert_second" class="red-font" style="font-weight:bold;">180</span> 초)
					</span>					
					<span id="cert_dd_chk" class="none">
						인증되었습니다.
					</span>
					<span id="mb_cert_txt" class="red-font"></span>
				</div>
				<!-- 인증확인 div 끝 -->
			</td>
        </tr>
        </tbody>
        </table>

		<?if(!$w){?>
		<section id="fregister_private">
			<h2 class="sound_only">개인정보 수집 및 이용</h2>
			<textarea readonly style="resize:none; width:100%;"><?php echo get_text($config['cf_privacy']) ?></textarea>			
		</section>
		<?}?>		

		<fieldset class="fregister_agree">			
			<label for="agree1">개인정보 수집 및 이용에 관한 내용에 동의함</label>
			<input type="checkbox" name="agree1" value="1" id="agree1">
		</fieldset>

		<br />

		<div class="btn_confirm">
			<input type="submit" value="이벤트 참여하기" id="btn_submit" accesskey="s" class="btn_submit">
		</div>
		<?}else{?><!-- 수정 상태일때 -->
		휴대폰번호 : <input type="text" name="wr_2" id="wr_2" value="<?=$write['wr_2']?>">

		<div class="btn_confirm">
			<input type="submit" value="수정하기" id="btn_submit" accesskey="s" class="btn_submit2">
		</div>
		<?}?>

		<script>
		var cert = "";
		//인증요청버튼 누르면
		$("#cert_btn").click(function (){
			var tg = $(this);//인증요청버튼 값을 담는다
			var wr_1 = $("#wr_1").val();//넘어온 이벤트명을 담는다.
			var mb_hp = $("#wr_2").val();//휴대폰번호를 담는다.
			
			//휴대폰번호 입력확인
			if(!mb_hp){
				alert("휴대폰번호를 입력해주세요.");
				return false;
			}

			//해당 번호 조회
			$.post(g5_bbs_url + "/ajax.hp_check.php",{ wr_1:wr_1, mb_hp:mb_hp }, function (result){
				if(result.status == "false"){
					alert("고객님께서는 이미 이벤트에 참여 하셔서 중복 참여가 불가합니다.");
					return false;
				}

				//문자전송 및 카운트 시작
				alert("문자를 전송중입니다. 3분 이내로 인증번호를 입력해주세요.");
				cert = result.cret;
				var second = 180;
				
				//인증번호받기 버튼 비활성화
				tg.attr("disabled", "disabled");
				setTimeout(function (){
					tg.removeAttr("disabled");//시간 끝나면 다시 버튼 활성화
				}, 30000);
				
				//인증번호 입력 및 카운트 보이기
				$("#cert_dl").removeClass("none");
				
				//타이머
				var si = setInterval(function (){

					$("#cert_second").html(second);
					second--;
					
					if(second < 0){
						clearInterval(si);
						cert = "over";
					}
				}, 1000);
			}, "json");
		});
		
		//인증확인 버튼 클릭시
		$("#cert_btn2").click(function (){
			//인증시간이 지나면
			if(cert == "over"){
				$("#mb_cert_txt").html("인증가능한 시간이 지났습니다.");
				//$("#mb_cert_i").removeClass("green-font").addClass("red-font");
				return false;
			}
			
			//인증번호값
			var mb_cert = $("#reg_mb_cert").val();
			
			//인증번호 비교
			if(mb_cert != cert){
				alert("인증번호를 다시 확인하시고 참여 바랍니다");
				//$("#mb_cert_txt").html("인증번호가 틀립니다.");
				//$("#mb_cert_i").removeClass("green-font").addClass("red-font");
				return false;
			}
			
			//인증완료 시
			$("#mb_cert_txt").html("");//설명문구 지우기
			$("#cert_dd_cnt").html("");//카운트 지우기
			$("#cert_dd_btn").addClass("none");//인증확인버튼 지우기			
			//$("#mb_cert_i").removeClass("red-font").addClass("green-font");
			$("#mb_cert").attr("readonly", "readonly");//인증번호 입력박스 지우기
			$("#cert_btn").attr("disabled", "disabled");//인증번호받기 버튼 비활성화
			$("#cert_dd_chk").removeClass("none");//인증되었습니다 문구 띄우기
			$("#status_chk").val("complete");//인증상태 complete로 변경
		});
		</script>
		
		<br />

		</form>
	</div>

    <script>
	$('#wr_6').change(function() {
		$('input[name=wr_5]').val($(this).val());
	});
	
    function fwrite_submit(f)
    {
		if (f.status_chk.value != "complete") {
            alert("휴대폰번호 인증 후 가능합니다.");
            f.status_chk.focus();
            return false;
        }

		if (!f.agree1.checked) {
            alert("개인정보 수집 동의를 하지 않으시면 이벤트 참여가 불가 합니다.");
            f.agree1.focus();
            return false;
        }

        document.getElementById("btn_submit").disabled = "disabled";
        return true;
    }
    </script>
    </div>
</section>
<!-- } 게시물 작성/수정 끝 -->