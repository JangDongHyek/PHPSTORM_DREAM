<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<?
if (isset($flag) == false) {
	if (isset($prevno) == false) $prevno = 0;
	
	$SQL = "select * from $New_BoardConfigTable where bbs_no = $bbs_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		@mysql_data_seek($dbresult,$i);
		$ary = mysql_fetch_array($dbresult);
		$bbs_no = $ary["bbs_no"];
		$mart_id = $ary["mart_id"];
		$board_title = $ary["board_title"];
		$board_comment = $ary["board_comment"];
		$board_date = $ary["board_date"];
		$comment_ok = $ary["comment_ok"];
		$item_fg_color = $ary["item_fg_color"];
		$item_bg_color = $ary["item_bg_color"];
		$table_fg_color = $ary["table_fg_color"];
		$table_bg_color = $ary["table_bg_color"];
		$headhtml = $ary["headhtml"];
		$tailhtml = $ary["tailhtml"];
		$top_body = $ary["top_body"];
		$bottom_body = $ary["bottom_body"];
		$board_class = $ary["board_class"];
		$pagecount = $ary["pagecount"];
		$if_use_secret = $ary["if_use_secret"];
		$userfile_use = $ary["userfile_use"];
		$list_type = $ary["list_type"];
	}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
<script>
var cPicker = null;
function checkform(f){
	if(f.board_title.value == ""){
		alert("�Խ��� ������ �Է��ϼ���.");
		f.board_title.focus();
		return false;
	}
	if(f.board_comment.value == ""){
		alert("�Խ��� ������ �Է��ϼ���.");
		f.board_comment.focus();
		return false;
	}
	if(f.pagecount.value == ""){
		alert("�������� �Խù� ���� �Է��ϼ���.");
		f.pagecount.focus();
		return false;
	}
	if(f.pagecount.value == '0'){
		alert("�������� �Խù� ���� 0���� Ŀ���մϴ�.");
		f.pagecount.focus();
		return false;
	}
	return true;
}
function colorPicker(formname, target) {
	if (cPicker!=null && !cPicker.closed) {
		return;
	}
	var url = 'color_sel.php?formname='+formname+'&target='+target;
	cPicker = window.open(url, "������", "fullscreen=no,titlebar=no,toolbar=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=320,height=290")
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
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">�Խ��ǰ���</span> &gt; <span class="text_gray2_c">�Խ��ǰ���</span></div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;�����ڸ�忡 �����ϼ̽��ϴ�.</span></div></td>
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
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "8";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�Խ��ǰ���</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top">�Խ����� ���� ���ϸ鼭��, ���� ���� �߿��� ������ Ŀ�´����̼� ���Դϴ�.&nbsp;<br>
					�׸��� �ѹ� ������ �Խ����� ������ �Ұ����Ͽ��� ������ �����Ͻñ� �ٶ��ϴ�.&nbsp;
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#5A96BD" height="1" valign="top"></td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top"align="center">
        		
        		<table border="0" width="95%">     
          		<tr>     
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">     
              			<tr>     
                			<td width="100%" bgcolor="#8FBECD" colspan="5">
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">     
                  				<tr>     
                    				<td width="50%">&nbsp; <strong><span class="dd">�Խ���  
                      					����</span></strong></td>     
                    				<td width="50%"></td>     
                  				</tr>     
                				</table>     
                			</td>     
              			</tr>     
        				</center>  
    					</center>     
              			</center>  
    					</center>     
              			
              			<form method='post' name='writeform' onsubmit='return checkform(this)'>
              			<input type='hidden' name='flag' value='update'>
              			<input type='hidden' name='bbs_no' value='<?=$bbs_no?>'>
              			
              			<tr>     
                			<td width="11%" bgcolor="#FFFFFF" align="left">
                				<span class="aa"><p align="left">
                				�Խ��� ����</span></td>    
                				<center><center>    
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<span class="aa"><input name="board_title" value = '<?=$board_title?>' size="66" style="border: 1px solid rgb(136,136,136)" class="aa">  
                  				</span>
                  			</td>    
              			</tr>    
              			<tr>    
                			<td width="11%" bgcolor="#FFFFFF" align="left">
                				<span class="aa">
                				�Խ��� ����</span></td>   
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<span class="aa"><input name="board_comment" value = '<?=$board_comment?>' size="66" style="border: 1px solid rgb(136,136,136)" class="aa">  
                  				</span> 
                  			</td>    
              			</tr>    
              			<tr>    
                			<td width="11%" bgcolor="#FFFFFF" align="left">
                				<span class="aa">
                				�������� �Խù� ��</span></td>    
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<span class="aa">
                				<input name="pagecount" value = '<?=$pagecount?>'size="5" style="border: 1px solid rgb(136,136,136)" class="aa">  
                  				��
                  				<input class='bb' type='checkbox' name='if_use_secret' value='1'
                  				<?
                  				if($if_use_secret == '1') echo " checked";
                  				?>
                  				>��� ��� ���
                  				</span> 
                  			</td>    
              			</tr>    
              			<tr>    
                			<td width="11%" bgcolor="#FFFFFF" align="left"><span class="aa">�ϹݰԽ���</span></td>   
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<input type="radio" name="board_class" value="0"
                				<?if($board_class == 0) echo " checked";?>>ȸ��/��ȸ�� 
                  				��� �а�,���� �ִ� �Խ����Դϴ�.<br> 
                  				��) �����Խ��� / A.S�Խ���/ ��ǰ����� 
                			</td>    
              			</tr>    
              			<tr>    
                			<td width="11%" bgcolor="#FFFFFF" align="left"><span class="aa">ȸ�����Խ��� 1</span></td>    
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<input type="radio" name="board_class" value="1"
                				<?if($board_class == 1) echo " checked";?>>ȸ���� 
                  				�а� ���� �ִ� �Խ����Դϴ�.&nbsp;&nbsp; ��) ȸ������ �Խ���/ 
                  				�系 ��Ʈ���</td>    
              			</tr>
              			<tr>    
                			<td width="11%" bgcolor="#FFFFFF" align="left"><span class="aa">ȸ�����Խ��� 2</span></td>    
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<input type="radio" name="board_class" value="3"
                				<?if($board_class == 3) echo " checked";?>>ȸ���� �б�,���Ⱑ��/��ȸ���� �бⰡ��</td>    
              			</tr>   
              			<tr>    
                			<td width="11%" bgcolor="#FFFFFF" align="left"><span class="aa">����������Խ���</span></td>   
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<input type="radio" name="board_class" value="2"
                				<?if($board_class == 2) echo " checked";?>>�����ڸ� �۾��Ⱑ �����մϴ�.&nbsp; 
                  				��) ��������
							</td>    
              			</tr>
              			<tr>    
                			<td width="11%" bgcolor="#FFFFFF" align="left"><span class="aa">���� ���</span></td>   
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<input type="radio" name="comment_ok" value="y" <?if($comment_ok=="y"){echo ("checked");}?>>��� <input type="radio" name="comment_ok" value="n" <?if($comment_ok=="n"){echo ("checked");}?>>������
							</td>    
              			</tr>						
              			<tr>    
                			<td width="11%" bgcolor="#FFFFFF" align="left" rowspan="2">
                				<span class="aa">���̺���</span></td>   
                			<td width="10%" bgcolor="#FFFFFF" align="left" class="aa">
                				�׸� ����</td>   
                			<td width="11%" bgcolor="#FFFFFF" align="left" class="aa">
                				<span class="aa"> 
                				<input name="item_bg_color" value='<?=$item_bg_color?>' size="10" style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span>
                				<a href="javascript:colorPicker('writeform', 'item_bg_color')"><img src="../images/pick.gif" border='0'></a>
                			</td>   
                			<td width="11%" bgcolor="#FFFFFF" align="left" class="aa">
                				��� ����</td>   
                			<td width="10%" bgcolor="#FFFFFF" align="left" class="aa">
                				<span class="aa"> 
                				<input name="table_bg_color" value='<?=$table_bg_color?>' size="10" style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span>
                				<a href="javascript:colorPicker('writeform', 'table_bg_color')"><img src="../images/pick.gif" border='0'></a>
                			</td>   
              			</tr>   
              			<tr>   
                			<td width="10%" bgcolor="#FFFFFF" align="left" class="aa">
                				�׸� ���ڻ�</td>   
                			<td width="11%" bgcolor="#FFFFFF" align="left" class="aa">
                				<span class="aa"> 
                				<input name="item_fg_color" value='<?=$item_fg_color?>' size="10" style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span>
                				<a href="javascript:colorPicker('writeform', 'item_fg_color')"><img src="../images/pick.gif" border='0'></a>
                			</td>   
                			<td width="11%" bgcolor="#FFFFFF" align="left" class="aa">
                				��� ���ڻ�</td>   
                			<td width="10%" bgcolor="#FFFFFF" align="left" class="aa">
                				<span class="aa"> 
                				<input name="table_fg_color" value='<?=$table_fg_color?>' size="10" style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span>
                				<a href="javascript:colorPicker('writeform', 'table_fg_color')"><img src="../images/pick.gif" border='0'></a>
                			</td>   
              			</tr> 
              			<tr>   
                			<td width="11%" bgcolor="#FFFFFF" align="left">
                				<span class="aa">�Խ��� ��ܿ� �ҷ��� ����</span>
							</td>   
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<input name="top_body" value='<?=$top_body?>' size="50" style="border: 1px solid rgb(136,136,136)" class="aa">
							</td>   
              			</tr>						
              			<tr>   
                			<td width="11%" bgcolor="#FFFFFF" align="left">
                				<span class="aa">�Խ��� ��� HTML</span>
							</td>   
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<textarea class="aa" cols="41" name="headhtml" rows="3" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; FONT-SIZE: 9pt; WIDTH: 100%"><?=htmlspecialchars($headhtml)?></textarea>
							</td>   
              			</tr>
              			<tr>   
                			<td width="11%" bgcolor="#FFFFFF" align="left">
                				<span class="aa">�Խ��� �ϴܿ� �ҷ��� ����</span>
							</td>   
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<input name="bottom_body" value='<?=$bottom_body?>' size="50" style="border: 1px solid rgb(136,136,136)" class="aa">
							</td>   
              			</tr>
              			<tr>   
                			<td width="11%" bgcolor="#FFFFFF" align="left">
                				<span class="aa">�Խ��� �ϴ� HTML</span>
							</td>   
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<textarea class="aa" cols="41" name="tailhtml" rows="3" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; FONT-SIZE: 9pt; WIDTH: 100%"><?=htmlspecialchars($tailhtml)?></textarea>
							</td>   
              			</tr>
              			<tr>   
                			<td width="11%" bgcolor="#FFFFFF" align="left">
                				<span class="aa">÷������ ���</span>
							</td>   
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<input type="radio" name="userfile_use" value="y"
                				<?if($userfile_use == y) echo " checked";?>>���&nbsp;
								<input type="radio" name="userfile_use" value="n"
                				<?if($userfile_use == n) echo " checked";?>>������
							</td>   
              			</tr>
						<tr>   
                			<td width="11%" bgcolor="#FFFFFF" align="left">
                				<span class="aa">����Ʈ ����</span>
							</td>   
                			<td width="42%" bgcolor="#FFFFFF" align="left" class="aa" colspan="4">
                				<input type="radio" name="list_type" value="NL"
                				<?if($list_type == 'NL') echo " checked";?>>�Ϲ���&nbsp;
								<input type="radio" name="list_type" value="GT"
                				<?if($list_type == 'GT') echo " checked";?>>������(�̸�����)&nbsp;
								<input type="radio" name="list_type" value="GL"
                				<?if($list_type == 'GL') echo " checked";?>>������(���)
							</td>   
              			</tr> 	
            			</table>   
            			</center></center>   
            		</td>   
          		</tr>   
        		</table>   
          		</div>   
        		</div>
        	</td>   
      	</tr>   
      	<tr align="center">   
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><span class="aa"><br>
          		&nbsp;</span>
          		<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="��������">&nbsp;
          		<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="��������">&nbsp;
          		<input onClick="window.location.href='admin_board_list.php'" class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ��">
          	</td>  
      	</tr>
      	</form>    
    	</table> 
		
<br>
			<!--���� END~~-->
		</td>
	</tr>
</table>    
</body>     
</html>     
<?
}
else if($flag == "update"){
	$sql1 = "update $New_BoardConfigTable set board_title = '$board_title', board_comment = '$board_comment', item_fg_color = '$item_fg_color', item_bg_color = '$item_bg_color', table_fg_color = '$table_fg_color', table_bg_color = '$table_bg_color', comment_ok='$comment_ok', headhtml = '$headhtml', tailhtml = '$tailhtml', top_body='$top_body', bottom_body='$bottom_body', board_class = '$board_class', userfile_use='$userfile_use', pagecount = '$pagecount', if_use_secret='$if_use_secret', list_type='$list_type' where bbs_no = $bbs_no and mart_id='$mart_id'";

	$dbresult = mysql_query($sql1, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=$PHP_SELF?bbs_no=$bbs_no'>";
}
?>
<?
mysql_close($dbconn);
?>