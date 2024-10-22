<?php
$sub_menu = "250000";
include_once('./_common.php');
include_once('../lib/thumbnail.lib.php');
include_once('../model/model.php');

$g5_write_qna = new Model("g5_write_qna","wr_id");

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";

}else if($stx_d){
	//회원 지역 검색	
	if($stx_mb_8) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_8 = '{$stx_mb_8}') ";		
		$sql_search .= " ) ";
	}

	//결혼 유형 검색	
	if($stx_mb_3) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_3 = '{$stx_mb_3}') ";		
		$sql_search .= " ) ";
	}

	//회원 성별 검색	
	if($stx_mb_2) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_2 = '{$stx_mb_2}') ";		
		$sql_search .= " ) ";
	}

	//회원 나이 검색 
	if($stx_mb_7_1 || $stx_mb_7_2){
		$sql_search .= " and ( ";		
	}

	if($stx_mb_7_1 && $stx_mb_7_2){
		$sql_search .= " mb_mb_312 between ".$stx_mb_7_1." and ".$stx_mb_7_2." ";
		//$sql_search .= " (DATE_FORMAT( NOW( ) ,  '%Y' ) - LEFT( mb_7, 4 ) +1) between ".$stx_mb_7_1." and ".$stx_mb_7_2." ";
	}else if($stx_mb_7_1 || $stx_mb_7_2){
		if($stx_mb_7_1) {								
			$sql_search .= " mb_mb_312 >= ".$stx_mb_7_1." ";		
			//$sql_search .= " (DATE_FORMAT( NOW( ) ,  '%Y' ) - LEFT( mb_7, 4 ) +1) >= ".$stx_mb_7_1." ";		
		}
		if($stx_mb_7_2) {								
			$sql_search .= " mb_mb_312 <= ".$stx_mb_7_2." ";		
			//$sql_search .= " (DATE_FORMAT( NOW( ) ,  '%Y' ) - LEFT( mb_7, 4 ) +1) <= ".$stx_mb_7_2." ";		
		}			
	}

	if($stx_mb_7_1 || $stx_mb_7_2){
		$sql_search .= " ) ";
	}

	//회원 직업 검색
	if($stx_mb_110) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_110 = '{$stx_mb_110}') ";		
		$sql_search .= " ) ";
	}

	//회원 학력 검색
	if($stx_mb_73) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_73 = '{$stx_mb_73}') ";		
		$sql_search .= " ) ";
	}

	//담당매니저 검색
	if($stx_mb_1) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_1 like '%{$stx_mb_1}%') ";		
		$sql_search .= " ) ";
	}

	//회원 신장 검색
	if($stx_mb_48_1 || $stx_mb_48_2){
		$sql_search .= " and ( ";		
	}
	if($stx_mb_48_1 && $stx_mb_48_2){
		$sql_search .= " mb_48 between ".$stx_mb_48_1." and ".$stx_mb_48_2." ";
	}else if($stx_mb_48_1 || $stx_mb_48_2){
		if($stx_mb_48_1) {								
			$sql_search .= " mb_48 >= ".$stx_mb_48_1." ";		
		}
		if($stx_mb_48_2) {								
			$sql_search .= " mb_48 <= ".$stx_mb_48_2." ";		
		}			
	}
	if($stx_mb_48_1 || $stx_mb_48_2){
		$sql_search .= " ) ";
	}

	//회원 종교 검색
	if($stx_mb_62) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_62 = '{$stx_mb_62}') ";		
		$sql_search .= " ) ";
	}
	

	$sql_search .= " and mb_level != 10 ";
}else if($stx_mb_company){
	if($stx_mb_company) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_company = '{$stx_mb_company}') ";		
		$sql_search .= " ) ";
	}
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if($_SESSION['ss_mb_id'] != "lets080")
	$sql_search .= " and mb_id != 'lets080'";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_search .= " and mb_level <= 8 and mb_level >= 7 ";//매니저 레벨이 7~8
if($_SESSION['ss_mb_level'] == 9){
	$sql_search .= " and mb_company = '{$_SESSION['ss_mb_company']}' ";
}

$sql_order = " order by {$sst} {$sod} ";

//가맹점 명
$sql = "select * from `g5_member` where mb_level != 10 group by mb_company order by mb_datetime";
$company_name = sql_query($sql);

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$mb_count = $total_count + 1; //회원 넘버링

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '온라인상담';
include_once('./admin.head.php');

