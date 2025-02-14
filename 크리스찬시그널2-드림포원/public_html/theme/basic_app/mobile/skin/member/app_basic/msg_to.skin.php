<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<style>
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
    .lg_btn a {
        display: inline-block;
        padding: 4px 12px;
        color: #000;
        font-size: 0.95em;
        /*border-radius: 30px;*/
        border: 1px solid #fe8ea6;
        margin: 5px;
    }
    .lg_btn a.on {
        display: inline-block;
        padding: 4px 12px;
        color: #fff;
        font-size: 0.95em;
        /*border-radius: 30px;*/
        margin-top: 20px;
        background: #fe8ea6;
        border: 1px solid #fe8ea6;
        font-size: 1em;
        font-weight: 600;
    }
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


<!--내메세지함-->
<div id="msg">
	<!--상단카테고리-->
    <ul class="cate cf">
        <li><a href="javascript:void(0);" onclick="tab_move('msg_from.php');">받은 메세지</a></li>
        <li class="active"><a href="javascript:void(0);">보낸 메세지</a></li>
        <li><a href="javascript:void(0);" onclick="tab_move('msg_adm.php');">관리자 메세지</a></li>
    </ul>

    <form id="fmemsch" name="fmemsch" method="get">
        <div id="mem_sch" class="cf">
            <div class="part cf">
                <span>닉네임</span>
                <input type="text" id="name_sch" placeholder="닉네임" name="name_sch"  value="<?=$_GET['name_sch']?>">
                <input type="hidden" id="mode" name="mode" value="<?=$mode?>">
                <input type="submit" value="검색">
            </div><!--part-->
            <?php if($private) { ?>
            <!--<div class="part cf">
                <p class="lg_btn">
                    <a <?php /*echo $mode == 2 || empty($mode) ? 'class="on"' : ''; */?> onclick="$('#mode').val('2');document.fmemsch.submit();">회원</a>
                    <a <?php /*echo $mode == 10 ? 'class="on"' : ''; */?> onclick="$('#mode').val('10');document.fmemsch.submit();">관리자</a>
                </p>
            </div>-->
            <?php } ?>
        </div><!--mem_sch-->
    </form>

    <!--내용부분--> 
    <div class="in" style="padding-top: 5px !important;">
        <div class="msg_con">
        <?php
        for($i=0; $row=sql_fetch_array($result); $i++) {
            // 프로필 기본이미지
            if($row['mb_sex'] == '여')  $default_img = 'noimg.jpg'; else $default_img = 'noimg_male.jpg';

            // 프로필 이미지 (첫번째 사진 한장)
            $sql = " select * from g5_member_img where mb_no = {$row['receive_mb_no']} order by idx limit 1";
            $file = sql_fetch($sql);

            // 수신확인
            if(!empty($row['message_state'])) $message_state = 'fa-envelope-open'; else $message_state = 'fa-envelope';
            if(!empty($row['message_state'])) $before = 'before'; else $before = '';

            // 21.05.04 본인에게 메세지 보낸 사람은 블러 처리 하지 않음, 1,000포인트 차감으로 프로필 사진 조회한 사람은 블러 처리 하지 않음
            $blur = 'blur';
            $message = sql_fetch(" select count(*) as count from g5_message where send_mb_no = {$row['mb_no']} and receive_mb_no = {$member['mb_no']}; ")['count'];
            $profile_view = sql_fetch( " select count(*) as count from g5_member_point where mb_id = '{$member['mb_id']}' and rel_mb_id = '{$row['mb_id']}'; ")['count'];
            if($message > 0 || $profile_view > 0) {
                $blur = 'noblur';
            }
        ?>
            <div class="list cf">
                <div class="new <?=$before?>"><i class="fas <?=$message_state?>"></i></div><!--상대가 읽기 전/읽기 후 표시-->
                <?php if($row['mb_level'] != 10 && $row['propose'] == 'ON') { ?> <!-- 관리자에게 신청 X -->
                <div class="bts propose"><a href="javascript:void(0);" onclick="send_propose('<?=$row['mb_no']?>', '<?=$row['mb_nick']?>');"><i class="fas fa-hand-holding-heart" title="데이트신청"></i></a></div><!--데이트 신청-->
                <?php } ?>
                <div class="bts write"><a href="javascript:void(0);" onclick="send_message_modal('<?=$row['mb_no']?>', '<?=$row['mb_nick']?>');"><i class="fas fa-pencil-alt" title="메세지보내기"></i></a></div><!--메세지 보내는 창 뜨게-->
                <div class="bts del"><a href="javascript:void(0);" onclick="del_message('<?=$row['idx']?>');" title="삭제"><i class="far fa-trash-alt"></i></a></div><!--삭제누르면 "해당메세지를 정말 삭제하시겠습니까? 확인창 한번 더 뜨고 삭제 되도록..-->
                <div class="face <?=$blur?>"><!--회원사진이 뜨게..-->
                <?php if(isset($file['img_file'])) { ?>
                    <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file['img_file']?>" />
                <?php } else { ?>
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                <?php } ?>
                </div>
                <div class="info">
                    <h2 class="nick"><strong>To.</strong><?php if($row['secret_member'] == 'Y') { ?><i class="secret"></i><?php } ?><span><?=$row['mb_nick']?></span>님께</h2>
                    <div class="date">발신일 : <?=$row['message_date']?></div>
                    <div class="con"><?=$row['message']?></div><!--내용글 최대 두줄까지만 보여줌, ....처리-->
                    <!--<a href="<?php /*echo G5_BBS_URL */?>/msg_view.php?idx=<?/*=$row['idx']*/?>&mode=send" class="view">메세지 더보기 +</a>-->
                    <a href="javascript:void(0)" onclick="view_move('<?=$row['idx']?>');" class="view">메세지 더보기 +</a>
                </div>
            </div><!--list-->
        <?php
        }
        if($i == 0) {
        ?>
            <!--보낸 메세지가 없을때 띄워주세요.-->
            <div class="msg_none"><span><i class="fas fa-paper-plane"></i></span> 보낸 메세지가 없습니다.</div>
            <!--보낸 메세지가 없을때 띄워주세요.-->
        <?php
        }
        ?>
        </div><!--msg_con-->
    </div><!--in-->
