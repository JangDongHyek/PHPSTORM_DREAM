<?
	// ����ó��
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
			  // �Ϻ� �������� ���ε�� ������ ���� �ȵɰ�� �õ��Ѵ�.
				// 2003-10-15
				if(@move_uploaded_file($file[tmp_name], $bbs_data_path.$file[server_name])) {
					${"rg_file{$fi}_name"} = $file[name];
					${"rg_file{$fi}_size"} = $file[size];
				} else {
					${"rg_file{$fi}_name"} = '';
					${"rg_file{$fi}_size"} = 0;
				}
			}

			// ���͸�ũ �������
			$watermark_path = "./data/__watermark.png";

			// ����1�� �������
			$rg_file_path = $bbs_data_path.$rg_doc_num.'$'.$fi.'$'.${"rg_file{$fi}_name"};


			############## �����
			//����� ���μ��� ũ�� ���� 
				$thum_width = 600; 
				$thum_height = 600; 
			//	$max_filesize = 1024*1024*2;
			############# ����1
			// ������1�� url
				$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$'.$rg_file1_name);
				$rg_thum1_width = $thum_width; 
				$rg_thum1_height = $thum_height; 

				if($rg_file1_name && eregi('(\.jpg|\.png)$',$rg_file1_name)){

					// ����1�� �������
					$rg_file1_path = $bbs_data_path.$rg_doc_num.'$1$'.$rg_file1_name;
					// ������1�� �������
					$rg_thum1_path = $bbs_data_path.$rg_doc_num.'$1$th2$'.$rg_file1_name;
					// ���͸�ũ �������
					//$watermark_path = $bbs_data_path."__watermark.jpg";
					// ������1�� url
					$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$th2$'.$rg_file1_name);

					if(file_exists($rg_file1_path))
					{
						//����� �̹��� ũ�� ���μ��� ���� ���� 
						$rg_file1_info = getimagesize($rg_file1_path);
						$rg_file1_width = $rg_file1_info[0]; 
						$rg_file1_height = $rg_file1_info[1];
					}else
					{
						$rg_file1_width = 0;
						$rg_file1_height = 0;
					}

					//echo "$rg_thum1_url";
					//echo "<br>$rg_file1_width";
					//echo "<br>$rg_file1_height";
					//exit;
			// && filesize($rg_file1_path) < $max_filesize)
					
					if(($rg_file1_width * $rg_file1_height) < 5800000 && ($rg_file1_info[2] != 1))
					{
								
						// ������� ���ٸ� �����Ѵ�.
						if(!file_exists($rg_thum1_path)) {
							if($rg_file1_width > $rg_file1_height) { 
								$rg_thum1_width = $thum_width; 
								$rg_thum1_height = ceil($rg_thum1_width/$rg_file1_width * $rg_file1_height); 
							} else { 
								$rg_thum1_height = $thum_height; 
								$rg_thum1_width = ceil($rg_thum1_height/$rg_file1_height * $rg_file1_width); 
							}
							$arr_error = thumbnailImageCreate($rg_file1_path, $rg_thum1_path, $rg_thum1_width, $rg_thum1_height, 100);
							
							//�������ϻ���
							$del_file = $rg_doc_num.'$1$'.$rg_file1_name;
							@unlink($bbs_data_path.$del_file);

						}
					} else {
						// ������1�� url
						$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$'.$rg_file1_name);
					}
				}
			####################����2
				$rg_thum2_url = $bbs_data_url.urlencode($rg_doc_num.'$2$'.$rg_file2_name);
				$rg_thum2_width = $thum_width; 
				$rg_thum2_height = $thum_height; 

				if($rg_file2_name && eregi('(\.jpg|\.png)$',$rg_file2_name)){

					// ����2�� �������
					$rg_file2_path = $bbs_data_path.$rg_doc_num.'$2$'.$rg_file2_name;
					// ������2�� �������
					$rg_thum2_path = $bbs_data_path.$rg_doc_num.'$2$th2$'.$rg_file2_name;
					// ���͸�ũ �������
					//$watermark_path = $bbs_data_path."__watermark.jpg";
					// ������2�� url
					$rg_thum2_url = $bbs_data_url.urlencode($rg_doc_num.'$2$th2$'.$rg_file2_name);

					if(file_exists($rg_file2_path))
					{
						//����� �̹��� ũ�� ���μ��� ���� ���� 
						$rg_file2_info = getimagesize($rg_file2_path);
						$rg_file2_width = $rg_file2_info[0]; 
						$rg_file2_height = $rg_file2_info[1];
					}else
					{
						$rg_file2_width = 0;
						$rg_file2_height = 0;
					}

					//echo "$rg_thum2_url";
					//echo "<br>$rg_file2_width";
					//echo "<br>$rg_file2_height";
					//exit;
			// && filesize($rg_file2_path) < $max_filesize)
					
					if(($rg_file2_width * $rg_file2_height) < 5800000 && ($rg_file2_info[2] != 1))
					{
								
						// ������� ���ٸ� �����Ѵ�.
						if(!file_exists($rg_thum2_path)) {
							if($rg_file2_width > $rg_file2_height) { 
								$rg_thum2_width = $thum_width; 
								$rg_thum2_height = ceil($rg_thum2_width/$rg_file2_width * $rg_file2_height); 
							} else { 
								$rg_thum2_height = $thum_height; 
								$rg_thum2_width = ceil($rg_thum2_height/$rg_file2_height * $rg_file2_width); 
							}
							$arr_error = thumbnailImageCreate($rg_file2_path, $rg_thum2_path, $rg_thum2_width, $rg_thum2_height, 100);
						}
					} else {
						// ������2�� url
						$rg_thum2_url = $bbs_data_url.urlencode($rg_doc_num.'$2$'.$rg_file2_name);
					}
				}
			###########
		}
	}
	
?>