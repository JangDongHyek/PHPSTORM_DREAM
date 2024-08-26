<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/epggea.css">', 0);
add_javascript('<script type="text/javascript" src="'.$member_skin_url.'/js/epggea.js"></script>', 100);

//print_r($_REQUEST);
//exit;
if ($_REQUEST['leave_chk'] == 'Y'){
    $sql = "update {$g5['member_table']} set mb_8 = '1' , mb_quit_reason = '{$_REQUEST['mb_quit_reason']}' where mb_id = '{$member['mb_id']}' ";
    sql_query($sql);
    alert('탈퇴 신청이 완료되었습니다.',G5_BBS_URL.'/logout.php');
}
?>
<style>
.box-article .box-body .row{ background:#fff}
.tab-content {
	display: none;
	float: left;
	width: 100%;
	padding: 0 0 1em 0;
	background:#fff;
}
#reply{ display:none}
</style>


<!--마이페이지-->

<article id="mypage">


    <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>

        <section id="right_view">
             <h3>회원 탈퇴 </h3>
                 <div class="mem_leave">
                     <h4>유의사항</h4>
                     <ol>
                        <li>탈퇴신청 후 관리자가 탈퇴처리한 이후부터 탈퇴가 완료됩니다.</li>
                        <li>탈퇴한 회원님이 등록하신 게시물(재능/공모전/게시판에 등록된 게시물)들은 열람하실 수 없습니다.</li>
                     </ol>
                     <form action="<?=$_SERVER['PHP_SELF']?>" method="post" onsubmit="return form_submit()">
                         <div class="cont">
                             <label for="reg_mb_leave">탈퇴 사유</label>
                             <textarea placeholder="탈퇴 사유를 입력해주세요." id="mb_quit_reason" name="mb_quit_reason" maxlength="200" rows="6" style="height:100px;"></textarea>
                         </div>

                         <div class="leave_agree">
                             <input type="checkbox" id="leave" name="leave_chk" value="Y"><label for="leave">해당 내용을 모두 확인했으며, 회원탈퇴에 동의합니다. [필수]</label>
                         </div>
                         <button type="submit">회원 탈퇴신청</button>
                     </form>

                 </div>
        </section>

</article>

<script>
    function form_submit() {

        var chk = $('input[name="leave_chk"]:checked').val();
        if ($('#mb_quit_reason').val() == "" ){
            swal("탈퇴 사유를 입력해주세요.");
            return false;
        }

        if (chk != 'Y'){
            swal("회원탈퇴에 동의하지 않으시면 탈퇴가 불가능합니다.");
            return false;
        }
        return true;
    }
</script>
