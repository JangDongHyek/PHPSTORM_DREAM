<link href="../../css/common.css?version=<?php echo date('YmdHis')?>" rel="stylesheet" type="text/css">
<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if (isset($flag) == false || $flag == "") {
	include "../admin_head.php";



?>
<script>
function del_category(category_num){
	if(confirm("���� �Ͻðڽ��ϱ�?")){
		window.location.href='category_modify.php?flag=delcategory&category_num='+category_num;
		return true;
	}
	else return false;
}
/**	������
function really_del_gnt_category_s(gnt_category_num_s){
	if(confirm("���� �Ͻðڽ��ϱ�?")){
		window.location.href='category_modify.php?flag=del_gnt_category_s&gnt_category_num_s='+gnt_category_num_s;
		return true;
	}
	else return false;
}**/
</script>


<STYLE type=text/css>#floater {
	VISIBILITY: visible; POSITION: absolute
}
</STYLE>

<script language="JavaScript">
<!--

self.onError=null; 
currentX = currentY = 0; 
whichIt = null; 
lastScrollX = 0; lastScrollY = 0; 
NS = (document.layers) ? 1 : 0; 
IE = (document.all) ? 1: 0; 

function heartBeat() { 

	if(IE) { 
		diffY = document.body.scrollTop; 
		diffX = 0; 
	} 
	if(NS)
	{
		diffY = self.pageYOffset;
		diffX = self.pageXOffset;
	} 
	if(diffY != lastScrollY)
	{ 
		percent = .1 * (diffY - lastScrollY); 
		if(percent > 0)
			percent = Math.ceil(percent); 
		else
			percent = Math.floor(percent); 

		if(IE)
			document.all.floater.style.top = parseInt(document.all.floater.style.top) + percent; 
		if(NS)
			document.floater.top += percent; 
			lastScrollY = lastScrollY + percent; 
	}
}

function GoWing() {
	document.all.floater.style.display = "block";
	setInterval("heartBeat()",1);
}

var oldLoadHandlerMover = window.onload;
window.onload = new Function("{if (oldLoadHandlerMover != null) oldLoadHandlerMover(); GoWing();}");

-->
</script>


<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?  include '../inc/menu2.html'; ?>
<div class="wrap">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td background="../img/mid_bg.gif">&nbsp;</td>
                  </tr>
                </table></td>
                <td width="100%" valign="top" background="../img/top_2_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><div class="hidden-sm"><img src="../img/page_title2.gif" width="326" height="81"></div></td>
                    <td valign="top"><div align="right">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="10"></td>
                          </tr>
                          <tr>
                            <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../good/board_frame3.html">HOME</a> &gt; </span><span class="text_gray2_c">�������з� ���� </span> </div></td>
                          </tr>
                          <tr>
                            <td height="28">&nbsp;</td>
                          </tr>
                          <tr>
                            <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;�����ڸ�忡 �����ϼ̽��ϴ�.</span></div></td>
                          </tr>
                        </table>
                    </div></td>
                  </tr>
                </table></td>
                <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td background="../img/mid_bg.gif">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table>
			<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�������з� ���� </b> </td>
				</tr>
		  </table>

	





<?
include("./util.php");

if($small_update_value == 'y'){
	$sql = "update gameng_cate_bunya set gigan_money10='$gigan_money10',gigan_money20='$gigan_money20',gigan_money30='$gigan_money30' where seq_num='$small_value'";
	mysql_query( $sql,$dbconn ) or err_msg("�о� �Է��� �����߽��ϴ�.");
	meta_read("$PHP_SELF?big_value=$big_value&middle_value=$middle_value&next_focus=small");
}


#big_insert, middle_insert ���� ���е��,�оߵ��
#big_value - 1�ܰ� ��(���� ��)
#middle_value - 2�ܰ谪(�о� ��)






#���� ����
if($mode == "big_insert"){
	if(!$category_name){
		err_msg("���и��� �Է��ϼ���");
	}
	$sql = "insert into gameng_cate_bunya (seq_num,category_name) values ('','$category_name')";
	mysql_query( $sql,$dbconn ) or err_msg("���� �Է��� �����߽��ϴ�.");

	meta_read("$PHP_SELF");
}
#���� ����
else if($mode == "big_del"){
	$sql = "delete from gameng_cate_bunya where seq_num='$big_value'";
	mysql_query( $sql,$dbconn ) or err_msg("���� ������ �����߽��ϴ�.");

	meta_read("$PHP_SELF");
}


