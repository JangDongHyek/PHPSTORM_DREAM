<?php
include_once("JL.php");
class File extends JL{

    private $path;

    function __construct($path = ""){
        //부모 생성자
        parent::__construct();

        if(!empty($path)){
            $this->path = $this->ROOT.$path;

            if(!is_dir($path)){
                mkdir($path, 0777);
                chmod($path, 0777);
            }
        }
    }

    ///////////////////////////////////////////////////
    // size : 파일 사이즈 반환 함수
    ///////////////////////////////////////////////////
    function size($file){
        return $file['size'];
    }

    ///////////////////////////////////////////////////
    // size : 파일 확장자 반환 함수
    ///////////////////////////////////////////////////
    function ext($file, $comma = false){
        return $comma ? '.'.pathinfo($file['name'], PATHINFO_EXTENSION) : pathinfo($file['name'], PATHINFO_EXTENSION);
    }

    ///////////////////////////////////////////////////
    // save : 파일 저장함수
    ///////////////////////////////////////////////////
    function save($file, $path = ""){

        $path = $path ? $path : $this->path;
        if(empty($path)) throw new Exception("파일 업로드 경로가 설정되지 않았습니다");


        // 업로드 디렉토리 생성
        if(!is_dir($path)){
            mkdir($path, 0777);
            chmod($path, 0777);
        }

        if(0 < $file['size']){
            copy($file['tmp_name'], $path.'/'.$file['name']);
            chmod($path.'/'.$file['name'], 0777);
            return $file['name'];
        }
    }

    ///////////////////////////////////////////////////
    // rename : 파일 이름 변경함수
    ///////////////////////////////////////////////////
    function rename($src, $dst, $path = ""){
        $path = $path ? $path : $this->path;
        if(empty($path)) throw new Exception("파일 경로가 설정되지 않았습니다");


        rename($path.'/'.$src, $path.'/'.$dst);

        return $dst;
    }

    function bindGate($file,$permission = "",$path = "") {
        if(is_array($file['name'])) $result = $this->multiple_bind($file,$permission,$path);
        else $result = $this->bind($file,$permission,$path);

        return $result;
    }

    function bind($file,$permission = "",$path = "") {
        if($file == "null" || $file == "undefined" || $file == null || $file == "" || $file["size"] == 0) {
            return "";
        }else {
            $_idx = uniqid().str_pad(rand(0, 99), 2, "0", STR_PAD_LEFT);
            $path = $path ? $path : $this->path."/$_idx";
            if(empty($path)) throw new Exception("파일 경로가 설정되지 않았습니다");
            $permission = $permission ? $permission : $this->getPermission();
            $ext = $this->ext($file,true);
            if(!in_array($ext,$permission)) throw new Exception("허용된 파일이 아닙니다.");

            $src = $this->save($file,$path);

            // 파일네임변경 * 이미지 알집다운로드 필요시 주석처리
            $dst = $_idx.$ext;
            $this->rename($src,$dst,$path);
            $src = $dst;

            $image_path = str_replace($this->ROOT,"",$path);
            $file[status] = "read";
            $file[src] = $image_path."/".$src;
            $file[resize_src] = $image_path."/resize_".$src;
            $this->resize_image($file[src],$file[resize_src],200,100);

            return json_encode($file,JSON_UNESCAPED_UNICODE);
        }
    }

    function multiple_bind($files,$permission = "",$path = "") {
        $datas = array();
        for ($i=0; $i < count($files['name']); $i++) {
            $file = array(
                "name" => $files['name'][$i],
                "type" => $files['type'][$i],
                "tmp_name" => $files['tmp_name'][$i],
                "size" => $files['size'][$i]
            );

            $data = $this->bind($file,$permission,$path);

            array_push($datas,json_decode($data));
        }

        return json_encode($datas,JSON_UNESCAPED_UNICODE);
    }

    function resize_image($file, $newfile, $w, $h) {
        list($width, $height) = getimagesize($file);
        if(strpos(strtolower($file), ".jpg"))
            $src = imagecreatefromjpeg($file);
        else if(strpos(strtolower($file), ".png"))
            $src = imagecreatefrompng($file);
        else if(strpos(strtolower($file), ".gif"))
            $src = imagecreatefromgif($file);
        $dst = imagecreatetruecolor($w, $h);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
        if(strpos(strtolower($newfile), ".jpg"))
            imagejpeg($dst, $newfile);
        else if(strpos(strtolower($newfile), ".png"))
            imagepng($dst, $newfile);
        else if(strpos(strtolower($newfile), ".gif"))
            imagegif($dst, $newfile);
    }

    function getPermission() {
        // 이미지
        $images = array(".bmp",".gif",".jpeg",".jpg",".png",".psd",".pic",".raw",".tiff");

        // 동영상
        $movies = array(".avi",".flv",".mkv",".mov");

        // 음성
        $audios = array(".mp3",".mp4",".wav",".wma");

        // 문서
        $docs = array(".ppt",".pptx",".doc",".docx",".xls",".xlsx",".pdf",".ai",".hwp",".hwpx",".txt");

        // 압축파일
        $compress = array(".zip",".alz",".egg",".rar");

        $arrays = array_merge($images,$movies,$audios,$docs,$compress);

        return $arrays;
    }
}
?>