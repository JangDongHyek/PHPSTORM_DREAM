<?
include_once('../common.php');
//include_once('../head.sub.php');
echo "<pre>";

die();

/*
// parent_no 업데이트
$sql = "SELECT * FROM g5_member_block WHERE parent_mb_no = 0 ORDER BY regdate asc;";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

for ($i = 0; $row = sql_fetch_array($result); $i++) {
    $mb_no = $row['mb_no'];
    $parent = sql_fetch("SELECT parent_mb_no FROM g5_member WHERE mb_no = '{$mb_no}'");
    echo $parent['parent_mb_no']."//".$row['mb_no'];

    // 업데이트
    $sql3 = "UPDATE g5_member_block SET parent_mb_no = '{$parent['parent_mb_no']}' WHERE mb_no = '{$mb_no}'";
    // echo sql_query($sql3)? "완료" : "실패";

    echo "<hr>";
}

die();
*/

/*
// 정상가입 아닌경우 (휴대폰번호 X)
$sql = "SELECT mb_no, mb_id, mb_name, mb_birth, mb_hp, parent_mb_no FROM g5_member 
        WHERE parent_mb_no = 0 AND mb_hp = '' ORDER BY mb_no ASC LIMIT 0, 3000";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

for ($i = 0; $row = sql_fetch_array($result); $i++) {
    // $mb_hp = str_replace("-", "", $row['mb_hp']);
    $mb_no = $row['mb_no'];

    // 회원정보
    print_r($row);
    // echo $mb_no == $parent_mb_no? "PASS:" : "중복:";
    // echo $parent_mb_no."<br>";

    // 업데이트
    $sql3 = "UPDATE g5_member SET parent_mb_no = '{$mb_no}' WHERE mb_no = '{$mb_no}'";
    echo sql_query($sql3)? "완료" : "실패";

    echo "<hr>";
}
*/

/*
// 회원 부모번호 업데이트
$sql = "SELECT mb_no, mb_id, mb_name, mb_birth, mb_hp, parent_mb_no FROM g5_member
        WHERE parent_mb_no = 0 AND mb_hp != '' ORDER BY mb_no ASC LIMIT 0, 3000";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

for ($i = 0; $row = sql_fetch_array($result); $i++) {
    $mb_hp = str_replace("-", "", $row['mb_hp']);
    $mb_no = $row['mb_no'];

    // 최초 mb_no 찾기
    $sql2 = "SELECT mb_no, mb_hp FROM g5_member
             WHERE REPLACE(mb_hp, '-', '') = '{$mb_hp}' AND mb_birth = '{$row['mb_birth']}' ORDER BY mb_no ASC LIMIT 0, 1";
    $row2 = sql_fetch($sql2);

    $parent_mb_no = $row2['mb_no'];

    // 회원정보
    print_r($row);
    echo $mb_no == $parent_mb_no? "PASS:" : "중복:";
    echo $parent_mb_no."<br>";

    // 업데이트
    $sql3 = "UPDATE g5_member SET parent_mb_no = '{$parent_mb_no}' WHERE mb_no = '{$mb_no}'";
    echo sql_query($sql3)? "완료" : "실패";

    echo "<hr>";
}




die();


$mart_id = "hongbu"; //계정명	
$conn_db = mysqli_connect("211.51.221.165","emma","wjsghk!@#","emma");
mysqli_query($conn_db,'set names utf8');
$conn_db->query('set names utf8');
//mysqli_query("SET SESSION character_set_server=utf8"); 


$sql = "SELECT * FROM emma.em_all_log WHERE tran_id = 'hongbu' AND tran_callback = '".COMMON_SEND_NUM."' AND tran_date LIKE '%-27%' ORDER BY tran_date ASC LIMIT 0 , 1000";
$result = mysqli_query($conn_db, $sql);


/*
$all_query = "Insert into emma.em_all_log 
(tran_pr,tran_id,
tran_phone,tran_callback,tran_status,
tran_date,tran_msg,reg_date) values 
(null,'$mart_id',
'$tran_phone1','$tran_callback1','1',
'$send_date','$tran_msg1',curdate())";
*/

$i = 1;
while($row = mysqli_fetch_array($result)) {
	echo "<h1>{$i}</h1>";
	echo $row['tran_phone']."<br>";
	echo $row['tran_date'];
	echo "<br>";
	//print_r($row);
	//echo "<br>";
	$i++;

}


//include_once('../tail.sub.php');
?>