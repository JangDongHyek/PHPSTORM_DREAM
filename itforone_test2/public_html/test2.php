<?
include "./_common.php";

if ($_SERVER['REMOTE_ADDR'] != "183.103.22.103") exit;

if ($_POST['mb_id'] == "") {
?>

<div id="mb_login" class="mbskin" style="width: 50%;">
    <h1><p>LOGIN</p></h1>
    <form name="flogin" action="?" onsubmit="return flogin_submit(this);" method="post">
        <input type="text" name="mb_id" id="login_id" class="frm_input" size="20" maxlength="20" placeholder="ID">
        <input type="submit" value="LOGIN" class="btn_submit">
    </form>
</div>

<script>
function flogin_submit(f){
	if (f.mb_id.value == "") {
		f.mb_id.focus();
		return false;
	}
	return true;
}
</script>

<?
} else {
	$mb = get_member($_POST['mb_id']);

	if (!$mb['mb_id']) {
		alert('가입된 회원아이디가 아닙니다.');
	}

	// 1. 세션해제
	/*
	session_unset(); // 모든 세션변수를 언레지스터 시켜줌
	session_destroy(); // 세션해제함
	*/
	set_cookie('ck_mb_id', '', 0);
	set_cookie('ck_auto', '', 0);
	//set_cookie_app('mb_id', $mb['mb_id'], 86400);

	// 2. 새션 생성
	set_session('ss_mb_id', $mb['mb_id']);
	set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

	$key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
    set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 365);
    set_cookie('ck_auto', $key, 86400 * 365);
?>
<h1>session complete</h1>
<div style='font-size: 1.2em; margin-bottom: 20px;'><?=$mb['mb_id']?></div>
<a href="<?=G5_ADMIN_URL?>">관리자</a>
<a href="<?=G5_URL?>">사이트</a>

<?
}

exit;

/***********************************************
2) 1)에서 업로드한 DB 중복제거 등록 (도로명코드로 묶음)
************************************************/
$re = sql_query("SELECT * FROM new_map_en GROUP BY loadcode");
$result_cnt = sql_num_rows($re);

$upload_cnt = 0;

while($row = sql_fetch_array($re)){
	$full_gu = $row['si'].' '.$row['gu'].' '.$row['dong'];
	$full_new = $row['si'].' '.$row['gu'].' '.$row['loadname'];

	$sql = "INSERT INTO new_map_code_en SET
			si = '{$row['si']}',
			gu = '{$row['gu']}',
			dong = '{$row['dong']}',
			l_name = '{$row['loadname']}',
			full_gu = '{$full_gu}',
			full_new = '{$full_new}'
			";
	if (sql_query($sql)) {
		$upload_cnt++;
	}
}

echo "총 개수: ".$result_cnt;
echo " // 업로드 수 : ".$upload_cnt;



/***********************************************
1) DB전체 업로드
************************************************/

$addr_file = array(0=>"rn_seoul.txt", 1=>"rn_busan.txt", 2=>"rn_daegu.txt", 3=>"rn_incheon.txt", 4=>"rn_gwangju.txt",
					5=>"rn_daejeon.txt", 6=>"rn_ulsan.txt", 7=>"rn_sejong.txt", 8=>"rn_gyunggi.txt", 9=>"rn_gangwon.txt",
					10=>"rn_chungbuk.txt", 11=>"rn_chungnam.txt", 
					12=>"rn_jeonbuk.txt", 13=>"rn_jeonnam.txt",
					14=>"rn_gyeongbuk.txt", 15=>"rn_gyeongnam.txt", 16=>"rn_jeju.txt"
				  );


exit; 

/*
// 총 530만건 업로드
for ($i = 0; $i < count($addr_file); $i++) {
	$addr_path = G5_DATA_PATH."/test/".$addr_file[$i];
	$lines = @file($addr_path) or die("파일읽기실패");
	$total_lines = count($lines);
	echo $addr_file[$i]." :: ".number_format($total_lines)."<br>";
}
*/

$file_idx = 16;	// 파일
$line_inx = 0;	// 시작종료라인

$addr_path = G5_DATA_PATH."/test/".$addr_file[$file_idx];
$lines = @file($addr_path) or die("파일읽기실패");
$total_lines = count($lines);

echo $addr_file[$file_idx]." :: ".number_format($total_lines)."<hr>";

exit;

//				0			1		2		3		4			5			6
$st_line = array(0,			200000,	400000, 600000,	800000,		1000000,	1200000);
$en_line = array(200000,	400000, 600000,	800000,	1000000,	1200000,	1300000);

for ($i = $st_line[$line_inx]; $i < $en_line[$line_inx]; $i++) {

	$addr = explode("|", $lines[$i]);

	echo "<h1>".($i+1)."</h1>";
	//print_r($addr);
	//if ($i == 0) exit;

	$code = $addr[0];			// 법정동코드
	$si = $addr[1];				// 시
	$gu = $addr[2];				// 구/군
	$dong = $addr[3];			// 동
	$loadcode = $addr[8];		// 도로명코드 (group by)
	$loadname = $addr[9];		// 도로명영문
	$zipcode = $addr[14];		// 우편번호

	if ($i == $total_lines) break;
	
	$sql = "INSERT INTO new_map_en SET 
			code = '{$code}',
			si = '{$si}',
			gu = '{$gu}',
			dong = '{$dong}',
			loadcode = '{$loadcode}',
			loadname = '{$loadname}',
			zipcode = '{$zipcode}'
			";
	if ($i == $st_line[$line_inx]) {
		echo $sql."<br>";
	}
	//exit;

	echo (sql_query($sql))? "완료" : "실패";

	echo "<hr>";
}

echo "<script>document.body.style.background = '#ac9dd4';</script>";

