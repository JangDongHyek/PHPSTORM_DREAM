<?
/*----------------------------------------------------------------------------- 
 *	제작자 : 강훈일
 *	제작일 : 2003. 10. 9
 *	이메일 : kanghoonil@npine.com , hoonil@javastars.com
 *	파일명 : lib_ImageConvert.php
 *	
 *	> 함수 설명 <
 *	array(int 결과값(1=성공, 0=실패), string 이미지소스format방식, string 결과 메시지) THUMBNAIL_IMAGE_CREATE($image_path, $save_path, $max_with_size=100, $max_height_size=100, $save_format="jpg", $background_color="WHITE", $image_quality=100)
 *	이미지 섬네일 작성 함수 
 *	
 *	> 전달인자 설명 <
 *	$image_path				:				원본 경로
 *	$save_path				:				저장 경로
 *	$max_with_size			:				가로 최대 사이즈
 *	$max_height_size		:				세로 최대 사이즈
 *	$waterMakeImagePath		:				워터마크 이미지(값이 있는경우 실행)
 *	$save_format			:				저장 포맷 형식
 *	$background_color		:				세로 최대 사이즈
 *	$image_quality			:				압축률
 *	
 -----------------------------------------------------------------------------*/
 FUNCTION thumbnailImageCreate($image_path, $save_path, $max_with_size=100, $max_height_size=100,  $image_quality=80, $background_color="WHITE")
{
	global $imageTypes;
	/**
	 *	원본 이미지 사이즈 알아오기
	 *	$image_path_size_info[0]		:		원본 이미지 가로 사이즈
	 *	$image_path_size_info[1]		:		원본 이미지 세로 사이즈
	 *	$image_path_size_info[2]		:		원본 이미지 포맷 방식
	 *												1 - GIF
	 *												2 - JPG
	 *												3 - PNG
	 *												4 - SWF
	 *													   
	 *	$image_path_size_info[3]		:		원본 이미지 문자열 ex) height="xxx" width="xxx"
	 */
		$image_path_size_info = @getimagesize($image_path);
		
		
		/**
		 *	THUMBNAIL IMAGE 사이즈 설정
		 */
		if($image_path_size_info[0] > $image_path_size_info[1]){
				
				/**
				 *	이미지 사이즈가 width 가 height 보다 큰경우
				 */
				if($image_path_size_info[0] > $max_with_size){
						$save_path_width_size = $max_with_size;
						$save_path_height_size_divided = ($image_path_size_info[0] / $save_path_width_size);
						$save_path_height_size = ($image_path_size_info[1] / $save_path_height_size_divided);
						
				}else{
						$save_path_width_size = $image_path_size_info[0];
						$save_path_height_size = $image_path_size_info[1];
				}
				
		}else if($image_path_size_info[0] == $image_path_size_info[1]){
				
				/**
				 *	이미지 사이즈가 width 와 height 가 같은 경우
				 */
				if($image_path_size_info[0] > $max_with_size){
						$save_path_width_size = $max_with_size;
						$save_path_height_size_divided = ($image_path_size_info[0] / $save_path_width_size);
						$save_path_height_size = ($image_path_size_info[1] / $save_path_height_size_divided);
				}else{
						$save_path_width_size = $image_path_size_info[0];
						$save_path_height_size = $image_path_size_info[1];
				}
		}else{
				/**
				 *	이미지 사이즈가 height 가  width 보다 큰경우
				 */
				if($image_path_size_info[1] > $max_height_size){
						$save_path_height_size = $max_height_size;
						$save_path_width_size_divided = ($image_path_size_info[1] / $save_path_height_size);
						$save_path_width_size = ($image_path_size_info[0] / $save_path_width_size_divided);
				}else{
						$save_path_width_size = $image_path_size_info[0];
						$save_path_height_size = $image_path_size_info[1];
				}
		}
		
		
		/**
		 *	THUMBNAIL IMAGE 사이즈 설정및 백그라운드 색상 설정
		 */
		$save_image=ImageCreateTrueColor($save_path_width_size-1, $save_path_height_size-1);
		
		
		/**
		 *	백그라운드 색상 설정에 따른 이미지 백그라운드 설정 기
		 *	기본값 : WHITE
		 */
		/*
		switch($background_color){
				case "WHITE":
						$save_image_background_color=ImageColorAllocate($save_image, 255,255,255);
						break;
				case "BLACK":
						$save_image_background_color=ImageColorAllocate($save_image, 0, 0, 0);
						break;
				default :
						return array(0, "!!! 백그라운드 색상을 지원하지 못합니다. 작성자에게 문의 하십시요 !!!");
		}
		*/
		
		/**
		 *	원본이미지의 파일 포맷 방식을 읽어 와서 이미지를 읽을 포맷 방식을 설정한다.
		 *	참조값은 $image_path_size_info[2]
		 */
		switch($image_path_size_info[2]){
				case 1 :
							/**
							 *	GIF 포맷 형식
							 */	
							if(!$source_image=@ImageCreateFromGIF($image_path))
								 return array(0, $source_format, "!!! ImageCreateFromGIF 함수 수행시 에러가 발생했습니다. !!!");
							$source_format="gif";
							break;
				case 2 :
							/**
							 *	JPG 포맷 형식
							 */
							if(!$source_image=@ImageCreateFromJPEG($image_path))
								return array(0, $source_format, "!!! ImageCreateFromJPEG 함수 수행시 에러가 발생했습니다. !!!");
							$source_format="jpg";
							break;
				case 3 :
							/**
							 *	PNG 포맷 형식
							 */
							if(!$source_image=@ImageCreateFromPNG($image_path))
								return array(0, $source_format, "!!! ImageCreateFromPNG 함수 수행시 에러가 발생했습니다. !!!");
							$source_format="png";
							break;
				default :
							/**
							 *	GIF, JPG, PNG 포맷방식이 아닐경우 오류 값을 리턴 후 종료
							 */
							return array(0, $source_format, "!!! 원본이미지가 GIF, JPG, PNG 포맷 방식이 아s니어서 이미지 정보를 읽어올 수 없습니다. !!!");
		}
		
		
		/**
		 *	이미지 사이즈 소숫점 자리 삭제
		 */
		$save_path_width_size = round($save_path_width_size);
		$save_path_height_size = round($save_path_height_size);
		
		if(ImageCopyResampled($save_image ,$source_image, 0, 0, 0, 0, $save_path_width_size, $save_path_height_size, ImageSX($source_image), ImageSY($source_image)))
		{
			switch($imageTypes[$image_path_size_info[2]])
			{
				case "GIF";
					/*if(imagegif($save_image, $save_path)){
						return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path GIF 포맷 이미지 생성");
					}else{
						return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size GIF 포맷 이미지 생성에 실패 했습니다. !!!");
					}*/
					break;
				case "JPG"	:
					if(ImageJPEG($save_image, $save_path, $image_quality)){
						return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path JPG 포맷 이미지 생성");
					}else{
						return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size JPG 포맷 이미지 생성에 실패 했습니다. !!!");
					}
					break;
								
				case "PNG"	:
					if(ImagePNG($save_image, $save_path)){
						return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path PNG 포맷 이미지 생성");
					}else{
						return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size PNG 포맷 이미지 생성에 실패 했습니다. !!!");
					}
					break;				
				default :
					return array(0, $source_format, "!!! 입력하신 포맷 이미지는 지원되지 않습니다. !!!");
			}
		}else{
				return array(0, $source_format, "!!! ImageCopyResized 함수 수행시 에러가 발생했습니다. !!!");
		}
}

