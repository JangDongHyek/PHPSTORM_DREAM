<?php
$sub_menu = '400100';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$sql_common = " from `v5_coupon` ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "cp_no";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search}
            {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$g5['title'] = '쿠폰관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$colspan = 9;
?>
    <form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">

        <select name="sfl" title="검색대상">
            <option value="cp_subject"<?php echo get_selected($_GET['sfl'], "cp_subject"); ?>>쿠폰이름</option>
            <option value="cp_id"<?php echo get_selected($_GET['sfl'], "cp_id"); ?>>쿠폰코드</option>
        </select>
        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
        <input type="submit" class="btn_submit" value="검색">
    </form>

    <div class="btn_add01 btn_add">
        <a href="./couponform.php" id="coupon_add" class="btn btn_01">쿠폰 추가</a>
    </div>

    <form name="fcouponlist" id="fcouponlist" method="post" action="./couponlist_delete.php" onsubmit="return fcouponlist_submit(this);">
        <input type="hidden" name="sst" value="<?php echo $sst; ?>">
        <input type="hidden" name="sod" value="<?php echo $sod; ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
        <input type="hidden" name="stx" value="<?php echo $stx; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="hidden" name="token" value="">

        <div class="tbl_head01 tbl_wrap">
            <table>
                <caption><?php echo $g5['title']; ?></caption>
                <thead>
                <tr>
                    <th scope="col">쿠폰코드</th>
                    <th scope="col">쿠폰이름</th>
                    <th scope="col">회원아이디(적용등급)</a></th>
                    <th scope="col">사용기한</a></th>
                    <th scope="col">사용회수</th>
                    <th scope="col">사용가능여부</th>
                    <th scope="col">관리</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i=0; $row=sql_fetch_array($result); $i++) {
                    $link1 = '<a href="./orderform.php?od_id='.$row['od_id'].'">';
                    $link2 = '</a>';

                    // 쿠폰사용회수
                    $sql = " select count(*) as cnt from `v5_coupon_log` where cp_id = '{$row['cp_id']}' ";
                    $tmp = sql_fetch($sql);
                    $used_count = $tmp['cnt'];

                    $bg = 'bg'.($i%2);

                    // 문자열을 배열로 변환
                    $mb_ids = explode(",", $row['mb_id']);

                    // 회원 유형을 담을 변수 초기화
                    $member_types = "";

                    // 각 mb_id 값에 대해 회원 유형을 변수에 담기
                    foreach ($mb_ids as $mb_id) {
                        switch ($mb_id) {
                            case 2:
                                $member_types .= "일반, ";
                                break;
                            case 3:
                                $member_types .= "조합원, ";
                                break;
                            case 4:
                                $member_types .= "VIP, ";
                                break;
                            case 5:
                                $member_types .= "VVIP, ";
                                break;
                        }
                    }

                    // 마지막 콤마 제거
                    $member_types = rtrim($member_types, ", ");

                    if(empty($member_types)){
                        $member_types = $mb_id;
                    }

                    $is_finish = "사용가능";

                    $now = new DateTime(); // 현재 날짜와 시간

                    if (new DateTime($row['cp_start']) > $now) {
                        $is_finish = "사용대기";
                    }

                    $cp_end = new DateTime($row['cp_end']);
                    $cp_end->setTime(23, 59, 59);
                    if ($cp_end < $now) {
                        $is_finish = "기한만료";
                    }

                    if($row['cp_finish'] == "T"){
                        $is_finish = "사용중지";
                    }

                    ?>

                    <tr class="<?php echo $bg; ?>">
                        <td><?php echo $row['cp_id']; ?></td>
                        <td class="td_left"><?php echo $row['cp_subject']; ?></td>
                        <td class="td_name sv_use"><div><?php echo $member_types; ?></div></td>
                        <td class="td_datetime"><?php echo substr($row['cp_start'], 2, 8); ?> ~ <?php echo substr($row['cp_end'], 2, 8); ?></td>
                        <td class="td_cntsmall"><?php echo number_format($used_count); ?></td>
                        <td class="td_cntsmall"><?php echo $is_finish; ?></td>
                        <td class="td_mng td_mng_s">
                            <a href="./couponform.php?w=u&amp;cp_id=<?php echo $row['cp_id']; ?>&amp;<?php echo $qstr; ?>" class="btn btn_03"><span class="sound_only"><?php echo $row['cp_id']; ?> </span>수정</a>
                        </td>
                    </tr>

                    <?php
                }

                if ($i == 0)
                    echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
                ?>
                </tbody>
            </table>
        </div>

    </form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>