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
$SQL = "select service_name from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	$service_name = mysql_result($dbresult,0,0);
}
	
$DIR_PATH = "$root_dir/file_manager/$Mall_Admin_ID";
$real_path = realpath ("$DIR_PATH/$pos");
$pos = str_replace("$DIR_PATH","", "$real_path");
						
$low = 0; 
if($flag=='remove'){
	$remove_target = "$DIR_PATH$pos/$data";
	if(is_dir($remove_target)){
		if(!rmdir($remove_target));
	}else{
		if(!unlink($remove_target));
	}
	
	if($data){
		echo("<meta http-equiv='Refresh' content='0; URL=ftp-main.php?pos=$pos'>");
	}else{
		error("NOT_EXECUTE");
	}
	exit;
}

function finder($src,$dst) { 
 	global $low;
 	$handle = opendir($src);                      	// Opens source dir. 
 	if($src == $dst) {
 		$low = 1;
 	}
 	while ($file = readdir($handle)) { 
    	if (($file!=".") and ($file!="..")) {   	// Skips . and .. dirs 
        	$srcm = $src."/".$file; 
        	if($srcm == $dst){ 
 				$low = 1;
          	}              
          	if (is_dir($srcm)) {                	// If another dir is found 
          		finder($srcm,$dst);             	// calls itself - recursive WTG 
       		} else { 
          		     				// Is just a copy procedure is needed 
       		}                                    	// comment out this line 
    	} 
 	} 
 	return $low;
}

// ȭ�� �ű�� �ҽ�.
function mover($src,$dst) { 
 	if($src == $dst) exit;
 	$handle = opendir($src);                      	// Opens source dir. 
 	if (!is_dir($dst)&&!file_exists ($dst)) {
 		mkdir($dst,0755);       		// Make dest dir. 	
 		$madedir = 1;
 	}
 	while ($file = readdir($handle)) { 
    	if (($file!=".") and ($file!="..")) {   	// Skips . and .. dirs 
        	$srcm=$src."/".$file; 
        	$dstm=$dst."/".$file; 

    		if (is_dir($srcm)){                	// If another dir is found 
          		mover($srcm,$dstm);             	// calls itself - recursive WTG 
       		}else{ 
          		if(copy($srcm,$dstm)){ 
          			unlink($srcm);
          		}                   				// Is just a copy procedure is needed 
       		}                                    	// comment out this line 
    	} 
 	} 
 	closedir($handle); 
 	if($madedir == 1) {
 		rmdir($src);
	}
}

// ���� ��뷮 ���
function size_sum($src) { 
 	global $file_size_sum;
 	$handle = opendir($src);                      	// Opens source dir. 
 	while ($file = readdir($handle)) { 
    	if (($file!=".") and ($file!="..")) {   	// Skips . and .. dirs 
        	$srcm=$src."/".$file; 
    		if (is_dir($srcm)){                	// If another dir is found 
          		size_sum($srcm);             	
       		}else{ 
          		$file_size=filesize("$srcm");       
       			$file_size_sum += $file_size;
       		}                                    	
    	} 
 	} 
 	closedir($handle); 
	return $file_size_sum;
}

function PrintDir($DIR_PATH, $directory) {
	$thisdir = array("name", "struct");
	$thisdir['name'] = $directory;
	$opt_dir = str_replace($DIR_PATH, "", $directory);
	if($opt_dir == "") $opt_dir ="/";
	echo "<option value='$opt_dir'>$opt_dir</option>";
	if ($dir = @opendir($directory)) {
	  $i = 0;
		while ($file = readdir($dir)) {
			if (($file != ".")&&($file != "..")) {
				$tempDir = $directory."/".$file;
				if (is_dir($tempDir)) {
				  $thisdir['struct'][] = PrintDir($DIR_PATH, $tempDir,$file);
				} else {
				  $thisdir['struct'][] = $file;
				} 
		  	$i++;
			} 
		} 
		if ($i == 0) {
		  // empty directory
		  $thisdir['struct'] = -2;
		}
	} else {
	  // directory could not be accessed
		$thisdir['struct'] = -1;
	}
	return $thisdir;
}

