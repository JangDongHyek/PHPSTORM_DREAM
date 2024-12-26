<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>


<style type="text/css">
<!--

#divpop {
	position:absolute;
	left:50%;
	margin-left:-600px;
	top:100px;
	width:400px;
	height:auto;
	z-index:900;
	background-color:#1b1514;
	border:0px solid #000000;
	visibility: visible;
	box-shadow:0 0 3px #333
}

#divpop2 {
    position:absolute;
	visibility: hidden;
}


@media screen and (max-width:767px) {

#divpop2 {
	position:absolute;
	left:50%;
	transform:translateX(-50%);
    top:50px;
	width:340px;

	z-index:2000;
	background-color:#1b1514;
	visibility: visible;
}

#divpop {display:none;}
}


table tr td {padding:0; margin:0;}

#pop_link {color: #fff; font-size:11px}
#pop_link a{color: #fff;}
#pop_link a:hover {color:#FF0000;}


-->

</style>



<SCRIPT language=JavaScript>
<!--

<!--

//시간설정
function startTime(){
var time= new Date();
hours= time.getHours();
mins= time.getMinutes();
secs= time.getSeconds();
closeTime=hours*3600+mins*60+secs;
closeTime+=10; //시간설정 (초)
Timer();
}

//타이머
function Timer(){
var time= new Date();
hours= time.getHours();
mins= time.getMinutes();
secs= time.getSeconds();
curTime=hours*3600+mins*60+secs
if (curTime>=closeTime){
document.all['divpop'].style.visibility = "hidden";
}
else{
window.setTimeout("Timer()",7200)}
}

//쿠키설정
function setCookie( name, value, expiredays ) { 
var todayDate = new Date(); 
todayDate.setDate( todayDate.getDate() + expiredays ); 
document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
} 

//창닫기(레이어)
function closeWin() { 
if ( document.notice_form.chkbox.checked ){ 
setCookie( "maindiv", "done" , 2 ); 
} 
document.all['divpop'].style.visibility = "hidden";
}
function sitelink(url_link) 
{ 
window.opener.location=url_link; 
} 


//창닫기(레이어)
function closeWin2() { 
if ( document.notice_form2.chkbox2.checked ){ 
setCookie( "maindiv2", "done" , 2 ); 
} 
document.all['divpop2'].style.visibility = "hidden";
}
function sitelink(url_link) 
{ 
window.opener.location=url_link; 
} 


<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

-->
//-->
</SCRIPT>



<SCRIPT LANGUAGE="JavaScript">
<!--
function showLayer() {
document.all.divpopS.style.visibility = "visible";
}

function hideLayer() {
document.all.divpop.style.visibility = "hidden";
}
//-->
</SCRIPT>


<!--PC 레이어 팝업-->
<div id="divpop"  class="layer_popup1">
<table border="0" cellspacing="0" cellpadding="0">
      <tr>
         <td valign="top" class="handler"><iframe src="http://www.cjchem.co.kr/pop/index.htm" frameborder="0" marginheight="0" marginwidth="0" width="400" height="504" scrolling="no"></iframe></td>
                  </tr>
                  <tr>
                    <td height="30" bgcolor="#3F3F3F"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <form name="notice_form" id="notice_form">
                        <tr>
                          <td height="30" align="center">
                              <input type="checkbox" value="checkbox" name="chkbox" />
                              <span id="pop_link">24시간 동안 다시 열람하지 않습니다.&nbsp;&nbsp;<a href="javascript:closeWin();">[ 닫기 ]</a></span></td>
                        </tr>
                      </form>
                    </table>
                    </td>
                  </tr>
                </table>

</div>

<SCRIPT language=Javascript>
<!--
cookiedata = document.cookie; 
if ( cookiedata.indexOf("maindiv=done") < 0 ){ 
//document.all['divpop'].style.visibility = "visible";
} 
else {
document.all['divpop'].style.visibility = "hidden"; 
}
//-->
</SCRIPT>

<!--PC 레이어 끝-->



<!--모바일 레이어-->
<div id="divpop2"  class="layer_popup2">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#1b1514">
                  <tr>
                    <td valign="top" class="handler"><iframe src="http://www.cjchem.co.kr/pop/index.htm" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="433" scrolling="no"></iframe></td>
                  </tr>
                  <tr>
                    <td height="30" bgcolor="#3F3F3F"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <form name="notice_form2" id="notice_form2">
                        <tr>
                          <td height="30"><div align="center">
                              <input type="checkbox" value="checkbox" name="chkbox2" />
                             <span id="pop_link">오늘 하루 열지 않습니다.&nbsp;&nbsp;<a href="javascript:closeWin2();">[ X CLOSE ]</a></span></div></td>
                        </tr>
                      </form>
                    </table>
                    </td>
                  </tr>
                </table>
