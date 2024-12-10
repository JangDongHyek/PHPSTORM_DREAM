<?php
$tab = ($_GET['tab']) ? $_GET['tab'] : "1";
$tab2 = ($_GET['tab2']) ? $_GET['tab2'] : "";
$tab3 = ($_GET['tab3']) ? $_GET['tab3'] : "";
if ($tab == "1") {
    $sub_menu = 200100; // 고객관리
} elseif ($tab == "2") {
    $sub_menu = 200200; // 기사관리
} else {
    $sub_menu = 200300; // CCM관리
}

include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " FROM {$g5['member_table']} WHERE ";
if ($tab == "1") {
    $sql_common .= " mb_level = 2 and is_ccm = 'F'";
} elseif ($tab == "2") {
    $sql_common .= " (mb_level BETWEEN 3 AND 8 OR mb_level = 1) and is_ccm = 'F'";
} elseif ($tab == "3") {
    $sql_common .= " is_ccm = 'T'";
} else {
    $sql_common .= " mb_level = 9 and is_ccm = 'F'"; // CCM관리
}

// 승인여부 카테고리 클릭시
if ((int)$tab2 > 0) $sql_common .= " AND mb_user_auth = '{$tab2}' ";

// 기사구분
if ((int)$tab3 > 0) $sql_common .= " AND mb_level = '{$tab3}'";

// (대리점 로그인시) 본인 대리점만 조회
if ($member['mb_level'] != "10") {
    $sql_common .= " AND agency_no = '{$member['mb_no']}' ";
} else {
    // (관리자) 대리점 카테고리 선택가능
    if ($sca != "") $sql_common .= " AND agency_no = '{$sca}' ";
}

// 검색
if ($stx) {
    $sql_common .= " AND {$sfl} like '%{$stx}%' ";
}

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

// 페이징
$sql = " select count(*) as cnt {$sql_common} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page = ceil($total_count / $rows); // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
$list_no = $total_count - ($rows * ($page - 1)); // 글번호(내림차순)

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

// 리스트
$sql = " select * {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

if ($tab == "1") {
    $g5['title'] = '고객관리';
} elseif ($tab == "2") {
    $g5['title'] = '기사관리';
} else {
    $g5['title'] = 'CCM관리';
}

include_once('./admin.head.php');

?>
<style>
    .mb_tbl table {text-align: center;}
</style>

<div class="local_ov01 local_ov">
    <a href="<?=$_SERVER['SCRIPT_NAME']?>" class="ov_listall">전체목록</a>
    총 회원 <?php echo number_format($total_count) ?>명 중,
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>">차단 <?php echo number_format($intercept_count) ?></a>명,
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>">탈퇴 <?php echo number_format($leave_count) ?></a>명
</div>

<form id="fsearch" name="fsearch" class="local_sch" method="get">
    <input type="hidden" name="tab2" value="<?=$tab2?>">
    <input type="hidden" name="tab3" value="<?=$tab3?>">
    <div class="local_sch01">
        <input type="hidden" name="tab" value="<?=$tab?>">
        <?php
        if ($member['mb_level'] == "10") {
            $rst = sql_query("SELECT mb_no, mb_nick FROM g5_member WHERE mb_level = '9' ORDER BY mb_nick ASC;");
            $rst_cnt = sql_num_rows($rst);
            if ($rst_cnt > 0) {
                ?>
                <select name="sca" onchange="document.fsearch.submit();">
                    <option value="">대리점전체</option>
                    <?php while($agency = sql_fetch_array($rst)) { ?>
                        <option value="<?=$agency['mb_no']?>" <?php if ($sca == $agency['mb_no']) echo "selected"; ?>><?=$agency['mb_nick']?></option>
                    <?php } ?>
                </select>
                <?php
            }
        }
        ?>
        <label for="sfl" class="sound_only">검색대상</label>
        <select name="sfl" id="sfl">
            <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
            <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
            <option value="mb_memo"<?php echo get_selected($_GET['sfl'], "mb_memo"); ?>>관리자메모</option>
        </select>
        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
        <input type="submit" class="btn_submit" value="검색">
    </div>
</form>

<div class="local_desc01 local_desc">
    <p>
        승인여부가 [승인완료] 되어야 아이디 사용이 가능합니다.<br>
        [회원탈퇴] 처리 시 다른 회원이 기존 회원 아이디를 사용하지 못하도록 회원 아이디, 이름은 삭제하지 않고 영구 보관합니다.<br>
        <?php if ($tab == "2") { ?>대리점에서 기사의 [퇴사신청]이 가능하며, 최고관리자가 확인 후 [퇴사승인]으로 처리됩니다.<?php } ?>
    </p>
