<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');



//$sql_common = " from {$g5['member_table']} ";
$sql_common = "  from g5_member gm LEFT OUTER join new_gogac_car nc on gm.mb_id = nc.mb_id ";


if($_SESSION['ss_mb_id'] == "admin"){
    $sql_search .= " where 1=1 ";
}else{
    $sql_search .= " where 1=1 and mb_level < 4 ";
}


if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if ($_GET['lv']){
    $sql_search .= " and mb_level = '{$_GET['lv']}' ";
    $lv = $_GET['lv'];
}

if ($_GET['yn'] != ""){
    $sql_search .= " and mb_1 = '{$_GET['yn']}' ";
    $qstr .= "&yn=".$_GET['yn'];
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

$g5['title'] = '회원관리';
include_once('./admin.head.php');

$sql = " select gm.*,nc.car_no {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$colspan = 16;



?>
<br>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
        총회원수 <?php echo number_format($total_count) ?>명 |
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01" data-tooltip-text="탈퇴된 순으로 정렬합니다.&#xa;전체 데이터를 출력합니다."> <span class="ov_txt">탈퇴회원 보기</span><span class="ov_num"></a>


</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input type="hidden"  name="yn" id="yn" value="<?=$_GET['yn']?>">
    <input type="hidden"  name="level" id="level" value="<?=$_GET['lv']?>">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
        <option value="car_no"<?php echo get_selected($_GET['sfl'], "car_no"); ?>>차량번호</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
        <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>

    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class=" frm_input">
    <input type="submit" class="btn_submit" value="검색">

</form>


<?php if ($is_admin == 'super') { ?>
    <div class="btn_add01 btn_add">
        <ul class="cate cate_lv">
<!--            <li --><?// if ($lv == "") echo 'class="on"'; ?><!-- data-lv="">전체</li>-->
            <li <? if ($lv == "2") echo 'class="on"'; ?> data-lv="2">고객회원</li>
            <li <? if ($lv == "3") echo 'class="on"'; ?> data-lv="3">매니저회원</li>
            <li <? if ($lv == "9") echo 'class="on"'; ?> data-lv="9">관리팀장</li>
        </ul>
        <ul class="cate cate_yn">
            <li <? if ($yn == "") echo 'class="on"'; ?>  style="margin-left: 10px" data-yn="">전체</li>
            <li <? if ($yn == "Y") echo 'class="on"'; ?> data-yn="Y">승인</li>
            <li <? if ($yn == "N") echo 'class="on"'; ?> data-yn="N">승인안됨</li>
        </ul>
        <?php if ($auth_arr["menu".substr($sub_menu, 0, 3)."_write"] == "Y" || $member['mb_level'] == 10){ ?>
        <a href="./member_form.php?add=y" id="member_add">회원추가</a>
        <a href="./member_form.php?add=y&mb_level=9" id="member_add">관리팀장추가</a>
        <?php } ?>
    </div>
<?php } ?>

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
            <thead>
            <tr>
                		<th scope="col">
                            <label for="chkall" class="sound_only">회원 전체</label>
                            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                        </th>
                <th>no</th>
                <th>승인여부</th>
                <th>회원구분</th>
                <th><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
                <th><?php echo subject_sort_link('mb_name') ?>이름</a></th>
                <th>차량번호</th>
                <th>휴대폰</th>
                <th>가입일</th>
                <?php if($sst == 'mb_leave_date'){ ?>
                <th>탈퇴일</th>
                <?php } ?>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = 15;
            $list_no = $total_count - ($list_rows * ($page - 1));
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
                    $s_mod = '<a href="./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'">보기/수정</a>';
                }
                $s_grp = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">그룹</a>';

                $leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
                $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);

                $mb_nick = $row['mb_nick'];

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
                ?>
                <tr class="<?php echo $bg; ?>">
                  	<td>
                        <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
                        <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
                        <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td><?=$list_no?></td>
                    <td><?= $row['mb_1'] == 'Y' ? '승인': "승인안됨";?></td>
                    <td><?php if ($row['mb_level'] == '2'){
                            echo '고객';
                        }else if ($row['mb_level'] == '3'){
                            echo '매니저';
                        }else if ($row['mb_level'] == '9'){
                            echo '관리팀장';
                        }?></td>
                    <td><?=$mb_id?></td>
                    <td><?=get_text($row['mb_name'])?></td>
                    <td><?=get_text($row['car_no'])?></td>
                    <td><?=hyphen_hp_number($row['mb_hp'])?></td>
                    <td><?=substr($row['mb_datetime'],2,8)?></td>
                    <?php if($sst == 'mb_leave_date'){ ?>
                        <td><?=substr($row['mb_leave_date'],2,8)?></td>
                    <?php } ?>
                    
                    <td><?=$s_mod?></td>
                </tr>

                <? /*
    <tr class="<?php echo $bg; ?>">

        <td headers="mb_list_chk" class="td_chk" rowspan="2">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td headers="mb_list_id" rowspan="2" class="td_name sv_use"><?php echo $mb_id ?></td>
        <td headers="mb_list_name" class="td_mbname"><?php echo get_text($row['mb_name']); ?></td>
        <td headers="mb_list_cert" colspan="6" class="td_mbcert">
            <input type="radio" name="mb_certify[<?php echo $i; ?>]" value="ipin" id="mb_certify_ipin_<?php echo $i; ?>" <?php echo $row['mb_certify']=='ipin'?'checked':''; ?>>
            <label for="mb_certify_ipin_<?php echo $i; ?>">아이핀</label>
            <input type="radio" name="mb_certify[<?php echo $i; ?>]" value="hp" id="mb_certify_hp_<?php echo $i; ?>" <?php echo $row['mb_certify']=='hp'?'checked':''; ?>>
            <label for="mb_certify_hp_<?php echo $i; ?>">휴대폰</label>
        </td>
        <td headers="mb_list_mobile" class="td_tel"><?php echo get_text($row['mb_hp']); ?></td>
        <td headers="mb_list_auth" class="td_mbstat">
            <?php
            if ($leave_msg || $intercept_msg) echo $leave_msg.' '.$intercept_msg;
            else echo "정상";
            ?>
            <?php echo get_member_level_select("mb_level[$i]", 1, $member['mb_level'], $row['mb_level']) ?>
        </td>
        <td headers="mb_list_lastcall" class="td_date"><?php echo substr($row['mb_today_login'],2,8); ?></td>
        <td headers="mb_list_grp" rowspan="2" class="td_numsmall"><?php echo $group ?></td>
        <td headers="mb_list_mng" rowspan="2" class="td_mngsmall"><?php echo $s_mod ?> <?php echo $s_grp ?></td>
    </tr>
    <tr class="<?php echo $bg; ?>">
        <td headers="mb_list_nick" class="td_name sv_use"><div><?php echo $mb_nick ?></div></td>
        <td headers="mb_list_mailc" class="td_chk"><?php echo preg_match('/[1-9]/', $row['mb_email_certify'])?'<span class="txt_true">Yes</span>':'<span class="txt_false">No</span>'; ?></td>
        <td headers="mb_list_open" class="td_chk">
            <label for="mb_open_<?php echo $i; ?>" class="sound_only">정보공개</label>
            <input type="checkbox" name="mb_open[<?php echo $i; ?>]" <?php echo $row['mb_open']?'checked':''; ?> value="1" id="mb_open_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_mailr" class="td_chk">
            <label for="mb_mailling_<?php echo $i; ?>" class="sound_only">메일수신</label>
            <input type="checkbox" name="mb_mailling[<?php echo $i; ?>]" <?php echo $row['mb_mailling']?'checked':''; ?> value="1" id="mb_mailling_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_sms" class="td_chk">
            <label for="mb_sms_<?php echo $i; ?>" class="sound_only">SMS수신</label>
            <input type="checkbox" name="mb_sms[<?php echo $i; ?>]" <?php echo $row['mb_sms']?'checked':''; ?> value="1" id="mb_sms_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_adultc" class="td_chk">
            <label for="mb_adult_<?php echo $i; ?>" class="sound_only">성인인증</label>
            <input type="checkbox" name="mb_adult[<?php echo $i; ?>]" <?php echo $row['mb_adult']?'checked':''; ?> value="1" id="mb_adult_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_deny" class="td_chk">
            <?php if(empty($row['mb_leave_date'])){ ?>
            <input type="checkbox" name="mb_intercept_date[<?php echo $i; ?>]" <?php echo $row['mb_intercept_date']?'checked':''; ?> value="<?php echo $intercept_date ?>" id="mb_intercept_date_<?php echo $i ?>" title="<?php echo $intercept_title ?>">
            <label for="mb_intercept_date_<?php echo $i; ?>" class="sound_only">접근차단</label>
            <?php } ?>
        </td>
        <td headers="mb_list_tel" class="td_tel"><?php echo get_text($row['mb_tel']); ?></td>
        <td headers="mb_list_point" class="td_num"><a href="point_list.php?sfl=mb_id&amp;stx=<?php echo $row['mb_id'] ?>"><?php echo number_format($row['mb_point']) ?></a></td>
        <td headers="mb_list_join" class="td_date"><?php echo substr($row['mb_datetime'],2,8); ?></td>
    </tr>
	*/ ?>

                <?php
                $list_no--;
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <div class="btn_list01 btn_list">
        <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
    </div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr."&lv=".$_REQUEST['lv'].'&amp;page='); ?>

<script>

    $(document).on('click', "ul.cate_lv li, ul.cate_yn li", function(){
        var level = $(this).data("lv"),
            yn = $(this).data("yn"),
            params = "";

        if (level != undefined) {
            console.log(level);
            $("#level").val(level);
        }
        if (yn != undefined) {
            console.log(yn);
            $("#yn").val(yn);
        }


        params += "&lv=" + $("#level").val() + "&yn=" + $("#yn").val();



        var sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (stx != "") {
            params += "&sfl=" + sfl + "&stx=" + stx;
        }



        location.href = g5_admin_url + "/member_list.php?" + params;

    });

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
