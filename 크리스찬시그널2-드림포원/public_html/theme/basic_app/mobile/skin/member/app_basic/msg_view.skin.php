<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<style>
    <?php
    if($mode == 'send')
    {
     ?>
    .face img {
        -webkit-filter: blur(4.5px);
        -moz-filter: blur(4.5px);
        -o-filter: blur(4.5px);
        -ms-filter: blur(4.5px);
        filter: blur(4.5px);
    }
    .noblur img {
        -webkit-filter: blur(0px) !important;
        -moz-filter: blur(0px) !important
        -o-filter: blur(0px) !important;
        -ms-filter: blur(0px) !important;
        filter: blur(0px) !important;
    }
    <?php
    }
    ?>
</style>

<!-- 메세지 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">메세지 보내기</h4>
                </div>
                <div class="modal-body msg_con">
                    <div class="to_name"><strong class="nick"></strong>께 보내는 <span class="ht"><i class="fas fa-heart"></i></span>메세지<span class="ht"><i class="fas fa-heart"></i></span></div>
                    <div class="cont">
                        <textarea class="form-control doc-text" rows="6" id="message" name="message" placeholder="200자 이내로 내용을 입력해 주세요." style="resize: unset;"></textarea>
                        <p id="counter">0 / 최대 200자</p>
                    </div>
                </div><!--msg_con-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="send_message();"><i class="fas fa-paper-plane"></i> 메세지 전송하기</button>
                    <input type="hidden" id="receive_mb_no" name="receive_mb_no">
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 메세지 모달팝업 -->


<!--받은메세지 뷰-->
<?php
if($mode == 'receive')
{
    // 프로필 이미지 (첫번째 사진 한장)
    $sql = " select * from g5_member_img where mb_no = {$me['send_mb_no']} order by idx limit 1";
    $file = sql_fetch($sql);
?>
<div id="msg">
    <div class="in inview">
        <div class="msg_con">
        	<div class="list cf">
            	<div class="face">
                <?php if(isset($file['img_file'])) { ?>
                    <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file['img_file']?>" />
                <?php } else { ?>
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                <?php } ?>
                </div>
                <div class="info">
                	<h2 class="nick"><strong>From.</strong><?php if($me['secret_member'] == 'Y') { ?><i class="secret"></i><?php } ?><span><?=$me['mb_nick']?></span>님</h2>
                    <div class="date"><?=$me['message_date']?></div>
                    <div class="cons"><?=nl2br($me['message'])?></div><!--내용글 다 보여줌-->
                    <?php if($me['mb_level'] != '10' && $me['secret_member'] != 'Y') { ?> <!-- 최고관리자는 프로필 조회 X, 시크릿 회원 프로필 조회 X (미정) -->
                    <div class="who"><a href="<?=G5_BBS_URL?>/mem_view.php?mb_no=<?=$me['send_mb_no']?>"><i class="fas fa-heart"></i> 프로필 보기 <i class="fas fa-heart"></i></a></div>
                    <?php } ?>
                </div>
            </div><!--list-->
            <div class="ad_btn">
                <?php if($max_receive_idx != $me['idx']) { ?>
                    <a href="javascript:void(0);" onclick="message_move('<?=$prev_receive_idx?>', 'receive');" class="pv"><i class="fas fa-long-arrow-alt-left"></i> 이전 메세지</a>
                <?php } ?>
                <?php if($min_receive_idx != $me['idx']) { ?>
                    <a href="javascript:void(0);" onclick="message_move('<?=$next_receive_idx?>', 'receive');" class="nt">다음 메세지 <i class="fas fa-long-arrow-alt-right"></i></a>
                <?php } ?>
                <!--<a href="<?/*=G5_BBS_URL*/?>/<?/*=$link*/?>" class="golist">목록</a>-->
                <a href="javascript:void(0);" onclick="send_message_modal('<?=$me['mb_no']?>', '<?=$me['mb_nick']?>');" class="wrt">메세지 <i class="fas fa-pencil-alt"></i></a>
                <a href="javascript:void(0);" onclick="list_move();" class="golist">목록</a>
            </div>         
        </div><!--msg_con-->
    </div><!--in-->
</div><!--msg-->
<?php
}
?>