</div>

<div class="btn_add01 btn_add">
    <div class="tab" id="mb_tab">
        <ul>
            <li><label for="t2all" <?php if ($tab2 == "") { ?>class="on"<?php } ?>><input type="radio" name="tab2" id="t2all" value="" <?php if ($tab2 == "") echo "checked"; ?>>전체</label></li>
            <?php
            $tab_auth_list = $user_auth_list;

            if ($tab == "1" || $tab == "3") { // 고객 탭이면
                unset($tab_auth_list["3"]);
                unset($tab_auth_list["4"]);
            }

            foreach ($tab_auth_list as $key=>$val) {
                $chked = ($tab2 == $key && $tab2 != "") ? true : false;
                ?>
                <li><label for="t2<?=$key?>" <?php if ($chked) { ?>class="on"<?php } ?>><input type="radio" name="tab2" id="t2<?=$key?>" value="<?=$key?>" <?php if ($chked) echo "checked"; ?>><?=$val?></label></li>
            <?php } ?>
        </ul>
    </div>

    <?php if ($tab == "2") { ?>
        <div class="tab" id="driver_tab">
            <select name="driver_lv">
                <option value="">기사전체</option>
                <?php foreach ($driver_list as $key=>$val) { ?>
                    <option value="<?=$key?>" <?php if (!empty($tab3) && $tab3==$key) echo "selected";?>><?=$val?></option>
                <?php } ?>
            </select>
        </div>
    <?php } ?>

    <a href="./member_form.php?tab=<?=$tab?>" id="member_add"><?php echo ($tab == "1") ? "고객등록" : (($tab == "2") ? "기사등록" : "CCM등록"); ?></a>
