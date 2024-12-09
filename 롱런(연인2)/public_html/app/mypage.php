<?php
$pid = "mypage";
include_once("./app_head.php");

if (!$is_member) {
    goto_url(G5_BBS_URL."/login.php");
}

// 회원이미지
$mb_img = getMemberImg($member['mb_id']);

// 하트, 쿠폰 개수
$sql = "SELECT COUNT(*) AS coupon_cnt,
        (SELECT mb_heart FROM g5_heart WHERE mb_no = '{$member['mb_no']}' ORDER BY idx DESC LIMIT 1) AS mb_heart
        FROM g5_coupon WHERE mb_no = '{$member['mb_no']}' AND use_date = ''";
$row = sql_fetch($sql);
$coupon_cnt = $row['coupon_cnt'];
$heart_cnt = $row['mb_heart'];

?>
<script>
    // 진행중 상태변경
    function changeStatus() {
        let cur_status = document.querySelector("[name=mb_switch]").value;
        let msg = (cur_status=="on")? "휴면중" : "진행중";
        msg = `회원님의 상태를 [${msg}]으로 변경하시겠습니까?`;

        swal(msg, {
            buttons: {
                cancel: "취소",
                catch: {text: "변경", value: "catch",},
            },
        }).then((value) => {
            if (value == "catch") {
                $.ajax({
                    type : "POST",
                    url : g5_bbs_url + "/ajax.app_update.php",
                    data : {cur_status: cur_status, mode: 'changeStatus'},
                    dataType : "json",
                }).done(function(data, textStatus, xhr) {
                    if (data.result) {
                        location.reload();
                    }
                    else swal("상태 변경에 실패했습니다. 잠시 후 다시 시도해 주세요.");
                }).fail(function(data, textStatus, errorThrown) {
                    swal("상태 변경에 실패했습니다. 잠시 후 다시 시도해 주세요.");
                });
            }
        });

    }
</script>

<div id="mypage">
    <div class="area_my">
        <div class="info">
            <div class="photo btn_in">
                <p>
                    <? if ($mb_img['cnt'] > 0) { // 사진 존재하면 ?>
                    <img src="<?=$mb_img['list'][0]['src']?>">
                    <? }  ?>
                </p>
                <a href="../bbs/register_form.php?w=u#step-4"><i class="fa-sharp fa-solid fa-camera"></i></a>
            </div>
            <div class="text">
                <p class="name">
                    <strong><?=$member['mb_name']?>님</strong>
                    <a class="btn line small" href="../bbs/register_form.php?w=u#step-3">프로필수정</a>
                    <a class="btn line small" href="../bbs/logout.php?target=app">로그아웃</a>
                </p>
                <p class="email"><?=hyphen_hp_number($member['mb_hp'])?></p>
                <p class="state" id="member_status">
                    <input type="hidden" name="mb_switch" value="<?=$member['mb_switch']?>">
                    <? if ($member['mb_switch']=="on") { ?>
                    <span class="on">현재 <strong><i class="fa-solid fa-heart-pulse"></i> 롱런진행중</strong>이십니다.</span>
                    <? } else { ?>
                    <span class="off">현재 <strong><i class="fa-light fa-heart"></i> 롱런휴면중</strong>이십니다.</span>
                    <? } ?>
                    <a href="javascript:void(0)" onclick="changeStatus()"><i class="fa-regular fa-arrows-repeat"></i></a>
                </p>
            </div>
        </div>
        <? if ($is_member && $member['mb_sex'] == "남") { ?>
        <!-- 남자회원만 노출 -->
        <div class="icon_menu">
            <a href="./my_heart.php"><i class="fa-sharp fa-solid fa-heart"></i>하트<strong><?=$heart_cnt?></strong></a>
            <a href="./my_coupon.php"><i class="fa-regular fa-ticket-simple"></i>나의 쿠폰<strong><?=$coupon_cnt?></strong></a>
        </div>
        <? } ?>
    </div>
    <ul class="area_menu">
        <li><a href="./guide.php">롱런 가이드라인</a></li>
        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=provision">서비스 이용약관</a></li>
        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=privacy">개인정보 처리방침</a></li>
        <li><a href="javascript:void(0);" onclick="confirmAction()">탈퇴하기</a></li>
    </ul>

</div>

<script>
    function confirmAction() {
        var confirmed = confirm("회원 탈퇴를 하시겠습니까?\n(탈퇴를 위해 카카오톡 채널로 연결이됩니다.)");
        if (confirmed) {
            window.location.href = "http://pf.kakao.com/_idhdn/chat";
        }
    }
</script>

<?php
include_once ("./app_tail.php");
?>