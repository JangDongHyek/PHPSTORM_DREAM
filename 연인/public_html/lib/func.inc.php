<?
  function getCopy($val,$oldPath,$newPath){
    if($val){
      copy($oldPath,$newPath);
      unlink($oldPath);
    }
  }
  function getImage($path,$noPath,$file){
    if($file){
      if(file_exists($path.$file)){
        return $path.$file;
      }else{
        return $noPath;
      }
    }else{
      return $noPath;
    }
  }
	//한글 초성만 뽑아내기
	//초성검색시 필요함
	function utf8_strlen($str) { return mb_strlen($str, 'UTF-8'); }
	function utf8_charAt($str, $num) { return mb_substr($str, $num, 1, 'UTF-8'); }
	function utf8_ord($ch) {
		$len = strlen($ch);
		if($len <= 0) return false;
		$h = ord($ch{0});
		if ($h <= 0x7F) return $h;
		if ($h < 0xC2) return false;
		if ($h <= 0xDF && $len>1) return ($h & 0x1F) <<  6 | (ord($ch{1}) & 0x3F);
		if ($h <= 0xEF && $len>2) return ($h & 0x0F) << 12 | (ord($ch{1}) & 0x3F) << 6 | (ord($ch{2}) & 0x3F);          
		if ($h <= 0xF4 && $len>3) return ($h & 0x0F) << 18 | (ord($ch{1}) & 0x3F) << 12 | (ord($ch{2}) & 0x3F) << 6 | (ord($ch{3}) & 0x3F);
		return false;
	}

	function cho_hangul($str) {
		$cho = array("ㄱ","ㄲ","ㄴ","ㄷ","ㄸ","ㄹ","ㅁ","ㅂ","ㅃ","ㅅ","ㅆ","ㅇ","ㅈ","ㅉ","ㅊ","ㅋ","ㅌ","ㅍ","ㅎ");
		$result = "";
		for ($i=0; $i<utf8_strlen($str); $i++) {
			$code = utf8_ord(utf8_charAt($str, $i)) - 44032;
			if ($code > -1 && $code < 11172) {
				$cho_idx = $code / 588;      
				$result .= $cho[$cho_idx];
			}
		}
		return $result;
	}
	//달력 보여주기
	function getCalendar($date,$path){
    global $aca_idx;
    $time=strtotime($date);
    // 1. 총일수 구하기
    $last_day = date("t", $time);

    // 2. 시작요일 구하기
    $start_week = date("w", strtotime(date("Y-m",$time)."-01"));
    // 3. 총 몇 주인지 구하기
    $total_week = ceil(($last_day + $start_week) / 7);
    // 4. 마지막 요일 구하기
    $last_week = date('w', strtotime(date("Y-m",$time)."-".$last_day));
    include $path."/calender.php";
  }
  function send_notification ($tokens, $message)
  {
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
      'registration_ids' => $tokens,
      //'content_available'=>true,
      'data' => $message,
      'priority'          => 'high'
      //'notification'      => array( 'title' => 'CATCHA', 'body' => $message['message'])
      );

    $headers = array(
      'Authorization:key =AAAAvxu6rW4:APA91bGdh33dRiN4ilKrC6G6YAITkxrXTnpucpXd0ZZv8JD-O67ovotq-XOqd_HbhH5TBljMiJFmY73_DXtvifKg_peTTIks-R1RTwjO_n5x-NYsgU0V_6pIuFv9SnktFS_WR__-NptD' ,
      'Content-Type: application/json'
      );
    
     $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);           
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       return $result;
  }
	function dateCal($date1,$date2){
		$date=$date1-$date2;
		$day=floor($date/86400);
		$time=$date-($day*86400);
		$hours=floor($time/3600);
		if($day<1){
			return $hours."시간전";
		}else if($day<2){
			return $day."일전";
		}else{
			return date("Y-m-d H:i:s",$date2);
		}
	}
	function academyIdx($mb_id){
		$sql="select * from g5_teacher where mb_id='$mb_id'";
		$result=sql_query($sql);
		$row=sql_fetch_array($result);
		$aca_idx=$row[aca_idx];
		if(!$aca_idx){
			$sql="select * from g5_academy where mb_id='$mb_id' order by idx desc";
			$result2=sql_query($sql);
			$row2=sql_fetch_array($result2);
			$aca_idx=$row2[idx];
		}
		return $aca_idx;
	}
	function academyIdx2($mb_id){
		$sql="select * from g5_student where mb_id='$mb_id' order by idx desc";
		$result=sql_query($sql);
		$row=sql_fetch_array($result);
		$aca_idx=$row[aca_idx];
		return $aca_idx;
	}
	function generateRenStr($length) {  

    $characters  = "abcdefhjkmnopqrstuvwxyz";         

    $rendom_str = "";  

    $loopNum = $length;  

    while ($loopNum--) {  

        $rendom_str .= $characters[mt_rand(0, strlen($characters))];  

    }  

    return $rendom_str;  
	}
	function generateRenStr2($length) {  

    $characters  = "1234567890";         

    $rendom_str = "";  

    $loopNum = $length;  

    while ($loopNum--) {  

        $rendom_str .= $characters[mt_rand(0, strlen($characters))];  

    }  

    return $rendom_str;  
}
function goSms($reserv_phone, $send_phone, $msg)
{
	$conn_db=mysql_connect("211.51.221.165","emma","wjsghk!@#");
	mysql_select_db("emma");
	$mart_id = "hongbu"; //계정명	

	$number_receive_people=0;
	$tran_phone1 = $reserv_phone;		//"010-3997-0894";//받는 사람 번호 
	$tran_callback1 = $send_phone;		//"010-3997-0894";//보내는 사람 번호
	$send_date = date("YmdHis");

	if(!$tran_callback1){
		alert("전화번호가 잘못되었습니다. 다시 입력해주세요.");
		exit;
	}

	$msg1 = $msg;		//"[".$_POST['sms_name'].":".$_POST['sms_tel']."]".$_POST['sms_content']; //내용

	$tran_msg1 = iconv("UTF-8","EUC-KR",$msg1);

	$sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1')";
	$result=mysql_query($sms_query,$conn_db);
	if(!$result){
		echo mysql_error();
	}

	//전체기록남기기
	$all_query = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1',curdate())";
	$result2=mysql_query($all_query,$conn_db);
	if(!$result2){
		echo mysql_error();
	}

	$query = "Insert into tbl_sms(f_idno,f_from_phone,f_to_phone,f_comment,f_wdate) values('$mart_id','$tran_callback1','$tran_phone1','$tran_msg1','$send_date')";
	sql_query($query); 
	//	alert("문의문자가 전송되었습니다.");

}
?>