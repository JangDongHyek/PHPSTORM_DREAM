<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '하트';
include_once(G5_PATH.'/head.sub.php');

if ($member['mb_status'] != "관리자") {
    die("잘못된 접근입니다.");
}

// 회원정보
$mb_no = $_GET['mb_no'];
$sql = "SELECT mb_no, mb_name, mb_birth, mb_sex, mb_hp, mb_si, mb_gu FROM g5_member WHERE mb_no = '{$mb_no}' ";
$row = sql_fetch($sql);
if (!$row) {
	echo "<script>alert('회원정보를 불러오는데 실패하였습니다. 다시 시도해 주세요.'); window.close();</script>";
	exit;
}

$mb_name = $row['mb_name'];
$mb_birth = $row['mb_birth'];
$mb_sex = $row['mb_sex'];
$mb_hp = $row['mb_hp'];
$mb_si = $row['mb_si'];
$mb_gu = $row['mb_gu'];
$mb_age = (date("Y")+1) - substr($mb_birth, 0, 4);

$mb_heart = getMemberHeart($mb_no);

// 마이페이지 > 하트
$sql = "SELECT * FROM g5_heart WHERE mb_no = '{$mb_no}' ORDER BY idx DESC";
$result = sql_query($sql);
$heart_cnt = 0;
$list = array();
for ($i = 0; $row = sql_fetch_array($result); $i++) {
    if ($i == 0) $heart_cnt = $row['mb_heart'];
    $list[] = $row;
}

?>
<style>
    #ht_tbl {text-align: center; margin: 20px 0 30px;}
    #ht_tbl input[type=text] {text-align: center;}
</style>

<script>
    // 변경
    function changeHeart(f) {
        if (f.new_heart.value == "") {
            alert("변경할 하트 개수를 입력하세요.");
            f.new_heart.focus();
            return false;
        }

        if (!confirm("하트 개수를 변경하시겠습니까?")) return false;

        let data = {};
        data.mode = "changeHeartCount";
        data.mb_no = f.mb_no.value;
        data.old_heart = f.old_heart.value;
        data.new_heart = f.new_heart.value;

        $.ajax({
            type : "POST",
            url : "./ajax.heart_update.php",
            data : data,
            dataType : "json",
        }).done(function(data, textStatus, xhr) {
            console.log(data);
            if (data.result) {
                opener.location.reload();
                location.reload();
            }
            else alert("변경에 실패했습니다. 잠시 후 다시 시도해 주세요.");
        }).fail(function(data, textStatus, errorThrown) {
            alert("변경에 실패했습니다. 잠시 후 다시 시도해 주세요.");
        });



        return false;
    }

</script>

<div id="popup_wrap" class="match">
	<p>하트</p>
    <div class="tbl_head02 tbl_wrap">
        <!-- 회원정보 -->
        <? include_once("./member_info_pop.php"); ?>
        <!-- //회원정보 -->

        <form method="post" onsubmit="return changeHeart(this)" autocomplete="off">
            <input type="hidden" name="mb_no" value="<?=$mb_no?>">
            <input type="hidden" name="old_heart" value="<?=$mb_heart?>">

            <!-- 하트정보 -->
            <table id="ht_tbl">
                <colgroup>
                </colgroup>
                <thead>
                <tr>
                    <th>현재 하트 개수</th>
                    <th>변경할 하트 개수</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?=$mb_heart?>개</td>
                    <td><input type="text" name="new_heart" class="frm_input f_num2" value="" size="10" required> 개</td>
                </tr>
                </tbody>
            </table>

            <div class="btn_confirm01 btn_confirm">
                <input type="submit" value="변경완료" class="btn_submit">
                <a href="javascript:void(0);" onclick="getWinClose();">닫기</a>
            </div>
        </form>

        <br>
        <? if (count($list) == 0) { ?>
        <div style="border: 1px solid #ececec; padding: 20px; text-align: center;">
            발급된 하트가 없습니다.
        </div>
        <? } else { ?>
        <table>
            <colgroup>
                <col width="15%">
                <col width="25%">
                <col width="">
                <col width="15%">
                <col width="15%">
            </colgroup>
            <thead>
            <tr>
                <th>No.</th>
                <th>일자</th>
                <th>내용</th>
                <th>적립/소진</th>
                <th>잔여</th>
            </tr>
            </thead>
            <tbody>
            <?
            $list_no = count($list);
            foreach ($list AS $key=>$val) {
                $point = ($val['plus_heart'] == 0)? "-".$val['minus_heart'] : "+".$val['plus_heart'];
            ?>
            <tr style="text-align: center;">
                <td><?=number_format($list_no)?></td>
                <td><?=$val['regdate']?></td>
                <td><?=$val['description']?></td>
                <td><?=$point?></td>
                <td><?=$val['mb_heart']?></td>
            </tr>
            <? $list_no--; } ?>
            </tbody>
        </table>
        <? } ?>

    </div>
</div>


<?php
include_once(G5_PATH.'/tail.sub.php');
?>