<?php
$sub_menu = "210100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_company_inquiry as ci left join g5_member as mb on mb.mb_id = ci.mb_id ";

$sql_search = " where 1=1 and del_yn is null ";
// $sql_search .= " and podosea = 'Y' "; // 포도씨에 직접 의뢰한 건만 조회

// 의뢰구분
if(empty($lv) || $lv == 'podosea') {
    $sql_search .= " and podosea = 'Y' "; // 포도씨에 직접 의뢰한 건만 조회
} else if($lv == 'direct') { // 바로의뢰
    $sql_search .= " and podosea = '' and target_mb_no != '' ";
} else { // 기업의뢰
    $sql_search .= " and podosea = '' and target_mb_no = '' ";
}

// 검색 (검색어 입력)
if(!empty($stx)) {
    $sql_search .= " and (ci_subject like '%{$stx}%' or ci_contents like '%{$stx}%' or ci_category like '%{$stx}%' or ci_maker like '%{$stx}%' or ci_model like '%{$stx}%' or ci_serial_no like '%{$stx}%') ";
}

// 검색 (의뢰유형)
if(!empty($type) && $type != '전체') {
    $sql_search .= " and ci_type = '{$type}' ";
}

// 검색 (카테고리)
if(!empty($category) && $category != '전체') {
    $sql_search .= " and ci_category = '{$category}' ";
}

