<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css?ver=5">', 0);
//애플로그인 할 때 필요
if($_POST[mb_id]){
	$member[mb_id]=$_POST[mb_id];
}
//include_once($member_skin_path.'/mb.head.php');

// nice 신용 평가 추가
include_once(G5_BBS_PATH.'/nice/register.php');
?>
<style>
	body {
		background: #fff;
	}

	.box-article .box-body dd input{
		background: #f3f6fc !important;
	}
	.box-article .box-body dd select{
		background: #f3f6fc !important;
		color: #9eacc7;
		font-size: 1.02em;
		appearance:none;
	}
	#basic_modal .modal-content .msg_con{
		padding: 15px;
	}
	#basic_modal .modal-body h3{
		font-size: 1.1em;
	}
	#basic_modal .modal-body p{
		font-size: 0.9em;
	}
</style>

<!-- 메세지 모달팝업 -->
<div id="basic_modal">
	<!-- Modal -->
	<div class="modal fade" id="myModaregister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
					<h4 class="modal-title" id="myModalLabel">회원가입안내</h4>
				</div>
				<div class="modal-body msg_con">
					<h3>저희 앱은 어플특성상<br>본인을 증명할수 있는 <br>서류가 반드시 필요합니다.</h3>
					<p>
						서류외에는 본인신원 확인할수 없기에 <br>
						<span class="point01">마스크 뺀 얼굴 정면 사진 2장, <br>전신사진 1장, 본인의 MBTI,<br>혼인 관계 증명서(상세),<br>직업을 증명하는 서류<br>(졸업증.자격증.재직증명서 중 택1),<br>신분증</span>은<br>반드시 입력하셔야 승인처리 가능하시고, 활동하실수 있습니다. <br><br>
						<span class="bold">배우자를 만날수도 있는 공간</span>입니다. 신중하게 작성해주세요.<br>
						<span class="color">
							프로필변경시 관리자의 관리하에 변경됩니다.
						</span>
					<p>
				</div>
				<!--msg_con-->
			</div>
		</div>
	</div>
</div>
<!--basic_modal-->
<!-- 메세지 모달팝업 -->


<!-- 회원가입시작 { -->
<div class="mbskin">
	<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
	<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
	<script src="<?php echo G5_JS_URL ?>/certify.js"></script>
	<?php } ?>

	<form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
		<input type="hidden" name="w" value="<?php echo $w;?>">

		<input type="hidden" name="mb_level" id="mb_level" value="<?php if($w == '') { echo $mb_level; } else { echo $member['mb_level']; } ?>">
		<input type="hidden" name="join_type" id="join_type" value="<?=$join_type?>"> <!-- 가입유형 -->
		<input type="hidden" name="secret_member" id="secret_member" value="<?=$secret_member?>"> <!-- 시크릿회원여부 -->
		<input type="hidden" name="disab_type1" id="disab_type1">
		<input type="hidden" name="disab_type2" id="disab_type2">
		<input type="hidden" name="delete_yn" id="delete_yn">
		<input type="hidden" name="token" id="token"> <!-- 21.03.08 푸시알림 -->
		<input type="hidden" name="mb_certify" id="mb_certify" value="<?php if($w == 'u') { echo $member['mb_certify']; } else { echo $_POST['mb_certify']; } ?>"> <!-- 인증수단 -->
		<input type="hidden" name="mb_sex" value="<?=$member['mb_sex']?>">

		<h2 class="title_top">신실한 연애의 첫 걸음,<strong><span class="point">크리스찬시그널</span>과 함께 하세요.</strong></h2>
		<div class="regi_info">
			<p>
				입력하시는 모든 내용은 회원에게 전체공개되는 내용입니다.<br>
				신중하고 정확한 입력부탁드립니다.
			</p>
