<?
include "../lib/Mall_Admin_Session.php";
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(f){
	if(f.category_limit_start.value == ""){
		alert("회원번호를 입력하세요.")
		f.category_limit_start.focus();
		return false;
	}	
	if(f.category_limit_end.value == ""){
		alert("회원번호를 입력하세요.")
		f.category_limit_end.focus();
		return false;
	}	





<?
if(!$st){
?>
	if(f.sea_num.value == ""){
		alert("고유번호를 입력하세요.")
		f.sea_num.focus();
		return false;
	}	
<?
}elseif($st==2){
?>
	if(f.sung_num.value == ""){
		alert("고유번호를 입력하세요.")
		f.sung_num.focus();
		return false;
	}	
<?
}elseif($st==3){
?>
	if(f.khan_num.value == ""){
		alert("고유번호를 입력하세요.")
		f.khan_num.focus();
		return false;
	}
<?
}
?>






	if(f.g_id.value == ""){
		alert("그룹장 아이디를 입력하세요.")
		f.g_id.focus();
		return false;
	}	
	if(f.g_pw.value == ""){
		alert("그룹장 비밀번호를 입력하세요.")
		f.g_pw.focus();
		return false;
	}	
	//var category_left = ed.getHtml(); //대체한 textarea에 작성한HTML값 전달

	return true;
}
function createXMLHttpRequest(){
	if(window.ActiveXObject){
		xmlHttpRequest=new ActiveXObject("Microsoft.XMLHTTP");
	}else if(window.XMLHttpRequest){
		xmlHttpRequest=new XMLHttpRequest();
	}
	return xmlHttpRequest;
}
xmlHttpRequest=createXMLHttpRequest();
function idcheck(){
	var g_id = document.up.g_id.value;
	var url = "xml_id_check.php";
	


        var uid = document.getElementById("g_id");


        if(!/^[a-zA-Z0-9]{4,16}$/.test(uid.value))

        { 
            alert('아이디는 숫자와 영문자 조합으로 4~16자리를 사용해야 합니다.');
            uid.value = "";
            uid.focus();
            return false;
        }

        var chk_num1 = uid.value.search(/[0-9]/g); 
        var chk_eng1 = uid.value.search(/[a-z]/ig); 

        if(chk_num1 < 0 || chk_eng1 < 0)
        { 
            alert('아이디는 숫자와 영문자를 혼용하여야 합니다.');
            uid.value = "";
            uid.focus(); 
            return false;
        }

	
	
		if(xmlHttpRequest){
			try{
				if(g_id){
					if(xmlHttpRequest.readyState==4||xmlHttpRequest.readyState==0){
						var params="mart_id=<?=$mart_id?>&form_info=f.g_id&user_id="+encodeURIComponent(g_id);
						//POST방식으로 xmltest.php를 열고, 비동기식으로 불러옴
						xmlHttpRequest.open("post",url,true);
						//서버측 요청하고 응답을 받기 위한 함수(메서드)
						xmlHttpRequest.onreadystatechange=Member_check;
						//한글 깨짐 방지하기 위한 것
						xmlHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=euc-kr');
						xmlHttpRequest.send(params);
					}else{}
				}	
			}catch(e){}
		}else{
				alert("서버에서 응답이 없습니다.");
		}
		//checkwin.focus(); 
	
}
function Member_check(){
	var id_chk=document.getElementById("id_chk");
	if(xmlHttpRequest.readyState==4){
			if(xmlHttpRequest.status==200){
				var xml=xmlHttpRequest.responseTEXT;
				var g_id = document.up.g_id.value;
				//중복된 아이디가 없으면 아이디 사용가능
				if(xml==0){
					id_chk.innerHTML=document.up.g_id.value+"는 사용 가능한 아이디입니다.";
					document.up.g_pw.focus();
				//그렇지 않을 경우 아이디 사용불가
				}else{
					id_chk.innerHTML=document.up.g_id.value+"는 사용중인 아이디입니다.";
					document.up.g_id.value="";
					document.up.g_id.focus();
				}
			}
		}else{
			id_chk.innerHTML="(아이디는 영문자, 숫자 포함해서 6자이상)";
		}
}
/***************************************************************************************/
/*				          ajax를 이용한 아이디 중복 체크 끝						   */
/***************************************************************************************/
</script>
<script src="../../editor/easyEditor.js"></script>

