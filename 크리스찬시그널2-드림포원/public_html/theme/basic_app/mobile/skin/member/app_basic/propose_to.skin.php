<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>


<!--내메세지함-->
<div id="msg">
	<!--상단카테고리-->
    <ul class="cate cf">
        <li><a href="javascript:void(0);" onclick="tab_move('propose_from.php');">데이트 수신</a></li>
        <li class="active"><a href="javascript:void(0);">데이트 신청</a></li>
    </ul>
    
    <!--내용부분--> 
    <div class="in">
        <div class="msg_con dating">
        <?php
        for($i=0; $row=sql_fetch_array($result); $i++) {
            // 프로필 기본이미지
            if($row['mb_sex'] == '여')  $default_img = 'noimg.jpg'; else $default_img = 'noimg_male.jpg';

            // 프로필 이미지 (첫번째 사진 한장)
            $sql = " select * from g5_member_img where mb_no = {$row['receive_mb_no']} order by idx limit 1";
            $file = sql_fetch($sql);

            // 수신확인
            if(!empty($row['propose_state'])) $propose_state = 'fa-envelope-open'; else $propose_state = 'fa-envelope';
            if(!empty($row['propose_state'])) $before = 'before'; else $before = '';

            if ($row["mb_8"] == 2){
                $row['mb_nick'] = "탈퇴한 회원";
                $name = "OOO";
                $href = "javascript:void(0)";
            }else{
                $href = G5_BBS_URL."/mem_view.php?mb_no=".$row['receive_mb_no'];
            }

        ?>
            <div class="list cf">
                <?php if(!empty($row['propose_state'])) { ?>
                <div class="propose_state"><i class="fas fa-check-circle"></i> 상대가 <span><?=$row['propose_state']?></span>함</div>
                <?php } else { ?>
                <div class="propose_state"><i class="fas fa-check-circle"></i> 상대가 <span class="ing">확인</span>중</div>
                <?php } ?>
                <!--<div class="new <?/*=$before*/?>"><i class="fas <?/*=$propose_state*/?>"></i></div>-->
                <!--<div class="write"><a href="javascript:void(0);" onclick="send_message_modal('<?/*=$row['mb_no']*/?>', '<?/*=$row['mb_nick']*/?>');"><i class="fas fa-pencil-alt"></i></a></div>-->
                <div class="bts del"><a href="javascript:void(0);" onclick="del_propose('<?=$row['idx']?>');" title="삭제"><i class="fas fa-trash-alt"></i></a></div>
                <div class="face"><!--회원사진이 뜨게..-->
                <?php if(isset($file['img_file']) && $row["mb_8"] !=2 ) { ?>
                    <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file['img_file']?>" />
                <?php } else { ?>
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                <?php } ?>
                </div>
                <div class="info">
                    <h2 class="nick"><strong>To.</strong><span><?=$row['mb_nick']?></span>님께 데이트 신청</h2>
                    <!--<div class="con"><?/*=$row['message']*/?></div>-->
                    <!--<a href="javascript:void(0)" onclick="view_move('<?/*=$row['idx']*/?>');" class="view">메세지 더보기 +</a>-->
                    <div class="date">신청일 : <?=$row['propose_date']?></div>
                    <div class="who"><a href="<?=$href?>"><i class="fas fa-heart"></i> 프로필 보기 <i class="fas fa-heart"></i></a></div>
                </div>
            </div><!--list-->
        <?php
        }
        if($i == 0) {
        ?>
        <div class="msg_none"><span><i class="fas fa-paper-plane"></i></span> 데이트 신청 내역이 없습니다.</div>
        <?php
        }
        ?>
        </div><!--msg_con-->
    </div><!--in-->
</div><!--msg-->
<!--내메세지함-->

<script>
// 탭 이동 (뒤로가기 때문에 replace 사용)
function tab_move(page) {
    location.replace(g5_bbs_url+'/'+page);
}

// 메세지 더보기 이동 (뒤로가기 때문에 replace 사용)
function view_move(idx) {
    location.replace('<?php echo G5_BBS_URL ?>/msg_view.php?idx='+idx+'&mode=send');
}

// 메세지 삭제
function del_propose(idx) {
    swal({
        text: "데이트 신청 내역을 삭제하시겠습니까?",
        icon: "warning",
        buttons: {
            cancel: "취소",
            defeat: "확인",
        }
    })
    .then((value) => {
        switch (value) {
            case "defeat":
                $.ajax({
                    type: 'POST',
                    url: g5_bbs_url + "/ajax.del_propose.php",
                    data: {idx: idx, mode : 'send'},
                    success: function (data) {
                        if(data) {
                            swal('데이트 신청 내역이 삭제되었습니다.')
                            .then(() => {
                                location.replace(g5_bbs_url + '/propose_to.php');
                            });
                        }
                    }
                });
            break;
        }
    });
}

// 메세지 모달
function send_message_modal(mb_no, mb_nick) {
    // 초기화
    $('textarea#message').val('');
    $('#counter').html("0 / 최대 200자");
    $('#myModal6 .nick').text(mb_nick); // 닉네임
    $('#receive_mb_no').val(mb_no); // 받는사람
    $('#myModal6').modal('show');
}

// 메시지 전송하기
var is_post = false;
function send_message() {
    if(is_post) {
        return false;
    }
    is_post = true;

    if($.trim($('#message').val()).length == 0) {
        swal('메세지를 입력해주세요.');
        is_post = false;
        return false;
    }

    $.ajax({
        type: 'POST',
        url: g5_bbs_url + "/ajax.send_message.php",
        data: {mb_no: $('#receive_mb_no').val(), message:  $('textarea#message').val() },
        success: function (data) {
            if(data == 'success') {
                swal('메세지를 전송하였습니다.')
                .then(() => {
                    // $('#myModal6').modal('hide');
                    location.replace(g5_bbs_url + '/propose_to.php');
                });
            }
        }
    });
}
</script>