</div>
<SCRIPT language=Javascript>
<!--
cookiedata = document.cookie; 
if ( cookiedata.indexOf("maindiv2=done") < 0 ){ 
//document.all['divpop'].style.visibility = "visible";
} 
else {
document.all['divpop2'].style.visibility = "hidden"; 
}
//-->
</SCRIPT>
<!--모바일 레이어 끝-->








<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/jquery.pwstabs.css">
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css">
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/owl.carousel.min./kor/theme/zenfixd/img/sub/icon_sitemap.pngss"><!--//제품 슬라이드 css-->
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/owl.theme.default.min.css"><!--//제품 슬라이드 css-->
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.pwstabs.min.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/owl.carousel.js"></script><!--//제품 슬라이드 js-->


    <div id="rolling_tab" class="swiper-container wow fadeInDown" data-wow-delay="0.2s">
        <ul class="swiper-wrapper">
            <li class="swiper-slide slide_li1">
				<div class="slide_txt">
					<div class="big_txt">BCS series distribution center <span>CJCHEM</span></div>
					<div class="mid_txt">씨제이켐은 친환경성 산업용 세척제 - BCS 공식 판매점입니다.</span></div>
	 			</div>
            </li>
            <li class="swiper-slide slide_li2">
				<div class="slide_txt">
					<div class="big_txt">BCS series distribution center <span>CJCHEM</span></div>
					<div class="mid_txt">TCE, MC, NPBr, 1,2-DCP, HCFC-141b 등을 대체할 수 있는 친환경성 산업용 세척제 BCS 판매점</span></div>
	 			</div>
            </li>
        </ul>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div><!--rolling_tab-->

    <!--//m_content02--> 
    <div id="m_content01">
    	<div id="m_cont">
			<div class="mpro">
               <ul class="clearfix"><!--4줄까지나오게-->
                  <li class="col-md-2 col-sm-2 col-xs-4 wow fadeInUp" data-wow-delay="0.2s">
                      <p class="t"><span>BCS-</span>NEW1000</p>
                      <p class="c">BCS 제품중 가장 범용적인 제품으로 인기 있는 친환경성 세척제입..</p>
					   <p class="more"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=product05">MORE+</a></p>
                   </li>
                   <li class="col-md-2 col-sm-2 col-xs-4 wow fadeInUp" data-wow-delay="0.3s">
                      <p class="t"><span>BCS-</span>NEW1000(N)</p>
                      <p class="c"> 금형 세척이 가능하며 방청유, 타발유, 프레스유 등 각종 가공유..</p>
					   <p class="more"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=product05_3">MORE+</a></p>
                   </li>				   
                   <li class="col-md-2 col-sm-2 col-xs-4 wow fadeInUp" data-wow-delay="0.4s">
                      <p class="t"><span>BCS-</span>3000</p>
                      <p class="c">BCS제품 중 증발이 가장 빠르며 플러스 및 PCB 세척에 탁월..</p>
					   <p class="more"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=product02">MORE+</a></p>
                   </li>
                   <li class="col-md-2 col-sm-2 col-xs-4 wow fadeInUp" data-wow-delay="0.5s">
                      <p class="t"><span>BCS-</span>5000</p>
                      <p class="c">인체에 유해하지 않은 세척제로 BCS시리지 중 프리미엄 친환경성...</p>
					   <p class="more"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=product03">MORE+</a></p>
                   </li>
                   <li class="col-md-2 col-sm-2 col-xs-4 wow fadeInUp" data-wow-delay="0.5s">
                      <p class="t"><span>BCS-</span>SS</p>
                      <p class="c">독성물질이 포함되어 있지 않으며 속건성으로 휴대폰부품 및..</p>
					   <p class="more"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=product07">MORE+</a></p>
                   </li>
                   <li class="col-md-2 col-sm-2 col-xs-4 wow fadeInUp" data-wow-delay="0.5s">
                      <p class="t"><span>BYSOL-</span>MXY</p>
                      <p class="c">도료 희석용 및 세척용으로 주로 인쇄, 고무, 가죽 산업에서..</p>
					   <p class="more"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=pro_bysol">MORE+</a></p>
                   </li>
               </ul>
            </div><!--//.mpro-->
            
			
            <div class="text-center t_margin50 b_margin40 t_padding15 b_padding15">
                <p class="t1 wow fadeInRight" data-wow-delay="0.1s" style="word-break: keep-all;">고객 감동을 위해 신뢰를 우선으로 삼고, 고객의 요구를 수용하고자</p>
                <p class="t16 wow fadeInLeft" data-wow-delay="0.2s" style="word-break: keep-all;">항상 고객의 입장에서 고객만족 경영을 실천하기 위해 끊임없이 노력하고 있습니다. </p>
            </div>
			
			<div class="big_data">
				<h1 class="data_tt">자료실<h1>
				<?php echo latest("theme/basic", "data", 6, 50); ?>
			</div>
			
            <dl class="clearfix">
                <dd class="col-md-7 col-sm-7 col-xs-12 wow fadeInDown small_map" data-wow-delay="0.1s">
                   <div>
