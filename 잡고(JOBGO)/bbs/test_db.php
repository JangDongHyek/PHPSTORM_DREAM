<?php
include_once("./_common.php");
//이미지 지우는용도
//$img_row = 'test'.'.jpg';
//@unlink(G5_DATA_PATH . '/member/te/' . $img_row);
//폴더전체삭제
function rm_rf($file)
{
    if (file_exists($file)) {
        if (is_dir($file)) {
            $handle = opendir($file);
            while($filename = readdir($handle)) {
                if ($filename != '.' && $filename != '..')
                    rm_rf($file.'/'.$filename);
            }
            closedir($handle);

            @chmod($file, G5_DIR_PERMISSION);
            @rmdir($file);
        } else {
            @chmod($file, G5_FILE_PERMISSION);
            @unlink($file);
        }
    }
}


rm_rf(G5_DATA_PATH.'/file/certificate');

