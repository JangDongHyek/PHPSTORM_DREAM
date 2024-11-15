<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect_login.php";

if( !$url ){
	$url = "../main/";
} 

if( !$username ){
	echo ("
		<script>
		window.alert('아이디를 입력하지 않았습니다.')
		history.go(-1)
		</script>
	");
	exit;
}

if( !$password ){
	echo ("
		<script>
		window.alert('비밀번호를 입력하지 않았습니다.')
		history.go(-1)
		</script>
	");
	exit;
}

if( $member_type == "1" ){
	$query = "select * from $Mart_Member_NewTable where username ='$username'";
	$result = mysql_query( $query, $dbconn );
	$total = mysql_num_rows( $result );
	$row = mysql_fetch_array( $result );

	if(!$total)
	{
		$query = "select * from $MemberTable where username ='$username'";
		$result = mysql_query( $query, $dbconn );
		$total = mysql_num_rows( $result );
		$row = mysql_fetch_array( $result );
		$_SESSION["Mall_Admin_ID"] = $row[username];		// 관리자 아이디
	}

	$username = $row[username];
	$db_passwd = $row[password];
	$perms = $row[perms];
	$name = $row[name];
	$email = $row[email];
	
}else if( $member_type == "2" || $member_type == "3" ){
	$query = "select * from $MemberTable where username ='$username'";
	$result = mysql_query( $query, $dbconn );
	$total = mysql_num_rows( $result );
	$row = mysql_fetch_array( $result );

	$username = $row[username];
	$db_passwd = $row[password];
	$perms = $row[perms];
	$name = $row[name];
	$email = $row[email];
}
if( !$username ){
	echo("
		<script>
		alert('존재하지 않는 아이디입니다.');
		history.go(-1);
		</script>
	");
	exit;
}

$login_date = date("Y-m-d H:i:s");//마지막 접속시간

//================ 두 비밀번호를 비교하여 일치하면 세션을 생성함 =========================
if( strcmp( $db_passwd, get_password_str($password) ) ){ // 두 변수를 비교하여 같으면 else{}, 다르면 if()를 실행함
	echo("
		<script>
		alert('잘못된 회원정보입니다. 다시 입력해주세요!');
		history.go(-1);
		</script>
	");
	exit;
}else{
	if( headers_sent() ){
		error("HTTP_HEADERS_SENT");
		exit;
	}else{
		if( $member_type == "1" ){
			$UnameSess   = $username;
			$MemberLevel  = $perms;
			$MemberName  = $name;
			$MemberEmail  = $email;

	        //session_register("UnameSess");
	        //session_register("MemberLevel");
		    //session_register("MemberName");
			//session_register("MemberEmail");
			$_SESSION["UnameSess"] = $username;
			$_SESSION["MemberLevel"] = $perms;
			$_SESSION["MemberName"] = $name;
			$_SESSION["MemberEmail"] = $email;


			//==================== 회원 정보를 쿠키에 저장함 =============================
			setcookie("na3_member",$username,time()+30*24*3600,"/");
			//setcookie("member_id",$username,time()+30*24*3600,"/");

			//==================== 회원 정보가 맞다면 접속시간을 저장함 ======================
			$sql = "update $Mart_Member_NewTable set login_date='$login_date', login_count=login_count+1 where username='$username'";
		}else if( $member_type == "2" || $member_type == "3" ){
			$Mall_Admin_ID   = $username;
			$MemberLevel  = $perms;
			$MemberName  = $name;
			$MemberEmail  = $email;

			$_SESSION["Mall_Admin_ID"] = $username;
			$_SESSION["UnameSess"] = $username;
			$_SESSION["MemberLevel"] = $perms;
			$_SESSION["MemberName"] = $name;
			$_SESSION["MemberEmail"] = $email;
			//==================== 회원 정보가 맞다면 접속시간을 저장함 ======================
			$sql = "update $MemberTable set lastlogin='$login_date', loginno=loginno+1 where username='$username'";
		}
		
		$res = mysql_query( $sql, $dbconn );

		$url = str_replace( "|", "?", $url );
		$url = str_replace( "!", "&", $url );
?>
<script language='javascript'>var _AceTM=(_AceTM||{});_AceTM.Login={uID:'member'}</script>
<!--AceCounter-Plus Log Gathering for AceTag Manager V.9.2.20170103-->
<script type="text/javascript">
var _AceTM = (function (_j, _s, _b, _o, _y) {
	var _uf='undefined',_pmt='',_lt=location;var _ap = String(typeof(_y.appid) != _uf ? _y.appid():(isNaN(window.name))?0:window.name);var _ai=(_ap.length!=6)?(_j!=0?_j:0):_ap;if(typeof(_y.em)==_uf&&_ai!=0){var _sc=document.createElement('script');var _sm=document.getElementsByTagName('script')[0];
	var _cn={tid:_ai+_s,hsn:_lt.hostname,hrf:(document.referrer.split('/')[2]),dvp:(typeof(window.orientation)!=_uf?(_ap!=0?2:1):0),tgp:'',tn1:_y.uWorth,tn2:0,tn3:0,tw1:'',tw2:'',tw3:'',tw4:'',tw5:'',tw6:'',tw7:_y.pSearch};_cn.hrf=(_cn.hsn!=_cn.hrf)?_cn.hrf:'in';for(var _aix in _y){var _ns=(_y[_aix])||{};
	if(typeof(_ns)!='function'){_cn.tgp=String(_aix).length>=3?_aix:'';_cn.tn2=_ns.pPrice;_cn.tn3=_ns.bTotalPrice;_cn.tw1=_ns.bOrderNo;_cn.tw2=_ns.pCode;_cn.tw3=_ns.pName;_cn.tw4=_ns.pImageURl;_cn.tw5=_ns.pCategory;_cn.tw6=_ns.pLink;break;};};_cn.rnd=(new Date().getTime());for(var _alx in _cn){
	var _ct=String(_cn[_alx]).substring(0,128);_pmt+=(_alx+"="+encodeURIComponent((_ct!=_uf)?_ct:'')+"&");};_y.acid=_ai;_y.atid=_cn.tid;_y.em=_cn.rnd;_sc.src=((_lt.protocol.indexOf('http')==0?_lt.protocol:'http:')+'//'+_b+'/'+_o)+'?'+_pmt+'py=0';_sm.parentNode.insertBefore(_sc,_sm);};return _y;
})(127793,'CT-50-A', 'atm.acecounter.com','ac.js',window._AceTM||{});
</script>
<!--AceCounter-Plus Log Gathering for AceTag Manager End -->
<?
		echo ("
			<!-- <script>
			window.alert('{$url}님 안녕하세요!');
			window.alert('{$MemberName}님 안녕하세요!');
			</script> -->
			<meta http-equiv='Refresh' content='0; url=$url'>
			 
		");
	}
}


mysql_free_result( $result );
mysql_close($dbconn);
?>