<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$bo_table = $_REQUEST['bo_table'];
$sql_common = " from g5_write_{$bo_table} where mb_id != 'hong'  ";
$sca = $_REQUEST['sca'];
$sql_search = '';
$sql_search .= " and ( wr_1 = 'y' || wr_name = '{$member['mb_nick']}' ) and wr_is_comment = 0";
if($_REQUEST['sca']){
    $sql_search .= " and ca_name like '{$sca}'";
}
if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//print_r($sql);
$result = sql_query($sql);

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);

?>
<?php //관리자페이지 스타일
    if (G5_IS_ADMIN == 1) { ?>
    <style>
        .app_list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sel_del_btn{
            display: inline-block;
            vertical-align: middle;
            padding: 10px;
            border: 1px solid #ccc;
            background: #f0f0f0;
            text-decoration: none;
            cursor: pointer;
        }

        p{
            padding: 0;
        }

        .chkbx input[type="checkbox"] + label {
            background-size: 18px auto;
        }

    </style>
<?php } ?>
<div id="bo_app">
<?php /*?><!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>

    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
        <!--<option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>-->
    </select>

    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input sch_input required" maxlength="20">
    <input type="submit" value="검색" class="btn_submit02">
    </form>
</fieldset>
<!-- } 게시판 검색 끝 --><?php */?>

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

    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
    <div id="bo_list_total">
        <span><i class="fas fa-list-ul"></i> <?php echo number_format($total_count) ?>건</span>
        <!--<?php echo $page ?> Page-->
    </div>

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
        <ul class="app_list">
        <?php
        for ($i=0; $list=sql_fetch_array($result); $i++) {

            //썸네일 이미지 가져오기
            $thumb = get_list_thumbnail($board['bo_table'], $list['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
            $list['href'] = G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&wr_id='.$list['wr_id'];
            //본문내용 텍스트만 가져오기
            $str_content = cut_str(strip_tags($list['wr_content']),150);

            // 비회원 문의는 비밀번호 입력 (관리자는 비밀번호 입력 X)
            if($bo_table == 'qna' && !$is_admin) {
                $list['href'] = './password.php?w=v&amp;bo_table='.$bo_table.'&amp;wr_id='.$list['wr_id'].'&amp;page='.$page;
            }
         ?>

        <li class="<?php if ($list['is_notice']) echo "bo_notice"; ?>">
            <a href="<?php echo $list['href'] ?>">
            <p class="num">
            <?php
            if ($list['is_notice']) // 공지사항
                echo '<strong>공지</strong>';
            else if ($wr_id == $list['wr_id'])
                echo "<span class=\"bo_current\">열람중</span>";
            else
                echo $list['num'];
             ?>
            </p>
            <?php if ($is_checkbox) { ?>
            <p class="chkbx">
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                <label for="chk_wr_id_<?php echo $i ?>"></label>
            </p>
            <?php } ?>
            <p class="subject">
                <?php
                echo $list['icon_reply'];
                if ($is_category && $list['ca_name']) {
                 ?>
                <a href="<?php echo $list['ca_name_href'] ?>" class="bo_cate_link hidden-xs"><?php echo $list['ca_name'] ?></a>
                <?php } ?>


                    <?php echo $bo_table == 'qna' ? '문의합니다' : $list['wr_subject']; ?>
                    <?php if ($list['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>


                <?php
                // if ($list['link']['count']) { echo '['.$list['link']['count']}.']'; }
                // if ($list['file']['count']) { echo '<'.$list['file']['count'].'>'; }

                if (isset($list['icon_new'])) echo $list['icon_new'];
                if (isset($list['icon_hot'])) echo $list['icon_hot'];
                if (isset($list['icon_file'])) echo $list['icon_file'];
                if (isset($list['icon_link'])) echo $list['icon_link'];
                if (isset($list['icon_secret'])) echo $list['icon_secret'];

                 ?>
            </p>
            <p class="name sv_use"><?php echo $list['wr_name'] ?></p>
            <p class="date"><?php echo $list['wr_datetime'] ?></p>
            <p class="hit">조회 <?php echo $list['wr_hit'] ?></p>
            </a>
        </li>
        <?php } ?>
        <?php if ($total_count == 0) { echo '<li><p class="empty_table">게시물이 없습니다.</p></li>'; } ?>
        </ul>
    </div>

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
            <?php if (G5_IS_ADMIN != 1) { ?>
                <ul class="btn_bo_adm">
                    <li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"><i class="far fa-trash-alt"></i><span class="sound_only">선택삭제</span></button></li>
                </ul>
            <?php }else{ ?>
                <ul class="btn_bo_user">
                    <!--                    <li><button type="submit" name="btn_submit" value="선택삭제" ></button></li>-->
                    <li><button type="submit" name="btn_submit" class="sel_del_btn" onclick="document.pressed=this.value" value="선택삭제">선택삭제</button></li>
                </ul>
            <?php } ?>
        <?php } ?>
        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
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
<?php //echo $write_pages;  ?>
    <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?bo_table='.$bo_table.$qstr.'&job='.$_REQUEST["job"].'&salary='.$_REQUEST["salary"].'&user_type='.$user_type.'&sex='.$_REQUEST['sex'].'&age='.$_REQUEST['age'].'&si='.$_REQUEST['si'].'&gu='.$_REQUEST['gu'].'&type='.$_REQUEST['type'].'&join_type='.$_REQUEST['join_type'].'&mem_type='.$_REQUEST['mem_type'].'&st_date='.$_REQUEST['st_date'].'&ed_date='.$_REQUEST['ed_date'].'&amp;page='); ?>


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
        swal(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        /*if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;*/
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
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

</div>