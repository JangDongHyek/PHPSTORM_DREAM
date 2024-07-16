// 전역 변수
var errmsg = "";
var errfld = null;

// =================================================
// 포도씨
// -------------------------------------------------
$(function() {
    // 각 메뉴 클릭 시 a 태그 active
    $('#nav .gnb > li > a').each(function() {
        $(this).removeClass('active');
        var page = this.href.split('/').reverse()[0]; // 메뉴 페이지 help_list.php / career.php ...
        // window.location.href : 현재페이지 / this.href : 메뉴페이지
        if(window.location.href.indexOf('mypage_') == -1) { // 마이페이지 제외
            if(window.location.href.indexOf(page) != -1) {
                $(this).addClass('active');
            }
            if(window.location.href.indexOf('help_') != -1 && this.href.indexOf('help_') != -1) { // help_view.php에서는 별도 처리 (help_list.php 소속 메뉴)
                $(this).addClass('active');
            }
            if(window.location.href.indexOf('community_') != -1 && this.href.indexOf('community') != -1) { // community_list.php, community_view.php에서는 별도 처리 (community.php 소속 메뉴)
                $(this).addClass('active');
            }
            // company_write.php, company_view.php, estimate.php에서는 별도 처리 (company_list.php 소속 메뉴)
            if((window.location.href.indexOf('company_write') != -1 || window.location.href.indexOf('company_view') != -1 || window.location.href.indexOf('estimate') != -1) && this.href.indexOf('company_list.php') != -1) {
                $(this).addClass('active');
            }
            // career_write.php, career_view.php 에서는 별도 처리 (career.php 소속 메뉴)
            if((window.location.href.indexOf('career_write') != -1 || window.location.href.indexOf('career_view') != -1) && this.href.indexOf('career.php') != -1) {
                $(this).addClass('active');
            }
            // company.php 에서는 별도 처리 (company_search.php 소속 메뉴)
            if((window.location.href.indexOf('company.php') != -1) && this.href.indexOf('company_search.php') != -1) {
                $(this).addClass('active');
            }
            if((window.location.href.indexOf('shop_') != -1) && this.href.indexOf('shop.php') != -1) {
                $(this).addClass('active');
            }
        }
        // console.log('window',window.location.href);
        // console.log(this.href);
        // console.log(this);
    });
});

// 숫자만 입력 가능하도록
function only_number(data) {
    $('#'+data.id).val(data.value.replace(/[^\d]+/g, ''));
}

