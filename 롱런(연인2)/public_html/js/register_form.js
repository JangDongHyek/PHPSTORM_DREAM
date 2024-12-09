/**
 * smartWizard 하단 버튼 설정
 */
$(function () {
    // Toolbar extra buttons
    let btnFinish = $('<button data-toggle="modal" data-target="#myResult"></button>').addClass('btn btn-contact disabled');
    if (document.frm1.w.value == "u") btnFinish.text("회원수정");
    else btnFinish.text("회원가입");
    //.on('click', function(){  window.location = "join_step_result.php";});
    //var btnCancel = $('<button></button>').text('Cancel')
    //								 .addClass('btn btn-danger')
    //								 .on('click', function(){ $('#work_step').smartWizard("reset"); });
    btnFinish.on("click", function() {
       registerMember();
    });

    // Step show event
    $("#join_step").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
        if(stepPosition === 'first') {
            $("#step-1").removeClass("hide");
        } else if(stepPosition === 'last') {
            $(".btn-contact.disabled").removeClass('disabled');
        } else {
            $("#step-1").addClass("hide");
            $(".btn-contact").addClass('disabled');
        }
    });

    // leaveStep event
    $("#join_step").on("leaveStep", function(e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
        console.log(`leaveStep currentStepIndex=${currentStepIndex}, nextStepIndex=${nextStepIndex}`);
        if (currentStepIndex > nextStepIndex) { // 이전 스텝으로 이동
            if (document.frm1.w.value == "u") {
                // 회원수정시 1,2 스텝 불가
                if (currentStepIndex > 2) return true;
                else return false;
            } else {
                return true;
            }
        }

        let form = document.frm1;
        let check_fields = [];
        let msg = "";

        switch (currentStepIndex) {
            case 0 : // step1. 본인인증
                // location.href = g5_bbs_url + "/kcb/phone_popup1.php";
                fnNicePopup();
                return false;
                break;

            case 1 : // step2. 약관동의
                msg = validAgreeCheck();
                break;

            case 2 : // step3. 기본정보
                if (form.w.value == "u") { // 회원정보수정
                    check_fields = ['path'];
                    if (form.mb_password.value != "" || form.mb_password_re.value != "")
                        check_fields.push('mb_password');

                } else { // 회원가입
                    check_fields = ['path', 'mb_id', 'mb_password'];
                }
                msg = validFormCheck(check_fields);
                break;

            case 3 : // step4. 프로필
                check_fields = ['mb_si', 'mb_height', 'mb_smoking', 'mb_job', 'mb_char', 'mb_body_type', 'mb_hobby', 'mb_car_yn', 'mb_drinking', 'mb_profile', 'mb_photo'];
                msg = validFormCheck(check_fields);
                break;

            // case 4 : // step5. 이상형 --> 마지막step이라 submit으로 이동
            //     check_fields = ['ideal_type'];
            //     msg = validFormCheck(check_fields);
            //     break;
        }

        if (msg != "") {
            swal(msg);
            return false;
        }

        return true;
    });

    // Smart Wizard
    $('#join_step').smartWizard({
        selected: 0,
        theme: 'default', // default, arrows, dots, progress
        // darkMode: true,
        transition: {
            animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
        },
        toolbarSettings: {
            toolbarPosition: 'bottom', // both bottom
            toolbarExtraButtons: [btnFinish]
        },
        lang: { // Language variables for button
            next: '다음',
            previous: '이전'
        },
        keyboardSettings: {
            keyNavigation: false, // 키보드 화살표 X
        }
    });

    // enter form 막기
    document.addEventListener('keydown', function(event) {
        if (event.keyCode === 13 && event.target.tagName != "TEXTAREA") {
            event.preventDefault();
        };
    }, true);

});

/**
 * 회원정보 수정시
 */
$(function () {
    if (document.frm1.w.value == "u") {
        // 거주지역 구/군 호출
        //fnGetCity();
        checkCity();
    }
});

/**
 * step2. 약관동의
 */
// 약관 내용보기
$(".btn-agr").click(function () {
    var dis = $(this).parents(".agree-row").find(".agr_textarea").css("display");
    if (dis == "none")
        $(this).parents(".agree-row").find(".agr_textarea").slideDown(100);
    else
        $(this).parents(".agree-row").find(".agr_textarea").slideUp(100);
});

