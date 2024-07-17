<?php
$sub_menu = "230100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');



$g5['title'] = '카테고리 관리';
include_once('./admin.head.php');


?>
<div id="app">
    <adm-category-list></adm-category-list>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>
<script src="<?=G5_JS_URL?>/jang.js"></script>

<script>
    Vue.data.test = 1;
</script>




<?php
include_once (G5_PATH."/component/adm-category-list.php");
include_once (G5_PATH."/component/modal-component.php");
include_once (G5_PATH."/component/adm-category-input.php");
include_once (G5_PATH."/component/paging-component.php");
include_once ('./admin.tail.php');
?>
