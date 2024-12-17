<?php
$sub_menu = "250000";
include_once('./_common.php');

include_once('../jl/JlConfig.php');

auth_check($auth[$sub_menu], 'r');



$g5['title'] = '상품관리';
include_once('./admin.head.php');


?>
<div id="app">
    <product-list></product-list>
</div>


<?php $jl->vueLoad("app",["drag"]);?>

<?php $jl->componentLoad("adm/product");?>
<?php $jl->componentLoad("item");?>




<?php

?>
