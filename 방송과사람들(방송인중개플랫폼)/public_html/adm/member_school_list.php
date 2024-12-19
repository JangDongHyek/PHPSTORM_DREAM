<?php
$sub_menu = "200500";
include_once('./_common.php');

include_once('../jl/JlConfig.php');

auth_check($auth[$sub_menu], 'r');



$g5['title'] = '학력 전공 증빙자료';
include_once('./admin.head.php');


?>
<div id="app">
    <school-list></school-list>
</div>


<?php $jl->vueLoad("app");?>

<?php $jl->componentLoad("item");?>
<?php $jl->componentLoad("/adm/member");?>



<?php

?>
