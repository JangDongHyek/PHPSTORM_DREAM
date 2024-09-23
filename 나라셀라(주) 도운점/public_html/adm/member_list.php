<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} as M ";

$sql_search = " where M.mb_id!='lets080' AND M.mb_id!='admin' ";

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
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($is_admin != 'super')
    $sql_search .= " and M.mb_level <= '{$member['mb_level']}' ";

if($_SESSION['ss_mb_id'] != "lets080")
	$sql_search .= " and M.mb_id != 'lets080'";

if (!$sst) {
    $sst = "M.mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " 
    SELECT count(*) as cnt          
    {$sql_common}  
    {$sql_search}
    ";

$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '회원관리';
include_once('./admin.head.php');

$sql = " 
    SELECT DISTINCT
        M.*    
    {$sql_common} 
    {$sql_search} 
    {$sql_order} 
    limit 
        {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>


<div class="local_ov01 local_ov">
    총회원수 <?php echo number_format($total_count) ?>명
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="display: flex; align-items: center;">

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="M.mb_id" <?php echo get_selected($_GET['sfl'], "M.mb_id"); ?>>아이디</option>
        <option value="M.mb_name" <?php echo get_selected($_GET['sfl'], "M.mb_name"); ?>>이름</option>
        <option value="M.mb_1" <?php echo get_selected($_GET['sfl'], "M.mb_1"); ?>>생년월일</option>        
        <option value="M.mb_hp" <?php echo get_selected($_GET['sfl'], "M.mb_hp"); ?>>휴대폰</option>
    </select>

    <!--<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>-->
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">

    <input type="submit" class="btn_submit" value="검색" style="width: 100px; height: 30px;">

</form>

    <!--<a href="./v5_member_excel_down.php" class="btn_submit" style="width: 100px; height: 30px;" download>엑셀다운로드</a>-->
    <a href="./v5_member_excel_down.php" class="btn_submit" style="width: 100px; height: 30px;">엑셀다운로드</a>

<!--
<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>
-->

<?php if ($is_admin == 'super') { ?>
<!--
<div class="btn_add01 btn_add">
    <a href="./member_form.php" id="member_add">회원추가</a>
</div>
-->
<?php } ?>

<form>
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div id="memberBox" class="tbl_head02 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
                <tr>                    
                    <th>순번</th>
                    <th>아이디</th>
                    <th>이름</th>
                    <th>휴대폰</th>
                    <th>생년월일</th>
                    <th>이메일</th>
                    <th>마케팅 정보동의</th>
                    <th>가입일</th>
                    <th>최근접속일</th>
                    <th>가입경로</th>
                    <th>직업</th>
                </tr>                                
            </thead>
            <tbody>
                <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        
        $bg = 'bg'.($i%2);
    ?>

                <tr class="<?php echo $bg; ?>">                    
                    <td class=""><?=$result->num_rows - $i?></td>
                    <td><?=$row['mb_id']?></td>
                    <td><?=$row['mb_name']?></td>                    
                    <td><?=$row['mb_hp']?></td>
                    <td><?=$row['mb_1']?></td>
                    <td><?=$row['mb_email']?></td>
                    <td><?=($row['mb_sms'] == '1'? 'Y' : 'N')?></td>
                    <td><?=substr($row['mb_datetime'], 2, 14)?></td>
                    <td><?=substr($row['mb_today_login'], 2, 14)?></td>
                    <td><?=$row['mb_route']?></td>
                    <td><?=$row['mb_job']?></td>
                </tr>

                <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
            </tbody>
        </table>
    </div>

    <!--
<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>
-->

</form>

<?php  echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page=');  ?>

<?php
include_once ('./admin.tail.php');
?>