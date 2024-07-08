<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '쿠폰';
include_once(G5_PATH.'/head.sub.php');

// 회원정보
$mb_no = $_GET['mb_no'];
$row = sql_fetch(" SELECT mb_id, mb_no, mb_name, mb_birth, mb_sex, mb_hp, mb_si, mb_gu FROM g5_member WHERE mb_no = '{$mb_no}' ");
if (!$row) {
	echo "<script>alert('회원정보를 불러오는데 실패하였습니다. 다시 시도해 주세요.'); window.close();</script>";
	exit;
}

$mb_id = $row['mb_id'];
$mb_name = $row['mb_name'];
$mb_birth = $row['mb_birth'];
$mb_sex = $row['mb_sex'];
$mb_hp = $row['mb_hp'];
$mb_si = $row['mb_si'];
$mb_gu = $row['mb_gu'];
$mb_age = (date("Y")+1) - substr($mb_birth, 0, 4);

// 쿠폰 목록
$sql = "SELECT A.*, B.mb_id AS match_mb_id, B.target_id AS match_target_id, 
        (SELECT mb_name FROM g5_member WHERE mb_id = B.mb_id) AS match_mb_name,
        (SELECT mb_name FROM g5_member WHERE mb_id = B.target_id) AS match_target_name
        FROM g5_coupon A LEFT JOIN g5_matching B ON A.matching_idx = B.idx
        WHERE A.mb_no = '{$mb_no}' ORDER BY A.idx DESC";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

// 관리자?
$is_adm = ($member['mb_status'] == "관리자")? true : false;

?>
<style>
    #co_issue_area {text-align: right;margin-top: 20px;}
    #co_list {margin-top: 10px;}
    #co_list .init {border: 1px solid #ececec; padding: 20px; text-align: center;}
    #co_list table {text-align: center}
</style>

<script>
    <?php if ($is_adm) { ?>
    // 신규쿠폰발급
    function issueCoupon(f) {
        let cnt = f.coupon_cnt.value;
        if (cnt == "") {
            alert("발급할 쿠폰 개수를 입력하세요.");
            f.coupon_cnt.focus();
            return false;
        }

        if (!confirm("신규 쿠폰 "+ f.coupon_cnt.value +"장을 발급하시겠습니까?")) return false;
        let data = {mode: "issueCoupon", mb_no: f.mb_no.value, cnt: f.coupon_cnt.value};

        $.ajax({
            type : "POST",
            url : "./ajax.coupon_update.php",
            data : data,
            dataType : "json",
        }).done(function(data, textStatus, xhr) {
            if (data.result) {
                opener.location.reload();
                location.reload();
            }
            else alert("쿠폰 발급에 실패했습니다. 잠시 후 다시 시도해 주세요.");
        }).fail(function(data, textStatus, errorThrown) {
            alert("쿠폰 발급에 실패했습니다. 잠시 후 다시 시도해 주세요.");
        });

        return false;
    }

    // 삭제
    function deleteCoupon(idx) {
        if (!confirm("선택하신 쿠폰을 삭제하시겠습니까?")) return false;

        $.ajax({
            type : "POST",
            url : "./ajax.coupon_update.php",
            data : {mode: "deleteCoupon", idx: idx},
            dataType : "json",
        }).done(function(data, textStatus, xhr) {
            if (data.result) {
                opener.location.reload();
                location.reload();
            }
            else alert("쿠폰 삭제에 실패했습니다. 잠시 후 다시 시도해 주세요.");
        }).fail(function(data, textStatus, errorThrown) {
            alert("쿠폰 삭제에 실패했습니다. 잠시 후 다시 시도해 주세요.");
        });

        return false;
    }
    <?php } ?>

</script>

<div id="popup_wrap" class="match">
	<p>쿠폰</p>
    <div class="tbl_head02 tbl_wrap">
        <!-- 회원정보 -->
        <? include_once("./member_info_pop.php"); ?>
        <!-- //회원정보 -->

        <? if ($is_adm) { ?>
        <!-- 쿠폰발급 -->
        <div id="co_issue_area">
            <form onsubmit="return issueCoupon(this);" autocomplete="off" method="post">
                <input type="hidden" name="mb_no" value="<?=$mb_no?>">
                <input type="text" name="coupon_cnt" class="frm_input f_num2" placeholder="개수 입력" style="padding: 0 5px;" size="15">
                <button type="submit" class="btn_frmline">신규쿠폰발급</button>
            </form>
        </div>
        <!-- 쿠폰발급 -->
        <? } ?>

        <!-- 쿠폰목록 -->
        <div id="co_list">
            <?if ($result_cnt==0) { ?>
            <div class="init">발급된 쿠폰이 없습니다.</div>
            <? } else { ?>
            <table>
                <caption>쿠폰목록</caption>
                <colgroup>
                    <col width="">
                    <col width="30%">
                    <col width="30%">
                    <col width="15%">
                    <? if ($is_adm) { ?><col width="10%"><?}?>
                </colgroup>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>발급일자</th>
                    <th>사용일자</th>
                    <th>상대이름</th>
                    <? if ($is_adm) { ?><th>관리</th><?}?>
                </tr>
                </thead>
                <tbody>
                <?
                $list_no = $result_cnt;
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    // 상대이름
                    $target_name = ($row['match_mb_id']==$mb_id)? $row['match_target_name'] : $row['match_mb_name'];
                ?>
                <tr>
                    <td><?=number_format($list_no)?></td>
                    <td><?=$row['issue_date']?></td>
                    <td><?=$row['use_date']?></td>
                    <td><?=$target_name?></td>
                    <? if ($is_adm) { ?><td><button type="button" class="btn02" onclick="deleteCoupon(<?=$row['idx']?>)">삭제</button></td><?}?>
                </tr>
                <? $list_no--; } // end foreach ?>
                </tbody>
            </table>
            <? } // end if ?>
        </div>
        <!-- //쿠폰목록 -->

    </div>

    <br>
    <div class="btn_confirm01 btn_confirm">
        <a href="javascript:void(0);" onclick="getWinClose();">닫기</a>
    </div>
</div>


<?php
include_once(G5_PATH.'/tail.sub.php');
?>