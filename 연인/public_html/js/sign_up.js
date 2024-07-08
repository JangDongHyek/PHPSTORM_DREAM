let month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'];
let day_arr = ['일', '월', '화', '수', '목', '금', '토'];
let auth_num = 0;		// 인증번호
let auth_flag = false;

const regFrm = document.fregisterform;

$(function () {
    // step2 노출 - 1)글 수정
    if (regFrm.w.value == "u") {
        $("#step01").hide();
        $("#step02").show();

        // 거주지역 구/군 호출
        //fnGetCity();
        checkCity();
    }

    // step2 노출 - 2)본인확인
    if (regFrm.w.value == "" && kcb_cert == "T") {
        $("#step01").hide();
        $("#step02").show();
        auth_flag = true;

        // 본인인증정보 체크
        // if (regFrm.mb_hp.value)
        if (regFrm.mb_hp.value == '' || regFrm.mb_name.value == '') {
            alert('본인확인 정보가 올바르지 않습니다.');
            location.href = g5_bbs_url + '/register_form.php';
        }
    }


    // 약관 내용보기
    $(".btn_agr .btn_red").click(function () {
        const textarea = $(this).parents(".agree").find(".agr_textarea");
        const display = textarea.css("display");

        if (display == "none") textarea.slideDown(100);
        else textarea.slideUp(100);
    });

    // 약관 전체동의
    $("#agree0").click(function () {
        if ($(this).is(":checked") == true) {
            $("#agree1, #agree2, #agree3").prop("checked", "checked");
        } else {
            $("#agree1, #agree2, #agree3").prop("checked", "");
        }
    });
    // 개별 약관 동의
    $("#agree1, #agree2, #agree3").click(function () {
        if ($("#agree1").is(":checked") && $("#agree2").is(":checked") && $("#agree3").is(":checked")) {
            $("#agree0").prop("checked", true);
        } else {
            $("#agree0").prop("checked", false);
        }
    });

    if (kcb_cert != 'T') {
        // 생년월일 달력호출
        const currentYear = new Date().getFullYear();
        $("#reg_mb_birth").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            showMonthAfterYear: true,
            monthNames: month_arr,
            monthNamesShort: month_arr,
            dayNames: day_arr,
            dayNamesShort: day_arr,
            dayNamesMin: day_arr,
            yearRange: "1900:" + currentYear,
        });
    }

//********** 필드검사 START **********
// 텍스트
    $(".f_txt").on("keyup", function () {
        var name = $(this).prop("name");

        // 수정시 비밀번호체크
        if ($(this).val().length == 0 && regFrm.w.value == "u" && (name == "mb_password" || name == "mb_password_re")) {
            setElementsFlag($(this), "init");
            return false;
        }
        getFrmValid(name);
    });

    // 텍스트-직접입력
    $("input[name=mb_job_str], input[name=mb_body_type_str], input[name=mb_hobby_str], input.step03_txt, input[name=mb_ideal_type_str]").on("keyup", function () {
        var name = $(this).data("name");
        getFrmValid(name);
    });

    // 셀렉트박스
    $(".f_slct").on("change", function () {
        var name = $(this).prop("name");
        getFrmValid(name);
    });

    // 라디오, 체크박스
    $("input[name=mb_sex], input[name='mb_ideal_type[]']").on("click", function () {
        var name = $(this).prop("name");

        if (name == "mb_ideal_type[]") {
            name = "mb_ideal_type";
            // 성격 직접입력체크시
            if ($(this).val() == "직접입력") {
                var flag = $(this).prop("checked");
                if (flag) $("input[name=mb_ideal_type_str]").removeClass("hide").addClass("show");
                else $("input[name=mb_ideal_type_str]").removeClass("show").addClass("hide").val("");
            }
        }

        getFrmValid(name);
    });
//********** 필드검사 END **********
});

