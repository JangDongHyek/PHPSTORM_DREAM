<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_javascript('<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>', 0);

//include_once($member_skin_path.'/mb.head.php');


$fcm_token = get_session("fcm_token");

$sql = "select * from `member_gcm` where `mb_id` = '$member[mb_id]'";

$fcm_row = sql_fetch($sql);

if($fcm_row == null) $fcm_row['push_yn'] = "Y";

?>
<style>
body{background: #fff;}
</style>


<!-- 회원가입시작 { -->
<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w;?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
	<input type="hidden" name="mb_level" id="mb_level" value="<? if($w == '') { echo $mb_level; } else { echo $member[mb_level]; } ?>">
	<input type="hidden" name="mb_1" id="mb_1" value="<? if($w == '') { echo 'N'; } else { echo $member['mb_1']; } ?>">
    <?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php } ?>

	<article class="box-article">
    	<div id="join_info">
            <?php if($w == ""){ ?>
                <div class="join_part cf">
					<div class="part">
                        <a href="./register_form.php">고객 가입</a>
                    </div>
                    <div class="part">
                        <a href="./register_form_manager.php" class="on">매니저 가입</a>
                    </div>
                </div>
            <?php }else{ ?>

            <?php } ?>
        
            <div class="box-body">
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_id">아이디</label>
                        <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="4" maxlength="20" <?php echo $required ?> placeholder="아이디" <?php if($w=="u") echo "readonly";?>>
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_password">비밀번호</label>
                        <input type="password" name="mb_password" id="reg_mb_password" class="regist-input <?php echo $required ?>" minlength="4" maxlength="20" <?php echo $required ?> placeholder="비밀번호">
                    </dd>
                    <dd class="status_ico lock_ico1"><i class="fas fa-lock-open"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="mb_password_re">비밀번호확인</label>
                        <input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input <?php echo $required ?>" minlength="4" maxlength="20" <?php echo $required ?> placeholder="비밀번호확인">
                    </dd>
                    <dd class="status_ico lock_ico2"><i class="fas fa-lock"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_name">이름</label>
                        <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input <?php echo $required ?>" <?php echo $required ?> placeholder="이름">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
                
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_birth">생년월일 입력</label>
                        <input type="text" name="ma_birth" value="<?php echo $member['ma_birth'] ?>" id="reg_ma_birth" class="regist-input <?php echo $required ?>" <?php echo $required ?> placeholder="생년월일 입력(예 : 19870516)" minlength="8" maxlength="8">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
                
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_hp">휴대폰번호</label>
                        <input type="tel" name="mb_hp" value="<?php echo preg_replace("/[^0-9]*/s", "", $member['mb_hp']); ?>" id="reg_mb_hp" class="regist-input <?php echo $required ?>" <?php echo $required ?> placeholder="휴대폰번호" style="font-size:0.95em;" minlength="10" maxlength="13" >
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
		
                
                <dl class="row">
                    <dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_name">주소</label>
                        <input type="text" name="mb_addr1" readonly onclick="sample2_execDaumPostcode()" value="<?php echo $member['mb_addr1'] ?>" id="reg_mb_addr1" class="regist-input" placeholder="주소">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
                <dl class="row">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-11">
                            <label for="reg_mb_name">상세주소</label>
                            <input type="text" name="mb_addr2" value="<?php echo $member['mb_addr2'] ?>" id="reg_mb_addr2" class="regist-input" placeholder="상세주소">
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                </dl>
                
                <!--
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_nick">닉네임</label>
                        <input type="text" name="mb_nick" id="reg_mb_nick" class="regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="2" maxlength="20" <?php echo $required ?> placeholder="닉네임" value="<?php echo $member['mb_nick']; ?>">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_email">E-mail</label>
                        <input type="text" name="mb_email" id="reg_mb_email" class="regist-input <?php echo $required ?>" minlength="3" maxlength="50" <?php echo $required ?> placeholder="E-mail" value="<?php echo $member['mb_email']; ?>">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>-->
                
                
                <div class="sche">
                    <h3><i class="far fa-clock"></i> 근무가능시간</h3>
                    <dl class="row">
                        <dd class="col-xs-3">
                            <select name="ma_time1" id="reg_ma_time1" class="sch_sel">
                                <option value="오전">오전</option>
                                <option value="오후">오후</option>
                            </select>
                        </dd>
                        <dd class="col-xs-4">
                            <select name="ma_time2" id="reg_ma_time2" class="sch_sel">
                                <option value="">시간선택</option>
                                <option value="1시">01시</option>
                                <option value="2시">02시</option>
                                <option value="3시">03시</option>
                                <option value="4시">04시</option>
                                <option value="5시">05시</option>
                                <option value="6시">06시</option>
                                <option value="7시">07시</option>
                                <option value="8시">08시</option>
                                <option value="9시">09시</option>
                                <option value="10시">10시</option>
                                <option value="11시">11시</option>
                                <option value="12시">12시</option>
                            </select>
                        </dd>
                        <dd class="col-xs-3">
                            <span>부터</span>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dd class="col-xs-3">
                            <select name="ma_time3" id="reg_ma_time3" class="sch_sel">
                                <option value="오전">오전</option>
                                <option value="오후">오후</option>
                            </select>
                        </dd>
                        <dd class="col-xs-4">
                            <select name="ma_time4" id="reg_ma_time4" class="sch_sel">
                                <option value="">시간선택</option>
                                <option value="1시">01시</option>
                                <option value="2시">02시</option>
                                <option value="3시">03시</option>
                                <option value="4시">04시</option>
                                <option value="5시">05시</option>
                                <option value="6시">06시</option>
                                <option value="7시">07시</option>
                                <option value="8시">08시</option>
                                <option value="9시">09시</option>
                                <option value="10시">10시</option>
                                <option value="11시">11시</option>
                                <option value="12시">12시</option>
                            </select>
                        </dd>
                        <dd class="col-xs-3">
                            <span>까지</span>
                        </dd>
                    </dl>
                    <h3><i class="far fa-clock"></i>근무가능요일</h3>
                    <div class="row in">
                        <?php
                        $ma_day_arr = explode(',',$member['ma_day']);
                        for($i = 1; $i <= count($yoil); $i++){
                            $chk = "";
                            for($a= 0; $a < count($ma_day_arr); $a ++){
                                if ($ma_day_arr[$a] == $yoil[$i]){
                                    $chk = 'checked';

                                }
                            }
                            //금요일 일 경우 br 태그 넣어주기
                            if ($i == 6){
                                echo '<!-- <br> -->';
                            }
                            ?>
                            <span class="box-check-input"><label><input name="ma_day[]" <?=$chk?> type="checkbox" value="<?=$yoil[$i]?>"><?=$yoil[$i]?></label></span>
                        <?php } ?>
                    </div>
                </div><!--sche-->
                
                <div class="sche">
                    <h3><i class="far fa-clock"></i> 근무희망개월수</h3>
                    <dl class="row">
                            <dd class="col-xs-1 req">*</dd>
                            <dd class="col-xs-11">
                                <label for="reg_mb_nick">근무희망개월</label>
                        		<input type="text" name="ma_hope_month" value="<?= $member['ma_hope_month
                        		']?>" id="reg_ma_hope_month" class="regist-input" minlength="2" maxlength="20" <?php echo $required ?> placeholder="(예:8개월)">
                            </dd>
                    </dl>
                </div><!--sche-->
                
                <div class="sche">
                    <h3><i class="far fa-clock"></i> 출장세차경험</h3>
                    <dl class="row exp">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-6">
                            <input type="radio" value="Y" id="expYes" name="ma_exp_yn" checked="checked">
                            <label for="expYes">YES! 경험있습니다.</label>
                        </dd>
                        <dd class="col-xs-6">
                            <input type="radio" value="N" id="expNo" name="ma_exp_yn">
                            <label for="expNo">NO. 경험없습니다.</label>
                        </dd>
                    </dl>
                </div><!--sche-->
                
				<div class="sche">
                    <h3><i class="far fa-clock"></i> 푸시알림</h3>
                    <dl class="row exp">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-6">
                            <input type="radio" value="Y" id="push_Y" name="push_yn" <? if($fcm_row['push_yn'] == "Y") { echo 'checked';}?>>
                            <label for="push_Y">ON</label>
                        </dd>
                        <dd class="col-xs-6">
                            <input type="radio" value="N" id="push_N" name="push_yn" <? if($fcm_row['push_yn'] == "N") { echo 'checked';}?>>
                            <label for="push_N">OFF</label>
                        </dd>
                    </dl>
                </div><!--sche-->
                
                <div class="car_info">
                	<strong class="title">작업차량 정보</strong>
                    <dl class="row">
                            <dd class="col-xs-12">
                                <label for="ma_car_no">차량번호 입력</label>
                                <input type="text" name="ma_car_no" value="<?php echo $member['ma_car_no'] ?>" id="reg_ma_car_no" class="regist-input" placeholder="차량번호 입력 (예:12가1234)">
                            </dd>
                    </dl>
                    <dl class="row">
                            <dd class="col-xs-12">
                                <label for="ma_car_type">차량종류 입력</label>
                                <input type="text" name="ma_car_type" value="<?php echo $member['ma_car_type'] ?>" id="reg_ma_car_type" class="regist-input" placeholder="차량종류 입력 (예:스타렉스)">
                            </dd>
                    </dl>
                </div><!--car_info-->

                    
				<?php /*?><? $mb_2_css = ($w == "u" && $member['mb_1'] == "기타")? "display: block;" : "display: none;"; ?>
				<dl class="row">
                    <dd class="col-xs-12">
                        <label for="reg_mb_1">가입경로</label>
						<select class="regist-input" style="font-size: 1em;" name="mb_1" id="reg_mb_1" required>
							<option value="">가입경로 선택</option>
							<? foreach ($join_path_arr as $key=>$path) { ?>
							<option value="<?=$path?>" <? if ($member['mb_1'] == $path) echo "selected"; ?>><?=$path?></option>
							<? } ?>
						</select>
						<input type="text" name="mb_2" id="reg_mb_2" class="regist-input" maxlength="30" placeholder="가입경로를 입력하세요" value="<?php echo $member['mb_2']; ?>" style="border-top:1px solid #DCDCDC;<?=$mb_2_css?>">
                    </dd>
                </dl><?php */?>
    
            </div>
        </div><!--//join_info-->
		
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
        </div><!--//join_chk-->
		<?php } ?>

		<input type="submit" class="btn_submit ft_btn" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" accesskey="s">
        <?php /*?><a class="logout_btn" href="<?php echo G5_BBS_URL ?>/point.php">코인내역</a>
        <?php if(!$w == ""){ ?><a class="logout_btn" href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a><?php } ?><?php */?>
	</article>
    </form>
