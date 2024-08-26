<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../connect_login.php";
?>
<?
include( './include/getmartinfo.php' );

global $mart_id;
global $MartDesignTable;
global $MartBgColorTable;
global $MartInfoTable;
global $MartMngInfoTable;
global $MyDesignTable;
global $MartIntroTable;
global $CategoryTable;
global $PollTable;
global $BannerTable;
//global $MetaTable;
global $Co_img_UP;
global $Co_img_DOWN;
global $Design2Table;
global $Design2_Main2Table;
global $Design2_Temp2Table;
global $Design2_Temp3Table;
global $Design2_Temp4Table;
global $Design2_Temp5Table;
global $Design2_BottomTable;
global $ContentTable;
global $GiveNTakeTable;
global $Gnt_Category_UseTable;
//global $Gnt_Category_NameTable;
//global $Gnt_CategoryTable;
global $NoticeTable;
//global $Partner_ConfTable;
global $Gift_ItemTable;
global $Domain_forwardTable;
global $ItemTable;
global $Z_PriceTable;
global $Union_ListTable;
//global $Title_ImageTable;
global $Gnt_ItemTable;
//SMS global $Sms_ConfigTable;

if(strstr($icon_module,"icon12")!=false) include('./include/head_template6.inc');
else include('./include/head_alltemplate.inc');
?>
<script>
function checkform(f){
	if(f.username.value==""){
		alert("아이디를 입력하세요.");
		f.username.focus();
		return false;
	}
	if(f.password.value==""){
		alert("비밀번호를 입력하세요.");
		f.password.focus();
		return false;
	}
	return true;
}
/*function checkform1(f){
	if(f.passport1.value==""){
		alert("주민번호 앞자리를 입력하세요.");
		f.passport1.focus();
		return false;
	}
	if(f.passport2.value==""){
		alert("주민번호 뒷자리를 입력하세요.");
		f.passport2.focus();
		return false;
	}
	return true;
}
*/
function checkform1(f){
	if(f.name_query.value==""){
		alert("주문자 성명을 입력하세요.");
		f.name_query.focus();
		return false;
	}
	if(f.order_num_query.value==""){
		alert("주문번호를 입력하세요.");
		f.order_num_query.focus();
		return false;
	}
	return true;
}
function check(){
    var str = document.f.passport1.value.length;
    if(str == 6) {
       document.f.passport2.focus();
    }

} 
	
