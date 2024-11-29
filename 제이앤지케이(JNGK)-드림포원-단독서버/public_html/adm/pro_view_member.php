<?php
$sub_menu = "210100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$mb_no = $_GET['mb_no'];

$mb = get_member_no($mb_no);

// 22.01.07 레슨정보 수정 (레슨 삭제 시 데이터 제대로 나오지 않아 수정) / 이전 내용은 member_list.php 참조
$sql_common = " from {$g5['member_table']} as mb ";

$sql_search = " where mb_id != 'admin' and mb_category = '회원' and use_yn = 'Y' "; // 온라인(online)/휴면(no_long_register)/미등록(no_register)은 유효회원에서 제외, 21.04.29 삭제한 회원 제외
$sql_search .= " and pro_mb_no = '{$mb_no}' and mb.center_code = '{$member['center_code']}' "; // 선택 프로의 담당 회원만 조회

// 검색
if ($stx) {
    $name = str_replace(' ', '', $stx);
    $sql_search .= " and (mb_id_no like '%{$name}%' or mb_name like '%{$name}%' or mb_id like '%{$name}%') ";
}

// 정렬
if (!$sst) {
    $sst = "mb_reg_date";
    $sod = "desc";
}

// 회원구분
$sql_search .= " and mb_state not in ('online', 'no_register', 'no_long_register') ";

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 22.01.07 레슨정보 수정 (레슨 삭제 시 데이터 제대로 나오지 않아 수정) / 이전 내용은 member_list.php 참조
$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
//echo $sql;
$colspan = 16;

$listall = '<a href="' . $_SERVER['SCRIPT_NAME'] . '?mb_no=' . $mb_no . '" class="ov_listall">전체목록</a>';

$g5['title'] .= $mb['mb_category'] . '관리';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>

<style>
    .btn_adm_pro_ok {
        display: inline-block;
        line-height: 35px;
        background: #f3d421;
        color: #333;
        font-size: 1.2em;
        font-weight: 600;
        border: 1px solid #f3d421;
        width: 100px;
        margin: 0 5px;
        text-align: center;
        border-radius: 30px;
    }
</style>

<div id="tab_box">
    <ul class="tab">
        <li class="current" id="tab0"><a href="javascript:void(0);">유효회원</a></li>
        <li class="" id="tab1"><a href="javascript:void(0);" onclick="tabClick('pro_view.php');">레슨현황</a></li>
        <li class="" id="tab2"><a href="javascript:void(0);" onclick="tabClick('pro_view_tab2.php');">스케줄관리</a></li>
        <li class="" id="tab3"><a href="javascript:void(0);" onclick="tabClick('pro_view_atta.php');">근태관리</a></li>
        <li class="" id="tab5"><a href="javascript:void(0);" onclick="tabClick('pro_view_sales.php');">매출관리</a></li>
    </ul>
</div><!--#tab_box-->

<!--프로 프로필영역 시작//-->
<div class="adm_pro_info">
    <div class="apro_img">
        <?
        $sql = " select * from g5_member_img where mb_no = '{$mb['mb_no']}' ";
        $file = sql_fetch($sql);

        if (!empty($file['img_file'])) {
            ?>
            <img src="<?= G5_DATA_URL ?>/file/member/<?= $file['img_file'] ?>">
            <?
        } else {
            ?>
            <img src="<?php echo G5_ADMIN_URL; ?>/img/mem_noimg.gif"/>
            <?php
        }
        ?>
    </div><!--.apro_img-->
    <div class="apro_name">
        <?php /*?><span style="font-weight: bold;margin-right: 10px;"><?=$mb_state?></span>
        <span><?=$mb['mb_id_no']?></span> <?php */ ?>
        <?= $mb['mb_name'] ?> <span><?= $mb['mb_category'] ?></span>
    </div><!--.apro_name-->
    <div style="text-align: center;">
        <input type="button" class="btn_adm_pro_ok" value="정보수정" onclick="location.href='<?=G5_ADMIN_URL?>/pro_form.php?w=u&mb_no=<?=$mb_no?>'">
    </div>
</div><!--.adm_pro_info-->
<!--//프로 프로필영역 끝-->


