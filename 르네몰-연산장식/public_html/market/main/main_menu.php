<?
//========================== DB ���� ���� ======================================
$HostName = "localhost";
$DbName = "daek";
$Admin = "daek";
$AdminPass = "fpcm080";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

// $category_num ������ ����Ǿ� �ӽ÷� ����
$temp_category_num = $category_num;
$temp_category_name = $category_name;
$CategoryTable = "bb_class_table";
//================== 1�� ī�װ� ������ �ҷ��� ==========================================
$sql_cate = "select * from $CategoryTable where class_level='0' order by class_rank desc, class_id desc";
$res_cate = mysql_query($sql_cate, $dbconn);
$total_cate = mysql_num_rows($res_cate);
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
var fixedX = -1; ////////// ���̾� X�� ��ġ (-1 : ��ư�� �ٷ� �Ʒ��� ǥ��)
var fixedY = -1; ////////////// ���̾� Y�� ��ġ (-1 : ��ư�� �ٷ� �Ʒ��� ǥ��)

function openPopup(obj)
{
	var leftpos = 0;
	var toppos = 0;
	var cleft;
	var ctop;

	// ���� ������Ʈ�� ��ǥ��
	aTag = obj;
	do {
		aTag = aTag.offsetParent;
		leftpos	+= aTag.offsetLeft;
		toppos += aTag.offsetTop;
	} while(aTag.tagName!="BODY");

	cleft =	fixedX==-1 ? obj.offsetLeft	+ leftpos :	fixedX;
	ctop = fixedY==-1 ?	obj.offsetTop +	obj.offsetHeight + toppos :	fixedY;

	// �˾��޴�����
	oSubmenu = document.getElementById("sub"+obj.id);
	oSubmenu.style.left = cleft+100;
	oSubmenu.style.top = ctop-20;
	oSubmenu.style.zIndex = "9";
	oSubmenu.style.width = popWidth[obj.id.substring(4, obj.id.length)]+10;
	oSubmenu.style.height = popHeight[obj.id.substring(4, obj.id.length)];
	// �޴��� ���� ���� ���� �ȴٸ�
	if((parseInt(document.body.clientHeight)+document.body.scrollTop) < (parseInt(oSubmenu.style.top)+parseInt(oSubmenu.style.height)))
		oSubmenu.style.top = parseInt(document.body.clientHeight) + document.body.scrollTop - parseInt(oSubmenu.style.height);
	oSubmenu.style.display = "inline";
}

function closePopup(obj)
{
	oSubmenu = document.getElementById("sub"+obj.id);
	oSubmenu.style.display = "none";
}

function swapImgRestore() { //v3.0 
	var i,x,a=document.sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc; 
} 
//-->
</SCRIPT>
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="19%"><img src="../images/main_12.jpg" width="42" height="442"></td>
                    <td width="81%" valign="top">
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<?
//================== 1�� ī�װ� ������ �ҷ��� ==========================================
$upload = "../img/class/";
$i = "0";
while( $row_cate = mysql_fetch_array( $res_cate ) ){
	$i++;
	$category_num = $row_cate[class_id];
	$category_name = $row_cate[class_name];
	$category_img = $row_cate[class_img];

	$target = "$upload"."$category_img";
	if( $category_img ){
		$cate_target_img = "<img src='$target' border='0' align='absmiddle'>";
	}else{
		$cate_target_img = "$category_name";
	}
?>
							<tr>
								<td><a href="../shop/main.php?page=view_class&class_id=<?=$category_num?>" onmouseover="openPopup(this);" onmouseout="closePopup(this);" id="menu<?=$i?>"><?=$cate_target_img?></a></td>
							</tr>
<?
}
if( $res_cate ){
	mysql_free_result( $res_cate );
}
?>
						</table>
					  </td>
					</tr>
				  </table>

<?
//================== 1�� ī�װ� ������ �ҷ��� ==========================================
$sql_cate1 = "select * from $CategoryTable where class_level='0' order by class_rank desc, class_id desc";
$res_cate1 = mysql_query($sql_cate1, $dbconn);
$total_cate1 = mysql_num_rows($res_cate1);
$i = "0";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
popHeight = new Array(<?=$total_cate1+1?>);
popWidth = new Array(<?=$total_cate1+1?>);
//-->
</SCRIPT>
<?
while( $row_cate1 = mysql_fetch_array( $res_cate1 ) ){
	$i++;
	$category_num = $row_cate1[class_id];
?>
<!--����޴�<?=$i?>-->
<SCRIPT LANGUAGE="JavaScript">
<!--
popHeight[<?=$i?>] = 8;
popWidth[<?=$i?>] = 0;
//-->
</SCRIPT>
<a onmouseover="openPopup(document.getElementById('menu<?=$i?>'));" onmouseout="swapImgRestore();closePopup(document.getElementById('menu<?=$i?>'));">
<div id='submenu<?=$i?>' style="display: none;position: absolute;FILTER: alpha(opacity=85);">
<table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#EABE71">
	<tr>
		<td bgcolor="#ffffff" valign="top">
<?
	//================== 2�� ī�װ� ������ �ҷ��� ======================================
	$sql_cate2 = "select * from $CategoryTable where class_level='1' and class_ancestor='$category_num' order by class_rank desc, class_id desc";
	$res_cate2 = mysql_query($sql_cate2, $dbconn);
	$total_cate2 = mysql_num_rows($res_cate2);
	$k = "0";
?>
<?
	if( $total_cate2 < "1" ){
?>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr >
					<td height="20" class="submenu"><img src="../images/menu_icon.gif" align="absmiddle">No Category</td>
				</tr>
				<tr>
					<td><img src="../images/menu_line.gif"></td>
				<tr>
			</table>
<?
	}
?>
<?
	$temp_width = 0;
	while( $row_cate2 = mysql_fetch_array( $res_cate2 ) ){
		$k++;
		if((strlen($row_cate2[class_name])*7) > $temp_width)
			$temp_width = strlen($row_cate2[class_name]) * 7;
			
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	popHeight[<?=$i?>] += 23;
//-->
</SCRIPT>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td height="20" style="font-size:12px;"><img src="../images/menu_icon.gif" align="absmiddle">
					<a onClick="parent.location.href=href='../shop/main.php?page=view_class&class_id=<?=$row_cate2[class_id]?>'" style="cursor:hand;"><?=$row_cate2[class_name]?></a></td>
				</tr>
				<tr>
					<td height="2"><img src="../images/menu_line.gif"></td>
				<tr>
			</table>
<?
	}
	
	if($temp_width < 150)
		$temp_width = 150;
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	popWidth[<?=$i?>] = <?=$temp_width?>
//-->
</SCRIPT>
		</td>
	</tr>
</table>
</div>
</a>
<!--����޴�<?=$i?> END-->
<?
}

if( $res_cate1 ){
	mysql_free_result( $res_cate1 );
}
if( $res_cate2 ){
	mysql_free_result( $res_cate2 );
}

// $category_num ������ ������ �������� ����
$category_num = $temp_category_num;
$category_name = $temp_category_name;
?>