<div id="daumRoughmapContainer1647312182525" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100%"></div>
<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

<!-- 3. 실행 스크립트 -->
<script charset="UTF-8">
	new daum.roughmap.Lander({
		"timestamp" : "1647312182525",
		"key" : "29gj7",
		"mapWidth" : "100%",
		"mapHeight" : "292"
	}).render();
</script>
                </dd>
   <?
if($_POST[sms_send] == "y3"){

	$conn_db=mysql_connect("211.51.221.165","emma","wjsghk!@#");
	mysql_select_db("emma");
	
	
	$tran_phone3 = "010-7601-4341";//받는 사람 번호 관리자
	$tran_callback3 = "010-7601-4341";//보내는 사람 번호 
	$send_date = date("YmdHis");
	$mart_id = "bychem";
	$tran_msg3 = iconv("utf-8","euc-kr", $_POST['scontent3']);
	$tran_msg3 =	$_POST['tran_callback4']." ".$tran_msg3;


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

	if($tmp = rg_str_inword("a,cb,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,http,com,포커,릴겜,급전,개.인.통.장,개인통장,방콕,꼬꼬,선불폰,막폰,URL,싸이,투데이,방문자,추적,버그,boris,현대남,현대여,aphsun.info,목카드,도박,장비,특수렌즈,마킹카드,공장목,표시목,필승,화투,포르노,뽀르노,야동,화상채팅,대박이벤트,영계하고,데이또,재미짱,승률이,테크노,(바)카라,5000만원,입출금,생방송,바@카@라,천만원,키스,대박회원급증,용돈,㈓㈘㈑,강원랜드,야동,정력제,시알리스,비아그라,바카라,바/카/라,바카현이,섹스,폰섹,카지노,㉥┝㉪┝㉣┝,8억,추천id,추/천/인,바☆카☆라,바(카)라,남근확대,무료자료,━★,viagra,비아그라,sialis,시알리스,씨알리스,동거,섹스,viagra,비아그라,sialis,동거,섹스,프릴리지,상륙,아시는분만,신개념,바다이야기,피싱걸,황금성,물뽕,게임장,20원방,100원방,200원방,황 금 성,무료증정,경마,로얄,홍콩,부업,목카드,특수렌즈,도박,토토,href,url,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,※,◀,▶",$tran_msg3)) {
		$error_msg = $tmp.'(은)는 사용할수 없는 단어입니다.';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;
	}



	$sms_query3 = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone3','$tran_callback3','1','$send_date','$tran_msg3')";
	mysql_query($sms_query3,$conn_db);

	//전체기록남기기
	$all_query3 = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone3','$tran_callback3','1','$send_date','$tran_msg3',curdate())";
	mysql_query($all_query3,$conn_db);

	echo "<script>alert('빠른시일 내에 회신드리겠습니다. 감사합니다!');</script>";
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function checkform3(frm3){
	
		if(frm3.scontent3.value==""){
			alert("\n상담내용을 입력해주세요!");
			frm3.scontent3.focus();
			return false;
		}	
		if(frm3.tran_callback4.value==""){
			alert("\n회신번호를 입력해주세요!");
			frm3.tran_callback4.focus();
			return false;
		}	
		return true;
	}
	function cal_pre3(field)
	{
		var tmpStr;
		var form = eval ("document.f3." + field);
		tmpStr = form.value;
		cal_byte3(field, tmpStr);
	}

	//메세지창의 byte 계산
	function cal_byte3(field, aquery) 
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

		var cbyte_form = eval ("document.f3." + field + "_cbyte");
		var value_form = eval ("document.f3." + field);
		cbyte_form.value = tcount;

		if (tcount > 77) {
			reserve = tcount - 77;
			alert("메시지 내용은 77바이트 이상은 전송하실수 없습니다.\r\n 쓰신 메시지는 "+reserve+"바이트가 초과되었습니다.\r\n 초과된 부분은 자동으로 삭제됩니다."); 
			nets_check3(field, value_form.value, 77);
			return;
		}	
	}

	function nets_check3(field, aquery, max)
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
			var form = eval ("document.f3." + field);
			form.value = tmpStr;
			cal_byte3(field, tmpStr);
		}
		
		return tmpStr;
	}



