<link rel="stylesheet" href="<?php echo G5_PLUGIN_URL;?>/hash/style.css">
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.menu.js"></script><!--상단메뉴(pc및모바일) 및 그외 JS추가부분-->



    <!-- 전체메뉴 시작 { -->
    <nav id="navtoggle" class="new">
        <a href="javascript:history.back();" class="nav_close"><span class="sound_only">닫기</span></a>
        <div class="">
                <p class="name"><?=$member['mb_name']?>님의<br>인연을<br>찾아드려요</p>

            <div class="flex ai-c jc-bw switch_wrap">
                <?
                // 회원 휴면기/진행기 on, off
                $sw_flag = strtolower(strtolower($member['mb_switch']));
                $sw_str = ($sw_flag == "on")? "checked" : " ";
                ?>
                <input type="checkbox" id="switchHash" <?=$sw_str?> onclick="changeMemberSwitch('<?=$member['mb_id']?>', this);" data-flag="<?=$sw_flag?>"/>
                <label for="switchHash">Toggle</label>
                <p>인연 찾는중</p>
            </div>
            <nav id="gnb" class="CE">
                <ul>
                    <li><a href="<?php echo G5_BBS_URL; ?>/rules.php">연인소개룰</a></li>
                    <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_event">이벤트 안내</a></li>
                    <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_notice">공지사항</a></li>
                    <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_counsel">연애상담소</a></li>
                </ul>
            </nav>
        </div>


        <div id="left_menu">
            <p>
                <a href="<?=G5_BBS_URL?>/logout">로그아웃</a>
                <a href="javascript:void(0);" onclick="confirmAction()">회원 탈퇴</a>
                <a href="<?=G5_BBS_URL?>/content.php?co_id=privacy">개인정보처리방침</a>
                <a href="<?=G5_BBS_URL?>/content.php?co_id=provision">이용약관</a>
            </p>
        </div>
    </nav>
    <!-- } 전체메뉴 끝 -->

<script type="text/javascript">
    function confirmAction() {
        var confirmed = confirm("회원 탈퇴를 하시겠습니까?\n(탈퇴를 위해 카카오톡 채널로 연결이됩니다.)");
        if (confirmed) {
            // 장치 유형에 따라 리디렉션
            if (/iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream) {
                // iOS 장치
                helperLink('http://pf.kakao.com/_xeYhxhxb/chat');
            } else {
                // iOS가 아닌 장치
                window.location.href = "http://pf.kakao.com/_xeYhxhxb/chat";
            }
        }
    }
</script>

<?/*php } else {?>
<!-- 전체메뉴 시작 { -->
<nav id="navtoggle">
 <ul>
    <li>
     <a href="javascript:history.back();" class="nav_close"><span class="sound_only">닫기</span></a>
     <a href="<?=G5_BBS_URL?>/logout" class="setting"><span class="sound_only">설정</span></a>
        <ul id="hd_tnb" class="cf">
            <? /* php if ($is_member) { ?>
            <?php if ($is_admin) { ?>
            <li class="adm"><a href="<?php echo G5_ADMIN_URL ?>">관리자모드</a></li>
            <?php } ?>
            <!-- <li class="mod"><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">마이페이지 <i class="fa fa-user"></i></a></li> -->
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃 <i class="fa fa-unlock"></i></a></li>
            <?php } else { ?>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인 <i class="fa fa-lock"></i></a></li>
            <?php } ?>
            <li><a href="<?php echo G5_URL ?>/theme/basic/mobile/sitemap.php">사이트맵 <i class="fa fa-sitemap"></i></a></li> 
			<? / ?>
        </ul>
        
        <div class="scroll">
            <div id="mypage">
				<?
				// 나이
				$mb_age = (date("Y")+1) - (int)substr($member['mb_birth'], 0, 4);

				// 내 소개
				$mb_profile = iconv_substr($member['mb_profile'], 0, 20, "utf-8");
				if (mb_strlen($member['mb_profile'], 'utf-8' ) > 20) {
					$mb_profile .= "…";
				}

				// 회원사진
				$mb_img_info = getMemberImg($member['mb_id']);
				$mb_img_src = '<img src="'.G5_THEME_IMG_URL.'/mobile/no_image.png" alt="회원이미지">';

				if ($mb_img_info['cnt'] > 0 && $mb_img_info['list'][0]['src'] != "") {
					$mb_img_src = getImgSquare($mb_img_info['list'][0]['src'], 110);
				}
				?>
                <div class="myimg">
                    <div class="img_rd">
						<?=$mb_img_src?>
						<!--<img src="<?=G5_THEME_IMG_URL?>/mobile/no_image.png" alt="회원이미지">-->
                    </div>
                    <a href="<?=G5_BBS_URL?>/register_form.php?w=u&st=img" class="btn_mod"></a>
                </div>
                <p class="myname"><strong><?=$member['mb_name']?></strong><span>(<?=$mb_age?>세, <?=iconv_substr($member['mb_sex'], 0, 1, "utf-8");?>)</span></p>
                <p class="mymail"><?=$member['mb_email']?></p>
                <p class="mycomm"><?=$mb_profile?></p>
                <div class="myedit" onclick="location.href='<?=G5_BBS_URL?>/register_form.php?w=u'"><img src="<?php echo G5_THEME_IMG_URL; ?>/mobile/btn_write.png" alt="간단소개 수정"></div>
            </div><!--//mypage-->
            
            <nav id="gnb" class="CE">
                <ul>
                    <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=rule01">연인소개룰</a></li>
                    <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_event">이벤트 안내</a></li>
                    <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_notice">공지사항</a></li>
                    <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_counsel">연애상담소</a></li>
					<?
					// 회원 휴면기/진행기 on, off
					$sw_flag = strtolower(strtolower($member['mb_switch']));
					$sw_str = ($sw_flag == "on")? "진행기" : "휴면기";
					?>
                    <li onclick="setMemberSwitch('<?=$member['mb_id']?>', '<?=$sw_flag?>', 'sub');">
						소개 ON/OFF<span class="<?=$sw_flag?>_so" id="sub_flag"><span><?=$sw_str?></span><i class="far fa-grin"></i></span>
					</li>
                   <li style="border-bottom:0"><a href="<?=G5_URL?>/bbs/member_confirm.php?url=<?=G5_URL?>/bbs/member_leave.php">탈퇴하기</a></li>
                </ul>
            </nav>
        </div>
        
        
        <div id="left_menu">
        <!--<div class="title"><i class="fa fa-th-large"></i> 전체메뉴 안내</div>-->
              <!--메뉴시작-->
              <div id="accordion-example" data-collapse="accordion">
                <div id="gnb" class="hd_div">
                        <ul id="gnb_1dul">
                        <? /* php
                        $sql = " select *
                                    from {$g5['menu_table']}
                                    where me_mobile_use = '1'
                                      and length(me_code) = '2'
                                    order by me_order, me_id ";
                        $result = sql_query($sql, false);
            
                        for($i=0; $row=sql_fetch_array($result); $i++) {
                        ?>
                            <li class="gnb_1dli">
                                <a class="gnb_1da"><?php echo $row['me_name'] ?><i class="fa fa-angle-down"></i></a>
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
                                        echo '<ul class="gnb_2dul">'.PHP_EOL;
                                ?>
                                    <li class="gnb_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
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
                        <?php } / ?>
                        </ul>
                    </div>
              </div>
        </div>
    </li>
 </ul>
</nav>
<!-- } 전체메뉴 끝 -->
<?php }*/?>