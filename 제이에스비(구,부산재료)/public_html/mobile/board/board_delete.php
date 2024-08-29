<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<?
$SQL = "select perms from $MemberTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$perms = mysql_result($dbresult, 0, 0);
if($perms == "4") {
	echo ("		
	<script>
		alert('미등록 쇼핑몰입니다.');
		history.go(-1);
	</script>
	");
	exit;
}

$SQL = "select password from $MemberTable where username = '$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0 ){
	$shop_password = mysql_result($dbresult,0,0);	
}

$SQL = "select * from $New_BoardConfigTable where mart_id = '$mart_id' and bbs_no = '$bbs_no'";
$dbresult = mysql_query($SQL, $dbconn);
$ary = mysql_fetch_array($dbresult);

$board_title = $ary[board_title];	
$board_comment = $ary[board_comment];	
$board_date = $ary[board_date];
$comment_ok = $ary[comment_ok];
$item_fg_color = $ary[item_fg_color];	
$item_bg_color = $ary[item_bg_color];	
$table_fg_color = $ary[table_fg_color];	
$table_bg_color = $ary[table_bg_color];	
$headhtml = $ary[headhtml];
$tailhtml = $ary[tailhtml];
$top_body = $ary[top_body];
$bottom_body = $ary[bottom_body];	
$board_class = $ary[board_class];	
$pagecount = $ary[pagecount];	
$if_use_secret = $ary[if_use_secret];
$userfile_use = $ary[userfile_use];

