 <?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$name = "regi2";
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css?v='.G5_CSS_VER.'">', 0);

//$readonly = '';
//if($w == 'u' || !empty($sns)) { // 수정 || sns로그인
//    $readonly = 'readonly';
//}

$mb_id = $member['mb_id'];
//if($w == '' && $sns == 'kakao') { $mb_id = $id.'@k'; }
//else if($w == '' && $sns == 'naver') { $mb_id = substr($id, 0, 10).'@n'; }

$mb_name = $member['mb_name'];
if(!empty($sns) && !empty($name)) { $mb_name = $name; }
$mb_hp = $member['mb_hp'];
if(!empty($sns) && !empty($_GET['mobile'])) { $mb_hp = $_GET['mobile']; }
$mb_email = $member['mb_email'];
if(!empty($sns) && !empty($email)) { $mb_email = $email; }
?>
 <style>
     .step {display: none;}  
     .step.active {display: block;}
 </style>
 <?php if ($w == 'u') { ?>
     <style>
         #step1 {display: block;}
         #step2 {display: block;}
     </style>
 <?php } ?>

 
 <? if($name=="regi2") { ?>
 <body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="regi2">
 <?}?>

 <div class="mbskin">
     <article class="box-article">
         <div id="join_info">
             <form id="signupForm">
                 <!-- Step 1 -->
                 <div class="step active" id="step1">
                     <div class="box_line">
                         <h2><?php if($w == ""){ ?>회원가입<? }else { ?>회원정보<?php } ?></h2>

                         <div class="box-body">
                             <dl class="row">
                                 <dt>아이디<i class="fa-solid fa-asterisk"></i></dt>
                                 <dd>
                                     <input type="text" name="mb_id" value="<?=$mb_id?>" id="reg_mb_id" class="regist-input required" minlength="3" maxlength="15" required <?=$readonly?> placeholder="아이디를 입력해 주세요.">
                                 </dd>
                                 <dd class="error col-xs-12"></dd>
                             </dl>
                             <?php if(empty($sns)) { // sns로그인은 비밀번호 필요없음?>
                                 <dl class="row">
                                     <dt>비밀번호<i class="fa-solid fa-asterisk"></i></dt>
                                     <dd>
                                         <input type="password" name="mb_password" id="reg_mb_password" class="regist-input <?=$required?>" <?=$required?> minlength="4" maxlength="20" placeholder="비밀번호를 입력해 주세요.">
                                     </dd>
                                     <dd class="error col-xs-12"></dd>
                                 </dl>

                                 <dl class="row password">
                                     <dt>비밀번호확인<i class="fa-solid fa-asterisk"></i></dt>
                                     <dd>
                                         <input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input <?=$required?>" <?=$required?> minlength="4" maxlength="20" placeholder="비밀번호를 한번 더 입력해 주세요.">
                                     </dd>
                                     <dd class="error col-xs-12"></dd>
                                 </dl>
                             <?php } ?>

                             <?/*
                             <dl class="row">
                                 <dt>이메일<i class="fa-solid fa-asterisk"></i></dt>
                                 <dd>
                                     <div class="input">
                                         <input type="text" name="mb_email" id="reg_mb_email" class="regist-input required f_empty email" minlength="3" maxlength="50" required placeholder="이메일을 입력해 주세요." value="<?=$mb_email?>">
                                     </div>
                                 </dd>
                                 <dd class="error col-xs-12"></dd>
                             </dl>

                             <dl class="row hp">
                                 <dt>휴대폰번호<i class="fa-solid fa-asterisk"></i></dt>
                                 <dd>
                                     <div class="input <?php if($w == "") { ?>v1<?php } ?>">
                                         <input type="tel" name="mb_hp" value="<?=$mb_hp?>" id="reg_mb_hp" class="regist-input required" required placeholder="휴대폰번호를 입력해 주세요." minlength="10" maxlength="13">
                                         <?php if($w == "") { ?><button type="button" class="btn_hp" onclick="hpCertify();">인증</button><?php } ?>
                                     </div>
                                     <?php if($w == "") { ?>
                                         <div class="input cert">
                                             <input type="text" style="background-color: #f9f9f9 !important;" name="cert_no" value="" id="cert_no" disabled class="regist-input" placeholder="인증번호를 입력해 주세요." maxlength="6" onkeyup="only_number(this);">
                                         </div>
                                     <?php } ?>
                                 </dd>
                                 <dd class="error col-xs-12"></dd>
                             </dl>
                            */?>
                         </div>

                         <?php if ($w !== 'u') { ?>
                             <div id="join_agr">
                             <div class="cek_all">
                                 <label class="selector">
                                     <input type="checkbox" id="all_chk" name="all_chk">
                                     <span><i></i>약관전체동의</span>
                                 </label>
                             </div>
                             <div class="box-body">
    
                                 <dl class="row agree-row">
                                     <dd class="col-xs-8 chk_ico" data-for="reg_req1">
                                         <input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
                                         <label for="reg_req1"><span></span><em>이용약관 동의 (필수)</em></label>
                                         <!-- <i></i> 이용약관 동의 (필수) -->
                                     </dd>
                                     <dd class="col-xs-4 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                                     <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                                 </dl>
    
                                 <dl class="row agree-row">
                                     <dd class="col-xs-9 chk_ico" data-for="reg_req2">
                                         <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                                         <label for="reg_req2"><span></span><em>개인정보처리방침 동의 (필수)</em></label>
                                         <!--<i></i> 개인정보처리방침 동의 (필수) -->
                                     </dd>
                                     <dd class="col-xs-3 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                                     <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
                                 </dl>
    
                             </div>
                         </div>
                         <?php } ?>
    
                     </div>
                     <?php if ($w !== 'u') { ?>
                     <div class="btn_confirm">
                        <button type="button"class="btn_submit ft_btn" onclick="nextStep()">다음</button>
                     </div>
                     <?php } ?>
                 </div>
    
                 <!-- Step 2 -->
                 <div class="step" id="step2">
                     <div class="box_line">
                         <h2>프로필</h2>
                         <div class="box-body">
                             <dl class="row">
                                 <dt>닉네임<i class="fa-solid fa-asterisk"></i></dt>
                                 <dd>
                                     <input type="text" name="" value="" id="reg_mb_id" class="regist-input required" minlength="1" maxlength="2" required placeholder="닉네임을 입력해 주세요.">
                                 </dd>
                                 <dd class="error col-xs-12"></dd>
                             </dl>
                             <dl class="row">
                                 <dt>성별<i class="fa-solid fa-asterisk"></i></dt>
                                 <dd class="box_in">
                                     <input type="radio" id="gender_male" name="gender" value="male" />
                                     <label for="gender_male">남성</label>
                                     <input type="radio" id="gender_female" name="gender" value="female" />
                                     <label for="gender_female">여성</label>
                                 </dd>
                                 <dd class="error col-xs-12"></dd>
                             </dl>
                             <dl class="row">
                                 <dt>생년월일<i class="fa-solid fa-asterisk"></i></dt>
                                 <dd>
                                     <input type="date" name="" value="" id="reg_mb_id" class="regist-input required" required placeholder="생년월일을 입력해 주세요.">
                                 </dd>
                                 <dd class="error col-xs-12"></dd>
                             </dl>
                             
                             <dl class="row">
                                 <dt>프로필사진</dt>
                                 <dd>
                                     <form id="imgfrm">
                                         <!-- 숨겨진 파일 입력 요소 -->
                                         <input type="file" name="mb_icon" id="mb_icon" onchange="getImgPrev(this);" accept="image/*" style="display: none;">

                                         <!-- 프로필 사진 영역 -->
                                         <div class="area_photo basic" onclick="document.getElementById('mb_icon').click();" style="cursor: pointer;">
                                             <?php
                                             $icon_file = G5_DATA_PATH . '/file/member/' . $member['mb_no'] . '.jpg';
                                             if (file_exists($icon_file)) {
                                                 $icon_url = G5_URL . '/data/file/member/' . $member['mb_no'] . '.jpg';
                                                 echo '<img id="profileImg" src="' . $icon_url . '" alt="Profile Photo">';
                                             } else {
                                                 echo '<img id="profileImg" src="' . G5_IMG_URL . '/img_smile.jpg" alt="Default Profile Photo">';
                                             }
                                             ?>
                                         </div>
                                     </form>
                                 </dd>
                             </dl>

                             <dl class="row">
                                 <dt>현재직업</dt>
                                 <dd>
                                     <div class="input">
                                         <input type="text" name="" id="" class="regist-input" minlength="3" maxlength="50" placeholder="현재직업을 입력해 주세요." value="">
                                     </div>
                                 </dd>
                                 <dd class="error col-xs-12"></dd>
                             </dl>
                             <dl class="row">
                                 <dt>관심분야</dt>
                                 <dd>
                                     <div class="input">
                                         <input type="text" name="" id="" class="regist-input" minlength="3" maxlength="50" placeholder="관심분야 입력해 주세요." value="">
                                     </div>
                                 </dd>
                                 <dd class="error col-xs-12"></dd>
                             </dl>

                            <br>
                             <p class="txt_color text-center">※정확한 프로필 설정은 매칭에 도움이 됩니다.</p>
                             <br>

                         </div>
                     </div>
                     <?php if ($w == 'u') { ?>
                         <a href="javascript:member_leave();" class="btn_cancel">회원탈퇴</a>
                     <?php } else { ?>
                         <button type="button"  class="btn_cancel" onclick="prevStep()">이전</button>
                     <?php } ?>
                     <div class="btn_confirm">
                         <input type="submit" class="btn_submit ft_btn" id="pay_submit" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" accesskey="s">
                     </div>
                 </div>
                 
             </form>
         </div>
     </article>
 </div>


 <script>
     // 인증번호 발송
     function hpCertify() {
         if($.trim($('#reg_mb_hp').val()) == '') {
             swal('휴대폰번호를 입력해 주세요.');
             return false;
         }
         if($.trim($('#reg_mb_hp').val()).length != 13) {
             swal('휴대폰번호를 확인해 주세요.');
             return false;
         }

         $.ajax({
             url: './ajax.hp_certify.php',
             type: 'post',
             dataType: 'json', // 응답 데이터 타입(JSON)
             data: {hp: $('#reg_mb_hp').val(), mode: 'send', type:'register'},
             success: function(data) {
                 if(data.code == '1') {
                     swal(data.msg)
                         .then(()=>{
                             $('#cert_no').attr('disabled', false);
                             $('#cert_no').css('background-color', 'unset');
                             $('#cert_no').focus();
                         });
                 }
                 else if(data.code != '1') {
                     swal(data.msg);
                     return false;
                 }
             },
         });
     }

     function ag_check(obj){
         if(obj.value == "0"){
             obj.value = "1";
         }else{
             obj.value = "0";
         }
     }

     $(function (){
         // 인증번호 확인
         $('#cert_no').keyup(function() {
             // 공백제거
             $(this).val($(this).val().replace(/ /gi, ''));
             var state = $(this).parents(".row").find(".status_ico");
             var err = $(this).parents(".row").find(".error");

             if($.trim($("#cert_no").val()).length != 0) {
                 $.ajax({
                     url: './ajax.hp_certify.php',
                     type: 'post',
                     data: {hp: $('#reg_mb_hp').val(), cert_no: $('#cert_no').val(), mode: 'check'},
                     success: function(data) {
                         if (data == 'success') {
                             $('#cert_no').removeClass('chk_err');
                             $('#cert_no').addClass('chk_pas');
                         } else {
                             $('#cert_no').removeClass('chk_pas');
                             $('#cert_no').addClass('chk_err');
                         }
                     },
                 });
             }
             else {
                 err.html("");
             }
         });

         // 약관동의 전체체크
         $("#all_chk").click(function() {
             if($("#all_chk").prop("checked")) {
                 $("input[type=checkbox]").prop("checked",true);
                 $("input[type=checkbox]").val("1");
             } else {
                 $("input[type=checkbox]").prop("checked",false);
                 $("input[type=checkbox]").val("0");
             }
         });

         $('input[name^=reg_req]').click(function() {
             if($("input[name^='reg_req']:checked").length == 4) {
                 $('#all_chk').prop("checked", true);
             } else {
                 $('#all_chk').prop("checked", false);
             }
         });


         // 아이디 체크
         $("#reg_mb_id").keyup(function (){
             var mb_id = $(this).val();
             var state = $(this).parents(".row").find(".status_ico");
             var err = $(this).parents(".row").find(".error");

             // 아이디 정규표현식
             var regId = /^[a-z0-9_]{3,15}$/;

             if (regId.test(mb_id)){
                 var msg = reg_mb_id_check();
                 if (msg) {
                     state.removeClass("pas").addClass("err");
                     err.addClass("on").html(msg);
                 } else {
                     state.removeClass("err").addClass("pas");
                     err.html("");
                 }
             }else{
                 state.removeClass("pas").addClass("err");
                 err.addClass("on").html("아이디는 영문 소문자와 숫자, 3 ~ 15자리까지 가능합니다.");
             }
         });

         $("#reg_mb_password").keyup(function () {
             var mb_password = $(this);
             var mb_password_re = $("#reg_mb_password_re");
             var state = mb_password.parents(".row").find(".status_ico");
             var err = mb_password.parents(".row").find(".error");

             if (mb_password.val() != "" && mb_password_re.val() != "") {
                 // 비밀번호와 재입력 값이 다를 때
                 if (mb_password_re.val() != mb_password.val()) {
                     state.removeClass("pas").addClass("err");
                     err.addClass("on").html("비밀번호가 다릅니다.");
                 } else {
                     // 비밀번호가 일치할 때
                     state.removeClass("err").addClass("pas");
                     err.addClass("on").addClass("pas").html("비밀번호가 일치합니다.");
                 }
             } else if (mb_password.val().length < 8) {
                 state.removeClass("pas").addClass("err");
                 err.addClass("on").html("비밀번호는 8자 이상 문자와 숫자 조합으로 입력해 주세요.");
             } else {
                 state.removeClass("err").addClass("pas");
                 err.html("");
             }
         });

         $("#reg_mb_password_re").keyup(function () {
             var mb_password_re = $(this).val();
             var mb_password = $("#reg_mb_password").val();
             var state = $(this).parents(".row").find(".status_ico");
             var err = $(this).parents(".row").find(".error");

             // 비밀번호와 재입력 값 비교
             if (mb_password == mb_password_re) {
                 state.removeClass("err").addClass("pas");
                 err.addClass("on").addClass("pas").html("비밀번호가 일치합니다.");
             } else {
                 state.removeClass("pas").addClass("err");
                 err.addClass("on").html("비밀번호가 다릅니다.");
             }
         });

         $("#reg_mb_name").keyup(function (){
             var mb_name = $(this).val();
             var reg_mb_name = $(this);
             var state = $(this).parents(".row").find(".status_ico");
             var err = $(this).parents(".row").find(".error");

             // 이름 정규표현식
             var regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

             if (regName.test(mb_name)){
                 state.removeClass("err").addClass("pas");
                 err.html("");
             }else{
                 state.removeClass("pas").addClass("err");
                 err.addClass("on").html("2글자 이상 한글만 입력해 주세요.");
             }
         });

         $("#reg_mb_hp").keyup(function (){
             var mb_hp = $(this).val();
             var reg_mb_hp = $(this);
             var state = $(this).parents(".row").find(".status_ico");
             var err = $(this).parents(".row").find(".error");

             // 휴대폰 정규표현식
             // /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/
             //var regHp = /^\d{10,12}$/;
             var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;

             if (regHp.test(mb_hp)){
                 state.removeClass("err").addClass("pas");
                 err.html("");
             }else{
                 state.removeClass("pas").addClass("err");
                 err.addClass("on").html("휴대폰 번호는 10 ~ 12자리 숫자만 입력해 주세요.");
             }

         }).keydown(function (event) {
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
         });

         $("#cert_no").keyup(function () {
             let thisInput = $(this);
             let value = $(thisInput).val();

             if(value.length >= 6){
                 $(this).prop("disabled", true);

                 $.ajax({
                     url: './ajax.hp_certify.php',
                     type: 'post',
                     dataType: 'json', // 응답 데이터 타입(JSON)
                     data: {hp: $('#reg_mb_hp').val(), cert_no: value, mode: 'check'},
                     success: function(data) {
                         if(data.code == "1"){
                             swal(data.msg);
                             $(thisInput).removeClass('chk_err');
                             $(thisInput).addClass('chk_pas');
                         } else {
                             swal(data.msg);
                             $(thisInput).prop("disabled", false);
                             $(thisInput).removeClass('chk_pas');
                             $(thisInput).addClass('chk_err');
                         }
                     },
                 });
             }
         });

         $("#reg_mb_addr1").on("focusin", execDaumPostcode);

         $("#reg_mb_addr2").keyup(function (){
             var state = $(this).parents(".row").find(".status_ico");
             var err = $(this).parents(".row").find(".error");
             if ($(this).val().length > 0) {
                 state.removeClass("err").addClass("pas");
                 err.html("");
             } else {
                 state.removeClass("pas").addClass("err");
                 err.addClass("on").html("상세주소를 입력해 주세요.");
             }
         });

         $("#reg_mb_email").keyup(function (){
             // 공백제거
             $(this).val($(this).val().replace(/ /gi, ''));
             var mb_email = $(this).val();
             var state = $(this).parents(".row").find(".status_ico");
             var err = $(this).parents(".row").find(".error");

             // 이메일 정규표현식
             var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

             if (regEmail.test(mb_email)){
                 var msg = reg_mb_email_check();
                 if (msg) {
                     state.removeClass("pas").addClass("err");
                     err.addClass("on").html(msg);
                 } else {
                     state.removeClass("err").addClass("pas");
                     err.html("");
                 }
             }else{
                 state.removeClass("pas").addClass("err");
                 err.addClass("on").html("올바른 E-mail 형식으로 입력해 주세요.")
                 return false;
             }
         });

         $("#reg_mb_nick").keyup(function (){
             // 공백제거
             $(this).val($(this).val().replace(/ /gi, ''));
             var state = $(this).parents(".row").find(".status_ico");
             var err = $(this).parents(".row").find(".error");

             if($.trim($("#reg_mb_nick").val()).length != 0) {
                 var msg = reg_mb_nick_check();
                 if (msg) {
                     state.removeClass("pas").addClass("err");
                     err.addClass("on").html(msg);
                 } else {
                     state.removeClass("err").addClass("pas");
                     err.removeClass("on").html("");
                 }
             }
             else {
                 err.html("");
             }
         });

         /*
         // 라디오 버튼
         $("#dd_type p").click(function (){
             var v = $(this).data("val");
             $("#mb_type").val(v);
             $("#dd_type p").find("i").removeClass("fa-check-circle-o").addClass("fa-circle-o");
             $(this).find("i").removeClass("fa-circle-o").addClass("fa-check-circle-o");
         });
         */

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
     });

     // submit 최종 폼체크
     function fregisterform_submit(f){
         // 필수 체크박스
         // 조건들 확인
         var text = document.getElementsByClassName('error');

         for (a = 0; a < text.length;a++){
             if (text[a].innerHTML != ""){
                 swal(text[a].innerHTML);
                 return false;
                 break;
             }
         }


         if (f.w.value == "") {

             if($("#reg_req1").val()!="1"){
                 swal("이용약관 동의(필수)를 체크하세요.");
                 return false;
             }
             if($("#reg_req2").val()!="1"){
                 swal("개인정보처리방침 동의(필수)를 체크하세요.");
                 return false;
             }
         }

         // return true;
     }

     /* 다음주소 */
     var element_layer = document.getElementById('layer');

     function closeDaumPostcode() {
         element_layer.style.display = 'none';
     }

     function execDaumPostcode() {
         new daum.Postcode({
             oncomplete: function(data) {
                 //console.log(data);
                 document.getElementById("reg_mb_addr1").value = data.roadAddress;
                 document.getElementById("reg_mb_zip").value = data.zonecode;
                 document.getElementById("reg_mb_addr2").focus();

                 element_layer.style.display = 'none';

                 // chk처리
                 var state = $("#reg_mb_addr1").parents(".row").find(".status_ico");
                 state.removeClass("err").addClass("pas");
             },
             width : '100%',
             height : '100%',
             maxSuggestItems : 5
         }).embed(element_layer);

         element_layer.style.display = 'block';
         initLayerPosition();
     }

     <?php /*
// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
// 직접 element_layer의 top,left값을 수정해 주시면 됩니다. */ ?>
     function initLayerPosition(){
         var width = Math.round($(window).width() * 0.9);
         var height = Math.round($(window).height() * 0.8);
         var borderWidth = 1;

         // 위에서 선언한 값들을 실제 element에 넣는다.
         element_layer.style.width = width + 'px';
         element_layer.style.height = height + 'px';
         element_layer.style.border = borderWidth + 'px solid';
         // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
         element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
         element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
     }
 </script>
 
 <script>
     let currentStep = 1;

     function nextStep() {
         // 현재 단계의 입력값 유효성 검증
         const currentForm = document.getElementById('step' + currentStep);
         const inputs = currentForm.querySelectorAll('input');
         let isValid = true;

         // 모든 필드 검사
         inputs.forEach((input) => {
             if (!input.checkValidity()) {
                 input.reportValidity(); // 에러 메시지 표시
                 isValid = false;
             }
         });

         // 유효성 검사를 통과하면 다음 단계로 이동
         if (isValid) {
             currentForm.classList.remove('active');
             currentStep++;
             document.getElementById('step' + currentStep).classList.add('active');
         }
     }

     function prevStep() {
         document.getElementById('step' + currentStep).classList.remove('active');
         currentStep--;
         document.getElementById('step' + currentStep).classList.add('active');
     }

     document.getElementById('signupForm').addEventListener('submit', function (e) {
         e.preventDefault(); // 폼 제출 방지
         alert('회원가입이 완료되었습니다!');
         // 서버로 데이터 전송 로직 추가 가능
     });
     

     // 선택된 이미지를 미리 보기로 표시하는 함수
     function getImgPrev(input) {
         if (input.files && input.files[0]) { // 파일이 존재하는지 확인
             const reader = new FileReader(); // FileReader 객체 생성

             reader.onload = function (e) {
                 // 프로필 이미지 태그의 src 속성을 선택된 이미지로 변경
                 document.getElementById('profileImg').src = e.target.result;
             };

             // 선택된 이미지 파일을 읽기
             reader.readAsDataURL(input.files[0]);
         }
     }
 </script>