</div><!--msg-->
<!--내메세지함-->

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
//textarea 글자 수 제한
$('.doc-text').keyup(function (e) {
    var content = $("textarea#message").val();
    $('#counter').html("" + content.length + " / 최대 200자");    //글자수 실시간 카운팅

    if (content.length > 200) {
        alert("최대 200자까지 입력 가능합니다.");
        $(this).val(content.substring(0, 200));
        $('#counter').html("200 / 최대 200자");
    }
});

// 탭 이동 (뒤로가기 때문에 replace 사용)
function tab_move(page) {
    location.replace(g5_bbs_url+'/'+page);
}

// 메세지 더보기 이동 (뒤로가기 때문에 replace 사용)
function view_move(idx) {
    location.replace('<?php echo G5_BBS_URL ?>/msg_view.php?idx='+idx+'&mode=send');
}

// 메세지 삭제
function del_message(idx) {
    swal({
        text: "메세지를 삭제하시겠습니까?",
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
                    url: g5_bbs_url + "/ajax.del_message.php",
                    data: {idx: idx, mode : 'send'},
                    success: function (data) {
                        if(data) {
                            swal('메세지가 삭제되었습니다.')
                            .then(() => {
                                location.replace(g5_bbs_url + '/msg_to.php');
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


    var text = "\n<?=$manna_arr['message']?>만나가 차감됩니다.";
    <?php if ($ios_payment_test || $member["mb_level"] == 10 ){ ?>
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
                                    location.replace(g5_bbs_url + '/msg_to.php');
                                });
                        }else {
                            swal('메세지를 보낼 만나가 부족합니다.')
                                .then(() => {
                                    location.href = g5_bbs_url + "/user_level.php"
                                });
                        }
                    }
                });

        }
        is_post = false;

    });

}

// 데이트 신청
function send_propose(mb_no, mb_nick) {
    swal(mb_nick + '님께 데이트를 신청하시겠습니까?', {
        buttons: {
            cancel: "취소",
            defeat: "신청"
        }
    })
    .then((value) => {
        switch (value) {
            case "defeat" :
                $.ajax({
                    type: 'POST',
                    url: g5_bbs_url + "/ajax.send_propose.php",
                    data: {mb_no: mb_no},
                    success: function (data) {
                        if(data == 'success') {
                            swal('데이트를 신청하였습니다.')
                            .then(() => {
                                location.replace(g5_bbs_url + '/propose_to.php');
                            });
                        }
                        else if(data == 'fail') {
                            swal('데이트 신청 거절 상태입니다.')
                            .then(() => {
                                location.replace(g5_bbs_url + '/msg_to.php');
                            });
                        }
                    }
                });
                break;
        }
    });
}
</script>