// 금액 입력 시 숫자만 입력 + 천단위 콤마
function comma_number(data) {
    $('#'+data.id).val(data.value.replace(/[^\d]+/g, ''));
    $('#'+data.id).val(data.value.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,'));
}

// 금액 콤마 제거
function removeComma(data) {
    return Number(data.replace(/,/gi, ''));
}

// 프로필 업데이트 (구분(일반/기업), 현재프로필단계, 저장후이동경로, 파일유무, 미니홈피이동)
function profile_update(category, mode, move, file, home) {
    var form = $('form')[0];
    var formData = new FormData(form);
    formData.append("mode", mode);

    if(file == 'Y') { // profile_company_update04.php 사용
        for(var i=0; i<filesTempArr.length; i++) { // 카달로그/카달로그 커버 등록
            formData.append("files[]", filesTempArr[i][1]);
            if(filesTempArr[i][2] != '') { formData.append("use_cover[]", i); }
            formData.append("covers[]", filesTempArr[i][2]);
        }
        for(var i=0; i<filesDelIdx.length; i++) { // 카달로그/카달로그 커버 삭제
            formData.append("del_files[]", filesDelIdx[i]);
        }
        for(var i=0; i<editCover.length; i++) { // 카달로그 커버 수정
            formData.append("edit_covers[]", editCover[i]);
        }
    }

    if(category == 'company') { category = "company_"; }
    else if(category == 'member') { category = ""; }

    $.ajax({
        url : g5_bbs_url + "/ajax.profile_"+category+"update.php",
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        cache: false,
        success : function(data) {
            if(data){
                if(home == 'home') { // 기업미니홈피 이동
                    location.href = g5_bbs_url+'/company.php?mb_no='+data;
                } else if(home == 'mypage') { // 마이페이지 이동
                    location.href = g5_bbs_url + '/mypage_company.php';
                } else {
                    var param = '';
                    if(home == 'Y') { param = '?company=Y'; } // 기업미니홈피로 이동할 수 있는 버튼 생성 위함
                    location.href = g5_bbs_url + '/profile_' + category + move +'.php' + param;
                }

            }
        },
        error : function(err) {
            swal(err.status);
        }
    });
}

// 프로필 업데이트 이전단계로 이동
function pre_move(path, home) {
    var param = '';
    if(home == 'Y') { param = '?company=Y'; }
    location.replace(g5_bbs_url+'/profile_'+path+'.php'+param);
}

// summernote 이미지 서버 업로드 (html 소스가 길어지고 파일 사이즈가 커지는 문제(속도 저하)때문에 서버 업로드)
function sendFile(editor, file){
    var form_data = new FormData();
    form_data.append('file', file);

    $.ajax({
        data:form_data,
        type:"POST",
        url:g5_bbs_url+'/ajax.summernote_upload.php',
        cache:false,
        contentType:false,
        processData:false,
        success:function(data){
            editor.summernote('insertImage', data, function (image) {
                image.attr('src', data);
                image.attr('class', 'childImg');
            });
        },
        error: function(data) {
            console.log('error', data);
        }
    });
}

// 체크박스를 라디오버튼처럼 동작(1개만 선택)
function checkOnlyOne(element) {
    var checkbox = document.getElementsByName(element.name);
    checkbox.forEach((cb)=>{
        cb.checked = false;
    });
    element.checked = true;

    // company_write.php
    if(element.value == "private") {
        $('.data_password').show();
    } else {
        $('#ci_password').val("");
        $('.data_password').hide();
    }
}

// 숫자 한글로 표시 (수정 필요)
function fmtNumberKor(val, id) {
    val = val.replace(/,/gi, '');

    var numKor = new Array("", "일", "이", "삼", "사", "오", "육", "칠", "팔", "구", "십"); // 숫자 문자
    var danKor = new Array("", "십", "백", "천", "", "십", "백", "천", "", "십", "백", "천", "", "십", "백", "천"); // 만단위 문자열
    var result = "";
    if(val && !isNaN(val)) { // CASE: 금액이 공란/NULL/문자가 포함된 경우가 아닌 경우에만 처리
        for(var i=0; i < val.length; i++) {
            var str = "";
            var num = numKor[val.charAt(val.length - (i+1))];
            if(num != "") str += num + danKor[i]; // 숫자가 0인 경우 텍스트를 표현하지 않음

            switch(i){
                case 4:
                    str += "만";
                    break; // 4자리인 경우 '만'을 붙여줌 ex) 10000 -> 일만
                case 8:
                    str += "억";
                    break; // 8자리인 경우 '억'을 붙여줌 ex) 100000000 -> 일억
                case 12:
                    str += "조";
                    break; // 12자리인 경우 '조'를 붙여줌 ex) 1000000000000 -> 일조
                }

                result = str + result;
        }
        result = result + "원";
    }

    $('#'+id).text(result);
    // return result ;
}

// a 링크 이동 시 http 유무 체크
function site_link(element, link) {
    if(link.indexOf('https://') == -1 && link.indexOf('http://') == -1) {
        link = 'http://' + link;
    }
    $(element).attr('href', link);
}

// 관심친구 +/-
function likeFriend(mb_id, mode) {
    $.ajax({
        url: g5_bbs_url + "/ajax.like_friend.php",
        data: {friend_mb_id: mb_id, mode: mode},
        type: 'POST',
        success: function (data) {
            if(data) {
                var msg = '';
                if(mode == 'add') {
                    msg = '관심친구로 등록되었습니다.';
                } else {
                    msg = '관심친구에서 삭제되었습니다.';
                }

                swal(msg)
                .then(()=>{
                    location.reload();
                });
            }
        },
    });
}

// 관심기업 +/-
function likeCompany(mb_id, mode) {
    $.ajax({
        url: g5_bbs_url + "/ajax.like_company.php",
        data: {company_mb_id: mb_id, mode: mode},
        type: 'POST',
        success: function (data) {
            if(data) {
                var msg = '';
                if(mode == 'add') {
                    msg = '관심기업으로 등록되었습니다.';
                } else {
                    msg = '관심기업에서 삭제되었습니다.';
                }

                swal(msg)
                .then(()=>{
                    location.reload();
                });
            }
        },
    });
}

// 로딩바 표시
function showLoadingBar() {
    var maskHeight = $(document).height();
    var maskWidth = window.document.body.clientWidth;
    var mask = "<div id='mask'></div>";
    var loadingImg = '';
    loadingImg += "<div id='loadingImg'>";
    loadingImg += "<img src='"+g5_url+"/img/loading.gif'/>";
    loadingImg += "</div>";
    $('body').append(mask).append(loadingImg);
    $('#mask').css({'width': maskWidth, 'height': maskHeight, 'opacity': '0.3'})
    $('#mask').show();
    $('#loadingImg').show();
}

// 로딩바 숨김
function hideLoadingBar() {
    $('#mask, #loadingImg').hide();
    $('#mask, #loadingImg').remove();
}

// 채팅방 입장
function chatting(you_mb_id, idx) {
    if(you_mb_id != '' && you_mb_id != undefined) {
        $('#you_mb_id').val(you_mb_id);
    }
    if(idx != '' && idx != undefined) { // 기업의뢰 채팅 시
        $('#inquiry_idx').val(idx);
    }
    $('#fchatting').submit();
}

// 프로필 조회 (use : 헬프미, 커뮤니티, 마이페이지(기업)-나의의뢰-요청견적)
function profileOpen(category, mb_id) {
    if(category == '일반') {
        $.ajax({
            url: g5_bbs_url + '/ajax.profile_modal.php',
            type: 'POST',
            data: {mb_id: mb_id},
            dataType: 'html',
            async: false,
            success: function(data) {
                $('.profile-modal-content').html(data);
            },
        });

        setTimeout(function() {
            // 소개글 길어지면 스타일 깨져서 추가
            if($('.profile-modal-content .top_box').innerHeight() >= 300) {
                $('.profile-modal-content .top_box').css('min-height', 'auto');
                $('.box_wrap').addClass('hauto');
            }
        }, 200);

        $('#profileModal').modal('show');
    }
}

// 비밀번호 정규식 (영문, 숫자, 특수문자 중 2종류 이상 조합, 8자리 이상)
function mbPasswordChk(password) {
    var pw = password;
    var num = pw.search(/[0-9]/);
    var eng = pw.search(/[a-z]/gi);
    var spe = pw.search(/[~#?!@$%^&*-]/gi);

    if((pw.length < 8) || ((num < 0 && eng < 0) || (eng < 0 && spe < 0) || (spe < 0 && num < 0))) {
        return false;
    }else {
        return true;
    }
}

// 회원 구분 - 지금 의뢰하기는 기업 회원만 가능
function memberCheck(category, mb_no, podosea) {
    if(category == '일반') {
        swal('기업회원만 이용할 수 있습니다.');
    } else {
        var param = '';
        if(podosea == 'podosea') { // 포도씨에 직접의뢰
            param = '?podosea=Y';
        } else {
            if(mb_no != '' && mb_no != undefined) { param = '?target=' + mb_no; }
        }
        location.href = g5_bbs_url+'/company_write.php'+param;
    }
}

// 검색어 입력 확인
function searchChk() {
    if($.trim($('#search').val()) == '') {
        swal('검색어를 입력해 주세요.');
        return false;
    }
    return true;
}

// 토글 초기화
function toggleClear() {
    $('.bottom .list_info .user_list').removeClass('active');
    $('.help_question .profile_info .user_list').removeClass('active');
    $('.help_question .list_comment .user_list').removeClass('active');
}

// 신고하기 모달
function reportOpen(mb_id, table, idx) {
    $('#report_id').val(mb_id);
    $('#report_rel_table').val(table);
    $('#report_rel_idx').val(idx);
    $('#reportModal').modal('show');
    // 모달 초기화
    $('input:checkbox[name="report"]').prop('checked', false);
    $('#report_contents').val('');
}

// 신고하기
var is_check = false;
function reportAction() {
    if(is_check) {
        is_check = false;
    }
    is_check = true;

    var reason = $('input:checkbox[name="report"]:checked').val(); // 신고유형
    if(reason == '') {
        swal('신고사유를 선택해주세요.');
        is_check = false;
        return false;
    }

    $.ajax({
        url: g5_bbs_url+'/ajax.report_action.php',
        type: 'POST',
        data: {target_mb_id: $('#report_id').val(), reason: reason, contents: $('#report_contents').val(), rel_table: $('#report_rel_table').val(), rel_idx: $('#report_rel_idx').val()},
        success: function(data) {
            if(data) {
                swal('신고를 완료하였습니다.\n관리자 확인 후 즉시 조치됩니다.')
                .then(()=>{
                    is_check = false;
                    $('#reportModal').modal('hide');
                });
            }
        },
    });
}

// 숨김/차단
function blockReview(mb_id, table, idx) {
    $.ajax({
        url: g5_bbs_url+'/ajax.block_action.php',
        type: 'POST',
        data: {target_mb_id: mb_id, rel_table: table, rel_idx: idx},
        success: function(data) {
            if(data) {
                swal('차단 처리되었습니다.')
                .then(()=>{
                    company_review();
                });
            }
        },
    });
}

// ==사용자 소메뉴 토글
var user_cls = '';
function userToggle(cls) {
    if(user_cls != cls) {
        $('.user_list').hide();
    }
    user_cls = cls;

    if($('.'+cls).attr('style').indexOf('block') != -1) {
        $('.'+cls).hide();
    } else {
        $('.'+cls).show();
    }
}

$(document).click(function(e) {
    // 다른 아이디(닉네임)의 소메뉴 클릭 시 이전 소메뉴 숨김
    if($('body').hasClass('user_list') === true) {
        $('.user_list').each(function() {
            if($(this).attr('style').indexOf('block') != -1) { // style="display: block;" 이면
                if($(this)[0]['classList'][0] != user_cls) { // 다른 회원의 프로필 클릭 시 열려 있는 소메뉴 숨김
                    $('.user_list').hide();
                }
            }
        });
    }
    if (!$(e.target).hasClass('toggle')) { // toggle 포함된 영역 밖 클릭 시 소메뉴 영역 숨김
        $('.user_list').hide();
    }
});
// ==//사용자 소메뉴 토글

// 모바일 기기 체크
function mobileCheck() {
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
    return isMobile;
}

// 글자수 및 한글/영문/숫자 체크
function lengthChk(el) {
    var length = el.value.length;
    var str = el.value.charAt(length-1); // 마지막에 입력받은 문자
    var flag = true;
    var reg = /[ㄱ-ㅎㅏ-ㅣ가-힣|a-zA-Z|0-9|\s]/g; // 한글/숫자체크
    //var reg_ko = /[ㄱ-ㅎㅏ-ㅣ가-힣|0-9|\s]/g; // 한글/숫자체크
    //var reg_eng = /[a-zA-Z|0-9|\s]/g; // 영문체크

    if(reg.test(str)) {
        if(length > 20) {
            swal("글자수를 초과하였습니다.\n(최대 20자)");
            el.value = el.value.substring(0, 20);
            flag = false;
        }
    }

    /*if(reg_ko.test(str)) { // 한글
        if(length > 10) {
            swal("글자수를 초과하였습니다.\n(최대 10자)");
            el.value = el.value.substring(0, 10);
            flag = false;
        }
    } else if(reg_eng.test(str)) { // 영어/숫자
        if(length > 20) {
            swal("글자수를 초과하였습니다.\n(최대 20자)");
            el.value = el.value.substring(0, 20);
            flag = false;
        }
    } else {
        flag = false;
    }

    if(!flag && str != "") {
        swal("특수문자는 입력할 수 없습니다.")
        .then(()=>{
            $('#'+el.id).val(el.value.substring(0, length-1));
        });
    }*/

    return flag;
}

// 에디터 내용 체크 (내용 없으면 <p><br><p>태그가 기본으로 찍혀서 설정)
function editorCheck() {
    if(!$('#editor').summernote('isEmpty')) { // 내용이 있으면
        return $('#editor').summernote('code'); // 내용
    } else {
        return '';
    }
}

// 기업마이페이지 - 나의의뢰 - 전체선택
function allChk() {
    var chk = document.getElementsByName("noshow_chk");
    for (var i=0; i<chk.length; i++) {
        chk[i].checked = $('.all_chk').is(':checked');
    }
}

// 기업마이페이지 - 나의의뢰 - 선택삭제 (리스트에서 숨김)
function myInquiryDelete(mode) {
    var idx = '';
    $('input:checkbox[name=noshow_chk]').each(function() {
        if(this.checked) {
            idx += this.value+',';
        }
    });
    idx = idx.slice(0, -1);

    if(idx == '') {
        swal('선택삭제할 자료를 선택해 주세요.');
        return false;
    }

    swal({
        text: "의뢰를 삭제하시겠습니까?\n삭제된 의뢰는 복구할 수 없습니다.",
        icon: "warning",
        buttons: {
            defeat: "확인",
            cancel: "취소",
        },
    })
    .then((value) => {
        switch (value) {
            case "defeat":
                $.ajax({
                    url: './ajax.myinquiry_delete.php',
                    data: {mode: mode, idx: idx},
                    type: 'post',
                    success: function(data) {
                        if(data) {
                            swal('의뢰가 삭제되었습니다.')
                            .then(()=>{
                                location.reload();
                            });
                        }
                    }
                });
            case "cancel":
                return false;
        }
    });
    $('.swal-modal').addClass('half'); // 버튼 스타일 때문에 추가
}

// IOS / Android 구분
function iOSaOS_check() {
    var userAgent = navigator.userAgent;
    return userAgent;
    if (userAgent.match(".*Android.*")) { //안드로이드
        // ANDROID
        return "AOS";
    } else if (userAgent.match(".*iPhone.*") || userAgent.match(".*iPad.*")) { //아이폰
        // IOS
        return "IOS";
    } else {
        // IOS, ANDROID 외
        return "OTHER";
    }
}

// 파일다운로드 (구분, 서버파일명, 실제파일명)
function fileDownload(mode, temp, real) {
    // <!--https://www.podosea.com/bbs/file_download.php?mode=chat&temp=${data.server_file_name}&real=${data.file_name}-->
    location.href = g5_bbs_url+'/file_download.php?mode='+mode+'&temp='+temp+'&real='+real;
}

// 콤마체크
function isComma(input) {
    var chars = ",";
    for(var i=0; i<input.length; i++) {
        if(chars.indexOf(input.charAt(i)) > -1) {
            return false;
        }
    }
    return true;
}

// 해시태그체크
function isTag(input) {
    var chars = "#";
    for(var i=0; i<input.length; i++) {
        if(chars.indexOf(input.charAt(i)) > -1) {
            return false;
        }
    }
    return true;
}

// 사용자차단
function userBlock(target, rel_table, rel_idx, url) {
    location.href = g5_bbs_url + '/ajax.user_block.php?target='+target+'&rel_table='+rel_table+'&rel_idx='+rel_idx+'&url='+url;
    /*$.ajax({
       url: g5_bbs_url+'/ajax.user_block.php',
       type: 'post',
       data: {target: target, rel_table: rel_table, rel_idx: rel_idx},
       success: function(data) {
           swal("사용자가 차단되었습니다.")
           .then(()=>{
               if(url == 'helpme') {
                   location.href = g5_bbs_url+'/help_list.php';
               }
               else if(url == 'community') {
                   location.href = g5_bbs_url+'/community.php';
               }
               else {
                   location.reload();
               }
           });
       },
    });*/
}

// 프로필 업데이트 체크
function profileCheck(data, menu, flag, mb_id) {
    if(mb_id == '' || mb_id == undefined) {
        swal("로그인 후 이용해 주세요.")
        .then(()=>{
           location.href = g5_bbs_url+'/login.php';
        });
        return false;
    }

    var url = '';
    if(menu == 'company') {
        url = g5_bbs_url + '/company.php?mb_no='+data;
    } else { // 'career'
        url = g5_bbs_url + '/career_view.php?idx=' + data;
    }

    if(flag) {
        location.href = url;
    } else {
        $('#profileChkModal').modal('show');
    }
}

// #해시태그 등록
function add_hash(data, count) {
    if(event.keyCode == 13) { // 엔터 누를 시 태그 생성
        event.preventDefault();

        // 빈칸 체크
        if($.trim(data.value).length == 0) {
            swal('태그를 입력해 주세요.');
            return false;
        }
        // 콤마 체크
        if(!isComma(data.value)) {
            swal('콤마는 입력할 수 없습니다.');
            $('#input_tag').val('');
            return false;
        }
        // 태그 체크
        if(!isTag(data.value)) {
            swal('#은 입력할 수 없습니다.');
            $('#input_tag').val('');
            return false;
        }
        // 최대 5개 처리
        if($('.tag_word').length == count) {
            swal('최대 '+count+'개까지 등록할 수 있습니다.');
            return false;
        }
        var tag = '<li class="tag_'+num+'"><span class="tag_word">#'+data.value+'<button type="button" class="btn_close" onclick="del_hash('+num+');"></button></span></li>';
        $('.tag_list').append(tag);
        $('#input_tag').val('');
        num++;
    }
}

// #해시태그 삭제
function del_hash(num) {
    $('.tag_'+num).remove();
}

// 자료실 - 찜
function likeReference(idx, mode) {
    if($('.wish_'+idx).hasClass("on")) $('.wish_'+idx).removeClass("on");
    else $('.wish_'+idx).addClass("on");

    $.ajax({
        url: g5_bbs_url + "/ajax.like_reference.php",
        data: {idx: idx, mode: mode},
        type: 'POST',
        success: function (data) {
            if(data) {
                referenceList();
            }
        },
    });
}
// =================================================

// 필드 검사
function check_field(fld, msg)
{
    if ((fld.value = trim(fld.value)) == "")
        error_field(fld, msg);
    else
        clear_field(fld);
    return;
}

// 필드 오류 표시
function error_field(fld, msg)
{
    if (msg != "")
        errmsg += msg + "\n";
    if (!errfld) errfld = fld;
    fld.style.background = "#BDDEF7";
}

// 필드를 깨끗하게
function clear_field(fld)
{
    fld.style.background = "#FFFFFF";
}

function trim(s)
{
    var t = "";
    var from_pos = to_pos = 0;

    for (i=0; i<s.length; i++)
    {
        if (s.charAt(i) == ' ')
            continue;
        else
        {
            from_pos = i;
            break;
        }
    }

    for (i=s.length; i>=0; i--)
    {
        if (s.charAt(i-1) == ' ')
            continue;
        else
        {
            to_pos = i;
            break;
        }
    }

    t = s.substring(from_pos, to_pos);
    //				alert(from_pos + ',' + to_pos + ',' + t+'.');
    return t;
}

// 자바스크립트로 PHP의 number_format 흉내를 냄
// 숫자에 , 를 출력
function number_format(data)
{

    var tmp = '';
    var number = '';
    var cutlen = 3;
    var comma = ',';
    var i;

    var sign = data.match(/^[\+\-]/);
    if(sign) {
        data = data.replace(/^[\+\-]/, "");
    }

    len = data.length;
    mod = (len % cutlen);
    k = cutlen - mod;
    for (i=0; i<data.length; i++)
    {
        number = number + data.charAt(i);

        if (i < data.length - 1)
        {
            k++;
            if ((k % cutlen) == 0)
            {
                number = number + comma;
                k = 0;
            }
        }
    }

    if(sign != null)
        number = sign+number;

    return number;
}

// 새 창
function popup_window(url, winname, opt)
{
    window.open(url, winname, opt);
}


// 폼메일 창
function popup_formmail(url)
{
    opt = 'scrollbars=yes,width=417,height=385,top=10,left=20';
    popup_window(url, "wformmail", opt);
}

// , 를 없앤다.
function no_comma(data)
{
    var tmp = '';
    var comma = ',';
    var i;

    for (i=0; i<data.length; i++)
    {
        if (data.charAt(i) != comma)
            tmp += data.charAt(i);
    }
    return tmp;
}

// 삭제 검사 확인
function del(href)
{
    if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
        var iev = -1;
        if (navigator.appName == 'Microsoft Internet Explorer') {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                iev = parseFloat(RegExp.$1);
        }

        // IE6 이하에서 한글깨짐 방지
        if (iev != -1 && iev < 7) {
            document.location.href = encodeURI(href);
        } else {
            document.location.href = href;
        }
    }
}

// 쿠키 입력
function set_cookie(name, value, expirehours, domain)
{
    var today = new Date();
    today.setTime(today.getTime() + (60*60*1000*expirehours));
    document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
    if (domain) {
        document.cookie += "domain=" + domain + ";";
    }
}

// 쿠키 얻음
function get_cookie(name)
{
    var find_sw = false;
    var start, end;
    var i = 0;

    for (i=0; i<= document.cookie.length; i++)
    {
        start = i;
        end = start + name.length;

        if(document.cookie.substring(start, end) == name)
        {
            find_sw = true
            break
        }
    }

    if (find_sw == true)
    {
        start = end + 1;
        end = document.cookie.indexOf(";", start);

        if(end < start)
            end = document.cookie.length;

        return unescape(document.cookie.substring(start, end));
    }
    return "";
}

// 쿠키 지움
function delete_cookie(name)
{
    var today = new Date();

    today.setTime(today.getTime() - 1);
    var value = get_cookie(name);
    if(value != "")
        document.cookie = name + "=" + value + "; path=/; expires=" + today.toGMTString();
}

var last_id = null;
function menu(id)
{
    if (id != last_id)
    {
        if (last_id != null)
            document.getElementById(last_id).style.display = "none";
        document.getElementById(id).style.display = "block";
        last_id = id;
    }
    else
    {
        document.getElementById(id).style.display = "none";
        last_id = null;
    }
}

function textarea_decrease(id, row)
{
    if (document.getElementById(id).rows - row > 0)
        document.getElementById(id).rows -= row;
}

function textarea_original(id, row)
{
    document.getElementById(id).rows = row;
}

function textarea_increase(id, row)
{
    document.getElementById(id).rows += row;
}

// 글숫자 검사
function check_byte(content, target)
{
    var i = 0;
    var cnt = 0;
    var ch = '';
    var cont = document.getElementById(content).value;

    for (i=0; i<cont.length; i++) {
        ch = cont.charAt(i);
        if (escape(ch).length > 4) {
            cnt += 2;
        } else {
            cnt += 1;
        }
    }
    // 숫자를 출력
    document.getElementById(target).innerHTML = cnt;

    return cnt;
}

// 브라우저에서 오브젝트의 왼쪽 좌표
function get_left_pos(obj)
{
    var parentObj = null;
    var clientObj = obj;
    //var left = obj.offsetLeft + document.body.clientLeft;
    var left = obj.offsetLeft;

    while((parentObj=clientObj.offsetParent) != null)
    {
        left = left + parentObj.offsetLeft;
        clientObj = parentObj;
    }

    return left;
}

// 브라우저에서 오브젝트의 상단 좌표
function get_top_pos(obj)
{
    var parentObj = null;
    var clientObj = obj;
    //var top = obj.offsetTop + document.body.clientTop;
    var top = obj.offsetTop;

    while((parentObj=clientObj.offsetParent) != null)
    {
        top = top + parentObj.offsetTop;
        clientObj = parentObj;
    }

    return top;
}

function flash_movie(src, ids, width, height, wmode)
{
    var wh = "";
    if (parseInt(width) && parseInt(height))
        wh = " width='"+width+"' height='"+height+"' ";
    return "<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' "+wh+" id="+ids+"><param name=wmode value="+wmode+"><param name=movie value="+src+"><param name=quality value=high><embed src="+src+" quality=high wmode="+wmode+" type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash' "+wh+"></embed></object>";
}

function obj_movie(src, ids, width, height, autostart)
{
    var wh = "";
    if (parseInt(width) && parseInt(height))
        wh = " width='"+width+"' height='"+height+"' ";
    if (!autostart) autostart = false;
    return "<embed src='"+src+"' "+wh+" autostart='"+autostart+"'></embed>";
}

function doc_write(cont)
{
    document.write(cont);
}

var win_password_lost = function(href) {
    window.open(href, "win_password_lost", "left=50, top=50, width=617, height=330, scrollbars=1");
}

$(document).ready(function(){
    $("#login_password_lost, #ol_password_lost").click(function(){
        win_password_lost(this.href);
        return false;
    });
});

/**
 * 포인트 창
 **/
var win_point = function(href) {
    var new_win = window.open(href, 'win_point', 'left=100,top=100,width=600, height=600, scrollbars=1');
    new_win.focus();
}

/**
 * 쪽지 창
 **/
var win_memo = function(href) {
    var new_win = window.open(href, 'win_memo', 'left=100,top=100,width=620,height=500,scrollbars=1');
    new_win.focus();
}

/**
 * 메일 창
 **/
var win_email = function(href) {
    var new_win = window.open(href, 'win_email', 'left=100,top=100,width=600,height=580,scrollbars=0');
    new_win.focus();
}

/**
 * 자기소개 창
 **/
var win_profile = function(href) {
    var new_win = window.open(href, 'win_profile', 'left=100,top=100,width=620,height=510,scrollbars=1');
    new_win.focus();
}

/**
 * 스크랩 창
 **/
var win_scrap = function(href) {
    var new_win = window.open(href, 'win_scrap', 'left=100,top=100,width=600,height=600,scrollbars=1');
    new_win.focus();
}

/**
 * 홈페이지 창
 **/
var win_homepage = function(href) {
    var new_win = window.open(href, 'win_homepage', '');
    new_win.focus();
}

/**
 * 우편번호 창
 **/
var win_zip = function(frm_name, frm_zip, frm_addr1, frm_addr2, frm_addr3, frm_jibeon) {
    if(typeof daum === 'undefined'){
        alert("다음 우편번호 postcode.v2.js 파일이 로드되지 않았습니다.");
        return false;
    }

    var zip_case = 1;   //0이면 레이어, 1이면 페이지에 끼워 넣기, 2이면 새창

    var complete_fn = function(data){
        // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

        // 각 주소의 노출 규칙에 따라 주소를 조합한다.
        // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
        var fullAddr = ''; // 최종 주소 변수
        var extraAddr = ''; // 조합형 주소 변수

        // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
        if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
            fullAddr = data.roadAddress;

        } else { // 사용자가 지번 주소를 선택했을 경우(J)
            fullAddr = data.jibunAddress;
        }

        // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
        if(data.userSelectedType === 'R'){
            //법정동명이 있을 경우 추가한다.
            if(data.bname !== ''){
                extraAddr += data.bname;
            }
            // 건물명이 있을 경우 추가한다.
            if(data.buildingName !== ''){
                extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
            }
            // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
            extraAddr = (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
        }

        // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
        var of = document[frm_name];

        of[frm_zip].value = data.zonecode;

        of[frm_addr1].value = fullAddr;
        of[frm_addr3].value = extraAddr;

        if(of[frm_jibeon] !== undefined){
            of[frm_jibeon].value = data.userSelectedType;
        }

        of[frm_addr2].focus();
    };

    switch(zip_case) {
        case 1 :    //iframe을 이용하여 페이지에 끼워 넣기
            var daum_pape_id = 'daum_juso_page'+frm_zip,
                element_wrap = document.getElementById(daum_pape_id),
                currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
            if (element_wrap == null) {
                element_wrap = document.createElement("div");
                element_wrap.setAttribute("id", daum_pape_id);
                element_wrap.style.cssText = 'display:none;border:1px solid;left:0;width:100%;height:300px;margin:5px 0;position:relative;-webkit-overflow-scrolling:touch;';
                element_wrap.innerHTML = '<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-21px;z-index:1" class="close_daum_juso" alt="접기 버튼">';
                jQuery('form[name="'+frm_name+'"]').find('input[name="'+frm_addr1+'"]').before(element_wrap);
                jQuery("#"+daum_pape_id).off("click", ".close_daum_juso").on("click", ".close_daum_juso", function(e){
                    e.preventDefault();
                    jQuery(this).parent().hide();
                });
            }

            new daum.Postcode({
                oncomplete: function(data) {
                    complete_fn(data);
                    // iframe을 넣은 element를 안보이게 한다.
                    element_wrap.style.display = 'none';
                    // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                    document.body.scrollTop = currentScroll;
                },
                // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분.
                // iframe을 넣은 element의 높이값을 조정한다.
                onresize : function(size) {
                    element_wrap.style.height = size.height + "px";
                },
                width : '100%',
                height : '100%'
            }).embed(element_wrap);

            // iframe을 넣은 element를 보이게 한다.
            element_wrap.style.display = 'block';
            break;
        case 2 :    //새창으로 띄우기
            new daum.Postcode({
                oncomplete: function(data) {
                    complete_fn(data);
                }
            }).open();
            break;
        default :   //iframe을 이용하여 레이어 띄우기
            var rayer_id = 'daum_juso_rayer'+frm_zip,
                element_layer = document.getElementById(rayer_id);
            if (element_layer == null) {
                element_layer = document.createElement("div");
                element_layer.setAttribute("id", rayer_id);
                element_layer.style.cssText = 'display:none;border:5px solid;position:fixed;width:300px;height:460px;left:50%;margin-left:-155px;top:50%;margin-top:-235px;overflow:hidden;-webkit-overflow-scrolling:touch;z-index:10000';
                element_layer.innerHTML = '<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" class="close_daum_juso" alt="닫기 버튼">';
                document.body.appendChild(element_layer);
                jQuery("#"+rayer_id).off("click", ".close_daum_juso").on("click", ".close_daum_juso", function(e){
                    e.preventDefault();
                    jQuery(this).parent().hide();
                });
            }

            new daum.Postcode({
                oncomplete: function(data) {
                    complete_fn(data);
                    // iframe을 넣은 element를 안보이게 한다.
                    element_layer.style.display = 'none';
                },
                width : '100%',
                height : '100%'
            }).embed(element_layer);

            // iframe을 넣은 element를 보이게 한다.
            element_layer.style.display = 'block';
    }
}

/**
 * 새로운 비밀번호 분실 창 : 101123
 **/
win_password_lost = function(href)
{
    var new_win = window.open(href, 'win_password_lost', 'width=617, height=330, scrollbars=1');
    new_win.focus();
}

/**
 * 설문조사 결과
 **/
var win_poll = function(href) {
    var new_win = window.open(href, 'win_poll', 'width=616, height=500, scrollbars=1');
    new_win.focus();
}

/**
 * 스크린리더 미사용자를 위한 스크립트 - 지운아빠 2013-04-22
 * alt 값만 갖는 그래픽 링크에 마우스오버 시 title 값 부여, 마우스아웃 시 title 값 제거
 **/
$(function() {
    $('a img').mouseover(function() {
        $a_img_title = $(this).attr('alt');
        $(this).attr('title', $a_img_title);
    }).mouseout(function() {
        $(this).attr('title', '');
    });
});

/**
 * 텍스트 리사이즈
**/
function font_resize(id, rmv_class, add_class)
{
    var $el = $("#"+id);

    $el.removeClass(rmv_class).addClass(add_class);

    set_cookie("ck_font_resize_rmv_class", rmv_class, 1, g5_cookie_domain);
    set_cookie("ck_font_resize_add_class", add_class, 1, g5_cookie_domain);
}

$(function(){
    $(".win_point").click(function() {
        win_point(this.href);
        return false;
    });

    $(".win_memo").click(function() {
        win_memo(this.href);
        return false;
    });

    $(".win_email").click(function() {
        win_email(this.href);
        return false;
    });

    $(".win_scrap").click(function() {
        win_scrap(this.href);
        return false;
    });

    $(".win_profile").click(function() {
        win_profile(this.href);
        return false;
    });

    $(".win_homepage").click(function() {
        win_homepage(this.href);
        return false;
    });

    $(".win_password_lost").click(function() {
        win_password_lost(this.href);
        return false;
    });

    /*
    $(".win_poll").click(function() {
        win_poll(this.href);
        return false;
    });
    */

    // 사이드뷰
    var sv_hide = false;
    $(".sv_member, .sv_guest").click(function() {
        $(".sv").removeClass("sv_on");
        $(this).closest(".sv_wrap").find(".sv").addClass("sv_on");
    });

    $(".sv, .sv_wrap").hover(
        function() {
            sv_hide = false;
        },
        function() {
            sv_hide = true;
        }
    );

    $(".sv_member, .sv_guest").focusin(function() {
        sv_hide = false;
        $(".sv").removeClass("sv_on");
        $(this).closest(".sv_wrap").find(".sv").addClass("sv_on");
    });

    $(".sv a").focusin(function() {
        sv_hide = false;
    });

    $(".sv a").focusout(function() {
        sv_hide = true;
    });

    // 셀렉트 ul
    var sel_hide = false;
    $('.sel_btn').click(function() {
        $('.sel_ul').removeClass('sel_on');
        $(this).siblings('.sel_ul').addClass('sel_on');
    });

    $(".sel_wrap").hover(
        function() {
            sel_hide = false;
        },
        function() {
            sel_hide = true;
        }
    );

    $('.sel_a').focusin(function() {
        sel_hide = false;
    });

    $('.sel_a').focusout(function() {
        sel_hide = true;
    });

    $(document).click(function() {
        if(sv_hide) { // 사이드뷰 해제
            $(".sv").removeClass("sv_on");
        }
        if (sel_hide) { // 셀렉트 ul 해제
            $('.sel_ul').removeClass('sel_on');
        }
    });

    $(document).focusin(function() {
        if(sv_hide) { // 사이드뷰 해제
            $(".sv").removeClass("sv_on");
        }
        if (sel_hide) { // 셀렉트 ul 해제
            $('.sel_ul').removeClass('sel_on');
        }
    });

    $(document).on( "keyup change", "textarea#wr_content[maxlength]", function(){
        var str = $(this).val();
        var mx = parseInt($(this).attr("maxlength"));
        if (str.length > mx) {
            $(this).val(str.substr(0, mx));
            return false;
        }
    });
});
