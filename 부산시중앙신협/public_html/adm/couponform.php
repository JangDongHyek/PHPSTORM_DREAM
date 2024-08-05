<?php
$sub_menu = '400800';
include_once('./_common.php');

auth_check($auth[$sub_menu], "w");

$g5['title'] = '쿠폰관리';

if ($w == 'u') {
    $html_title = '쿠폰 수정';

    $sql = " select * from `v5_coupon` where cp_id = '$cp_id' ";
    $cp = sql_fetch($sql);
    if (!$cp['cp_id']) alert('등록된 자료가 없습니다.');


    $mb_ids = explode(",", $cp['mb_id']);

    // 각 회원 유형별 체크 여부 확인
    $checked_general = in_array("2", $mb_ids) ? "checked" : "";
    $checked_union = in_array("3", $mb_ids) ? "checked" : "";
    $checked_vip = in_array("4", $mb_ids) ? "checked" : "";
    $checked_vvip = in_array("5", $mb_ids) ? "checked" : "";

} else {
    $html_title = '쿠폰 입력';
    $cp['cp_start'] = G5_TIME_YMD;
    $cp['cp_end'] = date('Y-m-d', (G5_SERVER_TIME + 86400 * 7));
}

include_once (G5_ADMIN_PATH.'/admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
?>

    <form name="fcouponform" action="./couponformupdate.php" method="post" onsubmit="return form_check(this);">
        <input type="hidden" name="w" value="<?php echo $w; ?>">
        <input type="hidden" name="cp_id" value="<?php echo $cp_id; ?>">
        <input type="hidden" name="sst" value="<?php echo $sst; ?>">
        <input type="hidden" name="sod" value="<?php echo $sod; ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
        <input type="hidden" name="stx" value="<?php echo $stx; ?>">
        <input type="hidden" name="page" value="<?php echo $page;?>">

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <caption><?php echo $g5['title']; ?></caption>
                <colgroup>
                    <col class="grid_4">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="cp_subject">쿠폰이름</label></th>
                    <td>
                        <input type="text" name="cp_subject" value="<?php echo stripslashes($cp['cp_subject']); ?>" id="cp_subject" required class="required frm_input" size="50">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mb_id">회원아이디</label></th>
                    <td>
                        <?php echo help("회원전체를 체크 할 경우 회원아이디는 적용이 안됩니다. 별도로 만들어주세요."); ?>
                        <input type="text" name="mb_id" value="<?php echo stripslashes($cp['mb_id']); ?>" id="mb_id" class="frm_input">
                        <button type="button" id="sch_member" class="btn_frmline">회원검색</button>
<!--                        <input type="checkbox" name="chk_general" id="chk_general" value="general" <?/*= $checked_general */?>>
                        <label for="chk_general">일반회원</label>
                        <input type="checkbox" name="chk_vip" id="chk_vip" value="vip" <?/*= $checked_vip */?>>
                        <label for="chk_vip">VIP회원</label>-->
                        <input type="checkbox" name="chk_vvip" id="chk_vvip" value="vvip" <?= $checked_vvip ?>>
                        <label for="chk_vvip">VVIP회원전체</label>
<!--                        <input type="checkbox" name="chk_union" id="chk_union" value="union" <?/*= $checked_union */?>>
                        <label for="chk_union">조합원</label>-->
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cp_start">사용시작일</label></th>
                    <td>
                        <?php echo help('입력 예: '.date('Y-m-d')); ?>
                        <input type="text" name="cp_start" value="<?php echo stripslashes($cp['cp_start']); ?>" id="cp_start" required class="frm_input required">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cp_end">사용종료일</label></th>
                    <td>
                        <?php echo help('입력 예: '.date('Y-m-d')); ?>
                        <input type="text" name="cp_end" value="<?php echo stripslashes($cp['cp_end']); ?>" id="cp_end" required class="frm_input required">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cp_end">쿠폰사용중단</label></th>
                    <td>
                        <?php echo help("즉시 사용 중단이 필요할때 체크하세요."); ?>
                        <input type="checkbox" name="cp_finish" id="cp_finish" class="frm_input" <? if($cp['cp_finish'] == 'T') {?>checked<?}?> value="T">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="btn_confirm01 btn_confirm">
            <input type="submit" value="확인" class="btn_submit" accesskey="s">
            <a href="./couponlist.php?<?php echo $qstr ?>">목록</a>
        </div>
    </form>

    <script>
        $(function() {
            $("#sch_member").click(function() {

                var opt = "left=50,top=50,width=520,height=600,scrollbars=1";
                var url = "./couponmember.php";
                window.open(url, "win_member", opt);
            });

            $("#cp_start, #cp_end").datepicker(
                { changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99" }
            );
        });

        function form_check(f)
        {
            return true;
        }
    </script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>