<!--			<span>준비 : 얼굴 정면사진 2장, 전신사진 1장 (꼭 필요합니다.)</span>-->
		</div>
		<article class="box-article">
			<div id="join_info">
				<h2><?php if($w == ""){ ?>회원정보 입력
					<? }else { ?>회원정보 확인 및 수정<?php } ?> <p><span style="color:#fb2323;">*</span> 필수입력</p>
				</h2>
				<div class="box-body">
					<dl class="row phn">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-9">
							<label for="reg_mb_hp">휴대폰번호 입력</label>
							<input type="tel" <?php if($w == "") { ?> onclick="nice_certify('1');" <?php } ?> name="mb_hp" value="<?php if($w=='u') { echo $member['mb_hp']; } else { echo $_POST['mb_hp']; } ?>" id="reg_mb_hp" class="regist-input" placeholder="휴대폰번호 입력" style="font-size:0.95em;" minlength="10" maxlength="13" readonly>
						</dd>
						<dd class="status_ico<?php if($w=="u" || !empty($_POST['mb_birth'])) echo " pas"?>"><i class="fas fa-check"></i></dd>
						<?php if($w == "") { ?><dd class="col-xs-3"><input type="button" id="injung-btn" class="phn_in" value="인증하기" <?php if($w == "") { ?> onclick="nice_certify('1');" <?php } ?>></dd>
						<? } ?>
					</dl>
					<span class="info_txt">※ <i>나이스평가정보</i>에서 인증받은 휴대전화번호를 사용하고 있습니다.</span>

					<dl class="row">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">
							<label for="reg_mb_name">본인의 성함 입력</label>
							<input type="text" name="mb_name" value="<?php if($w=='u') { echo $member['mb_name']; } else { echo urldecode($_POST['mb_name']); } ?>" id="reg_mb_name" class="regist-input" placeholder="실명" readonly>
						</dd>
						<dd class="status_ico<?php if($w=="u" || !empty($_POST['mb_birth'])) echo " pas"?>""><i class=" fas fa-check"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row gend">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-6">
							<input type="radio" id="gendFemale" name="reg_mb_sex" checked="checked" value="여" <?php if($w=="u") echo "disabled";?> disabled>
							<label for="gendFemale">여 성</label>
						</dd>
						<dd class="col-xs-6">
							<input type="radio" id="gendMale" name="reg_mb_sex" value="남" <?php if($w=="u") echo "disabled";?> disabled>
							<label for="gendMale">남 성</label>
						</dd>
					</dl>

					<dl class="row">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">
							<label for="reg_mb_birth">생년월일 입력</label>
							<input type="text" name="mb_birth" value="<?php if($w=='u') { echo $member['mb_birth']; } else { echo $_POST['mb_birth']; } ?>" id="reg_mb_birth" class="regist-input" placeholder="생년월일" minlength="8" maxlength="8" readonly>
						</dd>
						<dd class="status_ico <?php if($w=="u" || !empty($_POST['mb_birth'])) echo "pas"?>""><i class=" fas fa-check"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row"></dl>
					<dl class="row"></dl>

					<dl class="row row_mb_id">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">
							<label for="reg_mb_id">아이디 입력</label>
							<input type="text" name="mb_id" value="<?php if($w=='u') { echo $member['mb_id']; } else { echo $_POST['mb_id']; } ?>" id="reg_mb_id" class="regist-input <?php if($w=="u") echo "readonly";?>" <?php if($w=="u") echo "readonly";?> placeholder="아이디 입력">
						</dd>
						<dd class="status_ico<?php if($w=="u") echo " pas"?>"><i class="fas fa-check"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>
                    <dl class="row row_mb_nick">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-11">
                            <label for="reg_mb_nick">닉네임 입력</label>
                            <input type="text" name="mb_nick" value="<?php if($w=='u') { echo $member['mb_nick']; } else { echo $_POST['mb_nick']; } ?>" id="reg_mb_nick" class="regist-input" placeholder="닉네임 입력(한글만)">
                        </dd>
                        <dd class="status_ico<?php if($w=="u") echo " pas"?>"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>

                    <script>
                        $(function(){
                            $("#reg_mb_nick").keyup(function (event) {
                                regexp = /[a-z0-9]|[ \[\]{}()<>?|`~!@#$%^&*-_+=,.;:\"'\\]/g;
                                v = $(this).val();
                                if (regexp.test(v)) {
                                    alert("한글만 입력가능 합니다.");
                                    $(this).val(v.replace(regexp, ''));
                                }
                            });
                        });
                    </script>

					<dl class="row">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">
							<label for="reg_mb_password">비밀번호 입력</label>
							<input type="password" name="mb_password" value="<?php if($w=='') { echo $_POST['mb_password']; } ?>" id="reg_mb_password" class="regist-input" placeholder="<?php if($w=="u") echo '비밀번호 변경'; else echo '비밀번호 입력' ?>">
						</dd>
						<dd class="status_ico lock_ico1"><i class="fas fa-lock-open"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">
							<label for="mb_password_re">비밀번호 확인</label>
							<input type="password" name="mb_password_re" value="<?php if($w=='') { echo $_POST['mb_password_re']; } ?>" id="reg_mb_password_re" class="regist-input" placeholder="비밀번호 확인">
						</dd>
						<dd class="status_ico lock_ico2"><i class="fas fa-lock"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<?php if(strpos($_SERVER['HTTP_USER_AGENT'],"OSnaim")){?>
					<!--<dl class="row ioss">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
						<a href="javascript:click_set_initlocate()" class="my_map"><i class="fas fa-map-marker-alt"></i> 현 주소가져오기</a>
                        
						<input type="hidden" name="mb_zip" value="<?php /*echo $member['mb_zip1'].$member['mb_zip2']; */?>" id="reg_mb_zip" <?php /*echo $config['cf_req_addr']?"required":""; */?> class="frm_input <?php /*echo $config['cf_req_addr']?"required":""; */?>" size="5" maxlength="6">
						<button type="button" class="btn_frmline" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
						<label for="reg_mb_addr1" class="sound_only">주소<?php /*echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; */?></label>
						<input type="text" name="mb_addr1" value="<?php /*echo get_text($member['mb_addr1']) */?>" id="reg_mb_addr1" <?php /*echo $config['cf_req_addr']?"required":""; */?> class="frm_input frm_address <?php /*echo $config['cf_req_addr']?"required":""; */?>" size="50"><br>
						<label for="reg_mb_addr2" class="sound_only">상세주소</label>
						<input type="text" name="mb_addr2" value="<?php /*echo get_text($member['mb_addr2']) */?>" id="reg_mb_addr2" class="frm_input frm_address" size="50">
						<br>
						<label for="reg_mb_addr3" class="sound_only">참고항목</label>
						<input type="text" name="mb_addr3" value="<?php /*echo get_text($member['mb_addr3']) */?>" id="reg_mb_addr3" class="frm_input frm_address" size="50" readonly="readonly">
						<input type="hidden" name="mb_addr_jibeon" value="<?php /*echo get_text($member['mb_addr_jibeon']); */?>">
						
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>-->
					<?php }?>

					<dl class="row my_int">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">
							<label for="mb_introduce">상대방에게 나를 어필하는 한마디</label>
							<select name="mb_introduce" id="mb_introduce" class="regist-input">
								<option value="" selected>나를 어필할 수 있는 소개글 선택</option>
								<option value="안녕하세요">안녕하세요</option>
								<option value="반갑습니다">반갑습니다</option>
								<option value="좋은분 만나고 싶어요">좋은분 만나고 싶어요</option>
								<option value="직접입력">직접입력</option>
							</select>
							<input type="text" style="display: none" name="mb_introduce_memo" value="<?php if($w=='u') { echo $member['mb_introduce']; } else { echo $_POST['mb_introduce']; } ?>" id="mb_introduce_memo" class="regist-input" placeholder="나를 어필할 수 있는 소개글 입력">
						</dd>
						<dd class="status_ico" style="font-size:1em;"><i class="fas fa-angle-down"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>
                    <?php if($w== '') { ?>
                    <dl class="row my_int">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-11">
                            <label for="mb_1">가입경로</label>
                            <input type="text" name="mb_1" value="<?php if($w=='u') { echo $member['mb_1']; } ?>" id="mb_1" class="regist-input" placeholder="가입경로 ex) 네이버 블로그">
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>
                    <?php }?>
                    
                    <dl class="row my_int">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-11">
                            <label for="mb_1">추천인</label>
                            <input type="text" name="mb_recommend" value="<?php if($w=='u') { echo $member['mb_recommend']; } ?>" id="mb_recommend" class="regist-input" placeholder="추천인(이름) 입력">
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>

                    <dl class="row my_int">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-11">
                            <label for="mb_1">추천인 연락처</label>
                            <input type="text" name="mb_recommend_hp" value="<?php if($w=='u') { echo $member['mb_recommend_hp']; } ?>" id="mb_recommend_hp" class="regist-input" placeholder="추천인(연락처) 입력" maxlength="13" required>
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>
                    <span class="info_txt">※ <i>추천인 연락처</i>를 반드시 기재하셔야 합니다</span>

                    <!--초혼 가입시 나타나는 항목-->
					<?php if($join_type == '초혼') { ?>
					<div class="add_type">
						<div class="title">* 배우자 희망사항</div>
						<ul class="add_type_radio">
							<li>
								<input type="radio" id="type1_first" name="join_type_de" checked="checked" value="first">
								<label for="type1_first">초혼을 원함</label>
							</li>
							<li>
								<input type="radio" id="type1_all" name="join_type_de" value="all">
								<label for="type1_all">초혼/재혼 둘다 상관없음</label>
							</li>
						</ul>
					</div>
					<?php } ?>

					<!--재혼 또는 장애인 가입시 나타나는 항목-->
					<?php if($join_type == '재혼' || $join_type == '장애인') { ?>
					<div class="add_type">
						<div class="title">* 배우자 희망사항</div>
						<ul class="add_type_radio">
							<li>
								<input type="radio" id="type2_first" name="join_type_de" checked="checked" value="first">
								<label for="type2_first">초혼을 원함</label>
							</li>
							<li>
								<input type="radio" id="type2_second" name="join_type_de" value="second">
								<label for="type2_second">재혼을 원함</label>
							</li>
							<li>
								<input type="radio" id="type2_all" name="join_type_de" value="all">
								<label for="type2_all">초혼/재혼 둘다 상관없음</label>
							</li>
						</ul>
					</div>
					<?php } ?>

					<!--장애인 가입시 추가로 나타나는 항목-->
					<?php if($join_type == '장애인') { ?>
					<div class="add_type">
						<div class="title">* 장애유형을 선택해 주세요.<span>다중선택 가능</span></div>
						<div class="sel cf">
							<!--장애유형 다중선택 가능하게..-->
							<span class="type">
								<select id="se_disab_type" onchange="type_change(this.value);">
									<option value="">장애유형 선택</option>
									<option value="지체장애">지체장애</option>
									<option value="뇌병변장애">뇌병변장애</option>
									<option value="시각장애">시각장애</option>
									<option value="청각장애">청각장애</option>
									<option value="언어장애">언어장애</option>
									<option value="지적장애">지적장애</option>
									<option value="정신장애">정신장애</option>
									<option value="자폐성장애">자폐성장애</option>
									<option value="신장장애">신장장애</option>
									<option value="심장장애">심장장애</option>
									<option value="호흡기장애">호흡기장애</option>
									<option value="간장애">간장애</option>
									<option value="안면변형장애">안면변형장애</option>
									<option value="장루·요루장애">장루·요루장애</option>
									<option value="뇌전증(구.간질)장애">뇌전증(구.간질)장애</option>
								</select>
							</span>
							<span class="type">
								<select id="se_disab_type2" onchange="type_change2(this.value);">
									<option value="">장애급수 선택</option>
									<option value="1급">1급</option>
									<option value="2급">2급</option>
									<option value="3급">3급</option>
									<option value="4급">4급</option>
									<option value="5급">5급</option>
									<option value="6급">6급</option>
								</select>
							</span>
						</div>
						<!--sel-->

						<div class="select_result">
							<?php
                        $count = sql_fetch(" select count(*) as count from g5_member_disabled where mb_no = {$member['mb_no']}; ")['count'];

                        $sql = " select * from g5_member_disabled where mb_no = {$member['mb_no']} order by idx ";
                        $result = sql_query($sql);

                        for($i=0; $row=sql_fetch_array($result); $i++) {
                        ?>
							<div class="result result_<?=$i?>"><span class="a"><?=$row['disab_type1']?></span><span class="b"><?=$row['disab_type2']?></span><a class="del" onclick="del_disab_type('<?=$i?>');"><i class="fas fa-times-circle"></i></a></div>
							<?php
                        }
                        ?>
						</div>

					</div>
					<?php } ?>
					<!--장애인 가입시 추가로 나타나는 항목-->

					<!--<dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_email">E-mail</label>
                        <input type="text" name="mb_email" id="reg_mb_email" class="regist-input <?php echo $required ?>" minlength="3" maxlength="50" <?php echo $required ?> placeholder="E-mail" value="<?php echo $member['mb_email']; ?>">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>-->

				</div>
			</div>
			<!--//join_info-->

			<?php if($w == ""){ ?>
			<div id="join_agr">
				<h2 class="hide">약관동의</h2>
				<div class="box-body agree allcheck">
					<dl class="row agree-row all">
						<dd class="col-xs-12 chk_ico" data-for="reg_all">
							<input type="checkbox" name="reg_all" id="reg_all" value="0" onclick="ag_check(this)">
							<label for="reg_all" class="title">약관전체동의</label>
							<!-- <i></i> 이용약관 동의 (필수) -->
						</dd>
					</dl>

					<dl class="row agree-row">
						<dd class="col-xs-8 chk_ico" data-for="reg_req1">
							<input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
							<label for="reg_req1">서비스 이용약관 동의 (필수)</label>
							<!-- <i></i> 이용약관 동의 (필수) -->
						</dd>
						<dd class="col-xs-4 text-right"><input type="button" value="보기" class="btn btn-agr"></dd>
						<dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
					</dl>

					<dl class="row agree-row">
						<dd class="col-xs-9 chk_ico" data-for="reg_req2">
							<input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
							<label for="reg_req2">개인정보처리방침 동의 (필수)</label>
							<!--<i></i> 개인정보처리방침 동의 (필수) -->
						</dd>
						<dd class="col-xs-3 text-right"><input type="button" value="보기" class="btn btn-agr"></dd>
						<dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
					</dl>

					<!--<dl class="agree-row">
                    <dd class=" chk_ico" data-for="reg_chk1">
                        <input type="checkbox" name="reg_chk[]" id="reg_chk1" value="">
                        <label for="reg_chk1">선택 동의 (선택)</label>
                        <i></i> 선택 동의 (선택) 
                    </dd>
                </dl>-->
				</div>
			</div>
			<!--//join_chk-->
			<?php } ?>

			<input type="submit" class="btn_submit ft_btn" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" accesskey="s">
			<!--<input type="button" class="btn_submit ft_btn" value="<?php /*echo $w==''?'회원가입':'정보수정'; */?>" accesskey="s" onclick="submit_check();">-->
		</article>
	</form>
</div>


<script>
	$(function() {
		if ('<?=$w?>' == '') {
			$('#myModaregister').modal('show');
		}

		// 배우자 희망사항 (수정 화면)
		if ('<?=$w?>' == 'u') {

		    //어필 한마디 직접입력인지
            var thevalue = '<?=$member['mb_introduce']?>';
            var exists = 0 != $('#mb_introduce option[value='+thevalue+']').length;
            if (exists){
                $("#mb_introduce").val(thevalue);
                $("#mb_introduce_memo").val("");

            }else{
                $("#mb_introduce_memo").css("display","inline");
                $("#mb_introduce").val('직접입력');
            }


			$("input[name='join_type_de']:radio[value='<?=$member['mb_join_type_de']?>']").attr("checked", true);
		} else {
			$("input[name='join_type_de']:radio[value='<?=$_POST['join_type_de']?>']").attr("checked", true)
		}
	});

	function ag_check(obj) {
		if (obj.value == "0") {
			obj.value = "1";
		} else {
			obj.value = "0";
		}
	}

	function click_set_initlocate() {


		webkit.messageHandlers.scriptHandler.postMessage("1");


		// var lat = 37.5453842026006;
		// var lon = 126.940228965734;

		// set_initlocate(lat,lon);
	}

	function ios_set_initlocate(cname, lat, lon) {
		$("#reg_mb_addr1").val(cname);
	}
	var isIdCheck = <?php echo $w=='' ? 'false' : 'true' ?>;
	var isNickCheck = <?php echo $w=='' ? 'false' : 'true' ?> ;
	$(function() {
		// 정보 수정 - 성별
		if ('<?=$w?>' == 'u') {
			$("input:radio[name='reg_mb_sex']").removeAttr("checked");
			$("input:radio[name='reg_mb_sex']:radio[value='<?=$member['mb_sex']?>']").prop('checked', true);
		} else {
			if ('<?=$_POST['mb_sex']?>' != '') {
				if ('<?=$_POST['mb_sex']?>' == '0') {
					var mb_sex = '여';
				} else {
					var mb_sex = '남';
				}
				$("input:radio[name='reg_mb_sex']").removeAttr("checked");
				$("input:radio[name='reg_mb_sex']:radio[value='" + mb_sex + "']").prop('checked', true);
				$('input[name="mb_sex"]').val(mb_sex); // form
			}
		}

		//전체동의 체크 클릭시
		$("#reg_all").click(function() {
			$("#reg_req1").prop("checked", $(this).prop("checked"));
			$("#reg_req2").prop("checked", $(this).prop("checked"));
		});

		// 아이디 체크
        <?php if ($w == ""){ ?>
		$("#reg_mb_id").keyup(function() {
			var mb_id = $(this).val();
			var reg_mb_id = $(this);

			// 아이디 정규표현식
			var regId = /^[ㄱ-ㅎㅏ-ㅣ가-힣a-z0-9]{4,12}$/;
			if (regId.test(mb_id)) {
				$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
				$(this).parents(".row").find(".error").html("");
				isIdCheck = true;
			} else {
				$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				$(this).parents(".row").find(".error").addClass("on").html("아이디는 영문과 숫자,한글 4 ~ 12자리까지 가능합니다.");
				isIdCheck = false;
				return false;
			}

			// 아작스로 중복 아이디가 있는지 체크 1
			$.post(g5_bbs_url + "/ajax.mb_id.php", {
				"reg_mb_id": mb_id
			}, function(result) {
				if (result == '') { // ajax.mb_id.php 의 die($msg); 값을 가져옴
					reg_mb_id.parents(".row").find(".status_ico").removeClass("err").addClass("pas"); //될때 초록색 박스 i 는 icon 의 약자
					reg_mb_id.parents(".row").find(".error").html(""); // 마지막 dd 의 css 스타일 사용
					isIdCheck = true;
				} else {
					reg_mb_id.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
					reg_mb_id.parents(".row").find(".error").addClass("on").html(result);
					isIdCheck = false;
				}
			});
		});
        <?php } ?>


        $("#reg_mb_nick").keyup(function (){
            var mb_nick = $(this).val();
            var mb_id = $('#reg_mb_id').val();
            var reg_mb_nick = $(this);

            $.post(g5_bbs_url+"/ajax.mb_nick.php", {"reg_mb_id":mb_id, "reg_mb_nick":mb_nick}, function (result){
                if(result == ""){
                    reg_mb_nick.parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                    reg_mb_nick.parents(".row").find(".error").html("");
                    isNickCheck = true;

                }else{
                    reg_mb_nick.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                    reg_mb_nick.parents(".row").find(".error").addClass("on").html(result);
                    isNickCheck = false;
                }
            });
        });

		$("#reg_mb_password").keyup(function() {
			var mb_password = $(this);
			var mb_password_re = $("#reg_mb_password_re");
			var state = mb_password.parents(".row").find(".status_ico");
			var err = mb_password.parents(".row").find(".error");

			if (mb_password.val() != "" && mb_password_re.val() != "") {
				// 바뀌면 무조건 틀렸다로 표시.
				if (mb_password_re.val() != mb_password.val()) {
					state.removeClass("pas").addClass("err");
					err.addClass("on").html("비밀번호가 다릅니다.");
				} else {
					state.removeClass("err").addClass("pas");
					err.html("");
				}
			} else if (mb_password.val().length < 4) {
				state.removeClass("pas").addClass("err");
				err.addClass("on").html("비밀번호를 4자 이상 입력해 주세요.");
			} else {
				state.removeClass("err").addClass("pas");
				err.html("");
			}
		});

		$("#reg_mb_password_re").keyup(function() {
			var mb_password_re = $(this).val();
			var mb_password = $("#reg_mb_password").val();

			// 비밀번호 정규표현식
			var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

			if (mb_password == mb_password_re) {
				$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
				$(this).parents(".row").find(".error").html("");
			} else {
				$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				$(this).parents(".row").find(".error").addClass("on").html("비밀번호가 다릅니다.");
			}
		});

		$("#reg_mb_name").keyup(function() {
			var mb_name = $(this).val();
			var reg_mb_name = $(this);

			// 이름 정규표현식
			var regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

			if (regName.test(mb_name)) {
				$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
				$(this).parents(".row").find(".error").html("");
			} else {
				$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				$(this).parents(".row").find(".error").addClass("on").html("2글자 이상 한글만 입력해주세요.");
			}
		});

		$("#reg_mb_birth").keyup(function() {
			var mb_birth = $(this).val();

			var year = mb_birth.substr(0, 4); // 년
			var month = mb_birth.substr(4, 2); // 월
			var day = mb_birth.substr(6, 2) // 일
			var lastDay = new Date(year, month, 0).getDate(); // 월의 마지막 일자

			// 생년월일 정규표현식
			var regBirth = /^([0-9]{4})([0-9]{2})([0-9]{2})$/;

			if (regBirth.test(mb_birth) && day <= lastDay) {
				$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
				$(this).parents(".row").find(".error").html("");
			} else {
				$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				$(this).parents(".row").find(".error").addClass("on").html("생년월일을 다시 입력해주세요. (예 : 19870516)");
			}
		});

		$("#reg_mb_hp").keyup(function() {
			var mb_hp = $(this).val();
			var reg_mb_hp = $(this);
			// 휴대폰 정규표현식
			var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;

			if (regHp.test(mb_hp)) {
				$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
				$(this).parents(".row").find(".error").html("");
			} else {
				$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				$(this).parents(".row").find(".error").addClass("on").html("휴대폰 번호는 10 ~ 12자리 숫자만 입력하세요.");
			}
		});

        $("#mb_recommend_hp").keyup(function() {
            var mb_hp = $(this).val();
            var reg_mb_hp = $(this);
            // 휴대폰 정규표현식
            var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;

            if (regHp.test(mb_hp)) {
                $(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row").find(".error").html("");
            } else {
                $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row").find(".error").addClass("on").html("휴대폰 번호는 10 ~ 13자리 숫자만 입력하세요.");
            }
        });

        $('#mb_recommend_hp').keydown(function (event) {
            var key = event.charCode || event.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 8) {
                    $text.val($text.val() + '-');
                }
            }

            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
            // Key 8번 백스페이스, Key 9번 탭, Key 46번 Delete 부터 0 ~ 9까지, Key 96 ~ 105까지 넘버패트
            // 한마디로 JQuery 0 ~~~ 9 숫자 백스페이스, 탭, Delete 키 넘버패드외에는 입력못함
        })

		$("#mb_introduce_memo").keyup(function() {
			var mb_introduce = $(this).val();
			var reg_mb_introduce = $(this);

			var content = mb_introduce;

			if (content.length > 100) {
				// $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				$(this).val(content.substring(0, 100));
				$(this).parents(".row").find(".error").addClass("on").html("100 / 최대 100자");
			} else {
				$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
				$(this).parents(".row").find(".error").html("" + content.length + " / 최대 100자");
			}
		});

		// 내용보기
		$(".btn-agr").click(function() {
			var dis = $(this).parents(".row").find(".agr_textarea").css("display");
			if (dis == "none")
				$(this).parents(".row").find(".agr_textarea").slideDown(100);
			else
				$(this).parents(".row").find(".agr_textarea").slideUp(100);
		});

		// 약관동의
		$(".agree-row dd:first-child").click(function() {
			var ford = $(this).data("for");
			var targ = $("#" + ford);

			if (targ.val() == "1") {
				$(this).find("i").removeClass("nochk").addClass("chk");
				//targ.val("0");
			} else {
				$(this).find("i").removeClass("chk").addClass("nochk");
				//targ.val("1");
			}
		});
	});

	function only_number(num) {
		num = num + "";
		num = num.replace(/[^0-9]/gi, "");
		return num;
	}

	// submit 최종 폼체크
	function fregisterform_submit(f) {
		submit_check();

		// 필수 체크박스
		// 조건들 확인


		// 휴대폰번호 검사
		if (f.w.value == '') {
			if (f.mb_hp.value.length < 1) {
				swal('휴대폰번호를 입력하십시오.');
				return false;
			}
		}

		// 회원아이디 검사
		if (f.w.value == "") {
			// 아작스로 중복 아이디가 있는지 체크 1
			// 아이디 정규표현식
			var regId = /^[ㄱ-ㅎㅏ-ㅣ가-힣a-z0-9]{4,12}$/;
			if (regId.test(($('#reg_mb_id').val()))) {
				$('.row_mb_id').find(".status_ico").removeClass("err").addClass("pas");
				$('.row_mb_id').find(".error").html("");

				$.post(g5_bbs_url + "/ajax.mb_id.php", {
					"reg_mb_id": $('#reg_mb_id').val()
				}, function(result) {
					if (result == '') { // ajax.mb_id.php 의 die($msg); 값을 가져옴
						$('.row_mb_id').find(".status_ico").removeClass("err").addClass("pas"); //될때 초록색 박스 i 는 icon 의 약자
						$('.row_mb_id').find(".error").html(""); // 마지막 dd 의 css 스타일 사용
						isIdCheck = true;
					} else {
						$('.row_mb_id').find(".status_ico").removeClass("pas").addClass("err");
						$('.row_mb_id').find(".error").addClass("on").html(result);
						isIdCheck = false;
					}
				});
			} else {
				$('.row_mb_id').find(".status_ico").removeClass("pas").addClass("err");
				$('.row_mb_id').find(".error").addClass("on").html("아이디는 영문과 숫자, 4 ~ 12자리까지 가능합니다.");
				isIdCheck = false;
			}

			if (isIdCheck == false) {
				swal("아이디를 확인하세요.");
				return false;
			}

		}
        if (isNickCheck == false) {
            swal("닉네임을 확인하세요.");
            return false;
        }
		// 회원아이디 검사
		// if (f.w.value == "") {
		//     var msg = reg_mb_id_check();
		//     if (msg) {
		//         swal(msg);
		//         f.mb_id.select();
		//         return false;
		//     }
		// }

		if (f.w.value == '') {
			if (f.mb_password.value.length < 3) {
				swal('비밀번호를 3글자 이상 입력하십시오.');
				f.mb_password.focus();
				return false;
			}
		}

		if (f.mb_password.value != f.mb_password_re.value) {
			swal('비밀번호가 같지 않습니다.');
			f.mb_password_re.focus();
			return false;
		}

		if (f.mb_password.value.length > 0) {
			if (f.mb_password_re.value.length < 3) {
				swal('비밀번호를 3글자 이상 입력하십시오.');
				f.mb_password_re.focus();
				return false;
			}
		}

		// 이름 검사
		if (f.w.value == '') {
			if (f.mb_name.value.length < 1) {
				swal('이름을 입력하십시오.');
				f.mb_name.focus();
				return false;
			}
		}

		if ($('#reg_mb_name').parents(".row").find(".status_ico").hasClass("err")) {
			swal('이름을 확인하세요.');
			$('#reg_mb_name').focus();
			return false;
		}

		if ($('#reg_mb_birth').parents(".row").find(".status_ico").hasClass("err")) {
			swal('생년월일을 확인하세요.');
			$('#reg_mb_birth').focus();
			return false;
		}

        if (f.mb_introduce.value == "직접입력" && f.mb_introduce_memo.value.length < 1) {
            swal('나를 어필할 수 있는 소개글을 입력하십시오.');
            $('#mb_introduce').parents(".row").find(".status_ico").removeClass("pas").addClass("err");
            f.mb_introduce_memo.focus();
            return false;
        }

        if (f.mb_introduce.value == "") {
            swal('나를 어필할 수 있는 소개글을 선택하십시오.');
            return false;
        }


		<?php if($w == ""){ ?>
        if (f.mb_1.value.length < 1) {
            swal('가입경로를 입력하세요.');
            return false;

        }
            if ($("#reg_req1").prop("checked") == false) {
			swal("이용약관 동의(필수)를 체크하십시오");
			return false;
		}
		if ($("#reg_req2").prop("checked") == false) {
			swal("개인정보처리방침 동의(필수)를 체크하십시오");
			return false;
		}
		<?php } ?>

		return true;
	}

	// 장애유형 선택
	function type_change(type) {
		console.log('선택유형 : ', type);
		// $('#se_disab_type2').find('option:first').attr('selected', 'selected');
		$('#se_disab_type2 option:eq(0)').prop('selected', true);
	}

	// 장애급수 선택
	var cnt = <?php echo $count == 0 ? 0 : $count ?>;

	function type_change2(type) {
		// console.log('선택급수 : ', type);

		if ($('#se_disab_type').val() == '') {
			swal('장애유형을 선택하세요.');
			$('#disab_type2').val('');
			return false;
		}

		$('.select_result').append('<div class="result result_' + cnt + '"><span class="a">' + $('#se_disab_type').val() + '</span><span class="b">' + type + '</span><a class="del" onclick="del_disab_type(\'' + cnt + '\');"><i class="fas fa-times-circle"></i></a></div>');
		cnt++;

		$('#delete_yn').val('Y'); // 수정 시 사용
	}

	// 장애유형 삭제
	function del_disab_type(cnt) {
		$('.result_' + cnt).remove();

		$('#delete_yn').val('Y'); // 수정 시 사용
	}

	// 저장하기 전 장애유형 재확인
	var disab_type1 = '';
	var disab_type2 = '';

	function submit_check() {
		$('.result').each(function() {
			var idx = $(this)[0].classList[1].split('_')[1];
			disab_type1 += $('.result_' + idx + ' .a').text() + ',';
			disab_type2 += $('.result_' + idx + ' .b').text() + ',';
		});

		$('#disab_type1').val(disab_type1.slice(0, -1));
		$('#disab_type2').val(disab_type2.slice(0, -1));

		/*
		var form = $('form')[0];
		var formData = new FormData(form);

		$.ajax({
		    type: 'POST',
		    processData: false,
		    contentType: false,
		    url: g5_bbs_url + "/register_form_update.php",
		    data: formData,
		    success: function (data) {

		    }
		});
		*/

		// $('#fregisterform').submit();
	}

	// 21.03.08 푸시알림
	function fcmKey(token) {
		$("input[name='token']").val(token); //토큰값을 필드에 넣기 mb_10일 경우 mb_10으로 하면된다
	}

	// 21.03.08 나이스 본인 인증
	function nice_certify(type) {
		sessionStorage.setItem("mb_id", $('#reg_mb_id').val());
		sessionStorage.setItem("secret_member", $('#secret_member').val());
		sessionStorage.setItem("mb_password", $('#reg_mb_password').val());
		sessionStorage.setItem("mb_password_re", $('#reg_mb_password_re').val());
		sessionStorage.setItem("mb_name", $('#reg_mb_name').val());
		sessionStorage.setItem("mb_birth", $('#reg_mb_birth').val());
		sessionStorage.setItem("mb_sex", $('input[name="reg_mb_sex"]:checked').val());
		sessionStorage.setItem("mb_introduce", $('#mb_introduce').val());
		sessionStorage.setItem("join_type", '<?=$join_type?>');
		sessionStorage.setItem("join_type_de", $('input[name="join_type_de"]:checked').val());
		sessionStorage.setItem("type", type);

		fnNicePopup();
	}
	// 어필 소개글
    $('#mb_introduce').on('change',function(){
        var val = $(this).val();
        if (val == "직접입력"){
            $("#mb_introduce_memo").css("display","inline");
        }else{
            $("#mb_introduce_memo").css("display","none");
            $("#mb_introduce_memo").val("");
            $(this).parents(".row").find(".error").html("");
        }
    });

</script>

<script>
	$(document).ready(function() {
		$(function() {
			$('#reg_mb_hp').keydown(function(event) {
				var key = event.charCode || event.keyCode || 0;
				$text = $(this);
				if (key !== 8 && key !== 9) {
					if ($text.val().length === 3) {
						$text.val($text.val() + '-');
					}
					if ($text.val().length === 8) {
						$text.val($text.val() + '-');
					}
				}

				return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
				// Key 8번 백스페이스, Key 9번 탭, Key 46번 Delete 부터 0 ~ 9까지, Key 96 ~ 105까지 넘버패트
				// 한마디로 JQuery 0 ~~~ 9 숫자 백스페이스, 탭, Delete 키 넘버패드외에는 입력못함
			});
		});
	});

</script>
