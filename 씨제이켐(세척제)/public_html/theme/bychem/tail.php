<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>

            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
    </div>
</div>

<!-- } 콘텐츠 끝 -->

<hr>

<?
if($_POST[sms_send] == "y2"){
	$conn_db=mysql_connect("211.51.221.165","emma","wjsghk!@#");
	mysql_select_db("emma");
	
	
	$tran_phone2 = "010-7601-4341";//받는 사람 번호 관리자
	$tran_callback2 = "010-7601-4341";//보내는 사람 번호 
	$send_date = date("YmdHis");
	$mart_id = "bychem";
	$tran_msg2 = iconv("utf-8","euc-kr", $_POST['scontent2']);
	$tran_msg2 =	$_POST['tran_callback3']." ".$tran_msg2;


	// $str 안에 $list 가 있는지 검사
	function rg_str_inword($list,$str) {
    $_result = '';
    $list = explode(",", trim($list));
		while (list ($key, $val) = each ($list)) {
			$val = trim($val);
			if ($val=='') continue;
			$val = str_replace('/','\/',$val);
			$val = str_replace('(','\(',$val);
			$val = str_replace(')','\)',$val);
			$reg_str = "/({$val})/i";
			if (preg_match($reg_str, $str)) {
				$_result = $val;
				break;
			}
		}
		unset($key);
		unset($val);
		unset($list);
		
    return $_result;
	}

	if($tmp = rg_str_inword("a,cb,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,http,com,포커,릴겜,급전,개.인.통.장,개인통장,방콕,꼬꼬,선불폰,막폰,URL,싸이,투데이,방문자,추적,버그,boris,현대남,현대여,aphsun.info,목카드,도박,장비,특수렌즈,마킹카드,공장목,표시목,필승,화투,포르노,뽀르노,야동,화상채팅,대박이벤트,영계하고,데이또,재미짱,승률이,테크노,(바)카라,5000만원,입출금,생방송,바@카@라,천만원,키스,대박회원급증,용돈,㈓㈘㈑,강원랜드,야동,정력제,시알리스,비아그라,바카라,바/카/라,바카현이,섹스,폰섹,카지노,㉥┝㉪┝㉣┝,8억,추천id,추/천/인,바☆카☆라,바(카)라,남근확대,무료자료,━★,viagra,비아그라,sialis,시알리스,씨알리스,동거,섹스,viagra,비아그라,sialis,동거,섹스,프릴리지,상륙,아시는분만,신개념,바다이야기,피싱걸,황금성,물뽕,게임장,20원방,100원방,200원방,황 금 성,무료증정,경마,로얄,홍콩,부업,목카드,특수렌즈,도박,토토,href,url,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,※,◀,▶",$tran_msg2)) {
		$error_msg = $tmp.'(은)는 사용할수 없는 단어입니다.';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;
	}



	$sms_query2 = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone2','$tran_callback2','1','$send_date','$tran_msg2')";
	mysql_query($sms_query2,$conn_db);

	//전체기록남기기
	$all_query2 = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone2','$tran_callback2','1','$send_date','$tran_msg2',curdate())";
	mysql_query($all_query2,$conn_db);
	
	echo "<script>alert('빠른시일 내에 회신드리겠습니다. 감사합니다!');</script>";
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function checkform2(frm2){
	
		if(frm2.scontent2.value==""){
			alert("\n상담내용을 입력해주세요!");
			frm2.scontent2.focus();
			return false;
		}	
		if(frm2.tran_callback3.value==""){
			alert("\n회신번호를 입력해주세요!");
			frm2.tran_callback3.focus();
			return false;
		}	
		return true;
	}


	function cal_pre2(field)
	{
		var tmpStr;
		var form = eval ("document.f2." + field);
		tmpStr = form.value;
		cal_byte2(field, tmpStr);
	}

	//메세지창의 byte 계산
	function cal_byte2(field, aquery) 
	{
		var tmpStr;
		var temp=0;
		var onechar;
		var tcount;
		tcount = 0;
		 
		tmpStr = new String(aquery);
		temp = tmpStr.length;

		for (k=0;k<temp;k++)
		{
			onechar = tmpStr.charAt(k);

			if (escape(onechar).length > 4) {
				tcount += 2;
			}
			else if (onechar!='\r') {
				tcount++;
			}
		}

		var cbyte_form = eval ("document.f2." + field + "_cbyte");
		var value_form = eval ("document.f2." + field);
		cbyte_form.value = tcount;

		if (tcount > 77) {
			reserve = tcount - 77;
			alert("메시지 내용은 77바이트 이상은 전송하실수 없습니다.\r\n 쓰신 메시지는 "+reserve+"바이트가 초과되었습니다.\r\n 초과된 부분은 자동으로 삭제됩니다."); 
			nets_check2(field, value_form.value, 77);
			return;
		}	
	}

	function nets_check2(field, aquery, max)
	{
		var tmpStr;
		var temp=0;
		var onechar;
		var tcount;
		tcount = 0;
		 
		tmpStr = new String(aquery);
		temp = tmpStr.length;

		for(k=0;k<temp;k++)
		{
			onechar = tmpStr.charAt(k);
			
			if(escape(onechar).length > 4) {
				tcount += 2;
			}
			else if(onechar!='\r') {
				tcount++;
			}
			if(tcount>max) {
				tmpStr = tmpStr.substring(0,k);			
				break;
			}
		}
		
		if (max == 77) {
			var form = eval ("document.f2." + field);
			form.value = tmpStr;
			cal_byte2(field, tmpStr);
		}
		
		return tmpStr;
	}



//-->
</SCRIPT>
<form name="f2" method=post action="<?=$PHP_SELF?>" onSubmit="return checkform2(this)">
<input type=hidden name="sms_send" value="y2">
<input type=hidden name="co_id" value="<?=$co_id?>">

<!--sms문자-mobile(PC버전 sms는 submenu.skin.php에 있습니다)-->
         <div id="sms_box" class="visible-xs">
         	<div class="smst">문자상담문의 <i class="fas fa-comment"></i></div>
			<textarea class="sms_cont" name="scontent2" placeholder="상담내용과 연락처를 남겨주세요. 빠른시일 내에 회신드리겠습니다." onKeyUp="javascript:cal_pre2('scontent2')"></textarea>
			<input type="text" name="tran_callback3" class="sms_input" placeholder="회신번호 입력"/>
			<INPUT  type=hidden name=scontent2_cbyte>
            <input type="submit" class="sms_btn" value="전송하기">
         </div><!--#sms_box-->
</form>




<!-- 하단 -->
<div id="ft" class="clearfix wow fadeInUp" data-wow-delay="0.2s">
  <div class="ft_area">
    <div class="flogo col-md-1"><img src="<?php echo G5_THEME_IMG_URL ?>/f_logo.png" /></div>
	<div id="ft_copy" class="col-md-11">
        <!--상호-->
        <p class="ct  hidden-xs"><strong><?php echo $config['cf_title']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;
        <!--상호-->
        <!--기본정보-->
        <strong><?php echo $config['cf_1_subj']; ?></strong><?php echo $config['cf_1']; ?>&nbsp;&nbsp;&nbsp;
        <strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?>&nbsp;&nbsp;&nbsp;
		<strong><?php echo $config['cf_8_subj']; ?></strong> <?php echo $config['cf_8']; ?><br />
        <strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?>&nbsp;&nbsp;
        <strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?>&nbsp;&nbsp;
        <strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?>&nbsp;&nbsp;
        <strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?><br />
		<strong><?php echo $config['cf_7_subj']; ?></strong> <?php echo $config['cf_7']; ?>
	  <div id="foot_menu">
			  <div class="foot_menu_in">
				   <div class="copyright">COPYRIGHT(C) 2018 CJCHEM CO.,LTD. ALL RIGHTS RESERVED&nbsp;&nbsp;&nbsp;
						<?php if ($is_admin) {  ?>
						<a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock fa-lg" style="color: #4f5963"></i></a>
						<?php } else {  ?>
						<a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock fa-lg" style="color: #4f5963"></i></a>
						<?php }  ?>
				  </div>
				  <div class="copyright_mobile">COPYRIGHT(C) 2018 CJCHEM CO.,LTD. ALL RIGHTS RESERVED&nbsp;&nbsp;&nbsp;
						<?php if ($is_admin) {  ?>
						<a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock fa-2x" style="color: #4f5963"></i></a>
						<?php } else {  ?>
						<a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock fa-2x" style="color: #4f5963"></i></a>
						<?php }  ?>
				  </div>
			  </div>
        <!--기본정보-->
    </div>
   

  </div>
  </div>
</div>
<!-- //하단 -->   
  

<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#ft" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
</div>


<!--//애니메이션 js-->
<script src="<?php echo G5_THEME_JS_URL ?>/wow.min.js"></script>
<script>
	
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});

