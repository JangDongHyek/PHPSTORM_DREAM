</div>

<? if ($header_type == 1) { ?>
<div id="ft_copy">
    <div id="ft_company">
        부산광역시 해운대구 좌동 순환로 395 한라프라자 4층<br />
        대표자명 : 정은희&nbsp;&nbsp;전화번호 : 051-746-9987<br />
        사업자등록번호 : 330-79-00246<br />
        계좌 : 기업은행 051-746-9987 정은희
        <!--세금계산서 발행 : 기업은행 051-746-9987 정은희<br/>
        세금계산서 미발행 : 국민은행 062001-04-087503 정태현--></p>
    </div>
    (C)<b>JUNDOSIRAk</b>  All RIGHT RESERVED.<br>
    <a href="http://pf.kakao.com/_wkaIs/chat" target="<?php echo strpos($_SERVER['HTTP_USER_AGENT'],"IOS")?"":"_blank";?>" class="ft_kakao"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_kakao.png" />카카오톡 상담하기</a>
</div>
<? } ?>

<?php
include_once(APP_URL.'/get_page.php'); // 페이징
require_once('../tail.sub.php');
?>