<?php
$sub_menu = "200500";

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


$sql_search .= " and mb_level > 8 ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

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

$g5['title'] = '관리자 리스트';
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
    총 관리자수 <?php echo number_format($total_count) ?>명
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input type="hidden" name="lv" value="<?php echo $lv ?>">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
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
        <a href="./adm_member_form.php" id="member_add">관리자추가</a>
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
                <th>아이디</th>
                <th>이름</th>
                <th>가입일</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = $rows;
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                $s_mod = '<a href="./adm_member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'">보기/수정</a>';


                $mb_id = $row['mb_id'];


                $bg = 'bg'.($i%2);
                ?>
                <tr class="<?php echo $bg; ?>">
                    <td><?= $list_no?></td>
                    <td><?=$row['mb_id']?></td>
                    <td><?=$row['mb_name']?></td>
                    <td><?=substr($row['mb_datetime'],2,8)?></td>
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
