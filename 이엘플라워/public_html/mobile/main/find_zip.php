<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<!DOCTYPE html>
 
 
 
 
 
 
<html>
	<head>
		<meta charset="euc-kr" />
		<title>행폰</title>
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

function ordercheck(f){
	if(f.ordernum.value==""){
		alert("주문번호를 입력하세요.");
		f.ordernum.focus();
		return false;
	}
	return true;
}
function checkform1(f){
	if(f.order_name.value==""){
		alert("주문자 성명을 입력하세요.");
		f.order_name.focus();
		return false;
	}
	/*
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
	*/
	return true;
}

function check(){
    var str = document.f1.passport1.value.length;
	if(str == 6) {
       document.f1.passport2.focus();
    }

} 
	
function check1(){
    var str = document.f1.passport2.value.length;
    if(str == 7) {
       document.f1.order_name.focus();
       
	}   	
} 
</script> 
	</head>
	<body>

		
  <section id="content">

		<article id="login">
		<h3>&nbsp;&nbsp;동 / 읍 / 면 을 입력하세요</h3>
		  <form name='post_form' onSubmit="return frm_val(this)">		  
		  <input type='hidden' name='flag' value='<?=$flag?>'>
			<div class="loginForm">
 
                <table class="loginT" cellpadding="0" cellspacing="0" border="0">
                    <tbody>
              
                        <tr>
										
										
											<td height="30" align="center">
												<input type="text" name="dong" class="input_03" size="15" style='ime-mode:active'>
												<input type='submit' value="검색"></a>
											</td>
										                
						</tr>
                    </tbody>
                </table>
            </div>
            </form>
		
 <?
if(!empty($dong)){
	$SQL = "select * from postcode_new where binary dong like '%$dong%'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	for($i=0;$i<$numRows;$i++){
		mysql_data_seek($dbresult, $i);
		$ary = mysql_fetch_array($dbresult);
		$zipcode = trim($ary["zipcode"]);
		$sido = trim($ary["sido"]);
		$gugun = trim($ary["gugun"]);
		$dong = trim($ary["dong"]);
		$bunji = trim($ary["bunji"]);
?>

						<div class="loginB"><input type=button value="선택" onClick="javascript:ReturnFocus('<?=$zipcode?>','<?=$sido?> <?=$gugun?> <?=$dong?>','<?=$bunji?>')">&nbsp;<a href="javascript:ReturnFocus('<?=$zipcode?>','<?=$sido?> <?=$gugun?> <?=$dong?>','<?=$bunji?>')"><?=$sido?> <?=$gugun?> <?=$dong?> <?=$bunji?></a></div>
					
<?
	}
}
?>		</article>
    </section>
 
 
	</body>
</html>
<?
if($flag == ""){
	echo ("
	<script>
	function ReturnFocus(z,a,b) {	
		top.opener.document.f.address.value = a;
		//top.opener.document.f.address_d.value = b;
		top.opener.document.f.zip.value = z;
		top.opener.document.f.address_d.focus();
	 	parent.window.close(); 
	}	
	</script>
	");
}
if($flag == "buyer"){
	echo ("
	<script>
	function ReturnFocus(z,a,b) {	
		top.opener.document.f.buyer_address.value = a;
		//top.opener.document.f.buyer_address_d.value = b;
		top.opener.document.f.buyer_zip.value = z;	
		top.opener.document.f.buyer_address_d.focus();
		parent.window.close();
	}	
	</script>
	");
}
if($flag == "inmall"){
	echo ("
	<script>
	function ReturnFocus(z,a,b) {	
		top.opener.document.f.place.value = a;
		//top.opener.document.f.buyer_address_d.value = b;
		top.opener.document.f.zip.value = z;	
		top.opener.document.f.place_detail.focus();
		parent.window.close();
	}	
	</script>
	");
}
if($flag == "inmember"){
	echo ("
	<script>
	function ReturnFocus(z,a,b) {	
		top.opener.document.f.place.value = a;
		//top.opener.document.f.buyer_address_d.value = b;
		top.opener.document.f.zip.value = z;	
		top.opener.document.f.place_detail.focus();
		parent.window.close();
	}	
	</script>
	");
}
if($flag == "customer"){
	echo ("
	<script>
	function ReturnFocus(z,a,b) {	
		top.opener.document.f.c_address.value = a;
		//top.opener.document.f.buyer_address_d.value = b;
		top.opener.document.f.c_zip.value = z;	
		top.opener.document.f.c_address_d.focus();
		parent.window.close();
	}	
	</script>
	");
}
?>
<script>
document.forms[0].dong.focus();
</script>	
<?
mysql_close($dbconn);
?>