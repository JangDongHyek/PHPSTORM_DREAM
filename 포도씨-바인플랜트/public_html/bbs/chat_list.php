<?
include_once('./_common.php');
$name = "chat_list";
$g5['title'] = '채팅리스트';
include_once('./_head.php');

/** 채팅리스트 **/

?>

<? if($name=="chat_list") { ?>
<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="chat_list">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

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
                <input type="text" id="stx" name="stx" placeholder="검색" value="<?=$stx?>"><button type="submit"></button>
            </form>
        </div> <!-- 채팅방 이름 검색 -->

        <div class="tab_container">
            <div id="tab1" class="tab_content">
                <!-- bbs/ajax.chat_list.php -->
                <ul class="chat_list ul_chat_list">
                    <!--<li>
                        <a href="<?/*=G5_BBS_URL*/?>/chat.php">
                            <div class="area_img"><img class="basic" src="<?php /*echo G5_IMG_URL */?>/img_smile.svg"></div>
                            <div class="chat_txt">
                                <div class="info"><em class="name">PODOSEA</em><span clas="data">11월 5일</span></div>
                                <div class="cont">김철수 고객님 안녕하세요. 요청하신 견적 제안금액입니다.김철수 고객님 안녕하세요. 요청하신 견적 제안금액입니다.김철수 고객님 안녕하세요. 요청하신 견적 제안금액입니다.김철수 고객님 안녕하세요. 요청하신 견적 제안금액입니다.김철수 고객님 안녕하세요. 요청하신 견적 제안금액입니다.</div>
                            </div>
                            <div class="badge">2</div>
                        </a>
                    </li>-->
                </ul>
            </div>
            <!--<div id="tab2" class="tab_content">
                <ul class="chat_list">
                    <li class="nodata">
                        <p>채팅 내역이 없습니다.</p>
                    </li>
                </ul>
            </div>-->
        </div>
    </div>
</div>


<form id="fchatting" name="fchatting" method="post" action="./chat.php">
    <input type="hidden" name="inquiry_idx" id="inquiry_idx" value="">
    <input type="hidden" name="you_mb_id" id="you_mb_id" value="">
</form>

<?
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
</script>