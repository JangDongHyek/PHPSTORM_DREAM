<?
/*******************************************
회원문자발송 - 회원리스트
 *******************************************/
include_once('./_common.php');
include_once('../util/SQLQueryBuilder.php');

$queryBuilder = new SQLQueryBuilder();
$memberId = $member['mb_id']; // 예를 들어, 현재 사용자 ID
$mbGroup = (int)$_POST['mb_group'];
$mb_name = $_POST['mb_name'];
$start_date = $_POST['start-date']; // 폼 필드의 name 속성에 따라 조정
$end_date = $_POST['end-date'];
$sql = '';

if($mbGroup == 150){
    // 날짜 조건을 추가하기 위한 변수 초기화
    $dateCondition = "1=1"; // 기본적으로 참인 조건

    // 시작 날짜와 종료 날짜가 모두 설정되어 있을 경우, 날짜 범위 조건을 구성
    if (!empty($start_date) && !empty($end_date)) {
        $dateCondition = "mb_open_date BETWEEN '{$start_date}' AND '{$end_date}'";
    }

    $sql = $queryBuilder->select("SELECT mb_id, mb_name, mb_hp, mb_open_date")
        ->from("g5_member")
        ->where("mb_leave_date = ''")
        ->where($memberId != "lets080" ? "mb_id != 'lets080'" : "1=1")
        ->where($dateCondition) // 날짜 범위 조건을 사용
        ->where(!empty($mb_name) ? "mb_name LIKE '%{$mb_name}%'" : "1=1")
        ->orderBy("mb_open_date DESC")
        ->getSQL();
}else{
    $sql = $queryBuilder->select("SELECT mb_id, mb_name, mb_hp, mb_open_date")
        ->from("g5_member")
        ->where("mb_leave_date = ''")
        ->where($memberId != "lets080" ? "mb_id != 'lets080'" : "1=1")
        ->where($mbGroup != 99 ? "mb_level = '{$mbGroup}'" : "mb_level != '10'")
        ->where(!empty($mb_name) ? "mb_name LIKE '%{$mb_name}%'" : "1=1")
        ->orderBy("mb_name ASC")
        ->getSQL();
}


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
            <td><?=$row['mb_level'] == '10'?'관리자':'회원'?></td>
            <td><?=$row['mb_name']?></td>
            <td><?=$row['mb_id']?></td>
            <td><?=$row['mb_open_date']?></td>
        </tr>
        <?
        $num++;
    }
}
?>