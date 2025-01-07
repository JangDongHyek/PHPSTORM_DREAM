<?php
$sub_menu = "300000";
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], 'w');
include_once ('./admin.head.php');

if($_GET[w]=="u"){
	$sql="select * from g5_item where idx='$idx'";
	$row=sql_fetch($sql);
}
$sql="select * from g5_category order by idx asc";
$cResult=sql_query($sql);
?>

<form name="fboardform" id="fboardform" action="./item_form_update.php" onsubmit="return fboardform_submit(this)" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $_GET['w']?>">
<input type="hidden" name="idx" value="<?php echo $_GET['idx']?>">

<section id="anc_bo_basic">
    <h2 class="h2_frm">발주상품 등록</h2>
    <?php echo $pg_anchor ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>게시판 기본 설정</caption>
        <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_3">
        </colgroup>
        <tbody>
		<tr>
            <th scope="row"><label for="item_name">분류</label></th>
            <td>
                <select name="category_no" required>
					<option value="">분류선택</option>
					<?php
						for($i=0;$cRow=sql_fetch_array($cResult);$i++){
					?>
					<option value="<?php echo $cRow[idx]?>"<?php echo $cRow[idx]==$row[category_no]?" selected":"";?>><?php echo $cRow[category_name]?></option>
					<?php }?>
				</select>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="item_name">상품명</label></th>
            <td>
                <input type="text" name="item_name" value="<?php echo $row['item_name'] ?>" id="item_name" <?php echo $required ?> <?php echo $readonly ?> class="frm_input" maxlength="20">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="price">가격</label></th>
            <td>
                <input type="text" name="price" value="<?php echo $row['price'] ?>" id="price" <?php echo $required ?> <?php echo $readonly ?> class="frm_input" maxlength="20">
            </td>
        </tr>
		<tr>
            <th scope="row"><label for="item_name">이미지</label></th>
            <td>
				<input type="hidden" name="old_item_image" value="<?php echo $row[item_image]?>">
				<div style="width:100px;height:100px;line-height:100px;text-align:center;font-weight:bold;font-size:20px;border:1px solid #ccc;background-color:#f1f1f1;overflow:hidden;padding:0px" id="item-image">
				<?php
					if($row[item_image]==""){?>
					+
				<?php }else{?>
				<img src="<?php echo G5_DATA_URL?>/item/thumb/<?php echo $row[item_image]?>">
				<?php }?>
				</div>
                <input type="file" name="item_image" style="display:none" id="item_image" accept="image/*">
            </td>
        </tr>
		<tr>
            <th scope="row"><label for="orderby">정렬</label></th>
            <td>
                <input type="text" name="orderby" value="<?php echo $row['orderby'] ?>" id="orderby" <?php echo $required ?> <?php echo $readonly ?> class="frm_input" maxlength="20"><br/>
				숫자가 높을수록 상단에 보여줍니다.
            </td>
        </tr>
        </tbody>
        </table>
    </div>
	<script type="text/javascript">
		$(function(){
			$("#item-image").on("click",function(){
				$("#item_image").click();
			});
		});
		//이미지 미리보여주기 이벤트
		document.querySelector("#item_image").addEventListener("change", e => {
			readURL(e.target);
		});
		//이미지 미리보여주기 함수
		function readURL(input) {
		  if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
			  const previewImage = document.getElementById("item-image");
			  const imageTag = `<img src="${e.target.result}" width="100" height="100">`;
			  previewImage.innerHTML=imageTag;
			};
			reader.readAsDataURL(input.files[0]);
		  } else {

		  }
		}

	</script>
</section>

<div style="width:100%;text-align:center;">
	<button type="submit" style="background-color:#000;color:#fff;padding:10px;border:0">등록하기</button>
</div>


</form>



<?php
include_once ('./admin.tail.php');
?>
