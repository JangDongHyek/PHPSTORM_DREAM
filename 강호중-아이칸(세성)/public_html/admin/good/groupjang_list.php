<link href="../../css/common.css?version=<?php echo date('YmdHis')?>" rel="stylesheet" type="text/css">

<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ""){
	include "../admin_head.php";
?>
<script language='javascript'>
function frm_val(f){

	if(f.content.value==""){
		alert("내용이 입력되지 않았습니다.");
		f.content.focus();
		return false;
	}
	var Digit = '1234567890'

	if(f.bonus.value==""){
		alert("지급 금액을 입력하세요");				
		f.bonus.focus();
		return false;				
		
	}
	else{
		var len =f.bonus.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
		    var ch = f.bonus.value.substring(i,i+1);
		    
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("숫자만 입력가능합니다.");
					f.bonus.focus();
					return false;
			} 
			ret = false;
		}
	}
}

function del(username,num){
	if(confirm("삭제하시겠습니까?")){
		window.location.href='groupjang_list.php?flag=del&mode=<?=$mode?>&provider_id=<?=$provider_id?>&username='+username+'&num='+num;
	}
	else return;
}
</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?include '../inc/menu3.html'; ?>
<div class="wrap">
<table border="0" cellpadding="0" cellspacing="0" width="100%" bordercolorlight="#E1E1E1"  align="center">
  <tr>
	 <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
	 <table cellSpacing="0" cellPadding="0" width="100%" border="0">
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
		  <table width="100%" border="0">
			 <tr>
				<td width="100%" height="20">
				<p align="center"><b>[그룹장정보] </b><br>
				<br>
				
				</td>
			 </tr>
		  </table>
		  </td>
		</tr>
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
		  <table width="97%" border="0">
			 <tr>
				<td width="100%" bgColor="#999999">
				<table cellSpacing="1" cellPadding="3" width="100%" border="0">
			
				<form action='bunus.html' method='post' onsubmit="return frm_val(this)">
				<input type='hidden' name='flag' value='add'>
				<input type='hidden' name='username' value='<?=$username?>'>
				<input type='hidden' name='provider_id' value='<?=$Mall_Admin_ID?>'>
				<input type='hidden' name='mode' value='<?=$mode?>'>
				<tr>
					<td align="left" bgColor="#c8dfec" colspan=8>
					
			<select name=sea_area onchange="location.href='<?=$PHP_SELF?>?sea_area='+this.options[this.selectedIndex].value">
			<option value="">==시/도==</option>
			<?
			$sql = "select distinct sea_area from category where category_degree='0' order by cat_order desc";
			$result = mysql_query( $sql,$dbconn ) or err_msg("쿼리오류.");
			for($i=0; $rows = mysql_fetch_array($result); $i++){
				if($rows[sea_area] == $sea_area){
					$sea_seled="selected";
				}
			?>
				<option value="<?=$rows[sea_area]?>" <?=$sea_seled?>><?=$rows[sea_area]?></option>
			<?
				$sea_seled="";
			}
			?>
			</select>				
			
			<select name=sung_area onchange="location.href='<?=$PHP_SELF?>?sea_area=<?=$sea_area?>&sung_area='+this.options[this.selectedIndex].value">
			<option value="">==구/군==</option>
			<?
			$sql = "select distinct sung_area from category where category_degree='1' and sea_area='$sea_area' order by cat_order desc";
			$result = mysql_query( $sql,$dbconn ) or err_msg("쿼리오류.");
			for($i=0; $rows = mysql_fetch_array($result); $i++){
				if($rows[sung_area] == $sung_area){
					$sung_seled="selected";
				}
			?>
				<option value="<?=$rows[sung_area]?>" <?=$sung_seled?>><?=$rows[sung_area]?></option>
			<?
				$sung_seled="";
			}
			?>
			</select>					
					
			<select name=khan_area onchange="location.href='<?=$PHP_SELF?>?sea_area=<?=$sea_area?>&sung_area=<?=$sung_area?>&khan_area='+this.options[this.selectedIndex].value">
			<option value="">==읍/면/동==</option>
			<?
			$sql = "select distinct khan_area from category where category_degree='2' and sea_area='$sea_area' and sung_area='$sung_area' order by cat_order desc";
			$result = mysql_query( $sql,$dbconn ) or err_msg("쿼리오류.");
			for($i=0; $rows = mysql_fetch_array($result); $i++){
				if($rows[khan_area] == $khan_area){
					$khan_seled="selected";
				}
			?>
				<option value="<?=$rows[khan_area]?>" <?=$khan_seled?>><?=$rows[khan_area]?></option>
			<?
				$khan_seled="";
			}
			?>
			</select>		
			

			&nbsp;&nbsp;&nbsp;

			<a href="<?=$PHP_SELF?>"><font size=4><b>[지역 초기화]</b></font></a>
					</td>
				</tr>				
				</form>
				
				<tr>
					<td align="middle" bgColor="#c8dfec">No.</td>
					<td align="middle" bgColor="#c8dfec">시/도</td>
					<td align="middle" bgColor="#c8dfec">구/군</td>
					<td align="middle" bgColor="#c8dfec">읍/면/동</td>
					<td align="middle" bgColor="#c8dfec">이름</td>
					<td align="middle" bgColor="#c8dfec">아이디</td>
					<td align="middle" bgColor="#c8dfec">비밀번호</td>
					<td align="middle" bgColor="#c8dfec">이중비밀번호</td>

<?
if($sea_area && $sung_area && $khan_area){
$sql_add = " and sea_area='$sea_area' and sung_area='$sung_area' and khan_area='$khan_area'";
}
elseif($sea_area && $sung_area){
$sql_add = " and sea_area='$sea_area' and sung_area='$sung_area' ";
}
elseif($sea_area){
$sql_add = " and sea_area='$sea_area' ";
}

