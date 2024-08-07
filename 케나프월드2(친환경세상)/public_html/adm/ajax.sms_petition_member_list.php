<?
/*******************************************
회원문자발송 - 회원리스트
*******************************************/
include_once('./_common.php');
include_once('../util/SQLQueryBuilder.php');

$queryBuilder = new SQLQueryBuilder();
$memberId = $member['mb_id']; // 예를 들어, 현재 사용자 ID

$mbGroup = $_POST['mb_group'];
$param = $_POST['param'];
$createdAt = $_POST['created_at']; // 폼 필드의 name 속성에 따라 조정
$mbId = $_POST['mb_id'];
$address = $_POST['address'];

$sql = '';
$tableName = 'petition';
$whereStr = '';

switch($mbGroup){
    case 'name' : //이름
        if($param != ''){
            $whereStr = " ${mbGroup} like '%${param}%' ";
        }
        break;
    case 'created_at' : //작성일
        if($param != ''){
            $whereStr = " ${mbGroup} like '%${param}%' ";
        }
        break;
    case 'mb_id' : //아이디
        if($param != ''){
            $whereStr = " ${mbGroup} like '%${param}%' ";
        }
        break;
    case 'address' : //주소
        if($param != ''){
            $whereStr = " ${mbGroup} like '%${param}%' ";
        }
        break;
}

$sql = $queryBuilder->select("SELECT mb_id, name as mb_name, mb_hp, address, created_at")
    ->from($tableName)
    ->where($memberId != "lets080" ? "mb_id != 'lets080'" : "1=1")
    ->where($whereStr)
    ->orderBy("created_at DESC")
    ->getSQL();


$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

if ($result_cnt == 0) {
?>
<tr><td colspan="5">검색결과가 없습니다.</td></tr>
<?
} else { 
	$num = 1;
	while($row = sql_fetch_array($result)) {

?>
<tr>
	<td>
		<input type="checkbox" name="sms_chkbox[]" value="<?=$num?>">
		<input type="hidden" name="sms_rcv_id[<?=$num?>]" value="<?=$row['mb_id']?>">
		<input type="hidden" name="sms_rcv_hp[<?=$num?>]" value="<?=$row['mb_id']?>">
	</td>
	<td><?=$num?></td>
	<td style="display: none"><?=$row['mb_no']?></td>
	<td><?=$row['mb_name']?></td>
	<td><?=$row['mb_id']?></td>
	<td><?=$row['address']?></td>
	<td><?=$row['created_at']?></td>
</tr>
<? 
	$num++;
	}
}
?>