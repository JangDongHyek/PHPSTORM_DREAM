<? 
include_once("./_common.php");

$g5['title'] = '쿠폰 현황';
$pid = "coupon_list";
include_once('./_head.php');

if(!$is_member){
    alert('로그인 후 이용해주세요.');
}

$sql = "SELECT *
        FROM `v5_coupon`
        WHERE (`mb_id` = '{$member['mb_id']}' OR FIND_IN_SET('{$member['mb_level']}', `mb_id`) > 0)
          AND `cp_start` <= '".G5_TIME_YMD."'
          AND `cp_end` >= '".G5_TIME_YMD."'
          AND `cp_finish` = 'F'
        ORDER BY `cp_no` desc";
$result = sql_query($sql);
$count = sql_num_rows($result);

?>
<link rel="stylesheet" href="<?=G5_BBS_URL?>/style.css?v=<?=G5_CSS_VER?>">
<style>


@media (max-width:768px){
    .btm_nav_box .link_title.ver2{
        margin-bottom: 20px;
    }
    #mypage_wrap .con_wrap .rev_wrap .rev_board thead{
        display: none;
    }
    #mypage_wrap .con_wrap .rev_wrap .rev_board tr{
        display: flex;
        flex-direction: column;
        grid-gap: 5px;
        border: 1px solid #eee;
        border-radius: 3px;
        padding: 15px;
        margin: 0 0 15px;
    }
    
    #mypage_wrap .con_wrap .rev_wrap .rev_board td{
        text-align: left;
        border: none;
        font-size: 1em;
        padding: 0;
    }
}
</style>

<div class="autoW bdpd">
    <div id="mypage_wrap" class="">
       <?php include_once('./mypage_left_menu.php'); ?> 
        <div class="con_wrap">
            <div class="rev_wrap">
                <h2>나의 쿠폰 현황</h2>
				<!--
                <ul class="rev_tab_wrap">
                    <li data-view = "" class="rev_tab <?php  if ($view == '') echo "on" ?>">전체</li>
                    <li data-view = "private" class="rev_tab <?php  if ($view == 'private') echo "on" ?>">프라이빗 센터</li>
                    <li data-view = "golf" class="rev_tab <?php  if ($view == 'golf') echo "on" ?>">더 스크린골프</li>
                    <li data-view = "cu" class="rev_tab <?php  if ($view == 'cu') echo "on" ?>">CU문화센터</li>
                </ul>
				-->
                <table class="rev_board">
                    <thead>
                    <tr>
                        <th>쿠폰명</th>
                        <th>유효기간</th>
						<th>상태</th>
                    </tr>
                    </thead>
                    <?
                        if($count > 0){
                            while($row = sql_fetch_array($result)){
                                $used = false;
                                $sql = " select count(*) as cnt from `v5_coupon_log` where mb_id = '$member[mb_id]' and cp_id = '$row[cp_id]' ";
                                $cp_log_row = sql_fetch($sql);
                                if($cp_log_row['cnt']) {
                                    $used = true;
                                }
                                ?>
                                <tr>
                                    <td>
                                        <a><?=$row['cp_subject']?></a>
                                    </td>
                                    <td>
                                        <a><?=$row['cp_end']?> 23:59:59 까지</a>
                                    </td>
                                    <td>
                                        <? if($used) { ?>
                                            <a class="btn-coupon used">사용완료</a>
                                        <?} else { ?>
                                            <a class="btn-coupon" onclick="use_cp('<?=$row['cp_id']?>')">사용하기</a>
                                        <?}?>
                                    </td>
                                </tr>
                            <?}
                        } else { ?>
                            <tr>
                                <td class="no_rev" colspan="4" style="text-align:center;">
                                    <a>지급된 쿠폰이 없습니다.</a>
                                </td>
                            </tr>
                        <?}
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function use_cp2(cp_id) {
            Swal.fire({
                input : 'password',
                inputLabel : "password",
                inputPlaceholder : "비밀번호를 입력"
            })
    }

    function use_cp(cp_id) {
        Swal.fire({
            title: '쿠폰 사용하기',
            input : "text",
            inputPlaceholder : "직원코드",
            text: "직원이 직접 '사용하기' 버튼을 눌러주세요.",
//            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#7C6AE6',
            cancelButtonColor: '#aaa',
            confirmButtonText: '사용하기',
            cancelButtonText: '취소',
            preConfirm: (name) => {
                if (!name) {
                    Swal.showValidationMessage('직원 코드를 입력해주세요.');
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("<?=G5_URL?>/cjax/use_cp.php", { "cp_id": cp_id , "staff_code" : result.value}, function (data) {
                    Swal.fire({
                        title: '알림',
                        text: data.msg,
                        icon: data.code == "200" ? 'success' : 'error',
                        confirmButtonColor: '#f5f5f5'
                    }).finally(() => {
                        if (data.code == "200") {
                            location.reload();
                        }
                    });
                }, "json");
            }
        });
    }

</script>


<style>
    div:where(.swal2-container).swal2-center>.swal2-popup{
        font-size: 13px;
        grid-gap: 5px;
        padding: 25px 0 0;
        overflow: hidden;
    }
    div:where(.swal2-container) h2:where(.swal2-title){
        font-size: 1.5em;
        padding: 0;
    }
    div:where(.swal2-container) .swal2-html-container{
        color: #999;
    }
    
    div:where(.swal2-container) div:where(.swal2-actions){
        display: grid !important;
        width: 100%;
        grid-template-columns: 1fr 1fr;
    }
    div:where(.swal2-container) button:where(.swal2-styled){
        
    }
    div:where(.swal2-container) button:where(.swal2-styled),
    div:where(.swal2-container) button:where(.swal2-styled).swal2-default-outline:focus{
        box-shadow: none;
        height: 48px;
        border-radius: 0 !important;
        font-size: 1.1em !important;
        margin: 0;
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm{
        background: linear-gradient(45deg,#7C6AE6, #56A0D5);
    }
</style>
<?php
include_once('./_tail.php');
?>
