<link rel="stylesheet" href="<?php echo G5_PLUGIN_URL;?>/hash/style.css">


<nav id="navtoggle">
<a href="javascript:history.back();" class="close"><span class="sound_only">닫기</span></a>
<div class="scroll">
 <ul>
    <li>
     <div class="nav_close"></div>
        <ul id="hd_tnb" class="cf">
            <?php if ($is_member) { ?>
            <?php if ($is_admin) { ?>
            <!--<li class="adm"><a href="<?php echo G5_ADMIN_URL ?>">관리자모드</a></li> -->
            <?php } ?>
            <!--<li class="mod"><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">회원정보수정 <i class="fa fa-user"></i></a></li> -->
            <li class="mod"><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃 <i class="fa fa-unlock"></i></a></li>
            <?php } else { ?>
            <li class="mod"><a href="<?php echo G5_BBS_URL ?>/login.php">관리자로그인 <i class="fa fa-lock"></i></a></li>
            <?php } ?>
            <!--<li><a href="<?php echo G5_THEME_URL ?>/sitemap.php">사이트맵 <i class="fa fa-sitemap"></i></a></li> -->
        </ul>
        <div id="left_menu">
        <!--<div class="title"><i class="fa fa-th-large"></i> 전체메뉴 안내</div>-->
              <!--메뉴시작-->
              <div id="accordion-example" data-collapse="accordion">
                <div id="gnb2" class="hd_div">
                        <ul id="mgnb_1dul">
                        <?php
                        $sql = " select *
                                    from {$g5['menu_table']}
                                    where me_mobile_use = '1'
                                      and length(me_code) = '2'
                                    order by me_order, me_id ";
                        $result = sql_query($sql, false);
            
                        for($i=0; $row=sql_fetch_array($result); $i++) {
                        ?>
                            <li class="mgnb_1dli">
                                <a class="mgnb_1da"><?php echo $row['me_name'] ?><i class="fa fa-angle-down"></i></a>
                                <!--1차메뉴-->
                                <?php
                                $sql2 = " select *
                                            from {$g5['menu_table']}
                                            where me_mobile_use = '1'
                                              and length(me_code) = '4'
                                              and substring(me_code, 1, 2) = '{$row['me_code']}'
                                            order by me_order, me_id ";
                                $result2 = sql_query($sql2);
            
                                for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                                    if($k == 0)
                                        echo '<ul class="mgnb_2dul">'.PHP_EOL;
                                ?>
                                    <li class="mgnb_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="mgnb_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
                                <?php
                                }
            
                                if($k > 0)
                                    echo '</ul>'.PHP_EOL;
                                ?>
                            </li>
                        <?php
                        }
            
                        if ($i == 0) {  ?>
                            <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
                        <?php } ?>
                        </ul>
                    </div>
              </div>
        </div>
    </li>
 </ul>
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