//-->
</SCRIPT>
<form name="f3" method=post action="<?=$PHP_SELF?>" onSubmit="return checkform3(this)">
<input type=hidden name="sms_send" value="y3">
<input type=hidden name="co_id" value="<?=$co_id?>">
             
                <!--문자상담-->
                <dd class="col-md-3 col-sm-3 hidden-xs wow fadeInDown" data-wow-delay="0.2s">
                   <div id="sms_box" class="main_sms">
                        <div class="smst">문자상담문의 <i class="fas fa-comment"></i></div>
							<textarea class="sms_cont" name="scontent3" placeholder="상담내용과 연락처를 남겨주세요. 빠른시일 내에 회신드리겠습니다." onKeyUp="javascript:cal_pre3('scontent3')"></textarea>
							<input type="text" name="tran_callback4" class="sms_input" placeholder="회신번호 입력"/>
							<INPUT  type=hidden name=scontent3_cbyte>
							<input type="submit" class="sms_btn" value="전송하기">
                     </div><!--#sms_box-->
					 </form>
                </dd>
                <dd class="visible-xs  col-xs-9 wow fadeInDown" data-wow-delay="0.2s">
                   <ul class="map_info">
					   <li>상호. <span>(주)씨제이켐</span></li>
					   <li>대표. <span>박상훈</span></li>
					   <li>주소. <span>경기도 안산시 단원구 만해로 205,<br>
						   <span class="ad_mg">타원타크라3차지식산업센터 A동<br />
						   <span class="ad_mg">619호(성곡동)</span>
					    </li>
					   <li>대표번호. <span>1644-9269</span></li>
					   <li>전화. <span>031-364-8867</span></li>
					   <li>팩스. <span>0303-3444-8867</span></li>
					   <li>메일. <span><a href="mailto:cj_chem@naver.com">cj_chem@naver.com</a></span></li>
                   </ul> 
                </dd>
				
			<script>
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip(); 
			});
			</script>
				<dd class="col-md-2 col-sm-2 col-xs-3  wow fadeInDown" data-wow-delay="0.2s">
					<div class="customer">
                          <dl class="bt_cus">
							 <dt>CUSTOMER</dt>
							 <dd class="cs">CUSTOMER</dd>
							 <dd class="img"><img src="/theme/bychem/img/number.png"></dd>
							 <dd class="tel">1644-9269 </dd>
							 
							 <dd class="phone">031-364-8867<br />
P. 010-7601-4341<dd>
					     </dl>
						<ul class="bt_box ">
							<li class="left_li st1">
								<a href="https://open.kakao.com/o/sQfVbyG" target="_blank" data-toggle="tooltip" title="카카오문의">
									<img src="/theme/bychem/img/kakao.png" alt=" ">
								</a>
							</li>
							<li class="left_li st2">
								<a href="<?php echo G5_URL ?>/bbs/write.php?bo_table=request" data-toggle="tooltip" title="신청문의">
									<img src="/theme/bychem/img/mail_con.png" alt=" ">
								</a>
							</li>
							<li class="left_li st3 btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
								<a href="#" data-toggle="tooltip" title="브로슈어">
									<img src="/theme/bychem/img/down.png" alt=" ">
								</a>
							</li>
							  <ul class="dropdown-menu">
									<li><a href="/theme/bychem/file/BCS-NEW1000.pdf" download target="_blank">BCS-NEW-1000</a></li>
									<li class="divider"></li>
									<li><a href="/theme/bychem/file/BCS-NEW1000(D).pdf" download target="_blank">BCS-NEW-1000(D)</a></li>
									<li class="divider"></li>
									<li><a href="/theme/bychem/file/BCS-NEW1000(N).pdf" download target="_blank">BCS-NEW-1000(N)</a></li>
									<li class="divider"></li>
									<li><a href="/theme/bychem/file/BCS-3000.pdf" download target="_blank">BCS-3000</a></li>
							  	    <li class="divider"></li>
									<li><a href="/theme/bychem/file/BCS-5000.pdf" download target="_blank">BCS-5000</a></li>
								    <li class="divider"></li>
									<li><a href="/theme/bychem/file/BCS-UT3.pdf" download target="_blank">BCS-UT3</a></li>
									<li class="divider"></li>
									<li><a href="/theme/bychem/file/BYSOL-MXY.pdf" download target="_blank">BYSOL-MXY</a></li>
									<li class="divider"></li>
									<li><a href="/theme/bychem/file/CJC-6000.pdf" download target="_blank">CJC-6000</a></li>
		
							 </ul>
						</ul>
					</div>
                </dd>
            </dl>
        </div><!--#m_cont-->
    </div>
    <!--//m_content01--> 

 
<!-- Swiper JS -->
    <script src="<?php echo G5_THEME_JS_URL ?>/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('#rolling_tab', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
		speed: 1200,
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: 5000,
		//mousewheelControl: true,
        autoplayDisableOnInteraction: false,
		loop:true,
    });
    var swiper = new Swiper('#rolling_mtab', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
		speed: 1200,
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: false,
		loop:true,
    });
    </script>


<?php
include_once(G5_PATH.'/tail.php');
?>