// 약관동의 체크확인
function validAgreeCheck() {
    let chk_box = document.querySelectorAll("input[name='reg_req[]']");
    let err_msg = "";
    for (let i=0; i<chk_box.length; i++) {
        if (!chk_box[i].checked) {
            if (chk_box[i].value == 1) err_msg = "서비스 이용약관 동의는 필수입니다.";
            else if (chk_box[i].value == 2) err_msg = "개인정보처리방침 동의는 필수입니다.";
            else if (chk_box[i].value == 3) err_msg = "롱런 소개팅 관련 정보 수신에 대한 동의는 필수입니다.";
            break; // switch 는 먹통
        }
    }
    return err_msg;
}

/**
 * step4. 프로필
 */
// 시/도 변경 - modal open
function checkCity() {
    let si = $("[name=mb_si]:checked").val();

    if (!si) {
        $("#gu_item_list").html("시/도를 선택하세요");
        return false;
    }

    $.ajax({
        type : "GET",
        url : g5_url + "/plugin/address/address.php",
        dataType : "json",
        data : {"si": si},
        success : function(datas){
            let checked = "", radio = "", radio_id = "";
            $("#gu_item_list").html("");

            for(let i = 0; i < datas.length; i++){
                checked = (document.frm1.old_mb_gu.value == datas[i])? "checked" : "";
                radio_id = "gu" + i;
                radio = `<input type="radio" name="mb_gu" id="${radio_id}" value="${datas[i]}" ${checked} onclick="checkGu(this)">
                         <label for="${radio_id}">${datas[i]}</label>`;

                $("#gu_item_list").append(radio);
            }
        },
        error : function(request,status,error){
            console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
            $("#gu_item_list").html("시/도를 선택하세요");
            alert("구/군 정보를 불러오는데 실패했습니다.");
        }
    });
}
// 구/군 선택
function checkGu(elem) {
    document.frm1.old_mb_gu.value = elem.value;
}
// 지역 선택완료
function saveMyArea() {
    let msg = validFormCheck(['mb_si']);
    if (msg != "") {
        swal(msg);
        return false;
    } else {
        let txt = document.frm1.mb_si.value + " " + document.frm1.mb_gu.value;
        $("#mb_area_view").text(txt);
        $("#areaModal").modal("hide");
    }
}

// 시/도 변경 - select (사용안함)
/*function fnGetCity() {
    let si = $("#mb_si").val();

    $("#mb_gu").find("option").remove();
    $("#mb_gu").append("<option value=''>구/군 전체</option>");

    if (!si) {
        return false;
    }

    $.ajax({
        type : "GET",
        url : g5_url + "/plugin/address/address.php",
        dataType : "json",
        data : {"si": si},
        success : function(datas){
            let opt_select = "", opt = "";

            for(let i = 0; i < datas.length; i++){
                opt_select = (document.frm1.old_mb_gu.value == datas[i])? "selected" : "";
                opt = "<option value='" + datas[i] + "' " + opt_select + ">" + datas[i] + "</option>";

                $("#mb_gu").append(opt);
            }
        },
        error : function(request,status,error){
            console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
            alert("거주지역 정보를 불러오는데 실패했습니다.");
            history.back();
        }
    });
}*/

// 직접입력 필드체크
function getSelectedChk(el) {
    let input = $(el).parents("dl").find(".input_area");
    if (el.value == "직접입력") {
        input.removeClass("hide");
        input.children("input[type=text]").focus();
    } else {
        input.addClass("hide");
        input.children("input[type=text]").val("");
    }
}

// 흡연여부 modal 선택완료
function saveMySmoking() {
    let msg = validFormCheck(['mb_smoking']);
    if (msg != "") {
        swal(msg);
        return false;
    } else {
        let txt = document.frm1.mb_smoking.value;
        $("#mb_smoking_view").text(txt);
        $("#smokingModal").modal("hide");
    }
}

// 직업 modal 직접입력
$("input[name='mb_job']").on("click", function() {
    let input = $("input[name=mb_job_str]");
    if (this.value == "직접입력") {
        (this.checked)? input.removeClass("hide") : input.addClass("hide");
    } else {
        input.addClass("hide");
        input.val("");
    }
});

// 직업 modal 선택완료
function saveMyJob() {
    let msg = validFormCheck(['mb_job']);
    if (msg != "") {
        swal(msg);
        return false;
    } else {
        let txt = document.frm1.mb_job.value;
        if (txt == "직접입력") txt = document.frm1.mb_job_str.value;
        $("#mb_job_view").text(txt);
        $("#jobModal").modal("hide");
    }
}

