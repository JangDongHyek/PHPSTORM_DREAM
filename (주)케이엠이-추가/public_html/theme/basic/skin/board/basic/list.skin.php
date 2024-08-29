<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>

<!--<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>-->

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->

    <!-- 게시판 검색 시작 { -->
    <div class="d-lg-flex">
    <fieldset id="bo_sch" class="ms-auto">
        <legend>게시물 검색</legend>
        <form name="fsearch" method="get" class="input-group">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sop" value="and">
            <input type="hidden" name="sfl" value="wr_subject||wr_content||mb_id,1"> <!-- This line has been changed -->

            <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="form-control py-3 search-box-width" size="15" maxlength="20" placeholder="Please enter a word.">
            <button type="submit" value="검색" class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
        </form>
    </fieldset>
    </div>
    <!-- } 게시판 검색 끝 -->

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?> / </span>
            <?php echo $page ?> Page
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($_SESSION['ss_mb_id']=="lets080") { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">Admin</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">Write</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">



    <div class="tbl_head01 tbl_wrap">
        <table class="table table-hover">
        <caption><?php echo $board['bo_subject'] ?> List</caption>
        <thead>
        <tr class="table-list-title-font">
            <th scope="col" class="bg-kme text-light py-3 text-center number-width">#</th>
            <?php if ($is_checkbox) { ?>
            <th scope="col" class="bg-kme text-light py-3 text-center number-width">
                <label for="chkall" class="sound_only">All posts on current page</label>
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            </th>
            <?php } ?>
            <th scope="col" class="bg-kme text-light text-center py-3">Title</th>
            <th scope="col" class="bg-kme text-light text-center py-3 inquiry-list-writer-width mobile-none hidden-xs">Writer</th>
            <th scope="col" class="bg-kme text-light text-center py-3 inquiry-list-writer-width"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>Date</a></th>
            <th scope="col" class="bg-kme text-light text-center py-3 inquiry-list-writer-width mobile-none hidden-xs"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>Hits</a></th>
            <?php if ($is_good) { ?><th scope="col"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>추천</a></th><?php } ?>
            <?php if ($is_nogood) { ?><th scope="col"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>비추천</a></th><?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
         ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
            <td class="td_num">
            <?php
            if ($list[$i]['is_notice']) // 공지사항
                echo '<strong>Notice</strong>';
            else if ($wr_id == $list[$i]['wr_id'])
                echo "<span class=\"bo_current\">Viewing</span>";
            else
                echo $list[$i]['num'];
             ?>
            </td>
            <?php if ($is_checkbox) { ?>
            <td class="td_chk">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            </td>
            <?php } ?>
            <td class="td_subject">
                <?php
                echo $list[$i]['icon_reply'];
                if ($is_category && $list[$i]['ca_name']) {
                 ?>
                <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link hidden-xs"><?php echo $list[$i]['ca_name'] ?></a>
                <?php } ?>

                <a href="<?php echo $list[$i]['href'] ?>">
                    <?php echo $list[$i]['subject'] ?>
                    <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
                </a>

                <?php
                // if ($list[$i]['link']['count']) { echo '['.$list[$i]['link']['count']}.']'; }
                // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }

                /*if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                //if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
                if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
                if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
                if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'];*/

                 ?>
            </td>
            <td class="td_name sv_use"><?php echo $list[$i]['name'] ?></td>
            <td class="td_date hidden-xs"><?php echo date('d.m.y', strtotime($list[$i]['datetime'])); ?></td>
            <td class="td_num hidden-xs"><?php echo $list[$i]['wr_hit'] ?></td>
            <?php if ($is_good) { ?><td class="td_num"><?php echo $list[$i]['wr_good'] ?></td><?php } ?>
            <?php if ($is_nogood) { ?><td class="td_num"><?php echo $list[$i]['wr_nogood'] ?></td><?php } ?>
        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">There are no posts.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="Delete Selected" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="Copy Selected" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="Move Selected" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">List</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">Write</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>



<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "Copy Selected") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "Move Selected") {
        select_copy("move");
        return;
    }

    if(document.pressed == "Delete Selected") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->

<br><br><br>
<hr class="bg-secondary mb-5">
<div class="d-lg-flex">
    <!-- <div class="sub-title-font pt-0 pt-lg-4">VISIT</div> -->
    <div class="pb-5 pb-lg-0 me-0 me-lg-5 w-100">
        <div class="fs-4 fw-bold border bg-light p-3 mb-1">· Busan (Head Office)</div>
        <div class="d-lg-flex w-100 me-1 mb-1">
            <div class="d-flex">
                <div class="">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/bg_location/bg_location_01.webp" class="img-fluid">
                </div>
                <div class="">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/bg_location/bg_location_01-2.webp" class="img-fluid">
                </div>
            </div>
            <div class="d-flex">
                <div class="">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/bg_location/bg_location_01-5.webp" class="img-fluid">
                </div>
                <div>
                    <img src="<?php echo G5_THEME_IMG_URL ?>/bg_location/bg_location_01-4.webp" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="w-100 mb-1">
            <!--
            * 카카오맵 - 약도서비스
            * 한 페이지 내에 약도를 2개 이상 넣을 경우에는
            * 약도의 수 만큼 소스를 새로 생성, 삽입해야 합니다.
            -->

            <!-- 1. 약도 노드 -->
            <div id="daumRoughmapContainer1722926331727" class="root_daum_roughmap root_daum_roughmap_landing w-100"></div>

            <!-- 2. 설치 스크립트 -->
            <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

            <!-- 3. 실행 스크립트 -->
            <script charset="UTF-8">
                new daum.roughmap.Lander({
                    "timestamp": "1722926331727",
                    "key": "2k9w6"
                }).render();
            </script>
        </div>
        <div class="w-100">
            <div class="p-1">
                <div class="d-flex align-items-start my-2">
                    <div class="me-2"><i class="bi bi-pin"></i></div>
                    <div>29, NAKDONG-DAERO 1302 BEON-GIL, SASANG-GU, BUSAN, KOREA, 46910</div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-100">
        <div class="fs-4 fw-bold border bg-light p-3 mb-1">· Gimhae (Office/factory)</div>
        <div class="d-lg-flex w-100 me-1 mb-1">
            <div class="d-flex">
                <div class="">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/bg_location/bg_location_02.webp" class="img-fluid">
                </div>
                <div class="">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/bg_location/bg_location_02-1.webp" class="img-fluid">
                </div>
            </div>
            <div class="d-flex">
                <div class="">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/bg_location/bg_location_02-2.webp" class="img-fluid">
                </div>
                <div>
                    <img src="<?php echo G5_THEME_IMG_URL ?>/bg_location/bg_location_02-3.webp" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="w-100 mb-1">
            <!-- * 카카오맵 - 지도퍼가기 -->
            <!-- 1. 지도 노드 -->
            <div id="daumRoughmapContainer1722926559975" class="root_daum_roughmap root_daum_roughmap_landing w-100"></div>

            <!-- 2. 설치 스크립트 * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다. -->
            <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

            <!-- 3. 실행 스크립트 -->
            <script charset="UTF-8">
                new daum.roughmap.Lander({
                    "timestamp": "1722926559975",
                    "key": "2k9wa"
                }).render();
            </script>
        </div>
        <div class="w-100">
            <div class="p-1">
                <div class="d-flex align-items-start my-2">
                    <div class="me-2"><i class="bi bi-pin"></i></div>
                    <div>25, Seobu-ro 1331beon-gil, Juchon-myeon, Gimhae-si, Gyeongsangnam-do, Republic of
                        Korea</div>
                </div>
            </div>
        </div>
    </div>
</div>