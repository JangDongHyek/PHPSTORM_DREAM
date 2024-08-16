<?
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css?v='.G5_CSS_VER.'">', 0);

// 제휴회원
$mb_group = (int)$_GET['mb_group'];
if (!array_key_exists($mb_group, $partner_chk)) {
	alert('잘못된 접근입니다.');
}

// 가입비
$mb_bank_amt = $config['cf_3'];

// 타이틀
$regi_title = $partner_chk[$mb_group]." 제휴 회원가입";

// 스코피인 경우
$partner_data = array();

if ($mb_group == 3) {
	$tmp_url1 = explode("?", $_SERVER['REQUEST_URI']);
	$tmp_url2 = explode("&", $tmp_url1[1]);
	foreach($tmp_url2 as $key=>$val) {
		$tmp_url3 = explode("=", $val);
		$partner_data[$tmp_url3[0]] = $tmp_url3[1];
	}

	// 중복가입 확인
	$rs = sql_fetch("SELECT COUNT(*) as cnt FROM g5_member WHERE skopi_memberCd = '{$partner_data['memberCd']}'");
	$reg_cnt = (int)$rs['cnt'];
	if ($reg_cnt > 0) {
		alert('이미 가입된 회원정보가 존재합니다. 로그인 페이지로 이동합니다.', G5_BBS_URL."/login.php");
	}
}

?>

