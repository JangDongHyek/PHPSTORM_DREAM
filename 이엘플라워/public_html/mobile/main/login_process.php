<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect_login.php";

if( !$url ){
	$url = "../main/";
} 

if( !$username ){
	echo ("
		<script>
		window.alert('���̵� �Է����� �ʾҽ��ϴ�.')
		history.go(-1)
		</script>
	");
	exit;
}

if( !$password ){
	echo ("
		<script>
		window.alert('��й�ȣ�� �Է����� �ʾҽ��ϴ�.')
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
		$_SESSION["Mall_Admin_ID"] = $row[username];		// ������ ���̵�
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
		alert('�������� �ʴ� ���̵��Դϴ�.');
		history.go(-1);
		</script>
	");
	exit;
}

$login_date = date("Y-m-d H:i:s");//������ ���ӽð�

//================ �� ��й�ȣ�� ���Ͽ� ��ġ�ϸ� ������ ������ =========================
if( strcmp( $db_passwd, get_password_str($password) ) ){ // �� ������ ���Ͽ� ������ else{}, �ٸ��� if()�� ������
	echo("
		<script>
		alert('�߸��� ȸ�������Դϴ�. �ٽ� �Է����ּ���!');
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


			//==================== ȸ�� ������ ��Ű�� ������ =============================
			setcookie("na3_member",$username,time()+30*24*3600,"/");
			//setcookie("member_id",$username,time()+30*24*3600,"/");

			//==================== ȸ�� ������ �´ٸ� ���ӽð��� ������ ======================
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
			//==================== ȸ�� ������ �´ٸ� ���ӽð��� ������ ======================
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
			window.alert('{$url}�� �ȳ��ϼ���!');
			window.alert('{$MemberName}�� �ȳ��ϼ���!');
			</script> -->
			<meta http-equiv='Refresh' content='0; url=$url'>
			 
		");
	}
}


mysql_free_result( $result );
mysql_close($dbconn);
?>