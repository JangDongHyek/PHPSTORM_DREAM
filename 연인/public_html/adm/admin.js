function check_all(f)
{
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}

function btn_check(f, act)
{
    if (act == "update") // 선택수정
    {
        f.action = list_update_php;
        str = "수정";
    }
    else if (act == "delete") // 선택삭제
    {
        f.action = list_delete_php;
        str = "삭제";
    }
    else
        return;

    var chk = document.getElementsByName("chk[]");
    var bchk = false;

    for (i=0; i<chk.length; i++)
    {
        if (chk[i].checked)
            bchk = true;
    }

    if (!bchk)
    {
        alert(str + "할 자료를 하나 이상 선택하세요.");
        return;
    }

    if (act == "delete")
    {
        if (!confirm("선택한 자료를 정말 삭제 하시겠습니까?"))
            return;
    }

    f.submit();
}

function is_checked(elements_name)
{
    var checked = false;
    var chk = document.getElementsByName(elements_name);
    for (var i=0; i<chk.length; i++) {
        if (chk[i].checked) {
            checked = true;
        }
    }
    return checked;
}

function delete_confirm(el)
{
    if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
        var token = get_ajax_token();
        var href = el.href.replace(/&token=.+$/g, "");
        if(!token) {
            alert("토큰 정보가 올바르지 않습니다.");
            return false;
        }
        el.href = href+"&token="+token;
        return true;
    } else {
        return false;
    }
}

function delete_confirm2(msg)
{
    if(confirm(msg))
        return true;
    else
        return false;
}

function get_ajax_token()
{
    var token = "";

    $.ajax({
        type: "POST",
        url: g5_admin_url+"/ajax.token.php",
        cache: false,
        async: false,
        dataType: "json",
        success: function(data) {
            if(data.error) {
                alert(data.error);
                if(data.url)
                    document.location.href = data.url;

                return false;
            }

            token = data.token;
        }
    });

    return token;
}

$(function() {
    $(document).on("click", "form input:submit", function() {
        var f = this.form;
        var token = get_ajax_token();

        if(!token) {
            alert("토큰 정보가 올바르지 않습니다.");
            return false;
        }

        var $f = $(f);

        if(typeof f.token === "undefined")
            $f.prepend('<input type="hidden" name="token" value="">');

        $f.find("input[name=token]").val(token);

        return true;
    });
});

// bbs 사진업로드 체크
function uploadImgFiles(input) {
    if (input.files[0] == undefined) {
        console.log("undefined");
        return false;
    }

    let reg_ext = /(.*?)\.(jpg|jpeg|png)$/;

    if (!reg_ext.test(input.files[0].name)) {
        alert("이미지만 등록이 가능합니다. (jpg, jpeg, png)");
        $(input).val("");
        return false;
    }

    // 최대용량 체크
    let max_size_mb = 4, //4mb
        max_byte = max_size_mb * 1024 * 1024,
        file_byte = input.files[0].size;

    if (file_byte > max_byte) {
        alert("이미지가 최대 용량 (" + max_size_mb + "mb)을 초과합니다.");
        $(input).val("");
        return false;
    }
}

// 회원프로필 팝업
function getMemberPop(mb_id) {
    let url = g5_admin_url + "/member_form.php?w=u&mb_id=" + mb_id;
    let pop_w = 1200;
    let pop_h = 800;
    let title = "회원프로필";

    var left = Math.floor((window.innerWidth - pop_w) / 2),
        top = Math.floor((window.innerHeight - pop_h) / 2);
    var ts = new Date().getTime();
    title += " " + ts;
    window.open(url, title,"width="+pop_w+"px,height="+pop_h+"px,top="+top+",left="+left+",scrollbars=yes");
}

/**
 * BBS 게시판
 */
// 목록 전체선택
function allCheckedBbsList(sw) {
    let f = document.fboardlist;
    for (let i=0; i<f.length; i++) {
        if (f.elements[i].name == "idx[]")
            f.elements[i].checked = sw;
    }
}

