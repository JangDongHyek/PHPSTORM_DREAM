<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);
?>

<!-- 로그인 후 아웃로그인 시작 { -->
<strong><?php echo $nick ?>님</strong>
<?php if ($is_admin == 'super' || $is_auth) {  ?><a href="<?php echo G5_ADMIN_URL ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" value="로그인" style="width:80px; height:27px; line-height:27px; font-weight:bolder; margin-left:10px;">관리자 모드</a><?php }  ?>

<a class="mdl-navigation__link" href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php" id="ol_after_info">정보수정</a>
<a class="mdl-navigation__link" href="<?php echo G5_BBS_URL ?>/logout.php" id="ol_after_logout">로그아웃</a>
<script>
// 탈퇴의 경우 아래 코드를 연동하시면 됩니다.
function member_leave()
{
    if (confirm("정말 회원에서 탈퇴 하시겠습니까?"))
        location.href = "<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- } 로그인 후 아웃로그인 끝 -->
