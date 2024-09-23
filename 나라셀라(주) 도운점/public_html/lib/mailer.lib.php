<?php
if (!defined('_GNUBOARD_')) exit;

include_once(G5_PHPMAILER_PATH.'/PHPMailerAutoload.php');

// 메일 보내기 (파일 여러개 첨부 가능)
// type : text=0, html=1, text+html=2
function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="")
{
    global $config;
    global $g5;

    // 메일발송 사용을 하지 않는다면
    if (!$config['cf_email_use']) return;

    if ($type != 1)
        $content = nl2br($content);

    $mail = new PHPMailer(); // defaults to using php "mail()"
    if (defined('G5_SMTP') && G5_SMTP) {
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->Host = G5_SMTP; // SMTP server
        if(defined('G5_SMTP_PORT') && G5_SMTP_PORT)
            $mail->Port = G5_SMTP_PORT;
    }
    $mail->CharSet = 'UTF-8';
    $mail->From = $fmail;
    $mail->FromName = $fname;
    $mail->Subject = $subject;
    $mail->AltBody = ""; // optional, comment out and test
    $mail->msgHTML($content);
    $mail->addAddress($to);
    if ($cc)
        $mail->addCC($cc);
    if ($bcc)
        $mail->addBCC($bcc);
    //print_r2($file); exit;
    if ($file != "") {
        foreach ($file as $f) {
            $mail->addAttachment($f['path'], $f['name']);
        }
    }
    
    var_dump($mail);
    return $mail->send();
}


function itforoneMailer($from,$from_name,$to,$to_name,$subject,$content){
	$url  = "https://www.hostmeca.com/user_mail_relay.php";
	$post = array();

	$post['uid']       = "lets080"; // 회원 아이디 (필수입력)
	$post['from']      = "$from"; // 보내는 사람 메일주소 (필수입력)
	$post['from_name'] = "$from_name"; // 보내는 사람 이름
	$post['to']        = "$to"; // 받는 사람 메일 주소 (필수입력)
	$post['to_name']   ="$to_name"; // 받는 사람 이름
	$post['subject']   = "$subject"; // 메일 제목 (필수입력)
	$post['content']   ="$content"; // 메일 내용 (필수입력)
	$post['html']      = "Y"; // html 형식 여부.(Y : html 형식, N : text 형식)
	

	//$post = funcEuckrToUtf8($post);


	$curl = curl_init(); 

	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
	curl_setopt($curl, CURLOPT_POST, 1); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($curl, CURLOPT_POSTFIELDS, $post);

	$output = curl_exec($curl);

	curl_close($curl);

	$data = json_decode($output, true);

	//echo "<pre>";
	//var_dump($data);
	//echo "<pre>";

	/*
	$data 배열값
	$data['rslt'] // 결과값 (true, false)
	$data['code'] // 결과 코드값
	$data['msg']  // 결과 메세지
	*/
	//echo $data['code']."<br>";
	//echo mb_convert_encoding($data['msg'], "UTF-8", "EUC-KR");
	//exit;

	//$msg = mb_convert_encoding("메일이 전송되었습니다", "UTF-8", "EUC-KR");

	//echo "<script>alert('$msg');window.close();</script>";

	/*
	// 결과 코드값
	S00 - 성공
	E01 - 가입된 회원이 아님
	E02 - 서비스이용 가능한 회원이 아님
	E03 - 접속 가능한 서버가 아님
	E04 - 보내는 사람 메일주소 없음
	E05 - 보내는 사람 메일주소 형식오류
	E06 - 받는 사람 메일주소 없음
	E07 - 받는 사람 메일주소 형식오류
	E08 - 메일 제목 없음
	E09 - 메일 내용 없음
	E10 - 메일 발송시 에러
	*/



}
/******************************************************************************
 - 함수명 : funcEuckrToUtf8($str)
 - 용  도 : EUC-KR 문자를 UTF-8 문자로 변환하는 함수.
 - 속성값 : $str - EUC-KR 문자
 - 결과값 : UTF-8로 변환된 문자 반환
******************************************************************************/

function funcEuckrToUtf8($str) {
   $str = (!is_array($str)) ? mb_convert_encoding($str, "UTF-8", "EUC-KR") : array_map("funcEuckrToUtf8", $str);

   return $str;
}

// 파일을 첨부함
function attach_file($filename, $tmp_name)
{
    // 서버에 업로드 되는 파일은 확장자를 주지 않는다. (보안 취약점)
    $dest_file = G5_DATA_PATH.'/tmp/'.str_replace('/', '_', $tmp_name);
    move_uploaded_file($tmp_name, $dest_file);
    $tmpfile = array("name" => $filename, "path" => $dest_file);
    return $tmpfile;
}
?>