// 회원등록/수정
function getSubmit(f) {
    var step = parseInt(f.step.value),
        w = f.w.value;

    if (w == "") {
        // 회원가입시 (사용X-본인인증으로 바뀜)
        switch (step) {
            case 1 :
                if($("#step").val() != "2"){
                    //alert("상단의 본인인증을 진행해주세요.");
                    //return  false;
                }
                /*
                // 휴대폰번호 검사
                if (!getFrmValid('mb_hp')) {
                    return false;
                }

                var input_auth_num = f.hp_auth.value,
                    err = $("#reg_hp_auth").parents("dd").next(".error_msg");

                // 인증번호받기확인
                if ($("#hp_auth_area").css("display") == "none") {
                    getFrmValid('hp_auth');
                    return false;
                }

                // 인증번호 확인
                if (input_auth_num != auth_num || input_auth_num.length != 6) {
                    err.addClass("on").html("인증번호 6자리가 맞지 않습니다.");
                    f.hp_auth.focus();
                    return false;
                } else {
                    err.removeClass("on").html("");
                    auth_flag = true;
                }

                if (!auth_flag) {
                    err.addClass("on").html("인증번호 6자리가 맞지 않습니다.");
                    return false;
                }
                */

                break;

            case 2 :
                // 동의체크
                if (!f.agree1.checked) {
                    window.scrollTo(0, 0)
                    alert('서비스 이용약관 동의를 체크해주세요.');
                    return false;
                }
                if (!f.agree2.checked) {
                    window.scrollTo(0, 0)
                    alert('개인정보처리방침 동의를 체크해주세요.');
                    return false;
                }

                if (!f.agree3.checked) {
                    window.scrollTo(0, 0)
                    alert('"연인" 소개팅 관련 정보 수신에 대한 동의를 체크해주세요.');
                    return false;
                }

                var valid_field = ["mb_join_path", "mb_id", "mb_password", "mb_password_re", "mb_name", "mb_sex", "mb_gu", "mb_birth", "mb_height", "mb_smoking", "mb_job", "mb_char", "mb_body_type", "mb_hobby", "mb_profile", "mb_img"];

                for (var field of valid_field) {
                    if (!getFrmValid(field)) {
                        return false;
                    }
                }

                break;

            case 3 :
                var valid_field = ["mb_ideal_type"];

                for (var field of valid_field) {
                    if (!getFrmValid(field)) {
                        return false;
                    }
                }

                break;
        }

    } else {
        // 회원정보수정시
        switch (step) {
            case 2 :
                var valid_field = ["mb_join_path", "mb_name", "mb_sex", "mb_gu", "mb_birth", "mb_height", "mb_smoking", "mb_job", "mb_char", "mb_body_type", "mb_hobby", "mb_profile", "mb_img"];

                if (f.mb_password.value.length > 0 || f.mb_password_re.value.length > 0) {
                    valid_field.push("mb_password");
                    valid_field.push("mb_password_re");
                }

                for (var field of valid_field) {
                    if (!getFrmValid(field)) {
                        return false;
                    }
                }

                break;

            case 3 :
                var valid_field = ["mb_ideal_type"];

                for (var field of valid_field) {
                    if (!getFrmValid(field)) {
                        return false;
                    }
                }

                break
        }
    }

    if (step == 1) {
        f.btn_submit.value = "STEP02 프로필입력 완료";
        $("#step01").slideUp();
        $("#step02").slideDown();

    } else if (step == 2) {
        f.btn_submit.value = "STEP03 이상형설정 완료";
        $("#step02").slideUp();
        $("#step03").slideDown();

    } else {
        $("#loader_wrap").show();
        f.submit();
    }

    step += 1;
    f.step.value = step;

    $(".j_tab li").removeClass("current");
    $(".j_tab li").eq(step - 1).addClass("current");
    $(window).scrollTop(0);

    // console.log(">> step" + step);
    $('#stepRoute').text(`STEP ${step}`).removeClass().addClass(`s${step}`);
}

