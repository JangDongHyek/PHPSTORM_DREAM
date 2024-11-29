<?php
$sub_menu = "210100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

/** 팀장 - 프로관리 ==> 근태관리 **/

$mb_no = $_GET['mb_no'];

$mb = get_member_no($mb_no);

$lesson_info = sql_fetch(" select * from g5_lesson where lesson_code = '{$mb['lesson_code']}' ");

$sql_search = '';
if (!empty($_GET['start_date'])) {
    $start_date = str_replace('-', '.', $_GET['start_date']);
    $sql_search .= " and (re.reser_date >= '{$start_date}') ";
}
if (!empty($_GET['end_date'])) {
    $end_date = str_replace('-', '.', $_GET['end_date']);
    $sql_search .= " and (re.reser_date <= '{$end_date}') ";
}

$year = date('Y');
$month = date('m');
$sql_search2 = '';
if(empty($_GET['start_date']) && empty($_GET['end_date'])) {
    $sql_search2 .= " and re.reser_date like '{$year}.{$month}%' ";
}

$sql = " select count(*) as cnt 
         from (select re.* from g5_lesson_reser as re
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where re.pro_mb_no = '{$mb_no}' {$sql_search} {$sql_search2} and (re.reser_state = '예약완료' || re.reser_state = '노쇼')
         group by re.reser_date) as t
          ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//$rows = $config['cf_page_rows'];
$rows = 15;
$total_page = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select 
         re.reser_date, min(re.reser_time) as start_date, max(re.reser_time) as end_date, count(re.idx) as lesson_count,
         count(case when mb.mb_state='one_point_lesson' then 1 end) as one_point_count
         from g5_lesson_reser as re
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where re.pro_mb_no = '{$mb_no}' {$sql_search} {$sql_search2} and (re.reser_state = '예약완료' || re.reser_state = '노쇼')
         group by re.reser_date
         order by re.reser_date desc, re.reser_time desc limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$listall = '<a href="' . $_SERVER['SCRIPT_NAME'] . '?mb_no=' . $mb_no . '" class="ov_listall">전체목록</a>';

$colspan = 6;

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
        <li class="" id="tab0"><a href="javascript:void(0);" onclick="tabClick('pro_view_member.php');">유효회원</a></li>
        <li class="" id="tab1"><a href="javascript:void(0);" onclick="tabClick('pro_view.php');">레슨현황</a></li>
        <li class="" id="tab2"><a href="javascript:void(0);" onclick="tabClick('pro_view_tab2.php');">스케줄관리</a></li>
        <!--<li class="" id="tab3"><a href="javascript:void(0);" onclick="tabClick('pro_view_tab3.php');">휴무관리</a></li>-->
        <li class="current" id="tab3"><a href="javascript:void(0);">근태관리</a></li>
        <!--<li class="" id="tab4"><a href="javascript:void(0);" onclick="tabClick('pro_view_tab5.php');">신규/재등록 현황</a></li>-->
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
    <div class="lre_list_tit">
        <?php
        if(!empty($_GET['start_date']) && !empty($_GET['end_date'])) { echo $_GET['start_date'].'~'.$_GET['end_date']; }
        else if(!empty($_GET['start_date'])) { echo $_GET['start_date'].'~'; }
        else if(!empty($_GET['end_date'])) { echo '~'.$_GET['end_date']; }
        else { echo date('m').'월 '; }
        ?>
        근태기록
    </div><!--.lre_list_tit-->
    <p>총 <?php echo number_format($total_count) ?> 건 / <?= $listall ?></p>

    <!--기간검색-->
    <form id="fsearch" name="fsearch" method="get">
        <input type="hidden" id="mb_no" name="mb_no" value="<?= $mb_no ?>">
        <div class="lre_ldate">
            <input type="date" name="start_date" value="<?= $_GET['start_date'] ?>" class="input_ldate"/> ~ <input type="date" name="end_date" value="<?= $_GET['end_date'] ?>" class="input_ldate"/>
            <input type="submit" class="btn_ldate" value="검색">
        </div><!--.lre_ldate-->
    </form>

    <!--예약자 리스트 테이블-->
    <form action="ajax.approval_state_change.php" method="post">
        <div class="tbl_head02 tbl_wrap mb_tbl">
            <table>
                <caption><?php echo $g5['title']; ?> 목록</caption>
                <colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>일자</th>
                    <th>레슨시작시간</th>
                    <th>레슨종료시간</th>
                    <th>총레슨건수</th>
                    <th>원포인트건수</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $k = $total_count - ($rows * ($page - 1));
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                ?>
                    <tr>
                        <td><?= $k ?></td>
                        <td><?= $row['reser_date']?></td>
                        <td><?= $row['start_date']?></td>
                        <td><?= $row['end_date']?></td>
                        <td><?= $row['lesson_count']?></td>
                        <td><?= $row['one_point_count']?></td>
                    </tr>
                <?php
                    $k--;
                }
                if($i == 0)
                    echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
                ?>
                </tbody>
            </table>
        </div>

        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?' . $qstr . '&amp;mb_no=' . $mb_no ."&start_date=".$_REQUEST['start_date']."&end_date=".$_REQUEST['end_date'].'&amp;page='); ?>
    </form>

</div><!--#lesson_reslist-->

<div class="adm_mw_btn">
    <a href="<?= G5_ADMIN_URL ?>/pro_list.php" class="btn_adm_cancel">목록</a>
</div>
<!--//레슨현황 끝-->

<script>
    function tabClick(tab) {
        if (tab == 'pro_view_tab5.php') {
            alert('준비중입니다.');
            return false;
        }

        var lv = '';
        if(tab == 'pro_view_sales.php') {
            lv = '&lv=당일매출';
        }
        location.replace(g5_admin_url + '/' + tab + '?mb_no=<?=$mb_no?>'+lv);
    }
</script>

<?php
include_once('./admin.tail.php');
?>
