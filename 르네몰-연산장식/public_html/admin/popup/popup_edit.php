<?
 $site_path = "/home/yensan/public_html/bbs/"; 
  $site_url = "http://www.renemall.co.kr/bbs/"; 
	require_once($site_path."include/lib.inc.php");
	require_once($site_path."include/schema.inc.php");

	if($mode=='edit') {
		$dbqry = "
				SELECT *
				FROM `tblpopup` where idx = '$idx'
					";

		$rs = query($dbqry, $dbcon);
		$R=mysql_fetch_array($rs);
		mysql_free_result($rs);	
		$idx = $R[idx];
		$rg_file1_name = $R[file1];
	}

	if($act) {		
		if($mode=='edit') {
		 	// ���̺� �˾� ����Ÿ ����
			$dbqry="
				UPDATE `tblpopup` SET
					`visible` = '$visible',
					`subject` = '$subject',
					`width` = '$width',
					`height` = '$height',
					`location_top` = '$top',
					`location_left` = '$left',
					`cookie` = '$cookie',
					`title` = '$title',
					`memo` = '$memo'
				WHERE `idx` = '$idx'
			";
			query($dbqry,$dbcon);
		} else {
			$regdate = strftime("", time());
			// ���̺� �˾� ����Ÿ �߰�
			$dbqry="
				INSERT INTO `tblpopup`
					(	`idx`, `visible`,`subject`,
						`width`,`height`,`location_top`,
						`location_left`,`cookie`,`title`,
						`tag`,`memo`,`regdate`				
					) 
				VALUES 
					(	'','$visible','$subject',
						'$width','$height','$top',
						'$left','$cookie','$title',
						'$tag','$memo',now()
					)
			";
			query($dbqry,$dbcon);
			$idx = mysql_insert_id();
		}

		$bbs_data_path  = "../../bbs/editor/upload/";
		// ����ó��
		for($fi=1;$fi<2;$fi++) {
			if(${"del_file{$fi}"}) {
				@unlink($bbs_data_path.${"rg_file{$fi}_name"});
				${"rg_file{$fi}_name"} = '';
			}
			
			$file = $HTTP_POST_FILES["rg_file$fi"];
			if($file[size]>0) {
				$temp=explode(".",$file[name]);
				$file[ext]=$temp[count($temp)-1];
				
				$file[server_name] = $idx.'$'.$fi.'$'.$file[name];
				
				if(${"rg_file{$fi}_name"}) {
					if(@unlink($bbs_data_path.${"rg_file{$fi}_name"})) {
						${"rg_file{$fi}_name"} = '';
					}
				}
				
				if(@copy($file[tmp_name], $bbs_data_path.$file[server_name])) {
					${"rg_file{$fi}_name"} = $idx.'$'.$fi.'$'.$file[name];
				} else {
				  // �Ϻ� �������� ���ε�� ������ ���� �ȵɰ�� �õ��Ѵ�.
					// 2003-10-15
					if(@move_uploaded_file($file[tmp_name], $bbs_data_path.$file[server_name])) {
						${"rg_file{$fi}_name"} = $idx.'$'.$fi.'$'.$file[name];
					} else {
						${"rg_file{$fi}_name"} = '';
					}
				}

				// -- copy END -- 
			}
		}

		$dbqry="
			UPDATE `tblpopup` SET
				`file1` = '$rg_file1_name'
			WHERE idx='$idx'
		";
		query($dbqry,$dbcon);

		rg_href("popup_list.php?$p_str");
	}

	if($mode!='edit') {

	}
?>
<script language="JavaScript" type="text/JavaScript">
	function all_checked(form_name,checkbox_name,chk)
	{
		eval('var f = document.'+form_name);

		for (var i=0; i<f.length; i++) { 
			if (f.elements[i].name == checkbox_name) { 
				f.elements[i].checked = chk;
			}
		}
	}
	function editor_null_content(){
	
			return true;
		
	}
</script>
<?include "../admin_head.php";?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "10";
include "../include/left_menu_layer.php"; 

?>
			<!--���ʺκ� END-->
		 </td>
		<td>

<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" align="center" bgcolor="#F7F7F7"> <font color="#404040">�˾� ����</font></td>
  </tr>
