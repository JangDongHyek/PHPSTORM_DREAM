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
include "error_msg.php";

$DIR_PATH = "$root_dir/file_manager/$Mall_Admin_ID";

if($flag==""){
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
<script>
function checkform(f){
	if(f.up_file.value == ""){
		alert("ȭ���� ������ �ּ���.");
		f.up_file.focus();
		return false;	
	}
	return true;
}
</script>
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">

<table border="0" width="780" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="106" valign="top"><p align="left"><br>
    	<br>
    	<br>
    	</p>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="100%"><img src="../images/a-ftp.gif" width="160" height="36"></td>
      	</tr>
      	<tr>
        	<td width="100%" height="1" bgcolor="#98A043"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#F2F2F2"><p style="padding-left: 5px"><span class="bb"><br>
        		<small>��</small>  <font face="����">���ϰ��������縦           
          		�̿���<br>          
          		&nbsp;&nbsp; �� ������ ���ϰ� ����&nbsp;<br>          
          		&nbsp;&nbsp; �� �� �ֽ��ϴ�.</font><br>              
        		</span>
        	</td>              
      	</tr>              
      	<tr>              
        	<td width="100%" bgcolor="#98A043" height="1"></td>              
      	</tr>              
    	</table>              
    
    	<p align="left"><br>              
    	<br>              
    </td>              
    <td width="1" bgcolor="#808080"><br>              
    </td>              
    <td width="646" bgcolor="#FFFFFF" valign="top">
    	<div align="center"><center>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">              
      	<tr>              
        	<td width="90%" bgcolor="#FFFFFF" valign="top">              
        	</td>   
      	</tr>   
      	<tr>    
        	<td width="90%" bgcolor="#FFFFFF" valign="top">    
        	</td>   
      	</tr>   
      	<tr>    
        	<td width="90%" bgcolor="#FFFFFF" valign="top">    
        	</td>           
      	</tr>           
      	<tr>          
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">            
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">            
          		
          		<form method='post' onsubmit='return checkform(this)' enctype='multipart/form-data'>
          		<input type='hidden' name='flag' value='upload'>
          		<input type='hidden' name='pos' value='<?echo $pos?>'>
          		
          		<tr>            
            		<td width="100%" bgcolor="#FFFFFF" height="5" class="aa"> 
            			<p style="padding-left:20px"><font color="#0000FF"><br>  
              			<br>  
              			<span class="cc"><strong>[���� ���ε�]<br>
              			<br>
              			</strong></span>
              			<span class="aa"><br>
              			<input class="aa" type='file' name='up_file' size="41" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span> 
              			<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="���ε�">  
              			</font>
              		</td>        
          		</tr>
          		</form>        
    			</center>      
        		</table>       
        	</td>       
      	</tr>       
        <center>       
      	<tr>       
        	<td width="100%" bgcolor="#FFFFFF" valign="top">��</td>    
      	</tr>    
    	</center>    
        <center>      
    	</table>       
    	</center></div>
	</td>       
</tr>       
</table>       
</body>       
</html>       
<?
}
if($flag == 'upload'){
	if (strstr($up_file_name,'.php')){
		echo "
		<script>
		alert(\"phpȭ���� �ø� �� �����ϴ�.\")
		history.go(-1);
		</script>
		";
		exit;
	}
	
	if($up_file_name == ""){
		error("INPUT_FILE");
		exit;
	}

	$same_file_exist=file_exists("$DIR_PATH/$pos/$up_file_name");
	if($same_file_exist){
		error("SAME_FILE_EXIST"); 
		exit;
	}
	
	if(!copy($up_file,"$DIR_PATH/$pos/$up_file_name")){
		error("FILE_UPLOAD_FAILED");
		exit;
	}
	if(!unlink($up_file)){
		error("FILE_UNLINK_FAILED");
		exit;
	}
	echo("<meta http-equiv='Refresh' content='0; URL=ftp-main.php?pos=$pos'>");
}
?>
<?
mysql_close($dbconn);
?>