$SQL = "select * from category where mart_id ='$mart_id' $sql_add order by cat_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if ($cnfPagecount == "") $cnfPagecount = 20;
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

$total_page = ($numRows - 1) / $cnfPagecount;
$total_page = intval($total_page)+1;

if($page % 10 == 0)
$start_page = $page - 9;
else
$start_page = $page - ($page % 10) + 1;

$end_page = $start_page + 9;
if($end_page >= $total_page)
	$end_page = $total_page;
$prev_start_page = $start_page - 10;
$next_start_page = $start_page + 10;

$sum = 0;
for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$ary=mysql_fetch_array($dbresult);
	$j = $numRows - $i;

?>
				<tr>
					<td align='middle' bgColor='#ffffff'><?=$j?></td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[sea_area]?></td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[sung_area]?></td>
					<td align='middle' bgColor='#ffffff'><?=$ary[khan_area]?></td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[gr_name]?></td>
					<td align='middle'  bgColor='#ffffff'>
					<?
					if($ary[category_degree] == 2){
					?>
					<a href="../category/category_edit.php?category_num=<?=$ary[category_num]?>&prev_category_num=<?=$ary[prevno]?>"><?=$ary[g_id]?></a>
					<?}else{?>
					<a href="../category/category_edit.php?category_num=<?=$ary[category_num]?>"><?=$ary[g_id]?></a>
					<?}?>
					</td>
					<td align='middle'  bgColor='#ffffff'><?=$ary[g_pw]?></td>
					<td align='middle' bgColor='#ffffff'><?=$ary[g_pw2]?></td>
					</td>
				</tr>
<?
}
?>


				</table>
				</td>
			 </tr>
		  </table>
		  </td>
		</tr>
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff"><p align="right">
		  <?
				if($page == 1){
					echo ("
					처음
					");
				}
				else{
					echo ("
					<a href='groupjang_list.php?username=$rows[item_code]&page=1'>처음</a> 
					");
				}
			
				if($start_page > 1){
					echo ("
					<a href='groupjang_list.php?username=$rows[item_code]&page=$prev_start_page'>
					◁&nbsp; 
					</a>
					");
				}
				else{
					echo ("
					◁&nbsp; 
					");
				}
				for($i=$start_page;$i<=$end_page;$i++){
					if($i == $page){
						echo ("	
						[<b>$i</b>]
						");
					}
					else{
						echo ("
					<a href='groupjang_list.php?username=$rows[item_code]&page=$i'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='groupjang_list.php?username=$rows[item_code]&page=$next_start_page'>
					&nbsp;▷
					</a>
					");
				}
				else{
					echo ("
					&nbsp;▷
					");
				}
				if($page == $total_page){
					echo ("
					끝
					");
				}
				else{
					echo ("
					<a href='groupjang_list.php?username=$rows[item_code]&page=$total_page'>끝</a> 
					");
				}
				?>
				</td>
		</tr>
		<tr align="middle">
		  <td vAlign="top" width="100%" bgColor="#ffffff"></td>
		</tr>
	 </table>
	 </td>
  </tr>
</table>
</div>
</body>
</html>
<?
}else if($flag=="add"){
	$write_date = date("Y-m-d H:i:s");
	$bonus_tmp = $bonus;
	$point_str = "a";
	if($p_m == '-'){
		$bonus = -$bonus; 
		$point_str = "d";
	}

	$SQL = "insert into $BonusTable (mart_id, provider_id, id, write_date, bonus, content, mode) ".
	"values ('$mart_id', '$provider_id', '$username', '$write_date', $bonus, '$content', '$point_str')";
	$dbresult = mysql_query($SQL, $dbconn);

	if( !$dbresult ){
		echo "
		<script>
			alert('포인트 추가에 실패했습니다');
			history.go(-1);
		</script>
		";
		exit;
	}
			
	$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total + $bonus where username='$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	if( !$dbresult ){
		echo "
		<script>
			alert('회원정보에서 포인트 삭감에 실패했습니다');
			history.go(-1);
		</script>
		";
		exit;
	}

	if( $mode == "point" ){
		$tl_regdate = date("Y-m-d H:i:s");

		$tl_money = $bonus;
		
		if( $bonus < 0 ){
			$tl_content = "$username 포인트 기간 만료로 $tl_money 삭감";
			$tl_ok = "취소";
		}else{
			$tl_content = "$tl_money 지급";
			$tl_ok = "사용";			
		}
		$sql = "insert into $TicketListTable ( tl_uid, mart_id, provider_id, tl_money, tl_content, tl_memo, tl_ok,	tl_regdate, tl_getdate ) values ( '', '$mart_id', '$provider_id', '$tl_money', '$tl_content', '$tl_memo', '$tl_ok', '$tl_regdate', '$tl_regdate' )";
		$result = mysql_query($sql, $dbconn);
		if( !$result ){
			echo ("
				<script>
				alert('회원사 포인트 기록에 등록하는데 실패했습니다.');
				history.go(-1);
				</script>
			");
			exit;
		}
	}

	echo "<meta http-equiv='refresh' content='0; URL=groupjang_list.php?username=$username&provider_id=$provider_id&mode=$mode'>";
	
}else if($flag=="del"){
	
	$SQL = "select bonus from $BonusTable where num = $num and id = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$bonus = mysql_result($dbresult,0,0);
	
	$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total - $bonus 
	where username='$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "delete from $BonusTable where num = $num and id = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=groupjang_list.php?username=$username&provider_id=$provider_id&mode=$mode'>";
}
?>
<?
mysql_close($dbconn);
?>