</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td style="padding-top:15px;padding-left:20px;padding-right:20px;padding-bottom:20px;">
                  <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr> 
                      <td height="8" background="/admin/images/linebg.gif"></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
					<form name=form_write action="" method="post" enctype="multipart/form-data" onSubmit="return editor_null_content();">
					<input type="hidden" name="mode" value="<?=$mode?>">
					<input type="hidden" name="act" value="ok">
                    <tr> 
                      <td> 
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="2" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>�� ��</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      <input type="text" size=40 name=title class=b maxlength="50" value="<?=$R[title]?>">
                                      &nbsp;(��50���̳�,�˾�â �������� �Է°�)</td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>����</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      <input type="radio" name="visible" value="1" style="border:0" <? echo $R[visible] ? "checked" : "";?>>
                                      ����&nbsp;&nbsp; 
                                      <input type="radio" name="visible" value="0" style="border:0" <? echo !$R[visible] ? "checked" : "";?>>
                                      ��������� &nbsp;&nbsp;<font class=small04><font color=red>�� 
                                      �˾�â�� �������� üũ</font><br>
                                      ("���������"���� ����Ͻð�, ����Ȯ�� �� "����"�� �����Ͻô°� �����ϴ�. 
                                      )</font> </td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
								  <?/*?>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>�˾�â Ÿ��Ʋ</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      <input type="text" size=40 name=subject maxlength="70" value="<?=$R[subject]?>">
                                      &nbsp;(���˾�â�� ����ٿ� ��Ÿ���ϴ�.)</td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
								  <?*/?>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>�˾�</strong><strong>â ũ��</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      ���� : 
                                      <input type="text" name=width size=3 maxlength=3 class=b value="<?=$R[width]?>">
                                      &nbsp;px&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���� 
                                      : 
                                      <input type="text" name=height size=3 maxlength=3 class=b value="<?=$R[height]?>">
                                      &nbsp;px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(�ؼ��ڸ� 
                                      �Է�) </td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>�˾�â ��ġ</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      ��ܿ��� : 
                                      <input type="text" name="top" size=3 maxlength=3 class=b value="<?=$R[location_top]?>">
                                      &nbsp;px&nbsp;&nbsp;&nbsp;&nbsp;���ʿ��� : 
                                      <input type="text" name="left" size=3 maxlength=3 class=b value="<?=$R[location_left]?>">
                                      &nbsp;px &nbsp;&nbsp;(�ؼ��ڸ� �Է�) </td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>��Ű��� ����</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      <input type="radio" name="cookie" value="1" style="border:0" <? echo $R[visible] ? "checked" : "";?>>
                                      ��&nbsp;&nbsp; 
                                      <input type="radio" name="cookie" value="0" style="border:0" <? echo !$R[visible] ? "checked" : "";?>>
                                      �ƴϿ�&nbsp;(�ؿ��� �Ϸ� �˾�â ���� ���� ǥ�� ����) </td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                </table>
                                <br>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>�̹���</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      <input type="file" name="rg_file1" size="55"><BR>
                                      (���˾�â ������� �°� �ø�����)
<? if($R[file1]) {?>
									  <br>
									  <input type="checkbox" name="del_file1" value="1"> ���� (<?=$R[file1]?>)
<? } ?>
                                    </td>
                                  </tr>
								  
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>��ũ�ּ�</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 

                                      <input type="text" name="memo" size=60 value="<?=$R[memo]?>">
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                </table>
                              </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td align="center"><input type="submit" name="Submit2" value=" Ȯ     �� " style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"><!--  
						<input type="image" src="/admin/images/bt_004.gif" align="absbottom" style="border:0"> 
                        &nbsp;<img src="/admin/images/bt_003.gif" align="absbottom" onClick="document.regfrm.reset();document.regfrm.title.focus()" style="cursor:hand" name="Submit2">
						&nbsp;<img src="/admin/images/bt_012.gif" border="0" align="absbottom" style="cursor:hand" onClick="javascript:location.href='list.asp';" name="backbutton"> -->
                      </td>
                    </tr>
					</form>
                  </table>
                </td>
              </tr>
            </table>
<Td>
</tr>
</table>
</body>