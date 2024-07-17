<?php
$sub_menu = "200100";

include_once('./_common.php');
//print_r($qstr);
//exit;
auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} ";


$sql_search = " where mb_id!='lets080' ";


if ($stx != '') {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_8' :
            $sql_search .= " ({$sfl} > '{$stx}') ";
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
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if($_SESSION['ss_mb_id'] != "lets080")
    $sql_search .= " and mb_id != 'lets080'";

if ($_GET['lv'] != "")
    $sql_search .= " and mb_join_division = '{$_GET['lv']}' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = " select count(*) as cnt {$sql_common} ";
$total_member = sql_fetch($sql);
$total_member = $total_member['cnt'];

$rows = $config['cf_page_rows'];
//$rows =6;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_8 > 0  ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '회원관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;

//탈퇴 클릭 시 stx = 0일때 공백처리
if ($stx == '0'){
    $stx = "";
}
?>

<style>
    .mb_tbl table {text-align: center;}
    .btn_add ul.cate {list-style: none; margin: 0; padding: 0;}
    .btn_add .cate li {float: left; padding: 10px; border: 1px solid #ccc; border-left: 0; width: 85px; text-align: center; cursor: pointer;}
    .btn_add .cate li:nth-child(1) {border-left: 1px solid #ccc;}
    .btn_add .cate li.on {background: #f2f5f9; font-weight: 700;}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총회원수 <?php echo number_format($total_member-1) ?>명 중,
    <a href="?sfl=mb_8&amp;stx=0">탈퇴 <?php echo number_format($leave_count) ?></a>명
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input type="hidden" name="lv" value="<?php echo $lv ?>">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
        <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>이메일</option>
        <? /*
    <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
    <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
    <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
    <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
    <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
    <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
    <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
    <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
    <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
	*/ ?>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
    <input type="submit" class="btn_submit" value="검색">

</form>

<!--<div class="local_desc01 local_desc">-->
<!--    <p>회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.</p>-->
<!--</div>-->

<?php if ($is_admin == 'super') { ?>
    <div class="btn_add01 btn_add">
        <ul class="cate">
            <li <? if ($lv == "") echo 'class="on"'; ?> data-lv="">전체</li>
            <li <? if ($lv == "2") echo 'class="on"'; ?> data-lv="2">의뢰인</li>
            <li <? if ($lv == "3") echo 'class="on"'; ?> data-lv="3">전문가</li>
        </ul>
        <a href="./member_form.php?add=y" id="member_add">회원추가</a>
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
<!--                <th scope="col">-->
<!--                    <label for="chkall" class="sound_only">회원 전체</label>-->
<!--                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">-->
<!--                </th>-->
                <th>no</th>
                <th><?php echo subject_sort_link('mb_join_division') ?>회원구분</a></th>
                <th>아이디</th>
                <th><?php echo subject_sort_link('mb_email') ?>이메일</a></th>
                <?php if ($_REQUEST['lv'] == 3 || $_REQUEST['lv'] == ""){?>
                    <th>휴대폰</th>
                <?php } ?>
                <th>가입일</th>
                <th>최종접속</th>
                <th>관리</th>
            </tr>
            <? /*
    <tr>
        <th scope="col" rowspan="2" id="mb_list_chk">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" rowspan="2" id="mb_list_id"><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
        <th scope="col" id="mb_list_name"><?php echo subject_sort_link('mb_name') ?>이름</a></th>
        <th scope="col" colspan="6" id="mb_list_cert"><?php echo subject_sort_link('mb_certify', '', 'desc') ?>본인확인</a></th>
        <th scope="col" id="mb_list_mobile">휴대폰</th>
        <th scope="col" id="mb_list_auth">상태/<?php echo subject_sort_link('mb_level', '', 'desc') ?>권한</a></th>
        <th scope="col" id="mb_list_lastcall"><?php echo subject_sort_link('mb_today_login', '', 'desc') ?>최종접속</a></th>
        <th scope="col" rowspan="2" id="mb_list_grp">접근<br>그룹</th>
        <th scope="col" rowspan="2" id="mb_list_mng">관리</th>
    </tr>
    <tr>
        <th scope="col" id="mb_list_nick"><?php echo subject_sort_link('mb_nick') ?>닉네임</a></th>
        <th scope="col" id="mb_list_mailc"><?php echo subject_sort_link('mb_email_certify', '', 'desc') ?>메일<br>인증</a></th>
        <th scope="col" id="mb_list_open"><?php echo subject_sort_link('mb_open', '', 'desc') ?>정보<br>공개</a></th>
        <th scope="col" id="mb_list_mailr"><?php echo subject_sort_link('mb_mailling', '', 'desc') ?>메일<br>수신</a></th>
        <th scope="col" id="mb_list_sms"><?php echo subject_sort_link('mb_sms', '', 'desc') ?>SMS<br>수신</a></th>
        <th scope="col" id="mb_list_adultc"><?php echo subject_sort_link('mb_adult', '', 'desc') ?>성인<br>인증</a></th>
        <th scope="col" id="mb_list_deny"><?php echo subject_sort_link('mb_intercept_date', '', 'desc') ?>접근<br>차단</a></th>
        <th scope="col" id="mb_list_tel">전화번호</th>
        <th scope="col" id="mb_list_point"><?php echo subject_sort_link('mb_point', '', 'desc') ?> 포인트</a></th>
        <th scope="col" id="mb_list_join"><?php echo subject_sort_link('mb_datetime', '', 'desc') ?>가입일</a></th>
    </tr>
	*/ ?>
            </thead>
            <tbody>
            <?php
            $list_rows = $rows;
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                $s_mod = '<a href="./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'">보기/수정</a>';


                $mb_id = $row['mb_id'];


                $bg = 'bg'.($i%2);
                ?>
                <tr class="<?php echo $bg; ?>">
                    <td><?= $list_no?></td>
                    <td><?php
                        if ($row['mb_join_division'] == '2'){
                            echo  '의뢰인';
                        }elseif ($row["mb_join_division"] == '3'){
                            echo "전문가";
                        }elseif ($row["mb_level"] == '10') {
                            echo "관리자";
                        }?></td>
                    <td><?= $mb_id?></td>
<!--                    <td>-->
<!--                        <input type="hidden" name="mb_id[--><?php //echo $i ?><!--]" value="--><?php //echo $row['mb_id'] ?><!--" id="mb_id_--><?php //echo $i ?><!--">-->
<!--                        <input type="checkbox" name="chk[]" value="--><?php //echo $i ?><!--" id="chk_--><?php //echo $i ?><!--">-->
<!--                    </td>-->

                    <td><?=$row['mb_email']?></td>
                    <?php if ($row['mb_join_division'] == 3 || $_REQUEST['lv'] == "" ){ ?>
                        <td><?=$row['mb_hp']?></td>
                    <?php } ?>
                    <td><?=substr($row['mb_datetime'],2,8)?></td>
                    <td><?=substr($row['mb_today_login'],2,8)?></td>

                    <td><?=$s_mod?></td>
                </tr>

                <?php
                $list_no --;
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <div class="btn_list01 btn_list">
        <?php if ($lv == 2){ ?>
<!--            <input type="submit" name="act_button" style="background: #ccc" value="승인처리" onclick="document.pressed=this.value">-->
        <?php } ?>
<!--        <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">-->
    </div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
    $("ul.cate li").on("click", function() {
        var level = $(this).data("lv"),
            params = "",
            sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (level != "") {
            params += "?lv=" + level;
        }

        if (stx != "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx;
        }

        location.href = g5_admin_url + "/member_list.php" + params;
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