// 목록 선택삭제
function deleteBbsList(mode) {
    let chkbox = document.querySelectorAll("input[name='idx[]']:checked");
    if (chkbox.length == 0) {
        alert("선택삭제 할 게시글을 선택하세요.");
        return false;
    }

    if (!confirm("삭제 하시겠습니까? 삭제된 게시글은 복구되지 않습니다.")) return false;

    let chk_list = [];
    for (let i=0; i<chkbox.length; i++) {
        chk_list.push(chkbox[i].value);
    }

    $.ajax({
        type : "POST",
        url : "./ajax.board_update.php",
        data : {mode: mode, list: chk_list},
        dataType : "json",
    }).done(function(data, textStatus, xhr) {
        if (data.result) location.reload();
        else alert("삭제에 실패했습니다. 잠시 후 다시 시도해 주세요.");
    }).fail(function(data, textStatus, errorThrown) {
        alert("삭제에 실패했습니다. 잠시 후 다시 시도해 주세요.");
    });
}

// 상세보기 삭제
function deleteBbsOne(mode, idx) {
    if (!confirm("삭제 하시겠습니까? 삭제된 게시글은 복구되지 않습니다.")) return false;

    let chk_list = [idx];

    $.ajax({
        type : "POST",
        url : "./ajax.board_update.php",
        data : {mode: mode, list: chk_list},
        dataType : "json",
    }).done(function(data, textStatus, xhr) {
        if (data.result) {
            switch (mode) {
                case "refundDelete" : // 환불요청
                    location.href = "./refund.php"; break;
                case "couponDelete" : // 쿠폰발급요청
                    location.href = "./coupon.php"; break;
                case "reportDelete" : // 신고게시판
                    location.href  = "./report.php"; break;
                case "basicDelete" : // 기본게시판
                    location.href = document.referrer; break;
                default :
                    history.back();
            }
        }
        else alert("삭제에 실패했습니다. 잠시 후 다시 시도해 주세요.");
    }).fail(function(data, textStatus, errorThrown) {
        alert("삭제에 실패했습니다. 잠시 후 다시 시도해 주세요.");
    });
}

// 코멘트 등록
function commentSubmit(f) {
    if (f.content.value == "") {
        alert("답변내용을 입력해 주세요.")
        f.content.focus();
        return false;
    }

    // ajax submit
    let frmData = new FormData($(f)[0]);
    frmData.append("mode", "commentWrite");

    $.ajax({
        url: "./ajax.board_update.php",
        data: frmData,
        type: "POST",
        async: false,
        // enctype: "multipart/form-data",
        processData: false,
        contentType: false,
    }).done(function(response, textStatus, xhr) {
        let data = JSON.parse(response);
        console.log(data);
        if (data.result) {
            location.reload();
        } else {
            alert("등록에 실패했습니다. 잠시 후 다시 시도해 주세요.");
        }
    }).fail(function(data, textStatus, errorThrown) {
        console.log("[serverUploadImage] : [error] : ", xhr);
        alert("등록에 실패했습니다. 잠시 후 다시 시도해 주세요.");
    });

    return false;
}

// 코멘트 수정 열기
function commentEditOpen(idx) {
    document.querySelector("#edit_box_" + idx).style.display = "block";
}

// 코멘트 수정
function commentEdit(idx) {
    let content = document.querySelector("#comment_" + idx).value;
    let data = {idx: idx, content: content, mode: "commentWrite"};

    $.ajax({
        type : "POST",
        url : "./ajax.board_update.php",
        data : data,
        dataType : "json",
    }).done(function(data, textStatus, xhr) {
        console.log(data);
        if (data.result) location.reload();
        else alert("수정에 실패했습니다. 잠시 후 다시 시도해 주세요.");
    }).fail(function(data, textStatus, errorThrown) {
        alert("수정에 실패했습니다. 잠시 후 다시 시도해 주세요.");
    });
}

// 코멘트 삭제
function commentDelete(idx) {
    if (!confirm("선택하신 댓글을 삭제하시겠습니까?")) return false;

    $.ajax({
        type : "POST",
        url : "./ajax.board_update.php",
        data : {mode: "commentDelete", idx: idx},
        dataType : "json",
    }).done(function(data, textStatus, xhr) {
        console.log(data);
        if (data.result) location.reload();
        else alert("삭제에 실패했습니다. 잠시 후 다시 시도해 주세요.");
    }).fail(function(data, textStatus, errorThrown) {
        alert("삭제에 실패했습니다. 잠시 후 다시 시도해 주세요.");
    });
}