</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<?  include '../inc/menu2.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td >&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="310"></td>
        <td valign="top" ><div align="right">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="10"></td>
            </tr>
            <tr>
              <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">그룹장 검색결과 </span> </div></td>
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
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td >&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<form action='category_modify.php?category_num=<?=$category_num?>' name="up" method="post" onSubmit="return checkform(this)" enctype="multipart/form-data">

	<input type="hidden" name="flag" value="<?=$flag?>">
	<input type="hidden" name="st" value="<?=$st?>">
	<input type="hidden" name="prevno" value="<?=$prevno?>">



<input type="hidden" name="category_img" value="<?=$category_img?>">
<table width="70%" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		 <td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>그룹장 검색결과 </b></td>
				</tr>
			</table>


<?
if ($cnfPagecount == ""){
	$cnfPagecount = 1000;
}
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;


if($sea_num){
	$search_query = " and (sea_area like '%$sea_num%' or sea_num = '$sea_num') and category_degree='0'";
}
if($sea_num && $sung_num){
	$search_query = " and (sea_area like '%$sea_num%' or sea_num = '$sea_num') and (sung_area like '%$sung_num%' or sung_num = '$sung_num') and category_degree='1'";
}
if($sea_num && $sung_num && $khan_num){
	$search_query = " and (sea_area like '%$sea_num%' or sea_num = '$sea_num') and (sung_area like '%$sung_num%' or sung_num = '$sung_num') and (khan_area like '%$khan_num%' or khan_num = '$khan_num') and category_degree='2'";
}

$SQL = "select * from $CategoryTable where 1 $search_query order by cat_order desc ";



$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);

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

?>

<table border="0" width="70%" cellspacing="1" cellpadding="1" align=center>

							<tr bgcolor="#C8DFEC" align="center">
								<td width="10%">번호</td>
								<td >고유번호</td>
								<td >지역명</td>
								<td >회원번호</td>
								<td >이름</td>
							</tr>



<?
for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$row = mysql_fetch_array($dbresult);
	$j = $numRows - $i;

	$pu_search = $row[category_degree] + 1;
	if($pu_search == 3){
		$category_num_parent = $row[prevno];
	}
?>

							<tr onmouseover="this.style.backgroundColor='#DDF0FF'" onmouseout="this.style.backgroundColor='#FFFFFF'" bgcolor="#FFFFFF" align='center'>
								<input type='hidden' name='itemno[]' value='<?=$item_no?>'>
								<td><?=$j?></td>
								<td><a href="category_view.php?category_degree=<?=$row[category_degree]?>&sea_num=<?=$row[sea_num]?>&sung_num=<?=$row[sung_num]?>&khan_num=<?=$row[khan_num]?>"><?=$row[sea_num]?><?=$row[sung_num]?><?=$row[khan_num]?></a></td>
								
								<td><a href="category_view.php?category_degree=<?=$row[category_degree]?>&sea_num=<?=$row[sea_num]?>&sung_num=<?=$row[sung_num]?>&khan_num=<?=$row[khan_num]?>"><?=$row[sea_area]?> <?=$row[sung_area]?> <?=$row[khan_area]?></a></td>

								<td><?=$row[category_limit_start]?>~<?=$row[category_limit_end]?></td>
								<td><?=$row[gr_name]?></td>
							</tr>

<?




	$pu_search="";
	$category_num_parent="";
}
?>

</table>






		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
mysql_close($dbconn);
?>