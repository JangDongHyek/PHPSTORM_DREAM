<?php
$sub_menu = "251100";
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

$g5['title'] = '마켓 상품 '.$html_title;
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
 .flex {
     display: flex; gap: 5px; align-items: center
 }
</style>

<form name="fmember" id="fmember" action="./market_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
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
        <th scope="row"><label for="cp_category1">카테고리<strong class="sound_only">필수</strong></label></th>
        <td>
            <select id="cp_category1" name="cp_category1" class="frm_input" onchange="ctg1_change(this.value)">
                <option value="">카테고리</option>
                <option value="">SNS</option>
                <option value="">디자인</option>
                <option value="">체험단</option>
            </select>
        </td>
        <th scope="row"><label for="">판매상태<strong class="sound_only">필수</strong></label></th>
        <td>
            <select name="cp_progress">
                <option>가능</option>
                <option>불가</option>
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
        <th scope="row"><label for="">셀러판매<strong class="sound_only">필수</strong></label></th>
        <td>
            <select name="cp_progress">
                <option>가능</option>
                <option>불가</option>
            </select>
        </td>
        <th scope="row"><label for="">판매리워드<strong class="sound_only">필수</strong></label></th>
        <td>
            상품가의 <input type="number" name="" value="" class="frm_input" size="40"> %
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cp_title">상품명</label></th>
        <td colspan="3"><input type="text" name="cp_title" value="<?php echo $row['cp_title'] ?>" required id="cp_title" class="frm_input required" size="180" maxlength="200"></td>
    </tr>

    <tr>
        <th scope="row"><label for="">정상가</label></th>
        <td>
            <input type="number" name="" value="" class="frm_input" size="40"> 원
        </td>
        <th scope="row"><label for="">판매가</label></th>
        <td>
            <input type="number" name="" value="" class="frm_input" size="40"> 원
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="image">썸네일</label></th>
        <td colspan="3">
            <a class="btn_02">추가</a>
            <div style="display: flex; gap: 5px">
                <input type="file" multiple="multiple" name="bf_file[]" id="bf_file[]">
                <a class="btn_01">삭제</a>
            </div>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="image">추가옵션</label></th>
        <td>
            <select name="">
                <option>사용</option>
                <option>미사용</option>
            </select>
        </td>
        <td colspan="2">
            <a class="btn_02">추가</a>
            <div class="flex">
                옵션명 <input type="text" name="" value="" class="frm_input" size="40">
                추가금 <input type="number" name="" value="" class="frm_input" size="40"> 원
                <a class="btn_01">삭제</a>
            </div>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cp_logo_content">제품 정보</label></th>
        <td colspan="2"><!--에디터 삽입--></td>
    </tr>

    <tr>
        <th scope="row"><label for="">택배사</label></th>
        <td>
            <input type="text" name="" value="" class="frm_input" size="40">
        </td>
        <th scope="row"><label for="">배송비</label></th>
        <td>
            <input type="number" name="" value="" class="frm_input" size="40"> 원
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="">반품/교환 배송지</label></th>
        <td colspan="3">
            <div style="display: flex; gap: 5px">
                <input type="text" name="" value="<?= $row['']?>" class="frm_input" size="">
                <a class="btn_01">우편번호 검색</a>
                <input type="text" name="" value="<?= $row['']?>" class="frm_input" size="">
            </div>
        </td>
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
    <a href="./market_list.php?<?php echo $qstr ?>">목록</a>
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
