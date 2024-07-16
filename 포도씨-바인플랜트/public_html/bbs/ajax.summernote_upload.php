<?php
include_once('./_common.php');

@mkdir(G5_DATA_PATH . '/file/' . 'summernote', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'summernote', G5_DIR_PERMISSION);

if ($_FILES['file']['name']) {
    if (!$_FILES['file']['error']) {
        $temp = explode(".", $_FILES["file"]["name"]);
        $newfilename = round(microtime(true)).'.'.end($temp);
        $destinationFilePath = G5_DATA_PATH.'/file/summernote/'.$newfilename;
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $destinationFilePath)) {
            echo $errorImgFile;
        }
        else{
            echo G5_DATA_URL.'/file/summernote/'.$newfilename;
        }
    }
    else {
        echo  $message = 'Error!: ' . $_FILES['file']['error'];
    }
}
?>