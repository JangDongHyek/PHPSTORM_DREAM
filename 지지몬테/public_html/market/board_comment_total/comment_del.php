<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
if($flag == "comdel"){
	if(!$Mall_Admin_ID&&$MemberLevel!=1){
		if( !$cmt_password ){
			echo("
				<script>
				window.alert('비밀번호를 입력하셔야 합니다.');
				history.go(-1)
				</script>
			");
			exit;
		}
		$query = "select c_password from board_comment where c_no='$c_no' and index_no='$index_no' and bbs_no='$bbs_no' and mart_id='$mart_id'" ;
		$result = mysql_query( $query, $dbconn );
		$row = mysql_fetch_array( $result );

		$real_passwd = $row[c_password];

		//==================== 비밀번호가 맞는지 체크함 ==========================================
		if( $real_passwd != $cmt_password ){
			echo("
				<script>
				window.alert('비밀번호가 맞지 않습니다');
				history.go(-1)
				</script>
			");
			exit;
		}
		if( $result ){
			mysql_free_result( $result );
		}

	}
	$SQL = "delete from board_comment where c_no = '$c_no' and index_no = '$index_no' and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	if( $dbresult ){
		echo("
			<script language='javascript'>
			self.close();
			window.opener.location.href = 'board_read.php?index_no=$index_no&bbs_no=$bbs_no&page=$page&mart_id=$mart_id&keyset=$keyset&searchword=$searchword';
			</script>
		");
	}else{
		echo("
			<script>
			window.alert('삭제하는데 실패했습니다.');
			history.go(-1);
			</script>
		");
	}
}
if($flag == "comment"){
#######################금지단어팅구기################################	
	if($tmp = rg_str_inword("_,포커,릴겜,급전,개.인.통.장,개인통장,방콕,꼬꼬,선불폰,막폰,URL,싸이,투데이,방문자,추적,버그,boris,현대남,현대여,aphsun.info,목카드,도박,특수렌즈,마킹카드,공장목,표시목,필승,화투,포르노,뽀르노,야동,화상채팅,대박이벤트,영계하고,데이또,재미짱,승률이,테크노,(바)카라,5000만원,입출금,생방송,바@카@라,천만원,키스,대박회원급증,용돈,㈓㈘㈑,강원랜드,야동,정력제,시알리스,비아그라,바카라,바/카/라,바카현이,섹스,폰섹,카지노,㉥┝㉪┝㉣┝,8억,추천id,추/천/인,바☆카☆라,바(카)라,남근확대,무료자료,━★,viagra,비아그라,sialis,시알리스,씨알리스,동거,섹스,viagra,비아그라,sialis,동거,섹스,프릴리지,상륙,아시는분만,신개념,바다이야기,피싱걸,황금성,물뽕,게임장,20원방,100원방,200원방,황 금 성,무료증정,경마,로얄,홍콩,부업,목카드,특수렌즈,도박,토토,http,href,www,url,URL,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,※,◀,▶",$cmt_comment)) {
		$error_msg = $tmp.'(은)는 사용할수 없는 단어입니다.';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;
	}
#######################################################################
	if(!$Mall_Admin_ID&&$MemberLevel!=1){ 
		if( !$cmt_name || !$cmt_password || !$cmt_comment){
			echo("
				<script>
				window.alert('필요한 값이 없습니다. 다시 입력해 주세요!');
				history.go(-1)
				</script>
			");
			exit;
		}
	}

	$cmt_reg_ip = $REMOTE_ADDR;
	$cmt_comment = addslashes($cmt_comment);

	$SQL = "insert into board_comment (c_no, index_no, bbs_no, mart_id, c_name, c_password, c_comment, c_reg_ip, c_regdate, user_id) values ('', '$index_no', '$bbs_no', '$mart_id', '$cmt_name', '$cmt_password', '$cmt_comment', '$cmt_reg_ip', now(), '$UnameSess')";
	$dbresult3 = mysql_query($SQL, $dbconn);

	if( $dbresult3 ){
		echo "<meta http-equiv='refresh' content='0; URL=board_read.php?index_no=$index_no&bbs_no=$bbs_no&page=$page&mart_id=$mart_id&keyset=$keyset&searchword=$searchword'>";
	}else{
		echo("
			<script>
			window.alert('다시 입력해 주세요!');
			history.go(-1)
			</script>
		");
		exit;
	}
}

mysql_close($dbconn);
?>