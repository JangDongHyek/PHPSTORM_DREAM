<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>



<!--내메세지함-->
<div id="msg">
	<!--상단카테고리-->
    <ul class="cate cf">
        <li class="active"><a href="javascript:void(0);">데이트 수신</a></li>
        <li><a href="javascript:void(0);" onclick="tab_move('propose_to.php');">데이트 신청</a></li>
    </ul>
    
    <!--내용부분--> 
    <div class="in">
        <div class="msg_con dating">
        <?php
        for($i=0; $row=sql_fetch_array($result); $i++) {
            // 프로필 기본이미지
            if($row['mb_sex'] == '여')  $default_img = 'noimg.jpg'; else $default_img = 'noimg_male.jpg';

            // 프로필 이미지 (첫번째 사진 한장)
            $sql = " select * from g5_member_img where mb_no = {$row['send_mb_no']} order by idx limit 1";
            $file = sql_fetch($sql);

            // 수신확인
            if(!empty($row['propose_state'])) $propose_state = ''; else $propose_state = 'new';
        ?>
            <div class="list cf">
                <?php if(!empty($row['propose_state'])) { ?>
                <!--<div class="propose_ok">상태 : <?=$row['propose_state']?></a></div>-->
                <div class="propose_state"><i class="fas fa-check-circle"></i> 데이트 <span><?=$row['propose_state']?></span>함</a></div>
                <?php } else { ?>
                <div class="propose_btn">
                    <div class="propose_y"><a href="javascript:void(0);" onclick="change_propose_state('<?=$row['idx']?>','수락');"><i class="fas fa-heart"></i> 수락</a></div>
                    <div class="propose_n"><a href="javascript:void(0);" onclick="change_propose_state('<?=$row['idx']?>','거절');"><i class="fas fa-heart-broken"></i> 거절</a></div>
                </div>
                <?php } ?>
                <!--<div class="<?/*=$propose_state*/?>"><?php /*if($propose_state) echo 'N';*/?></div>-->
                <!--<div class="write"><a href="javascript:void(0);" onclick="send_message_modal('<?/*=$row['mb_no']*/?>', '<?/*=$row['mb_nick']*/?>');"><i class="fas fa-pencil-alt"></i></a></div>-->
                <div class="bts del"><a href="javascript:void(0);" onclick="del_propose('<?=$row['idx']?>');" title="삭제"><i class="far fa-trash-alt"></i></a></div>
                <div class="face"><!--회원사진이 뜨게..-->
                <?php if(isset($file['img_file'])) { ?>
                    <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file['img_file']?>" />
                <?php } else { ?>
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                <?php } ?>
                </div>
                <div class="info">
                    <h2 class="nick"><strong>From.</strong><span><?=$row['mb_nick']?></span>님의 데이트 신청</h2>
                    <!--<div class="con"><?/*=$row['message']*/?></div>-->
                    <div class="date">수신일 : <?=$row['propose_date']?></div>
                    <div class="who"><a href="<?=G5_BBS_URL?>/mem_view.php?mb_no=<?=$row['send_mb_no']?>"><i class="fas fa-heart"></i> 프로필 보기 <i class="fas fa-heart"></i></a></div>
                </div>
            </div><!--list-->
            <?php
        }
        if($i == 0) {
        ?>
        <div class="msg_none"><span><i class="fas fa-paper-plane"></i></span> 데이트 수신 내역이 없습니다.</div>
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

// 데이트 삭제
function del_propose(idx) {
    swal({
        text: "데이트 수신 내역을 삭제하시겠습니까?",
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
                    data: {idx: idx, mode : 'receive'},
                    success: function (data) {
                        if(data) {
                            swal('데이트 수신 내역이 삭제되었습니다.')
                            .then(() => {
                                location.replace(g5_bbs_url + '/propose_from.php');
                            });
                        }
                    }
                });
            break;
        }
    });
}
    
// 수락/거절
function change_propose_state(idx, state) {
    swal('데이트를 '+state+'하시겠습니까?', {
        buttons: {
            cancel: "취소",
            defeat: "확인"
        }
    })
    .then((value) => {
        switch (value) {
            case "defeat" :
                $.ajax({
                    type: 'POST',
                    url: g5_bbs_url + "/ajax.change_propose_state.php",
                    data: {idx: idx, state : state},
                    success: function (data) {
                        if(data) {
                            swal('데이트를 '+state+'하였습니다.')
                            .then(() => {
                                location.replace(g5_bbs_url + '/propose_from.php');
                            });
                        }
                    }
                });
                break;
        }
    });
}
</script>