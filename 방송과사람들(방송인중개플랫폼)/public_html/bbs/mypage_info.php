<?php

//찜한 서비스
$sql = "select count(*) cnt from new_heart where mb_no = '{$member['mb_no']}' ";
$like_cnt = sql_fetch($sql)['cnt'];


?>
<div id="area_my" class="company">
	<div class="myinfo">
		<div class="myinfo_wrap" >
            <form id = 'imgfrm'>
                <input type="file" name="mb_icon" id="mb_icon" onchange="getImgPrev(this);" accept="image/*" style="display: none">

                <div class="area_photo basic">
                    <?php
                    $icon_file = G5_DATA_PATH.'/file/member/'.$member['mb_no'].'.jpg';
                    if (file_exists($icon_file)) {
                        $icon_url = G5_URL.'/data/file/member/'.$member['mb_no'].'.jpg';
                        echo '<img src="'.$icon_url.'" alt="">';
                    }else{
                        echo '<img src="'.G5_IMG_URL .'/img_smile.jpg">';
                    }
                    ?>
                </div>
            </form>
		</div>
		<div class="id">
            <p><?=$member["mb_nick"]?></p>
            <i><?= ($member["mb_level"] > '2') ? "전문가" : "의뢰인" ?></i>
                <a class="btn" href="<?php echo G5_BBS_URL ?>/register_form.php?w=u">정보수정</a>
                <a class="btn" href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a>
        </div>

<!--		<a class="btn_type" onclick="change_member_type()"><span>--><?//= ($member["mb_level"] > '2') ? "의뢰인" : "전문가" ?><!--로 전환</span></a>-->
        <a class="btn_type" onclick="request_conversion()"><span><?= ($member["mb_level"] > '2') ? "의뢰인" : "전문가" ?>로 전환</span></a>
	</div>
	<ul class="my_qna">
		<li><em>찜한 서비스</em><a href="<?=G5_BBS_URL.'/mypage_jjim.php'?>"><?=$like_cnt?></a></li>
		<li><em>구매한 서비스</em><a href="<?=G5_BBS_URL.'/mypage.php'?>">0</a></li>
		<li><em>문의한 서비스</em><a href="javascript:void(0);">0</a></li>
	</ul>

</div>
<script>
    function file_click() {
        $('#mb_icon').trigger('click');
    }

    //function change_member_type() {
    //    $.post("<?//=G5_URL?>///cjax/change_member_type.php",{},function (data) {
    //        location.reload();
    //    });
    //}

    function request_conversion() {
        $.ajax({
            url : "ajax_member_request_conversion.php",
            method : "post",
            enctype : "multipart/form-data",
            async : false,
            cache : false,
            data : {
                "_method" : "post",
            },
            dataType : "json",
            success: function(res){
                if(!res.success) alert(res.message);
                else {
                    alert("신청이 완료되었습니다.")
                }
            }
        });
    }


</script>