<?php
include_once('./_head.php');

$now_date = date("Y-m-d", time());
$now_time = date("H:i");
$srl_no = $_GET['srl_no'];
$rs = "";
$comp_chk = "";

if($srl_no!=""){
    $sql = "SELECT * FROM store_receipt_list WHERE srl_no = '$srl_no' ";
    $rs = sql_fetch($sql);
}

if($rs['srl_state']=='완료'){
    $comp_chk = "style='display:block;'";
}


?>

<!--datepicker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="./js/store_datepicker.js?ver=<?=JS_VER_NUM?>"></script>
<script src="./js/store_timepicker.js?ver=<?=JS_VER_NUM?>"></script>

<!--timepicker-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<!--editer-->
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/summernote.min.css">
<script src="./js/bootstrap.min.js"></script>
<script src="./js/summernote.min.js"></script>
<script src="./js/summernote-ko-KR.js"></script>

<!--write_js/css-->
<link href="./css/store_write.css?ver=<?=CSS_VER_NUM?>" rel="stylesheet">
<script src="./js/store_write.js?ver=<?=JS_VER_NUM?>"></script>


<div class="inr">
    <h1>스토어 기록 등록</h1>

    <div class="write_tbl">
        <form name="frm" action="./proc/query.php" method="post" autocomplete="off" onsubmit="return frmSubmit(this)">
        <input type="hidden" name="val" value="<?=$srl_no=='' ? "insert" : "update" ?>"  />
        <input type="hidden" name="srl_no" value="<?=$srl_no?>" />
        <input type="hidden" id="start_time" value="<?=substr($rs['srl_reg_time'],0,5)?>"/>

        <dl>
            <dt></dt>
            <dd>
                <span class="subj">신청일</span>
                <span class="conts">
                  <input type="text" name="srl_reg_date" class="date_picker" value="<?=$srl_no=='' ? $now_date : substr($rs['srl_reg_date'],0,10) ?>" readonly/>
                </span>
            </dd>
            <dd>
                <span class="subj">신청시간</span>
                <span class="conts">
                  <input type="time" name="srl_reg_time" min="06:00" max="24:00" class="" value="<?=$srl_no=='' ? $now_time : substr($rs['srl_reg_time'],0,5) ?>"  required />
                </span>
            </dd>

            <dd>
                <span class="subj">업체명</span>
                <span class="conts"><input type="text" name="srl_comp_name" value="<?=$rs['srl_comp_name']?>" maxlength="40"></span>
            </dd>

            <dd>
                <span class="subj">구분</span>
                <select class="select_box" name="srl_class" >
                  <option  <?=$rs['srl_class']=='aOS' ? "selected" : "" ?>>aOS</option>
                  <option  <?=$rs['srl_class']=='IOS' ? "selected" : "" ?>>IOS</option>
                  <option  <?=$rs['srl_class']=='aOS(업데이트)' ? "selected" : "" ?>>aOS(업데이트)</option>
                  <option  <?=$rs['srl_class']=='IOS(업데이트)' ? "selected" : "" ?>>IOS(업데이트)</option>
                </select>
            </dd>

            <dd>
                <span class="subj">상태</span>
                <select class="select_box" name="srl_state" onchange="comp_date_on(this);" >
                    <option <?=$rs['srl_state']=='준비중' ? "selected" : "" ?> >준비중</option>
                    <option <?=$rs['srl_state']=='심사중' ? "selected" : "" ?> >심사중</option>
                    <option <?=$rs['srl_state']=='거절' ? "selected" : "" ?> >거절</option>
                    <option <?=$rs['srl_state']=='재심사' ? "selected" : "" ?> >재심사</option>
                    <option <?=$rs['srl_state']=='완료' ? "selected" : "" ?>>완료</option>
                </select>
            </dd>

            <dd>
                <span class="subj">스토어계정</span>
                <select class="select_box" name="srl_account_class" >
                  <option  <?=$rs['srl_account_class']=='자계정' ? "selected" : "" ?>>자계정</option>
                  <option  <?=$rs['srl_account_class']=='타계정' ? "selected" : "" ?>>타계정</option>
                </select>
            </dd>

            <dd class="complete_date_form"  <?=$comp_chk?>>
                <span class="subj">완료일</span>
                <span class="conts">
                    <input type="text" class="date_picker" name="srl_complete_date" value="<?=substr($rs['srl_complete_date'],0,10)?>" />
                </span>
            </dd>


            <dd>
                <span class="subj">내용</span>
                <span class="conts">
                    <div id="editor"><?=$rs['srl_content']?></div>
                    <textarea name="srl_content" class="el_hide"></textarea>
                </span>
            </dd>

        </dl>

        <div class="btn_confirm">
            <button type="submit" class="btn_submit"><?=$srl_no=='' ? "등록완료" : "수정완료" ?></button>
        </div>

        </form>
    </div>


</div>



<?php
include_once('./_tail.php');
?>