$directory = $DIR_PATH;
if($flag == ""){
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">

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
    	<br><br>
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">           
      	<tr>           
        	<td width="90%" bgcolor="#FFFFFF" valign="top" colspan="2">           
        	</td>   
      	</tr>   
      	<tr>    
        	<td width="90%" bgcolor="#FFFFFF" valign="top" colspan="2">    
        	</td>   
      	</tr>   
      		<tr>        
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top" colspan="2">          
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">          
          		<tr>          
            		<td width="100%" bgcolor="#FFFFFF" height="5" class="aa" colspan="2"> 
            			<p style="padding-left:20px"><font color="#0000FF">������ġ:</font>&nbsp;
            			<font color="#0000FF"><?echo "$DIR_PATH$pos"?><br> 
              			<br> 
              			</font>
              		</td>       
          		</tr>       
          		</table>      
        	</td>      
      	</tr>      
        <center>      
      	<tr>      
        	<td width="100%" bgcolor="#FFFFFF" valign="top" colspan="2">
        		<div align="center">
        		<center>
        		
        		<table border="0" width="95%">      
          		<form name='writeform' method='post'>
          		<input type='hidden' name='flag' value='move'>
          		<input type='hidden' name='pos' value='<?echo $pos?>'>
          		<tr>      
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">      
		              	<tr>      
		                	<td width="36%" bgcolor="#8FBECD" align="center" class="dd">���ϸ�      
		                	</td>      
		                	<td width="13%" bgcolor="#8FBECD" align="center" class="dd">����ũ��      
		                	</td>      
		                	<td width="9%" bgcolor="#8FBECD" align="center" class="dd">����      
		                	</td>      
		                	<td width="9%" bgcolor="#8FBECD" align="center" class="dd">����      
		                	</td>      
		                	<td width="33%" bgcolor="#8FBECD" align="center" class="dd">���      
		                	</td>      
		              	</tr>      
		              	<?
		              	$files = opendir("$DIR_PATH$pos");
						$file_size_sum = size_sum("$DIR_PATH");
						while($file_list = readdir($files)) {
							$file_size=filesize("$DIR_PATH$pos/$file_list");
							$file_size_frm = number_format($file_size);
							$file_sum+=$file_size; // ���� �ѻ��뷮(byte����ǥ��)
							
							//���α׷� ���࿡ ����Ǵ� ���� �����
							//if($file_list != "." && $file_list != ".."){
							if($file_list == ".." && $pos == "") continue;
							if($file_list != "."){ 
								$dir_check = is_dir("$DIR_PATH$pos/$file_list");  //���丮���� Ȯ���Ѵ� 1�̸�
								//echo "file_list=$file_list";
								echo ("
						<tr>      
		                	<td width='36%' bgcolor='#FFFFFF' class='aa'>
		                		");
		                		
		                		if($file_list != ".."){
		                			echo ("
		                		<font face='����'>
		                		<input name='filename[]' type='checkbox' value='$file_list' class='aa'></font>
		                			");
		                		}
		                		if($dir_check == 1){	
		                			echo ("<img border='0' src='../images/ex.gif' width='16' height='14'>");
		                  		}
		                  		else{
		                  			echo ("<img border='0' src='../images/html.gif' width='16' height='14'>");
		                  		}	
		                  	
		                  		if($dir_check == 1){	
		                  			echo ("
		                  		<a href='ftp-main.php?pos=$pos/$file_list&data=$file_list&dir_check=$dir_check&dir_delkey=$dir_delkey'>
		                  			$file_list</a>       
		                  		");
		                		}
		                		else{
		                			echo ("
		                		$file_list
		                			");
		                		}
		                		echo ("
		                	</td>       
		                	<td width='13%' bgcolor='#FFFFFF' align='center' class='aa'>
		                		$file_size_frm [byte]      
		                	</td>
		                	<td width='9%' bgcolor='#FFFFFF' align='center'>
		                	");       
		                		if($dir_check == 0){
		                			echo ("
		                		<a href='ftp-modify.php?pos=$pos&data=$file_list'>
		                		<img border='0' src='../images/m.gif' width='20' height='18'>
		                		</a>
		                			");
		                		}
		                		echo ("       
		                	</td>
		                	<td width='9%' bgcolor='#FFFFFF' align='center'>
		                		");
		                		
		                		if($file_list != ".."){
		                			echo ("
		                		<a href='ftp-main.php?flag=remove&pos=$pos&data=$file_list&dir_check=$dir_check' onClick=\"return confirm('${file_list}�� �����Ͻðڽ��ϱ�? ')\">
		                		<img border='0' src='../images/d.gif' width='20' height='18'>       
		                		</a>
		                			");
		                		}
		                		
		                		echo ("	
		                	</td>       
		                	<td width='33%' bgcolor='#FFFFFF'>
		                		");
		                		if($file_list != ".."){
		                			echo ("
		                		<span class='aa'>
		                		<input class='aa' name='login_pnum' value='$home_dir/file_manager/$Mall_Admin_ID$pos/$file_list' size='28' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid'></span>       
		                			");
		                			
		                		}
		                		echo ("
		                	</td>       
		              	</tr>      
		              			");
		              		}
		              	} 
		              	$file_sum_k = $file_size_sum/1000; //kbyte������ǥ����	
		              	?>
						</table>   
            		</td>   
				</tr>   
        		</table>   
        		</center></div>
			</td>   
		</tr>   
		</center>   
		<tr>
		<center>        
			<td width="40%" bgcolor="#FFFFFF" height="25" class="aa">        
    			</center>    
        		<p style="padding-left:20px" align="left">
        		<?
        		if($service_name == 'free_base') $quota_limit = 10;
        		else {
        			if($Mall_Admin_ID == 'pdazzle')
        				$quota_limit = 100;
        			else
        				$quota_limit = 50;
        		}
        		if($file_sum_k > $quota_limit*1000) {
        		?>
        		<input class="aa" onclick='alert("��뷮�� �ʰ��Ͽ����ϴ�.")' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="������ ����">&nbsp;
        		<input class="aa" onclick='alert("��뷮�� �ʰ��Ͽ����ϴ�.")' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="������ ����">&nbsp;
        		<input class="aa" onclick='alert("��뷮�� �ʰ��Ͽ����ϴ�.")' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Ͼ��ε�">&nbsp;&nbsp;  
        		<?
        		}
        		else{
        		?>
        		<input class="aa" onclick="window.location.href='new_folder.php?pos=<?echo $pos?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="������ ����">&nbsp;
        		<input class="aa" onclick="window.location.href='new_file.php?pos=<?echo $pos?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="������ ����">&nbsp;
        		<input class="aa" onclick="window.location.href='new_upload.php?pos=<?echo $pos?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Ͼ��ε�">&nbsp;&nbsp;  
        		<?
        		}
        		?>
        		
        	</td>       
    		<td width="60%" bgcolor="#FFFFFF" height="25" class="aa"> 
    			<p align="left">  
        		���� �� �����̵� <span class="bb">
        		<select class="aa" name="target" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">   
        		<?
    			//echo "dir=$directory";
    			PrintDir($DIR_PATH, $directory);
    			?>
        		</select></span>
        		<span class="aa">&nbsp; </span>
        		<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�̵�">
        		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
			</td>       
		</tr>
		</form> 
		<?
		$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
		//echo "sql=$SQL";
		$dbresult = mysql_query($SQL, $dbconn);
		if(mysql_num_rows($dbresult)>0){
			$shopname = mysql_result($dbresult, 0, "shopname");
			$name = mysql_result($dbresult, 0, "name");
			$passport = mysql_result($dbresult, 0, "passport");
			$tel1 = mysql_result($dbresult, 0, "tel1");
			$tel2 = mysql_result($dbresult, 0, "tel2");
			$email = mysql_result($dbresult, 0, "email");
			$place = mysql_result($dbresult, 0, "place");
			
		}
		?>
		<tr>    
        	<td width="90%" bgcolor="#FFFFFF" valign="top" colspan="2">    
          		<br>
          		<br>
          		<ul> 
            	<li> 
              	<p style="padding-left:10px"><span class="aa"><?echo $name?>����        
              	���� �ѿ뷮�� <input class="aa" name="login_pnum" size="4" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" value="<?echo $quota_limit?>" readonly>        
              	MB�̸�,&nbsp; ���� ���� <input class="aa" name="login_pnum" value='<?echo number_format($file_sum_k)?>' size="4" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">&nbsp;Kb��        
              	������Դϴ�.</span></li>       
            	<li>       
              	<p style="padding-left:10px"><span class="aa"><?echo $name?>����        
              	�����ּҴ� <a href="http://211.174.51.11/~<?if($Mall_Admin_ID == "69i") echo "i"?><?echo $Mall_Admin_ID?>">http://211.174.51.11/~<?if($Mall_Admin_ID == "69i") echo "i"?><?echo $Mall_Admin_ID?></a>�̸�,        
              	�������������� ��û�ϼ��� ��쿡�� http://��û������/~<?if($Mall_Admin_ID == "69i") echo "i"?><?echo $Mall_Admin_ID?>�Դϴ�</a></span></li>       
            	<li>       
              	<p style="padding-left:10px"><span class="aa">������        
              	���ϰ��� ! ���� ���� ���� ���īƮ��        
              	���ϰ��������縦 �̿��Ͽ� ���ϰ�        
              	�����ϼ���.</span><span class="aa"><br>       
              	</span></li>       
          		</ul>       
        	</td>         
      	</tr>         
      <tr>    
			<td width="40%" bgcolor="#FFFFFF" valign="top" class="aa">   <p style="padding-left:20px"></td>       
    		<td width="60%" bgcolor="#FFFFFF" valign="top" class="aa">    
    			<p align="right">��
			</td>       
		</tr>       
    	<center>      
		<tr align="center">       
        	<td width="100%" bgcolor="#FFFFFF" valign="top" colspan="2"></td>       
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
if($flag == 'move'){
	
	for($i=0; $i<count($filename); $i++) {
		$low = 0;
		$new_source = $DIR_PATH.$pos."/".$filename[$i];
		$new_target = $DIR_PATH.$target."/".$filename[$i];
		$new_target1 = $DIR_PATH.$target;
				
		if(is_dir($new_source)){
			if(!finder($new_source, $new_target1)){
				mover($new_source, $new_target);
			}
		}
		else{ 
			if(!file_exists ($new_target)){
				if(copy($new_source, $new_target)){
					unlink($new_source);      
				}
			}
		}
	}

	echo("<meta http-equiv='Refresh' content='0; URL=ftp-main.php?pos=$pos'>");
	exit;
}
?>
<?
mysql_close($dbconn);
?>