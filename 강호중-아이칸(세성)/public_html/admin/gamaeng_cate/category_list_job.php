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
	if(confirm("삭제 하시겠습니까?")){
		window.location.href='job_modify.php?flag=delcategory&category_num='+category_num;
		return true;
	}
	else return false;
}
/**	사용안함
function really_del_gnt_category_s(gnt_category_num_s){
	if(confirm("삭제 하시겠습니까?")){
		window.location.href='job_modify.php?flag=del_gnt_category_s&gnt_category_num_s='+gnt_category_num_s;
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
		<td>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top">
				<table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td background="../img/mid_bg.gif">&nbsp;</td>
                  </tr>
                </table></td>
                <td width="100%" valign="top" background="../img/top_2_bg.gif">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><div class="hidden-sm"><img src="../img/page_title2.gif" width="326" height="81"></div></td>
                    <td valign="top"><div align="right">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="10"></td>
                          </tr>
                          <tr>
                            <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../good/board_frame3.html">HOME</a> &gt; </span><span class="text_gray2_c">직업 관리 </span> </div></td>
                          </tr>
                          <tr>
                            <td height="28">&nbsp;</td>
                          </tr>
                          <tr>
                            <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;관리자모드에 접속하셨습니다.</span></div></td>
                          </tr>
                        </table>
                    </div></td>
                  </tr>
                </table>
				</td>
                <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td background="../img/mid_bg.gif">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table>

			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>직업 관리 </b> </td>
				</tr>
		  </table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">

					<table border="0" width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="100%" bgcolor="#808080" height="1"></td>
						</tr>
						<tr>
							<td width="100%" bgcolor="#FFFFFF" height="0"><table border="0" width="100%">
						<tr>
							<td width="30%" height="3"></td>
							<td width="70%" height="3"></td>

						<tr>
							<td width="30%"></td>
							<td width="70%"></td>
					  </tr>
					</table>
					</td>
				 </tr>
			  </table>
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<div align="center"><center>
					<table border="0" width="92%">
						<tr>
							<td width="90%" bgcolor="a7a7a7">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td bgcolor="#e7e7e7" colspan="4">
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<td width="50%">&nbsp; <b>
												목록</b></td>
											<td width="50%"></td>
											</tr>
										</table>
								  </td>
								</tr>
								<tr>
									<td width="55%" bgcolor="#FFFFFF" align="left">
										<p align="center">분야명
								  </td>
									<td width="31%" bgcolor="#FFFFFF" align="center">
										수정									</td>
								</tr>
<?
//================== 1차 분야 ========================================================
$SQL = "select * from job_gubun where mart_id='$mart_id' and prevno='0' order by cat_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
$start= "0";

for ($i=0; $i<$numRows; $i++){
	$row = mysql_fetch_array( $dbresult );
	$category_num = $row[category_num];
	$prevno = $row[prevno];
	$category_name = $row[category_name];
	$cat_order = $row[cat_order];
	$if_hide = $row[if_hide];
	$gigan = $row[gigan];
	$money = $row[money];

	if($if_hide == '1') $hide_str = "<img src='../images/hide.gif' border='0'>";
	else $hide_str = "";

	$cat_sql1 = "select * from job_gubun where mart_id='$mart_id' and prevno='$category_num' order by cat_order desc";
	$cat_res1 =  mysql_query($cat_sql1, $dbconn);

	/*
	$cat_num = 0;
	while( $cat_row1 = mysql_fetch_array( $cat_res1 ) ){
		$category_num1 = $cat_row1[category_num];
		$prevno1 = $cat_row1[prevno];

		$SQL1 = "select item_no from $ItemTable where prevno='$category_num1' and mart_id='$mart_id'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		$numRows1 = mysql_num_rows( $dbresult1 );
		$cat_num = $cat_num + $numRows1;
	}
	*/

	$cate_1 = "select item_no from $ItemTable where firstno='$category_num' and mart_id='$mart_id'";
	$cate_1_result = mysql_query($cate_1, $dbconn);
	$cate_1_total = mysql_num_rows( $cate_1_result );


	$SQL2 = "select category_num,category_name,cat_order,if_hide,category_degree from job_gubun where mart_id='$mart_id' and prevno='$category_num' and category_degree='1' order by cat_order desc";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$tot2 = mysql_num_rows($dbresult2);
?>
								<tr>
									<td bgcolor='#808080' align='left' height='1' colspan='3'></td>
								</tr>
								<tr onMouseOver="this.style.backgroundColor='#DDF0FF'" onMouseOut="this.style.backgroundColor='#FFFFFF'" bgcolor="#FFFFFF">
									<td align='left'><a name="<?=$category_num?>">
<?
		if($i < $numRows - 1){
?>
										<a href='job_modify.php?prevno=0&category_num=<?=$category_num?>&cat_order=<?=$cat_order?>&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='한단계내리기'> </a>
<?
		}else{
?>
										<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
		if($i > 0){	
?>
										<a href='job_modify.php?prevno=0&category_num=<?=$category_num?>&cat_order=<?=$cat_order?>&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='한단계올리기'> </a>
<?
		}
		else{
?>
										<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
?>
										&nbsp;<b><?=$category_name?></b>&nbsp;<?=$hide_str?></a>
									</td>
									<td align=center>
										
										<input class='aa' onClick="location.href='category_edit_job.php?category_num=<?=$category_num?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'>
										
<?
	
$numRows1="0";
?>
									</td>
								</tr>


<?
}
?>

								</table>
							</td>
						</tr>
				  </table>


<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>



<div id="floater" style='position:absolute; top:0px; left:50%; z-index:1;'>
<div style='position:absolute;top:388px;left:450px'>
	<a href="#top"><img src="./images/page_top.gif" border=0></a><BR><BR>
	<a href="#bottom"><img src="./images/page_bottom.gif" border=0></a>
</div>
</div>


</div></body>
</html>	
<script type="text/javascript" src="/js/script.js"></script>
<?
}
?>
<?
mysql_close($dbconn);
?>
