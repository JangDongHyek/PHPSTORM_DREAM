<?php
include_once(G5_PATH."/jl/JlConfig.php");

$model_config = array(
    "table" => "member_product_like"
);

$member_product_like = new JlModel(array("table" => "member_product_like"));
$member_order = new JlModel(array("table" => "member_order"));

// 상품 찜
$member_product_like->where("member_idx",$member['mb_no']);
$product_likes = $member_product_like->count();

// 구매상품
$member_order->where("member_idx",$member['mb_no']);
$order_count = $member_order->count();
?>
<div id="area_my" class="company">
	<div class="myinfo">
		<div class="myinfo_wrap" >
            <form id = 'imgfrm'>
                <input type="file" name="mb_icon" id="mb_icon" onchange="getImgPrev(this);" accept="image/*" style="display: none">

                <div class="area_photo basic">
                    <a href="<?php echo G5_BBS_URL ?>/profile.php?mb_no=<?=$member['mb_no']?>">
                    <?php
                    $icon_file = G5_DATA_PATH.'/file/member/'.$member['mb_no'].'.jpg';
                    if (file_exists($icon_file)) {
                        $icon_url = G5_URL.'/data/file/member/'.$member['mb_no'].'.jpg';
                        echo '<img src="'.$icon_url.'" alt="">';
                    }else{
                        echo '<img src="'.G5_IMG_URL .'/img_smile.jpg">';
                    }
                    ?>
                    </a>
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
        <?php if($member["mb_level"] > '2') {?>
        <a class="btn_type" onclick="request_conversion(2)"><span>의뢰인으로 전환</span></a>
        <?php } else {?>
            <a class="btn_type" onclick="request_conversion(3)"><span>전문가로 전환</span></a>
        <?php } ?>
	</div>
	<ul class="my_qna">
		<li><em>찜한 서비스</em><a href="<?=G5_BBS_URL.'/mypage_jjim.php'?>"><?=$product_likes?></a></li>
		<li><em>구매한 서비스</em><a href="<?=G5_BBS_URL.'/mypage.php'?>"><?=$order_count?></a></li>
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

    function request_conversion(level) {
        $.ajax({
            url : "ajax_member_request_conversion.php",
            method : "post",
            enctype : "multipart/form-data",
            async : false,
            cache : false,
            data : {
                "_method" : "post",
                "level" :level
            },
            dataType : "json",
            success: function(res){
                if(!res.success) alert(res.message);
                else {
                    alert("완료되었습니다.");
                    window.location.reload();
                }
            }
        });
    }


</script>