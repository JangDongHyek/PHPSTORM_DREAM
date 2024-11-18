<?php
$sub_menu = '400200';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '게시판 기본 메시지 관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql = "SELECT * from g5_board where 1=1 and bo_table = 'cs' ";
$row = sql_fetch($sql);

// 결과를 담을 배열 초기화
$bo_values = array();

$bo_values = array(
    'bo_1' => $row['bo_1'],
    'bo_2' => $row['bo_2'],
    'bo_3' => $row['bo_3'],
    'bo_4' => $row['bo_4'],
    'bo_5' => $row['bo_5'],
    'bo_6' => $row['bo_6']
);

$bo_keys = array(
    'bo_1' => '칭찬',
    'bo_2' => '제안',
    'bo_3' => '불만',
    'bo_4' => '기타문의',
    'bo_5' => '신고',
    'bo_6' => '공지'
);

?>

<!--<div class="btn_add01 btn_add">
    <a href="./js_newwinform.php">새창관리추가</a>
</div>-->

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">번호</th>
        <th scope="col">제목</th>
        <!--<th scope="col">접속기기</th>-->
        <th scope="col">내용</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $count = count($bo_values);
    foreach ($bo_values as $key => $value) {
        $bg = 'bg'.($count%2);

        switch($row['nw_device']) {
            case 'pc':
                $nw_device = 'PC';
                break;
            case 'mobile':
                $nw_device = '모바일';
                break;
            default:
                $nw_device = '모두';
                break;
        }
    ?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_num"><?php echo $count; ?></td>
        <td class="td_num"><?php echo $bo_keys[$key]; ?></td>
        <td><?php echo $value; ?></td>
        <td class="td_mngsmall">
            <a href="./cs_update_form.php?w=u&amp;nw_id=<?php echo $key; ?>"><span class="sound_only"><?php echo $row['nw_subject']; ?> </span>수정</a>
        </td>
    </tr>
    <?php
        $count--;
    }

    if ($i == 0) {
        echo '<tr><td colspan="11" class="empty_table">자료가 한건도 없습니다.</td></tr>';
    }
    ?>
    </tbody>
    </table>
</div>


<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
