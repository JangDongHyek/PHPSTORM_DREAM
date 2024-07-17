<?
include_once('./_common.php');
$name = "cmypage";
$pid = "mypage";
$g5['title'] = '설정';
include_once('./_head.php');

?>

    <div id="area_mypage">
        <div class="inr">
            <div id="mypage_wrap">
                <br>
                <!-- 마이페이지에만 나오는 메뉴 -->
                <div id="mypage_menu">
                    <h3>설정</h3>
                    <ul class="menu_list">
                        <li><a href="javascript:swal('준비중입니다.')">회원탈퇴</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



<?
include_once('./_tail.php');
?>