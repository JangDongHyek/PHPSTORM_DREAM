<?
	// 파일체크
	if(!$_POST["rg_files_count"])
		$rg_files_count = 2;

//	echo "$rg_files_count<br>";

	for($fi=1;$fi<=$rg_files_count;$fi++) {
		$file = $HTTP_POST_FILES["rg_file$fi"];
		
		switch ($file["error"]) {
			case UPLOAD_ERR_OK:
				break;
			case UPLOAD_ERR_INI_SIZE:
				$msg = "서버의 업로드 파일 용량제한을 초과 했습니다. (".ini_get("upload_max_filesize").") in php.ini.\\n\\n서버관리자에게 문의 하세요.";
				rg_href('',$msg,'','back');				
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$msg = ("The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.");
				rg_href('',$msg,'','back');
				break;
			case UPLOAD_ERR_PARTIAL:
				$msg = ("The uploaded file was only partially uploaded.");
				rg_href('',$msg,'','back');
				break;
			case UPLOAD_ERR_NO_FILE:
				//$msg = ("No file was uploaded.");
				//rg_href('',$msg,'','back');
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$msg = ("Missing a temporary folder.");
				rg_href('',$msg,'','back');
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$msg = ("Failed to write file to disk");
				rg_href('',$msg,'','back');
				break;
			default:
				$msg = ("Unknown File Error");
				rg_href('',$msg,'','back');
		}

		
		if($file[size]>0) {
			$temp=explode(".",$file[name]);
			$file[ext]=$temp[count($temp)-1];
			$bbs_file_ext = $bbs["bbs_file{$fi}_ext"];
			$bbs_file_size = $bbs["bbs_file{$fi}_size"];

			if(!$bbs_file_ext)
				$bbs_file_ext = $bbs["bbs_file1_ext"];
			if(!$bbs_file_size)
				$bbs_file_size = $bbs["bbs_file1_size"];

			// 업로드 가능한 확장명인지 체크한다.
			if($bbs_file_ext) {
				if(substr($bbs_file_ext,0,1)=='!') {
					$bbs_file_ext = substr($bbs_file_ext,1);
					$not = false;
				} else {
					$not = true;
				}
//				$match = eregi($file[ext],$bbs_file_ext);
				$bbs_file_ext1 = str_replace(",","|",$bbs_file_ext);
				$match = eregi($bbs_file_ext1,$file[ext]);
				
				if($match && !$not) {
					$msg = str_replace ("%file_ext%", $bbs_file_ext, "$msg_noupload_ext");
					rg_href('',$msg,'','back');
				}
				if(!$match && $not) {
					$msg = str_replace ("%file_ext%", $bbs_file_ext, "$msg_upload_ext");
					rg_href('',$msg,'','back');
				}
			}
			unset($bbs_file_ext);	
		
			// 업로드 가능한 크기를 체크한다
			if($bbs_file_size) {				
				if($file[size] > $bbs_file_size) {
					$bbs_file_size = rg_human_fsize_lib($bbs_file_size);
					$msg = "파일 크기가 $bbs_file_size 이상인 파일은 업로드하실수 없습니다.";
					rg_href('',$msg,'','back');
				}
			}
			unset($bbs_file_size);
		}
	}
	
?>