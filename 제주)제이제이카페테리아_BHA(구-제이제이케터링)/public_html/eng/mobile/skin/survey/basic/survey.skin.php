<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$sql = "select * from ".$g5['clause_table']." where sv_id = '".$sv_id."' order by cl_id asc";
$result = sql_query($sql);
$cnt = sql_num_rows($result);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$survey_skin_url.'/style.css">', 0);
?>

<form name="fsurvey" action="<?php echo G5_BBS_URL ?>/survey_update.php" onsubmit="return fsurvey_submit(this);" method="post">
<input type="hidden" name="sv_id" value="<?php echo $sv_id ?>">
<input type="hidden" name="skin_dir" value="<?php echo urlencode($skin_dir); ?>">
<input type="hidden" name="sv_cnt" value="<?php echo $cnt ?>">
<aside id="survey">
    <header>
        <!--<h2>설문조사</h2>-->
        <?php if ($is_admin == "super") { ?><a href="<?php echo G5_ADMIN_URL ?>/survey_form.php?w=u&amp;sv_id=<?php echo $sv_id ?>" class="btn_admin">설문조사 관리</a><?php } ?>
    </header>

	<?php 
	for($i=0; $i<$cnt; $i++){ 
		$cl = sql_fetch_array($result);
	?>
	<div class="header">
		<p class="survey_title"><span class="qicon">Q</span><?php echo $cl['cl_subject'] ?></p>
    </div>
	<ul>
		<input type="hidden" name="cl_id[]" value="<?php echo $cl['cl_id']?>">
        <?php for ($j=1; $j<=8 && $cl["cl_".$j]; $j++) { ?>
        <label for="gb_survey_<?php echo $i ?>_<?php echo $j ?>">
			<li>
				<input type="radio" name="gb_survey<?php echo $i ?>" value="<?php echo $j ?>" id="gb_survey_<?php echo $i ?>_<?php echo $j ?>"> <?php echo $cl['cl_'.$j] ?>
			</li>
        </label>
		<?php } ?>
		<?php if($cl['cl_ext']){ ?>
        <label for="gb_survey_<?php echo $i ?>_9">
			<li>
				<input type="radio" name="gb_survey<?php echo $i ?>" value="9" id="gb_survey_<?php echo $i ?>_9"> 기타의견 <br/><br/>
				<input type="text" name="cl_ext_txt" value="" class="frm_input" style="width:100%;">
			</li>
        </label>
		<?php } ?>
    </ul>
	<?php } ?>

    <footer>
        <input type="submit" id="sub" value="투표하기" style="width:100%;">
		<?/*
        <a href="<?php echo G5_BBS_URL."/survey_result.php?po_id=$po_id&amp;skin_dir=".urlencode($skin_dir); ?>" target="_blank" onclick="survey_result(this.href); return false;">결과보기</a>
		*/?>
    </footer>
</aside>
</form>

<script>
function fsurvey_submit(f)
{

	<?php for($i=0; $i<$cnt; $i++){ ?>

    var chk<?php echo $i?> = false;
    for (i=0; i<f.gb_survey<?php echo $i?>.length;i ++) {
        if (f.gb_survey<?php echo $i?>[i].checked == true) {
            chk<?php echo $i?> = f.gb_survey<?php echo $i?>[i].value;
            break;
        }
    }
	
    if (!chk<?php echo $i?>) {
        alert("투표하실 설문항목을 선택하세요");
        return false;
    }
	<?php } ?>

	$("#sub").attr("disabled", "disabled");

    return true;
}

function survey_result(url)
{

    win_survey(url);
}
</script>