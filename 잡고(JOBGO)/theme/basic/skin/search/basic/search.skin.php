<?php
$sub_id="search";
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$search_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<?php if ($result_cnt == 0) { ?>
<p class="search_tit"><span>'<?php echo $stx ?>'</span> 에 대한 검색결과 <?=number_format($result_cnt)?>개</p>
    <div class="empty_list">
           <p><i class="fal fa-search fa-3x"></i></p>
           <p class="t_padding17">검색된 자료가 하나도 없습니다.<br />다른 키워드를 사용해 보세요.</p>
    </div>
<?php }else { ?>
<p class="search_tit"><span>'<?php echo $stx ?>'</span> 에 대한 검색결과 <?=number_format($result_cnt)?>개</p>
<section id="cate_depth">
    <div class="cateTit"><h2>카테고리</h2></div>
    <div class="cateList">
        <div class="sort">

                    <?php echo $title_name ?>

<!--                <li class="check">신규등록 순</li>-->
<!--                <li>인기 순</li>-->
<!--                <li>추천 순</li>-->
<!--                <li>평점 순</li>-->
<!--                <li>응답 순</li>-->

        </div>
        <div class="depthList">
            <ul>
               <?= $ctg_html ?>
            </ul>
        </div>
    </div>
</section>
<?php  }  ?>

<!-- 전체검색 시작 { -->
<? /* <form name="fsearch" onsubmit="return fsearch_submit(this);" method="get">
<input type="hidden" name="srows" value="<?php echo $srows ?>">
<fieldset id="sch_res_detail">
    <legend>상세검색</legend>
    <?php echo $group_select ?>
    <script>document.getElementById("gr_id").value = "<?php echo $gr_id ?>";</script>

    <label for="sfl" class="sound_only">검색조건</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject||wr_content"<?php echo get_selected($_GET['sfl'], "wr_subject||wr_content") ?>>제목+내용</option>
        <option value="wr_subject"<?php echo get_selected($_GET['sfl'], "wr_subject") ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($_GET['sfl'], "wr_content") ?>>내용</option>
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id") ?>>회원아이디</option>
        <option value="wr_name"<?php echo get_selected($_GET['sfl'], "wr_name") ?>>이름</option>
    </select>

    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $text_stx ?>" id="stx" required class="frm_input required" maxlength="20">
    <input type="submit" class="btn_submit" value="검색">

    <script>
    function fsearch_submit(f)
    {
        if (f.stx.value.length < 2) {
            alert("검색어는 두글자 이상 입력하십시오.");
            f.stx.select();
            f.stx.focus();
            return false;
        }

        // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
        var cnt = 0;
        for (var i=0; i<f.stx.value.length; i++) {
            if (f.stx.value.charAt(i) == ' ')
                cnt++;
        }

        if (cnt > 1) {
            alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
            f.stx.select();
            f.stx.focus();
            return false;
        }

        f.action = "";
        return true;
    }
    </script>
    <input type="radio" value="or" <?php echo ($sop == "or") ? "checked" : ""; ?> id="sop_or" name="sop">
    <label for="sop_or">OR</label>
    <input type="radio" value="and" <?php echo ($sop == "and") ? "checked" : ""; ?> id="sop_and" name="sop">
    <label for="sop_and">AND</label>
</fieldset>
</form> */ ?>


<div id="sch_result">

    <hr>

    <section id="goods">
        <div class="in">
            <!--<h2 class="title">회원들이 많이 <strong>찾아 본</strong> 서비스</h2>회원들이 많이 검색하고 찾아본 상품들이 추출될 예정-->
            <div class="list cf">
                <?php
                for ($i = 0;  $row = sql_fetch_array($result); $i++){
                    //ios 스토어업데이트를 위해 추가한 신고..(test@naver.com만 나오게 했음. limit 깨져도 상관쓰지말기.)
                    $sql = "select count(*) cnt from new_report where mb_id = '{$member["mb_no"]}' and r_p_idx= '{$row['ta_idx']}' ";
                    $report_cnt = sql_fetch($sql)["cnt"];
                    if ($report_cnt > 0){
                        continue;
                    }

                    include(G5_BBS_PATH."/li_content.php");
                    ?>
                <?php } ?>
            </div><!--list-->
        </div><!--in-->
    </section>
    <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$made_qstr.'&amp;page='); ?>

</div>
<!-- } 전체검색 끝 -->
<script>

</script>