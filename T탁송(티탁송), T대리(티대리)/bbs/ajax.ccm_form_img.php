<?php
/************************************************
CCM회원가입시 프로필사진
 ************************************************/
include_once('./_common.php');

// print_r($_POST);
// print_r($_FILES);

$json = array();
$json['result'] = "F";

$upload_dir = G5_DATA_PATH.'/ccm/';
$upload_file = $_FILES['imageInput']['tmp_name'];
//$old_file_del = ($del_cert_img == "1")? true : false;
$file_name = "";



if ($upload_file != "") {
    $ext = array_pop(explode('.', $_FILES['imageInput']['name']));
    $file_name = time().getRandomString(4).".{$ext}";
    $upload_path = $upload_dir.$file_name;
    if (move_uploaded_file($upload_file, $upload_path)) {
        //$old_file_del = true;

        // 사진회전
        $exif  = exif_read_data($upload_path);
        $orient = $exif['Orientation'];
        $source = imagecreatefromjpeg($upload_path);

        switch($orient){
            case 8 : $source = imagerotate($source,90,0); break;
            case 3 : $source = imagerotate($source,180,0); break;
            case 6 : $source = imagerotate($source,-90,0); break;
        }
        imagejpeg($source, $upload_path);
        imagedestroy($source);
    }

    if (file_exists($upload_path)) {
        $json['result'] = "T";
        $json['file'] = $file_name;
    }
}

echo json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

?>
