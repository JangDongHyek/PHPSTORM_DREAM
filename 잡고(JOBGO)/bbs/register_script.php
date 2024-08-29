
<!--주소팝업-->
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
    <i class="fas fa-times-square" id="btnCloseLayer" style="width:40px; height:40px; color:#000; cursor:pointer;position:absolute;right:-5px;bottom:-5px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼"></i>
</div>

<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>

    $(document).ready(function() {
        <?php if ($is_member){ ?>
        $("input:radio[name='mb_5']:radio[value='<?=$member['mb_5']?>']").prop("checked", true);
        buisnessman_chk('<?=$member["mb_buisnessman"]?>');

    <?php } ?>
    });

    function buisnessman_chk(val) {
        if(val == "Y" ){
            if ($('#reg_mb_hp').val() == ""){
                swal("원활한 진행을 위해 휴대폰 인증을 먼저 진행해주세요.");
                $("input:radio[name='mb_buisnessman']:radio[value='N']").prop("checked", true);
                return false;
            }
            $("input:radio[name='mb_buisnessman']:radio[value='Y']").prop("checked", true);
            $('#buis_div').css('display','block');


        }else{
            $("input:radio[name='mb_buisnessman']:radio[value='N']").prop("checked", true);
            $('#buis_div').css('display','none');
        }

    }


    $('[name = "mb_sub_path[]"]:checkbox[value="직접입력"]').click(function(){
      if (this.checked == true){
          $('[name = mb_sub_text]').css('display','inline-block');
      } else{
          $('[name =mb_sub_text]').css('display','none');
          $('[name =mb_sub_text]').val('');
      }
    })
    function nice_certify(type) {

        sessionStorage.setItem("mb_email", $('#reg_mb_email').val() );
        sessionStorage.setItem("mb_password",  $('#reg_mb_password').val());
        sessionStorage.setItem("mb_password_re",  $('#reg_mb_password_re').val());
        sessionStorage.setItem("mb_nick",  $('#reg_mb_nick').val());
        sessionStorage.setItem("mb_addr1",  $('#reg_mb_addr1').val());
        sessionStorage.setItem("mb_addr2",  $('#reg_mb_addr2').val());
        sessionStorage.setItem("mb_5", $('input[name="mb_5"]:checked').val());
        sessionStorage.setItem("type",  type);
        sessionStorage.setItem("r_code",  $('#r_code').val());

        fnNicePopup();

    }

    var is_data = '';
    function certi_mail_send() {
        // 입력 이메일
        var reg_mb_email = $('#reg_mb_email').val();

        // 이메일 공란 체크
        if(reg_mb_email == '') {
            $('#email_msg').text('이메일 주소를 입력해주세요.');
            $('#reg_mb_email').focus();
            return;
        }

        // 이메일 형식 체크
        var data = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;

        if(reg_mb_email.search(data) != -1) {

            $.ajax({
                url: g5_bbs_url+'/ajax.controller.php',
                type: 'POST',
                data: {
                    mode : 'certi_mail_send',
                    reg_mb_email : $('#reg_mb_email').val()
                },
                dataType: 'html',
                success: function(data) {
                    // 메일 발송 성공
                    if(data == 'S00') {
                        $('#reg_mb_email').attr('readonly',true);
                        var html = '<button type="button" style="color: #eb7b78; right: 88px" class="btn cert" onclick="mail_change();">이메일변경</button>';
                        html += '<button type="button" style="background:#eb7b78; color: #fff;"  class="btn cert" onclick="certi_confirm()">인증확인</button>';
                        $('#button_span').html(html);
                        $('#email_msg').text('인증 메일이 발송되었습니다. 메일을 확인하여 인증을 완료해주세요.');
                    }

                    if(data == 'no') {
                        is_data = data;
                        $('#email_msg').text('이미 회원가입 한 이메일입니다.');
                    }
                }
            });
        } else {
            $('#email_msg').text('이메일 형식이 올바르지 않습니다.');
            $('#reg_mb_email').focus();
            return;
        }
    }

    var is_certify = 'N';
    // 인증 확인
    function certi_confirm() {
        var mb_email = $('#reg_mb_email').val();

        $.ajax({
            url: g5_bbs_url+'/ajax.controller.php',
            type: 'POST',
            data: {
                mode: "certi_confirm_check",
                reg_mb_email : $('#reg_mb_email').val()
            },
            dataType: 'html',
            success: function(data) {
                if(data == 'no_certify') {
                    swal('인증을 메일을 확인하여 인증을 완료해주세요.');
                } else {
                    is_certify = 'Y';
                    $('#button_span').html('<button type="button" style="background:#ef4d48; color: #fff ;cursor: none;" class="btn cert">인증완료</button>');
                    $('#email_msg').text('인증이 완료되었습니다.');
                }
            }
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


        //전체동의 체크 클릭시
        $("#reg_all").click(function(){
            $("#reg_req1").prop("checked",$(this).prop("checked"));
            $("#reg_req2").prop("checked",$(this).prop("checked"));
            $("#reg_req0").prop("checked",$(this).prop("checked"));
        });

        $("#reg_mb_password").keyup(function (){
            var mb_password = $(this).val();
            var reg_mb_password = $(this);
            // 바뀌면 무조건 틀렸다로 표시.
            if($("#reg_mb_password_re").val() != mb_password){
                $("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $("#reg_mb_password_re").parents(".row").find(".error").addClass("on").html("비밀번호가 다릅니다.");
                pw_chk = true;
            }else{
                $("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $("#reg_mb_password_re").parents(".row").find(".error").html("");
                pw_chk = false;
            }
            // 비밀번호 정규표현식
            // var regPassword = /^{9,15}/;
            //업데이트시 공백 인식안하도록.
            if (mb_password.length >= 6 || ('<?= $w ?>' == 'u' && mb_password == "") ){
                $(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row").find(".error").html("");
                pw_chk = false;
            }else{
                $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row").find(".error").addClass("on").html("비밀번호는 6자 이상이 되어야 합니다.");
                pw_chk = true;
            }
        });

        $("#reg_mb_password_re").keyup(function (){
            var mb_password_re = $(this).val();
            var mb_password = $("#reg_mb_password").val();

            if(mb_password == mb_password_re){
                $(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row").find(".error").html("");
            }else{
                $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row").find(".error").addClass("on").html("비밀번호가 다릅니다.");
            }
        });



        $("#reg_mb_nick").keyup(function (){
            var mb_nick = $(this).val();
            var mb_id = $('#reg_mb_email').val();
            var reg_mb_nick = $(this);

            $.post(g5_bbs_url+"/ajax.mb_nick.php", {"reg_mb_id":mb_id, "reg_mb_nick":mb_nick}, function (result){
                if(result == "0"){
                    reg_mb_nick.parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                    reg_mb_nick.parents(".row").find(".error").html("");
                }else{
                    reg_mb_nick.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                    reg_mb_nick.parents(".row").find(".error").addClass("on").html(result);

                }
            });
        });


    <?php if ($w == "") {?>
        $("#reg_mb_email").keyup(function (){
            var mb_email = $(this).val();
            var reg_mb_email = $(this);


            $.post(g5_bbs_url+"/ajax.mb_email.php", {"reg_mb_id":mb_email, "reg_mb_email":mb_email}, function (result){
                if(result == "0"){
                    reg_mb_email.parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                    reg_mb_email.parents(".row").find(".error").html("");
                }else{
                    reg_mb_email.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                    reg_mb_email.parents(".row").find(".error").addClass("on").html(result);

                }
            });

        });
        <?php } ?>
        /*
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

        // // 가입경로선택
        // $("#reg_mb_1").on("change", function() {
        // 	if ($(this).val() == "기타") {
        // 		$("#reg_mb_2").show().focus();
        // 	} else {
        // 		$("#reg_mb_2").hide().val("");
        // 	}
        // });
    });


    // submit 최종 폼체크
    function fregisterform_submit(f) {
        // 필수 체크박스
        // 조건들 확인

        if (f.w.value == 'u') {
            var msg = reg_mb_now_pw_check();
            if (msg) {
                swal(msg);
                f.now_pw.select();
                return false;
            }
        }

        if (f.w.value == '' && f.mb_sns.value == "" && f.simple.value == "") {
            if (is_certify != 'Y'){
                swal('이메일을 인증해주세요.');
                return false;
            }
        }

        if (f.w.value == "" && f.simple.value == "") {
            var msg = reg_mb_email_check();
            if (msg) {
                swal(msg);
                f.reg_mb_email.select();
                return false;
            }
        }

        // console.log(f.mb_sns.value);
        // console.log(f.mb_password.value);
        // console.log(f.mb_password_re.value);
        // return false;

        if (f.mb_sns.value == "" && f.mb_password.value != f.mb_password_re.value) {
            swal('비밀번호가 같지 않습니다.');
            return false;
        }



        if (f.w.value == "u" && <?=$member["mb_level"]?> == 3 ){
            if (f.mb_name.value.length < 1) {
                swal("이름을 입력하십시오.");
                f.mb_name.focus();
                return false;
            }
        }

        if(f.simple.value) {
            if(!f.mb_email.value) {
                swal("아이디를 입력하십시오.");
                return false;
            }
            
            if (f.mb_sns.value == "" && f.mb_password.value == "") {
                swal('비밀번호를 입력해주세요.');
                return false;
            }

            if(!f.reg_mb_name.value) {
                swal("이름을 입력하십시오.");
                return false;
            }

            if(!f.reg_mb_hp.value) {
                swal("휴대폰 번호를 입력하십시오.");
                return false;
            }

            if($("#reg_req1").prop("checked")==false){
                swal("이용약관 동의(필수)를 체크하십시오");
                return false;
            }
            if($("#reg_req2").prop("checked")==false){
                swal("개인정보처리방침 동의(필수)를 체크하십시오");
                return false;
            }
            

        }


        // if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
        //     var msg = reg_mb_nick_check();
        //     if (msg) {
        //         swal(msg);
        //         f.reg_mb_nick.select();
        //         return false;
        //     }
        // }
        if (f.mb_addr1.value.length < 2) {
            swal("거주지역을 입력해주세요.");
            return false;
        }
        inner_error_chk = false;
        // console.log($('.error').length);
        for (var i =0; i < $('.error').length; i++){
            var inner = $('.error')[i].innerHTML
            if(inner != "" && inner != "인증이 완료되었습니다."){
                console.log(inner);
                swal(inner);
                inner_error_chk = true;
                break;
            }
        }


        if (inner_error_chk){
            return false;
        }


        <?php if($w == ""){ ?>

        // if($("#reg_req0").prop("checked")==false){
        //     swal("만 18세이상 체크하십시오");
        //     return false;
        // }
        <?php if($private){ ?>
            // if ($('input[name="mb_want_ctg[]"]:checked').length == 0){
            //     swal("관심있는 분야를 하나 이상 체크해주세요");
            //     return false;
            // }
        <?php } ?>

        if($("#reg_req1").prop("checked")==false){
            swal("이용약관 동의(필수)를 체크하십시오");
            return false;
        }
        if($("#reg_req2").prop("checked")==false){
            swal("개인정보처리방침 동의(필수)를 체크하십시오");
            return false;
        }
        <?php } ?>

        return true;
        // return false;
    }

    // function mail_change(){
    //     $('#reg_mb_email').attr('readonly',false);
    //     $('#button_span').html('<button type="button" class="btn cert" onclick="certi_mail_send();">인증하기</button>');
    //
    // }

    function sms_register() {

        // if ($('#agree01').prop('checked') == false){
        //     swal("휴대폰 번호 수집 및 활용동의를 체크해주세요.");
        //     return false;
        // }

        ajax('sms_send');

    }
    function ajax(mode){

        var mb_hp = $("#mb_hp").val();
        // $('#mb_hp').attr('readonly', true); // 인증 번호 발송 후 휴대폰 번호 수정 불가 처리

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.sms_register.php",
            data: {
                "mb_hp": encodeURIComponent($("#reg_mb_hp").val())
                ,"mode":mode,
            },
            dataType: "json",
            success: function(data) {
                console.log(data);

                if (data['msg'] != 'sms_ok'){
                    swal(data['msg']);
                }


            }
        });
    }

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
        var height = "430"; //우편번호서비스가 들어갈 element의 height 400
        var borderWidth = 2; //샘플에서 사용하는 border의 두께

        // 위에서 선언한 값들을 실제 element에 넣는다.
        element_layer.style.width = width + 'px';
        element_layer.style.height = height + 'px';
        element_layer.style.border = borderWidth + 'px solid';
        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
        element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
        element_layer.style.top = (((window.innerHeight - 100 || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
    }




</script>