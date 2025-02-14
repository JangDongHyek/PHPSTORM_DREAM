<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<style>
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
	.btn_wrap{
		display: flex;
		align-items: center;
		width: 100%;
		padding: 10px 0 0;
	}
	.btn{
		width: 50%;
		margin: 0 2.5px;
	}
	a.btn_ok{
		background: #fe8ea6;
		color: #fff;
	}
	a.btn_no{
		background: #fff;
		border: 1px solid #ccc;
		color: #333;
	}
</style>


<!--내메세지함-->
<div id="msg">

    <!--내용부분-->
    <div class="in" style="padding-top: 20px !important;">
        <div class="msg_con">
            <?php for ($i = 0; $want =sql_fetch_array($result); $i++){
                $wonder_mb = get_member_no($want["wonder_mb_no"]) ;
                if($wonder_mb['mb_sex'] == '여')  $cover_img = 'img_cover02.png'; else $cover_img = 'img_cover01.png'; ?>
            <div class="list cf">
                <div class="face"><!--회원사진이 뜨게..-->
                <?php /*if(isset($file['img_file'])) { ?>
                    <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file['img_file']?>" />
                <?php } else { ?>
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                <?php }*/ ?>
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$cover_img?>" />
                </div>
                <div class="info">
                    <h2 class="nick">
                        <a href="<?=G5_BBS_URL.'/mem_view.php?mb_no='.$want["wonder_mb_no"]?>">
                            <span><?=$wonder_mb["mb_name"]?></span>님에게 학벌/재산/연봉정보
                            <span id="btn_class_<?=$want['iq_idx']?>" class="open_ment">
                                <?php if ($want['iq_yn'] == "W"){ ?>
                                    열람을 <b>수락</b>하시겠습니까?
                                <?php }elseif ($want['iq_yn'] == "Y"){ ?>
                                    열람을 <b>승낙</b>하셨습니다.
                                <?php }elseif ($want['iq_yn'] == "N"){?>
                                    열람을 <b>거절</b>하셨습니다.
                                <?php } ?>
                            </span>
                        </a>
                    </h2>
                    <div class="date">수신일 : <?= date("Y-m-d", strtotime($want["wr_datetime"]))?></div>
                    
                </div>
                <div class="btn_wrap btn_div_<?=$want['iq_idx']?>">
                    <?php if ($want['iq_yn'] == "W"){ ?>
                        <a href="javascript:req_info('Y',<?=$want['iq_idx']?>,<?=$wonder_mb['mb_no']?>)" class="btn btn_ok">열람승낙</a>
                        <a href="javascript:req_info('N',<?=$want['iq_idx']?>,<?=$wonder_mb['mb_no']?>)" class="btn btn_no">열람거절</a>
                    <?php } ?>
                </div>
            </div><!--list-->
            <?php }
            if ($i == 0){ ?>
                <div class="msg_none"><span><i class="fas fa-paper-plane"></i></span> 받은 신청이 없습니다.</div>
            <?php } ?>
        <!--받은 메세지가 없을때 띄워주세요.-->
        </div><!--msg_con-->
    </div><!--in-->
</div><!--msg-->
<!--내메세지함-->

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
    function req_info(req,idx,wonder_mb_no) {
        var text = "",
            cla = "";
        if (req == "Y"){
            text = "승낙";
        }else{
            text = "거절";
        }

        $.ajax({
            url : g5_bbs_url + "/ajax.controller.php",
            data: {mode: "req_info", req:req,idx:idx,wonder_mb_no:wonder_mb_no },
            type: 'POST',
            async: false,
            success : function(data) {
                if(data) {
                    swal("열람"+text + "이 완료되었습니다.");
                    $("#btn_class_"+idx).html("열람을 "+text+"하셨습니다.");
                    $(".btn_div_"+idx).html("");
                }
            },
            beforeSend: function() {
                showLoadingBar();
            },
            error: function() {
                hideLoadingBar();
            }
        });


    }
</script>