function check1(){
    var str = document.f.passport2.value.length;
    if(str == 7) {
       document.f.submit_button.focus();
       
	}   	
}
function opensub1(t,w,h)
{	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=no,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

}  
</script>
<?
if(strstr($icon_module,"icon7")!=false) include( './include/topmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( './include/topmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( './include/topmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( './include/topmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( './include/topmenu_template5.inc' );
if(strstr($icon_module,"icon12")!=false) include( './include/topmenu_template6.inc' );

if(strstr($icon_module,"icon7")!=false) include( './include/leftmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( './include/leftmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( './include/leftmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( './include/leftmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( './include/leftmenu_template5.inc' );
if(strstr($icon_module,"icon12")!=false) {
?>
<!--검색부분-->
<table width="990" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
  <form name=search onsubmit='return frm_search(this)' action='./product/search.php'>
	<input type=hidden name='search_type' value='item'>
	<input type=hidden name='mart_id' value='<?echo $mart_id?>'>
	<tr>
    <td width="30" height="30">&nbsp;</td>
    <td width="500" background="./images/template6/image/top/search_bg.gif" class="text_left"><img src="./images/template6/image/nevigation_icon.gif" width="17" height="14" align="absmiddle">
    홈 &gt; 로그인
		</td>
    <td width="460" align="right" background="./images/template6/image/top/search_bg.gif" class="text_right"><input name="itemname" type="text" class="input_search">
        <a href='javascript:document.search.submit()'><img src="./images/template6/image/top/bu_search.gif" width="56" height="22" border="0" align="absmiddle"></a></td>
  </tr>
  </form>
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
</table>
<!--검색부분끝-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30">&nbsp;</td>
    <td width="960">
   <!--타이들이미지 시작-->
   <table width="960" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td background="./images/template6/image/product/title_bg.gif"><img src="./images/template6/image/product/title_1.gif" width="130" height="40"><img src="./images/template6/image/product/title_type.gif" width="180" height="40"></td>
     </tr>
  </table>
  <!--타이들이미지  끝-->
  <table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
<?		
		include( './include/leftmenu_template6.inc' );
	}
	?>
	<td width="609" valign="top" bgcolor='#ffffff'>
    	<div align="center"><center>
    	<table border="0" width="500">
      	<tr>
        	<td width="100%" height="15"></td>
      	</tr>
      	<tr>
        	<td width="100%">
        	<?
        	if($ti_login1_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_login1_img")){
        		echo "	
        	<img src='$Co_img_DOWN$mart_id/design2/$ti_login1_img' WIDTH='170' HEIGHT='27'>
        		";
        	}
        	else{
        		echo "
        	<img src='/market/images/login-title.gif' WIDTH='170' HEIGHT='27'>
        		";
        	}
        	?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%">
        		<?
        	if($ti_line_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_line_img")){
        		echo "	
        	<img src='$Co_img_DOWN$mart_id/design2/$ti_line_img' WIDTH='571' HEIGHT='12'>
        		";
        	}
        	else{
        		echo "
        	<img src='./images/line.gif' WIDTH='571' HEIGHT='12'>
        		";
        	}
        	?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" height="10"></td>
      	</tr>
      	<tr>
        	<td width="100%" height="10"><br>
        		<br>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%">
        		<div align="center"><center>
        		<table cellspacing="1" background="/market/images/dot2.gif" width="75%" border="0">
          		 <form name='f' method=post action='login_process.php?url=<?=$url?>&mart_id=<?=$mart_id?>' onsubmit='return checkform(this)'>
          		 <tr>
            		<td bgcolor="#FFFFFF" valign="top">
            			<p align="center">
            			<?
				        	if($ti_login2_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_login2_img")){
				        		echo "	
				        	<img src='$Co_img_DOWN$mart_id/design2/$ti_login2_img' WIDTH='366' HEIGHT='25'>
				        		";
				        	}
				        	else{
				        		echo "
				        	<img src='/market/images/login1.gif' WIDTH='366' HEIGHT='25'>
				        		";
				        	}
				        	?>
				        	<br>
            			<br>
            			<?
				        	if($ti_login4_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_login4_img")){
				        		echo "	
				        	<img src='$Co_img_DOWN$mart_id/design2/$ti_login4_img' WIDTH='7' HEIGHT='20'>
				        		";
				        	}
				        	else{
				        		echo "
				        	<img src='/market/images/blank2.gif' align='absmiddle' WIDTH='7' HEIGHT='20'>
				        		";
				        	}
				        	?>
				        	<span class="bb">아이디<strong>&nbsp; </strong></span>
            			<input class="bb" name="username" value="" size="7" style="height: 18; width: 93; border: 1px solid #7B7D7B">
            			<strong><span class="zz"> </span>
            			<span class="bb">&nbsp; </span></strong>
            			<?
				        	if($ti_login4_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_login4_img")){
				        		echo "	
				        	<img src='$Co_img_DOWN$mart_id/design2/$ti_login4_img' WIDTH='7' HEIGHT='20'>
				        		";
				        	}
				        	else{
				        		echo "
				        	<img src='/market/images/blank2.gif' align='absmiddle' WIDTH='7' HEIGHT='20'>
				        		";
				        	}
				        	?>
				        	<span class="bb">비밀번호<strong>&nbsp; </strong></span>
            			<input class="bb" type='password' name='password' size="7" style="height: 18; width: 93; border: 1px solid #7B7D7B">
            			<strong><span class="zz"> &nbsp; 
            			<input class="bb" style="background-color: white; color: #7B7D7B; height: 18px; border: 1px solid #7B7D7B" type="submit" value=" go "> 
            			<br><br>
            			</span></strong>
            		</td>
          		</tr>
        		</form>

				</table>
        		</center></div>
        		<div align="center"><center>
        		<table cellspacing="1" width="75%" border="0">
          		<tr>
            		<td bgcolor="#FFFFFF" valign="top"><p align="center"><br>
            			<br>
            			<span class="zz"><strong>
<?
//if(strstr($this->url(),'order_sheet.php') != false){
?>
            			<input class='bb' onclick="window.location.href='./member/article.php?mart_id=<?=$mart_id?>&from_order_sheet_flag=1'" style='background-color: white; color: #7B7D7B; height: 18px; border: 1px solid #7B7D7B' type='button' value='무료회원 가입'>&nbsp; 
<?
//}else{
?>
            			<input class='bb' onclick="window.location.href='./member/article.php?mart_id=<?=$mart_id?>'" style='background-color: white; color: #7B7D7B; height: 18px; border: 1px solid #7B7D7B' type='button' value='무료회원 가입'>&nbsp; 
<?
//}
?>
            			<input class="bb" onclick="opensub1('./member/find_pass.php?mart_id=<?=$mart_id?>', 300, 200)" style="background-color: white; color: #7B7D7B; height: 18px; border: 1px solid #7B7D7B" type="button" value="ID,PASSWORD 분실">
<?
//if(strstr($this->url(),'order_sheet.php') != false && $shopuser != 2){
?>
            			<input class='bb' onclick="window.location.href='./cart/order_sheet_nomem.php?mart_id=<?=$mart_id?>'" style="background-color: white; color: #7B7D7B; height: 18px; border: 1px solid #7B7D7B" type="button" value="비회원 구매">
<?
//}
?>
            			<br>
            			<br>
            			</strong></span><br>
            		</td>
          		</tr>
        		</table>
        		</center></div>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%">
<?
//if(strstr($this->url(),'order.php') != false){
?>		
        		<div align="center"><center>
        		<table cellspacing="1" background="/market/images/dot2.gif" width="75%" border="0">
          		
          		<form name='f1' action='order_nomem.php' onsubmit='return checkform1(this)'>
          		<input type='hidden' name='mart_id' value='<?echo $mart_id?>'>
          		<!--
          		<tr>
            		<td bgcolor="#FFFFFF" valign="top">
            			<p align="center">
            			<?
				        	if($ti_login3_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_login3_img")){
				        		echo "	
				        	<img src='$Co_img_DOWN$mart_id/design2/$ti_login3_img' WIDTH='366' HEIGHT='25'>
				        		";
				        	}
				        	else{
				        		echo "
				        	<img src='/market/images/login2.gif' WIDTH='366' HEIGHT='25'>
				        		";
				        	}
				        	?>
				        	<br>
            			<br>
            			<?
				        	if($ti_login4_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_login4_img")){
				        		echo "	
				        	<img src='$Co_img_DOWN$mart_id/design2/$ti_login4_img' WIDTH='7' HEIGHT='20'>
				        		";
				        	}
				        	else{
				        		echo "
				        	<img src='/market/images/blank2.gif' align='absmiddle' WIDTH='7' HEIGHT='20'>
				        		";
				        	}
				        	?>
				        	<span class="bb">주민등록번호<strong>&nbsp; 
            			</strong></span>
            			<input class="bb" name="passport1" onkeyup=check(); size="7" style="height: 18; width: 93; border: 1px solid #7B7D7B">
            			<strong><span class="zz"> </span><span class="bb">&nbsp;-&nbsp; </span></strong>
            			<input class="bb" name="passport2" onkeyup=check1(); size="7" style="height: 18; width: 93; border: 1px solid #7B7D7B">
            			<strong><span class="zz"> &nbsp; 
            			<input class="bb" name='submit_button' style="background-color: white; color: #7B7D7B; height: 18px; border: 1px solid #7B7D7B" type="submit" value=" go ">&nbsp;&nbsp;&nbsp; <br>
            			<br>
            			</span></strong>
            		</td>
          		</tr>
          		//-->
          		
          		<tr>
		            <td vAlign="top" bgColor="#ffffff"><p align="center">
		            <?
			        	if($ti_login3_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_login3_img")){
			        		echo "	
			        	<img src='$Co_img_DOWN$mart_id/design2/$ti_login3_img' WIDTH='366' HEIGHT='25'>
			        		";
			        	}
			        	else{
			        		echo "
			        	<img src='/market/images/login2.gif' WIDTH='366' HEIGHT='25'>
			        		";
			        	}
			        	?>
		            <br>
		            <br>
		            </p>
		            <div align="center"><center>
		            <table border="0" width="70%">
		              <tr>
		                <td width="33%">
		                <?
					        	if($ti_login4_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_login4_img")){
					        		echo "	
					        	<img src='$Co_img_DOWN$mart_id/design2/$ti_login4_img' WIDTH='7' HEIGHT='20'>
					        		";
					        	}
					        	else{
					        		echo "
					        	<img src='/market/images/blank2.gif' align='absmiddle' WIDTH='7' HEIGHT='20'>
					        		";
					        	}
					        	?>
		                <span class="bb">주문자 성명</span></td>
		                <td width="33%">
		                <input name="name_query" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; WIDTH: 93px; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px" size="7"></td>
		                <td width="34%"><p align="center"></td>
		              </tr>
		              <tr>
		                <td width="33%">
		                <?
					        	if($ti_login4_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_login4_img")){
					        		echo "	
					        	<img src='$Co_img_DOWN$mart_id/design2/$ti_login4_img' WIDTH='7' HEIGHT='20'>
					        		";
					        	}
					        	else{
					        		echo "
					        	<img src='/market/images/blank2.gif' align='absmiddle' WIDTH='7' HEIGHT='20'>
					        		";
					        	}
					        	?>
		                <span class="bb">주문번호</span></td>
		                <td width="33%">
		                <input name="order_num_query" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; WIDTH: 93px; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px" size="7"></td>
		                <td width="34%"><strong><span class="zz"><p align="center">
		                <input class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value=" go " name="submit_button"></span></strong></td>
		              </tr>
		            </table>
		            </center></div><p align="center">　</td>
		          </tr>
          		
          		
          		</form>
        		</table>
        		
        		</center></div>
<?
//}
?>
        		<div align="center"><center>
        		<table cellspacing="1" width="441" border="0">
          		<tr>
            		<td bgcolor="#FFFFFF" valign="top" width="437"><br><br>
            			<p align="left">
            			<?
				        	if($ti_login5_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_login5_img")){
				        		echo "	
				        	<img src='$Co_img_DOWN$mart_id/design2/$ti_login5_img' WIDTH='429' HEIGHT='19'>
				        		";
				        	}
				        	else{
				        		echo "
				        	<img src='/market/images/join-exp.gif' WIDTH='429' HEIGHT='19'>
				        		";
				        	}
				        	?>
				        	<br>
            			<span class="bb"><br>
            			상품을 주문하실 때마다 번거로운 구매자 정보를 입력하지 
            			않으셔도 됩니다. <br>
            			구매하신 상품종류에 따라 일정의 사이버머니를 적립해 드립니다.<br>
            			저희 쇼핑몰의 회원만을 위한 상품정보 및 이메일서비스를 받으실 
            			수 있습니다.</span><strong><span class="zz"><br>
            			<br>
            			<br>
            			</span></strong>
            		</td>
          		</tr>
        		</table>
        		</center></div>
        	</td>
      	</tr>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
</td>
</tr>
</table>
<?
include( './include/bottom.inc' );
?>
</body>
</html>
<script>
document.f.username.focus();
</script>
