<? 
include_once("./_common.php");

$g5['title'] = '탈퇴 하기';
$pid = "widthdraw";
include_once('./_head.php');
$w = "u";
$register_action_url = G5_BBS_URL.'/register_form_update.php';

if ($is_admin)
    alert('관리자의 회원정보는 관리자 화면에서 수정해 주십시오.', G5_URL);

if (!$is_member)
    alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php?url='.G5_BBS_URL.'/widthdraw.php');


?>

<div class="autoW bdpd">
    <div id="mypage_wrap" class="">
        <div class="con_wrap">
            <div id="modal_withdraw" class=" mo_container">
                <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="w" value="<?=$w?>">

                <div class="modal-body">
                    <ul>
                        <li>
                            <input type="radio" name="widthdraw01" id="widthdraw01_01" value="이용이 불편하고 장애가 많아서" onclick="$('#report_comment').val(this.value)">
                            <label for="widthdraw01_01"><i class="fa-solid fa-circle-check"></i>이용이 불편하고 장애가 많아서</label>
                        </li>
                        <li>
                            <input type="radio" name="widthdraw01" id="widthdraw01_02" value="사용빈도가 낮아서" onclick="$('#report_comment').val(this.value)">
                            <label for="widthdraw01_02"><i class="fa-solid fa-circle-check"></i>사용빈도가 낮아서</label>
                        </li>
                        <li>
                            <input type="radio" name="widthdraw01" id="widthdraw01_03" value="콘텐츠 불만" onclick="$('#report_comment').val(this.value)">
                            <label for="widthdraw01_03"><i class="fa-solid fa-circle-check"></i>콘텐츠 불만</label>
                        </li>

                        <li>
                            <input type="radio" name="widthdraw01" id="widthdraw01_05" value="" onclick="$('#report_comment').val(this.value)">
                            <label for="widthdraw01_05"><i class="fa-solid fa-circle-check"></i>기타사유</label>
                            <textarea name="widthdraw_comment" id="report_comment">사유를 적어주세요.</textarea>
                        </li>
                    </ul>
                    <div class="widthdraw_agr_wrap">
                        <p class="txt-gray">회원 탈퇴 진행시 계정 복구가 불가능하며, 모든 데이터가 삭제되는 부분 동의하시나요?</p>
                        <input type="checkbox" id="widthdraw_agr">
                        <label for="widthdraw_agr"><i class="fa-solid fa-circle-check"></i>동의합니다</label>
                    </div>
                </div>

                <div class="modal-footer modal-btn">
                    <input type="hidden" name="mb_id" id="mb_id" placeholder="이름을 입력하세요" value="<?=$member['mb_id']?>">
                    <input type="hidden" name="mb_name" id="mb_name" placeholder="이름을 입력하세요" value="<?=$member['mb_name']?>">
                    <input type="hidden" name="mb_nick" id="reg_mb_nick" value="<?=$member['mb_nick']?>" minlength="3" maxlength="20" placeholder="닉네임">
                    <input type="hidden" name="mb_leave_date" value="<?php echo $member['mb_leave_date'] ?>" id="mb_leave_date"  maxlength="8">
                    <input type="hidden" name="mb_leave_comment" value="<?php echo $member['mb_leave_comment'] ?>" id="mb_leave_comment"  >
                    <button type="button" class="btn_complet" onclick="submit_leave()">탈퇴하기</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>

    // submit 최종 폼체크
    function fregisterform_submit(f) {
        return true;
    }

    function submit_leave(){

        if(!$('#report_comment').val()){
            swal('사유를 입력해주세요.');
            $('#report_comment').focus();
            $('#mb_leave_comment').val('');
            $('#mb_leave_date').val('');
            return false;
        }

        if($('#widthdraw_agr').is(":checked")){
            $('#mb_leave_comment').val($('#report_comment').val());
            $('#mb_leave_date').val('<?php echo date("Ymd"); ?>');
            $('#fregisterform').submit();
        }else{
            swal('탈퇴에 동의해주세요.');
            $('#widthdraw_agr').focus();
            return false;
        }
    }
</script>
<?php
include_once('./_tail.php');
?>
