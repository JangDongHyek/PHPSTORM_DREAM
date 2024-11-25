<?
/*----------------------------------------------------------------------------- 
 *	������ : ������
 *	������ : 2003. 10. 9
 *	�̸��� : kanghoonil@npine.com , hoonil@javastars.com
 *	���ϸ� : lib_ImageConvert.php
 *	
 *	> �Լ� ���� <
 *	array(int �����(1=����, 0=����), string �̹����ҽ�format���, string ��� �޽���) THUMBNAIL_IMAGE_CREATE($image_path, $save_path, $max_with_size=100, $max_height_size=100, $save_format="jpg", $background_color="WHITE", $image_quality=100)
 *	�̹��� ������ �ۼ� �Լ� 
 *	
 *	> �������� ���� <
 *	$image_path				:				���� ���
 *	$save_path				:				���� ���
 *	$max_with_size			:				���� �ִ� ������
 *	$max_height_size		:				���� �ִ� ������
 *	$waterMakeImagePath		:				���͸�ũ �̹���(���� �ִ°�� ����)
 *	$save_format			:				���� ���� ����
 *	$background_color		:				���� �ִ� ������
 *	$image_quality			:				�����
 *	
 -----------------------------------------------------------------------------*/
 FUNCTION thumbnailImageCreate($image_path, $save_path, $max_with_size=100, $max_height_size=100,  $image_quality=80, $background_color="WHITE")
{
	global $imageTypes;
	/**
	 *	���� �̹��� ������ �˾ƿ���
	 *	$image_path_size_info[0]		:		���� �̹��� ���� ������
	 *	$image_path_size_info[1]		:		���� �̹��� ���� ������
	 *	$image_path_size_info[2]		:		���� �̹��� ���� ���
	 *												1 - GIF
	 *												2 - JPG
	 *												3 - PNG
	 *												4 - SWF
	 *													   
	 *	$image_path_size_info[3]		:		���� �̹��� ���ڿ� ex) height="xxx" width="xxx"
	 */
		$image_path_size_info = @getimagesize($image_path);
		
		
		/**
		 *	THUMBNAIL IMAGE ������ ����
		 */
		if($image_path_size_info[0] > $image_path_size_info[1]){
				
				/**
				 *	�̹��� ����� width �� height ���� ū���
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
				 *	�̹��� ����� width �� height �� ���� ���
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
				 *	�̹��� ����� height ��  width ���� ū���
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
		 *	THUMBNAIL IMAGE ������ ������ ��׶��� ���� ����
		 */
		$save_image=ImageCreateTrueColor($save_path_width_size-1, $save_path_height_size-1);
		
		
		/**
		 *	��׶��� ���� ������ ���� �̹��� ��׶��� ���� ��
		 *	�⺻�� : WHITE
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
						return array(0, "!!! ��׶��� ������ �������� ���մϴ�. �ۼ��ڿ��� ���� �Ͻʽÿ� !!!");
		}
		*/
		
		/**
		 *	�����̹����� ���� ���� ����� �о� �ͼ� �̹����� ���� ���� ����� �����Ѵ�.
		 *	�������� $image_path_size_info[2]
		 */
		switch($image_path_size_info[2]){
				case 1 :
							/**
							 *	GIF ���� ����
							 */	
							if(!$source_image=@ImageCreateFromGIF($image_path))
								 return array(0, $source_format, "!!! ImageCreateFromGIF �Լ� ����� ������ �߻��߽��ϴ�. !!!");
							$source_format="gif";
							break;
				case 2 :
							/**
							 *	JPG ���� ����
							 */
							if(!$source_image=@ImageCreateFromJPEG($image_path))
								return array(0, $source_format, "!!! ImageCreateFromJPEG �Լ� ����� ������ �߻��߽��ϴ�. !!!");
							$source_format="jpg";
							break;
				case 3 :
							/**
							 *	PNG ���� ����
							 */
							if(!$source_image=@ImageCreateFromPNG($image_path))
								return array(0, $source_format, "!!! ImageCreateFromPNG �Լ� ����� ������ �߻��߽��ϴ�. !!!");
							$source_format="png";
							break;
				default :
							/**
							 *	GIF, JPG, PNG ���˹���� �ƴҰ�� ���� ���� ���� �� ����
							 */
							return array(0, $source_format, "!!! �����̹����� GIF, JPG, PNG ���� ����� ��s�Ͼ �̹��� ������ �о�� �� �����ϴ�. !!!");
		}
		
		
		/**
		 *	�̹��� ������ �Ҽ��� �ڸ� ����
		 */
		$save_path_width_size = round($save_path_width_size);
		$save_path_height_size = round($save_path_height_size);
		
		if(ImageCopyResampled($save_image ,$source_image, 0, 0, 0, 0, $save_path_width_size, $save_path_height_size, ImageSX($source_image), ImageSY($source_image)))
		{
			switch($imageTypes[$image_path_size_info[2]])
			{
				case "GIF";
					/*if(imagegif($save_image, $save_path)){
						return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path GIF ���� �̹��� ����");
					}else{
						return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size GIF ���� �̹��� ������ ���� �߽��ϴ�. !!!");
					}*/
					break;
				case "JPG"	:
					if(ImageJPEG($save_image, $save_path, $image_quality)){
						return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path JPG ���� �̹��� ����");
					}else{
						return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size JPG ���� �̹��� ������ ���� �߽��ϴ�. !!!");
					}
					break;
								
				case "PNG"	:
					if(ImagePNG($save_image, $save_path)){
						return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path PNG ���� �̹��� ����");
					}else{
						return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size PNG ���� �̹��� ������ ���� �߽��ϴ�. !!!");
					}
					break;				
				default :
					return array(0, $source_format, "!!! �Է��Ͻ� ���� �̹����� �������� �ʽ��ϴ�. !!!");
			}
		}else{
				return array(0, $source_format, "!!! ImageCopyResized �Լ� ����� ������ �߻��߽��ϴ�. !!!");
		}
}

/*----------------------------------------------------------------------------- 
 *	������ : ������
 *	������ : 2006. 09. 08
 *	�̸��� : heroyeo@hanmail.net
 *	���ϸ� : lib_ImageConvert.php
 *	
 *	> �Լ� ���� <
 *	���͸�ũ(�����ϰ�) ó�� �Լ� 
 *	
 *	> �������� ���� <
 *	$canvasImage		: �����̹���
 *	$watermarkImage	: ���͸�ũ �̹��� - �ݵ�� PNG,
 *	$opacity				: ����
 *	$quality				: �̹��� ǰ��
 *	$dstImage			: ���������� �����̸� - �����ÿ� �����̹����� ������ *	
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
			return array("bool"=>false, "error"=>"���� �̹����� GIF, JPG, PNG �̾�� �մϴ�.");
			break;
	}

	if($imageTypes[$getOverlayImageInfo[2]] != "PNG")
	{
		return array("bool"=>false, "error"=>"���͸�ũ �̹����� �ݵ�� PNG �̾�� �մϴ�. ���� :".$imageTypes[$getOverlayImageInfo[2]]);
	}

	// �̹����� �ʹ� Ŭ ��� ������ �޸� ���Ѱ� ���Ѵ� (���� ����ϰ� ��ġ)
	if(($getCanvasImageInfo[0]*$getCanvasImageInfo[1]*10) > (intval(ini_get("memory_limit"))*1024*1024)) 
	{
		return array("bool"=>false, "error"=>"�̹����� ó���ϱ⿡ �ʹ� Ů�ϴ�. ����� �ַ��ּ���.");
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
			return array("bool"=>false, "error"=>"���͸�ũ ó���� �̹��� ������ �����߽��ϴ�.");
			break;
	}
	
	imagedestroy($overlay_img);
	imagedestroy($canvas_img);

	return array("bool"=>true, "error"=>"����ó��");
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