<div id="wrapper">
	<!--서브상단비주얼시작-->
	<div id="svisual" class="wow fadeInDown" data-wow-delay="0.1s">
		<div class="svisual_in">
		<div class="s_text"></div><!--//s_text-->
		</div><!--//svisual_in-->
	</div><!--//svisual-->
	<!--서브상단비주얼끝-->
    
	<div class="container" style="padding:40px 0 0;">
		<h1 id="container_title">회원 가입<p>합리적인 장례/상례 소비문화를 선도합니다.</p></h1>
	</div>

	<div id="container" class="container">
		<script src="<?=G5_JS_URL ?>/jquery.register_form.js"></script>

		<div class="mbskin">
			<form name="fregisterform" id="fregisterform" action="<?=$register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" name="w" value="">
			<!-- 회원구분 -->
			<input type="hidden" name="mb_group" value="<?=$mb_group?>">
			<!-- 가입비 -->
			<input type="hidden" name="mb_bank_amt" value="<?=$mb_bank_amt?>">

			<!-- 스코피 -->
			<input type="hidden" name="skopi_memberCd" value="<?=$partner_data['memberCd']?>">
			<input type="hidden" name="skopi_seqNo" value="<?=$partner_data['seqNo']?>">


			<div class="tbl_frm01 tbl_wrap">
				<table>
				<h3 class="join_title"><?=$regi_title?></h3><!--회원가입 구분-->
				<caption>사이트 이용정보 입력</caption>
				<tr>
					<th scope="row"><label for="reg_mb_id">아이디<strong class="sound_only">필수</strong></label></th>
					<td>
						<input type="text" name="mb_id" value="" id="reg_mb_id" class="frm_input" placeholder="영문자, 숫자 4~20자" minlength="4" maxlength="20" required>
						<span id="msg_mb_id"></span>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="reg_mb_password">비밀번호<strong class="sound_only">필수</strong></label></th>
					<td><input type="password" name="mb_password" id="reg_mb_password" class="frm_input" minlength="4" maxlength="20" required></td>
				</tr>
				<tr>
					<th scope="row"><label for="reg_mb_password_re">비밀번호 확인<strong class="sound_only">필수</strong></label></th>
					<td><input type="password" name="mb_password_re" id="reg_mb_password_re" class="frm_input" minlength="4" maxlength="20" required></td>
				</tr>
				</table>
			</div>

			<div class="tbl_frm01 tbl_wrap">
				<table>
				<caption>개인정보 입력</caption>
				<tr>
					<th scope="row"><label for="reg_mb_name">이름<strong class="sound_only">필수</strong></label></th>
					<td><input type="text" id="reg_mb_name" name="mb_name" value="" maxlength="20" class="frm_input" required></td>
				</tr>
				
				<tr>
					<th scope="row"><label for="mb-sex1">성별<strong class="sound_only">필수</strong></label></th>
					<td>
						<input type="radio" name="mb_sex" id="mb-sex1" value="남" required>
						<label for="mb-sex1"> 남성</label>&nbsp;&nbsp;
						<input type="radio" name="mb_sex" id="mb-sex2" value="여">
						<label for="mb-sex2"> 여성</label>
					</td>
				</tr>
					
				<tr>
					<th scope="row"><label>생년월일<strong class="sound_only">필수</strong></label></th>
					<td>
						<select class="frm_sel" name="mb_year" id="mb_year" required>
							<option value="">년도</option>
							<? for ($tmp = date('Y'); $tmp >= 1900; $tmp--) { ?>
							<option value="<?=$tmp?>"><?=$tmp?></option>
							<? } ?>
						</select>
						<select class="frm_sel" name="mb_month" id="mb_month" required>
							<option value="">월</option>
							<? for ($tmp = 1; $tmp <= 12; $tmp++) { ?>
							<option value="<?=sprintf('%02d', $tmp)?>"><?=$tmp?></option>
							<? } ?>
						</select>
						<select class="frm_sel" name="mb_day" id="mb_day" required>
							<option value="">일</option>
							<? for ($tmp = 1; $tmp <= 31; $tmp++) { ?>
							<option value="<?=sprintf('%02d', $tmp)?>"><?=$tmp?></option>
							<? } ?>
						</select>
					</td>
				</tr>
			 
				<tr>
					<th scope="row"><label for="reg_mb_email">E-mail<strong class="sound_only">필수</strong></label></th>
					<td>
						<input type="hidden" name="old_email" value="">
						<input type="hidden" name="mb_email" id="reg_mb_email" value="">
						<?
						$em_direct_input = ($w == "")? true : false;

						/*if ($member['mb_email'] && $w == "u") {
							$mb_email_arr = explode("@", $member['mb_email']);

							if (!in_array($mb_email_arr[1], $regist_email)) {
								$em_direct_input = true;
							}
						}*/
						?>
						<input type="text" name="mb_email_head" maxlength="30" class="frm_input mailbox" value="" required>
						@ 
						<input type="text" name="mb_email_tail" maxlength="30" class="frm_input mailbox" value="" <? if (!$em_direct_input) echo "readonly";?> required>
						<select name="mb_email_sel" id="mb_email_sel" class="frm_sel mailbox">
							<option value="" <? if ($em_direct_input) echo "selected";?>>직접입력</option>
							<? for ($e = 0; $e < count($regist_email); $e++) { ?>
							<option value="<?=$regist_email[$e]?>"><?=$regist_email[$e]?></option>
							<? } ?>
						</select>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="reg_mb_hp">휴대폰번호</label></th>
					<td><input type="text" name="mb_hp" value="" id="reg_mb_hp" required class="frm_input f_hp" maxlength="15"></td>
				</tr>
				
				<?/*
				<tr>
					<th scope="row"><label for="reg_mb_tel">전화번호<?php if ($config['cf_req_tel']) { ?><strong class="sound_only">필수</strong><?php } ?></label></th>
					<td><input type="text" name="mb_tel" value="<?=get_text($member['mb_tel']) ?>" id="reg_mb_tel" class="frm_input <?=$config['cf_req_tel']?"required":""; ?>" maxlength="20" <?=$config['cf_req_tel']?"required":""; ?>></td>
				</tr>
				*/?>

				<tr>
					<th scope="row"><label for="reg_mb_zip">주소<strong class="sound_only">필수</strong></label></th>
					<td>
						<?
						$addr_event = "win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', '', '');";
						?>
						<!-- 주소 -->
						<input type="text" name="mb_zip" value="" id="reg_mb_zip" class="frm_input" size="5" maxlength="6" onclick="<?=$addr_event?>" onkeyup="<?=$addr_event?>" placeholder="우편번호" required>
						<span class="add_sh"><button type="button" class="btn_frmline" id="btn_addr" onclick="<?=$addr_event?>">주소 검색</button></span><br />
						<input type="text" name="mb_addr1" value="" id="reg_mb_addr1" class="frm_input frm_address" size="50" placeholder="기본주소" readonly><br>
						<input type="text" name="mb_addr2" value="" id="reg_mb_addr2" class="frm_input frm_address" size="50" placeholder="상세주소">
					</td>
				</tr>
				
				<tr>
					<th scope="row"><label for="reg_mb_route">가입경로<strong class="sound_only">필수</strong></label></th>
					<td>
						<?
						$route_css = "display: none;";
						$regist_route[] = "직접입력";
						?>
						<select name="mb_route" id="reg_mb_route" class="frm_sel routebox" required>
							<option value="">선택하세요</option>
							<? foreach ($regist_route as $key=>$val) { ?>
							<option value="<?=$val?>"><?=$val?></option>
							<? } ?>
						</select>
						<span class="add_sh">
						<input type="text" name="mb_route_input" id="mb_route_input" class="frm_input recomm" style="width:30%;<?=$route_css?>" value="<?=$member['mb_route_input']?>" placeholder="대리점 or 추천단체 입력" maxlength="20">
						</span>
					</td>
				</tr>
				<?/*
				<tr>
					<th scope="row"><label>증정품 선택<strong class="sound_only">필수</strong></label></th>
					<td>
					<div class="rdo">
						<?
						$gift_list = getGiftList();
						foreach ($gift_list as $key=>$val) {
						?>
						<input type="radio" name="mb_gift_idx" id="mb_gift<?=$key?>" value="<?=$val['idx']?>" required><label for="mb_gift<?=$key?>"> <?=$val['gf_name']?></label>&nbsp;&nbsp;
						<? } ?>
					  </div>
					</td>
				</tr>

				<tr>
					<th scope="row"><label>증정품 주소<strong class="sound_only">필수</strong></label></th>
					<td>
						<?
						$addr_event2 = "win_zip('fregisterform', 'mb_gift_zip', 'mb_gift_addr1', 'mb_gift_addr2', '', '');";
						$same_chk = false;
						?>
						<div class="rdo">
						<input type="checkbox" name="chk_addr" id="chk_addr" onclick="getPostCopy(document.fregisterform);" <? if ($same_chk) echo "checked"; ?>>
						<label for="chk_addr">주소와 동일합니다.</label>
						</div>
						
						<!-- 증정품주소 -->
						<input type="text" name="mb_gift_zip" value="<?=$member['mb_gift_zip']; ?>" id="mb_gift_zip" class="frm_input" size="5" maxlength="6" onclick="<?=$addr_event2?>" onkeyup="<?=$addr_event2?>" placeholder="우편번호" required>
						<span class="add_sh"><button type="button" class="btn_frmline" onclick="<?=$addr_event2?>">주소 검색</button></span><br>
						<input type="text" name="mb_gift_addr1" value="<?=get_text($member['mb_gift_addr1']) ?>" class="frm_input frm_address" size="50" placeholder="기본주소" readonly><br>
						<input type="text" name="mb_gift_addr2" value="<?=get_text($member['mb_gift_addr2']) ?>" class="frm_input frm_address" size="50" placeholder="상세주소">
					</td>
				</tr>
				*/ ?>
				
				</table>
			</div>

			<? if ($w == "") { ?>
			<div class="tbl_frm01 tbl_wrap bankinfo">
				<table>
				<caption>개인정보 입력</caption>
				<tbody>
				<? /*
				<tr>
					<th scope="row"><label>결제방법<strong class="sound_only">필수</strong></label></th>
					<td><!-- 계좌번호 --><span class="bank"><?=$config['cf_1']?></span><!-- 예금주--><span class="info"><?=$config['cf_2']?></span></td>
				</tr>
				<tr>
					<th scope="row"><label>결제금액</label></th>
					<td><span class="price"><?=number_format($config['cf_3'])?>원</span> (가입비)</span></td>
				</tr>
				*/ ?>
				<tr>
					<th scope="row"><label for="mb_chk">이용약관</label></th>
					<td>
					<textarea readonly class="txtin"><?=get_text($config['cf_stipulation']) ?></textarea>
					<fieldset class="fregister_agree">
						<label for="agree11">이용약관 내용 동의</label>
						<input type="checkbox" name="agree" value="1" id="agree11" required>
					</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="mb_chk">개인정보<br class="visible-xs" />처리방침</label></th>
					<td>
					<textarea readonly class="txtin"><?=get_text($config['cf_privacy']) ?></textarea>        
					<fieldset class="fregister_agree">
						<label for="agree21">개인정보처리방침 내용 동의</label>
						<input type="checkbox" name="agree2" value="1" id="agree21" required>
					</fieldset>
					</td>
				</tr>
				</tbody>
				</table>
			</div>
			<? } ?>

			<div class="btn_confirm">
				<input type="submit" value="회원가입" id="btn_submit" class="btn_submit" accesskey="s">
				<!--<a href="<?=G5_URL; ?>/" class="btn_cancel">취소</a>-->
			</div>
			</form>
		</div>
	</div><!-- container End -->
