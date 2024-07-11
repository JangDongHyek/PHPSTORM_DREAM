<?

//쿠키 설정
//if(!isset ($id)) {
//$id = uniqid(rand(15,20));
//setcookie("id","$id",0,"/");
//}

//문자열 자르기 함수---------------------------------------------------------------------------
function han_cut($val,$cut_len){
    $tot_len = strlen($val);
    $cut_str = substr($val,0,$cut_len);
    $len = strlen($cut_str);
    for($i=0;$i < $len;$i++){
        if(ord($val[$i]) > 127){
            $hanlen++;
        }else{
            $englen++;
        }
    }
    $cut_gap = $hanlen % 2;
    if($cut_gap == 1){
        $hanlen--;
    }
    $length=$hanlen + $englen;
    if($tot_len > $length){
        return substr($val,0,$length)."...";
    }else{
        return substr($val,0,$length);
    }
}//문자열 자르기함수1-2(...없는거)
function han_cut2($val,$cut_len){
    $tot_len = strlen($val);
    $cut_str = substr($val,0,$cut_len);
    $len = strlen($cut_str);
    for($i=0;$i < $len;$i++){ if(ord($val[$i]) > 127){ $hanlen++; }else{ $englen++; 	} }
    $cut_gap = $hanlen % 2;
    if($cut_gap == 1){ $hanlen--; }
    $length=$hanlen + $englen;
    if($tot_len > $length){ return substr($val,0,$length); }else{ return substr($val,0,$length); }
}

//문자열 자르기 함수2--------------------------------------------------------------------------
function Sublen($sub,$len) {
    $max = $len; // 글을 자를 길이입니다..
    $count = strlen($sub);
    if($count >= $max) {
        for ($pos=$max;$pos>0 && ord($sub[$pos-1])>=127;$pos--);
        if (($max-$pos)%2 == 0)
            $sub = substr($sub, 0, $max)."...";
        else
            $sub = substr($sub, 0, $max+1)."...";
    } else {
        $sub = "$sub";
    }
    return print("$sub");
}

//메일함수 ------------------------------------------------------------------------------------
function mem_mail($fromname,$from,$toname,$to,$subject,$body){
    //$subject=stripslashes($subject);
    //$body=stripslashes($body);
    $fromname = $fromname; //보내는 사람 이름
    $from = $from; //보내는 사람 메일주소
    $toname = $toname;
    $to = $to; //받는사람 메일주소
    $subject = $subject; //제목
    $body = $body; //글내용
    $MailServer = "localhost";
    // 보통 sendmail 은 릴레이가 금지되어 있심다.
    // 하지만 local에서의 접속은 허용되어 있응게 상관없습니다.

    // 여기서부터 25번 포트로 접속해서 보내는 부분
    $fp = fsockopen($MailServer, 25, &$errno, &$errstr, 30);
    if(!$fp) { echo("sendmail 연결에러: $errstr ($errno)\n"); exit; }

    fgets($fp, 128);
    fputs($fp, "helo <$HTTP_HOST>\r\n");	fgets($fp, 128);
    // 접속하구 나서 mail서버한테 인사하는 부분인거 같은데요.....
    // 없어도 잘 가더라구요... 하지만 표준인거 같애서 넣었습니다
    // $HTTP_HOST 는 php가 넘겨주는 변수죵^^..  싫으면 아무꺼나 넣어도 됨다..

    fputs($fp, "mail from: <$from>\r\n");	$retval[0] = fgets($fp, 128);
    // 보내는넘 메일 등록하는 부분

    fputs($fp, "rcpt to: <$to>\r\n");	$retval[1] = fgets($fp, 128);
    // 받는넘 메일임다....
    // 받는넘이 여러명이면 요걸 여러개 for()문 같은 걸로 적어 주면 되겠죠..
    // 한 500명 정도까지는 무난한걸로 보입니다. 정확히는 몰겠슴다 --

    fputs($fp, "data\r\n");			fgets($fp, 128);
    // 아래부터 메일 내용 입력하겠다는 명령

    fputs($fp, "Return-Path: <$from>\r\n");
    // 메일이 잘못 같은때 되돌아오는 메일 주소

    fputs($fp, "From: \"$fromname\" <$from>\r\n");
    fputs($fp, "To: <$to>\r\n");
    //fputs($fp, "Cc: $encoded_mailcc\r\n");
    fputs($fp, "Subject: $subject\r\n");
    // 머 대충 보면 알겠죠..^^

    fputs($fp, "X-Mailer: BR-net\r\n");
    // X 로 시작하는 명령은 3rd party 명령어 라구 하더라구요..
    // 그니까 표준이 아니라는 소리죠... 함 넣어봤습니다
    // 아웃룩으로 멜 보내고 헤더 보면 잡다한게 몇개 더 있습니다.

    fputs($fp, "MIME-Version: 1.0\r\n");

    // 첨부파일이 있을때 부분입니다...
    // 첨부파일이 있을때는 본문을 여러개의 섹터(?) 로 나누어서 각각에 넣어야 합니다.

    // 첨부파일 없을때는 간단함다..

    fputs($fp, "Content-Type: text/html;\r\n");
    fputs($fp, "    charset=\"euc-kr\"\r\n");
    fputs($fp, "Content-Transfer-Encoding: base64\r\n");
    fputs($fp, "\r\n");

    $body = chunk_split(base64_encode($body));
    fputs($fp, $body);
    fputs($fp, "\r\n");

    fputs($fp, "\r\n.\r\n");
    // 위에서 data 명령을 끝내때는 마지막에 . 을 붙여주면 끝납니다.

    $retval[2] = fgets($fp, 128);
    fclose($fp);


    // 에러코드가 리턴되면 중지
    // sendmail 에 명령을 내렸을때 응답코드로 250 이 오면 정상이고 이상이 있을때는 각각의 에러 코드가 옵니다
    // 250이 리턴되었나 확인하는 부분입니다
    if ( !ereg("^250", $retval[0]) || !ereg("^250", $retval[1]) || !ereg("^250", $retval[2]) ){
        echo("메일보내기를 실패 했습니다. 관리자에게 문의하여 주십시요");
    }
} //메일함수 끝

