<?
 $site_path = "/home/yensan/public_html/bbs/"; 
  $site_url = "../bbs/"; 
   require_once($site_path."include/lib.inc.php"); 

$sQuery = "SELECT * FROM tblpopup WHERE idx='". $idx ."'";
$rs = query($sQuery, $dbcon);

if(!mysql_num_rows($rs))
{
	echo  "<script language=javascript>
				alert('�������� �ʴ� �ڷ��Դϴ�.');
				self.close();
			</script>";
}else{
	$col = mysql_fetch_array($rs);
	$idx = $col[idx];
	$visible = $col[visible];
	$subject = trim($col[subject]);
	$width = $col[width];
	$height = $col[height];
	$width = " width='". $width ."' ";
	$height = " height='". $height ."' ";
	$location_top = $col[location_top];
	if($location_top == "")
		$location_top=0;

	$location_left = $col[location_left];
	if($location_left == "")
		$location_left=0;
	$cookie = $col[cookie];
	$subject = $col[subject];
	$file1 = trim($col[file1]);

	$memo = $col[memo];
	$visit = $col[visit];
	$regdate = $col[regdate];

	query("Update tblpopup Set visit=visit+1 Where idx='". $idx ."'",$dbcon);
}

?>
<html>
<head>
<title><?=$subject?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!--
function setCookie(name, value, expire) {
	//var expire_date = new Date(expire)
	var todayDate = new Date();
	todayDate.setDate(todayDate.getDate() + expire);
	document.cookie = name+"="+ escape(value) + "; expires=" + todayDate.toGMTString(); 
	//alert(document.cookie)
}

function clearCookie(name) {//��Ű �Ҹ�
	var today = new Date()
	//���� ��¥�� ��Ű �Ҹ� ��¥�� �����Ѵ�.
	var expire_date = new Date(today.getTime() - 60*60*24*1000)
	document.cookie = name + "= " + "; expires=" + expire_date.toGMTString()
}

function controlCookie(elemnt) {//üũ ���¿� ���� ��Ű ������ �Ҹ��� �����ϴ� �Լ�
	if (elemnt.checked) {//üũ �ڽ��� �������� ��� ��Ű ���� �Լ� ȣ��
		setCookie("empcookie_popup<?=$idx?>","true",1);
	}
	else {//üũ �ڽ��� �������� ��� ��Ű �Ҹ� �Լ� ȣ��
		clearCookie("empcookie_popup<?=$idx?>");
	}
	return;
}

function goURL(url) {
	opener.location.href = url;
	self.close();
}
//-->
</SCRIPT>

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                    <!--  �̸����� ���� -->
                    <table border="0" cellspacing="0" cellpadding="0" align="center" width="100%" height="100%">
                      <tr> 
                        <td align="center" valign="top"> 
                          <table <?=$width?> <?=$height?> border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td valign=top><a href="#" onclick="opener.parent.location.href='<?=$memo?>';window.close();"><img src="../../bbs/editor/upload/<?=$file1?>" <?=$width?> <?=$height?> border=0></a></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td height="30" bgcolor="ECECEC"> 
                          <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td align="right"> 
                                <?if ($cookie==1) {?>
                                <input type=CHECKBOX name="closepop" value="" onClick="controlCookie(this)" style="border:0"><font size=2>������ �׸�����</font>&nbsp;<?}?>
								<a href="javascript:this.close();"><img src="../images/close.gif" border=0 align="absmiddle" width=13 height=13></a> 
                                &nbsp;
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                    <!--  �̸����� �� -->
</body>
</html>