<?
	// 파일처리
	for($fi=1;$fi<=$rg_files_count;$fi++) {
		if(${"del_file{$fi}"}) {
			@unlink($bbs_data_path.$rg_doc_num.'$'.$fi.'$'.${"rg_file{$fi}_name"});
			${"rg_file{$fi}_name"} = '';
			${"rg_file{$fi}_size"} = 0;
		}
		
		$file = $HTTP_POST_FILES["rg_file$fi"];
		if($file[size]>0) {
			$temp=explode(".",$file[name]);
			$file[ext]=$temp[count($temp)-1];

			$file[name] = eregi_replace(" ", "_", $file[name]);
			$file[server_name] = $rg_doc_num.'$'.$fi.'$'.$file[name];
			
			if(${"rg_file{$fi}_name"}) {
				if(@unlink($bbs_data_path.$rg_doc_num.'$'.$fi.'$'.${"rg_file{$fi}_name"})) {
					${"rg_file{$fi}_name"} = '';
					${"rg_file{$fi}_size"} = 0;
				}
			}
			
			if(@copy($file[tmp_name], $bbs_data_path.$file[server_name])) {
				${"rg_file{$fi}_name"} = $file[name];
				${"rg_file{$fi}_size"} = $file[size];
			} else {
			  // 일부 계정에서 업로드된 파일이 복사 안될경우 시도한다.
				// 2003-10-15
				if(@move_uploaded_file($file[tmp_name], $bbs_data_path.$file[server_name])) {
					${"rg_file{$fi}_name"} = $file[name];
					${"rg_file{$fi}_size"} = $file[size];
				} else {
					${"rg_file{$fi}_name"} = '';
					${"rg_file{$fi}_size"} = 0;
				}
			}

			// 워터마크 서버경로
			$watermark_path = "./data/__watermark.png";

			// 파일1의 서버경로
			$rg_file_path = $bbs_data_path.$rg_doc_num.'$'.$fi.'$'.${"rg_file{$fi}_name"};

			//썸네일 이미지 크기 가로세로 비율 조정
			$rg_file_info = getimagesize($rg_file_path);
			$rg_file_width = $rg_file_info[0]; 
			$rg_file_height = $rg_file_info[1];

			/*if(!is_file($watermark_path))
				$watermark_path = createImagePng(array(0=>"Lets080"), $watermark_path);

			$arr_result = waterMarkImage($rg_file_path, $watermark_path, 50, 80, "");
			if(!$arr_result["bool"])
			{
				echo $arr_result["error"];
				exit;
			}*/
			// -- copy END -- 
		}
	}
	
?>