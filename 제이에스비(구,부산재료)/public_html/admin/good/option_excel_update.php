<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title> New Document </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
 </head>

 <body>

	
	

 <table width="100%" cellpadding="0" cellspacing="0">
	 <form name="frm" method="post" action="option_excel_update2.php" enctype="multipart/form-data">
	 <input type="hidden" name="item_no" value="<?=$item_no?>">
	 <input type="hidden" name="no" value="<?=$no?>">
	 <tr>
		<td><input type="file" name="ex_file"></td>
		<td><input type="submit" value="업데이트"></td>
	</tr>
	  </form>
 </table>
 <table width="100%" cellpadding="0" cellspacing="1" bgcolor="#cccccc">
	<tr>
		<td bgcolor="#ffffff">
			사용방법 및 주의사항
		</td>
	</tr>
	<tr>
		<td bgcolor="#ffffff">
			1. xls 파일이나 xlsx파일을 업로드 하시면 업데이트가 되지 않습니다.<br>
			다른 이름으로 저장을 하여 csv로 확장자를 변경하셔야 업데이트가 가능합니다.<br>
			2. 상품번호를 지우시면 상품업데이트가 안 되므로 절대로 지우지 마시길 바랍니다.<br>
			3. 엑셀로 저장할 시 절대로 따음표(')(")나 콤마(,) 같은 특수기호는 업데이트 할 때<br>
			문제가 생기므로 입력하시면 안 됩니다.
			4. 옵션을 추가로 넣고 싶으시면 옵션번호를 삭제하시면 됩니다.
		
		</td>
	</tr>
 </table>
 </body>
</html>
