<?php
$sub_menu = "220100";
include_once('./_common.php');

$w = '';
$title = '추가';
// 레슨상품수정
if(!empty($_GET['idx']) && $_GET['w'] == 'u') {
    $w = $_GET['w'];
    $title = '수정';
    $sql = " select * from g5_lesson where idx = {$_GET['idx']} ";
    $lesson = sql_fetch($sql);
}

// 레슨상품삭제
if(!empty($_GET['idx']) && $_GET['w'] == 'd') {
    $w = $_GET['$w'];
    //$sql = " delete from g5_lesson where idx = {$_GET['idx']} ";
    $sql = " update g5_lesson set use_yn = 'N', mod_mb_no = '{$member['mb_no']}', mod_date = now() where idx = '{$_GET['idx']}' ";
    sql_query($sql);

    die('success');
}

//if ($is_admin != 'super')
//    alert_close('최고관리자만 접근 가능합니다.');

$g5['title'] = '레슨 상품 ' . $title;
include_once(G5_PATH.'/head.sub.php');
?>

<div id="menu_frm" class="new_win">
    <div class="metf"><?php echo $g5['title']; ?></div>

    <form name="flessonform" id="flessonform" method="post" action="./lesson_form_update.php" onsubmit="return flessonform_submit(this);" autocomplete="off">
        <input type="hidden" name="w" id="w" value="<?=$w?>">
        <input type="hidden" name="idx" id="idx" value="<?=$_GET['idx']?>">

        <div class="tbl_head01 tbl_wrap">
            <table>
                <tbody>
                    <tr>
                        <td><label for="chk">레슨명</label></td>
                        <td><input type="text" name="lesson_name" id="lesson_name" value="<?=$lesson['lesson_name']?>" required class="required frm_input full_input"></td>
                    </tr>
                    <tr>
                        <td><label for="chk">레슨시간</label></td>
                        <td>
                            <input type="text" name="lesson_time" id="lesson_time" value="<?=$lesson['lesson_time']?>" required class="required frm_input full_input" placeholder="예) 30분, 60분">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="chk">레슨횟수</label></td>
                        <td>
                            <input type="text" name="lesson_count" id="lesson_count" value="<?=$lesson['lesson_count']?>" required class="required frm_input full_input" placeholder="예) 4회/1개월, 12회/6주">
                            * 형식 : 횟수/기간
                        </td>
                    </tr>
                    <tr>
                        <td><label for="chk">금액(원)</label></td>
                        <td><input type="text" name="lesson_price" id="lesson_price" value="<?php echo empty($lesson['lesson_price']) ? '' : number_format($lesson['lesson_price']) ?>" required class="required frm_input full_input" placeholder="숫자만 입력하세요." onkeyup="number_check(this);add_comma(this.value);"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="btn_confirm01 btn_confirm">
            <input type="submit" name="act_button" value="확인" class="btn_submit">
        </div>

    </form>

</div>

<script>
function flessonform_submit(f)
{
    return true;
}

function number_check(data) {
    $('#'+data.id).val(data.value.replace(/[^\d]+/g, ''));
    $('#'+data.id).val(data.value.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,'));
}

function add_comma(price) {
    price = price.replaceAll(/,/gi, "");
    $('#lesson_price').val(number_format(price));
}
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>
