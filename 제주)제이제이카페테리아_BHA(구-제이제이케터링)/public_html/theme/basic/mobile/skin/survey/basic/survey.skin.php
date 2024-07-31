<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$survey_skin_url.'/style.css">', 0);
?>

<form name="fsurvey" action="<?php echo G5_BBS_URL ?>/survey_update.php" onsubmit="return fsurvey_submit(this);" method="post">
<input type="hidden" name="po_id" value="<?php echo $po_id ?>">
<input type="hidden" name="skin_dir" value="<?php echo urlencode($skin_dir); ?>">
<aside id="survey">
    <header>
        <!--<h2>설문조사</h2>-->
        <?php if ($is_admin == "super") { ?><a href="<?php echo G5_ADMIN_URL ?>/survey_form.php?w=u&amp;po_id=<?php echo $po_id ?>" class="btn_admin">설문조사 관리</a><?php } ?>
        <p class="survey_title"><span class="qicon">Q</span><?php echo $po['po_subject'] ?></p>
    </header>
    <ul>
        <?php for ($i=1; $i<=9 && $po["po_survey{$i}"]; $i++) { ?>
        <label for="gb_survey_<?php echo $i ?>"><li><input type="radio" name="gb_survey" value="<?php echo $i ?>" id="gb_survey_<?php echo $i ?>"> <?php echo $po['po_survey'.$i] ?></li>
        <?php } ?></label>
    </ul>
    <footer>
        <input type="submit" value="투표하기" style="width:100%;">
		<?/*
        <a href="<?php echo G5_BBS_URL."/survey_result.php?po_id=$po_id&amp;skin_dir=".urlencode($skin_dir); ?>" target="_blank" onclick="survey_result(this.href); return false;">결과보기</a>
		*/?>
    </footer>
</aside>
</form>

<script>
function fsurvey_submit(f)
{
    <?php
    if ($member['mb_level'] < $po['po_level'])
        echo " alert('권한 {$po['po_level']} 이상의 회원만 투표에 참여하실 수 있습니다.'); return false; ";
    ?>

    var chk = false;
    for (i=0; i<f.gb_survey.length;i ++) {
        if (f.gb_survey[i].checked == true) {
            chk = f.gb_survey[i].value;
            break;
        }
    }

    if (!chk) {
        alert("투표하실 설문항목을 선택하세요");
        return false;
    }

    var new_win = window.open("about:blank", "win_survey", "width=616,height=500,scrollbars=yes,resizable=yes");
    f.target = "win_survey";

    return true;
}

function survey_result(url)
{
    <?php
    if ($member['mb_level'] < $po['po_level'])
        echo " alert('권한 {$po['po_level']} 이상의 회원만 결과를 보실 수 있습니다.'); return false; ";
    ?>

    win_survey(url);
}
</script>