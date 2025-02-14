<?php
$sub_id = "mem_new";
include_once('./_common.php');

// 로그인 확인
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다.\\n로그인 후 다시 이용해주세요.", G5_BBS_URL . '/login.php');
}

// 23.04.05 회원권 구매유도 get으로 팝업띄울지말지 결정
if ($member['mb_approval_request'] == 'Y' && $member['mb_approval'] == 'N') { // 프로필 승인 여부 확인
	alert("프로필 심사 중입니다.\\n심사 완료 시 모든 컨텐츠 이용이 가능합니다.\\n회원권 구매 확인 후 심사 진행됩니다.", G5_URL );
}
else if($member['mb_approval_request'] == 'N') { // 프로필 미작성 시 회원가입완료 페이지로 이동
	alert("프로필을 작성해주세요.\\n작성 후 심사 완료 시 모든 컨텐츠 이용이 가능합니다.");
}

// 비공개 회원 체크
if($member['show_yn'] == 'N' && $member['mb_id'] != 'hong') {
	alert('비공개 회원으로 컨텐츠를 이용할 수 없습니다.');
}

$is_mypage = "mem_new";
$g5['title'] = '전체회원';
//23.10.26 승인안된회원 wc
if(!empty($mb_approval)) {
	$g5['title'] = '승인대기중 회원';
}
include_once('./_head.php');

// 가입한지 1주일 이내 회원만 조회 -- and date_format(mb_join_date, '%Y-%m-%d') >= '{$date}' order by mb_no desc -- 주석
//$timestamp = strtotime(date('Y-m-d') . "-1 week");
//$date = date("Y-m-d", $timestamp);



$sql = " select * from g5_noshow where mb_no = {$member['mb_no']}; "; // 내가 비노출 처리한 회원
$result = sql_query($sql);
$noshow_arr = array();
for($i=0; $row=sql_fetch_array($result); $i++) {
	array_push($noshow_arr, $row['noshow_mb_no']);
}

$sql = " select * from g5_noshow where noshow_mb_no = {$member['mb_no']}; "; // 나를 비노출한 회원 (리스트에서 보이면 안됨)
$result = sql_query($sql);
$noshow = '';
for($i=0; $row=sql_fetch_array($result); $i++) {
	$noshow .= $row['mb_no'].',';
}
$noshow = substr($noshow, 0, -1);
$sql_add = '';
if(!empty($noshow)) {
	$sql_add = ' and mb_no not in ('.$noshow.') ';
}


//23.04.04 성별에 맞는것만 나오게 wc
$mysex = $_REQUEST['mysex']; // 검색데이터
$sex = $_REQUEST['sex']; // 검색데이터
$age = $_REQUEST['age'];
$si = $_REQUEST['si'];
$gu = $_REQUEST['gu'];
$type = $_REQUEST['type'];
$join_type = $_REQUEST['join_type'];
$sch = $_REQUEST['sch'];
$mb_approval = $_REQUEST['mb_approval'];

$min_age = explode('~',$age)[0];
$max_age = explode('~',$age)[1];
if(empty($max_age)) { $max_age = 99; }
$min_birth = date('Y')+1-$max_age;
$max_birth = date('Y')+1-$min_age;

//23.04.04 같은교회사람 안보이게 빼주는거 wc
if($member['mb_id']){
	$sql = "select * from new_member_interview where mb_id = '{$member['mb_id']}' ";
	$mi = sql_fetch($sql);
	$sql = " select * from new_member_interview where mi_church1 = '{$mi['mi_church1']}'; "; // 내가 비노출 처리한 회원
	$result = sql_query($sql);
	$noshow2 = '';
	for($i=0; $row=sql_fetch_array($result); $i++) {
		$noshow2 .= '\''.$row['mb_id'].'\',';
	}
	$noshow2 = substr($noshow2, 0, -1);
	if(!empty($noshow2)) {
		$sql_add .= ' and mb_id not in ('.$noshow2.') ';
	}
}

//23.04.04 남자면 여자만보이고, 여자면 남자만 보이게 wc
if($member['mb_sex'] == "남"){
	$sql_add .= ' and mb_sex = "여" ';
}else if($member['mb_sex'] == "여"){
	$sql_add .= ' and mb_sex = "남" ';
}

//23.10.20 검색기능 밖으로뺌
if(!empty($sex)) { $sql_add .= " and mb_sex = '{$sex}' "; }
if(!empty($sex)) { $sql_add .= " and mb_sex = '{$sex}' "; }
if(!empty($age)) { $sql_add .= " and substring(mb_birth, 1, 4) >= '{$min_birth}' and substring(mb_birth, 1, 4) <= '{$max_birth}' "; }
if(!empty($si)) { $sql_add .= " and mb_live_si like '{$si}%' "; }
if(!empty($gu)) { $sql_add .= " and mb_live_gu like '{$gu}%' "; }
if(!empty($type)) { $sql_add .= " and mb_character_type = '{$type}' "; }
if(!empty($join_type)) { $sql_add .= " and mb_join_type = '{$join_type}' "; }
if(!empty($sch)) { $sql_add .= " and ( mb_nick like '%{$sch}%' )"; }


