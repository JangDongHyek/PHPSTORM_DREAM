<?php
$sub_menu = "260000";
include_once('./_common.php');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

// 메뉴테이블 생성
if( !isset($g5['menu_table']) ){
    die('<meta charset="utf-8">dbconfig.php 파일에 <strong>$g5[\'menu_table\'] = G5_TABLE_PREFIX.\'menu\';</strong> 를 추가해 주세요.');
}

if(!sql_query(" DESCRIBE {$g5['menu_table']} ", false)) {
    sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['menu_table']}` (
                  `me_id` int(11) NOT NULL AUTO_INCREMENT,
                  `me_code` varchar(255) NOT NULL DEFAULT '',
                  `me_name` varchar(255) NOT NULL DEFAULT '',
                  `me_link` varchar(255) NOT NULL DEFAULT '',
                  `me_target` varchar(255) NOT NULL DEFAULT '0',
                  `me_order` int(11) NOT NULL DEFAULT '0',
                  `me_use` tinyint(4) NOT NULL DEFAULT '0',
                  `me_mobile_use` tinyint(4) NOT NULL DEFAULT '0',
                  `me_course` tinyint(4) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`me_id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ", true);
}

$sql = " select * from {$g5['menu_table']} order by me_id ";
$result = sql_query($sql);

$g5['title'] = "결제페이지";
include_once('./admin.head.php');


$sql_common = " from g5_payment ";
$sql_search = " where 1=1 ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {

        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}


$sql_order = " order by wr_datetime desc ";

if (!empty($_GET['sdt'])) $sql_search .= "AND DATE(wr_datetime) >= '{$_GET['sdt']}' ";
if (!empty($_GET['edt'])) $sql_search .= "AND DATE(wr_datetime) <= '{$_GET['edt']}' ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 15;

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.10.7/dayjs.min.js"></script><!--date.js-->

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총  <?php echo number_format($total_count) ?>개
    <a href="<?=G5_ADMIN_URL?>/pay_list_download.php" target='_blank'>엑셀 다운로드</a>
</div>

<form id="searchFrm" name="searchFrm" class="local_sch01 local_sch flex jc-sb" method="get">

    <div>
        <label for="sfl" class="sound_only">검색대상</label>
        <select name="sfl" id="sfl">
            <option value="userId" <?php echo get_selected($_GET['sfl'], "userId"); ?>>회원아이디</option>
            <option value="BuyerName" <?php echo get_selected($_GET['sfl'], "BuyerName"); ?>>품목</option>
            <option value="GoodsName" <?php echo get_selected($_GET['sfl'], "GoodsName"); ?>>기관명</option>
            <option value="BuyerTel" <?php echo get_selected($_GET['sfl'], "BuyerTel"); ?>>연락처</option>
            <option value="BuyerEmail" <?php echo get_selected($_GET['sfl'], "BuyerEmail"); ?>>이메일</option>
        </select>
        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
        <input type="hidden" name="sst" id="sst"  value="<?=$_REQUEST['sst']?>">
        <input type="hidden" name="sod" id="sod" value="<?=$_REQUEST['sod']?>">
        <input type="submit" class="btn_submit" value="검색">
    </div>

    <div class="flex">
        <div class="input_select">
            <input type="date" name="sdt" class="border_gray frm_input" value="<?= $_GET['sdt'] ?>">
        </div>
        ~
        <div class="input_select">
            <input type="date" name="edt" class="border_gray frm_input" value="<?= $_GET['edt'] ?>"
                   onchange="changeInputDate(this.value)">
        </div>

        <div class="select flex nowrap">
            <?
            $dateRange = ['1' => '오늘', '2' => '이번주', '3' => '이번달', '4' => '지난달', '5' => '3개월'];
            foreach ($dateRange as $key => $val) {
                $checked = ($_GET['dtRange'] == $key) || (!$_GET['dtRange'] && $key == 0) ? "checked" : "";
                $id = "dtr{$key}";
                ?>
                <input type="radio" id="<?= $id ?>" name="dtRange"
                       value="<?= $key ?>" <?= $checked ?> onclick="changeDateRange(this.value)"/>
                <label for="<?= $id ?>"><?= $val ?></label>
            <? } ?>

        </div>
    </div>

</form>
<!--
<div class="local_desc01 local_desc">
    <p><strong>주의!</strong> 가격 및 품목 <strong>확인 후 삭제</strong> 해주시기 바랍니다.</p>