<?php
if($mode == 'send')
{
    // 프로필 이미지 (첫번째 사진 한장)
    $sql = " select * from g5_member_img where mb_no = {$me['receive_mb_no']} order by idx limit 1";
    $file = sql_fetch($sql);

    // 21.05.04 본인에게 메세지 보낸 사람은 블러 처리 하지 않음, 1,000포인트 차감으로 프로필 사진 조회한 사람은 블러 처리 하지 않음
    $blur = 'blur';
    $message = sql_fetch(" select count(*) as count from g5_message where send_mb_no = {$me['mb_no']} and receive_mb_no = {$member['mb_no']}; ")['count'];
    $profile_view = sql_fetch( " select count(*) as count from g5_member_point where mb_id = '{$member['mb_id']}' and rel_mb_id = '{$me['mb_id']}'; ")['count'];
    if($message > 0 || $profile_view > 0) {
        $blur = 'noblur';
    }
?>
<!--보낸메세지 뷰-->
<div id="msg">
    <div class="in inview">
        <div class="msg_con">
            <div class="list cf">
                <div class="face <?=$blur?>">
                <?php if(isset($file['img_file'])) { ?>
                    <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file['img_file']?>" />
                <?php } else { ?>
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                <?php } ?>
                </div>
                <div class="info">
                    <h2 class="nick"><strong>To.</strong><?php if($me['secret_member'] == 'Y') { ?><i class="secret"></i><?php } ?><span><?=$me['mb_nick']?></span>님께</h2>
                    <div class="date"><?=$me['message_date']?></div>
                    <div class="cons"><?=nl2br($me['message'])?></div><!--내용글 다 보여줌-->
                    <?php if($me['mb_level'] != '10' && $me['secret_member'] != 'Y') { ?> <!-- 최고관리자는 프로필 조회 X, 시크릿 회원 프로필 조회 X (미정) -->
                    <div class="who"><a href="<?=G5_BBS_URL?>/mem_view.php?mb_no=<?=$me['receive_mb_no']?>"><i class="fas fa-heart"></i> 프로필 보기 <i class="fas fa-heart"></i></a></div>
                    <?php } ?>
                </div>
            </div><!--list-->
            <div class="ad_btn">
                <?php if($min_send_idx != $me['idx']) { ?>
                <a href="javascript:void(0);" onclick="message_move('<?=$prev_send_idx?>', 'send');" class="pv"><i class="fas fa-long-arrow-alt-left"></i> 이전 메세지</a>
                <?php } ?>
                <?php if($max_send_idx != $me['idx']) { ?>
                <a href="javascript:void(0);" onclick="message_move('<?=$next_send_idx?>', 'send');" class="nt">다음 메세지 <i class="fas fa-long-arrow-alt-right"></i></a>
                <?php } ?>
                <!--<a href="<?/*=G5_BBS_URL*/?>/<?/*=$link*/?>" class="golist">목록</a>-->
                <a href="javascript:void(0);" onclick="send_message_modal('<?=$me['mb_no']?>', '<?=$me['mb_nick']?>');" class="wrt">메세지 <i class="fas fa-pencil-alt"></i></a>
                <a href="javascript:void(0);" onclick="list_move();" class="golist">목록</a>
            </div>
        </div><!--msg_con-->
    </div><!--in-->
</div><!--msg-->
<?php
}
?>

<script>
// 목록 이동 (뒤로가기 때문에 replace 사용)
function list_move() {
    location.replace('<?=G5_BBS_URL?>/<?=$link?>');
}

// 메세지 이동
function message_move(idx, mode) {
    if(mode == 'send') {
        location.replace('<?php echo G5_BBS_URL ?>/msg_view.php?idx='+idx+'&mode=send');
    }
    else {
        location.replace('<?php echo G5_BBS_URL ?>/msg_view.php?idx='+idx+'&mode=receive');
    }
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
    var text = "\n<?=$manna_arr['message']?>만나가 차감됩니다.";
    <?php if ($ios_payment_test || $member["mb_level"] == 10 ||$me['mb_no'] == 1 ){ ?>
    text = "";
    <?php } ?>

    if ($('#receive_mb_no').val() == 1){
        text = "";
    }


    swal({
        text: "메세지를 보내시겠습니까?"+text,
        icon: "warning",
        buttons: {
            cancel: "취소",
            defeat: "확인",
        }
    }).then((value) => {
        switch (value) {
            case "defeat":
                $.ajax({
                    type: 'POST',
                    url: g5_bbs_url + "/ajax.send_message.php",
                    data: {mb_no: $('#receive_mb_no').val(), message:  $('textarea#message').val() },
                    success: function (data) {
                        if(data == 'success') {
                            swal('메세지를 전송하였습니다.')
                                .then(() => {
                                    $('#myModal6').modal('hide');
                                });
                        }else {
                            swal('메세지를 보낼 만나가 부족합니다.')
                                .then(() => {
                                    $('#myModal6').modal('hide');
                                    location.href = g5_bbs_url + "/user_level.php"

                                });
                        }
                    }
                });

        }
        is_post = false;

    });
}
</script>
