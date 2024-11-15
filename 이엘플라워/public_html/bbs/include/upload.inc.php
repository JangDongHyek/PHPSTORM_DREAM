<?

           // 파일처리
           for($fi=1;$fi<=$rg_files_count;$fi++) {
				if(${"del_file{$fi}"}) {
					@unlink($bbs_data_path."{$rg_doc_num}\$$fi\$".${"rg_file{$fi}_name"});
					@unlink($bbs_data_path."{$rg_doc_num}\$$fi\$th\$".${"rg_file{$fi}_name"});
					@unlink($bbs_data_path."{$rg_doc_num}\$$fi\$th2\$".${"rg_file{$fi}_name"});
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

				 $image_size = @getimagesize($bbs_data_path.$rg_doc_num.'$'.$fi.'$'.${"rg_file{$fi}_name"});
				 if($image_size[0] > 600){
				  if(${"rg_file{$fi}_name"} && eregi('(\.gif|\.jpg|\.jpeg|\.png|\.bmp)$', ${"rg_file{$fi}_name"})){
					//이미지매직
					MakeThum_Gall($rg_doc_num,$fi,$bbs_id,${"rg_file{$fi}_name"});
				  }
				 }
                  // -- copy END --
              }
          }

?>