/* IE8 이하 브라우저는 애니메이션 스크립트 실행 막아야함 */
var IE = -1;
if (navigator.appName == 'Microsoft Internet Explorer') {
    var ua = navigator.userAgent;
    var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null) {
        IE = parseFloat(RegExp.$1);
    }
}
if(IE > 9 || IE == -1) new WOW().init();
</script>
<!--//애니메이션 js-->


<script type="text/javascript">
	(function($) {
	  $.fn.semisticky = function(options) {
		return this.each(function() {
		  new SemiSticky($(this), options);
		});
	  };
	}(jQuery));

	var SemiSticky = function(element, options) {
	  var _this = this;
	  
	  options = $.extend({
		offsetLimit: element.outerHeight(),
		scrollThreshold: 50,
		onScroll: function() {}
	  }, options);
	  
	  this.element = element;
	  this.state = 'fixed';
	  this.currentOffsetAmount = 0;
	  
	  this.init = function() {
		var oldScrollTop = $(document).scrollTop();
		var thresholdCounter = 0;
		
		$(window).on('scroll.semisticky', function() {
		  var newScrollTop = $(document).scrollTop();
		  var delta = oldScrollTop - newScrollTop;
		  thresholdCounter = Math.min(Math.max(thresholdCounter + delta, -options.scrollThreshold), options.scrollThreshold);
		  var newOffset;

		  if (Math.abs(thresholdCounter) >= options.scrollThreshold || _this.state == 'scrolling') {
			if (delta < 0 && _this.state !== 'hidden') {
			  
			  if (_this.currentOffsetAmount > -options.offsetLimit) {
				_this.currentOffsetAmount = Math.max(_this.currentOffsetAmount + delta, -options.offsetLimit);
				_this.element.css('top', _this.currentOffsetAmount);
				_this.state = 'scrolling';
			  } else {
				_this.state = 'hidden';
				thresholdCounter = 0;
			  }
			  
			} else if (delta > 0 && _this.state !== 'fixed') {
			  
			  if (_this.currentOffsetAmount < 0) {
				_this.currentOffsetAmount = Math.min(_this.currentOffsetAmount + delta, 0);
				_this.element.css('top', _this.currentOffsetAmount);
				_this.state = 'scrolling';
			  } else {
				_this.state = 'fixed';
				thresholdCounter = 0;
			  }
			  
			}
		  }
		  
		  options.onScroll.call(_this, delta);
		  
		  oldScrollTop = newScrollTop;
		});
	  };
	  
	  this.die = function() {
		$(window).off('scroll.semisticky');
	  };
	  
	  this.init();
	};
	
	</script>
    
    <script>
      $('#hd').semisticky({
        offsetLimit: $('#topm').outerHeight(),
      })
    </script>


<?php
include_once(G5_PATH."/tail.sub.php");
?>

<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
	if (!wcs_add) var wcs_add={};
		wcs_add["wa"] = "s_eb12e45ce07";
	if (!_nasa) var _nasa={};
		wcs.inflow("cjchem.co.kr");
	wcs_do(_nasa); 
</script> 