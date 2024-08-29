<?
class smsDB{
     var $Host;
     var $User;
     var $Passwd;
     var $DB;
     var $Connect;

     function smsDB($host="211.233.89.245", $user="smsmember", $passwd="qppalz1010", $db="SMSMember_db"){
         $this->Host = $host;
         $this->User = $user;
         $this->Passwd = $passwd;
         $this->DB = $db;
         $this->Connect = @mysql_connect($this->Host, $this->User, $this->Passwd) or die('DB연결이 실패하였습니다.');
         @mysql_select_db($this->DB, $this->Connect) or die('DB가 존재하지 않습니다.');
        }
     function mysqlQuery($Q) {
         $result = @mysql_query($Q, $this->Connect);
         return $result;
        }
     function CloseConnection(){
         if ($this->Connect) @mysql_close();
    }
     function freeResult()
    {
       return ( @mysql_free_result($result));
    }
}

function sms_member($sms_member_id)
{
   $db = new smsDB();
   $result = mysql_fetch_array(mysql_query("SELECT * FROM sms_member WHERE id='$sms_member_id'"));
   $db->freeResult();
   $db->CloseConnection();
   return $result;
}


function sms_bill_check($ref_sms_member_id,$ref_recv)  // 입금액(funds)와 단가(cost)를 나눔 = 발송통수체크 flag_no=0 : 정율제 1 : 정액제
{
   $member = sms_member($ref_sms_member_id);
   if($member[flag_no] == 0) { 
      $sms_cnt = $member[funds]/$member[cost]; 
      if(!$sms_cnt || $sms_cnt < count($ref_recv)) return false; else return true;
   }elseif($member[flag_no] == 1){
      if($member[limit_num] <= 0) return false; else return true;   
   }  
}


function sms_stand_by($send_tel, $recv_tel, $message, $client_code="S100010", $user_id, $user_area)
{
        $member=sms_member($user_id);
	
	if(!$member[id]) { echo "<script>alert('{$user_id}는 없는 id입니다.');history.go(-1);</script>"; exit;}
	if(!sms_bill_check($user_id,$ref_recv)) { echo"<script>alert('메시지를 보낼수 없습니다.충전금액이 부족합니다.!!');history.go(-1)</script>"; exit;}    
	$recv_arr=explode(",",$recv_tel);
	$recv_arr_count = count($recv_arr);

        if($member[flag_no] == 0){
	  for($i=0;$i<count($recv_arr);$i++) {
	    $result = sendsms($send_tel, $recv_arr[$i], $message, $client_code="S100010", $user_id, $user_area);
	  }
        }elseif($member[flag_no] == 1){
		for($i=0;$i<count($recv_arr);$i++) {
                 $result = sendsms($send_tel, $recv_arr[$i], $message, $client_code="S100010", $user_id, $user_area);
		}
	}

        if($result == "00") echo "<!-- <script>alert('발송완료하였습니다.!!');</script> -->";
		else echo "<!-- <script>alert('[발송 실패]\\n업체에 문의 하십시요.');</script> -->";
}

function sendsms($send_tel, $recv_tel, $message, $client_code="", $user_id, $user_area){
/*******************************************************************************
	$send_tel		: 보내는이 전화번호 (최대 14byte, '-'으로 구분)
	$recv_tel		: 받는이 전화번호 (최대 14byte, '-'으로 구분)
	$message		: 호출메세지 (최대 80byte)
	$client_code	: 고객코드 (7byte) : 투시안이 부여  S100010 <-- 부여받은 번호 
	$user_id		: 사용자아이디 (최대 20byte) : 회원사가 부여
	$user_area		: 회원사 영역 (최대 40byte) : 임시공간
*******************************************************************************/
	//SMS DB에 접속
    	$smsDBServerConn = new smsDB($host="210.114.223.57", $user="SMSMEMBERS", $passwd="8763sssms", $db="sms_db");

	$smsQuery = "INSERT INTO sms_msg(id,phone,callback,status,reqdate,msg) VALUES('$user_id','$recv_tel','$send_tel','0',NOW(),'$message')";
	$smsResult = mysql_query($smsQuery); 

	$smsDBServerConn -> CloseConnection();

	$db = new smsDB();
	$member=mysql_fetch_array(mysql_query("SELECT * FROM sms_member WHERE id='$user_id'"));

	mysql_query("INSERT INTO sms_data VALUES('','$rbuf_date','$rbuf_cli_code','$user_id','$rbuf_user_area','$send_tel','$rbuf_send_tel2','$rbuf_send_tel3','$recv_tel','$rbuf_recv_tel2','$rbuf_recv_tel3','$rbuf_ret_code','$message');");
	if($member[flag_no] == 0){
		mysql_query("UPDATE sms_member SET funds=funds-cost WHERE id='$user_id'"); 
	}else if($member[flag_no] == 1){
		mysql_query("UPDATE sms_member SET limit_num=limit_num-1 WHERE id='$user_id'");
	}
	$db -> CloseConnection();



}

?>
