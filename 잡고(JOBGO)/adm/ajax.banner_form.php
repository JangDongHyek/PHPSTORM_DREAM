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

    $ctg1 = p_common_code($row['ba_category']);
    if ($ctg1['p_idx'] != "0" && $ctg1['p_idx'] != ""){
        $ba_category1 = $ctg1['p_idx'];
        $ba_category2 = $ctg1['idx'];
        $ba_category3 = $row['ba_category'];
    }else if ($ctg1['idx'] != "0" && $ctg1['idx'] != ""){
        $ba_category1 = $ctg1['idx'];
        $ba_category2 = $row['ba_category'];
    } else{
        $ba_category1 = $row['ba_category'];
    }


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

    <strong>배너위치<strong>
            상단 <input checked onclick="ba_place_disabled(this.value)" type="radio" name="ba_place" value="top">
            하단 <input onclick="ba_place_disabled(this.value)" type="radio" name="ba_place" value="btm">
            카테고리 별 <input onclick="ba_place_disabled(this.value)" type="radio" name="ba_place" value="ctg">

            <select disabled name="ba_category1" class="ba_category" id="ba_category1" onchange="pro_ctg1_change(this.value,'pro')">
                <?= common_code('ctg','code_ctg','html') ?>
            </select>
            <select disabled name="ba_category2" class="ba_category" id="ba_category2" onchange="pro_ctg1_change(this.value,'pro2')">
                <option>2차 카테고리 선택</option>
            </select>
            <select disabled name="ba_category3" class="ba_category" id="ba_category3">
                <option>3차 카테고리 선택</option>
            </select>
            <br>
            <br>
    <strong>연결링크<strong>
        <input type="text" name="ba_link" value="<?=$row['ba_link']?>" class="frm_input" style="width: 90%;">
        <div>※ http:// 혹은  https:// 까지 기입해주세요.</div>
        <br>
        <div>새탭으로 이동 <input <? if ($row['ba_new_tab'] == "1") echo "checked"; ?> type="checkbox" name="ba_new_tab" value="1"></div>
        <div>※ 체크하지 않을 경우 잡고에서 이동하게 됩니다.</div>
        <br>
    <strong>노출순서<strong>
        <input type="text" name="ba_number" value="<?=$row['ba_number']?>" class="frm_input">
        <span>※ 숫자가 클수록 먼저 노출됩니다.</span>
        <br>
    <strong>노출유무<strong>
        <select name="ba_use">
        <?php for ($i = 1; $i <= count($yn_list); $i++){ ?>
            <option value="<?= $i ?>"><?= $yn_list[$i] ?></option>
        <?php } ?>
        </select>
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
    $(function() {
        if('<?=$idx?>' != '') {
            $('#ba_category1').val('<?=$ba_category1?>').attr('selected', 'selected');
            pro_ctg1_change('<?=$ba_category1?>','pro');
            setTimeout(function(){$('#ba_category2').val('<?=$ba_category2?>').attr('selected', 'selected');}, 200);
            <?php if ($ba_category2 != ""){ ?>
            pro_ctg1_change('<?=$ba_category2?>','pro2');
            setTimeout(function(){$('#ba_category3').val('<?=$ba_category3?>').attr('selected', 'selected');}, 300);
            <?php } ?>
            $("input:radio[name='ba_place']:radio[value='<?=$row['ba_place']?>']").prop("checked", true);
            ba_place_disabled('<?=$row['ba_place']?>');

            $('[name = ba_use]').val('<?=$row['ba_use']?>');
        }
    });

    function ba_place_disabled(val) {
        if (val == 'ctg'){
            $('.ba_category').attr('disabled',false);
        }else{
            $('.ba_category').attr('disabled',true);
        }

    }


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

    //카테고리 변경 시 change시키기
    function pro_ctg1_change(val,type) {

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "pro_ctg1": val,
                "mode": "pro_ctg2_common"
            },
            dataType: "html",
            success: function(data) {
                if(type == 'pro') {
                    $('[name = "ba_category2"]').html('<option value="">2차 카테고리 선택</option>' + data);
                    $('[name = "ba_category3"]').html('<option value="">3차 카테고리 선택</option>');
                }else if(type == 'pro2') {
                    $('[name = "ba_category3"]').html('<option value="">3차 카테고리 선택</option>' + data);
                }
            }
        });

    }
</script>