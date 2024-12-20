<?php
	include_once("./_common.php");
	
	//upload 파일 처리
	$upload_flag = false;
	$upload_directory = './upload/';
	$sql2 = "select * from g5_popup";
	$result = sql_query($sql2);
	$row=sql_fetch_array($result);
	
	if(isset($_FILES['image_file']) && $_FILES['image_file']['error'] != 4){ 
		$image_file = $_FILES['image_file'];
		$data = new splFileInfo($image_file["name"]);
		$file_ext = $data->getExtension(); //확장자
		$upload_file_name = md5(microtime()). '.' . $file_ext; //폴더에 저장되는 파일 이름
		$real_file_name = $image_file["name"];
		$delete_file_name = $row["image_name"];
		while(file_exists($upload_directory.$upload_file_name)){ //해당 경로에 중복되는 파일이름이 있으면 새로 저장
			$upload_file_name = md5(microtime()). '.' . $file_ext; 
		}
		$upload_flag = true;
	}else{
		$upload_file_name = $row["image_name"];
		$real_file_name = $row["real_image_name"];
		$delete_file_name = "";
	}

	
	if($_POST["type"] == 0){ //게시글 등록
		$sql = "insert into g5_popup(image_name, real_image_name, link, regdate) values(";
		$sql .="'".$upload_file_name."',";
		$sql .= "'".$real_file_name."',";
		$sql .= "'".$_POST["link"]."',";
		$sql .= "now())";
		$result = sql_query($sql);
		if($result == true){
			if($upload_file_name != ""){
				move_uploaded_file($image_file['tmp_name'], $upload_directory.$upload_file_name);
			}
			echo "<script>
						location.href = 'http://incore1122.cafe24.com/eng/';
				  </script>";
		}
		else{

		}
	}else{ //게시글 수정
		$sql = "update g5_popup set ";
		$sql .= "image_name = '".$upload_file_name."',";
		$sql .= "real_image_name = '".$real_file_name."',";
		$sql .= "link = '".$_POST["link"]."',";
		$sql .= "regdate = now()";
		$result = sql_query($sql);
		if($result == true){
			if($upload_flag){ //파일이 수정된 경우
				if($delete_file_name != ""){ //기존의 파일 삭제
					$file_name = $upload_directory.$delete_file_name;
					if (file_exists($file_name)) {
						unlink($file_name);
					}
				}

				if($upload_file_name != ""){ //수정된 파일 업로드
					move_uploaded_file($image_file['tmp_name'], $upload_directory.$upload_file_name);
				}
			}
			echo "<script>
							location.href = 'http://incore1122.cafe24.com/eng/';
					  </script>";
		}
		else{

		}
	}
	
	
?>
 <html>
     <head>
         <meta charset="utf-8">
         <title></title>
     </head>
</html>