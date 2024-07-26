<?php
$big_ctg = ctg_list2();
?>
<link rel="stylesheet" href="<?php echo G5_PLUGIN_URL;?>/hash/style.css">


<nav id="navtoggle">
    <div class="hd_title">
        <a href="javascript:history.back();" class="btn_close"><i class="fa-regular fa-arrow-left"></i><span class="sound_only">닫기</span></a>
        <p class="title">카테고리</p>
    </div>
    <div class="scroll">
            <ul id="hd_tnb" class="cf">
                <?php if ($is_member) { ?>
                <div class="mb_box">
                    <div class="mb_photo"><img src="<?php echo G5_THEME_IMG_URL ?>/app/wing_mb_noimg.png"></div>
                    <div class="mb_info">
                        <p><?php echo $member['mb_nick'] ?></p>
                        <span>라이더스회원</span>
                        <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php" class="btn">프로필편집</a>
                        <a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn">로그아웃</a>
                    </div>
                </div>
                <?php } else { ?>
                <a href="<?php echo G5_BBS_URL ?>/login.php">로그인 후, 이용해주세요</a><br />
                <a href="<?php echo G5_BBS_URL ?>/login.php" class="btn">로그인</a>
                <a href="<?php echo G5_BBS_URL ?>/register_form.php" class="btn">회원가입</a>
                <?php } ?>
            </ul>
          <!--메뉴-->
            <div id="gnb2" class="hd_div">
                    <ul id="mgnb_1dul">
                        <?php for ($i = 0; $i< count($big_ctg); $i++){?>
                            <li class="mgnb_1dli">
                                <a class="mgnb_1da" href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=<?=$big_ctg[$i]["idx"]?>">
                                    <div class="area_icon"></div>
                                    <h3><?=$big_ctg[$i]["name"]?></h3>
                                </a>
                                <ul class="mgnb_2dul">
                                    <?php
                                    $small_ctg = ctg_list2($big_ctg[$i]["idx"]);
                                    for ($a = 0; $a< count($small_ctg); $a++){ ?>
                                        <li class="mgnb_2dli"><a class="mgnb_2da" href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=<?=$small_ctg[$a]["idx"]?>">
                                            <?=$small_ctg[$a]["name"]?>
                                        </a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>


            </div>
            <!--//메뉴-->


    </div>
</nav>

<script>
$(document).ready(function() {
	// 모바일 트리메뉴 .gnb .d1 h3를 클릭
	$("#navtoggle .mgnb_1dli .mgnb_1da").click(function(){
		var dp = $(this).siblings("ul.mgnb_2dul").css("display");
		if(dp=="none"){
			$("#navtoggle .mgnb_1dli .mgnb_1da").removeClass("on");
			$(this).addClass("on");
			$("#navtoggle .mgnb_1dli ul.mgnb_2dul").slideUp(500);
			$(this).siblings("ul.mgnb_2dul").slideDown(500);
			}
		if(dp=="block"){
			$("#navtoggle .mgnb_1dli .mgnb_1da").removeClass("on");
			$("#navtoggle .mgnb_1dli ul.mgnb_2dul").slideUp(500);
			}
		return false;
	});
});
</script>