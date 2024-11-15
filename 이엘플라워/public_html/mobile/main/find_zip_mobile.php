<script>
/*########################### Div레이어팝업을 띄울 자바스크립트 함수 ###########################*/
	function doLayerPopup(v) {
		var layerPopupFull = document.getElementById("layerPopupFull");
		var client_width = document.body.clientWidth;
		var client_height = document.body.clientHeight;
		var window_height = document.body.scrollHeight;
		var layerPopup = document.getElementById("layerPopup");

		parent.layerPopupFull.style.display = "none";
		parent.layerPopup.style.display = "none";
	}
/*##############################################################################################*/
</script>


<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ks_c_5601-1987">
<link href="../../market/css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../market/js/common.js"></script>
<script>
function frm_val(f){
	if(f.dong.value==""){
		alert("읍/면/동 또는 키워드를 입력하세요!");
		f.dong.focus();
		return false;
	}else{
		var i;
		var t = f.dong.value;			
		for(i=0;i<t.length;i++){					
			if(t.substring(i,i+1)=="'"){
				alert("허용할수 없는 문자가 입력되었습니다.")
				f.dong.focus();
				return false
			}					
		}			
		for(i=0;i<t.length;i++)
			if(t.substring(i,i+1)==" "){
				alert("허용할수 없는 문자가 입력되었습니다.")
				f.dong.focus();
				return false
			}							
	return true;
	}
}
</script>
</head>

<body topmargin="0" bgcolor="#FFFFFF" leftmargin="0" style='overflow-x:hidden; overflow-y:scroll;' onload='document.post_form.dong.focus();'>
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top">
			<table width="100%" height="100%"  border="0" cellpadding="10" cellspacing="0">
				<tr>
					<td valign="top">
    					<table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
							<tr>
								<td width="90" height="4" bgcolor="1F76AF"></td>
							</tr>
							<tr>
								<td height="100"  bgcolor="#F7F7F7">
									<table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td height="30" align="center" class="text_14_s2">동 / 읍 / 면 을 입력하세요!</td>
										</tr>
										<tr>
										<form name='post_form' onsubmit="return frm_val(this)">
										<input type='hidden' name='flag' value='<?=$flag?>'>
											<td height="30" align="center">
												<input type="text" name="dong" class="input_03" size="15" style='ime-mode:active'>
												<input type='image' src="../../market/image/bu_search3.gif" width="40" height="20" border="0" align="absmiddle" onfocus='blur();'></a>
											</td>
										</form>
										</tr>
									</table>
								</td>
							</tr>
							<tr align="center">
								<td >
									<table width="90%"  border="0" cellspacing="0" cellpadding="2">
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
										<tr>
											<td class="text_name"><img src="../../market/image/icon_4.gif" width="15" height="9" align="absmiddle"><a href="javascript:ReturnFocus('<?=$zipcode?>','<?=$sido?> <?=$gugun?> <?=$dong?>','<?=$bunji?>')"><?=$sido?> <?=$gugun?> <?=$dong?> <?=$bunji?></a></td>
											<td width="40"><a href="javascript:ReturnFocus('<?=$zipcode?>','<?=$sido?> <?=$gugun?> <?=$dong?>','<?=$bunji?>')"><img src="../../market/image/bu_select.gif" width="30" height="20" border="0"></a></td>
										</tr>
<?
	}
}
?>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="1F76AF" height="4"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
<?
if($flag == ""){
	echo ("
	<script>
	function ReturnFocus(z,a,b) {	
		parent.document.f.address.value = a;
		//parent.document.f.address_d.value = b;
		parent.document.f.zip.value = z;
		parent.document.f.address_d.focus();
		doLayerPopup('close');
	}	
	</script>
	");
}
if($flag == "buyer"){
	echo ("
	<script>
	function ReturnFocus(z,a,b) {	
		parent.document.f.buyer_address.value = a;
		//parent.document.f.buyer_address_d.value = b;
		parent.document.f.buyer_zip.value = z;	
		parent.document.f.buyer_address_d.focus();
		doLayerPopup('close');
	}	
	</script>
	");
}
if($flag == "inmall"){
	echo ("
	<script>
	function ReturnFocus(z,a,b) {	
		parent.document.f.place.value = a;
		//parent.document.f.buyer_address_d.value = b;
		parent.document.f.zip.value = z;	
		parent.document.f.place_detail.focus();
		doLayerPopup('close');
	}	
	</script>
	");
}
if($flag == "inmember"){
	echo ("
	<script>
	function ReturnFocus(z,a,b) {	
		parent.document.f.place.value = a;
		//parent.document.f.buyer_address_d.value = b;
		parent.document.f.zip.value = z;	
		parent.document.f.place_detail.focus();
		doLayerPopup('close');
	}	
	</script>
	");
}
if($flag == "customer"){
	echo ("
	<script>
	function ReturnFocus(z,a,b) {	
		parent.document.f.c_address.value = a;
		//parent.document.f.buyer_address_d.value = b;
		parent.document.f.c_zip.value = z;	
		parent.document.f.c_address_d.focus();
		doLayerPopup('close');
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