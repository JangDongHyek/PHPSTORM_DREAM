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
		if(substr($data,-4,4) == ".gif" || substr($data,-4,4) == ".jpg" || substr($data,-4,4) == ".bmp") $img_flag = 1; 
		if($img_flag != 1){
			$fp=fopen("$DIR_PATH/$pos/$data", r);
	
			$content = fread($fp,1000000);
			$content = htmlspecialchars($content);
		}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
<script>
var blnBodyLoaded = false;
var blnEditorLoaded = false;

function HandleLoad() {
	blnBodyLoaded = true;
	if (blnEditorLoaded == true) {
		init();
	}
}

function setEditMode(sMode){
	var f = document.writeform;
	f.editBox.editmode = sMode;
}
function init() {
	var f = document.writeform;
	f.editmode[0].click();
	f.editBox.editmode = "html";
	f.editBox.html = f.content.value;
	f.editBox.focus();
	f.editBox.setFocus();
}


function checkform(f){
	f.editBox.editmode = "html";
	f.content.value = f.editBox.html;
	return true;
}
</script>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox>
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
</SCRIPT>
</head>

<body onload=HandleLoad() bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table border="0" width="780" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="106" valign="top">
    	<p align="left"><br>
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
      	<?
      	if($img_flag != 1){
      	?>
      	<tr>    
        	<td width="90%" bgcolor="#FFFFFF" valign="top">    
          		<p style="padding-left: 10px">
          		<font color="#0000FF"><span class="cc"><strong>[����   
          		����]</strong></span>    
              	</font>         
        	</td>           
      	</tr>           
      	<tr>          
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">            
    		</center>       
        		
	        	<table width="590"> 
	          	
	          	<form method=post  name=writeform onsubmit='return checkform(this)'>
				<input type='hidden' name='flag' value='update'>
				<input type=hidden name=pos value='<?echo $pos?>'> 
				<input type=hidden name=content value='<?echo $content?>'> 
        		<input type=hidden name=data value='<?echo $data?>'> 
        		<tr> 
	            	<td bgColor="#ffffff" height="13" vAlign="top" width="582"> 
	              		<p class="aa" style="PADDING-LEFT: 40px" align="center"><br> 
	              		<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">������ 
        				<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML �����Է� 
        				</p>  
	            	</td>  
	          	</tr>  
	          	<tr>  
	            	<td bgColor="#FFFFFF" width="582">  
	              		<p align="center">
	              		<OBJECT id=editBox data=../editor/Editorx.htm width=530 height=350 type=text/x-scriptlet></OBJECT>
					</td>  
	          	</tr>  
	        	</table>  
	    	</td>        
	  	</tr>       
		<center>        
    	<tr>        
        	<td width="100%" bgcolor="#FFFFFF" valign="top">��</td>    
    	</tr>    
    	</center>    
    	<tr> 
    		<td width="100%" bgcolor="#FFFFFF" height="25" class="aa">         
    			<p align="center">&nbsp;<span class="aa">&nbsp; </span>
    			<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�Ϸ�">&nbsp; 
    			<input class="aa" onclick='init()' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���Է�">&nbsp;
    			<input class="aa" onclick="window.location.href='ftp-main.php?pos=<?echo $pos?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ��">&nbsp;
    			&nbsp;&nbsp;
    		</td>        
 		
 		</tr>  
    	</form>       
		<?
		}
		?>
		<tr>
    	<form name='signform' method='post' action='ftp-modify.php?flag=rename'>
		<input type='hidden' name='data' value='<?echo $data?>'>
		<input type='hidden' name='pos' value='<?echo $pos?>'>
		<center>        
    		<td width="100%" bgcolor="#FFFFFF" height="25" class="aa">        
    			</center>    
         		<p align="left">   
          		<br>
          		&nbsp;&nbsp;&nbsp;
          		<span class="cc"><strong>[���ϸ� �ٲٱ�]</strong></span>
          		<span class="aa">&nbsp;���ϸ�&nbsp; 
          		<input class="aa" name="rename" value='<?echo $data?>' size="27" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">
          		</span> 
          		<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="����">
   			</td>        
		</tr>
		</form>  
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
if($flag == 'update'){
	$fp=fopen("$DIR_PATH/$pos/$data", w);
	$fw = $content;
	$fw = stripslashes($fw);
	fputs($fp,$fw);
	fclose($fp);
	echo("<meta http-equiv='Refresh' content='0; URL=ftp-main.php?pos=$pos'>");
}
if($flag == 'rename'){
	
	if (strstr($rename,'.php')){
		echo "
		<script>
		alert(\"phpȭ�Ϸ� �ٲܼ� �����ϴ�.\")
		history.go(-1);
		</script>
		";
		exit;
	}
	
	if(file_exists("$DIR_PATH/$pos/$rename")){
		error("SAME_FILE_EXIST");
		exit;
	}
	$rename_dir="$DIR_PATH/$pos/$data";
	$rename_apply=rename($rename_dir,"$DIR_PATH/$pos/$rename");
	if(!$rename_apply){
		error("RENAME_CHANGE_FAILED");
		exit;
	}
	echo("<meta http-equiv='Refresh' content='0; URL=ftp-main.php?pos=$pos'>");
}
?>
<?
mysql_close($dbconn);
?>