if (!$sst) {
    $sst = "wr_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '기업의뢰';
include_once('./admin.head.php');

$sql = " select ci.*, mb.mb_hp {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$colspan = 16;
?>

<style>
.mb_tbl table {text-align: center;}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총의뢰수 <?php echo number_format($total_count) ?>건<!-- 중,
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php /*echo $sfl */?>&amp;stx=<?php /*echo $stx */?>">차단 <?php /*echo number_format($intercept_count) */?></a>명,
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php /*echo $sfl */?>&amp;stx=<?php /*echo $stx */?>">탈퇴 <?php /*echo number_format($leave_count) */?></a>명-->
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="type" id="type" onchange="document.fsearch.submit();">
    <option value="">RFQ Type</option>
    <option value="Service">Service</option>
    <option value="Parts">Parts</option>
    <option value="Ship supplies">Ship supplies</option>
    <option value="Others">Others</option>
</select>
<select name="category" id="category" onchange="document.fsearch.submit();">
    <option value="">Category</option>
    <option value="Engine">Engine</option>
    <option value="Auxiliary Machinery">Auxiliary Machinery</option>
    <option value="Valve, Filter/Strainer, Pipe Fittings">Valve, Filter/Strainer, Pipe Fittings</option>
    <option value="Propulsion System And Rudder System">Propulsion System And Rudder System</option>
    <option value="HVAC, Refrigeration System">HVAC, Refrigeration System</option>
    <option value="Electrical Equipment and Automation">Electrical Equipment and Automation</option>
    <option value="Communication and Navigation Equipment">Communication and Navigation Equipment</option>
    <option value="Deck Machinery & Cargo Hold Hatch Cover">Deck Machinery & Cargo Hold Hatch Cover</option>
    <option value="Fire Fighting/Life-Saving and Personal Safety/Protection">Fire Fighting/Life-Saving and Personal Safety/Protection</option>
    <option value="Measuring Meter/Instrument/Special Tool">Measuring Meter/Instrument/Special Tool</option>
    <option value="Galley Equipment/Laundry Equipment/Sanitory Unit">Galley Equipment/Laundry Equipment/Sanitory Unit</option>
    <option value="Ship Chandler">Ship Chandler</option>
    <option value="New Building & Conversion">New Building & Conversion</option>
    <option value="Maintenance & Repair Services">Maintenance & Repair Services</option>
    <option value="Other Service & Products">Other Service & Products</option>
</select>
<!--<select name="sfl" id="sfl">
    <option value="mb_id"<?php /*echo get_selected($_GET['sfl'], "mb_id"); */?>>아이디</option>
</select>-->
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input" placeholder="검색어 입력">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="local_desc01 local_desc">
    <!--<p>* 포도씨에 직접 의뢰한 건이 표시됩니다.</p>-->
    <p>* 삭제된 의뢰는 표시되지 않습니다.</p>
</div>

<?php if ($is_admin == 'super') { ?>
    <div class="btn_add01 btn_add">
        <ul class="cate">
            <li <? if ($lv == "" || $lv == "podosea") echo 'class="on"'; ?> data-lv="podosea">포도씨에의뢰</li>
            <li <? if ($lv == "company") echo 'class="on"'; ?> data-lv="company">기업의뢰</li>
            <li <? if ($lv == "direct") echo 'class="on"'; ?> data-lv="direct">바로의뢰</li>
        </ul>
        <a href="javascript:;" style="visibility: hidden;">&nbsp;</a>
    </div>
<?php } ?>

<form name="finquirylist" id="finquirylist" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head02 tbl_wrap mb_tbl">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <table>
        <caption><?php echo $g5['title']; ?> 목록</caption>
        <colgroup>
            <col width="2%"><!--No-->
            <col width="5%"><!--아이디-->
            <col width="6%"><!--휴대폰-->
            <col width="5%"><!--의뢰유형-->
            <col width="10%"><!--카테고리-->
            <col width="15%"><!--의뢰제목-->
            <col width="*"><!--Maker-->
            <col width="*"><!--Model-->
            <?php if($lv == 'podosea') { ?>
                <col width="3%"><!--의뢰전달여부-->
            <?php } ?>
            <col width="5%"><!--견적기한-->
            <col width="5%"><!--D-DAY-->
            <col width="5%"><!--의뢰상태-->
            <col width="5%"><!--등록일-->
            <col width="3%"><!--견적-->
            <col width="4%"><!--관리-->
        </colgroup>
        <thead>
        <tr>
            <!--<th scope="col">
                <label for="chkall" class="sound_only">회원 전체</label>
                <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
            </th>-->
            <th>No.</th>
            <th><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
            <th>휴대폰</th>
            <th>RFQ Type</th>
            <th>Category</th>
            <th>Subject (RFQ title)</th>
            <th>Maker</th>
            <th>Model</th>
            <?php if($lv == 'podosea') { ?>
            <th>의뢰전달여부</th>
            <?php } ?>
            <th>Quotation deadline</th>
            <th>D-DAY</th>
            <th>의뢰상태</th>
            <th>등록일</th>
            <th>받은견적</th>
            <th>관리</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $list_no = $total_count - ($rows * ($page - 1));
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = '<a href="./company_inquiry_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['idx'].'">보기</a>';
        $bg = 'bg'.($i%2);

        $date = $row['ci_deadline_date'];
        $todate = date("Y-m-d", time());
        $dday = ( strtotime($date) - strtotime($todate) ) / 86400;

        $cnt = sql_fetch(" select count(*) as cnt from g5_company_estimate where company_inquiry_idx = '{$row['idx']}' ")['cnt'];
    ?>
	<tr class="<?php echo $bg; ?>">
        <!--<td>
			<input type="hidden" name="mb_id[<?php /*echo $i */?>]" value="<?php /*echo $row['mb_id'] */?>" id="mb_id_<?php /*echo $i */?>">
            <input type="checkbox" name="chk[]" value="<?php /*echo $i */?>" id="chk_<?php /*echo $i */?>">
		</td>-->
        <td><?=$list_no?></td>
        <td><?=$row['mb_id']?></td>
        <td><?=$row['mb_hp']?></td>
        <td><?=$row['ci_type']?></td>
        <td><?=$row['ci_category']?></td>
        <td><?=$row['ci_subject']?></td>
        <td><div><?=$row['ci_maker']?></div></td>
        <td><div><?=$row['ci_model']?></div></td>
        <?php if($lv == 'podosea') { ?>
        <td><?php echo !empty($row['pass_yn']) ? '&#10003;' : ''; ?></td>
        <?php } ?>
        <td><?=$row['ci_deadline_date']?></td>
        <td><?=$dday>=0 ? $dday.'일 남음' : '-';?></td><!-- 견적남은일자 -->
        <td><?=$row['ci_state']?></td>
        <td><?=substr($row['wr_datetime'],0,10)?></td>
        <td><?=$cnt?>개</td>
        <td><?=$s_mod?></td>
	</tr>
    <?php
        $list_no--;
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<!--<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>-->

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
$(function() {
    if('<?=$type?>' != '') {
        $('#type').val('<?=$type?>');
    }
    if('<?=$category?>' != '') {
        $('#category').val('<?=$category?>');
    }
});

// 의뢰구분 변경
$("ul.cate li").on("click", function() {
    var level = $(this).data("lv"),
        params = "",
        sfl = $("#sfl").val(),
        stx = $("#stx").val(),
        type = $('#type').val(),
        category = $('#category').val();

    if (level != "") {
        params += "?lv=" + level;
    }

    if (stx != "") {
        params += (params == "")? "?" : "&";
        params += "sfl=" + sfl + "&stx=" + stx;
    }

    if(type != "") {
        params += (params == "")? "?" : "&";
        params += "type=" + type;
    }

    if(category != "") {
        params += (params == "")? "?" : "&";
        params += "category=" + category;
    }

    location.href = g5_admin_url + "/company_inquiry_list.php" + params;
});
</script>

<?php
include_once ('./admin.tail.php');
?>