//$sql = " select *, DATE_FORMAT(NOW( ), '%Y') - LEFT(mb_6, 4) + 1 as age {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$sql = " select * {$sql_common} {$sql_search} {$sql_search_group} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
//echo $sql;
$colspan = 17;

$mb_count = $mb_count - $rows * ($page - 1);
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총회원수 <?php echo number_format($total_count) ?>명
</div>

<!-- 단일검색 S -->
<!-- <form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_1"<?php echo get_selected($_GET['sfl'], "mb_1"); ?>>담당매니저</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
	<option value="mb_2"<?php echo get_selected($_GET['sfl'], "mb_2"); ?>>성별</option>    
    <option value="mb_mb_312"<?php echo get_selected($_GET['sfl'], "mb_mb_312"); ?>>나이</option>
	<option value="mb_110"<?php echo get_selected($_GET['sfl'], "mb_110"); ?>>직업</option>
	<option value="mb_73"<?php echo get_selected($_GET['sfl'], "mb_73"); ?>>학력</option>
	<option value="mb_8"<?php echo get_selected($_GET['sfl'], "mb_8"); ?>>지역</option>
	<option value="mb_48"<?php echo get_selected($_GET['sfl'], "mb_48"); ?>>키</option>
	<option value="mb_62"<?php echo get_selected($_GET['sfl'], "mb_62"); ?>>종교</option>
	<option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
<input type="button" class="btn_submit" value="초기화" onclick="location.href='./member_list.php'">
</form>-->
<!-- 단일검색 E -->
<?php if ($is_admin == 'super' || $_SESSION['ss_mb_level'] > 9) { ?>
<!-- 가맹점 검색 S -->
<form id="fsearch_c" name="fsearch" class="local_sch01 local_sch" method="get">

<input type="hidden" name="stx_c" value="detail" id="stx_d"><!-- 가맹점 검색 -->

<span class="schTit">온라인상담 검색 : </span>
<select id="stx_mb_company" name="stx_mb_company">
	<option value="">선택하세요.</option>
	<?for($i=0; $company_row=sql_fetch_array($company_name); $i++){?>
	<option value="<?=$company_row['mb_company']?>" <?php echo get_selected($_GET['stx_mb_company'], $company_row['mb_company']); ?>><?=$company_row['mb_company']?></option>	
	<?}?>
</select>
<input type="submit" class="btn_submit" value="검색">
<input type="button" class="btn_submit" value="초기화" onclick="location.href='./member_list_manager.php'">
</form>
<!-- 가맹점 검색 E -->
<?}?>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<input type="hidden" name="member_list_manager" value="1">

