<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
	<? if(defined('_INDEX_')) {?>
    <!--메인컨테이너 부분-->
    </div><!--#container_index-->
    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <!--서브컨테이너 부분-->
    </div><!--#container-->
	<? } ?> 
</div>

<!-- } 콘텐츠 끝 -->

<hr>


<div id="quick">
	<div class="in">
    <h2>이름과 전화번호를 남겨주시면 빠른 상담 드리겠습니다.</h2>
    <form name="b_form_write" action="<?=G5_BBS_URL?>/sms_quickconsult.php" method="post" onSubmit="return b_checkvalue();">
    <input type="hidden" name="b_send_sms" value="ok">
    <div class="fr">
        <input name="b_name" type="text" class="input_03" placehold="이름입력"/>
    </div>
    <div class="fr">
        <input name="b_tel1" type="text" class="input_03" style="width:22%;height:25px" onKeyUp="b_auto_next();">
        <input name="b_tel2" type="text" class="input_03" style="width:22%;height:25px" onKeyUp="b_auto_next2();">
        <input name="b_tel3" type="text" class="input_03" style="width:22%;height:25px" />
    </div>
    <div><strong>개인정보수집동의</strong> <input type="checkbox" name="quick_checkbox" id="quick_checkbox" ></div>
    <div><a onclick=""><input type="image" src="http://itforone.co.kr/~unikorea2/theme/basic/img/main/quick_btn.gif" /></a></div>
    </div><!--in-->
</div><!--quick-->

 <article id="sublist" class="mquick" style="margin-bottom:10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form name="b_form_write" action="<?=G5_BBS_URL?>/sms_quickconsult.php" method="post" onSubmit="return b_checkvalue();">
<input type="hidden" name="b_send_sms" value="ok">
  <tr>
    <td height="80" align="center">
    <p><img src="http://itforone.co.kr/~unikorea2/theme/basic/img/main/quick_title.gif" /></p>
    <!--<p>quick 상담신청</p> -->
    <br>이름과 전화번호를 입력해주세요</td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20%" align="center" ><strong>이　름</strong></td>
        <td align="left">
            <input name="b_name" type="text" class="input_03" style="width:100%;height:25px" />        </td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="10" align="center"></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20%" align="center"><strong>휴대폰</strong></td>
        <td>
        <input name="b_tel1" type="text" class="input_03" style="width:22%;height:25px" onKeyUp="b_auto_next();">
         <input name="b_tel2" type="text" class="input_03" style="width:22%;height:25px" onKeyUp="b_auto_next2();">
         <input name="b_tel3" type="text" class="input_03" style="width:22%;height:25px" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><table border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>
            </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" align="center"><table width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><strong>개인정보수집동의</strong> <input type="checkbox" name="quick_checkbox" id="quick_checkbox" ></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <a onclick=""><input type="image" src="http://itforone.co.kr/~unikorea2/theme/basic/img/main/quick_btn.gif" /></a>
  </tr>
</form>
</table>
      </article>
	  <script>

	  function b_checkvalue(){

		var form=document.b_form_write;
		if(!form.b_name.value){
			alert('성함을 입력해주세요.');
			form.b_name.focus();
			return false;
		}
		if(!form.b_tel1.value){
			alert('휴대폰번호를 입력해주세요.');
			form.b_tel1.focus();
			return false;
		}
		if(!form.b_tel2.value){
			alert('휴대폰번호를 입력해주세요.');
			form.b_tel2.focus();
			return false;
		}
		if(!form.b_tel3.value){
			alert('휴대폰번호를 입력해주세요.');
			form.b_tel3.focus();
			return false;
		}


		if(!$("#quick_checkbox").is(":checked")){
			alert("개인정보수집동의 체크 해주세요.");
			return false;
		}	

		return true;

	}

		function b_auto_next(){
		var form=document.b_form_write;
		if(form.b_tel1.value.length == 3){
			form.b_tel2.focus();
		}
	}
	function b_auto_next2(){
		var form=document.b_form_write;
		if(form.b_tel2.value.length == 4){
			form.b_tel3.focus();
		}
	}

	  </script>   
    
	<div id="footer">
        <div class="foot_menu">
        	<ul class="fm">
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01">회사소개</a></li> 
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro_01">제품소개</a></li>  
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=gal_01">제작사례</a></li>  
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02">오시는 길</a></li>              
            </ul>
            <ul class="sns">
            	<li><a href="javascript:;"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_naver.png" /></a></li>
                <li><a href="javascript:;"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_insta.png" /></a></li>
                <li><a href="javascript:;"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_kakao.png" /></a></li>
            </ul>
        </div>
    	<div class="footer_in cf">
			<address>
            	<h1><?php echo $config['cf_title']; ?></h1> 
				<p>
                <span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span>
                <!--<span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?></span>
                <span><strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?></span>-->
                </p>
                <p>
                <span><strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?></span>
                <span><strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?></span>
                <span><strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?></span>
                <span><strong><?php echo $config['cf_7_subj']; ?></strong> <span class="mail"><?php echo $config['cf_7']; ?></span></span>
                </p>
                <p class="co">COPYRIGHT(c) 2020 <strong><?php echo $config['cf_title']; ?></strong> ALL RIGHTS RESERVED.</p>
			</address>
            <div class="f_cus cf">
            	<h2 class="main_tel">문의상담 
                <span><i class="fas fa-phone-alt"></i> <?php echo $config['cf_4']; ?></span>
                <span class="mail"><?php echo $config['cf_7']; ?></span>
                </h2>

            </div><!--f_cus-->
        </div><!--.footer_in-->
	</div><!--#footer--> 

    

    
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ar_top.png" alt="상단으로"></a>
	<a href="#footer" class="goFt"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ar_bt.png" alt="하단으로"></a>
</div>



<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>