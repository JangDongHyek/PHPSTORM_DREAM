<?php
$sub_menu = "251000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $sound_only = '<strong class="sound_only">필수</strong>';
    $html_title = '추가';
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

$g5['title'] = '공모전 '.$html_title;
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

<form name="fmember" id="fmember" action="./compete_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="idx" value="<?php echo $row['cp_idx'] ?>">



<!--<input type="hidden" name="mb_level" value="--><?//=$mb['mb_level']?><!--">-->
<?php //for ($i=1; $i<=10; $i++) { ?>
<!--<input type="hidden" name="mb_--><?php //echo $i ?><!--" value="--><?php //echo $mb['mb_'.$i] ?><!--" id="mb_--><?php //echo $i ?><!--">-->
<?php //} ?>


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
        <th scope="row"><label for="cp_category1">상위카테고리<strong class="sound_only">필수</strong></label></th>
        <td>
            <select id="cp_category1" name="cp_category1" class="frm_input" onchange="ctg1_change(this.value)">
                <?php echo common_code('competition_ctg','code_ctg','html')?>
            </select>
        </td>
        <th scope="row"><label for="cp_category2">하위카테고리<strong class="sound_only">필수</strong></label></th>
        <td>
            <select id="cp_category2" name="cp_category2" class="frm_input">
                <?php echo common_code($row['cp_category1'],'code_p_idx','html')?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_id">업체 아이디</label></th>
        <td style="width: 30%">
            <input <?=$readonly?> type="text" name="mb_id" value="<?= $row['mb_id']?>" class="frm_input" size="40">
        </td>
        <th scope="row"><label for="cp_company_name">업체명</label></th>
        <td>
            <input type="text" name="cp_company_name" value="<?=$row['cp_company_name'] ?>" class="frm_input" size="40">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cp_title">제목</label></th>
        <td colspan="3"><input type="text" name="cp_title" value="<?php echo $row['cp_title'] ?>" required id="cp_title" class="frm_input required" size="180" maxlength="200"></td>
    </tr>
    <tr>
        <th scope="row"><label for="cp_logo_content">상세내용</label></th>
        <td colspan="2"><textarea style="width: 200%" name="cp_logo_content" id="cp_logo_content" class="frm_input"><?php echo $row['cp_logo_content'] ?></textarea></td>
    </tr>

    <tr>
        <th scope="row"><label for="cp_startdate">시작기간</label></th>
        <td>
            <input type="date" name="cp_startdate" value="<?= date('Y-m-d',strtotime($row['cp_startdate'])) ?>" class="frm_input" size="40">
        </td>
        <th scope="row"><label for="cp_datetime">마감기간</label></th>
        <td>
            <input type="date" name="cp_datetime" value="<?= date('Y-m-d',strtotime($row['cp_datetime'])) ?>" class="frm_input" size="40">
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="image">썸네일</label></th>
        <td>
            <a class="btn_02">추가</a>
            <div style="display: flex; gap: 5px">
                <input type="file" multiple="multiple" name="bf_file[]" id="bf_file[]">
                <a class="btn_01">삭제</a>
            </div>
        </td>
        <th scope="row"><label for="cp_progress">진행상태</label></th>
        <td>
            <select name="cp_progress">
                <?php for ($i = 1; $i <= count($progress_list); $i++){ ?>
                    <option value="<?=$i?>"><?=$progress_list[$i]?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cp_reward">상금</label></th>
        <td>
            <a class="btn_02">추가</a>
            <div style="display: flex; gap: 5px">
                <input type="text" name="cp_reward_th" value="<?=$row['cp_reward_th']?>" class="frm_input" size="5">  등수 *
                <input type="text" name="cp_reward_count" value="<?=$row['cp_reward_count']?>" class="frm_input" size="5">  명 *
                <input type="text" name="cp_reward" value="<?=$row['cp_reward']?>" class="frm_input" size="20">  만원
                <a class="btn_01">삭제</a>
            </div>
        </td>
        <th scope="row"><label for="image">선호하는 디자인</label></th>
        <td>
            <div>
                <a class="btn_02">추가</a>
                <div style="display: flex; gap: 5px">
                    <input type="file" multiple="multiple" name="bf_file[]" id="bf_file[]">
                    <a class="btn_01">삭제</a>
                </div>
            </div>
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="cp_logo_content2">참고자료</label></th>
        <td colspan="2"><textarea style="width: 200%" name="cp_logo_content2" id="cp_logo_content2" class="frm_input"><?php echo $row['cp_logo_content2'] ?></textarea></td>
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
    <a href="./compete_list.php?<?php echo $qstr ?>">목록</a>
</div>

</form>



<script>
    $(document).ready(function() {
        $("[name='cp_category1']").val(<?= $row['cp_category1']?>);
        $("[name='cp_category2']").val(<?= $row['cp_category2']?>);
        $("[name='cp_progress']").val(<?= $row['cp_progress']?>);



    });

    function ctg1_change(val) {


        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "pro_ctg1": val,
                "mode": "pro_ctg2_common"
            },
            dataType: "html",
            success: function(data) {
                $('#cp_category2').html('<option value="">상세분야 선택</option>' + data);
            }
        });

    }


</script>

<?php
include_once('./admin.tail.php');
?>