</div>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="tab" value="<?php echo $tab ?>">
    <input type="hidden" name="tab2" value="<?php echo $tab2 ?>">
    <input type="hidden" name="tab3" value="<?php echo $tab3 ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <col width="3%">
                <col width="5%">
                <col width="7%">
                <?php if ($tab == "2") { ?><col width="7%"><?php } ?>
                <col width="15%">
                <col width="*">
                <?php if ($tab == "2") { ?><col width="7%"><?php } ?>
                <col width="*">
                <col width="*">
                <col width="10%">
                <col width="10%">
                <col width="7%">
                <col width="*">
            </colgroup>
            <thead>
            <tr>
                <th scope="col">
                    <label for="chkall" class="sound_only">회원 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th>No.</th>
                <th>승인여부</th>
                <?php if ($tab == "2") { ?><th>계좌출금<br>승인여부</th><?php } ?>
                <th>대리점</th>
                <th>회원구분</th>
                <th>아이디</th>
                <?php if ($tab == "2") { ?><th>콜유형</th><?php } ?>
                <th><?php echo subject_sort_link('mb_name') ?>이름</a></th>
                <th>생년월일</th>
                <th>관리자 메모</th>
                <th>휴대폰</th>
                <?php if ($tab != "3") { ?><th>포인트</th><?php } ?>
                <?php if ($tab != "3") { ?><th>포인트<br>자동차감</th><?php } ?>
                <th>가입일</th>
                <th>관리</th>
                <?php if ($tab == "2") {?><th>계약서</th><?php }?>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $bg = 'bg'.($i%2);

                $mb_id = $row['mb_id'];

                // 대리점
                $rs = sql_fetch("SELECT mb_nick FROM g5_member WHERE mb_no = '{$row['agency_no']}'");
                $agency_name = $rs['mb_nick'];

                // 수정
                $mod_link = "./member_form.php?w=u&mb_id=".$row['mb_id'];
                if (strlen($qstr) > 0) $mod_link .= "&".$qstr;

                // 승인여부 (탈퇴승인은 최고관리자만 가능)
                $auth_list = $user_auth_list;

                if ($row['mb_level'] == "2") { // 고객
                    unset($auth_list["3"]);
                    unset($auth_list["4"]);
                } elseif (array_key_exists($row['mb_level'], $driver_list)) { // 기사
                    if ($member['mb_level'] != "10") unset($auth_list["4"]);
                }

                ?>
                <tr class="<?php echo $bg; ?>">
                    <td>
                        <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
                        <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td><?=$list_no?></td>
                    <td>
                        <select name="mb_user_auth[<?=$i?>]" data-idx="<?=$i?>">
                            <?php foreach ($auth_list as $key=>$val) { ?>
                                <option value="<?=$key?>" <?php if ($row['mb_user_auth'] == $key) echo "selected"; ?>><?=$val?></option>
                            <?php } ?>
                        </select>
                    </td>

                    <?php if ($tab == "2") { ?>
                        <td>
                            <?php if ($member['mb_level'] == "10") { ?>
                                <select name="mb_user_acc[<?=$i?>]" data-idx="<?=$i?>">
                                    <?php foreach ($driver_acc_list as $key=>$val) { ?>
                                        <option value="<?=$key?>" <?php if ($row['mb_user_acc'] == $key) echo "selected"; ?>><?=$val?></option>
                                    <?php } ?>
                                </select>
                                <?php
                            } else {
                                echo $driver_acc_list[$row['mb_user_acc']];
                            }
                            ?>
                        </th>
                    <?php } ?>
                    <td><?=$agency_name?></td>

                    <td><?=$tdr_member[$row['mb_level']]?></td>
                    <td><?=$row['mb_id']?></td>
                    <?php if ($tab == "2") { ?><td><?=$driver_call_type[$row['driv_type']]?></td><?php } ?>
                    <td><a href="<?=$mod_link?>#point_list"><?=get_text($row['mb_name'])?></a></td>
                    <td><?=$row['mb_birth']?></td>
                    <td><?=nl2br($row['mb_memo'])?></td>
                    <td><?=$row['mb_hp']?></td>
                    <?php if ($tab != "3") { ?><td><?=number_format($row['mb_point'])?></td><?}?>
                    <?php if ($tab != "3") { ?><td>
                        <?php if ($row['at_point_type'] == "1") echo "<div>월 차감</div>" ?>
                        <?php if ($row['at_point2_type'] == "1") echo "<div>일 차감</div>" ?>
                    </td>
                    <?}?>
                    <td><?=substr($row['mb_datetime'],0,10)?></td>
                    <td><a href="<?=$mod_link?>">수정</a></td>

                    <?php if ($tab == "2") {?>
                        <td><a href="javascript:void(0)" onclick="openContract('<?=$mb_id?>')">보기</a></td>
                    <?php }?>
                </tr>
                <?php
                $list_no--;
            }
            if ($i == 0)
                echo "<tr><td colspan='20' class='empty_table'>자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <div class="btn_list01 btn_list">
        <input type="submit" name="act_button" value="회원상태변경" onclick="document.pressed=this.value">
        <input type="submit" name="act_button" value="회원탈퇴" onclick="document.pressed=this.value">
    </div>

</form>

<?php
$paging_params = get_paging_params($qstr);
echo get_paging($config['cf_write_pages'], $page, $total_page, '?'.$paging_params);
?>

<script>
    $(function() {
        // 승인여부 변경시 체크
        $(".mb_tbl select").on("change", function() {
            var idx = $(this).data("idx");
            if (typeof idx != "undefined") {
                $("#chk_" + idx).prop("checked", true);
            }
        });

        // 승인여부 카테고리 클릭시
        $("#mb_tab input[name=tab2]").on("change", function() {
            document.fsearch.tab2.value = $(this).val();
            document.fsearch.submit();
        });

        // 기사select변경
        $("#driver_tab select").on("change", function() {
            document.fsearch.tab3.value = $(this).val();
            document.fsearch.submit();
        });

    });


    function fmemberlist_submit(f)
    {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if(document.pressed == "회원탈퇴") {
            if(!confirm("선택한 회원을 탈퇴처리 하시겠습니까?")) {
                return false;
            }
        }

        if(document.pressed == "회원상태변경") {
            if(!confirm("선택한 회원의 상태를 변경하시겠습니까?")) {
                return false;
            }
        }

        return true;
    }

    // 계약서보기
    var child = "";
    function openContract(mb_id) {
        var pop_w = 500,
            pop_h = 700,
            left = Math.floor((window.innerWidth - pop_w) / 2),
            top = Math.floor((window.innerHeight - pop_h) / 2);

        child = window.open(g5_admin_url + "/member_contract.php?mb_id=" + mb_id, "기사 계약서", "width="+pop_w+"px,height="+pop_h+"px,top="+top+",left="+left+",scrollbars=yes");
    }
</script>

<?php
include_once ('./admin.tail.php');
?>
