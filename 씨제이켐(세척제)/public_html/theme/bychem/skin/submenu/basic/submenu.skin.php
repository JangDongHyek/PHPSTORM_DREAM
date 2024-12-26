<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>

    <div id="aside">
    	<?php /*?><div><img src="<?php echo $theme_path.'/skin/submenu/'.$skin_dir.'/m_arrow.png'; ?>" /></div><?php */?>
        <div class="dl_wrap">
            <dl>
                <dt class="tt"><p>CJ CHEM</p>
                <?php echo $title['sm_name'] ?></dt>
                <?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){
					?>
                <dd <?if($sub['sm_name'] == "블로그 (cj_chem)" || $sub['sm_name'] == "블로그 (bcsmarket)" || $sub['sm_name'] == "포스트" || $sub['sm_name'] == "다음 블로그" || $sub['sm_name'] == "티스토리" || $sub['sm_name'] == "카카오스토리"){if($i>1){?>class="sub_menu"<?}}?>><a href="<?php echo $sub['sm_link']?>" target="_<?php echo $sub['sm_target']; ?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?>><?php echo $sub['sm_name'];?></a>
                   <?php if($sub['sm_name'] == "스마트공장 지원사업"&&$sm_tid=="smart01"){ //스마트팩토리

											echo"<dl class='section hidden-sm hidden-xs'>
													<dd><a href='#section01'>스마트팩토리 개요</a></dd>
									                <dd><a href='#section02'>스마트팩토리 지원사업</a></dd>
												 </dl> "; 
										 }else if($sub['sm_name'] == "MES/POP"&&$sm_tid=="pro01"){
											echo"<dl class='section hidden-sm hidden-xs'>
													<dd><a href='#section01'>MES (제조실행 시스템)</a></dd>
									                <dd><a href='#section02'>POP (생산 시점 관리)</a></dd>
												 </dl> "; 
					 }else {
			          echo ""; 
					 }
					 ?>
                </dd>
                <?php } ?>
            </dl>
        </div>
        
        <dl class="left_cus">
			<dt>CUSTOMER</dt>
			<dd class="img"><img src="../theme/bychem/img/number.png"></dd>
			<dd class="tel">
	1644-9269
		
			
		</dd>
			
		
			
			<dd class="phone">031-364-8867<br />P. 010-7601-4341<dd>
        </dl>
		
		
				
		
			
			
			
		<ul class="left_box">
			<li class="left_li st1">
				<a href="https://open.kakao.com/o/sQfVbyG" target="_blank" data-toggle="tooltip" title="카카오문의">
					<img src="http://www.dreamforone.com/~bychem/theme/bychem/img/kakao.png" alt=" ">
				</a>
			</li>
			<li class="left_li st2"><a href="<?php echo G5_URL ?>/bbs/write.php?bo_table=request" data-toggle="tooltip" title="신청문의">
				<img src="http://www.dreamforone.com/~bychem/theme/bychem/img/mail_con.png" alt=" ">
				</a>
			</li>
			<li class="left_li st3 btn btn-primary dropdown-toggle" data-toggle="dropdown">
				<a href="#" data-toggle="tooltip" title="브로슈어">
					<img src="http://www.dreamforone.com/~bychem/theme/bychem/img/down.png" alt=" ">
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
		 </ul><!--.left_box-->