// 성격 modal 직접입력
$("input[name='mb_char[]']").on("click", function() {
    if (this.value == "직접입력") {
        let input = $("input[name=mb_char_str]");
        (this.checked)? input.removeClass("hide") : input.addClass("hide");
    }
});

// 성격 modal 선택완료
function saveMyChar() {
    let msg = validFormCheck(['mb_char']);
    if (msg != "") {
        swal(msg);
        return false;
    } else {
        let chk_list = document.querySelectorAll("input[name='mb_char[]']:checked");
        let chk_val = [];
        for (let i=0; i<chk_list.length; i++) {
            if (chk_list[i].value == "직접입력") chk_val.push(document.frm1.mb_char_str.value);
            else chk_val.push(chk_list[i].value);
        }
        $("#mb_char_view").text(chk_val.join(","));
        $("#charModal").modal("hide");
    }
}

// 체형 modal 직접입력
$("input[name='mb_body_type']").on("click", function() {
    let input = $("input[name=mb_body_type_str]");
    if (this.value == "직접입력") {
        (this.checked)? input.removeClass("hide") : input.addClass("hide");
    } else {
        input.addClass("hide");
        input.val("");
    }
});

// 체형 modal 선택완료
function saveMyBodyType() {
    let msg = validFormCheck(['mb_body_type']);
    if (msg != "") {
        swal(msg);
        return false;
    } else {
        let txt = document.frm1.mb_body_type.value;
        if (txt == "직접입력") txt = document.frm1.mb_body_type_str.value;
        $("#mb_body_type_view").text(txt);
        $("#bodyModal").modal("hide");
    }
}

// 취미 modal 직접입력
$("input[name='mb_hobby']").on("click", function() {
    let input = $("input[name=mb_hobby_str]");
    if (this.value == "직접입력") {
        (this.checked)? input.removeClass("hide") : input.addClass("hide");
    } else {
        input.addClass("hide");
        input.val("");
    }
});

// 취미 modal 선택완료
function saveMyHobby() {
    let msg = validFormCheck(['mb_hobby']);
    if (msg != "") {
        swal(msg);
        return false;
    } else {
        let txt = document.frm1.mb_hobby.value;
        if (txt == "직접입력") txt = document.frm1.mb_hobby_str.value;
        $("#mb_hobby_view").text(txt);
        $("#hobbyModal").modal("hide");
    }
}

// 음주 modal 선택완료
function saveMyDrinking() {
    let msg = validFormCheck(['mb_drinking']);
    if (msg != "") {
        swal(msg);
        return false;
    } else {
        $("#mb_drinking_view").text(document.frm1.mb_drinking.value);
        $("#drinkingModal").modal("hide");
    }
}

// 이미지업로드 동적생성
let file_num = $("#prev_area .img_item").length;	// 업로드파일 순번
function getImgUpload() {
    let length = $("#prev_area .img_item").length;

    if (length > 4) { // 최대 5장까지
        swal("사진은 5장까지 등록 가능 합니다.");
        return false;
    }
    // file_num = length;

    let area = $("#dynamic_files");
    let input = $(`<input type="file" accept="image/*" name="img_file[]" id="file${file_num}" onchange="getImgPrev(this)" id="f${file_num}">`);

    area.append(input);
    input.click();
}