<div id="lesson_reslist">
    <p>총 회원 수 <?php echo number_format($total_count) ?> 명<!-- / --><?/*= $listall */?></p>

    <form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="token" value="">

        <div class="tbl_head02 tbl_wrap mb_tbl">
            <table>
                <caption><?php echo $g5['title']; ?> 목록</caption>
                <colgroup>
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                <tr>
                    <th>회원사진</th>
                    <th>회원번호</th>
                    <th><?php echo subject_sort_link('mb_name') ?>회원명 </a></th>
                    <th>센터/아카데미</th>
                    <?php if($member['mb_level'] == 9) { ?> <!-- 팀장관리자 일 경우만 조회, 프로 로그인 시 본인 담당회원만 조회할 수 있으므로 필요없음 -->
                        <th><?php echo subject_sort_link('mb_charge_pro') ?>담당프로 </a></th>
                    <?php } ?>
                    <th>상품명</th>
                    <th>잔여회차</th>
                    <th>레슨일지</th>
                    <th>관리</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i=0; $row=sql_fetch_array($result); $i++) {
                    $s_mod = './member_view.php?mb_no='.$row['mb_no'];
                    $pro_s_mod = './pro_view_member.php?mb_no='.$row['pro_mb_no'];
                    $bg = 'bg'.($i%2);

                    $state_class = 'mb_state';
                    if ($row['mb_state'] == 'new_member') {
                        $mb_state = '신규';
                        $state_class = 'mbs_new';
                    } else if ($row['mb_state'] == 're_member') {
                        $mb_state = '재등록';
                        $state_class = 'mbs_re';
                    } else if ($row['mb_state'] == 'one_point_lesson') {
                        $mb_state = '원포인트';
                        $state_class = 'mbs_one';
                    }

                    $file = sql_fetch(" select * from g5_member_img where mb_no = '{$row['mb_no']}' ");

                    $diary_count = sql_fetch(" select count(*) as count from g5_lesson_diary where mb_no = '{$row['mb_no']}' and history_idx = '{$row['history_idx']}' ")['count'];

                    // 22.01.07 레슨정보 수정 (레슨 삭제 시 데이터 제대로 나오지 않아 수정)
                    $info = sql_fetch(" select md.lesson_remain_count, his.lesson_name from g5_lesson_diary as md right outer join g5_member_history as his on md.history_idx = his.idx where his.idx = '{$row['history_idx']}' order by md.idx desc limit 1 ");
                    $lesson_name = explode('/', $info['lesson_name'])[0];
                    $lesson_count = explode('/', $info['lesson_name'])[2];
                    if($info['lesson_remain_count'] === null) { $lesson_remain_count = $lesson_count; } // 레슨일지 미작성 (잔여회차 데이터 NULL)
                    else { $lesson_remain_count = $info['lesson_remain_count'].'회'; }
                    if($info['lesson_remain_count'] === 0 || $lesson_remain_count < 0) { $lesson_remain_count = '0회'; } // 레슨일지 전체 작성 완료(잔여회자가 0) || 잔여회차가 마이너스
                    ?>
                    <tr class="<?php echo $bg; ?>">
                        <td><?php if(!empty($file['img_file'])) { ?> <img src="<?=G5_DATA_URL?>/file/member/<?=$file['img_file']?>" width="50px" height="50px"> <?php } else { ?> <img src="<?php echo G5_ADMIN_URL; ?>/img/mem_noimg.gif" width="50px" height="50px"/> <?php } ?></td>
                        <td><span class="<?=$state_class?>"><?=$mb_state?></span><?=$row['mb_id_no']?></td>
                        <td style="cursor: pointer;" onclick="member_history_popup('<?=$row['mb_no']?>');"><?=$row['mb_name']?></td>
                        <td><?=$row['mb_center']?></td>
                        <?php if($member['mb_level'] == 9) { ?> <!-- 팀장관리자 일 경우만 조회, 프로 로그인 시 본인 담당회원만 조회할 수 있으므로 필요없음 -->
                            <td style="cursor: pointer;" onclick="location.href='<?=$pro_s_mod?>'"><?=$row['mb_charge_pro']?></td>
                        <?php }?>
                        <td><?=$lesson_name?></td>
                        <td>
                            <!--잔여회차-->
                            <span style="font-weight: bold;">
                            <?=$lesson_remain_count?>
                            </span>
                            <?php if(!empty($row['history_idx'])) { ?>/<?php } ?>
                            <!--레슨회차-->
                            <?=$lesson_count?>
                        </td>
                        <td onclick="event.cancelBubble=true">
                            <a href="javascript:void(0);" class="btn_remo" onclick="lesson_diary('<?=$row['mb_no']?>');">레슨일지</a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="btn_remo" onclick="location.href='<?=$s_mod?>'">상세보기</a>
                        </td>
                    </tr>
                    <?php
                }
                if ($i == 0)
                    echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
                ?>
                </tbody>
            </table>
        </div>
    </form>

    <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&mb_no='.$mb_no.'&amp;page='); ?>

</div><!--#lesson_reslist-->

<div class="adm_mw_btn">
    <a href="<?= G5_ADMIN_URL ?>/pro_list.php" class="btn_adm_cancel">목록</a>
</div>
<!--//레슨현황 끝-->

<script>
    function tabClick(tab) {
        var lv = '';
        if(tab == 'pro_view_sales.php') {
            lv = '&lv=당일매출';
        }
        location.replace(g5_admin_url + '/' + tab + '?mb_no=<?=$mb_no?>'+lv);
    }

    // 회원-레슨일지(팝업)
    function lesson_diary(mb_no) {
        var url = "./lesson_diary_form.php?mb_no="+mb_no;

        if('<?=$ios_flag?>' || '<?=$android_flag?>') {
            location.href = url;
        }
        else {
            window.open(url, "add_lesson_diary", "left=100,top=100,width=1000,height=800,scrollbars=yes,resizable=yes");
        }
    }

    // 회원-상품등록이력조회 팝업
    function member_history_popup(mb_no) {
        var url = "./popup.member_history.php?mb_no="+mb_no;

        if('<?=$ios_flag?>' || '<?=$android_flag?>') {
            location.href = url;
        }

        window.open(url, "member_history", "left=100,top=100,width=1000,height=800,scrollbars=yes,resizable=yes");
    }
</script>

<?php
include_once('./admin.tail.php');
?>
