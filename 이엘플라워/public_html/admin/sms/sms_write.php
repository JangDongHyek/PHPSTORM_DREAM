<?
	$hpArray=explode(",",$hp);
?>
<html>
<head>
<title> SMS �޼��� ������ </title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
td { font-family: "����", "����"; font-size: 9pt;}
.box01 {font-family: "����", "����"; font-size: 9pt; background-color: #B5F3F7; border: 1px solid #B5F7F7;width:103;height:70; overflow:hidden}
.box02 {font-family: "����", "����"; font-size: 9pt; background-color: #FFFFFF; border: 1px solid #787878; overflow:hidden; padding:2}
.box03 {font-family: "����", "����";font-size: 9pt; background-color: #92E9EB; border: 1px solid #92E9EB; padding-top:1; text-align: center; vertical-align: middle;}
.t01{color:#5A7DBD}
.t02{color:#999999}
.select{ font-family: "����","����"; font-size: 8pt;}
-->
</style>
<script type="text/javascript">
	function checkForm(){
		var f=document.form;
		if(f.content.value.trim().length<1){
			alert("������ �Է��ϼ���");
			return false;
		}
		return true;
	}
</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0">
<form name="form" method="post" action="./sms_send.php" onsubmit="return checkForm()">
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td background="#6370d0" align="center" style="font-size:30px">sms ������</td>
	</tr>
</table>
<table width="100%">
	<tr>
		<!-- ������ ��ȣ ���� -->
		<td valign="top" width="50%">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td>�����ڹ�ȣ</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #000"></td>
				</tr>
				<?
					for($i=0;$i<count($hpArray);$i++){
				?>
				<input type="hidden" name="hp[]" value="<?=$hpArray[$i]?>">
				<!--<input type="text" name="hp[]" value="01042421950">-->
				<tr>
					<td style="border-bottom:1px solid #000" height="30">
						<?=$hpArray[$i]?>
					</td>
				</tr>
				<? }?>
			</table>
		</td>
		<!-- ������ ��ȣ �� -->
		<td width="30"></td>
		<!-- ������ ���� -->
		<td valign="top" align="center">
			<textarea name="content" rows="10" style="width:200px;border:1px solid #ccc;background-color:#e1e1e1"></textarea><br/><br/><br/>
			<button type="submit" style="background-color:#000;color:#fff;border:1px solid #000;padding:10px">�����ϱ�</button>
		</td>
		<!-- ������ �� -->
	</tr>
	
	</tr>
</table>
</form>
</body>
</html>