// 21.06.29 장애인 회원은 장애인 회원만 조회
if($member['mb_join_type'] == '장애인') { $sql_add .= ' and mb_join_type = "장애인" '; }
else { $sql_add .= ' and mb_join_type != "장애인" '; }

/**
 * 앱 심사용 - 신고한 사용자 숨김
 * mem_new.php, mem_love.php, ajax.change_option.php
 */


/* 23.05.30 mb_approval 승인안된사람도 보이게
$sql = " select count(*) as cnt from {$g5['member_table']} as mb
  		 where mb_level = '2' and mb_approval = 'Y' and (secret_member is null or secret_member = '') {$sql_add} and show_yn = 'Y' ";
*/

if($member['secret_member'] == 'Y'){
	$sql = " select count(*) as cnt from {$g5['member_table']} as mb
  		 where mb_level = '2' {$sql_add} and show_yn = 'Y' ";
}else{
	$sql = " select count(*) as cnt from {$g5['member_table']} as mb
  		 where mb_level = '2' and (secret_member is null or secret_member = '') {$sql_add} and show_yn = 'Y' ";
}


//23.10.26 승인안된회원 wc 총개수
if(!empty($mb_approval)) {
	if($member['secret_member'] == 'Y'){
		$sql = "select count(*) as cnt from g5_member where mb_id != '{$member["mb_id"]}' and mb_id not like 'test%' and mb_approval = 'N'  {$sql_add} order by mb_no desc";
	}else{
		$sql = "select count(*) as cnt from g5_member where mb_id != '{$member["mb_id"]}'  and secret_member != 'Y' and mb_id not like 'test%' and mb_approval = 'N'  {$sql_add} order by mb_no desc";
	}
}

$row = sql_fetch($sql);
$total_count = $row['cnt'];

//$rows = $config['cf_page_rows'];
$rows = 12;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


if($member['mb_id'] == 'hong') {
	if(!empty(blockUser($member['mb_id']))) {
		$block = blockUser($member['mb_id']);
		$sql_add .= " and mb.mb_id not in ({$block}) ";
	}
}
$sql_add .= " and mb.mb_id != 'hong' "; // 테스트아이디

/* 23.05.30 mb_approval 승인안된사람도 보이게

$sql = " select mb.* from {$g5['member_table']} as mb
  		 where mb_level = '2' and mb_approval = 'Y' and (secret_member is null or secret_member = '') {$sql_add} and show_yn = 'Y' order by mb.mb_no desc limit {$from_record}, {$rows}  "; // 관리자가 회원 비노출로 변경 시 리스트에서 제외 (show_yn)
*/

//23.11.16 시크릿인사람은 시크릿보이게 wc
if($member['secret_member'] == 'Y'){
	$sql = " select mb.* from {$g5['member_table']} as mb
  		 where mb_level = '2' {$sql_add} and show_yn = 'Y' order by mb.mb_no desc limit {$from_record}, {$rows}  "; // 관리자가 회원 비노출로 변경 시 리스트에서 제외 (show_yn)
}else{
	$sql = " select mb.* from {$g5['member_table']} as mb
  		 where mb_level = '2' and  (secret_member is null or secret_member = '') {$sql_add} and show_yn = 'Y' order by mb.mb_no desc limit {$from_record}, {$rows}  "; // 관리자가 회원 비노출로 변경 시 리스트에서 제외 (show_yn)
}

//23.10.26 승인안된회원 wc
if(!empty($mb_approval)) {
	if($member['secret_member'] == 'Y'){
		$sql = "select mb.* from {$g5['member_table']} as mb where mb.mb_id != '{$member["mb_id"]}'  and mb_id not like 'test%' and mb_approval = 'N'  {$sql_add} order by mb.mb_no desc limit {$from_record}, {$rows} ";
	}else{
		$sql = "select mb.* from {$g5['member_table']} as mb where mb.mb_id != '{$member["mb_id"]}'  and secret_member != 'Y' and mb_id not like 'test%' and mb_approval = 'N'  {$sql_add} order by mb.mb_no desc limit {$from_record}, {$rows} ";
	}
	$qstr .= "&mb_approval=N";
}

$result = sql_query($sql);

include_once($member_skin_path.'/mem_new.skin.php');

include_once('./_tail.php');
?>
