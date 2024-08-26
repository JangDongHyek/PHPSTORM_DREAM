<?
	require_once("include/bbs.lib.inc.php");

	if($pw_mode =="ok"){
		$sql="select * from reservation_com where id='$view_id' and view_pw='$view_pw'";
		//echo $sql;
		//exit;

		$result = mysql_query($sql);
		$rows = mysql_fetch_array($result);
		if(!$view_pw){		
			echo"<script>alert('비밀번호를 입력해주세요');history.go(-1);exit;</script>";
			exit;
		}
		elseif($rows[view_pw]==$view_pw){
			$ss_auth_ok = date("YmdHis");
			$_SESSION['ss_auth_ok']=$ss_auth_ok;

			echo"<script>location.href='./list.php?bbs_id=$bbs_id&ss[fc]=$ss[fc]&view_id=$view_id';exit;</script>";

		}else{
			echo"<script>alert('비밀번호가 일치하지 않습니다');history.go(-1);exit;</script>";
			exit;
		}
	}

	if($MemberLevel == 1){

		echo"<script>location.href='./list.php?bbs_id=$bbs_id&ss[fc]=$ss[fc]&view_id=$view_id';exit;</script>";
		
	}else{
	?>
			<form name=form action="./list_front.php" method=post>
			<input type="hidden" name="pw_mode" value="ok">
			<input type="hidden" name="bbs_id" value="<?=$bbs_id?>">
			<input type="hidden" name="ss[fc]" value="<?=$ss[fc]?>">
			<input type="hidden" name="view_id" value="<?=$view_id?>">

			비밀번호:<input type=password name="view_pw"><input type=submit value="확 인">
			</form>
	<?
	}
	?>