</div>


<!--주소팝업-->
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
    <i class="fas fa-times-square" id="btnCloseLayer" style="width:40px; height:40px; color:#000; cursor:pointer;position:absolute;right:-5px;bottom:-5px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼"></i>
</div>




<script>
    var element_layer = document.getElementById('layer');

    function closeDaumPostcode() {
        // iframe을 넣은 element를 안보이게 한다.
        element_layer.style.display = 'none';
    }




    function sample2_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    // document.getElementById("sample2_extraAddress").value = extraAddr;

                } else {
                    // document.getElementById("sample2_extraAddress").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                // document.getElementById('sample2_postcode').value = data.zonecode;
                document.getElementById("reg_mb_addr1").value = addr +' '+extraAddr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("reg_mb_addr2").focus();

                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_layer.style.display = 'none';
            },
            width : '100%',
            height : '100%',
            maxSuggestItems : 5
        }).embed(element_layer);

        // iframe을 넣은 element를 보이게 한다.
        element_layer.style.display = 'block';

        // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
        initLayerPosition();
    }

    // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
    // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
    // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
    function initLayerPosition(){
        var width = "350"; //우편번호서비스가 들어갈 element의 width 350
        var height = "400"; //우편번호서비스가 들어갈 element의 height 400
        var borderWidth = 2; //샘플에서 사용하는 border의 두께

        // 위에서 선언한 값들을 실제 element에 넣는다.
        element_layer.style.width = width + 'px';
        element_layer.style.height = height + 'px';
        element_layer.style.border = borderWidth + 'px solid';
        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
        element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
        element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
    }

    function ag_check(obj){
	if(obj.value == "0"){
		obj.value = "1";
	}else{
		obj.value = "0";
	}
}
$(function (){
	//전체동의 체크 클릭시
	$("#reg_all").click(function(){
		$("#reg_req1").prop("checked",$(this).prop("checked"));
		$("#reg_req2").prop("checked",$(this).prop("checked"));
	});
	// 아이디 체크
	
	$("#reg_mb_id").keyup(function (){
		var mb_id = $(this).val();
		var reg_mb_id = $(this);

		// 아이디 정규표현식
		var regId = /^[a-z0-9]{4,12}$/;
		/*
		if (regId.test(mb_id)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("아이디는 영문과 숫자, 4 ~ 12자리까지 가능합니다.");
			
			return false;
		}*/
		
		// 아작스로 중복 아이디가 있는지 체크 1
		$.post(g5_bbs_url+"/ajax.mb_register.php", {"type":"mb_id", "val":mb_id}, function (result){
			if(result == "0"){  // ajax.mb_register.php 의 echo $row['cnt']; 값을 가져옴
				reg_mb_id.parents(".row").find(".status_ico").removeClass("err").addClass("pas"); //될때 초록색 박스 i 는 icon 의 약자
				reg_mb_id.parents(".row").find(".error").html(""); // 마지막 dd 의 css 스타일 사용
			}else{
				reg_mb_id.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				reg_mb_id.parents(".row").find(".error").addClass("on").html("사용중인 아이디입니다.");
			}
		});
	});

	$("#reg_mb_password").keyup(function (){
		var mb_password = $(this).val();
		var reg_mb_password = $(this);
		/*
		// 바뀌면 무조건 틀렸다로 표시.
		if($("#reg_mb_password_re").val() != mb_password){
			$("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$("#reg_mb_password_re").parents(".row").find(".error").addClass("on").html("비밀번호가 다릅니다.");	
		}else{
			$("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$("#reg_mb_password_re").parents(".row").find(".error").html("");
		}*/
		/*
		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

		if (regPassword.test(mb_password)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("비밀번호는 8자~15자 영문,숫자,특수문자가 포함 되어야 합니다.");
		}*/
	});

	$("#reg_mb_password_re").keyup(function (){
		var mb_password_re = $(this).val();
		var mb_password = $("#reg_mb_password").val();

		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;
		
		if(mb_password == mb_password_re){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("비밀번호가 다릅니다.");	
		}
	});


	$("#reg_mb_name").keyup(function (){
		var mb_name = $(this).val();
		var reg_mb_name = $(this);

		// 이름 정규표현식
		var regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

		if (regName.test(mb_name)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("2글자 이상 한글만 입력해주세요.");
		}
	});

	$("#reg_mb_hp").keyup(function (){
		var mb_hp = $(this).val();
		var reg_mb_hp = $(this);

		// 휴대폰 정규표현식
		// /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/
		//var regHp = /^\d{10,12}$/;
        var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;

		if (regHp.test(mb_hp)){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("휴대폰 번호는 10 ~ 12자리 숫자만 입력하세요.");
		}
	});
	
	

	$("#reg_mb_nick").keyup(function (){
		var mb_nick = $(this).val();
		var reg_mb_nick = $(this);

		// 닉네임 정규표현식
		var regNick = /^[\w\Wㄱ-ㅎㅏ-ㅣ가-힣]{2,20}$/;
		
		if (regNick.test(mb_nick)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("2글자 이상 입력해주세요.")		
			return false;
		}

		$.post(g5_bbs_url+"/ajax.mb_register.php", {"type2":"mb_nick", "val2":mb_nick}, function (result){
			if(result == "0"){  
				reg_mb_nick.parents(".row").find(".status_ico").removeClass("err").addClass("pas"); 
				reg_mb_nick.parents(".row").find(".error").html("");
			}else{
				reg_mb_nick.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				reg_mb_nick.parents(".row").find(".error").addClass("on").html("사용중인 닉네임 입니다.");
			}
		});
	});
	
	$("#reg_mb_email").keyup(function (){
		var mb_email = $(this).val();
		var reg_mb_email = $(this);

		// 이메일 정규표현식
		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
		
		if (regEmail.test(mb_email)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("올바른 E-mail 형식으로 입력해주십시오.")		
			return false;
		}
	});
	
	$("#reg_mb_level").click(function (){
		var mb_level = $(this).val();
		var reg_mb_level = $(this);

		// 이메일 정규표현식

		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
		
		if (regEmail.test(mb_email)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("올바른 E-mail 형식으로 입력해주십시오.")		
			return false;
		}
	});
	
	// 라디오 버튼
	$("#dd_type p").click(function (){
		var v = $(this).data("val");
		$("#mb_type").val(v);
		$("#dd_type p").find("i").removeClass("fa-check-circle-o").addClass("fa-circle-o");
		$(this).find("i").removeClass("fa-circle-o").addClass("fa-check-circle-o");
	});

	// 내용보기 
	$(".btn-agr").click(function (){
		var dis = $(this).parents(".row").find(".agr_textarea").css("display");
		if(dis == "none")
			$(this).parents(".row").find(".agr_textarea").slideDown(100);
		else
			$(this).parents(".row").find(".agr_textarea").slideUp(100);
	});
	// 약관동의
	
	$(".agree-row dd:first-child").click(function (){
		var ford = $(this).data("for");
		var targ = $("#" + ford);
		
		if(targ.val() == "1"){			
			$(this).find("i").removeClass("nochk").addClass("chk");
			//targ.val("0");
		}else{			
			$(this).find("i").removeClass("chk").addClass("nochk");
			//targ.val("1");
		}
	});

	// 가입경로선택
	//$("#reg_mb_1").on("change", function() {
//		if ($(this).val() == "기타") {
//			$("#reg_mb_2").show().focus();
//		} else {
//			$("#reg_mb_2").hide().val("");
//		}
//	});

});

