<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style_pro.css">', 0);
$url = "";
?>
<link rel="stylesheet" href="<?= $member_skin_url?>/competition.css">

<?
include_once('./_common.php');
$g5['title'] = '재능등록';
include_once('./_head.php');
$name = "item_write";

//재능정보
$idx = $_REQUEST['idx'];
$sql = "select * from new_item where i_idx = '{$idx}' ";
$view = sql_fetch($sql);

if ($view['i_idx'] != "") {
    $ctg_key = array_search($view['i_ctg'], array_column($main_ctg, 'code')) + 1;
}

if(!$is_member){
    alert("회원이시라면 로그인 후 이용해주세요.",G5_BBS_URL.'/login.php?url='.G5_BBS_URL."/contest_write.php" );
}

?>
<div id="item_write">
<div class="inr v2" id="inr">
        <h3>프로젝트 의뢰등록</h3>
        <form name="fmember" id="fmember" action="./competition_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
        <input type="hidden" name="w" value="">
        <input type="hidden" name="sfl" value="">
        <input type="hidden" name="stx" value="">
        <input type="hidden" name="sst" value="">
        <input type="hidden" name="sod" value="">
        <input type="hidden" name="page" value="">
        <input type="hidden" name="token" value="">
        <input type="hidden" name="idx" value="">
        <div class="box_list">
        <div class="box_input col02">
        <div class="box_write">
            <h4><label for="cp_category1">상위카테고리<strong class="sound_only">필수</strong></label></h4>
            <div class="cont">
                <div class="select_box">
                    <div class="box">
                        <select id="cp_category1" name="cp_category1" class="frm_input" onchange="ctg1_change(this.value)">
                        <option value="146">카테고리별</option>
                        <option value="148">업종별</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="box_write">
            <h4><label for="cp_category2">하위카테고리<strong class="sound_only">필수</strong></label></h4>
            <div class="cont">
                <div class="select_box">
                        <select id="cp_category2" name="cp_category2" class="frm_input">
                        <option value="146">카테고리별</option><option value="148">업종별</option>
                        <option value="3">디자인</option><option value="1">IT/프로그램</option>
                        <option value="2">마케팅</option><option value="36">영상/음향/사진</option>
                        <option value="499">문화예술</option>
                        </select>
                </div>
            </div>
        </div>
        </div>
        <div class="box_write">
            <h4><label for="cp_company_name">회사명</label></h4>
            <div class="cont">
                <input type="text" name="cp_company_name" value="" class="frm_input" size="40">
            </div>
        </div>
        <div class="box_write">
            <h4><label for="cp_company_explain">회사소개</label></h4>
            <div class="cont">
                <textarea name="cp_company_explain" id="cp_company_explain" class="frm_input"></textarea>
            </div>
        </div>
        <div class="box_write">
            <h4><label for="cp_title">제목</label></h4>
            <div class="cont">
               <input type="text" name="cp_title" value="" required id="cp_title" class="frm_input required" size="180" maxlength="200">
            </div>
        </div>
        <div class="box_write">
            <h4><label for="cp_logo_content">내용</label></h4>
            <div class="cont">
               <textarea name="cp_logo_content" id="cp_logo_content" class="frm_input"></textarea>
            </div>
        </div>
        <div class="box_write">
            <h4><label for="cp_datetime">마감기간</label></h4>
            <div class="cont">
               <input type="date" name="cp_datetime" class="frm_input" size="40">
            </div>
        </div>
        <div class="box_write">
            <h4><label for="cp_reward">희망 제작금액</label></h4>
            <div class="cont">
               <label>만원</label>
               <input type="text" name="cp_reward" id="cp_reward" value="" class="frm_input" onkeyup="numberWithCommas(this)" size="40">
            </div>
        </div>
        <div class="box_write">
            <h4><label for="image">메인이미지</label></h4>
            <div class="cont">
                <input type="file" name="main_img">
            </div>
        </div>
        <div class="box_write">
            <h4><label for="image">참고 자료</label></h4>
            <div class="cont">

            </div>
        </div>
        <div class="box_write">
            <h4><label for="cp_logo_sty">관련키워드</label></h4>
            <div class="cont">
               <input type="text" name="cp_logo_sty" value="" class="frm_input" size="40">
            </div>
        </div>


        </form>

        <div id="area_btn">
            <input type="submit" value="확인" class="btn_next"accesskey='s'>
        </div>
        </div>
</div>
</div>

<script>
    function numberWithCommas(x) {
        var val = x.value;
        var id = x.id;
        final_val = val.replace(/[^0-9]/g,''); // 입력값이 숫자가 아니면 공백
        final_val = final_val.replace(/,/g,''); // ,값 공백처리
        $("#"+id).val(final_val.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); // 정규식을 이용해서 3자리 마다 , 추가
    }
</script>





