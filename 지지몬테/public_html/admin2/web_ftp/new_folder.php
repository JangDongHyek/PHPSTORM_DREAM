<?
//================== DB 설정 파일을 불러옴 ===============================================
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
	if(f.creat_dir.value == ""){
		alert("폴더명을 입력하세요.");
		f.creat_dir.focus();
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
        		<small>▶</small>  <font face="돋움">파일관리마법사를            
          		이용하<br>           
          		&nbsp;&nbsp; 여 파일을 편리하게 관리&nbsp;<br>           
          		&nbsp;&nbsp; 할 수 있습니다.</font><br>               
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
              	<p style="padding-left:10px"><span class="aa"><br>         
              	</span>         
        	</td>           
      	</tr>           
      	<tr>          
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">            
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">            
          		
          		<form method='post' onsubmit='return checkform(this)'>
          		<input type='hidden' name='flag' value='make'>
          		<input type='hidden' name='pos' value='<?echo $pos?>'>
          		
          		<tr>            
            		<td width="100%" bgcolor="#FFFFFF" height="5" class="aa"> 
            			<p style="padding-left:20px"><br>  
              			<span class="cc"><strong>[새폴더 생성]<br>
              			<br>
              			</strong>
              			<font color="#0000FF">현재위치:</font>&nbsp;
            			<font color="#0000FF"><?echo "$DIR_PATH$pos"?><br> 
              			<br> 
              			</font>
              			</span><span class="aa"><br>
              			폴더명 : 
              			<input class="aa" name="creat_dir" size="13" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">
              			</span> 
              			<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="생성">   
              			<br>   
					</td>         
          		</tr>         
    			
    			</form>
    			
    			</center>       
        		</table>        
        	</td>        
      	</tr>        
        <center>        
    	</center>     
        <center>       
      	<tr align="center">        
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>        
      	</tr>        
    	</table>        
    	</center></div>
    </td>        
</tr>        
</table>        
</body>        
</html>        
<?
}
if($flag == 'make'){
	$dir="$DIR_PATH/$pos/$creat_dir";
	if(is_dir($dir)){
		error("SAME_DIR_EXIST");
		exit;
	}
	else if(!mkdir($dir,0777)){
		error("SAME_DIR_EXIST");
		exit;
	}else{
		echo("<meta http-equiv='Refresh' content='0; URL=ftp-main.php?pos=$pos'>");
	}
}
?>
<?
mysql_close($dbconn);
?>