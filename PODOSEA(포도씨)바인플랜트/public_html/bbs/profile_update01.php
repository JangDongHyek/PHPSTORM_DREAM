<?php
include_once('./_common.php');

$g5['title'] = '프로필 업데이트';
include_once('./_head.php');

loginCheck($member['mb_id'], '일반');

$mb = get_member($member['mb_id']); // 회원정보

$cert_flag = false;
if(!empty($mb['mb_certify'])) { $cert_flag = true; }
?>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/mobile/skin/member/app_basic/style.css?v=<?= G5_CSS_VER ?>">
<style>
	.profile_top .list_step > li.active:before{width:20%;}
	.profile_content h3{text-align:center !important;}
    .box-article #join_info .row .error.on {
        color: #FF0000;
    }
    .box-article #join_info .row .error {
        font-size: 0.85em;
        color: #858585;
        padding: 0;
    }
</style>

<div class="mbskin">
	<article class="box-article">
		<h3>프로필 업데이트</h3>
        <form id="fprofile" name="fprofile" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" id="del_file" name="del_file" value="<?=$mb['mb_img_idx']?>">
            <input type="hidden" name="mb_certify" value="hp_sms">
            <div id="area_join" class="profile">
                <div id="join_info">
                    <div class="profile_top">
                        <ul class="list_step">
                            <li class="active">
                                <em>1</em>
                                <span>회원소개</span>
                            </li>
                            <li>
                                <em>2</em>
                                <span>경력사항</span>
                            </li>
                            <li>
                                <em>3</em>
                                <span>학력, 전공 <span class="option">선택사항</span></span>
                            </li>
                            <li>
                                <em>4</em>
                                <span>보유 기술, 자격증 <span class="option">선택사항</span></span>
                            </li>
                            <li>
                                <em>5</em>
                                <span>추가정보</span>
                            </li>
                        </ul>
                    </div>
                    <div class="profile_content">
                        <h3>회원님에 대해 소개해주세요!</h3>
                        <div class="profile_box">
                            <div class="area_photo">
                                <a class="upload" href="javascript:void(0);" onclick="file_add();"></a>
                                <input type="file" name="file" id="file" onchange="getImgPrev(this);" accept="image/*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">

                                <!-- 등록 이미지 있을 때 -->
                                <div class="p_box">
                                    <div class="img_rd">
                                    <?php echo getProfileImg($mb['mb_id'], $mb['mb_category']); ?>
                                    </div>
                                </div>
                            </div>
                            <dl class="row">
                            <dt>닉네임<!--을 작성해주세요.--><em>*선택</em></dt>
                            <dd>
                                <div class="input">
                                    <input type="text" name="mb_nick" id="reg_mb_nick" value="<?=$mb['mb_nick']?>" class="regist-input" placeholder="닉네임을 입력해 주세요.">
                                    <input type="hidden" name="mb_id" id="reg_mb_id" value="<?=$mb['mb_id']?>">
                                </div>
                            </dd>
                            <dd class="error col-xs-12"></dd>
                        </dl>
                        </div>

                        <dl class="row">
                            <dt>이름</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" name="mb_name" value="<?=$mb['mb_name']?>" id="reg_mb_name" class="regist-input required f_empty" required <?=$readonly?> placeholder="이름을 입력해 주세요.">
                                </div>
                            </dd>
                            <dd class="error col-xs-12"></dd>
                        </dl>

                        <dl class="row hp">
                            <dt>휴대폰번호</dt>
                            <dd>
                                <div class="input <?php if(!$cert_flag) { ?>v1<?php } ?>">
                                    <input type="tel" name="mb_hp" value="<?=$mb['mb_hp']?>" id="reg_mb_hp" class="regist-input required" required placeholder="휴대폰번호를 입력해 주세요." minlength="10" maxlength="13">
                                    <?php if(!$cert_flag) { ?><button type="button" class="btn_hp" onclick="hpCertify();">인증번호</button><?php } ?>
                                </div>
                                <?php if(!$cert_flag) { ?>
                                    <div class="input cert">
                                        <input type="text" style="background-color: #f9f9f9 !important;" name="cert_no" value="" id="cert_no" disabled class="regist-input" placeholder="인증번호를 입력해 주세요." maxlength="6" onkeyup="only_number(this);">
                                    </div>
                                <?php } ?>
                            </dd>
                            <dd class="error col-xs-12"></dd>
                        </dl>

                        <dl class="row">
                            <dt>활동중인 비즈니스 분야를 선택해 주세요</dt>
                            <dd>
                                <div class="input">
                                    <select id="mb_active_business" name="mb_active_business" required>
                                        <option value="">선택해주세요</option>
                                        <?php for ($i=1; $i<=count($business_active_list); $i++){ ?>
                                            <option value="<?=$i?>" <?php echo $member['mb_active_business'] == $i ? 'selected' : ''?>><?=$business_active_list[$i]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </dd>
                            <dd class="error col-xs-12"></dd>
                        </dl>

                        <dl class="row">
                            <dt>간략한 자기소개를 작성해주세요.</dt>
                            <dd>
                                <div class="input">
                                    <textarea id="mb_introduce" name="mb_introduce" placeholder="예)조선해양 프로젝트 전문가 ?&#13;&#10;수리서비스경력 10년" required><?=$mb['mb_introduce']?></textarea>
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>지역</dt>
                            <dd>
                                <div class="input">
                                    <select id="mb_si" name="mb_si" required>
                                        <option value="" selected >선택해주세요</option>
                                        <option value="서울">서울</option>
                                        <option value="인천">인천</option>
                                        <option value="부산">부산</option>
                                        <option value="울산">울산</option>
                                        <option value="대구">대구</option>
                                        <option value="대전">대전</option>
                                        <option value="광주">광주</option>
                                        <option value="세종">세종</option>
                                        <option value="경기(평택)">경기(평택)</option>
                                        <option value="경남(거제,창원)">경남(거제,창원)</option>
                                        <option value="경북(포항)">경북(포항)</option>
                                        <option value="전남(목포,여수)">전남(목포,여수)</option>
                                        <option value="전북(군산,부안)">전북(군산,부안)</option>
                                        <option value="충남(당진,서산)">충남(당진,서산)</option>
                                        <option value="충북">충북</option>
                                        <option value="강원">강원</option>
                                        <option value="제주">제주</option>
                                    </select>
                                </div>
                            </dd>
                        </dl>
                        <div class="area_btn">
                            <!-- input 다작성하면 a class="active" 추가 -->
                            <a href="javascript:void(0);" class="btn_next">다음</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	</article>
</div>

<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<script>
    $(function() {
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
        // 이름 입력
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
        // 휴대폰번호 입력
        $("#reg_mb_hp").keyup(function (){
            var mb_hp = $(this).val();
            var reg_mb_hp = $(this);
            var state = $(this).parents(".row").find(".status_ico");
            var err = $(this).parents(".row").find(".error");

            // 휴대폰 정규표현식
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
        // 지역
        $('#mb_si').val('<?=$mb['mb_si']?>').attr("selected", "selected");
        // 폼체크
        form_check();

        // input 전부 작성 시 active 클래스 추가
        $(":input").on("change keyup", function(e) {
            form_check();
        });
    });

    // 폼체크(필수값)
    function form_check() {
        if($.trim($('#reg_mb_name').val()).length != 0 && $('#reg_mb_hp').val().length != '' && $('#cert_no').val() != '' && $('#mb_active_business').val() != '' && $.trim($('#mb_introduce').val()).length != 0 && $('#mb_si').val() != "") {
            $('.btn_next').addClass('active');
            $('.btn_next').attr('href', 'javascript:profile_update();');
        } else {
            $('.btn_next').removeClass('active');
            $('.btn_next').attr('href', 'javascript:void(0);');
        }
    }

    // 프로필 사진 등록
    function file_add() {
        $("#file").click();
    }

    // 사진 미리보기
    var filesTempArr = [];
    function getImgPrev(input) {
        var regex = /(.*?)\.(jpg|jpeg|png|PNG|bmp|JPG|gif)$/;

        if (!regex.test(input.files[0].name)) {
            swal("이미지만 등록이 가능합니다.\n(jpg/jpeg/png/bmp/gif)");
            input.value = "";
            return false;
        }

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var div = document.createElement('div'),
                    div_img = document.createElement('div'),
                    img = document.createElement('img');
                // btn = document.createElement('button');

                var el = $(input),
                    prev_area = el.nextAll("div.p_box"),
                    file_area = el.nextAll("div.wr_files");
                if (prev_area.length > 0) prev_area.remove();
                //if (file_area.length > 0) file_area.remove();

                div.setAttribute("class", "p_box");

                div_img.setAttribute("class", "img_rd");
                img.setAttribute("class", "p_img");
                img.setAttribute("src", e.target.result);
                img.setAttribute("style", "width:80px;height:80px;border-radius:50px");

                // btn.setAttribute("type", "button");
                // btn.setAttribute("class", "btn");
                // btn.innerHTML = "X";

                div_img.appendChild(img);
                div.appendChild(div_img);
                // div.appendChild(btn);

                el.after(div);
            }
            reader.readAsDataURL(input.files[0]);

            var files = input.files;
            var files_arr = Array.prototype.slice.call(files);
            filesTempArr.push(files_arr);

            /*var form = $('form')[0];
            var formData = new FormData(form);
            formData.append("file[]", filesTempArr);

            // return false;
            // 이미지 등록
            $.ajax({
                url : g5_bbs_url + "/ajax.profile_update.php",
                processData: false,
                contentType: false,
                data: formData,
                type: 'POST',
                success : function(data) {
                    if(data){
                        swal('사진 등록이 완료되었습니다.');
                        $('#del_file').val(data);
                    }else{
                        swal("통신에 실패했습니다.");
                    }
                },
                err : function(err) {
                    alert(err.status);
                }
            });*/
        }
    }

    // 닉네임 중복 검사
    $("#reg_mb_nick").keyup(function () {
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
                err.html("");
            }
        }
        else {
            err.html("");
        }
    });

    // 프로필 업데이트 - 회원소개
    var is_post = false;
    function profile_update() {
        if(is_post) {
            return false;
        }
        is_post = true;

        // 닉네임중복체크
        if($.trim($('#reg_mb_nick').val()) != 0) {
            var msg = reg_mb_nick_check();
            if (msg) {
                swal(msg);
                $('#reg_mb_nick').focus();
                is_post = false;
                return false;
            }
        }

        var submit = true;
        var f = $('#fprofile')[0];

        if (f.mb_name.value == "") {
            swal('이름을 입력하세요.');
            f.mb_name.focus();
            is_post = false;
            return false;
        }
        if(f.mb_hp.value == "") {
            swal("휴대폰번호를 입력하세요.");
            f.mb_hp.focus();
            is_post = false;
            return false;
        }
        <?php if(!$cert_flag) { ?>
        if(f.cert_no.value == "") {
            swal("인증번호를 입력하세요.");
            f.cert_no.focus();
            is_post = false;
            return false;
        }
        if($("#cert_no").is(".chk_err") === true) {
            swal("인증번호를 확인하세요.");
            is_post = false;
            return false;
        }
        // 인증번호 입력 후 휴대폰번호 변경 시 알림창
        $.ajax({
            url: './ajax.hp_certify.php',
            type: 'post',
            data: {hp: $('#reg_mb_hp').val(), cert_no: $('#cert_no').val(), mode: 'check'},
            async: false,
            success: function(data) {
                if (data == 'no_cert') {
                    swal('휴대폰번호가 변경되었습니다.\n새로운 인증을 진행해 주세요.');
                    is_post = false;
                    submit = false;
                }
            },
        });
        <?php } ?>
        if (!submit) {
            return false;
        }

        if(f.mb_active_business.value == "") {
            swal("활동중인 비즈니스 분야를 선택하세요.");
            is_post = false;
            return false;
        }

        var form = $('form')[0];
        var formData = new FormData(form);
        formData.append("file[]", filesTempArr);
        formData.append("mode", 'profile01');

        $.ajax({
            url : g5_bbs_url + "/ajax.profile_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success : function(data) {
                if(data){
                    location.href = '<?php echo G5_BBS_URL ?>/profile_update02.php';

                    //if('<?//=$member['mb_active_business']?>//' == 1) { // 학생 또는 취업준비생이면 2단계 경력사항에 해당되지 않으므로 3단계(학력, 전공)로 바로 넘어감
                    //     swal("경력사항에 해당사항이 없으므로\n학력, 전공 입력으로 넘어갑니다.")
                    //     .then(()=>{
                    //        location.href = '<?php //echo G5_BBS_URL ?>///profile_update03.php';
                    //     });
                    // } else {
                    //    location.href = '<?php //echo G5_BBS_URL ?>///profile_update02.php';
                    // }
                }
            },
            err : function(err) {
                swal(err.status);
            }
        });
    }

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
            data: {hp: $('#reg_mb_hp').val(), mode: 'send'},
            success: function(data) {
                if(data == 'success') {
                    swal('인증번호를 발송하였습니다.')
                        .then(()=>{
                            $('#cert_no').attr('disabled', false);
                            $('#cert_no').css('background-color', 'unset');
                            $('#cert_no').focus();
                        })
                }
                else if(data == 'fail') {
                    swal('휴대폰번호를 입력해 주세요.');
                    return false;
                }
            },
        });
    }
</script>

<?
include_once('./_tail.php');
?>