</div>

<?
// 스코피인 경우 데이터 가져옴
if ($mb_group == 3) { 
?>
<script>
var url = "http://app.skopi.com/skopi/event/getHappyLifeMember.do";
var formData = <?php echo json_encode($partner_data)?>;

$(function() {
	$.ajax({
		dataType : 'jsonp',
		jsonpCallback: "callBack",
		url: url,
		async: false,
		type: "POST",
		data: formData,
		scriptCharset : 'UTF-8',
		success: function(data){  
			var result = data.map;
			var f = document.fregisterform;
			
			// 필수항목 없으면 못받아온거
			if (result == "") {
				alert("회원정보를 받아오는데 실패하였습니다. 다시 시도해 주세요.");
				location.href = "http://www.skopi.com/";
			}

			// 이름
			if (result.mb_name != "") {
				f.mb_name.value = decodeURIComponent(result.mb_name);
				f.mb_name.readOnly = true; //block
			}

			// 성별
			if (result.mb_sex != "") {
				decodeURIComponent(result.mb_sex) == "남"? $("#mb-sex1").prop("checked", true) : $("#mb-sex2").prop("checked", true);
				$("input[name=mb_sex]").prop('disabled', true);	//block
				//$("input[name=mb_sex]").attr("onclick", "return(false)"); 
			}

			// 생년월일
			if (result.mb_year != "" && result.mb_month != "" && result.mb_day != "") {
				$("#mb_year").val(result.mb_year).prop('disabled', true); //block
				$("#mb_month").val(result.mb_month).prop('disabled', true);
				$("#mb_day").val(result.mb_day).prop('disabled', true);
			}

			// 이메일주소
			if (result.mb_email_head != "" && result.mb_email_tail != "") {
				f.mb_email_head.value = result.mb_email_head;
				f.mb_email_tail.value = result.mb_email_tail;

				f.mb_email_head.readOnly = true; //block
				f.mb_email_tail.readOnly = true;
				$("#mb_email_sel").prop('disabled', true);
			}

			// 휴대폰번호
			if (result.mb_hp.length > 0) {
				f.mb_hp.value = result.mb_hp;
				f.mb_hp.readOnly = true; //block
			}

			// 주소
			if (result.mb_zip.length > 0 && result.mb_addr1.length > 0) {
				f.mb_zip.value = result.mb_zip;
				f.mb_addr1.value = decodeURIComponent(result.mb_addr1).replace(/[+]/gi, " ");
				if (result.mb_addr2.length > 0) {
					f.mb_addr2.value = decodeURIComponent(result.mb_addr2).replace(/[+]/gi, " ");
				}
				f.mb_zip.readOnly = true;	//block
				f.mb_addr1.readOnly = true;
				$("#reg_mb_zip, #btn_addr").attr("onclick", "");
			}
		},
		error: function(request,status,error){
			alert("회원정보를 받아오는데 실패하였습니다. 다시 시도해 주세요.");
			location.href = "http://www.skopi.com/";
		}
	});
});
</script>
<? } // end 스코피 ?>