#�о� ����
else if($mode == "middle_insert"){
	if(!$big_value){
		err_msg("������ �����ϼ���.");
	}
	if(!$category_name){
		err_msg("������ �Է��ϼ���");
	}


	$sql = "insert into gameng_cate_bunya (seq_num,parent_num,category_name) values ('','$big_value','$category_name')";
	mysql_query( $sql,$dbconn ) or err_msg("�о� �Է��� �����߽��ϴ�.");

	meta_read("$PHP_SELF?big_value=$big_value&next_focus=middle");
}
#�о� ����
else if($mode == "middle_del"){
	$sql = "delete from gameng_cate_bunya where seq_num='$middle_value'";
	mysql_query( $sql,$dbconn ) or err_msg("�о� ������ �����߽��ϴ�.");

	meta_read("$PHP_SELF?big_value=$big_value");
}



#�κ� ����
else if($mode == "small_insert"){
	if(!$big_value){
		err_msg("������ �����ϼ���.");
	}
	if(!$category_name){
		err_msg("������ �Է��ϼ���");
	}
	if(!$middle_value){
		err_msg("�о߸� �����ϼ���.");
	}
	if(!$category_name){
		err_msg("�о߸� �Է��ϼ���");
	}

	$sql = "insert into gameng_cate_bunya (seq_num,parent_num,parent_num2,category_name,gigan_money10,gigan_money20,gigan_money30) values ('','$big_value','$middle_value','$category_name','$gigan_money10','$gigan_money20','$gigan_money30')";





	mysql_query( $sql,$dbconn ) or err_msg("�о� �Է��� �����߽��ϴ�.");

	meta_read("$PHP_SELF?big_value=$big_value&middle_value=$middle_value&next_focus=small");
}
#�κ� ����
else if($mode == "small_del"){
	$sql = "delete from gameng_cate_bunya where seq_num='$small_value'";
	mysql_query( $sql,$dbconn ) or err_msg("�κ� ������ �����߽��ϴ�.");

	meta_read("$PHP_SELF?big_value=$big_value");
}



?>

<Table align=center>
<tr>




<?
##########################################������##########################################################
?>


<td width="300">

<table>
<?
########################################## ���� ##########################################################
?>
	<form name="form1" method="post" action="<?=$PHP_SELF?>">
	<input type="hidden" name="mode" value="big_insert">
	<tr> 
		<td height=10 colspan="2">
		    <b>��������</b><BR>
			<!--<input type="text" name="category_name" size=16> <input type=submit value="���">
			--><br><br><br><br>
			</td>
	</tr>
	</form>

	<tr>
		<td colspan="2">
			<select name=sel onchange="location.href='<?=$PHP_SELF?>?big_value='+this.options[this.selectedIndex].value" size=15 style="width:200";>
			<?
			$sql = "select * from gameng_cate_bunya where parent_num is NULL";
			$result = mysql_query( $sql,$dbconn ) or err_msg("���� ��������.");
			for($i=0; $rows = mysql_fetch_array($result); $i++){
			?>
				<option value="<?=$rows[seq_num]?>"><?=$rows[category_name]?></option>
			<?
			}
			?>
			</select>				
		</td>
	</tr>
	<tr>
		<td>
			<?
			$sql = "select * from gameng_cate_bunya where seq_num='$big_value'";
			$result = mysql_query( $sql,$dbconn ) or err_msg("���а� ���ϱ� ����.");
			$rows = mysql_fetch_array($result);
			?>
			���ð� : <b><?=$rows[category_name]?></b>
			<?
			if($big_value){
			?>
			<!--<a href="<?=$PHP_SELF?>?mode=big_del&big_value=<?=$big_value?>">[����]</a>-->
			<?
			}
			?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;
			
		</td>
	</tr>
</table>	
</td>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;
</td>

<?
########################################## �о� ##########################################################
?>


