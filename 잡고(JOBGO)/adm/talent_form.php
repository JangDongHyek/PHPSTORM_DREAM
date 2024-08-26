<?php
$sub_menu = "250100";
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
    $mb = get_member($mb_id);
//    if (!$mb['mb_id'])
//        alert('존재하지 않는 회원자료입니다.');
//
//    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
//        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    $sql = "select * from {$g5['talent_table']} where ta_idx = '{$_REQUEST["idx"]}'";
    $row = sql_fetch($sql);

    $sql = "select * from {$g5['pay_talent_table']} where ta_idx = '{$_REQUEST["idx"]}'";
    $pay_result = sql_query($sql);


    $mb = get_member($row["mb_id"]);
    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

//    $mb['mb_name'] = get_text($mb['mb_name']);
//    $mb['mb_nick'] = get_text($mb['mb_nick']);
//    $mb['mb_email'] = get_text($mb['mb_email']);
//    $mb['mb_homepage'] = get_text($mb['mb_homepage']);
//    $mb['mb_birth'] = get_text($mb['mb_birth']);
//    $mb['mb_tel'] = get_text($mb['mb_tel']);
//    $mb['mb_hp'] = get_text($mb['mb_hp']);
//    $mb['mb_addr1'] = get_text($mb['mb_addr1']);
//    $mb['mb_addr2'] = get_text($mb['mb_addr2']);

}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$g5['title'] = '재능등록';
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
<form name="fmember" id="fmember" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="idx" value="<?php echo $row['idx'] ?>">
<input type="hidden" id="re_lat" name="re_lat" value="<?php echo $row['re_lat'] ?>">
<input type="hidden" id="re_lon" name="re_lon" value="<?php echo $row['re_lon'] ?>">



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
        <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="mb_id" value="<?= isset($row['mb_id']) ?  $row['mb_id'] : "admin"; ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="30" minlength="3" maxlength="20">
			<? /*
            <?php if ($w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>">접근가능그룹보기</a><?php } ?>
			*/ ?>
        </td>
        <th scope="row"><label for="mb_name">닉네임<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" value="<?php echo $mb['mb_nick'] ?>" id="mb_nick" class="frm_input" size="15" minlength="2" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_hp">제목</label></th>
        <td colspan="3"><input type="text" name="ta_title" value="<?php echo $row['ta_title'] ?>" required id="ta_title" class="frm_input required" size="200" maxlength="200"></td>
    </tr>
    <tr>
        <th scope="row"><label for="ta_category1">상위카테고리<strong class="sound_only">필수</strong></label></th>
        <td>
            <select id="ta_category1" name="ta_category1" class="frm_input">
                <?php echo common_code('ctg','code_ctg','html')?>
            </select>
        </td>
        <th scope="row"><label for="ta_category2">하위카테고리<strong class="sound_only">필수</strong></label></th>
        <td>
            <select id="ta_category1" name="ta_category2" class="frm_input">
                <?php echo common_code($row['ta_category1'],'code_p_idx','html')?>
            </select>
        </td>
    </tr>
    <tr>
        <td><p style="font-weight: bolder; font-size: 16px; margin-top: 10px">가격정보</p></td>
    </tr>

    <?php for ($a = 0; $pay_row = sql_fetch_array($pay_result); $a++){ ?>
    <tr>

        <th scope="row"><label for=""><?=$info_list[$pay_row['pta_info']] ?><strong class="sound_only">필수</strong></label></th>
        <td>
            <input name="pta_title" id="pta_title" size="100" class="frm_input" value="<?php echo $pay_row['pta_title'] ?>" placeholder="가격제목">
            <br><input style="margin-top: 10px;" name="pta_pay" id="pta_pay" size="20" class="frm_input" value="<?php echo number_format($pay_row['pta_pay']) ?>" placeholder="가격"><span>원</span>

        </td>
        <th scope="row"><label for="mb_work">설명<strong class="sound_only">필수</strong></label></th>
        <td style="width: 40%">
            <input type="text"  class="frm_input"  id="pta_content" value="<?=  $pay_row['pta_content'] ?>"  size="100"  placeholder="가격내용">
        </td>

    </tr>
    <?php } ?>
    <tr>
        <td><p style="font-weight: bolder; font-size: 16px"></p></td>
    </tr>
    <tr>
        <th scope="row"><label for="image">메인사진</label></th>
        <td colspan="3">