/*----------------------------------------------------------------------------- 
 *	제작자 : 여성술
 *	제작일 : 2006. 09. 08
 *	이메일 : heroyeo@hanmail.net
 *	파일명 : lib_ImageConvert.php
 *	
 *	> 함수 설명 <
 *	워터마크(투명하게) 처리 함수 
 *	
 *	> 전달인자 설명 <
 *	$canvasImage		: 원본이미지
 *	$watermarkImage	: 워터마크 이미지 - 반드시 PNG,
 *	$opacity				: 투명도
 *	$quality				: 이미지 품질
 *	$dstImage			: 새로저장할 파일이름 - 없을시엔 원본이미지에 겹쳐짐 *	
 -----------------------------------------------------------------------------*/

function waterMarkImage($canvasImage, $watermarkImage /* MUST BE PNG */, $opacity=50, $quality=80, $dstImage = "")
{
	global $imageTypes;		

	if($dstImage == "")
		$dstImage = $canvasImage;

	// get canvas Image information (file type)
	$getCanvasImageInfo = @getimagesize($canvasImage);
	// get overlay Image information (file type)
	$getOverlayImageInfo = @getimagesize($watermarkImage);

	// create true color canvas image:
	switch($imageTypes[$getCanvasImageInfo[2]])
	{
		case "GIF":
			$canvas_src = imagecreatefromgif($canvasImage);
			break;
		case "JPG":
			$canvas_src = imagecreatefromjpeg($canvasImage);
			break;
		case "PNG":
			$canvas_src = imagecreatefrompng($canvasImage);
			break;
		default:
			return array("bool"=>false, "error"=>"원본 이미지는 GIF, JPG, PNG 이어야 합니다.");
			break;
	}

	if($imageTypes[$getOverlayImageInfo[2]] != "PNG")
	{
		return array("bool"=>false, "error"=>"워터마크 이미지는 반드시 PNG 이어야 합니다. 현재 :".$imageTypes[$getOverlayImageInfo[2]]);
	}

	// 이미지가 너무 클 경우 서버의 메모리 제한과 비교한다 (거의 비슷하게 일치)
	if(($getCanvasImageInfo[0]*$getCanvasImageInfo[1]*10) > (intval(ini_get("memory_limit"))*1024*1024)) 
	{
		return array("bool"=>false, "error"=>"이미지를 처리하기에 너무 큽니다. 사이즈를 주려주세요.");
	}

	/*echo ($getCanvasImageInfo[0]*$getCanvasImageInfo[1]*10);
	if(($getCanvasImageInfo[0]*$getCanvasImageInfo[1]*10) > (intval(ini_get("memory_limit"))*1024*1024))
		echo ">";
	else
		echo "<";
	echo (intval(ini_get("memory_limit"))*1024*1024);
	exit;*/

	$canvas_w = ImageSX($canvas_src);
	$canvas_h = ImageSY($canvas_src);
	$canvas_img = @imagecreatetruecolor($canvas_w, $canvas_h);
	imagecopy($canvas_img, $canvas_src, 0,0,0,0, $canvas_w, $canvas_h);
	imagedestroy($canvas_src); // no longer needed

	// create true color overlay image:
	$overlay_src = imagecreatefrompng($watermarkImage);
	$overlay_w = ImageSX($overlay_src);
	$overlay_h = ImageSY($overlay_src);
	$overlay_img = imagecreatetruecolor($overlay_w, $overlay_h);
	imagecopy($overlay_img, $overlay_src, 0,0,0,0, $overlay_w, $overlay_h);
	imagedestroy($overlay_src); // no longer needed

	// setup transparent color (pick one):
	$black = imagecolorallocate($overlay_img, 0x00, 0x00, 0x00);
	$white = imagecolorallocate($overlay_img, 0xFF, 0xFF, 0xFF);
	$magenta = imagecolorallocate($overlay_img, 0xFF, 0x00, 0xFF); 
	// and use it here:
	imagecolortransparent($overlay_img, $black);

	// calculate overlay Image position 
	$overlay_x = ($getCanvasImageInfo[0] - $getOverlayImageInfo[0]) / 2;
	$overlay_y = ($getCanvasImageInfo[1] - $getOverlayImageInfo[1]) / 2;

	// copy and merge the overlay image and the canvas image:
	imagecopymerge($canvas_img, $overlay_img, $overlay_x, $overlay_y, 0, 0, $overlay_w, $overlay_h, $opacity);

	// output
	//header("Content-type: image/jpeg");
	switch($imageTypes[$getCanvasImageInfo[2]])
	{
		case "GIF":
			@imagegif($canvas_img, $dstImage);
			break;
		case "JPG":
			@imagejpeg($canvas_img, $dstImage, $quality);
			break;
		case "PNG":
			@imagepng($canvas_img, $dstImage);
			break;
		default:
			return array("bool"=>false, "error"=>"워터마크 처리된 이미지 생성에 실패했습니다.");
			break;
	}
	
	imagedestroy($overlay_img);
	imagedestroy($canvas_img);

	return array("bool"=>true, "error"=>"정상처리");
}

function createImagePng($text, $save_path)
{
	//1line per column
	//$text=array(0=>"line 1",1=>"line 2");

	$largeur=200;
	$line_height=30;
	$hauteur=sizeof($text)*$line_height;

	// Create the image
	$im = imagecreatetruecolor($largeur, $hauteur);

	// Create some colors
	$white = imagecolorallocate($im, 255, 255, 255);
	$grey = imagecolorallocate($im, 225, 225, 225);
	$blue = imagecolorallocate($im, 0, 62, 126);
	//imagefilledrectangle($im, 0, 0, $largeur, $hauteur, $white);

	// Replace path by your own font path
	$font = '/usr/share/fonts/ko/TrueType/gulim.ttf';

	for($i=0;$i<=sizeof($text);$i++) {
		//Center the text
		$size = imagettfbbox(20, 0, $font, $text[$i]);
		$long_text = $size[2]+$size[0];
		$posx=($largeur-$long_text)/2;
		// Add the text
		imagettftext($im, 20, 0, $posx, $line_height+$line_height*$i, $white, $font, $text[$i]);
	}

	imagepng($im, $save_path);
	imagedestroy($im);

	return $save_path.$simg_im;
}
?>
