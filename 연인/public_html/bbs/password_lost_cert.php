<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

if ($is_member) {
    alert("이미 로그인중입니다.");
}

$g5['title'] = '회원정보 찾기';
include_once(G5_PATH.'/head.sub.php');


//include_once($member_skin_path . '/password_lost_cert.skin.php');

add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

// kcb인증후 비밀번호 업데이트
if ($_POST['kcb_cert'] == "Y") {

    /*
     * print_r($_POST);
        Array
        (
            [kcb_step] => 2
            [kcb_name] => ������
            [kcb_birth] => 19890220
            [kcb_sex] => F
            [kcb_hp] => 01026120220
            [kcb_cert] => Y
            [kcb_telcom] => 02
        )
     */

    $err_msg = "회원정보 찾기에 실패하였습니다.\n다시 시도해 주세요.";
    $err_url = G5_BBS_URL."/password_lost_cert.php";

    $mb_hp = $_POST['kcb_hp'];

    if ($mb_hp == "")
        alert($err_msg, $err_url);

    // (210914) 회원정보 조회 - 중복가입이 가능해져 여러건일수있음
    $sql = "SELECT mb_no, mb_id, mb_datetime FROM g5_member WHERE mb_hp = '{$mb_hp}' AND mb_status = '일반' ORDER BY mb_no DESC";
    $result = sql_query($sql);
    $result_cnt = sql_num_rows($result);

    $result_list = array();

    for ($i = 0; $i < $result_cnt; $i++) {
        $result_list[$i] = sql_fetch_array($result);
    }
}
?>
<style>
    .mbskin .btn_submit {width:60px;height:50px;background:#ac9dd4;color:#fff; width:100%;border-radius:0px !important; border:1px solid #fff; box-shadow:none;font-size:1.3em;font-weight:bold;margin:5px 0; transition:all 0.3s;}
    .mbskin .btn_submit:hover{ background:#fff!important; color:#2abaee!important; border-color:#2abaee!important; transition:all 0.3s;}
    .mbskin .win_btn {margin-top: 30px;}
    .mbskin .win_btn:after{ display:block; content:""; color:both;}
    .mbskin .win_btn .btn_submit{ font-size:13px; height:40px; float:left; width:50%; margin:0 !important; box-sizing: border-box;}
    .mbskin .win_btn .btn01{padding: 0; float:left; width:calc(48% - 2%); margin-left:2%; height: 40px; line-height: 40px; box-sizing: border-box; font-size: 13px;}
    .mbskin .win_btn .btn01.full {width: 100%;}
    .mbskin p {padding: 10px 0;}
    #find_frm {margin: 10px 0;}
    #find_info{padding:30px;}
    #find_info #mb_hp_label {display:inline-block;margin-left:10px}
    #find_info #info_fs {margin:0px 0px;padding:0; font-size:0.95em;}
    #find_info #info_fs input[type=radio] {margin:0; width:18px; height: 18px;}
    #find_info #info_fs label {margin: 0 5px;}
    #find_info #info_fs label span {font-weight: normal; font-size: 0.9em;}
    #find_info #info_fs .frm_input {width:100%; padding:0 10px; font-size:13px; margin-top:5px; height: 35px; background: #FFF; border: 0; border-bottom: 1px solid #ac9dd4; border-radius: 0 !important;}
    #find_info #info_fs .phone{ width:65%;}
    #find_info #info_fs .phone_btn{ width:calc(35% - 10px); margin:5px 0 0 5px; border:1px solid #333; background:#444; color:#fff; font-size:13px; padding:2px 0; height: 35px;}
    #find_info #info_fs  p {margin:15px 0;line-height:1.5em; font-size:13px;}
    #find_info #captcha {margin:0 20px}
    .mbskin button.btn01{width:100%;padding:10px 0;text-align:center;border-radius:0px!important; background:none; border:1px solid #ccc; color:#333; margin-bottom:3px; font-size:0.9em; letter-spacing:-1px;}
    #find_info #win_title { border-bottom:1px solid #ddd; padding:10px 0; font-size:1.4em; font-weight: 700;}
    #find_result {clear: both;}
    #find_result h1 {margin-bottom:10px; font-size: 14px; font-weight:bold;}
</style>

<div id="find_info" class="mbskin">
    <h1 id="win_title">회원정보 찾기</h1>

    <? if ($_POST['kcb_cert'] != "Y") { ?>
    <!-- 1) 찾기 -->
    <div id="find_frm">
        <fieldset>
            <p>휴대폰 본인인증 후 새로운 비밀번호로 변경하실 수 있습니다.</p>
        </fieldset>
        <div class="win_btn">
            <input type="button" value="본인인증" class="btn_submit" onclick="location.href='./kcb/phone_popup1.php?req_page=find'">
            <button type="button" onclick="javascript:history.back();" class="btn01">뒤로</button>
            <div style="clear:both;"></div>
        </div>
    </div>
    <!-- // 찾기 -->

    <? } else { ?>
    <!-- 2) 본인인증 완료 -->
    <div id="find_result">
        <fieldset id="info_fs">
            <? if (count($result_list) == 0) { ?>
            <p>존재하지 않는 회원정보 입니다.</p>
            <div class="win_btn">
                <button type="button" onclick="movePage('main')" class="btn01 full">메인으로 이동</button>
            </div>

            <? } else { ?>
            <p>해당 휴대폰번호로 가입된 아이디는 <strong><?=count($result_list)?>개</strong> 입니다.<br></p>
            <? foreach ($result_list AS $key=>$val) { ?>
            <h1>
                <input type="radio" name="mb_id" id="id<?=$key?>" value="<?=$val['mb_id']?>">
                <label for="id<?=$key?>"><?=$val['mb_id']?> <span>(가입일 : <?=substr($val['mb_datetime'],0,10)?>)</span></label>
            </h1>
            <? } ?>

            <div class="win_btn">
                <input type="button" value="임시비밀번호 발급" class="btn_submit" onclick="resetPassword()">
                <button type="button" onclick="movePage()" class="btn01">로그인으로 이동</button>
            </div>
            <? } ?>
        </fieldset>
    </div>

    <script>
        function movePage(page) {
            if (page == "main") location.href = g5_url;

            if (confirm("로그인으로 이동하시겠습니까?")) location.href = g5_bbs_url + "/login.php";
        }

        function resetPassword() {
            if ($("input[name=mb_id]:checked").length == 0) {
                alert("임시비밀번호를 발급받을 아이디를 선택하세요.");
                return false;
            }

            var mb_id = $("input[name=mb_id]:checked").val();

            $.post("./ajax.password_change.php", {mb_id: mb_id}).done(function(data) {
                if (data == "F") alert('임시비밀번호 발급에 실패하였습니다.\n다시 시도해 주세요.');
                else $("#info_fs").html(data);

            }, "html").fail(function() {
                alert('임시비밀번호 발급에 실패하였습니다.\n다시 시도해 주세요.');
            });
        }
    </script>

    <!-- // 본인인증완료 -->
    <? } ?>

</div>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>