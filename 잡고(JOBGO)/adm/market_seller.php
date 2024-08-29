<?php
$sub_menu = "251000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $sound_only = '<strong class="sound_only">필수</strong>';
    $html_title = '셀러';
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
//    if (!$mb['mb_id'])
//        alert('존재하지 않는 회원자료입니다.');
//
//    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
//        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    $sql = "select * from new_competition where cp_idx = '{$_REQUEST["idx"]}'";
    $row = sql_fetch($sql);

    $mb = get_member($row["mb_id"]);
    $readonly = 'readonly';
    $html_title = '수정';


}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$g5['title'] = '마켓 상품 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨


?>
<style>
    .title {margin-bottom: 10px; font-size: 2em}
    .title span {font-size: 12px}
    .sub {margin-bottom: 15px;font-size: 16px}
</style>


<div class="tbl_head02 tbl_wrap">
    <h6 class="title"><a href="<?php echo G5_BBS_URL ?>/market_view.php" target="_blank">상품명</a> <span>업체명</span></h6>
    <p class="sub"><b>판매리워드</b> 5%</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>신청일</th>
                <th>참여자(아이디)</th>
                <th>연락처</th>
                <th>판매 링크</th>
                <th>판매 건수</th>
                <th>판매 금액</th>
                <th>정산 금액</th>
                <th>셀러 활동</th>
            </tr>
        </thead>
        <tbody>
        <!--선정자는 상단으로-->
            <tr>
                <td>No</td>
                <td>참여일</td>
                <td>참여자(아이디)</td>
                <td>010-0000-0000</td>
                <td><a target="_blank"><i class="fa-solid fa-link"></i>판매 링크</a></td>
                <td>판매 건수</td>
                <td>판매 금액</td>
                <td>정산 금액</td>
                <td>
                    <select>
                        <option>가능</option>
                        <option>불가</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="저장" style="background: #0A7CC7" class="btn_submit"accesskey='s'>
    <a href="./market_list.php?<?php echo $qstr ?>">목록</a>
</div>

</form>




<?php
include_once('./admin.tail.php');
?>
