</div>

<? if ($footer_type == 1) { ?>
<div id="ft_menu">
	<ul>
        <li>
            <a class="ft_logo" href="<?php echo G5_URL ?>/app/index.php">
                <img src="<?php echo G5_IMG_URL ?>/logo_mark.svg">
            </a>
        </li>
    	<li <?php if($pid == "counselor") { echo "class='on'"; }?>>
            <?php
            $counselor_link = G5_URL."/app/counselor.php";
            if(!$is_member) $counselor_link = "javascript:swal('로그인이 필요합니다.');";
            ?>
            <a href="<?=$counselor_link?>">
                <i class="fa-regular fa-square-heart"></i>
                <p>카운슬러</p>
            </a>
        </li>
    	<li <?php if($pid == "notice") { echo "class='on'"; }?>>
            <a href="<?php echo G5_URL ?>/app/notice.php">
                <i class="fa-regular fa-bullhorn"></i>
                <p>공지</p>
            </a>
        </li>
        <li <?php if($pid == "column") { echo "class='on'"; }?>>
            <a href="<?php echo G5_URL ?>/app/column.php">
                <i class="fa-regular fa-book-open"></i>
                <p>칼럼</p>
            </a>
        </li>
        <li <?php if($pid == "event") { echo "class='on'"; }?>>
            <a href="<?php echo G5_URL ?>/app/event.php">
                <i class="fa-regular fa-gift"></i>
                <p>이벤트</p>
            </a>
        </li>
    	<li <?php if($pid == "mypage" ) { echo "class='on'"; }?>>
			<?php if ($is_member) {  ?>
            <a href="<?php echo G5_URL ?>/app/mypage.php"><i class="fa-regular fa-square-user"></i><p>마이페이지</p></a>
            <?php } else {  ?>
            <a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa-regular fa-square-user"></i><p>로그인</p></a>
            <?php }  ?>
        </li>
    </ul>
</div>
<? } else { ?>
<? } ?>

<!-- 해시 새창열기 -->
<style>
    #hash_popup {border:0;position:fixed;top:0;left:0;width:100%;height:100%;z-index: 1000;overflow: scroll;}
</style>
<script>
    window.addEventListener("hashchange", function(){
        if (location.hash == "") removeViewFrame();
        else createViewFrame();
    });
    window.onload = function() {
        if (location.hash == "") removeViewFrame();
        else createViewFrame();
    }

    // 상세보기 아이프레임 생성
    let parent_scroll = 0; // 아이프레임에서 돌아왔을때 스크롤 위치 저장
    function createViewFrame() {
        let src = "";
        parent_scroll = $(window).scrollTop();

        if (location.hash.indexOf("#notice") == 0) { // 공지 상세보기
            src = "./notice_view.php?idx=" + location.hash.replace("#notice", "");
        } else if (location.hash.indexOf("#column") == 0) { // 롱런칼럼 상세보기
            src = "./column_view.php?idx=" + location.hash.replace("#column", "");
        } else if (location.hash.indexOf("#event") == 0) { // 이벤트 상세보기
            src = "./event_view.php?idx=" + location.hash.replace("#event", "");
        }

        if (src != "") {
            let frame = $(`<iframe id="hash_popup" src="${src}"></iframe>`);
            $("body").append(frame);
        } else {
            removeViewFrame();
        }
    }

    // 상세보기 아이프레임 제거
    function removeViewFrame() {
        if (parent_scroll > 0) $(window).scrollTop(parent_scroll);
        $("#hash_popup").remove();
    }

</script>

<?php
require_once('../tail.sub.php');
?>
