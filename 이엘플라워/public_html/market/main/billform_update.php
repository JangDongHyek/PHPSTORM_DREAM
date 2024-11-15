<?
//================== DB 설정 파일을 불러옴 ===============================================
include_once("../../connect.php");
$sql="insert shop_bill set
			company='$company',
			repres='$repres',
			business='$business',
			line='$line',
			biz_no='$biz_no',
			biz_addr='$biz_addr',
			order_no='$order_no',
			res_email='$res_email',
			regdate='".time()."'";
$result=mysql_query($sql);
if($result){
	echo "<meta http-equiv='refresh' content='0;url=./billform.success.php'>";
	exit;
}else{
	echo "<meta http-equiv='refresh' content='0;url=./billform.fail.php'>";
	exit;
}
/*include_once("../../PHPMailer2/PHPMailerAutoload.php");
echo "<meta charset='utf-8'>";

	// 메일 보내기 (파일 여러개 첨부 가능)
	// type : text=0, html=1, text+html=2

	
function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="")
{
    if ($type != 1)
        $content = nl2br($content);
 
    $mail = new PHPMailer(); // defaults to using php "mail()"
    
    $mail->IsSMTP(); 
    $mail->SMTPDebug = 1; 
   

		$mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com"; 
    $mail->Port = '587'; 
		$mail->Username = "kimnamhyong@gmail.com";
    $mail->Password = "kim13422";
 
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
 
    if ($file != "") {
        foreach ($file as $f) {
            $mail->addAttachment($f['path'], $f['name']);
        }
    }
    return $mail->send();
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
$subject=$repres."님이 계산서를 요청하였습니다.";
$content='<table width="100%" cellpadding="0" cellspacing="0" border="0" class="email-form">
	<tbody>
	<tr>
		<th>회사명</th>
		<td>'.$company.'</td>
	</tr>
	<tr>
		<th>대표자명</th>
		<td>'.$repres.'</td>
	</tr>
	<tr>
		<th>업태</th>
		<td>'.$business.'</td>
	</tr>
	<tr>
		<th>업종</th>
		<td>'.$line.'</td>
	</tr>
	<tr>
		<th>사업자 등록번호</th>
		<td>'.$biz_no.'</td>
	</tr>
	<tr>
		<th>사업자 주소</th>
		<td>'.$biz_addr.'</td>
	</tr>
	<tr>
		<th>주문번호</th>
		<td>'.$order_no.'</td>
	</tr>
	<tr>
		<th>수령자이메일</th>
		<td>'.$res_email.'444</td>
	</tr>
	
	</tbody>
</table>';
mailer("test", "kimnamhyong@gmail.com", "kimnamhyong@gmail.com", "제목", "내용", 1);*/

?>