if( $board_class == 1 || $board_class == 3 ){	
	$SQL = "select username from $Mart_Member_NewTable where username='$UnameSess' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows < 1){
		echo ("		
			<script>
			window.alert('회원전용 공간입니다.');
			parent.location.href='../main/login.html?url=$url&mart_id=$mart_id';
			</script>
		");
		exit;
	}

}
if($board_class == 2){
	echo ("		
	<script>
		alert('관리자만 삭제할 수 있습니다.');
		history.go(-1);
	</script>
	");
	exit;
}						

include "../../market/include/getmartinfo.php";

if(!isset($flag) || $flag != "delete"){
	include('../../market/include/head_alltemplate.php');

?>

<script>
function board_checkform(){
	var f = document.writeform;
	if (f.passwd.value.length < 1){
		alert("비밀번호를 입력하세요.")
		f.passwd.focus();
		return;
	}
	//f.editBox.editmode = "html";
	//f.content.value = f.editBox.html;
	f.submit();	
}
</script>


<!---------------------- 게시판 시작 ---------------------------------------------------->	
<?
$SQL = "select * from $New_BoardTable where index_no=$index_no and mart_id = '$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$ary = mysql_fetch_array($dbresult);

$writer = $ary[writer];
$email = $ary[email];
$subject_new = $ary[subject_new];
$content = $ary[content];
$if_secret = $ary[if_secret];
$user_file = $ary[userfile];
$user_file1 = $ary[userfile1];

$subject_new = eregi_replace( "<br>", "", $subject_new );
$content = eregi_replace( "<br>", "", $content );
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="euc-kr" />
			<title>아이엠푸드몰</title>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;" />
		<link rel="apple-touch-icon" href="http://img.orga.co.kr/images/mobile/apple-touch-icon.png" />
        <link rel="shortcut icon" href="http://img.orga.co.kr/images/mobile/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="../css/m_style.css" />
		<script type="text/JavaScript" src="../js/jquery-1.7.min.js"></script>
		<script type="text/javascript">
			document.createElement('header');
			document.createElement('nav');
			document.createElement('section');
			document.createElement('article');
			document.createElement('footer');
			
			function check_submit() {

				var query = document.searchForm.searchTerm.value;

				if(query != ''){
					document.searchForm.submit();
				} else {
					alert("검색어를 입력하세요");
					document.searchForm.searchTerm.focus(); 
					return;
				}	
			}			
		</script>
		
		
<script language="javascript">
<!--
function goTo(){
	var f=document.boardchange;
	f.action="board_list.html";
	f.submit();
}

function member(){
if (confirm("회원만 사용할 수 있는 메뉴입니다. 로그인하세요.")) return true;
return false;
}

//-->
</script>
<script>
function board_checkform(){
	var f = document.writeform;
	if (f.passwd.value.length < 1){
		alert("비밀번호를 입력하세요.")
		f.passwd.focus();
		return;
	}
	f.submit();	
}
</script>

	</head>
	<body>
 
 <? include("../include/top.html"); ?>

		<section id="content">
			<article id="contentSubTitle">
				<div class="subTitle">
					<h2>&nbsp;&nbsp;<a href="../">홈</a> > 커뮤니티 > <?if($bbs_no==1){echo"공지사항";}elseif($bbs_no==2){echo"이용안내";}elseif($bbs_no==4){echo"회원문의";}else{echo"비회원문의";}?></h2>
				</div>
			</article>
 
			<article id="contentSub">
				<article class="btnNews">
					<ul class="list">
					
						
						<li><a href="../board/board_list.html?bbs_no=1">[공지]</a></li>
						<li><a href="../board/board_list.html?bbs_no=2">[이용안내]</a></li>
						<li><a href="../board/board_list.html?bbs_no=4">[회원문의]</a></li>
						<li><a href="../board/board_list.html?bbs_no=5">[비회원문의]</a></li>
					</ul>
				</article>

			<article id="productReview">	
<?
	if($user_pass != ''){
		echo "
		<script>
		alert(\"비밀번호가 틀립니다.\");
		</script>
		";
	}	
?>
			<table class="orderForm mt10 mb20">
				<form method="POST" name='writeform' onsubmit='board_checkform(); return false'> 
				<input type="Hidden" name="flag" value="delete">
				<input type="Hidden" name="mart_id" value="<?=$mart_id?>">
				<input type="Hidden" name="content" value="<?=htmlspecialchars($content)?>">
				<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
				<input type="hidden" name="page" value="<?=$page?>">
				<input type="hidden" name="keyset" value="<?=$keyset?>">
				<input type="hidden" name="searchword" value="<?=$searchword?>">
				<tr>
                        <th width=25%>비밀번호</th>
                        <td><input type='password' name="passwd" class="input_03"  size="20"> <input type='submit' value=" 확 인 "></td>
                </tr>

			  </form>
			  <script>
			  document.f.user_pass.focus();
			  </script>
		    </table>
			<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center"><input type=button value="목록으로" onclick=location.href='board_list.html?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'></td>
				</tr>
			</table>

			</article>	
		</section><!-- end content -->
 
 
<? include("../include/bottom.html"); ?>
<script>
document.writeform.passwd.focus();
</script>
<?
}else if($flag == "delete"){
	$SQL = "select passwd, userfile, userfile1, thread from $New_BoardTable where index_no=$index_no and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	
	$row = mysql_fetch_array($dbresult);

	$passwd_db = $row[passwd];
	$username = $row[username];
	$userfile = $row[userfile];
	$userfile1 = $row[userfile1];
	$thread = $row[thread];

	if($passwd_db != $passwd && $shop_password != $passwd){
		echo ("
			<script language='javascript'>
			alert('비밀번호가 정확하지 않습니다.');
			</script>
		");	

		echo "<meta http-equiv='refresh' content='0; URL=board_delete.php?mart_id=$mart_id&index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
	}else{


		$upload = "$UploadRoot$mart_id/";
		if( $userfile ){ //해당번호에 파일이 있다면 파일을 삭제함
			$desc = "{$upload}{$userfile}";
			unlink($desc);
		}
		if( $userfile1 ){ //해당번호에 파일이 있다면 파일을 삭제함
			$desc1 = "{$upload}{$userfile1}";
			unlink($desc1);
		}

		$SQL = "delete from $New_BoardTable where index_no = $index_no and mart_id = '$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		if ($dbresult == false) echo "쿼리 실행 실패!";

		//관련 코멘트 삭제
		$SQL = "delete from board_comment where index_no = '$index_no' and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);

		echo "<meta http-equiv='refresh' content='0; URL=board_list.html?mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
	}
}
?>
<?
mysql_close($dbconn);
?>
	</body>
</html>