// 필드유효성검사
function getFrmValid(t) {
    var f = regFrm;

    switch (t) {
        case "mb_join_path" :
            if ($("input[name='mb_join_path[]']:checked").length == 0) {
                alert("가입경로를 선택해 주세요.");
                $('html, body').animate({
                    scrollTop: $('.join_path_box').offset().top - 100,
                }, 500);
                return false;
            }
            break;

        case "mb_id" :
            var reg_mb_id = $("#reg_mb_id");
            mb_id = reg_mb_id.val(),
                regId = /^[a-z0-9]{4,12}$/;

            if (regId.test(mb_id)) {
                setElementsFlag(reg_mb_id, "on");
            } else {
                setElementsFlag(reg_mb_id, "off", "아이디는 영문(소문자)와 숫자, 4 ~ 12자리까지 가능합니다.");
                return false;
            }

            $.post(g5_bbs_url + "/ajax.mb_register.php", {"type": "mb_id", "val": mb_id}, function (result) {
                if (result == "0") {
                    setElementsFlag(reg_mb_id, "on");
                } else {
                    setElementsFlag(reg_mb_id, "off", "이미 사용 중이거나 탈퇴 된 아이디입니다.");
                    return false;
                }
            });
            break;

        case "mb_hp" :
            var err = $("#reg_mb_hp").parents("dd").next(".error_msg"),
                hp = f.reg_mb_hp.value,
                leng = hp.length,
                result = false;

            if (leng == 0) {
                err.addClass("on").html("휴대폰번호를 입력하세요.");
                f.reg_mb_hp.focus();
                return false;

            } else {
                $.ajax({
                    type: "post",
                    url: g5_bbs_url + "/ajax.mb_hp_chk.php",
                    data: {"reg_mb_hp": hp},
                    dataType: "text",
                    async: false,				// 비동기 처리
                    success: function (data) {
                        if (data != "T") {
                            if (data == "leave") {
                                data = "탈퇴된 회원입니다. <a href='./leave.php'>재가입안내 바로가기</a>";
                            }
                            err.addClass("on").html(data);
                            f.reg_mb_hp.focus();
                            result = false;
                        } else {
                            err.removeClass("on").html("");
                            result = true;
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("휴대폰번호가 올바르지 않습니다. 다시 시도해 주세요.");
                        f.reg_mb_hp.focus();
                    }
                });

                return result;
            }

            break;

        // case "hp_auth" :		// 휴대폰인증체크
        //     var err = $("#reg_mb_hp").parents("dd").next(".error_msg"),
        //         hp = f.reg_mb_hp.value,
        //         leng = hp.length,
        //         result = false;
        //
        //     if (leng < 10) {
        //         err.addClass("on").html("휴대폰번호를 정확히 입력하세요.");
        //         f.reg_mb_hp.focus();
        //         return false;
        //     } else {
        //         err.removeClass("on").html("");
        //     }
        //
        //     $.ajax({
        //         type: "post",
        //         url: g5_bbs_url + "/ajax.mb_hp_auth.php",
        //         data: {"reg_mb_hp": hp},
        //         dataType: "text",
        //         async: false,				// 비동기 처리
        //         success: function (data) {
        //             console.log(data);
        //             if (data == "leave") {
        //                 err.addClass("on").html("탈퇴된 회원입니다. <a href='./leave.php'>재가입안내 바로가기</a>");
        //                 f.reg_mb_hp.focus();
        //
        //             } else {
        //                 auth_num = parseInt(data);
        //                 result = true;
        //                 alert("인증번호가 발송되었습니다.");
        //                 $("#hp_auth_area").slideDown(1000);
        //                 f.hp_auth.focus();
        //             }
        //         },
        //         error: function (xhr, status, error) {
        //             alert("인증번호 발송에 실패하였습니다. 다시 시도해 주세요.");
        //             f.reg_mb_hp.focus();
        //         }
        //     });
        //
        //     return result;
        //
        //     break;

        case "mb_name" :
            var el = $("#reg_mb_name"),
                mb_name = el.val(),
                regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

            if (regName.test(mb_name)) {
                setElementsFlag(el, "on");
            } else {
                setElementsFlag(el, "off", "2글자 이상 한글만 입력해주세요.");
                return false;
            }
            break;

        case "mb_password" :
            var el = $("#reg_mb_password"),
                mb_password = el.val(),
                regPassword = /^[A-Za-z0-9+]*$/; ///^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

            if (regPassword.test(mb_password) && mb_password.length > 3) {
                setElementsFlag(el, "on");
            } else {
                setElementsFlag(el, "off", "비밀번호는 4자 이상 영문, 숫자만 가능합니다.");
                return false;
            }
            break;

        case "mb_password_re" :
            var el = $("#reg_mb_password_re"),
                mb_password_re = el.val(),
                mb_password = $("#reg_mb_password").val();

            if (mb_password == mb_password_re) {
                setElementsFlag(el, "on");
            } else {
                setElementsFlag(el, "off", "비밀번호가 일치하지 않습니다.");
                return false;
            }
            break;

        case "mb_sex" :
            var el = $("input[name=mb_sex]");

            if (el.is(":checked") == true) {
                setElementsFlag(el, "on");
            } else {
                setElementsFlag(el, "off", "성별을 선택하세요.");
                return false;
            }
            break;

        case "mb_gu" :
            var si = $('[name=mb_si]:checked').val() || '';
            var gu = $('[name=mb_gu]:checked').val() || '';
            var el = $('[name=mb_area_view]');

            if (si != '' && gu != '') {
                setElementsFlag(el, "on");
            } else {
                setElementsFlag(el, "off", "거주지역을 선택하세요.");
                return false;
            }
            break;

        case "mb_birth" :
            var el = $("#reg_mb_birth");

            if (el.val() != "") {
                setElementsFlag(el, "on");
            } else {
                setElementsFlag(el, "off", "생년월일을 입력하세요.");
                return false;
            }
            break;

        case "mb_height" :
            var el = $("#reg_mb_height");

            if (el.val() != "") {
                setElementsFlag(el, "on");
            } else {
                setElementsFlag(el, "off", "키를 입력하세요.");
                return false;
            }
            break;

        case "mb_smoking" :
            var value = $('[name=mb_smoking]:checked').val();
            var el = $('[name=mb_smoking_view]');

            if (value != undefined && value != '') {
                setElementsFlag(el, "on");
            } else {
                setElementsFlag(el, "off", "흡연을 선택하세요.");
                return false;
            }

            break;

        case "mb_job" :
            var value = $('[name=mb_job]:checked').val();
            var txtValue = $("input[name=mb_job_str]").val();
            var el = $('[name=mb_job_view]');

            if (value != undefined && value != '') {
                if (value == '직접입력' && txtValue == '') {
                    alert('직업을 입력하세요.');
                    return false;
                }
                setElementsFlag(el, "on");

            } else {
                setElementsFlag(el, "off", "직업을 선택하세요.");
                return false;
            }

            break;

        case "mb_char" :
            var checkboxes = $("input[name='mb_char[]']:checked");
            var el = $('[name=mb_char_view]');

            if (checkboxes.length < 2) {
                setElementsFlag(el, "off", "성격을 2개 이상 선택하세요.");
                alert("성격을 2개 이상 선택하세요.");
                return false;
            }

            var strCheck = true;
            checkboxes.each(function (index, element) {
                if ($(element).val() == '직접입력' && $('[name=mb_char_str]').val() == '') {
                    strCheck = false;
                }
            });
            if (!strCheck) {
                setElementsFlag(el, "off", "성격 '직접입력'을 입력하세요.");
                alert("성격 '직접입력'을 입력하세요.");
                return false;
            }

            setElementsFlag(el, "on");
            break;

        case "mb_body_type" :
            var value = $('[name=mb_body_type]:checked').val();
            var txtValue = $("input[name=mb_body_type_str]").val();
            var el = $('[name=mb_body_type_view]');

            if (value != undefined && value != '') {
                if (value == '직접입력' && txtValue == '') {
                    alert('체형을 입력하세요.');
                    return false;
                }
                setElementsFlag(el, "on");

            } else {
                setElementsFlag(el, "off", "체형을 선택하세요.");
                return false;
            }

            break;

        case "mb_hobby" :
            var value = $('[name=mb_hobby]:checked').val();
            var txtValue = $("input[name=mb_hobby_str]").val();
            var el = $('[name=mb_hobby_view]');

            if (value != undefined && value != '') {
                if (value == '직접입력' && txtValue == '') {
                    alert('취미를 입력하세요.');
                    return false;
                }
                setElementsFlag(el, "on");

            } else {
                setElementsFlag(el, "off", "취미를 선택하세요.");
                return false;
            }
            break;

        case "mb_profile" :
            var el = $("#reg_mb_profile");

            if (el.val() != "") {
                setElementsFlag(el, "on");

            } else {
                setElementsFlag(el, "off", "내 소개를 입력하세요.");
                return false;
            }
            break;

        case "mb_img" :
            var leng = $("#prev_area .p_box").length;
            if (leng < 2) {
                alert("사진을 2장 이상 등록하셔야 합니다.");
                return false;
            }
            break;

        case "mb_ideal_type" :
            var el = $("input[name='mb_ideal_type[]']"),
                txt = $("input[name=mb_ideal_type_str]"),
                chked = $("input[name='mb_ideal_type[]']:checked");

            if ($("#itp").is(":checked") && txt.val() == "") {	// 이상형설정 직접입력 체크시
                setElementsFlag(txt, "off", "이상형을 입력하세요.");
                return false;
            }
            if (chked.length < 2) {
                setElementsFlag(el, "off", "이상형을 2개 이상 선택하세요.");
                return false;
            }
            setElementsFlag(el, "on");
            break;
        case "mb_5" :
            var el = $("#mb_5");

            if (el.val() != "") {
                setElementsFlag(el, "on");
            } else {
                setElementsFlag(el, "off", "카카오 아이디를 입력하세요.");
                return false;
            }
            break;

    }
    return true;
}

// 필드유효성검사 결과on,off
function setElementsFlag(el, type, msg) {
    var bullet = el.parents(".rows").find("i"),
        err_msg = el.parents(".rows").find(".error_msg");

    bullet.removeClass();

    if (type == "on") {
        bullet.addClass("on"); //.css("background", "#1EC545");
        err_msg.removeClass("on").html("");
    } else if (type == "init") {
        err_msg.removeClass("on").html("");
    } else {
        bullet.addClass("fail"); //css("background", "#E84438");
        err_msg.addClass("on").html(msg);
        el.focus();
    }
}

// 직접입력 필드체크
function getSelctdChk(el) {
    var input = el.nextSibling.nextSibling;

    if (el.value == "직접입력") {
        input.classList.remove("hide");
        input.classList.add("show");
        input.focus();
    } else {
        input.classList.remove("show");
        input.classList.add("hide");
        input.value = "";
    }
}

// ****************************************************
// 이미지업로드
var file_num = 0;	// 업로드파일 순번

// 이미지업로드 동적생성
function getImgUpload() {
    var area = document.getElementById("img_after"),
        input = document.createElement('input'),
        leng = $("#prev_area .p_box").length;

    file_num = leng;

    if (leng > 4) { // 5장까지
        alert("최대 5장까지 등록 가능합니다.");
        return false;
    }

    input.setAttribute("type", "file");
    input.setAttribute("accept", "image/*");
    input.setAttribute("name", "bf_file[]");
    input.setAttribute("id", "f" + file_num);
    input.setAttribute("onchange", "getImgPrev(this)");

    area.appendChild(input);

    var elem = document.getElementsByName("bf_file[]"),
        eq = elem.length;

    elem[eq - 1].click();
}

// 이미지업로드 미리보기
function getImgPrev(input) {
    var reg_ext = /(.*?)\.(jpg|jpeg|png|bmp)$/;

    if (!reg_ext.test(input.files[0].name)) {
        alert("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp)");
        return false;
    }

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var area = document.getElementById("prev_area"),
                div = document.createElement('div'),
                div_img = document.createElement('div'),
                img = document.createElement('img'),
                btn = document.createElement('button');

            div.setAttribute("class", "p_box");
            div.setAttribute("id", "box" + file_num);

            div_img.setAttribute("class", "img_bd");
            img.setAttribute("class", "p_img");
            img.setAttribute("src", e.target.result);

            btn.setAttribute("type", "button");
            btn.setAttribute("class", "btn");
            btn.setAttribute("onclick", "getImgDel('w', " + file_num + ")");
            btn.innerHTML = "X";

            div_img.appendChild(img);
            div.appendChild(div_img);
            div.appendChild(btn);
            area.appendChild(div);

            file_num++;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// 이미지미리보기/업로드된 이미지 삭제
function getImgDel(mode, idx) {
    if (mode == "w") {
        var input = document.getElementById("f" + idx),
            prev = document.getElementById("box" + idx);

        input.parentNode.removeChild(input);
        prev.parentNode.removeChild(prev);

    } else if (mode == "u") {
        var input = document.getElementById("bf_file_del" + idx),
            prev = document.getElementById("ubox" + idx);

        if (confirm("사진을 삭제하시겠습니까?") == true) {
            input.value = 1;
            prev.parentNode.removeChild(prev);
        } else {
            return false;
        }
    }
}

// ****************************************************

// 시/도 변경 - modal open
function checkCity() {
    let si = $("[name=mb_si]:checked").val();

    if (!si) {
        $("#gu_item_list").html("시/도를 선택하세요");
        return false;
    }

    $.ajax({
        type: "GET",
        url: g5_url + "/plugin/address/address.php",
        dataType: "json",
        data: {"si": si},
        success: function (datas) {
            let checked = "", radio = "", radio_id = "";
            $("#gu_item_list").html("");

            for (let i = 0; i < datas.length; i++) {
                checked = (regFrm.old_mb_gu.value == datas[i]) ? "checked" : "";
                radio_id = "gu" + i;
                radio = `<input type="radio" name="mb_gu" id="${radio_id}" value="${datas[i]}" ${checked} onclick="checkGu(this)">
                         <label for="${radio_id}">${datas[i]}</label>`;

                $("#gu_item_list").append(radio);
            }
        },
        error: function (request, status, error) {
            console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            $("#gu_item_list").html("시/도를 선택하세요");
            alert("구/군 정보를 불러오는데 실패했습니다.");
        }
    });
}

// 구/군 선택
function checkGu(elem) {
    regFrm.old_mb_gu.value = elem.value;
}

// 지역 선택완료
function saveMyArea() {
    if (regFrm.mb_si.value == '') {
        return alert('시/도를 선택해 주세요.');
    }
    if (!regFrm.mb_gu || (regFrm.mb_gu && regFrm.mb_gu.value == '')) {
        return alert('구/군을 선택해 주세요.');
    }

    regFrm.mb_area_view.value = regFrm.mb_si.value + " " + regFrm.mb_gu.value;
    $("#areaModal").modal("hide");
}

// 흡연여부 modal 선택완료
function saveMySmoking() {
    if (!getFrmValid('mb_smoking')) return;

    regFrm.mb_smoking_view.value = regFrm.mb_smoking.value;
    $("#smokingModal").modal("hide");
}

// 직업 modal 직접입력
$("input[name='mb_job']").on("click", function () {
    let input = $("input[name=mb_job_str]");
    if (this.value == "직접입력") {
        (this.checked) ? input.removeClass("hide") : input.addClass("hide");
    } else {
        input.addClass("hide");
        input.val("");
    }
});

// 직업 modal 선택완료
function saveMyJob() {
    if (!getFrmValid('mb_job')) return;

    let value = regFrm.mb_job.value;
    if (value == '직접입력') value = regFrm.mb_job_str.value;

    regFrm.mb_job_view.value = value;
    $("#jobModal").modal("hide");
}

// 성격 modal 직접입력
$("input[name='mb_char[]']").on("click", function () {
    if (this.value == "직접입력") {
        let input = $("input[name=mb_char_str]");
        (this.checked) ? input.removeClass("hide") : input.addClass("hide");
    }
});

// 성격 modal 선택완료
function saveMyChar() {
    if (!getFrmValid('mb_char')) return;

    let checkboxes = $("input[name='mb_char[]']:checked");
    let arr = [];
    checkboxes.each(function (index, element) {
        if ($(element).val() == '직접입력') {
            arr.push($('[name=mb_char_str]').val());
        } else {
            arr.push($(element).val());
        }
    });
    regFrm.mb_char_view.value = arr.join(',');
    $('#charModal').modal('hide');
}

// 체형 modal 직접입력
$("input[name='mb_body_type']").on("click", function () {
    let input = $("input[name=mb_body_type_str]");
    if (this.value == "직접입력") {
        (this.checked) ? input.removeClass("hide") : input.addClass("hide");
    } else {
        input.addClass("hide");
        input.val("");
    }
});

// 체형 modal 선택완료
function saveMyBodyType() {
    if (!getFrmValid('mb_body_type')) return;

    let value = regFrm.mb_body_type.value;
    if (value == '직접입력') value = regFrm.mb_body_type_str.value;

    regFrm.mb_body_type_view.value = value;
    $("#bodyModal").modal("hide");
}

// 취미 modal 직접입력
$("input[name='mb_hobby']").on("click", function () {
    let input = $("input[name=mb_hobby_str]");
    if (this.value == "직접입력") {
        (this.checked) ? input.removeClass("hide") : input.addClass("hide");
    } else {
        input.addClass("hide");
        input.val("");
    }
});

// 취미 modal 선택완료
function saveMyHobby() {
    if (!getFrmValid('mb_hobby')) return;

    let value = regFrm.mb_hobby.value;
    if (value == '직접입력') value = regFrm.mb_hobby_str.value;

    regFrm.mb_hobby_view.value = value;
    $("#hobbyModal").modal("hide");
}