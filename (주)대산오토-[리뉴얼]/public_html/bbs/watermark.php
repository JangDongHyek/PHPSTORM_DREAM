<?php
// Function to add text water mark over image
function addTextWatermark($src, $watermark, $save=NULL) {
	list($width, $height) = getimagesize($src);
	$image_color = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($src);
	imagecopyresampled($image_color, $image, 0, 0, 0, 0, $width, $height, $width, $height);
	$txtcolor = imagecolorallocate($image_color, 255, 255, 255);
	$font = './MONOFONT.TTF';
	$font_size = 50;
	imagettftext($image_color, $font_size, 0, 50, 150, $txtcolor, $font, $watermark);
	if ($save<>'') {
	imagejpeg ($image_color, $save, 100);
	} else {
	header('Content-Type: image/jpeg');
	imagejpeg($image_color, null, 100);
	}
	imagedestroy($image);
	imagedestroy($image_color);
}
// Function to add image watermark over images
function addImageWatermark($SourceFile, $WaterMark, $DestinationFile=NULL, $opacity) {
	$main_img = $SourceFile;
	$watermark_img = $WaterMark;
	$padding = 5;
	$opacity = $opacity;
	// create watermark
	$watermark = imagecreatefrompng($watermark_img);
	$image = imagecreatefromjpeg($main_img);
	if(!$image || !$watermark) die("Error: 이미지 또는 워터마크이미지가 로딩되지 않았습니다!");
	$watermark_size = getimagesize($watermark_img);
	$watermark_width = $watermark_size[0];
	$watermark_height = $watermark_size[1];
	$image_size = getimagesize($main_img);
	$dest_x = ($image_size[0] - $watermark_width - $padding)/2;
	$dest_y = ($image_size[1] - $watermark_height - $padding)/2;
	imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, $opacity);
	if ($DestinationFile<>'') {
	imagejpeg($image, $DestinationFile, 100);
	} else {
	header('Content-Type: image/jpeg');
	imagejpeg($image);
	}
	imagedestroy($image);
	imagedestroy($watermark);
}

function add_watermark_image($image_path, $watermark_path) {
    
    // $image_path, $watermark_path 는 반드시 절대경로로 지정해야함 (url이 아닌 path)
    
    $array_img_chk = array("jpg", "jpeg", "png", "gif", "bmp");
    
    // 이미지 확장자
    $img_ext = explode(".", strrev($image_path));
    $img_ext = strrev($img_ext[0]);
    $img_ext = strtolower($img_ext);
    
    // 이미지 파일인 경우에만 진행
    if(in_array($img_ext, $array_img_chk)) {
 
        if($img_ext == 'jpg' || $img_ext == 'jpeg')
            $create_img = imagecreatefromjpeg($image_path);
 
        if($img_ext == 'png')
            $create_img = imagecreatefrompng($image_path);
 
        if($img_ext == 'gif')
            $create_img = imagecreatefromgif($image_path);
 
        if($img_ext == 'bmp')
            $create_img = imagecreatefromwbmp($image_path);
 
        if($create_img) {
            
            // 워터마크 이미지 확장자
            $watermark_img_ext = explode(".", strrev($watermark_path));
            $watermark_img_ext = strrev($watermark_img_ext[0]);
            $watermark_img_ext = strtolower($watermark_img_ext);
 
            if($watermark_img_ext == 'jpg' || $watermark_img_ext == 'jpeg')
                $create_watermark_img = imagecreatefromjpeg($watermark_path);
 
            if($watermark_img_ext == 'png')
                $create_watermark_img = imagecreatefrompng($watermark_path);
 
            if($watermark_img_ext == 'gif')
                $create_watermark_img = imagecreatefromgif($watermark_path);
 
            if($watermark_img_ext == 'bmp')
                $create_watermark_img = imagecreatefromwbmp($watermark_path);
 
            if($create_watermark_img) {
 
                list($img_w, $img_h) = getimagesize($image_path);
                list($watermark_img_w, $watermark_img_h) = getimagesize($watermark_path);

 
                imagealphablending($create_img, true);
                
                // 워터마크 위치 지정
               // $pos_x = 50;
               // $pos_y = 50;
 
                // (예시) 워터마크를 정중앙으로
                 $pos_x = ceil(($img_w - $watermark_img_w) / 2);
                 $pos_y = ceil(($img_h - $watermark_img_h) / 2);
                
                imagecopy($create_img, $create_watermark_img, $pos_x, $pos_y, 0, 0, $watermark_img_w, $watermark_img_h);
 
                /* imagecopy 설명 */
                // 원본 이미지 리소스 : $create_img
                // 워터마크 이미지 리소스 : $create_watermark_img
                // 워터마크 이미지 x 좌표 : $pos_x
                // 워터마크 이미지 y 좌표 : $pos_y
                // 원본 이미지 x 좌표 : 0
                // 원본 이미지 y 좌표 : 0
                // 워터마크 이미지 가로크기 : $watermark_img_w
                // 워터마크 이미지 세로크기 : $watermark_img_h
                
                //header("Content-type: image/jpeg");
                imagejpeg($create_img, $image_path);
 
                imagedestroy($create_img);
                imagedestroy($create_watermark_img);
            }
        }
    }
}



?>