<!--            <input type="file" multiple="multiple" name="bf_file[]" id="bf_file[]">-->
            <div>
                <?php
                if (isset($row['ta_idx'])) {
                    $sql = "select * from {$g5['board_file_table']} where bo_table = 'talent' and wr_id = '{$row['ta_idx']}'";
                    $result = sql_query($sql, false);
//                $icon_file = G5_DATA_PATH.'/service/'.$file['bf_file'];
                    if (sql_num_rows($result) > 0) {
                        for ($b = 0; $file = sql_fetch_array($result); $b++) {
                            $icon_url = G5_DATA_URL . '/file/talent/' . $file['bf_file'];
                            echo '<a href="'.G5_BBS_URL.'/view_image?bo_table=talent&fn='.$file['bf_file'].'" class = "view_image"><span style="margin-right: 8px"><img style="width: 100px; height: 100px" src="' . $icon_url . '" alt=""></span></a>
                            <span style="position: absolute;margin-left: -110px;">
                                </span>
                            </span>';
                        }
                    }else{
                        echo ' <p>사진없음</p>';
                    }
                }else{ ?>
                <div class="form photo_in cf">

                    <div id = "prev_area"></div>
                    <!--                   -->
                    <div name="photo_box_0" class="photo"  onclick="file_add()" >
                        <label for="image"><span class="pbtn">+</span></label>
                    </div>

                    <div id="file_input"></div>
                </div>
                <?php } ?>
            </div>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="image">서브사진</label></th>
        <td colspan="3">
            <!--            <input type="file" multiple="multiple" name="bf_file[]" id="bf_file[]">-->
            <div>
                <?php
                if (isset($row['ta_idx'])) {
                    $sql = "select * from {$g5['board_file_table']} where bo_table = 'sub_talent' and wr_id = '{$row['ta_idx']}'";
                    $result = sql_query($sql, false);
//                $icon_file = G5_DATA_PATH.'/service/'.$file['bf_file'];
                    if (sql_num_rows($result) > 0) {
                        for ($b = 0; $file = sql_fetch_array($result); $b++) {
                            $icon_url = G5_DATA_URL . '/file/sub_talent/' . $file['bf_file'];
                            echo '<a href="'.G5_BBS_URL.'/view_image?bo_table=sub_talent&fn='.$file['bf_file'].'" class = "view_image"><span style="margin-right: 8px"><img style="width: 100px; height: 100px" src="' . $icon_url . '" alt=""></span></a>
                            <span style="position: absolute;margin-left: -110px;">
                                </span>
                            </span>';
                        }
//                        echo '<p>체크후 확인을 누르면 삭제됩니다.</p>';
                    }else{
                        echo ' <p>사진없음</p>';
                    }
                }else{ ?>
                    <div class="form photo_in cf">

                        <div id = "prev_area"></div>
                        <!--                   -->
                        <div name="photo_box_0" class="photo"  onclick="file_add()" >
                            <label for="image"><span class="pbtn">+</span></label>
                        </div>

                        <div id="file_input"></div>
                    </div>
                <?php } ?>
            </div>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="ta_service_info">서비스설명</label></th>
        <td><textarea name="ta_service_info" id="ta_service_info" class="frm_input"><?php echo $row['ta_service_info'] ?></textarea></td>
        <th scope="row"><label for="ta_update_info">수정 및 재진행 안내입력</label></th>
        <td><textarea type="text" name="ta_update_info"id=ta_update_info" class="frm_input"><?php echo $row['ta_update_info'] ?></textarea></td>
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
<!--    <input type="button" onclick="form_ajax();" value="확인" style="background: #0A7CC7" class="btn_submit"accesskey='s'>-->
    <a href="./talent_list.php?<?php echo $qstr ?>">목록</a>
    <?php if ($w == 'u' && $row["mb_id"] == "admin"){ ?>
<!--        <input type="button" value="삭제" class="btn_submit" style="float: right" onclick="admin_work_del();">-->
    <?php } ?>
</div>

</form>
<!--주소팝업-->
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
    <span id="btnCloseLayer" style="width:40px; height:40px; color:#000; cursor:pointer;position:absolute;right:-20px;bottom:-10px;z-index:1;font-size: large" onclick="closeDaumPostcode()" >X</span>
</div>
<script>
    $(document).ready(function() {
        $("[name='ta_category1']").val(<?= $row['ta_category1']?>);
        $("[name='ta_category2']").val(<?= $row['ta_category2']?>);

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
