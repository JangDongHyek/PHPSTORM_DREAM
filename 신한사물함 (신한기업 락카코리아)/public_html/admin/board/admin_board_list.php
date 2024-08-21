<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag_del=="del"){
	$SQL = "delete from $New_BoardTable where bbs_no = $bbs_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$SQL = "delete from $New_BoardConfigTable where bbs_no = $bbs_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}

if($flag_del=="car_board_del"){
	//$SQL = "delete from $Car_BoardTable where bbs_no = $bbs_no and mart_id='$mart_id'";
	//$dbresult = mysql_query($SQL, $dbconn);
	$SQL = "delete from $New_BoardConfigTable where bbs_no = $bbs_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}

if($flag == ""){
	include "../admin_head.php";
?>
<script>
function checkform(f){
	if(f.board_title.value == ""){
		alert("게시판 제목을 입력하세요");
		f.board_title.focus();
		return false;
	}
	if(f.board_comment.value == ""){
		alert("게시판 설명을 입력하세요");
		f.board_comment.focus();
		return false;
	}
	return true;
}
function del(bbs_no){
	if(confirm("삭제하시겠습니까? \n\n삭제하면 게시판의 모든 내용도 삭제됩니다.")){
		window.location.href='admin_board_list.php?flag_del=del&bbs_no='+bbs_no;
	}
	else return;
}
function car_board_del(bbs_no){
	if(confirm("삭제하시겠습니까? \n\n삭제하면 게시판의 모든 내용도 삭제됩니다.")){
		window.location.href='admin_board_list.php?flag_del=car_board_del&bbs_no='+bbs_no;
	}
	else return;
}
function board_view(bbs_no, mart_id){
	var url = "board_list.php?bbs_no="+bbs_no;
	var uploadwin = window.open(url,"uploadwin","width=800,height=600,scrollbars=no,toolbar=no,navationbar=no,scrollbars=yes,resizable=yes");
}
function car_board_view(bbs_no, mart_id){
	var url = "../car_board/board_list.php?bbs_no="+bbs_no;
	var uploadwin = window.open(url,"uploadwin","width=670,height=500,scrollbars=no,toolbar=no,navationbar=no,scrollbars=yes,resizable=yes");
}
</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?  include '../inc/menu6.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" background="../img/mid_bg.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="310"><img src="../img/page_title6.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">게시판관리</span> &gt; <span class="text_gray2_c">게시판관리</span> </div></td>
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
        </table></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500">
			<!--왼쪽부분시작-->
<?
$left_menu = "8";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->	  </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>게시판관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top">게시판은 가장 흔하면서도, 또한 가장 중요한 고객과의 커뮤니케이션 툴입니다.&nbsp;<br>
					그리고 한번 삭제한 게시판은 복구가 불가능하오니 삭제시 유의하시기 바랍니다.&nbsp;
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#5A96BD" height="1" valign="top"></td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
					<table border="0" width="100%">
<?
$SQL = "select * from $New_BoardConfigTable where mart_id='$mart_id' order by bbs_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
?>
							<tr>
							<td align="center"><b>[총 <?=$numRows?> 개의 게시판이 생성되어 있습니다]</b></td>
							</tr>
					</table>
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<div align="center"><div align="center"><center>
					
					<table border="0" width="95%">
						<tr>
							<td width="90%" bgcolor="#ffffff">
								<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
								<tr>
									<td width="100%" bgcolor="#e7e7e7" colspan="3">
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<td width="50%">&nbsp; <b>
												등록된 게시판 목록</b></td>
											<td width="50%"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="14%" bgcolor="#FFFFFF" align="left">
										<p align="center">게시판
											제목</td>
									<td width="26%" bgcolor="#FFFFFF" align="left">
										<p align="center">게시판
											설명</td>
									<td width="26%" bgcolor="#FFFFFF" align="center">
										설정/삭제</td>
								</tr>
<?
for($i=0; $i<$numRows; $i++){
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$bbs_no = $ary["bbs_no"];
	$bbs_order = $ary["bbs_order"];
	$mart_id = $ary["mart_id"];
	$board_title = htmlspecialchars($ary["board_title"]);
	$board_comment = htmlspecialchars($ary["board_comment"]);
	$board_date = $ary["board_date"];
	$item_fg_color = $ary["item_fg_color"];
	$item_bg_color = $ary["item_bg_color"];
	$table_fg_color = $ary["table_fg_color"];
	$table_bg_color = $ary["table_bg_color"];
	$headhtml = $ary["headhtml"];
	$board_class = $ary["board_class"];
	$pagecount = $ary["pagecount"];
	$board_type = $ary["board_type"];
	echo ("
								<tr>
									<td width='14%' bgcolor='#FFFFFF' align='left'>
	");
									
	if($i < $numRows - 1){
		echo "
										<a href=admin_board_list.php?bbs_no=$bbs_no&bbs_order=$bbs_order&flag=down><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='한단계내리기'></a> 
		";
	 }else{
		echo "
										<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
		";
	 }
	 if($i > 0){	
		echo "
										<a href=admin_board_list.php?bbs_no=$bbs_no&bbs_order=$bbs_order&flag=up><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='한단계올리기'></a> 
		";
	}
	else{
		echo "
										<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
		";
	}
	echo (" 	
										$board_title
									</td>
									<td width='26%' bgcolor='#FFFFFF'  align='center'>
										$board_comment
									</td>
									<td width='26%' bgcolor='#FFFFFF' align='center'>
										");

										if($_SESSION["UnameSess"] == "lets080" || $_SESSION["Mall_Admin_ID"] == "lets080"){echo"<input class='aa' onclick=\"window.location.href='admin_board_config.php?bbs_no=$bbs_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='설정'>
										";}
	if($board_type == ''){      				
		echo "
										<input class='aa' onclick=\"board_view('$bbs_no', '$Mall_Admin_ID')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='보기'>";
										if($_SESSION["UnameSess"] == "lets080" || $_SESSION["Mall_Admin_ID"] == "lets080"){
											echo"&nbsp;<input class='aa' onclick=\"del('$bbs_no')\" style='background-color: white; color: black; height: 18; width: 40; border: 1px solid #5a5a5a' type='button' value='삭제'>";
										}
	}
	if($board_type == '1'){      				
		echo "
										<input class='aa' onclick=\"car_board_view('$bbs_no', '$Mall_Admin_ID')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='보기'>
									";
										if($_SESSION["UnameSess"] == "lets080" || $_SESSION["Mall_Admin_ID"] == "lets080"){
											echo"&nbsp;<input class='aa' onclick=\"car_board_del('$bbs_no')\" style='background-color: white; color: black; height: 18; width: 40; border: 1px solid #5a5a5a' type='button' value='삭제'>";
										}
	}
	echo ("</td></tr>");
}
?>
							</table>
							</td>
						</tr>
					</table>
					</center></div>
				</td>
				</tr>
	<?if($_SESSION["UnameSess"] == "lets080" || $_SESSION["Mall_Admin_ID"] == "lets080"){?>		
<form name=writeform method='post' onsubmit='return checkform(this)'>
<input type='hidden' name='flag' value='write'>
<input type='hidden' name='mart_id' value='<?=$mart_id?>'>
				
				<tr align="left">
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<b>
					&nbsp;&nbsp;&nbsp;[새로운 게시판 생성] </b><br>
					&nbsp;&nbsp;&nbsp;&nbsp;게시판제목 <input name="board_title" size="25" class="input_03"><br>
					&nbsp;&nbsp;&nbsp;&nbsp;게시판설명 <input name="board_comment" size="45" class="input_03">&nbsp;
					<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="생성">
				  </td>
				</tr>
			</form>
			<?}?>
		  </table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
}
elseif ($flag == "write") {
	$SQL = "select max(bbs_no), count(*) from $New_BoardConfigTable where mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0){
		$maxBbs_no = mysql_result($dbresult, 0, 0) + 1;
	}else{
		$maxBbs_no = 1;
	}

	$sql2 = "select max(bbs_order), count(*) from $New_BoardConfigTable where mart_id='$mart_id'";
	$res2 = mysql_query($sql2, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($res2,0,1) > 0){
		$max_bbs_order = mysql_result($dbresult, 0, 0) + 1;
	}else{
		$max_bbs_order = 1;
	}

	$board_date = date("Y-m-d H:i:s");

	$item_fg_color = "#000000";
	$item_bg_color = "#f6f6f6";
	$table_fg_color = "#000000";
	$table_bg_color = "#ffffff";
	$headhtml = "";
	$board_class = 0;
	$pagecount = 10;

	$SQL = "insert into $New_BoardConfigTable (mart_id, bbs_no, board_title, ".
	"board_comment, board_date, item_fg_color, item_bg_color, table_fg_color, table_bg_color, ".
	"headhtml, board_class, pagecount, board_type, bbs_order) values ('$mart_id', $maxBbs_no, '$board_title', '$board_comment', '$board_date', '$item_fg_color', '$item_bg_color', '$table_fg_color', '$table_bg_color', '$headhtml', '$board_class', '$pagecount', '$board_type', '$max_bbs_order')";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=admin_board_list.php'>";
}
if($flag == "up"){
	$SQL = "select bbs_order from $New_BoardConfigTable where bbs_order > $bbs_order and mart_id='$mart_id' order by bbs_order Asc";
	$dbresult = mysql_query($SQL, $dbconn);
	$up_bbs_order = mysql_result($dbresult,0,0);
	
	$SQL = "select bbs_no from $New_BoardConfigTable where bbs_order = $up_bbs_order and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$up_bbs_no = mysql_result($dbresult,0,0);
	
	$SQL = "update $New_BoardConfigTable set bbs_order = $up_bbs_order where bbs_no = $bbs_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $New_BoardConfigTable set bbs_order = $bbs_order where bbs_no = $up_bbs_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=admin_board_list.php'>";
}

if($flag == "down"){
	$SQL = "select bbs_order from $New_BoardConfigTable where bbs_order < $bbs_order and mart_id='$mart_id' order by bbs_order Desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$down_bbs_order = mysql_result($dbresult,0,0);

	$SQL = "select bbs_no from $New_BoardConfigTable where bbs_order = $down_bbs_order and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$down_bbs_no= mysql_result($dbresult,0,0);
	
	$SQL = "update $New_BoardConfigTable set bbs_order = $down_bbs_order where bbs_no = $bbs_no and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $New_BoardConfigTable set bbs_order = $bbs_order where bbs_no = $down_bbs_no and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=admin_board_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>