<div class="row row-horizon">
<div class="tbl_head02">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th width="5" align="center" id="mb_list_chk">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>				
		<th id="mb_company">이름</th>
		<th id="mb_name">성별</th>
		<th id="mb_tel">연락처</th>
		<th id="mb_hp">이메일</th>
		<th id="mb_10">생년월일</th>
		<th id="mb_email">주소</th>
        <th id="mb_11">직업</th>
		<?if($_SESSION['ss_mb_id'] == "lets080"){?>
        <th id="mb_list_auth">상태/권한<?php echo subject_sort_link('mb_level', '', 'desc') ?><span class="ud"></span></a></th>
		<?}?>
        <th id="mb_list_mng">상세</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $datas = $g5_write_qna->gets(array());
        foreach($datas['datas'] as $data) {
        ?>
    <tr>
        <td headers="mb_list_chk" class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($data['wr_name']); ?> <?php echo get_text($data['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td align="center" class="td_company" headers="mb_company"><?php echo get_text($data['wr_name']); ?></td>
        <td align="center" class="td_name" headers="mb_name"><?php echo get_text($data['gender']); ?></td>
        <td align="center" class="td_tel" headers="mb_tel"><?php echo get_text($data['wr_hp']); ?></td>
        <td align="center" class="td_hp" headers="mb_hp"><?php echo get_text($data['wr_email']); ?></td>
        <td align="center" class="td_10" headers="mb_10"><?php echo get_text($data['birthdate']); ?></td>
        <td align="center" class="td_email" headers="mb_email"><?php echo get_text($data['address']); ?></td>
        <td align="center" class="td_11" headers="mb_10"><?php echo get_text($data['wr_1']); ?></td>
        <td headers="mb_list_mng" class="td_mngsmall"><?php echo $s_mod ?><a href="<?php echo G5_URL ?>/adm/request_view.php?id=<?=$data['wr_id']?>">상세</a></td>
    </tr>
            <?php } ?>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        // 접근가능한 그룹수
        $sql2 = " select count(*) as cnt from {$g5['group_member_table']} where mb_id = '{$row['mb_id']}' ";
        $row2 = sql_fetch($sql2);
        $group = '';
        if ($row2['cnt'])
            $group = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">'.$row2['cnt'].'</a>';

        if ($is_admin == 'group') {
            $s_mod = '';
        } else {
			if($row['mb_level'] == 8 || $row['mb_level'] == 7){// 매니저 수정폼으로
				$s_mod = '<a href="./member_form_manager.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'">●</a>';
			}else if($row['mb_level'] == 9){// 가맹점 수정폼으로
				$s_mod = '<a href="./member_form_company.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'">●</a>';
			}else{
				$s_mod = '<a href="./member_form_pop.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'" onclick="window.open(this.href,\'form\', \'width=1200px,height=900px,toolbars=no,scrollbars=yes\'); return false;">●</a>';
			}
        }
        $s_grp = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">그룹</a>';

        $leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
        $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);

        $mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);

        $mb_id = $row['mb_id'];
        $leave_msg = '';
        $intercept_msg = '';
        $intercept_title = '';
        if ($row['mb_leave_date']) {
            $mb_id = $mb_id;
            $leave_msg = '<span class="mb_leave_msg">탈퇴함</span>';
        }
        else if ($row['mb_intercept_date']) {
            $mb_id = $mb_id;
            $intercept_msg = '<span class="mb_intercept_msg">차단됨</span>';
            $intercept_title = '차단해제';
        }
        if ($intercept_title == '')
            $intercept_title = '차단하기';

        $address = $row['mb_zip1'] ? print_address($row['mb_addr1'], $row['mb_addr2'], $row['mb_addr3'], $row['mb_addr_jibeon']) : '';

        $bg = 'bg'.($i%2);

        switch($row['mb_certify']) {
            case 'hp':
                $mb_certify_case = '휴대폰';
                $mb_certify_val = 'hp';
                break;
            case 'ipin':
                $mb_certify_case = '아이핀';
                $mb_certify_val = '';
                break;
            case 'admin':
                $mb_certify_case = '관리자';
                $mb_certify_val = 'admin';
                break;
            default:
                $mb_certify_case = '&nbsp;';
                $mb_certify_val = 'admin';
                break;
        }
		$mb_count--;
    ?>

    <tr<?php /*?> class="<?php echo $bg; ?>"<?php */?>>
        <td headers="mb_list_chk" class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>		
		<td align="center" class="td_company" headers="mb_company"><?php echo get_text($row['mb_company']); ?></td>
		<td align="center" class="td_name" headers="mb_name"><?php echo get_text($row['mb_name']); ?></td>
		<td align="center" class="td_tel" headers="mb_tel"><?php echo get_text($row['mb_tel']); ?></td>		
		<td align="center" class="td_hp" headers="mb_hp"><?php echo get_text($row['mb_hp']); ?></td>
		<td align="center" class="td_10" headers="mb_10"><?php echo get_text($row['mb_10']); ?></td>
		<td align="center" class="td_email" headers="mb_email"><?php echo get_text($row['mb_email']); ?></td>
        <td align="center" class="td_11" headers="mb_10"><?php echo get_text($row['mb_11']); ?></td>

		<?if($_SESSION['ss_mb_id'] == "lets080"){?>
        <td headers="mb_list_auth" class="td_mbstat">
            <?php
            if ($leave_msg || $intercept_msg) echo $leave_msg.' '.$intercept_msg;
            else echo "정상";
            ?>
            <?php echo get_member_level_select("mb_level[$i]", 1, $member['mb_level'], $row['mb_level']) ?>
        </td>
		<?}?>
        <td headers="mb_list_mng" class="td_mngsmall"><?php echo $s_mod ?> <?//php echo $s_grp ?></td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>
</div><!--row row-horizon-->

<div class="btn_list01 btn_list">
    <!--<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">-->
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