// URL, Mail을 자동으로 체크하여 링크만듬
function get_link($str){// URL 치환
    $str=" ".$str;
    $str = eregi_replace( ">http://([a-z0-9\_\-\.\/\~\@\?\=\;\&\#\-]+)", "><a href=http://\\1 target=_blank>http://\\1</a>", $str);
    $str = eregi_replace( "&nbsp;&nbsp;http://([a-z0-9\_\-\.\/\~\@\?\=\;\&\#\-]+)", "&nbsp;&nbsp;<a href=http://\\1 target=_blank>http://\\1</a>", $str);
    $str = eregi_replace( " http://([a-z0-9\_\-\.\/\~\@\?\=\;\&\#\-]+)", " <a href=http://\\1 target=_blank>http://\\1</a>", $str);

    // 메일 치환
    $str = eregi_replace("([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)", "<a href=mailto:\\1@\\2>\\1@\\2</a>", $str);

    return $str;
} //URL, Mail 자동 링크 함수 끝

// 파일 사이즈를 이쁘게 변환해서 리턴
function GetFileSize($size){
    if($size<1024) return ($size."B");
    else if($size >1024 && $size< 1024 *1024){
        return sprintf("%0.1fKB",$size / 1024);
    }
    else return sprintf("%0.2fMB",$size / (1024*1024));
}

//=============================== 가로,세로 비율에 맞게 이미지 맞추기 ====================
//========= $target : 파일의 경로와 파일명 ===============================================
//========= $limit_width : 제한하고 싶은 가로 길이 =======================================
//========= $limit_height : 제한하고 싶은 세로 길이 ======================================
//========= 적용예 : list( $height_new, $width_new ) = img_size( "$target", "90", "70"); =

function img_size($target, $limit_width, $limit_height){
    $size = GetImageSize($target);

    $width = $size[0]; //입력받은 파일의 가로크기를 구합니다.
    $height = $size[1]; //입력받은 파일의 세로크기를 구합니다.

    $limit_w = $limit_width; // 원하는 최대 가로 크기를 입력합니다.
    $limit_h = $limit_height; // 원하는 최대 세로 크기를 입력합니다.

    if(!$percentage){
        $percentage = $percentage_w;
    }

    $percentage_w = $width/$limit_w; // 입력받은 이미지의 세로크기와 원하는 최대 세로크기의 비율
    $percentage_h = $height/$limit_h; // 입력받은 이미지의 세로크기와 원하는 최대 세로크기의 비율

    if($height > $limit_h || $width > $limit_w){ // 입력받은 이미지의 가로크기나 세로크기 중 어느 하나만 크더라도, 괄호 안의 내용을 실행

        if( ($height > $limit_h && $width > $limit_w && $percentage_w > $percentage_h) ||
            ($height < $limit_h && $width > $limit_w)){ // 세로길이와 가로길이 둘 다 제한크기보다 크고 가로의 크기가 세로의 크기보다 크거나, 세로길이는 제한크기보다 작고 가로길이가 제한크기보다 클 경우

            $percentage = $percentage_w; // 입력받은 그림의 가로길이와 한계치의 가로길이의 비율을 percentage 변수에 저장

        }elseif( ($height > $limit_h && $width > $limit_w && $percentage_w < $percentage_h) || ($height > $limit_h && $width < $limit_w)){ // 다른 경우에, 세로길이와 가로길이 둘 다 제한크기보다 크고 세로길이가 가로길이보다 크거나, 세로길이가 제한길이보다 크고 가로길이는 제한길이보다 작을 때,

            $percentage= $percentage_h; // 입력받은 그림의 세로길이와 한계치의 세로길이의 비율을 percentage 변수에 저장
        }
    }else{
        $percentage= 1;  // 입력받은 그림의 가로,세로 길이 둘 다 제한길이보다 크지 않을 때 입니다. 그럴 때는 percentage를 1로 함
    }

    $height_new = $height/$percentage; // 여러가지 경우에 따라 설정된 percentage값으로 세로 길이를 다시 설정
    $width_new = $width/$percentage; // 여러가지 경우에 따라 설정된 percentage값으로 가로 길이를 다시 설정

    return array($height_new, $width_new);
}
?>