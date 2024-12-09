<?php
/**
 * 기본형게시판 목록
 */
include_once('./_common.php');
include_once('./_board.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = $title;
include_once('../admin.head.php');

// 파라미터
$page = ($_GET['page'] > 1)? $_GET['page'] : 1;

// 공통쿼리
$sql_common = "FROM g5_bbs_basic A LEFT JOIN g5_member B ON A.writer_no = B.mb_no 
               WHERE A.del_yn = 'N' AND A.tbl_name = '{$tbl_name}'";

// 검색어
if (trim($stx) != "") {
    switch ($sfl) {
        case "subject" : // 제목
            $sql_common .= " AND A.subject LIKE '%{$stx}%'";
            break;
        case "content" : // 내용
            $sql_common .= " AND A.content LIKE '%{$stx}%'";
            break;
        case "mb_name" : // 작성자
            $sql_common .= " AND B.mb_name LIKE '%{$stx}%'";
            break;
    }
}

// 페이징
$sql = "SELECT COUNT(*) AS cnt {$sql_common}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$list_rows = 15;	//$config['cf_page_rows'];				// 한페이지 글 개수
$total_page  = ceil($total_count / $list_rows);		// 전체페이지
if ($page > $total_page) $page = $total_page;
if ($page < 1) $page = 1;

$from_record = ($page - 1) * $list_rows;					// 시작 열
$sql_limit = " LIMIT {$from_record}, {$list_rows}";			// 리스트 sql에 limit 추가
$list_page_rows = 10;										// 한블록 개수
$list_no = $total_count - ($list_rows * ($page - 1));		// 글번호(내림차순)

$sql_orderBy = "ORDER BY A.idx DESC";

// 리스트
$sql = "SELECT A.*, B.mb_id, B.mb_name,
        (SELECT COUNT(idx) FROM g5_bbs_reply WHERE del_yn = 'N' AND tbl_name = '{$tbl_name}' AND tbl_idx = A.idx) AS reply_cnt
        {$sql_common} {$sql_orderBy} {$sql_limit}";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

?>

<!-- 게시판 목록 시작 { -->
<div id="bo_list">
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <ul class="btn_bo_user">
            <li><a href="./form.php?tbl=<?=$tbl_name?>" class="btn_b02">등록하기</a></li>
        </ul>
    </div>

    <form name="fboardlist" id="fboardlist" method="post">
        <div class="tbl_head01 tbl_wrap">
            <table>
                <colgroup>
                    <col width="5%">
                    <col width="3%">
                    <col width="">
                    <col width="15%">
                    <col width="15%">
                    <?if ($hit_enable) { ?><col width="7%"><?}?>
                </colgroup>
                <thead>
                <tr>
                    <th scope="col">번호</th>
                    <th scope="col">
                        <input type="checkbox" id="chkall" onclick="if (this.checked) allCheckedBbsList(true); else allCheckedBbsList(false);">
                    </th>
                    <th scope="col">제목</th>
                    <th scope="col">작성자</th>
                    <th scope="col">등록일자</th>
                    <?if ($hit_enable) { ?><th>조회수</th><?}?>
                </tr>
                </thead>
                <tbody>
                <?if ($total_count == 0) { ?>
                    <tr><td colspan="6" class="empty_table">등록된 글이 없습니다.</td></tr>
                    <?php
                } else {
                    for ($i=0; $row=sql_fetch_array($result); $i++) {
                        $link = "./view.php?idx=".$row['idx'];
                        if ($page > 1) $link .= "&page={$page}";
                        if ($qstr != "") $link .= "&{$qstr}";

                        $category = ($row['category'])? "[{$row['category']}]" : "";
                        ?>
                        <tr style="text-align:center;">
                            <td><?=$list_no?></td>
                            <td class="td_chk">
                                <input type="checkbox" name="idx[]" value="<?=$row['idx']?>">
                            </td>
                            <td>
                                <strong><?=$category?></strong>
                                <a href="<?=$link?>"><?=$row['subject']?></a>
                                <?if ($row['reply_cnt'] > 0) echo ' <strong style="font-size:0.9em;">('.$row['reply_cnt'].')</strong>'; ?>
                                <?=bbsNew($row['regdate'])?>
                            </td>
                            <td>
                                <!--<a href="javascript:void(0)" onclick="getMemberPop('<?=$row['mb_id']?>')"><?=$row['mb_name']?></a>-->
                                <?=$row['mb_name']?>
                            </td>
                            <td><?=$row['regdate']?></td>
                            <?if ($hit_enable) { ?><td><?=$row['hit']?></td><?}?>
                        </tr>
                        <?php $list_no--; }} ?>
                </tbody>
            </table>
        </div>

        <div class="bo_fx">
            <ul class="btn_bo_adm">
                <li><input type="button" name="btn_submit" value="선택삭제" onclick="deleteBbsList('basicDelete')"></li>
            </ul>
            <?/*
            <ul class="btn_bo_user">
                <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
                <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
            </ul>
            */?>
        </div>

    </form>
</div>


<!-- 페이지 -->
<?php
echo get_paging(10, $page, $total_page, '?'.$qstr.'&amp;page=');
?>

<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>
    <form name="fsearch" method="get" autocomplete="off">
        <input type="hidden" name="tbl" value="<?=$tbl_name?>">
        <span class="select_box">
            <select name="sfl">
                <option value="subject"<?php echo get_selected($sfl, 'subject'); ?>>제목</option>
                <option value="content"<?php echo get_selected($sfl, 'content'); ?>>내용</option>
                <option value="mb_name"<?php echo get_selected($sfl, 'mb_name', true); ?>>작성자</option>
            </select>
        </span>
        <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" class="frm_input sch_input" maxlength="20" minlength="2">
        <input type="submit" value="검색" class="btn_submit02">
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->

<?php
include_once ('../admin.tail.php');
?>
