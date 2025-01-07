<?php
$sub_menu = '300000';
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
if($_FILES['item_image']['name']){
	$dotIndexOf = strpos($_FILES['item_image']['name'], ".") + 1;
	$imgLength = strlen($_FILES['item_image']['name']);
	$ext = strtolower(substr($_FILES['item_image']['name'], $dotIndexOf, $imgLength));//확장자
	$uploadPath = G5_DATA_PATH . "/item/";
	$path = G5_DATA_URL . "/item/";
	$item_image = date("YmdHis").rand(10,99)."." . $ext;
	if (!move_uploaded_file($_FILES['item_image']['tmp_name'], $uploadPath . $item_image)) {
	} else {
	}
	make_thumbnail($uploadPath . $item_image, 100, 100, $uploadPath . "/thumb/" . $item_image);
}else{
	$item_image=$_POST['old_item_image'];
}

if($_POST['w']==""){
	$sql="insert g5_item set
			category_no='$category_no',
			item_name ='$item_name',
			price='$price',
			orderby='$orderby',
			item_image='$item_image'";
	sql_query($sql);

}else{
	$sql="update g5_item set
			category_no='$category_no',
			item_name='$item_name',
			price='$price',
			orderby='$orderby',
			item_image='$item_image'
			where idx='$idx'";
	sql_query($sql);
}

goto_url("./item_list.php");
