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
				 
				  if($fi==1){//�����̹���
					$file[server_name] = 'small'.$admin_orderby.'.jpg';
				  }else{//ū�̹���
					$file[server_name] = 'big'.$admin_orderby.'.jpg';
				  }
                  if(${"rg_file{$fi}_name"}) {
					  if($fi==1){//�����̹���
						  if(@unlink($bbs_data_path.'small'.$admin_orderby.'.jpg')) {
							  ${"rg_file{$fi}_name"} = '';
							  ${"rg_file{$fi}_size"} = 0;
						  }
					  }else{//ū�̹���
						  if(@unlink($bbs_data_path.'big'.$admin_orderby.'.jpg')) {
							  ${"rg_file{$fi}_name"} = '';
							  ${"rg_file{$fi}_size"} = 0;
						  }
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
                  // -- copy END --
              }
          }

?>