function only_number(num){
	num = num + "";
	num = num.replace(/[^0-9]/gi, "");
	return num;
}

// submit 최종 폼체크
function fregisterform_submit(f)
{
	// 필수 체크박스
	// 조건들 확인
	
	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
            swal_func(msg);
			f.mb_id.select();
			return false;
		}
	}

	if (f.w.value == '') {
		if (f.mb_password.value.length < 3) {
            swal_func('비밀번호를 3글자 이상 입력하십시오.');
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
        swal_func('비밀번호가 같지 않습니다.');
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
            swal_func('비밀번호를 3글자 이상 입력하십시오.');
			f.mb_password_re.focus();
			return false;
		}
	}

	// 이름 검사
	if (f.w.value=='') {
		if (f.mb_name.value.length < 1) {
            swal_func('이름을 입력하십시오.');
			f.mb_name.focus();
			return false;
		}
	}
/*
	// 닉네임 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
		var msg = reg_mb_nick_check();
		if (msg) {
			alert(msg);
			f.reg_mb_nick.select();
			return false;
		}
	}*/
/*
	// E-mail 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}
	}*/

	// 가입경로확인
	//if ($("select#reg_mb_1 option:selected").val() == "기타" && $("input#reg_mb_2").val() == "") {
//		alert("가입경로를 입력하세요.");
//		$("input#reg_mb_2").focus();
//		return false;
//	}

	<?php if($w == ""){ ?>
	if($("#reg_req1").prop("checked")==false){
        swal_func("이용약관 동의(필수)를 체크하십시오");
		return false;
	}
	if($("#reg_req2").prop("checked")==false){
        swal_func("개인정보처리방침 동의(필수)를 체크하십시오");
		return false;
	}
	<?php } ?>

	

	return true;
}

function swal_func(text) {

        swal({
            title: "경고창",
            text: text,
            icon: "error",
            button: "확인",
        });

    }
</script>

<script>
$(document).ready(function () {

    <?php if ($w == 'u'){ ?>
        $('[name="ma_exp_yn"]').attr('checked',false);
        $("input:radio[name='ma_exp_yn']:radio[value='<?=$member['ma_exp_yn']?>']").prop("checked", true);

         $('[name="ma_time1"]').val('<?=$member['ma_time1']?>');
         $('[name="ma_time2"]').val('<?=$member['ma_time2']?>');
        $('[name="ma_time3"]').val('<?=$member['ma_time3']?>');
        $('[name="ma_time4"]').val('<?=$member['ma_time4']?>');
    <?php } ?>

   $(function () {
            
            $('#reg_mb_hp').keydown(function (event) {
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
   });

});
</script>



