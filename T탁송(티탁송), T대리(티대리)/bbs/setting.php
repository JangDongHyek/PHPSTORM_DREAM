<?php
include_once('./_common.php');
$g5['title'] = '거리설정';

//if (!$is_member || $is_driver) {
if (!$is_driver) {
    alert("잘못된 접근입니다.", G5_URL."/index.php");
}

include_once(G5_THEME_PATH.'/head.php');

if ($_POST['w'] == "u") {
    $mb_distance = (int)$_POST['distance'];
    $sql = "UPDATE g5_member SET mb_distance = '{$mb_distance}' WHERE mb_no = '{$member['mb_no']}'";
    if (sql_query($sql)) {
        $member['mb_distance'] = $mb_distance;
    }
}


?>
<style>
    #point_box.setting .pb_box select {width: 100%; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; height: 40px; font-size: 1.2em; font-family: inherit; margin-bottom:10px;}
</style>

<div id="point_box" class="setting">
    <div id="point_b">
        <div class="pb_title">거리설정</div>

        <form name="frm" method="post" action="./setting.php">
            <input type="hidden" name="w" value="u">

            <div class="pb_box">
                <select name="distance">
                    <?foreach ($driver_distance AS $key=>$str) { ?>
                    <option value="<?=$key?>" <?=($member['mb_distance']==$key || ($member['mb_distance']==0 && $key==999))? "selected": "";?>><?=$str?></option>
                    <?}?>
                </select>
                <input type="submit" class="pb_btn" value="거리설정완료">
            </div><!--.pb_box-->

            <div class="pb_txt">콜을 수락하실 범위(km)를 설정하세요.</div>
        </form>
    </div><!--#point_b-->
</div><!--#point_box-->


<?php
include_once('./_tail.sub.php');
//include_once(G5_THEME_PATH.'/tail.php');
?>