// 이미지업로드 미리보기
function getImgPrev(input) {
    let reg_ext = /(.*?)\.(jpg|jpeg|png|bmp)$/;

    if (!reg_ext.test(input.files[0].name)) {
        alert("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp)");
        return false;
    }

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            let html = `<li class="img_item" id="item${file_num}">`;
            html += `<p><img src="${e.target.result}"></p>`;
            html += `<a class="del_btn" onclick="getImgDel('w', '${file_num}')"><i class="fa-light fa-xmark"></i></a>`;
            html += `</li>`;

            $("#prev_area ul").append(html);

            file_num++;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// 이미지미리보기/업로드된 이미지 삭제
let deleteOldImgIdx = [];
function getImgDel(mode, idx) {
    swal("선택하신 사진을 삭제하시겠습니까?", {
        buttons: {
            cancel: "닫기",
            catch: {text: "삭제", value: "catch",},
        },
    }).then((value) => {
        if (value == "catch") {
            let input = $(`#file${idx}`);
            let prev = $(`#item${idx}`);

            if (mode == 'w') { // 회원가입
                input.remove();
                prev.remove();

            } else { // 회원수정
                let del_idx = prev.data("idx");
                deleteOldImgIdx.push(del_idx);
                prev.remove();
            }
        }
    });
}

/**
 * step5. 이상형
 */
// 성격선택 - 직접입력
$("input[name='mb_ideal_type[]']").on("click", function() {
    if (this.value == "직접입력") {
        let input = $("input[name=mb_ideal_type_str]");
        (this.checked)? input.removeClass("hide") : input.addClass("hide");
        $('.tab-content').scrollTop(1000);
    }
});

/**
 * step 공통
 */
// 폼 체크
function validFormCheck(...fields) {
    let f = document.frm1;
    // console.log(fields[0]);

    for (let i=0; i<fields[0].length; i++) {
        let name = fields[0][i];
        let chk_list = [];

        switch (name) {
            case "path" :         // 가입경로
                if (document.querySelectorAll("input[name='mb_join_path[]']:checked").length == 0) {
                    $('.tab-content').scrollTop(0);
                    return "가입경로를 선택해 주세요.";
                }
                break;

            case "mb_id" :          // 아이디
                let regType = /^[A-Za-z0-9]{4,25}$/;
                if (!regType.test(f[name].value)) {
                    $('.tab-content').scrollTop(0);
                    return "아이디를 4자이상 입력해 주세요. (영문/숫자)";
                }
                let msg = reg_mb_id_check();
                if (msg != "") return msg;
                break;

            case "mb_password" :    // 비밀번호, 비밀번호확인
                if (f[name].value.length < 4) {
                    return "비밀번호를 4자 이상 입력해 주세요.";
                } else {
                    if (f['mb_password_re'].value.length < 4)
                        return "비밀번호확인을 4자 이상 입력해 주세요.";
                    if (f[name].value != f['mb_password_re'].value)
                        return "비밀번호와 비밀번호확인이 일치하지 않습니다.";
                }
                break;

            case "mb_si" : // 거주지역 (시, 구군)
                if (f.mb_si.value == "") {
                    $('.tab-content').scrollTop(0);
                    return "거주지역 시/도를 선택해 주세요.";
                }
                if (f.mb_gu.value == "") {
                    $('.tab-content').scrollTop(0);
                    return "거주지역 구/군을 선택해 주세요.";
                }
                break;

            case "mb_height" : // 키
                if (f[name].value == "") {
                    $('.tab-content').scrollTop(0);
                    return "키를 입력해 주세요.";
                }
                break;

            case "mb_smoking" : // 흡연여부
                if (f[name].value == "") {
                    // $('.tab-content').scrollTop(0);
                    return "흡연여부를 선택해 주세요.";
                }
                break;

            case "mb_job" : // 직업
                if (f[name].value == "") {
                    // $('.tab-content').scrollTop(0);
                    return "직업을 선택해 주세요.";
                } else if (f[name].value == "직접입력" && f['mb_job_str'].value == "") {
                    return "직업 '직접입력' 란을 입력해 주세요.";
                }
                break;

            case "mb_char" :    // 성격 2개이상
                chk_list = document.querySelectorAll("input[name='mb_char[]']:checked");
                if (chk_list.length < 2) {
                    return "성격을 2개 이상 선택하세요.";
                } else {
                    // 직접입력 확인
                    for (let i=0; i<chk_list.length; i++) {
                        if (chk_list[i].value=="직접입력" && f.mb_char_str.value == "") {
                            return "성격 '직접입력' 란을 입력해 주세요.";
                            break;
                        }
                    }
                }
                break;

            case "mb_body_type" : // 체형
                if (f[name].value == "") {
                    // $('.tab-content').scrollTop(0);
                    return "체형을 선택해 주세요.";
                } else if (f[name].value == "직접입력" && f['mb_body_type_str'].value == "") {
                    return "체형 '직접입력' 란을 입력해 주세요.";
                }
                break;

            case "mb_hobby" : // 취미
                if (f[name].value == "") {
                    // $('.tab-content').scrollTop(1000);
                    return "취미를 선택해 주세요.";
                } else if (f[name].value == "직접입력" && f['mb_hobby_str'].value == "") {
                    // $('.tab-content').scrollTop(1000);
                    return "취미 '직접입력' 란을 입력해 주세요.";
                }
                break;

            case "mb_car_yn" :  // 자차
                if (f[name].value == "") {
                    $('.tab-content').scrollTop(1000);
                    return "자차 유무를 선택해 주세요.";
                }
                break;

            case "mb_drinking" :  // 음주
                if (f[name].value == "") {
                    // $('.tab-content').scrollTop(1000);
                    return "음주를 선택해 주세요.";
                }
                break;

            case "mb_profile" : // 내소개
                if (f[name].value == "") {
                    $('.tab-content').scrollTop(1000);
                    return "내 소개를 입력해 주세요.";
                }
                break;

            case "mb_photo" :   // 사진등록 2장이상
                let length = $("#prev_area .img_item").length;
                if (length < 2) {
                    $('.tab-content').scrollTop(1000);
                    return "사진등록을 2장 이상 등록해 주세요.";
                }
                break;

            case "ideal_type" : // 이상형등록
                chk_list = document.querySelectorAll("input[name='mb_ideal_type[]']:checked");
                if (chk_list.length == 0) {
                    return "이상형등록을 선택해 주세요.";
                }

                // 직접입력 확인
                for (let i=0; i<chk_list.length; i++) {
                    if (chk_list[i].value=="직접입력" && f.mb_ideal_type_str.value == "") {
                        return "이상형 '직접입력' 란을 입력해 주세요.";
                        break;
                    }
                }
                break;
        }
    }

    return "";
}

// 회원가입완료
function registerMember() {
    let f = document.frm1;
    let err_msg = "";
    let frm_data = new FormData($(f)[0]);
    let prefix = f.w.value == "u"? "회원수정" : "회원가입";

    if (f.w.value == "") { // 회원가입
        let check_fields = ['ideal_type', 'path', 'mb_id', 'mb_password', 'mb_si', 'mb_height', 'mb_smoking', 'mb_job', 'mb_char', 'mb_body_type', 'mb_hobby', 'mb_car_yn', 'mb_drinking', 'mb_profile', 'mb_photo'];
        err_msg = validFormCheck(check_fields);
        if (err_msg != "") {
            swal(err_msg);
            return false;
        }

    } else { // 회원수정
        let check_fields = ['ideal_type', 'path', 'mb_si', 'mb_height', 'mb_smoking', 'mb_job', 'mb_char', 'mb_body_type', 'mb_hobby', 'mb_car_yn', 'mb_drinking', 'mb_profile', 'mb_photo'];
        err_msg = validFormCheck(check_fields);
        if (err_msg != "") {
            swal(err_msg);
            return false;
        }

        // 기존사진 삭제시
        frm_data.append("deleteOldImgIdx", deleteOldImgIdx.join(","));
    }

    err_msg = `${prefix}에 실패했습니다. 잠시 후 다시 시도해 주세요.`;

    showLoading(1);

    $.ajax({
        url: "./ajax.register_form_update.php",
        data: frm_data,
        type: "POST",
        async: false,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
    }).done(function(response, textStatus, xhr) {
        let data = JSON.parse(response);
        // console.log(data);
        showLoading();

        if (data.result) {
            swal(`${prefix}이 완료되었습니다.`, {
                buttons: {
                    cancel: "닫기",
                },
            }).then((value) => {
                if (f.w.value == "u") {
                    history.pushState(null, null, g5_url + "/app/index.php");
                    location.href = g5_url + "/app/mypage.php#refresh";
                } else {
                    // 롱런 웹 회원가입 완료이면 페이스북 픽셀실행
                    if (is_web_longlun && is_web_longlun == 'Y') {
                        fbTagging(1);

                    } else {
                        if (f.app_type.value == "AOS" && parseInt(f.app_ver.value) >= 1) {
                            // 페이스북 SDK (aos ver 1 이상)
                            saveFacebookLogEvent('회원가입');
                        }
                    }

                    location.href = g5_url + "/app/index.php";
                }
            });
        } else {
            if (data.err_msg != "") err_msg = data.err_msg;
            swal(err_msg);
        }
    }).fail(function(data, textStatus, errorThrown) {
        showLoading();
        swal(err_msg);

    }).always(function() {
        // setTimeout(() => {
        //     showLoading();
        // }, 1000);

    });

    // console.log('submit');
    return false;
}
