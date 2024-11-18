<?php
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], "w");

$nw_id = $_GET['nw_id'];

function getBoValue($param, $nw){
    $content = '';
    switch($param) {
        case 'bo_1':
            $content = $nw['bo_1'];
            break;
        case 'bo_2':
            $content = $nw['bo_2'];
            break;
        case 'bo_3':
            $content = $nw['bo_3'];
            break;
        case 'bo_4':
            $content = $nw['bo_4'];
            break;
        case 'bo_5':
            $content = $nw['bo_5'];
            break;
        case 'bo_6':
            $content = $nw['bo_6'];
            break;
        default:
            break;
    }
    return $content;
}

function getBoTitle($param) {
    $bo_values = array(
        'bo_1' => '칭찬',
        'bo_2' => '제안',
        'bo_3' => '불만',
        'bo_4' => '기타문의',
        'bo_5' => '신고',
        'bo_6' => '공지'
    );

    // 파라미터에 해당하는 값이 배열에 있는지 확인하고 있으면 반환
    if (array_key_exists($param, $bo_values)) {
        return $bo_values[$param];
    } else {
        return '해당하는 값이 없습니다.';
    }
}

$html_title = "고객문의 기본노출 메시지관리";
if ($w == "u")
{
    $html_title .= " 수정";
    $sql = " select * from g5_board where bo_table = 'cs' ";
    $nw = sql_fetch($sql);
    if (!$nw['bo_table']) alert("등록된 자료가 없습니다.");
}
else
{
    $nw['nw_height'] = 500;
    $nw['nw_content_html'] = 2;
}

$boTitle = getBoTitle($nw_id);  // 출력: 칭찬
$boValue = getBoValue($nw_id, $nw);

$g5['title'] = $html_title;
include_once (G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="frmnewwin" action="./cs_default_msg_update.php" onsubmit="return frmnewwin_check(this);" method="post">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="nw_id" value="<?php echo $nw_id; ?>">
<input type="hidden" name="token" value="">

<div class="local_desc01 local_desc">
    <p>초기화면 접속 시 자동으로 뜰 팝업레이어를 설정합니다.</p>
</div>

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
	<input type="hidden" name="nw_device" id="nw_device" value="both">
    <!--<tr>
        <th scope="row"><label for="nw_disable_hours">시간<strong class="sound_only"><?=$nw['bo_1']?> 필수</strong></label></th>-->
    <tr>
        <th scope="row"><label for="nw_subject">문의타입<strong class="sound_only"><?=$boTitle?>  필수</strong></label></th>
        <td>
            <input type="hidden" name="nw_subject" value="<?php echo $nw_id ?>" id="nw_subject" required class="frm_input required" size="80" readonly>
            <input type="text" name="nw_type" value="<?php echo $boTitle ?>" id="nw_type" required class="frm_input required" size="80" readonly>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="nw_content">내용</label></th>
        <td><?php echo editor_html('nw_content', get_text($boValue, 0)); ?></td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="./cs_default_msg_manager.php">목록</a>
</div>
</form>

<script>
function frmnewwin_check(f)
{
    errmsg = "";
    errfld = "";

    <?php echo get_editor_js('nw_content'); ?>

    check_field(f.nw_subject, "제목을 입력하세요.");

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }
    return true;
}
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