</div>
-->
<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <colgroup>
       <col style="width:2%" />
       <col style="width:*" />
       <col style="width:10%" />
       <col style="width:10%" />
       <col style="width:10%" />
       <col style="width:10%" />
       <col style="width:10%" />
    </colgroup>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">게시판 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">번호</th>
        <th scope="col">회원아이디</th>
        <th scope="col">기관명</th>
        <th scope="col">품목</th>
        <th scope="col">결제금액</th>
        <th scope="col">결제종류</th>
        <th scope="col">결제방식</th>
        <th scope="col">연락처</th>
        <th scope="col">이메일</th>
        <th scope="col">결제일시</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php
        $list_no = $total_count - ($rows * ($page - 1));
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $mb_id = $row['mb_id'];
            $mb = get_member($mb_id);
        ?>

        <td class="td_chk">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['bo_subject']) ?></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td class=""><?=$list_no?></td>
        <td class=""><?=$row['userId']?></td>
        <td class=""><?=$row['GoodsName']?></td>
        <td class=""><?=$row['BuyerName']?></td>

        <td class=""><?=number_format($row['Amt'])?></td>
        <td class=""><?=$row['fn_name']?></td>
        <td class=""><?=$row['payMethod']?></td>
        <td class=""><?=$row['BuyerTel']?></td>
        <td class=""><?=$row['BuyerEmail']?></td>
        <td class=""><?=date('Y-m-d',strtotime($row['wr_datetime']))?></td>

    </tr>
    <?php
    $list_no--;
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\" style='text-align: center'>자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&pay='.$pay.'&amp;page='); ?>




<?php
include_once ('./admin.tail.php');
?>

<script>
    // 날짜기간 생성
    const getStartAndEndDate = (rangeType) => {
        let returnDateRange = {start: '', end: ''};
        const today = new Date();
        const now = dayjs();

        switch (rangeType.toString()) {
            case "1" : // 오늘
                returnDateRange.start = formatDate(today);
                returnDateRange.end = formatDate(today);
                break;

            case "2" : // 이번주
                let firstDay = today.getDate() - today.getDay() + 1;
                let lastDay = firstDay + 6;
                let firstDate = new Date(today.setDate(firstDay));
                // let lastDate = new Date(today.setDate(lastDay));
                // returnDateRange.start = formatDate(firstDate);
                // returnDateRange.end = formatDate(lastDate);
                let firstDateFormat = formatDate(firstDate);
                let lastDate = dayjs(firstDateFormat).add(6, 'day');
                let lastDateFormat = lastDate.format('YYYY-MM-DD');
                returnDateRange.start = firstDateFormat;
                returnDateRange.end = lastDateFormat;
                break;

            case "3" : // 이번달
                let thisMonthFirstDay = new Date(today.getFullYear(), today.getMonth(), 1);
                let thisMonthLastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                returnDateRange.start = formatDate(thisMonthFirstDay);
                returnDateRange.end = formatDate(thisMonthLastDay);
                break;

            case "4" : // 지난달
                let lastMonthFirstDay = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                let lastMonthLastDay = new Date(today.getFullYear(), today.getMonth(), 0);
                returnDateRange.start = formatDate(lastMonthFirstDay);
                returnDateRange.end = formatDate(lastMonthLastDay);
                break;

            case "5" : // 3개월
                let last3MonthFirstDay = new Date(today.getFullYear(), today.getMonth() - 3, 1);
                let last3MonthLastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                returnDateRange.start = formatDate(last3MonthFirstDay);
                returnDateRange.end = formatDate(last3MonthLastDay);
                break;
        }

        return returnDateRange;
    }

    // (상단 검색 공통) 기간선택
    const changeDateRange = (value) => {
        const searchFrm = document.searchFrm;
        if (searchFrm) {
            const dateList = getStartAndEndDate(value);
            searchFrm.sdt.value = dateList.start;
            searchFrm.edt.value = dateList.end;
            searchFrm.submit();
        }
    }
    // (상단 검색 공통) 날짜선택
    const changeInputDate = (value) => {
        const searchFrm = document.searchFrm;
        if (searchFrm) {
            const radios = document.querySelectorAll('[name=dtRange]');
            radios.forEach(radio => {
                radio.checked = false;
            });
            searchFrm.submit();
        }
    }

    // Date to YYYY-mm-dd 포맷변환
    function formatDate(date) {
        let year = date.getFullYear();
        let month = ('0' + (date.getMonth() + 1)).slice(-2);
        let day = ('0' + date.getDate()).slice(-2);
        return `${year}-${month}-${day}`;
    }


</script>