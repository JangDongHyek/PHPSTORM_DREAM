<?php
$sub_menu = "270100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $required_mb_id = 'readonly';
//    $required_mb_id_class = 'required alnum_';
//    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';
    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '추가';
}
else if ($w == 'u')
{

    $sql = "select * from new_cancel_rule where cr_idx = '{$_REQUEST["cr_idx"]}'";
    $row = sql_fetch($sql);

    $html_title = '수정';



}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$g5['title'] = '규정'.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨


?>
<style>
  .form.photo_in .photo {
        float: left;
        margin-right: 5px;
        margin-bottom: 5px;
        border: 1px solid #f1f1f1;
        background: #fff;
        width: 60px;
        height: 60px;
        z-index: 1;
        position: relative;
    }

 .form.photo_in .photo .btn_del {
     position: absolute;
     background: rgba(0, 0, 0, 0.5);
     width: 18px;
     height: 18px;
     line-height: 18px;
     border: 0;
     border-radius: 50%;
     right: -3px;
     top: -4px;
     color: #fff;
     font-size: 0.8em;
     z-index: 10;
 }
   .form label {
       display: block;
       color: #bfbfbf;
       font-size: 1.1em;
       font-weight: 500;
   }
  .photo_in .pbtn {
      display: block;
      position: absolute;
      left: 0;
      top: 0;
      font-size: 2em;
      width: 100%;
      height: 100%;
      line-height: 60px;
      background: #fff;
      text-align: center;
      border: 0;
  }
 .form input {
      display: none;
  }
</style>
<form name="fmember" id="fmember" action="./cancel_rule_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="cr_idx" value="<?php echo $row['cr_idx'] ?>">


<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>

    <tr>
        <th scope="row"><label for="cr_category1">상위카테고리<strong class="sound_only">필수</strong></label></th>
        <td>
            <select id="cr_category1" name="cr_category1" class="frm_input">
                <?php
                for ($i = 1; $i <= count($main_ctg); $i++){ ?>
                    <option value="<?php echo $main_ctg[$i]['code'] ?>"<?php echo get_selected($_GET['big_ctg'],$main_ctg[$i]['code']) ?> ><?=$main_ctg[$i]['name']?></option>
                <?php } ?>
            </select>
        </td>

    </tr>
    <tr>
        <th scope="row"><label for="cr_content">서비스설명</label></th>
        <td colspan="3"><textarea name="cr_content" id="cr_content" class="frm_input"><?php echo $row['cr_content'] ?></textarea></td>
    </tr>

    <?php if ($w == 'u') { ?>
    <tr>

        <th scope="row">작성일</th>
        <td colspan="3"><?php echo $row['wr_datetime'] ?></td>

    </tr>
    <?php } ?>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" style="background: #0A7CC7" class="btn_submit"accesskey='s'>
    <a href="./cancel_rule.php?<?php echo $qstr ?>">목록</a>
</div>

</form>
<!--주소팝업-->
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
    <span id="btnCloseLayer" style="width:40px; height:40px; color:#000; cursor:pointer;position:absolute;right:-20px;bottom:-10px;z-index:1;font-size: large" onclick="closeDaumPostcode()" >X</span>
</div>
<script>
    $(document).ready(function() {
        $("#cr_category1").val('<?= $row['cr_category1']?>');

    });
    //콤마찍기
    function numberWithCommas(x) {
        x = x.replace(/[^0-9]/g,''); // 입력값이 숫자가 아니면 공백
        x = x.replace(/,/g,''); // ,값 공백처리
        $("[name = wr_price]").val(x.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); // 정규식을 이용해서 3자리 마다 , 추가
    }

</script>

<?php
include_once('./admin.tail.php');
?>
