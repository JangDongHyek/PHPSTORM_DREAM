<?php
/**************************************************
배너관리 - 배너등록/수정
 **************************************************/
include_once("./_common.php");

$img_exists = false;

$idx = $_REQUEST['idx'];
if ($idx != "") {
    $sql = "SELECT * FROM new_adm_banner WHERE idx = '{$idx}'";
    $row = sql_fetch($sql);
    $img_path = G5_BNR_PATH."/".$row['image'];
    $img_exists = (file_exists($img_path) && $row['image'])? true : false;
}

?>
<style>
    strong {display:block; margin: 5px 0;}
    .p_img {max-width:100%;}
</style>
<form id="regFrm" name="regFrm" action="banner_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <input type="hidden" name="idx" value="<?=$row['idx']?>">
    <input type="hidden" name="bnr_img_old" value="<?=$row['image']?>">

    <strong>연결링크<strong>
            <input type="text" name="ba_link" value="<?=$row['ba_link']?>" class="frm_input" style="width: 90%;">
            <br>
            <strong>노출순서<strong>
                    <input type="text" name="ba_number" value="<?=$row['ba_number']?>" class="frm_input">
                    <span>※ 숫자가 클수록 먼저 노출됩니다.</span>
                    <br>
                    <br>
                    <strong>배너이미지(권장사이즈 800px X 340px)<strong>
                            <input type="file" name="image" onchange="getImgPrev(this)">
                            <!-- 미리보기 -->
                            <div id="prev_area">
                                <? if ($img_exists) { ?>
                                    <div class="p_box"><img src="<?=str_replace(G5_DATA_PATH, G5_DATA_URL, $img_path)?>" class="p_img"></div>
                                    <!--<label for="img_del"><input type="checkbox" id="img_del" name="bnr_img_del" value="1"> 이미지 삭제</label>-->
                                <? } ?>
                            </div>
</form>

<script>
    // 파일업로드 미리보기
    function getImgPrev(input) {
        var reg_ext = /(.*?)\.(jpg|jpeg|png|bmp)$/;
        var file_name = input.files[0].name.toLowerCase();
        if (!reg_ext.test(file_name)) {
            alert("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp)");
            return false;
        }

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var area = document.getElementById("prev_area"),
                    div = document.createElement('div'),
                    div_img = document.createElement('div'),
                    img = document.createElement('img');

                area.innerHTML = "";

                div.setAttribute("class", "p_box");
                div.setAttribute("id", "p_box");

                img.setAttribute("class", "p_img");
                img.setAttribute("src", e.target.result);

                div.appendChild(img);
                area.appendChild(div);
            }
            reader.readAsDataURL(input.files[0]);
        }

    }
</script>