<script>
$(function() {
	<? // maxlength ?>
	$("#fregisterform input[type=text]").on("input", function() {
		var maxleng = $(this).attr('maxlength'),
			val = $(this).val();
		if (val.length > maxleng && typeof maxleng != "undefined") {
			$(this).val(val.slice(0, maxleng));
		}
	});

	<? // 가입경로 ?>
	$("#reg_mb_route").on("change", function() {
		if ($(this).val() == "직접입력" || $(this).val() == "추천인") {
			$("#mb_route_input").show().focus();
		} else {
			$("#mb_route_input").hide().val("");
		}
	});

	<? // 이메일 tail ?>
	$("#mb_email_sel").on("change", function() {
		var sel = $(this).val(),
			f = document.fregisterform;

		if (sel == "") {
			f.mb_email_tail.readOnly = false;
			f.mb_email_tail.value = "";
			f.mb_email_tail.focus();
		} else {
			f.mb_email_tail.readOnly = true;
			f.mb_email_tail.value = sel;
		}
	});
});

// submit 최종 폼체크
function fregisterform_submit(f)
{
	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			alert(msg);
			f.mb_id.focus();
			return false;
		}
	}

	if (f.w.value == '') {
		if (f.mb_password.value.length < 4) {
			alert('비밀번호를 4자 이상 입력해 주세요.');
			f.mb_password.focus();
			return false;
		}
	} 

	if (f.mb_password.value != f.mb_password_re.value) {
		alert('비밀번호가 같지 않습니다.');
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 4) {
			alert('비밀번호를 4자 이상 입력해 주세요.');
			f.mb_password_re.focus();
			return false;
		}

		// 정보수정때 비밀번호변경시 기존비밀번호 확인
		if (f.w.value == 'u') {
			if (f.old_mb_password.value == "") {
				alert('비밀번호 변경시 기존 비밀번호를 입력해 주세요.');
				f.old_mb_password.focus();
				return false;

			} else {
				var chk_flag = false;

				$.ajax({  
					type : "post",  
					url : "./ajax.mb_password.php",
					data : {"pass" : f.old_mb_password.value},
					async: false,
					dataType : "text",  
					success : function(result) {  
						if (result == "T") {
							chk_flag = true;
						} else {
							alert('기존 비밀번호가 맞지 않습니다.');
						}
					},  
					error : function(xhr,status,error) {
						alert('기존 비밀번호 확인에 실패하였습니다. 다시 시도해 주세요.');
					}
				});

				if (!chk_flag) {
					return false;
				}
			}
		} // end w = "u"
	}

	// 이름 검사
	if (f.w.value=='') {
		if (f.mb_name.value.length < 1) {
			alert('이름을 입력해 주세요.');
			f.mb_name.focus();
			return false;
		}
	}
	
	// 이메일 검사
	if (f.mb_email_head.value != "" && f.mb_email_tail.value == "") {
		alert("E-mail 종류를 선택하세요.");
		f.mb_email_sel.focus();
		return false;
	}
	if (f.mb_email_head.value != "" && f.mb_email_tail.value != "") {
		f.mb_email.value = f.mb_email_head.value + "@" + f.mb_email_tail.value;
		/*
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.mb_email_head.focus();
			return false;
		}
		*/
	}

	// 휴대폰 검사
	if (f.mb_hp.value.length < 10) {
		alert("휴대폰 번호를 올바르게 입력해 주세요.");
		f.mb_hp.focus();
		return false;
	}

	// 우편물 주소
	if (f.mb_zip.value == "") {
		alert("우편물 주소를 입력해 주세요.");
		f.mb_zip.focus();
		return false;
	}
	if (f.mb_addr1.value == "") {
		alert("우편물 주소를 입력해 주세요.");
		f.mb_addr1.focus();
		return false;
	}

	// 가입경로 확인
	if ($("#reg_mb_route").length > 0) {
		if ($("#reg_mb_route").val() == "") {
			alert("가입경로를 선택해 주세요.");
			$("#reg_mb_route").focus();
			return false;
		}
		if ($("#reg_mb_route option:selected").val() == "직접입력" && $("#mb_route_input").val() == "") {
			alert("가입경로를 작성해 주세요.");
			$("#mb_route_input").focus();
			return false;
		}
	}
	/*
	// 정보수정시 비밀번호체크
	if (f.w.value == "u" && f.chk_mb_password.value == "") {
		alert("현재비밀번호를 입력해 주세요.");
		$("#chk_mb_password").focus();
		return false;
	}
	*/

	$("#mb_year").prop('disabled', false);
	$("#mb_month").prop('disabled', false);
	$("#mb_day").prop('disabled', false);
	$("input[name=mb_sex]").prop('disabled', false);

	document.getElementById("btn_submit").disabled = "disabled";
	return true;
}
</script>