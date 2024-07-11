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
 	if($src == $dst){
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

// 화일 옮기는 소스.
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

    		if (is_dir($srcm)) {                	// If another dir is found 
          		mover($srcm,$dstm);             	// calls itself - recursive WTG 
       		} else { 
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

// 계정 사용량 계산
function size_sum($src) { 
 	global $file_size_sum;
 	$handle = opendir($src);                      	// Opens source dir. 
 	while ($file = readdir($handle)) { 
    	if (($file!=".") and ($file!="..")) {   	// Skips . and .. dirs 
        	$srcm=$src."/".$file; 
    		if (is_dir($srcm)) {                	// If another dir is found 
          		size_sum($srcm);             	
       		} else { 
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

<table border="0" width="646" cellspacing="0" cellpadding="0" height="100%">
<tr>
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
            			<p style="padding-left:20px"><font color="#0000FF">현재위치:</font>&nbsp;
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
		                	<td width="36%" bgcolor="#8FBECD" align="center" class="dd">파일명      
		                	</td>      
		                	<td width="13%" bgcolor="#8FBECD" align="center" class="dd">파일크기      
		                	</td>      
		                	<td width="51%" bgcolor="#8FBECD" align="center" class="dd">경로      
		                	</td>      
		              	</tr>      
		              	<?
		              	$files = opendir("$DIR_PATH$pos");
						$file_size_sum = size_sum("$DIR_PATH");
						while($file_list = readdir($files)) {
							$file_size=filesize("$DIR_PATH$pos/$file_list");
							$file_size_frm = number_format($file_size);
							$file_sum+=$file_size; // 파일 총사용용량(byte단위표시)
							
							//프로그램 실행에 관계되는 파일 숨기기
							//if($file_list != "." && $file_list != ".."){
							if($file_list == ".." && $pos == "") continue;
							if($file_list != "."){ 
								$dir_check = is_dir("$DIR_PATH$pos/$file_list");  //디렉토리인지 확인한다 1이면
								//echo "file_list=$file_list";
								echo ("
						<tr>      
		                	<td width='36%' bgcolor='#FFFFFF' class='aa'>
		                		");
		                		
		                		if($file_list != ".."){
		                			echo ("
		                		<font face='굴림'>
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
		                  		<a href='ftp-main-win.php?pos=$pos/$file_list&data=$file_list&dir_check=$dir_check&dir_delkey=$dir_delkey'>
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
		                	<td width='51%' bgcolor='#FFFFFF'>
		                		");
		                		if($file_list != ".."){
		                			if($Mall_Admin_ID == "69i"){
		                				echo ("
		                		<span class='aa'>
		                		<input class='aa' name='login_pnum' value='http://211.174.51.11/~i$Mall_Admin_ID/data$pos/$file_list' size='46' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid'></span>       
		                				");
		                			}
		                			else{
		                				echo ("
		                		<span class='aa'>
		                		<input class='aa' name='login_pnum' value='http://211.174.51.11/~$Mall_Admin_ID/data$pos/$file_list' size='46' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid'></span>       
		                				");
		                			}
		                		}
		                		echo ("
		                	</td>       
		              	</tr>      
		              			");
		              		}
		              	} 
		              	$file_sum_k = $file_size_sum/1000; //kbyte단위로표시함	
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
        	<td width="90%" bgcolor="#FFFFFF" valign="top" colspan="2">    
          		<br>
          		<ul> 
            	<li>       
              	<p style="padding-left:10px"><span class="aa">
              	경로의 주소를 선택한 후 Ctrl+C 또는 마우스 우측버튼으로 복사후 사용하세요.
              	</li>       
            	</ul>       
        	</td>         
      	</tr>         
      <tr>    
			<td width="40%" bgcolor="#FFFFFF" valign="top" class="aa">   <p style="padding-left:20px"></td>       
    		<td width="60%" bgcolor="#FFFFFF" valign="top" class="aa">    
    			<p align="right">　
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
		}else{ 
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