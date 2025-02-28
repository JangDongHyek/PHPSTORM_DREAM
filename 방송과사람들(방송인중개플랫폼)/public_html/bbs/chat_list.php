<?
include_once('./_common.php');
include_once('./class/Lib.php');
$name = "chat_list";
$pid = 'chat';
$g5['title'] = '채팅리스트';
include_once('./_head.php');

$jl = new JL();

/** 채팅리스트 **/
if(!$is_member){
    alert("로그인이 필요합니다.",G5_BBS_URL.'/login.php?url='.G5_BBS_URL."/chat_list.php" );
}
?>

<? if($name=="chat_list") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="chat_list">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/chat/style.css?v=<?= G5_CSS_VER ?>">

<style>
	.left_menu .hd_sch{display:none;}
</style>

<div id="area_chat">
    <div class="chat_list_wrap">
         <!--<ul class="tabs">
            <li class="active" rel="tab1"><span>일반회원</span></li>
            <li rel="tab2"><span>기업회원</span></li>
        </ul>-->

        <?php if(!$is_admin) { ?>
        <button type="button" class="btn_confirm violet" onclick="chatting('admin');">관리자에게 문의하기</button>
        <?php } ?>

        <div class="box_sch">
            <form name="fsearch" method="get">
                <input type="hidden" id="stx" name="stx" placeholder="검색" value="<?=$stx?>"><button type="submit"></button>
            </form>
        </div> <!-- 채팅방 이름 검색 -->

        <chat-list mb_no="<?=$member['mb_no']?>"></chat-list>


    </div>
</div>


<form id="fchatting" name="fchatting" method="post" action="./chat.php">
    <input type="hidden" name="inquiry_idx" id="inquiry_idx" value="">
    <input type="hidden" name="you_mb_id" id="you_mb_id" value="">
</form>

<?
$jl->vueLoad("area_chat");
$jl->includeDir("/component/chat");
include_once('./_tail.php');
?>

<!--<script src="--><?//=G5_JS_URL?><!--/socket.io.js"></script>-->
<!--<script src="--><?//=G5_JS_URL?><!--/chat.js"></script>-->
<script>

$(document).ready(function() {
    /*$(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
		if(!($(this).find('a').length > 0)){
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn()
		}
    });*/

    //chatLogin('<?//=$member['mb_id']?>//'); // head로 이동
    chatList('<?=$member['mb_id']?>');
});

// 채팅방 입장
function chatting(you_mb_id, idx) {
    if(you_mb_id != '' && you_mb_id != undefined) {
        $('#you_mb_id').val(you_mb_id);
    }
    if(idx != '' && idx != undefined) { // 기업의뢰 채팅 시
        $('#inquiry_idx').val(idx);
    }
    $('#fchatting').submit();
}

</script>
