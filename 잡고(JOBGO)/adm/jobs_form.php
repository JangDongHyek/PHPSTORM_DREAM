<?php
$sub_menu = "251300";
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

$g5['title'] = '공고 '.$html_title;
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
 .flex {display: flex; align-items: center; gap: 5px}
</style>

<form name="fmember" id="fmember" action="./campaign_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
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
        <th scope="row"><label for="">채용 담당자</label></th>
        <td>
            <input type="text" name="" value="<?= $row['']?>" class="frm_input" size="40">
        </td>
        <th scope="row"><label for="">담당자 전화</label></th>
        <td>
            <input type="text" name="" value="<?= $row['']?>" class="frm_input" size="40">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="">업체 주소</label></th>
        <td>
            <div style="display: flex; gap: 5px">
                <input type="text" name="" value="<?= $row['']?>" class="frm_input" size="">
                <a class="btn_01">우편번호 검색</a>
                <input type="text" name="" value="<?= $row['']?>" class="frm_input" size="">
            </div>
        </td>
        <th scope="row"><label for="">업체 썸네일</label></th>
        <td>
            <input type="file" multiple="multiple" name="bf_file[]" id="bf_file[]">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="">근무요일<strong class="sound_only">필수</strong></label></th>
        <td>
            <input type="checkbox" id="week1"><label for="week1">월요일</label>
            <input type="checkbox" id="week2"><label for="week2">화요일</label>
            <input type="checkbox" id="week3"><label for="week3">수요일</label>
            <input type="checkbox" id="week4"><label for="week4">목요일</label>
            <input type="checkbox" id="week5"><label for="week5">금요일</label>
            <input type="checkbox" id="week6"><label for="week6">토요일</label>
            <input type="checkbox" id="week7"><label for="week7">일요일</label>
            <input type="checkbox" id="week8"><label for="week8">공휴일 휴무</label>
        </td>
        <th scope="row"><label for="">모집인원<strong class="sound_only">필수</strong></label></th>
        <td>
            <input type="text" name="" value="<?=$row['']?>" class="frm_input" size="20">명
            <input type="checkbox" id=""><label for="">미정</label>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="">근무시간<strong class="sound_only">필수</strong></label></th>
        <td>
            <div class="flex">
                <input type="time"class="frm_input">~
                <input type="time"class="frm_input">
                | 휴게시간<input type="number"class="frm_input"> 분
            </div>
        </td>
        <th scope="row"><label for="">근무지역<strong class="sound_only">필수</strong></label></th>
        <td>
            <div style="display: flex; gap: 5px">
                <input type="text" name="" value="<?= $row['']?>" class="frm_input" size="">
                <a class="btn_01">우편번호 검색</a>
                <input type="text" name="" value="<?= $row['']?>" class="frm_input" size="">
            </div>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="">근무기간<strong class="sound_only">필수</strong></label></th>
        <td>
            <div class="flex">
                <select>
                    <option>3개월</option>
                    <option>6개월</option>
                    <option>1년</option>
                    <option>계약기간</option>
                </select>
                <select>
                    <option>이상</option>
                    <option>이하</option>
                    <option></option>
                </select>
            </div>
        </td>
        <th scope="row"><label for="">고용형태<strong class="sound_only">필수</strong></label></th>
        <td>
            <input type="radio" id="emp1" name="emp"><label for="emp1">정규직</label>
            <input type="radio" id="emp2" name="emp"><label for="emp2">계약직</label>
            <input type="radio" id="emp3" name="emp"><label for="emp3">인턴</label>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="">급여<strong class="sound_only">필수</strong></label></th>
        <td>
            <div class="flex">
                <select>
                    <option>시급</option>
                    <option>일급</option>
                    <option>주급</option>
                    <option>월급</option>
                    <option>연봉</option>
                </select>
                <input type="text"  class="frm_input"> 원 |
                기타사항 <input type="text"  class="frm_input">
            </div>
        </td>
        <th scope="row"><label for="">직종<strong class="sound_only">필수</strong></label></th>
        <td>
            <input type="text"  class="frm_input">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="">복리후생<strong class="sound_only">필수</strong></label></th>
        <td>
            <input type="text"  class="frm_input">
        </td>
        <th scope="row"><label for="cp_startdate">모집기간</label></th>
        <td>
            <input type="date" name="cp_startdate" value="<?= date('Y-m-d',strtotime($row['cp_startdate'])) ?>" class="frm_input" size="40"> 까지
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="">학력<strong class="sound_only">필수</strong></label></th>
        <td>
            <select>
                <option>무관</option>
                <option>고졸이상</option>
                <option>대학(2/3년)이상</option>
                <option>대학(4년)이상</option>
                <option>석사이상</option>
                <option>박사이상</option>
            </select>
        </td>
        <th scope="row"><label for="">경력<strong class="sound_only">필수</strong></label></th>
        <td>
            <select>
                <option>무관</option>
                <option>1년이상</option>
                <option>3년이상</option>
                <option>5년이상</option>
                <option>10년이상</option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="">대표<strong class="sound_only">필수</strong></label></th>
        <td>
            <input type="text" class="frm_input">
        </td>
        <th scope="row"><label for="cp_startdate">사업내용</label></th>
        <td>
            <input type="text" class="frm_input">
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="">홈페이지<strong class="sound_only">필수</strong></label></th>
        <td colspan="3">
            <input type="text" class="frm_input">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cp_title">공고 제목</label></th>
        <td colspan="3"><input type="text" name="cp_title" value="<?php echo $row['cp_title'] ?>" required id="cp_title" class="frm_input required" size="180" maxlength="200"></td>
    </tr>

    <tr>
        <th scope="row"><label for="cp_logo_content">상세 요강</label></th>
        <td colspan="2"><!--에디터 삽입--></td>
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
    <a href="./jobs_list.php?<?php echo $qstr ?>">목록</a>
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
