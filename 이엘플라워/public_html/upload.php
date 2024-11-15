<?
///////////////////////////////////////////////////////////////
//  파일 업로드
//////////////////////////////////////////////////////////////
//예제 : $file_name = FileUploadName("","../../imgdata/",$user_file,$user_file_name);
function FileUploadName($prev_file,$savedir,$file,$file_name){
	
	if(!file_exists("$savedir")){
		mkdir("$savedir", 0755 );
	}

	if($file_name){
		if($prev_file && $prev_file != "no"){
			if(file_exists($savedir.$prev_file))
			{
				unlink($savedir.$prev_file);
			}
		}

		$limitext = "html;htm;php;php3;phtml;inc;sql;cgi;pl";

		$pos = strrpos($file_name,".");
		$name = substr($file_name,0,$pos);
		$ext = substr($file_name,$pos+1);

		if(strpos($limitext,$ext)){
			echo "
				<script language='javascript'>
				alert('파일 업로드 실패');
				history.go(-1);
				</script>";
			exit;
		}

		$fullname = $savedir . $file_name;

		$r = 1;
		while(file_exists($fullname)){
			$file_name = $name . "_" . $r++. "." . $ext;
			$fullname =  $savedir . $file_name;
		}
		

		if(!move_uploaded_file($file,$fullname)){
			echo "
				<script language='javascript'>
				alert('파일 업로드 실패');
				history.go(-1);
				</script>";
			exit;
		}
	}else{
		if($prev_file && $prev_file != "no")
			$file_name = $prev_file;
		else
			$file_name = "no";
	}

	return $file_name;
}
?>