<td>
<table>
	<form name="form2" method="post" action="<?=$PHP_SELF?>">
	<input type="hidden" name="mode" value="middle_insert">
	<input type="hidden" name="big_value" value="<?=$big_value?>">
	<tr> 
		<td height=10 colspan="2">
			<b>�о� ����</b><BR>
			<input type="text" name="category_name" size=16> <input type=submit value="���">
			<br><br><br><br>
			</td>
	</tr>
	</form>
	<tr>
		<td colspan="2">
			<select name=sel2 onchange="location.href='<?=$PHP_SELF?>?big_value=<?=$big_value?>&middle_value='+this.options[this.selectedIndex].value" size=15 style="width:200";>
			<?
			$sql = "select * from gameng_cate_bunya where parent_num='$big_value' and parent_num2 is null";
			$result = mysql_query( $sql,$dbconn ) or err_msg("�о� ��������.");
			for($i=0; $rows = mysql_fetch_array($result); $i++){
			?>
				<option value="<?=$rows[seq_num]?>"><?=$rows[category_name]?></option>
			<?
			}
			?>
			</select>				
		</td>
	</tr>
	<tr>
		<td>
			<?
			$sql = "select * from gameng_cate_bunya where seq_num='$middle_value'";
			$result = mysql_query( $sql,$dbconn ) or err_msg("�о߰� ���ϱ� ����.");
			$rows = mysql_fetch_array($result);
			?>
			���ð� : <b><?=$rows[category_name]?></b> 
			<?
			if($middle_value){
			?>
			<a href="<?=$PHP_SELF?>?mode=middle_del&big_value=<?=$big_value?>&middle_value=<?=$middle_value?>">[����]</a>
			<?
			}
			?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;
			
		</td>
	</tr>
</table>
</td>
<?
##########################################�κа���##########################################################
?>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;
</td>

<td>
<script type="text/javascript">
<!--
	function small_update(){
		var form = document.form3;
		form.small_update_value.value = 'y';
		form.action='./category_list.php';
		form.target = "_parent"
		form.submit();
	}
//-->
</script>
<table>
	<form name="form3" method="post" action="<?=$PHP_SELF?>">
	<input type="hidden" name="mode" value="small_insert">
	<input type="hidden" name="big_value" value="<?=$big_value?>">
	<input type="hidden" name="middle_value" value="<?=$middle_value?>">
	<input type="hidden" name="small_value" value="<?=$small_value?>">
	<input type="hidden" name="small_update_value" value="">

	<tr> 
		<td height=10 colspan="2">
			<b>�κ� ����</b><BR>
<?

			$sql = "select * from gameng_cate_bunya where seq_num='$small_value'";
			$result = mysql_query( $sql,$dbconn ) or err_msg("�κа� ���ϱ� ����.");
			$rows = mysql_fetch_array($result);


?>

			�κи�:<input type="text" name="category_name" value="<?=$rows[category_name]?>" size=16> <br>
			��:<input type=text name="gigan_money10" value="<?=$rows[gigan_money10]?>" size=10>��<br>
			��:<input type=text name="gigan_money20" value="<?=$rows[gigan_money20]?>" size=10>��<br>
			��:<input type=text name="gigan_money30" value="<?=$rows[gigan_money30]?>" size=10>��
								
			
			
			
			
			
			
			<input type=submit value="���">
			<?
			if($small_value){
			?>
			<input type=button onclick="small_update()" value="����">
			<?
			}
			?>
			
			</td>
	</tr>
	</form>
	<tr>
		<td colspan="2">
			<select name=sel3 onchange="location.href='<?=$PHP_SELF?>?big_value=<?=$big_value?>&middle_value=<?=$middle_value?>&small_value='+this.options[this.selectedIndex].value" size=15 style="width:200";>
			<?
			$sql = "select * from gameng_cate_bunya where parent_num2='$middle_value'";
			$result = mysql_query( $sql,$dbconn ) or err_msg("�κ� ��������.");
			for($i=0; $rows = mysql_fetch_array($result); $i++){
			?>
				<option value="<?=$rows[seq_num]?>"><?=$rows[category_name]?></option>
			<?
			}
			?>
			</select>				
		</td>
	</tr>
	<tr>
		<td>
			<?
			$sql = "select * from gameng_cate_bunya where seq_num='$small_value'";
			$result = mysql_query( $sql,$dbconn ) or err_msg("�κа� ���ϱ� ����.");
			$rows = mysql_fetch_array($result);
			?>
			���ð� : <b><?=$rows[category_name]?></b> 
			<?
			if($middle_value){
			?>
			<a href="<?=$PHP_SELF?>?mode=small_del&big_value=<?=$big_value?>&middle_value=<?=$middle_value?>&small_value=<?=$small_value?>">[����]</a>
			<?
			}
			?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;
			
		</td>
	</tr>
</table>
</td>

</tr>
</table>







		</td>
	</tr>
</table>



</div>
</body>
</html>	
<script type="text/javascript" src="/js/script.js"></script>
<?
}
?>
<?
mysql_close($dbconn);
?>