<?
if($_POST[sms_send] == "y"){
	$conn_db=mysql_connect("211.51.221.165","emma","wjsghk!@#");
	mysql_select_db("emma");
	
	
	$tran_phone1 = "010-7601-4341";//받는 사람 번호 관리자
	$tran_callback1 = "010-7601-4341";//보내는 사람 번호 
	$send_date = date("YmdHis");
	$mart_id = "bychem";
	$tran_msg1 = iconv("utf-8","euc-kr", $_POST['scontent']);
	$tran_msg1 =	$_POST['tran_callback2']." ".$tran_msg1;


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

	if($tmp = rg_str_inword("a,cb,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,http,com,포커,릴겜,급전,개.인.통.장,개인통장,방콕,꼬꼬,선불폰,막폰,URL,싸이,투데이,방문자,추적,버그,boris,현대남,현대여,aphsun.info,목카드,도박,장비,특수렌즈,마킹카드,공장목,표시목,필승,화투,포르노,뽀르노,야동,화상채팅,대박이벤트,영계하고,데이또,재미짱,승률이,테크노,(바)카라,5000만원,입출금,생방송,바@카@라,천만원,키스,대박회원급증,용돈,㈓㈘㈑,강원랜드,야동,정력제,시알리스,비아그라,바카라,바/카/라,바카현이,섹스,폰섹,카지노,㉥┝㉪┝㉣┝,8억,추천id,추/천/인,바☆카☆라,바(카)라,남근확대,무료자료,━★,viagra,비아그라,sialis,시알리스,씨알리스,동거,섹스,viagra,비아그라,sialis,동거,섹스,프릴리지,상륙,아시는분만,신개념,바다이야기,피싱걸,황금성,물뽕,게임장,20원방,100원방,200원방,황 금 성,무료증정,경마,로얄,홍콩,부업,목카드,특수렌즈,도박,토토,href,url,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,※,◀,▶",$tran_msg1)) {
		$error_msg = $tmp.'(은)는 사용할수 없는 단어입니다.';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;
	}




	$sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1')";
	mysql_query($sms_query,$conn_db);

	//전체기록남기기
	$all_query = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1',curdate())";
	mysql_query($all_query,$conn_db);
	
	echo "<script>alert('빠른시일 내에 회신드리겠습니다. 감사합니다!');</script>";
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function checkform(frm){
	
		if(frm.scontent.value==""){
			alert("\n상담내용을 입력해주세요!");
			frm.scontent.focus();
			return false;
		}	
		if(frm.tran_callback2.value==""){
			alert("\n회신번호를 입력해주세요!");
			frm.tran_callback2.focus();
			return false;
		}	
		return true;
	}
	function cal_pre(field)
	{
		var tmpStr;
		var form = eval ("document.f." + field);
		tmpStr = form.value;
		cal_byte(field, tmpStr);
	}

	//메세지창의 byte 계산
	function cal_byte(field, aquery) 
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

		var cbyte_form = eval ("document.f." + field + "_cbyte");
		var value_form = eval ("document.f." + field);
		cbyte_form.value = tcount;

		if (tcount > 77) {
			reserve = tcount - 77;
			alert("메시지 내용은 77바이트 이상은 전송하실수 없습니다.\r\n 쓰신 메시지는 "+reserve+"바이트가 초과되었습니다.\r\n 초과된 부분은 자동으로 삭제됩니다."); 
			nets_check(field, value_form.value, 77);
			return;
		}	
	}

	function nets_check(field, aquery, max)
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
			var form = eval ("document.f." + field);
			form.value = tmpStr;
			cal_byte(field, tmpStr);
		}
		
		return tmpStr;
	}

//-->
</SCRIPT>
<form name="f" method=post action="<?=$PHP_SELF?>" onSubmit="return checkform(this)">
<input type=hidden name="sms_send" value="y">
<!--sms문자-PC화면(모바일 sms는 tail.php에 있습니다)-->
         <div id="sms_box">
         	<div class="smst">문자상담문의 <i class="fas fa-comment"></i></div>
			<textarea class="sms_cont" name="scontent" placeholder="상담내용과 연락처를 남겨주세요. 빠른시일 내에 회신드리겠습니다." onKeyUp="javascript:cal_pre('scontent')"></textarea>
			<input type="text" name="tran_callback2" class="sms_input" placeholder="회신번호 입력"/>
			<INPUT  type=hidden name=scontent_cbyte>
            <input type="submit" class="sms_btn" value="전송하기">
         </div><!--#sms_box-->
</form>


         
    </div><!--#aside-->

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>