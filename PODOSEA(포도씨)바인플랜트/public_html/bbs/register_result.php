<?php
include_once('./_common.php');

//if (isset($_SESSION['ss_mb_reg']))
    //$mb = get_member($_SESSION['ss_mb_reg']);

// 회원정보가 없다면 초기 페이지로 이동
if (empty($_SESSION['ss_mb_id']))
    goto_url(G5_URL);
?>
<!-- 네이버 스크립트 (마케팅 관련) -->
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
    var _nasa={};
    if(window.wcs) _nasa["cnv"] = wcs.cnv("2","1"); //
</script>
<!-- End 네이버 스크립트 -->
<?php
$g5['title'] = '회원가입완료';
include_once('./_head.php');
include_once($member_skin_path.'/register_result.skin.php');
include_once('./_tail.php');
?>