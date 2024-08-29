<?php
$sub_menu = "251300";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $sound_only = '<strong class="sound_only">필수</strong>';
    $html_title = '지원자 선정';
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

$g5['title'] = '공고 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨


?>
<style>
    .title {margin-bottom: 10px; font-size: 2em}
    .title span {font-size: 12px}
    .sub {margin-bottom: 15px;font-size: 16px}
</style>


<div class="tbl_head02 tbl_wrap">
    <h6 class="title"><a href="<?php echo G5_BBS_URL ?>/jobs_view.php" target="_blank">공고명</a> <span>업체명</span></h6>
    <p class="sub"><b>모집기간</b>-24.01.01 
        <select>
            <option>모집중</option>
            <option>모집마감</option>
            <option>개별통보</option>
        </select>
    </p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>지원일</th>
                <th>지원자</th>
                <th>이메일</th>
                <th>연락처</th>
                <th>나이/성별</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>No</td>
                <td>지원일</td>
                <td>지원자(아이디)</td>
                <td>이메일</td>
                <td>010-0000-0000</td>
                <td>나이/성별</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="저장" style="background: #0A7CC7" class="btn_submit"accesskey='s'>
    <a href="./jobs_list.php?<?php echo $qstr ?>">목록</a>
</div>

</form>




<?php
include_once('./admin.tail.php');
?>
